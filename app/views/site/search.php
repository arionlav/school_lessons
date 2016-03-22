<?php
use \config\App;

$title = 'Search in database';
?>
<h1>Search in database</h1>
<hr/>
<div id="searchParams">
    <form action="<?= App::url(['site/search-result']) ?>" method="post" target="_blank">

        <div id="multipleSelect">
            <label for="courseName">Course name</label>
            <select name="courseName[]" id="courseName" multiple=''>
                <option selected value='-1'>All courses</option>
                <?
                if (! empty($courseName)) {
                    foreach ($courseName as $value) {
                        echo "<option value='{$value['id']}'>{$value['course_name']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div id="multipleSelect">
            <label for="month">Month</label>
            <select name="month[]" id="month" multiple=''>
                <option selected value='-1'>All month</option>
                <?
                if (! empty($month)) {
                    foreach ($month as $key => $value) {
                        echo "<option value='{$key}'>{$value}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div id="selectItems" style="clear: both">
            <label for="year">Select year</label>
            <select name="year" id="year" class="simpleSelect">
                <?
                for ($i = date('Y'); $i >= 2012; $i--) {
                    echo "<option" . (($i == date('Y')) ? ' selected' : '') . " value='$i'>$i</option>";
                }
                ?>
            </select>
        </div>

        <div id="selectItems">
            <label for="type">Select graph type</label>
            <select name="type" id="type" class="simpleSelect">
                <?
                if (! empty($graphTypes)) {
                    foreach ($graphTypes as $value) {
                        echo "<option" . (($graphType == $value['id']) ? ' selected' : '')
                             . " value='{$value['id']}'>{$value['nameGraphType']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <input type="submit" value="Search" id="submit">
    </form>
</div>
