<?php

use Classes\ActiveRecord;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$ar = new ActiveRecord();
$ar->select_all();
