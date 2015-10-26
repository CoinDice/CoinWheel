<?php

if (!isset($init)) {
  header('Location: ./');
  exit();
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

$included=true;
include './inc/db-conf.php';
include './inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include './inc/functions.php';
if (empty($_GET['unique'])) {
  if (!empty($_COOKIE['unique_']) && mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_COOKIE['unique_'])."' LIMIT 1"))!=0) {
    header('Location: ./?unique='.$_COOKIE['unique_'].'# Do Not Share This URL!');
    exit();  
  }
  newPlayer($wallet);
}
else { // !empty($_GET['unique'])
  if (mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['unique'])."' LIMIT 1"))!=0) {
    $player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['unique'])."' LIMIT 1"));
    $unique=prot($_GET['unique']);
    setcookie('unique_',prot($_GET['unique']),time()+60*60*24*365*5,'/');  
  }
  else {
    setcookie('unique_','');
    header('Location: ./');    
    exit();
  }
}


if ($player['password']!='' && (empty($_COOKIE['protected_']) || $_COOKIE['protected_']!=$player['password'])) {
  if (isset($_GET['bad_'])) echo '<script type="text/javascript">alert(\'Wrong password!\')</script>';
  echo '<script type="text/javascript">window.location.href=\'./requestAccess.php?_unique='.$unique.'&pass=\'+prompt(\'This URL is password protected. Please, enter password:\');</script>';
  exit();
}

if ($player['server_seed']=='') {
  $multips_index=array(
    0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15
  );
  shuffle($multips_index);
  $s_seed=implode('|',$multips_index);
  mysql_query("UPDATE `players` SET `server_seed`='".$s_seed."' WHERE `id`=$player[id] LIMIT 1");
}

if ($player['client_seed']=='') {
  $c_seed=rand(0,999999999999999);
  mysql_query("UPDATE `players` SET `client_seed`='".$c_seed."' WHERE `id`=$player[id] LIMIT 1");
}
$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` WHERE `id`=1 LIMIT 1"));
?>