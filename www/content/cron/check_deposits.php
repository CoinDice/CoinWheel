<?php

// CRON must be running every minute!
$included=true;
include '../../inc/db-conf.php';
include '../../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../../inc/functions.php';


$deposits=mysql_query("SELECT * FROM `deposits`");
while ($dp=mysql_fetch_array($deposits)) {
  $received=$wallet->getreceivedbyaddress($dp['address']);
  if ($received<0.00000001) continue;
  if ($dp['received']==1) {
    mysql_query("UPDATE `deposits` SET `confirmations`=`confirmations`+1 WHERE `id`=$dp[id] LIMIT 1");
    if (++$dp['confirmations']==15) {
      mysql_query("UPDATE `players` SET `balance`=`balance`+$received WHERE `id`=$dp[player_id] LIMIT 1");
      mysql_query("DELETE FROM `deposits` WHERE `id`=$dp[id] LIMIT 1");
    }
    continue;
  }  
  
  mysql_query("UPDATE `deposits` SET `received`=1,`amount`=$received WHERE `id`=$dp[id] LIMIT 1");
}
mysql_query("DELETE FROM `deposits` WHERE `time_generated`<NOW()-INTERVAL 7 DAY");

?>