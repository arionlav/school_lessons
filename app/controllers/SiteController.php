<?php
namespace app\controllers;

use app\models\ModelSite;
use config\App;
use core\Controller;
use core\helpers\GenerateException;

/**
 * Class SiteController is responsible of index page and adding new data
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    function __construct()
    {
        parent::__construct();
        $this->model = new ModelSite();
    }

    /**
     * Index page on the site
     */
    public function actionIndex()
    {
        $graphTypes = $this->model->getGraphTypes();

        $this->view->render('index', [
            'graphTypes' => $graphTypes,
            'graphType'  => $_SESSION['graph_type']
        ]);
    }

    /**
     * Download file
     */
    public function actionLoad()
    {
        if (! $post = App::post()) {
            GenerateException::getException('Method must be POST', __CLASS__, __LINE__);
        }

        $this->model->cleanUploadDir();

        $pathToFile = $this->model->uploadFile($_FILES['file']['tmp_name']);

        // get data from .json file. Replace method according to data source
        $data = $this->model->getData($pathToFile);

        $this->model->insertData($data, $post['year']);

        if ($this->model->updateGraphType($post['type'], $_SESSION['graph_type'], $_SESSION['login'])) {
            // remember new graph type for user
            $_SESSION['graph_type'] = $post['type'];
        }

        $graphFile = $this->model->getGraph($_SESSION['graph_type'], $data);

        $this->view->render('result', [
            'data'      => $data,
            'graphFile' => $graphFile
        ]);
    }

    /**
     * Index page for search
     */
    public function actionSearchIndex()
    {
        $graphTypes = $this->model->getGraphTypes();
        $courseName = $this->model->getCourses();
        $month      = $this->model->getMonth();

        $this->view->render('search', [
            'graphTypes' => $graphTypes,
            'courseName' => $courseName,
            'month'      => $month,
            'graphType'  => $_SESSION['graph_type']
        ]);
    }

    /**
     * Show search result
     */
    public function actionSearchResult()
    {
        if (! $post = App::post()) {
            GenerateException::getException('Method must be POST', __CLASS__, __LINE__);
        }

        $searchResult = $this->model->getSearchResult($post);

        if (! $searchResult) {
            $this->view->render('result', [
                'emptyResult' => true
            ]);
        }

        $data = $this->model->prepareData($searchResult);

        if ($this->model->updateGraphType($post['type'], $_SESSION['graph_type'], $_SESSION['login'])) {
            $_SESSION['graph_type'] = $post['type'];
        }

        $graphFile = $this->model->getGraph($_SESSION['graph_type'], $data);

        $this->view->render('result', [
            'data'      => $data,
            'graphFile' => $graphFile
        ]);
    }
}
