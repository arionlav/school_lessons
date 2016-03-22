<?php
namespace app\models;

use config\App;
use core\helpers\GenerateException;
use core\Model;
use app\models\pchart\ComboAreaLines;
use app\models\pchart\ScaleLabels;

/**
 * Class ModelSite provide logic for index page and adding new data
 *
 * @package app\models
 */
class ModelSite extends Model
{
    /**
     * @var \PDO Connection to database
     */
    protected $db;

    /**
     * @var string Sql query
     */
    protected $sql;

    /**
     * Connect to database
     */
    public function __construct()
    {
        $dns      = 'mysql:host=' . App::DB_HOST . ';dbname=' . App::DB_DBNAME;
        $this->db = new \PDO($dns, App::DB_USER, App::DB_PASS);
    }


    /**
     * Download file
     *
     * @param string $fileTmp Tmp_name for downloaded file
     * @return string
     */
    public function uploadFile($fileTmp)
    {
        if (! is_uploaded_file($fileTmp)) {
            GenerateException::getException('File does not load', __CLASS__, __LINE__);
        }

        $fileName     = date('d.m.Y') . '--' . time() . '.json';
        $pathToUpload = App::$pathToLoadFiles . '/' . $fileName;

        move_uploaded_file($fileTmp, $pathToUpload);

        return $pathToUpload;
    }

    /**
     * Remove all downloaded files from [[App::$pathToLoadFiles]] directory
     */
    public function cleanUploadDir()
    {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . App::$pathToRoot . '/'
                      . App::$pathToLoadFiles . '/*');

