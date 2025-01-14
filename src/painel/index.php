<?php
require_once '../vendor/autoload.php';

function pre($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

use App\Core\App;

session_start();
$app = new App();
