<?php

$included=true;
include '../../inc/db-conf.php';
include '../../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../../inc/functions.php';

if (empty($_GET['amount']) || empty($_GET['valid_addr']) || empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();

$player=mysql_fetch_array(mysql_query("SELECT `id`,`balance` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

$validate=$wallet->validateaddress($_GET['valid_addr']);
if ($validate['isvalid']==false) {
  $error='yes';
  $con=0;
}
else {
  if (!is_numeric($_GET['amount']) || (double)$_GET['amount']>$player['balance'] || (double)$_GET['amount']<0.001) {
    $error='yes';
    $con=1;
  }
  else {
    $amount=(double)$_GET['amount']-0.0002;
    $txid=$wallet->sendfrom('',$_GET['valid_addr'],$amount);
    mysql_query("UPDATE `players` SET `balance`=`balance`-".prot($_GET['amount'])." WHERE `id`=$player[id] LIMIT 1");
    $error='no';
    $con=$txid;
  }
}
$return=array(
  'error' => $error,
  'content' => $con
);

echo json_encode($return);
?>