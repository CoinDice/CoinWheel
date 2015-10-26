<?php

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();
$balance=mysql_fetch_array(mysql_query("SELECT `balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));
$balance_=rtrim(rtrim(sprintf("%0.12f",$balance['balance']),'0'),'.');
$return=array(
  'balance' => $balance_
);
echo json_encode($return);
?>