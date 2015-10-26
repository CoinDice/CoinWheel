<?php

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['client_seed']) || !is_numeric($_GET['client_seed']) || !is_int((int)$_GET['client_seed']) || strlen($_GET['client_seed'])>24 || empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$player=mysql_fetch_array(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));


mysql_query("UPDATE `players` SET `client_seed`=$_GET[client_seed] WHERE `id`=$player[id] LIMIT 1");

echo json_encode(array('error'=>'no'));

?>