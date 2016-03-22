<?php
use \config\App;

$title = 'Training orders';
?>
<script src="<?= App::$pathToRoot ?>/js/table.js"></script>

<h1>Training orders</h1>

<?
if ($emptyResult) {
    echo "<div class='emptyResultMsg'>Nothing fount :( Please, change your search params</div>";
    exit;
}
?>

<? require $_SERVER['DOCUMENT_ROOT'] . App::$pathToRoot . '/app/views/layouts/table.php' ?>

<? require $_SERVER['DOCUMENT_ROOT'] . App::$pathToRoot . '/app/views/layouts/graph.php' ?>
