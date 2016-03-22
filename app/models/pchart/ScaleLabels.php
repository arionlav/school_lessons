<?php
namespace app\models\pchart;

use \config\App;

/* pChart library inclusions */
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pData.class.php");
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pDraw.class.php");
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pImage.class.php");

/**
 * Class ScaleLabels
 *
 * @package app\models\pChartTmpl
 */
class ScaleLabels
{
    /**
     * @param $data
     * @return string
     */
    public static function run($data)
    {
        $pathToLoadGraph = App::$pathToRoot . "/img/graph/graph.png";
        $pathToPCart     = $_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart;

        /* Create and populate the pData object */
        $MyData = new \pData();

        foreach ($data->Rows as $lessonName => $orders) {
            $MyData->addPoints($orders, $lessonName);
        }

        $MyData->addPoints($data->Columns, "Labels");

        $MyData->setSerieTicks("Probe 2", 4); // line ticks

        $MyData->setAxisName(0, "Orders");
        $MyData->setAbscissaName("Months");

        $MyData->setSerieDescription("Labels", "Months");
        $MyData->setAbscissa("Labels");

        /* Create the pChart object */
        $myPicture = new \pImage(700,230,$MyData);

        /* Turn of AAliasing */
        $myPicture->Antialias = FALSE;

        /* Write the chart title */
        $myPicture->setFontProperties(["FontName" => $pathToPCart
                                                     . "fonts/calibri.ttf", "FontSize" => 11]);
        $myPicture->drawText(150, 35, "Training orders",
            ["FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE]);

        /* Set the default font */
        $myPicture->setFontProperties(["R"=>0,"G"=>0,"B"=>0,
                                       "FontName"=>$pathToPCart . "fonts/verdana.ttf","FontSize"=>7]);

        /* Define the chart area */
        $myPicture->setGraphArea(50,40,680,170);

        /* Draw the scale */
        $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"DrawSubTicks"=>TRUE,
                               "GridR"=>100,"GridG"=>100,"GridB"=>100,"GridAlpha"=>15);
        $myPicture->drawScale($scaleSettings);

        /* Draw the chart */
        $myPicture->Antialias = TRUE;
        $myPicture->drawSplineChart();
        $myPicture->Antialias = FALSE;

        /* Write the chart legend */
        $myPicture->drawLegend(540,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));


        $myPicture->drawPlotChart(["PlotBorder"  => true, "PlotSize" => 2, "BorderSize"  => 1,
                                   "Surrounding" => -60, "BorderAlpha" => 80
        ]);

        /* Render the picture (choose the best way) */
        $myPicture->Render($_SERVER{'DOCUMENT_ROOT'} . $pathToLoadGraph);

        return $pathToLoadGraph;
    }
}