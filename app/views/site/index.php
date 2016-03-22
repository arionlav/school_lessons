<?php
use \config\App;

$title = 'Главная';
?>
<h1>Welcome</h1>
<h2 id="header">to our magic application</h2>
<hr/>

<h3 id="header">Upload data file</h3>

<div id="selectItems" class="form">
    <form action="<?= App::url(['site/load']) ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">

        <label for="year">Select year</label>
        <select name="year" id="year" class="simpleSelect">
            <?
            for ($i = date('Y'); $i >= 2012; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

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

        <input type="submit" id="submit" value="LOAD FILE">
    </form>
</div>

<div id="selectItems" class="searchLink">
    <a id="searchLink" href="<?= App::url(['site/search-index']) ?>">Search in database</a>
</div>

<div>
    <a id="logoutLink" href="<?= App::url(['security/login', 'e' => '0']) ?>">Logout</a>
</div>
