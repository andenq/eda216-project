<?php
session_start();
require_once('database.inc.php');
require_once("mysql_connect_data.inc.php");
require_once('form_helper.php');

$db = new Database($host, $userName, $password, $database);
$db->openConnection();
$con = $db->isConnected();