        if (! empty($files)) {
            array_map('unlink', $files);
        }
    }

    /**
     * Get values from .json file
     *
     * @param string $pathToFile Path to .json file
     * @return \StdClass
     * @throws GenerateException
     */
    public function getData($pathToFile)
    {
        $data = null;

        if (file_exists($pathToFile)) {
            $data = json_decode(file_get_contents($pathToFile));
        }

        if ($data === null) {
            GenerateException::getException('Format file must be .json', __CLASS__, __LINE__);
        }

        return $data;
    }

    /**
     * Insert data into database
     *
     * @param object $data Data for insert
     * @param string $year Year
     * @return bool
     * @throws GenerateException
     */
    public function insertData($data, $year)
    {
        if (! empty($data->Rows)) {

            $bindParams = $this->getSqlQueryForInsert($data->Rows, $year);

            if (! $bindParams) {
                GenerateException::getException('Binding params are fail', __CLASS__, __LINE__);
            }

            $this->db->beginTransaction();

            if (! $this->deleteRowsByYear($year)) {
                $this->db->rollBack();
            }

            $stmt   = $this->db->prepare($this->sql);
            $result = $stmt->execute($bindParams);

            if (! $result) {
                $this->db->rollBack();
            } else {
                $this->db->commit();
            }
        } else {
            GenerateException::getException('Nothing for inserting ', __CLASS__, __LINE__);
        }

        return true;
    }

    /**
     * Create sql query. $this->sql variable will contain it
     *
     * @param array  $data Data for insert
     * @param string $year Year
     * @return array Array with binding params
     * @throws GenerateException
     */
    protected function getSqlQueryForInsert($data, $year)
    {
        $sql = "INSERT INTO count_course (id, course_year, course_name_id, course_month, count_courses)
                VALUES ";

        $courses     = $this->getCourses();
        $bindParams  = []; // array with binding params
        $insertQuery = []; // array with binding variable for one inserting row, example [(?, ?, ?)[,]]

        $i = 0;
        foreach ($data as $courseName => $countCourses) {
            $courseId = null;
            if (! empty($courses)) {
                foreach ($courses as $value) {
                    if ($courseName == $value['course_name']) {
                        $courseId = $value['id'];
                    }
                }
            }
            if (is_null($courseId)) {
                GenerateException::getException('Unknown course name', __CLASS__, __LINE__);
            }

            $month = 0;
            if (! empty($countCourses)) {
                foreach ($countCourses as $value) {
                    $insertQuery[] = "(null, {$year}, :courseName{$i}, :courseMonth{$i}, :countCourse{$i})";

                    $bindParams[":courseName{$i}"]  = $courseId;
                    $bindParams[":courseMonth{$i}"] = $month;
                    $bindParams[":countCourse{$i}"] = $value;

                    $month++;
                    $i++;
                }
            }
        }

        $sql .= implode(', ', $insertQuery);
        $this->sql = $sql;

        return $bindParams;
    }

    /**
     * Update the graph type for user if it has been changed
     *
     * @param string $inputType    Incoming value for graph type
     * @param string $oldGraphType Current value for graph type
     * @param string $login        User login
     * @return bool
     * @throws GenerateException
     */
    public function updateGraphType($inputType, $oldGraphType, $login)
    {
        if ($inputType != $oldGraphType) {
            $sql  = "UPDATE user_users SET graph_type = :inputType WHERE login = :login";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':inputType', $inputType);
            $stmt->bindParam(':login', $login);
            $result = $stmt->execute();

            if (! $result) {
                GenerateException::getException('Updating the graph type is fail', __CLASS__, __LINE__);
            }

            return true;
        }

        return false;
    }

    /**
     * Remove all rows for the current year
     *
     * @param string $year Year
     * @return bool
     */
    protected function deleteRowsByYear($year)
    {
        $sql  = "DELETE FROM count_course WHERE course_year = :course_year";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':course_year', $year);
        $result = $stmt->execute();

        return $result;
    }

    /**
     * Get all courses
     *
     * @return array
     * @throws GenerateException
     */
    public function getCourses()
    {
        $sql  = "SELECT id, course_name FROM course_name";
        $stmt = $this->db->query($sql);
        $arr  = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (! $arr) {
            GenerateException::getException('Array with courses are empty', __CLASS__, __LINE__);
        }

        return $arr;
    }

    /**
     * Get all graph types
     *
     * @return array
     * @throws GenerateException
     */
    public function getGraphTypes()
    {
        $sql  = "SELECT id, nameGraphType FROM graph_types";
        $stmt = $this->db->query($sql);
        $arr  = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (! $arr) {
            GenerateException::getException('Array with graph types are empty', __CLASS__, __LINE__);
        }

        return $arr;
    }

    /**
     * Run needle method for graph creation
     *
     * @param \StdClass $data      Data for graph
     * @param int       $graphType Current graph type
     * @return string Link to graph image
     * @throws GenerateException
     */
    public function getGraph($graphType, $data)
    {
        switch ($graphType) {
            case 1:
                $graphName = ScaleLabels::run($data);
                break;
            case 2:
                $graphName = ComboAreaLines::run($data);
                break;
            default:
                $graphName = ScaleLabels::run($data);
        }

        if (! file_exists($_SERVER['DOCUMENT_ROOT'] . $graphName)) {
            GenerateException::getException('Graph creation error', __CLASS__, __LINE__);
        }

        return $graphName;
    }

    /**
     * Get search result from database
     *
     * @param array $post Incoming values
     * @return array
     */
    public function getSearchResult($post)
    {
        $sql = "SELECT c1.id, c1.course_year, c2.course_name, c1.course_month, c1.count_courses
                FROM count_course c1
                INNER JOIN course_name c2 ON c1.course_name_id = c2.id";

        $queryParams = '';
        $bindParams  = [];

        if ($post['year']) {
            $queryParams .= ' WHERE';
            $queryParams .= ' course_year = ?';
            $bindParams[] = $post['year'];
        }

        if (! empty($post['courseName'])) {
            if (! in_array('-1', $post['courseName'])) {
                if ($queryParams === '') {
                    $queryParams .= ' WHERE';
                } else {
                    $queryParams .= ' AND';
                }

                $count = count($post['courseName']) - 1;
                if ($count === 0) {
                    $queryParams .= ' course_name_id = ?';
                    $bindParams[] = $post['courseName'][0];
                } else {
                    $queryParams .= ' course_name_id IN (';
                    foreach ($post['courseName'] as $key => $value) {
                        $queryParams .= '?';
                        $bindParams[] = $value;
                        if ($key != $count) {
                            $queryParams .= ', ';
                        }
                    }
                    $queryParams .= ')';
                }
            }
        }

        if (! empty($post['month'])) {
            if (! in_array('-1', $post['month'])) {
                if ($queryParams === '') {
                    $queryParams .= ' WHERE';
                } else {
                    $queryParams .= ' AND';
                }

                $count = count($post['month']) - 1;
                if ($count === 0) {
                    $queryParams .= ' course_month = ?';
                    $bindParams[] = $post['month'][0];
                } else {
                    $queryParams .= ' course_month IN (';
                    foreach ($post['month'] as $key => $value) {
                        $queryParams .= '?';
                        $bindParams[] = $value;
                        if ($key != $count) {
                            $queryParams .= ', ';
                        }
                    }
                    $queryParams .= ')';
                }
            }
        }

        $sql .= $queryParams;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindParams);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    /**
     * Create \StdClass object for search result
     *
     * @param array $searchResult Values from database
     * @return \StdClass
     */
    public function prepareData($searchResult)
    {
        $data = new \StdClass();

        $months = $this->getMonth();

        $data->Columns = [];

        foreach ($searchResult as $row) {
            if (! empty($data->Columns)) {
                $flag = 0;
                foreach ($data->Columns as $key => $value) {
                    if ($value == $months[$row['course_month']]) {
                        $flag = 1;
                        break;
                    }
                }
                if (! $flag) {
                    $data->Columns[] = $months[$row['course_month']];
                }
            } else {
                $data->Columns[] = $months[$row['course_month']];
            }

            $data->Rows[$row['course_name']][$row['course_month']] = $row['count_courses'];
        }

        return $data;
    }

    /**
     * Get all months
     *
     * @return array
     */
    public function getMonth()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];
    }
}
