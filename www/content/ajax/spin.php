<?php
/*
 *  © CoinWheel 
 *  Demo: http://www.btcircle.com
 *  Please do not copy or redistribute.
 *  More licences we sell, more products we develop in the future.  
*/

$included=true;
include '../../inc/db-conf.php';
include '../../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../../inc/functions.php';

if (empty($_GET['_unique']) || mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"))==0) exit();

$player=mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE `hash`='".prot($_GET['_unique'])."' LIMIT 1"));

if (!isset($_GET['w']) || !is_numeric($_GET['w']) || (double)$_GET['w']>$player['balance']) {
  echo json_encode(array('error'=>'yes','data'=>'invalid_bet'));
  exit();
}

$multipliers=array(
  '1.25;11.25',       // 0
  '0.25;33.75',       // 1
  '1.25;56.25',          // 2
  '0;78.75',          // 3
  '2;101.25',         // 4
  '0.35;123.75',      // 5
  '2;146.25',         // 6
  '0.40;168.75',      // 7
  '1.25;191.25',       // 8
  '0.25;213.75',      // 9
  '1.25;236.25',      // 10
  '0;258.75',         // 11
  '3;281.25',         // 12
  '0;303.75',         // 13
  '1.5;326.25',       // 14
  '0.6;348.75',      // 15
);

if ((double)$_GET['w']==0 || $_GET['w']=='') {
  shuffle($multipliers);
  $xp_=explode(';',$multipliers[rand(0,count($multipliers)-1)]);
  $multiplier=(double)$xp_[0];
  $spinTo=($xp_[1]-8)+rand(0,16);
  echo json_encode(array('spin'=>'free','error'=>'no','data'=>$multiplier,'spinTo'=>$spinTo));
  exit();
}

if (empty($_GET['client_seed']) || !is_numeric($_GET['client_seed']) || !is_int((int)$_GET['client_seed']) || strlen($_GET['client_seed'])>24) exit();



$wager=(double)$_GET['w'];

$reservedBalance=mysql_fetch_array(mysql_query("SELECT SUM(`balance`) AS `sum` FROM `players`"));
$reservedWaitingBalance=mysql_fetch_array(mysql_query("SELECT SUM(`amount`) AS `sum` FROM `deposits`"));
$serverBalance=$wallet->getbalance();
$serverFreeBalance=($serverBalance-$reservedBalance['sum']-$reservedWaitingBalance['sum']);

$jakynasobekminimalne=40;

if (($wager*$jakynasobekminimalne)>$serverFreeBalance) {
  echo json_encode(array('error'=>'yes','data'=>'too_big_bet','under'=>($serverFreeBalance/$jakynasobekminimalne)));
  exit();
}


$colick=($player['client_seed'])*9;

$server_seed_array=explode('|',$player['server_seed']);
$rest=$colick%16;

$return_index=$server_seed_array[$rest];



$xp_=explode(';',$multipliers[$return_index]);


$multiplier=(double)$xp_[0];
$spinTo=($xp_[1]-8)+rand(0,16);

if ((double)$_GET['w']<0.00000001) {
  echo json_encode(array('error'=>'yes','data'=>'too_small'));
  exit();
}

$balance=$player['balance']-$wager;


$newBalance_=$wager*$multiplier+$balance;
if (strpos('.',(string)$newBalance_)!==false) {
  $xploded=explode('.',(string)$newBalance);
  $newBalance__=$xploded[0].'.'.substr(sprintf('%0.10f',$xploded[1]),0,7);
}
else $newBalance__=$newBalance_;
$newBalance=(double)$newBalance__;

mysql_query("UPDATE `players` SET `balance`=TRUNCATE($newBalance,10),`t_spins`=`t_spins`+1 WHERE `id`=$player[id] LIMIT 1");
mysql_query("INSERT INTO `spins` (`wager`,`multiplier`,`player`) VALUES ($wager,$multiplier,$player[id])");

// new seed
$multips_index=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);

shuffle($multips_index);
$s_seed=implode('|',$multips_index);
$c_seed=(int)$_GET['client_seed'];

mysql_query("UPDATE `players` SET `server_seed`='$s_seed',`client_seed`=$c_seed,`old_server_seed`='$player[server_seed]',`old_client_seed`='$player[client_seed]' WHERE `id`=$player[id] LIMIT 1");


echo json_encode(array('spin'=>'spin','error'=>'no','data'=>$multiplier,'spinTo'=>$spinTo,'reduceTo'=>$balance,'tspins'=>($player['t_spins']+1),'tspins_'=>mysql_num_rows(mysql_query("SELECT `id` FROM `spins`"))));

?>