<?php
namespace app\models\pchart;

use \config\App;

/* pChart library inclusions */
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pData.class.php");
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pDraw.class.php");
include($_SERVER{'DOCUMENT_ROOT'} . App::$pathToRoot . App::$pathToPCart . "class/pImage.class.php");

/**
 * Class ComboAreaLines
 *
 * @package app\models\pChartTmpl
 */
class ComboAreaLines
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
        $myPicture = new \pImage(700, 230, $MyData);

        /* Turn of Antialiasing */
        $myPicture->Antialias = false;

        $myPicture->drawFilledRectangle(60,40,670,190,
            ["R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10]);

        /* Overlay with a gradient */
        $Settings =
            ["StartR" => 219, "StartG" => 231, "StartB" => 139,
             "EndR"   => 1, "EndG" => 138, "EndB" => 68, "Alpha" => 50
            ];
        $myPicture->drawGradientArea(0, 0, 700, 230, DIRECTION_VERTICAL, $Settings);

        /* Add a border to the picture */
        $myPicture->drawRectangle(0, 0, 699, 229, ["R" => 0, "G" => 0, "B" => 0]);

        /* Write the chart title */
        $myPicture->setFontProperties(["FontName" => $pathToPCart
                                                     . "fonts/calibri.ttf", "FontSize" => 11]);
        $myPicture->drawText(150, 35, "Training orders",
            ["FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE]);

        /* Set the default font */
        $myPicture->setFontProperties(["FontName" => $pathToPCart
                                                     . "fonts/verdana.ttf", "FontSize" => 6]);

        /* Define the chart area */
        $myPicture->setGraphArea(60, 40, 650, 200);

        /* Draw the scale */
        $scaleSettings = ["XMargin" => 10, "YMargin" => 10, "Floating" => true,
                          "GridR" => 255, "GridG" => 255,
                          "GridB"   => 255, "DrawSubTicks" => true, "CycleBackground" => true
        ];
        $myPicture->drawScale($scaleSettings);

        /* Write the chart legend */
        $myPicture->drawLegend(540, 20, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);

        /* Turn on Antialiasing */
        $myPicture->Antialias = true;

        /* Draw the area chart */
        $MyData->setSerieDrawable("Probe 1", true);
        $MyData->setSerieDrawable("Probe 2", false);
        $myPicture->drawAreaChart();

        /* Draw a line and a plot chart on top */
        $MyData->setSerieDrawable("Probe 2", true);
        $myPicture->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);
        $myPicture->drawLineChart();
        $myPicture->drawPlotChart(["PlotBorder"  => true, "PlotSize" => 2, "BorderSize"  => 1,
                                   "Surrounding" => -60, "BorderAlpha" => 80
        ]);

        /* Render the picture (choose the best way) */
        $myPicture->Render($_SERVER{'DOCUMENT_ROOT'} . $pathToLoadGraph);

        return $pathToLoadGraph;
    }
}