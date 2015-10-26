<?php

if (empty($_GET['con'])) exit();

$included=true;
include '../../inc/db-conf.php';
include '../../inc/functions.php';

$content='';

switch ($_GET['con']) {
  case 'recent_spins':
    $content.='<table id="stats-table">';
    $content.='<tr>';
    $content.='<th>ID</th>';
    $content.='<th>Alias</th>';
    $content.='<th>Bet</th>';
    $content.='<th>Result</th>';
    $content.='<th>Return</th>';
    $content.='<th>Time</th>';
    $content.='</tr>';
    $query=mysql_query("SELECT * FROM `spins` ORDER BY `time` DESC LIMIT 30");
    $sl=false;
    while ($row=mysql_fetch_array($query)) {
      if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"))!=0) {
        $player_inf_=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"));
        $row['player']=$player_inf_['alias'];
      }
      else $row['player']='-';      
      
      $class=($sl==true)?' class="odd"':'';
      $content.='<tr'.$class.'>';
      $content.='<td>'.$row['id'].'</td>';
      $content.='<td>'.$row['player'].'</td>';
      $content.='<td><b>'.rtrim(rtrim(sprintf("%0.12f",$row['wager']),'0'),'.').'</b> '.$settings['currency_sign'].'</td>';
      $content.='<td><b>'.rtrim(rtrim(sprintf("%0.12f",$row['multiplier']),'0'),'.').'</b>x</td>';
      $content.='<td><b>'.rtrim(rtrim(sprintf("%0.12f",($row['wager']*$row['multiplier'])),'0'),'.').'</b> '.$settings['currency_sign'].'</td>';
      $content.='<td>'.$row['time'].' CET</td>';
      $content.='</tr>';
      if ($sl==false) $sl=true; else $sl=false;
    }
    $content.='</table>';
  break;
  case 'leaderbord':
    $content.='<table id="stats-table">';
    $content.='<tr>';
    $content.='<th>ID</th>';
    $content.='<th>Alias</th>';
    $content.='<th>Bet</th>';
    $content.='<th>Result</th>';
    $content.='<th>Return</th>';
    $content.='<th>Time</th>';
    $content.='</tr>';
    $query=mysql_query("SELECT *,(`wager`*`multiplier`) AS `return` FROM `spins` ORDER BY `return` DESC LIMIT 30");
    $sl=false;
    while ($row=mysql_fetch_array($query)) {
      if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"))!=0) {
        $player_inf_=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"));
        $row['player']=$player_inf_['alias'];
      }
      else $row['player']='-';      
      
      $class=($sl==true)?' class="odd"':'';
      $content.='<tr'.$class.'>';
      $content.='<td>'.$row['id'].'</td>';
      $content.='<td>'.$row['player'].'</td>';
      $content.='<td><b>'.$row['wager'].'</b> '.$settings['currency_sign'].'</td>';
      $content.='<td><b>'.$row['multiplier'].'</b>x</td>';
      $content.='<td><b>'.rtrim(rtrim(sprintf("%0.12f",($row['wager']*$row['multiplier'])),'0'),'.').'</b> '.$settings['currency_sign'].'</td>';
      $content.='<td>'.$row['time'].' CET</td>';
      $content.='</tr>';
      if ($sl==false) $sl=true; else $sl=false;
    }
    $content.='</table>';

  break;
  case 'news':
    $query=mysql_query("SELECT * FROM `news` ORDER BY `time` DESC");
    while ($row=mysql_fetch_array($query)) {
      $content.='<div class="news_single">';
      $content.=str_replace('[I]','<i>',str_replace('[/I]','</i>',str_replace('[BR]','<br>',str_replace('[/B]','</b>',str_replace('[B]','<b>',$row['content']))))).'<br><span class="news_single_time">'.$row['time'].'</span>';
      $content.='</div>';
    }
    $content.=' <br>';
    
  break;
  case 'fair':
    $unique=$_GET['_unique'];
    $player=mysql_num_rows(mysql_query("SELECT `id` FROM `players` WHERE `hash`='".prot($unique)."' LIMIT 1"));
    if ($player!=0) $player=mysql_fetch_array(mysql_query("SELECT `id`,`server_seed`,`client_seed`,`old_server_seed`,`old_client_seed` FROM `players` WHERE `hash`='".prot($unique)."' LIMIT 1"));
    else exit();
    $content.='<div id="fair_nice">';
    $content.='<span class="seed_hash">Server seed hash: <b>'.hash('sha256',$player['server_seed']).'</b></span>';
    $content.='<br><span class="seed_hash">Client seed: <b>'.$player['client_seed'].'</b></span>';
    $content.='<br><a href="#" onclick="javascript:randomize();return false;" class="randomize">Set client seed for next spin</a><br>';
    $content.='<br><span class="seed_hash">Old server seed: <b>'.$player['old_server_seed'].'</b></span>';
    $content.='<br><span class="seed_hash">Old client seed: <b>'.$player['old_client_seed'].'</b></span><br>';
    $content.='<br><span class="seed_hash">Formula: <b>((<i>client_seed</i> * 9) Mod 16) + 1</b> = final order in server seed</span><br><br>';
    $content.='<br><span class="seed_hash"><b>Served seed values:</b></span>';
    $content.='<br><span class="seed_hash">0 = 1.25x</span>';
    $content.='<br><span class="seed_hash">1 = 0.25x</span>';
    $content.='<br><span class="seed_hash">2 = 2x</span>';
    $content.='<br><span class="seed_hash">3 = 0x</span>';
    $content.='<br><span class="seed_hash">4 = 2x</span>';
    $content.='<br><span class="seed_hash">5 = 0.25x</span>';
    $content.='<br><span class="seed_hash">6 = 2x</span>';
    $content.='<br><span class="seed_hash">7 = 0.25x</span>';
    $content.='<br><span class="seed_hash">8 = 1.5x</span>';
    $content.='<br><span class="seed_hash">9 = 0.25x</span>';
    $content.='<br><span class="seed_hash">10 = 1.25x</span>';
    $content.='<br><span class="seed_hash">11 = 0x</span>';
    $content.='<br><span class="seed_hash">12 = 3x</span>';
    $content.='<br><span class="seed_hash">13 = 0x</span>';
    $content.='<br><span class="seed_hash">14 = 1.5x</span>';
    $content.='<br><span class="seed_hash">15 = 0.25x</span>';
    $content.='</div>';  
  break;
}


echo json_encode(array('content'=>$content));
?>