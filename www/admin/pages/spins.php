<?php

  if (!isset($included)) exit();
  
  $perPage=15;
  
  $page=1;
  if (!empty($_GET['_page']) && is_numeric($_GET['_page']) && is_int((int)$_GET['_page'])) {
    $page=(int)$_GET['_page'];
    $lima=-$perPage+($page*$perPage);
  }
  else $lima=0;  
  $query_=mysql_query("SELECT * FROM `spins` ORDER BY `time` DESC LIMIT $lima,$perPage");
  $pocet=mysql_num_rows(mysql_query("SELECT `id` FROM `spins`"));
  $pages_=$pocet/$perPage;
  $xplosion=explode('.',(string)$pages_);
  $pages=(int)$xplosion[0]+1;

?>
<h1>Spins</h1>
<div class="strankovani">
  Page: 
  <?php
    for ($i=0;$i<$pages;$i++) {
      $t_dec=(($i+1)==$page)?'underline':'none';
      echo '<a style="text-decoration: '.$t_dec.';" href="./?p=spins&_page='.($i+1).'">'.($i+1).'</a> ';
    }
  ?>
</div>

<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>ID</th>
    <th>Bet</th>
    <th>Result</th>
    <th>Return</th>
    <th>Player</th>
    <th>Time</th>

  </tr>
  <?php
  while ($row=mysql_fetch_array($query_)) {
    if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"))!=0) {
      $player_inf_=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$row[player] LIMIT 1"));
      $row['player']=$player_inf_['alias'];
    }                                                                                    
    else $row['player']='[unknown]';
    echo '<tr class="vypis_table_obsah">';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><b>'.$row['wager'].'</b> '.$settings['currency_sign'].'</td>';
    echo '<td><b>'.$row['multiplier'].'</b>x</td>';
    echo '<td><b>'.rtrim(rtrim(sprintf("%0.12f",($row['wager']*$row['multiplier'])),'0'),'.').'</b> '.$settings['currency_sign'].'</td>';
    echo '<td title="'.$row['player'].'" onclick="javascript:prompt(\'Alias:\',\''.$row['player'].'\');">'.zkrat($row['player'],10,'<b>...</b>').'</td>';
    echo '<td>'.$row['time'].'</td>';
    echo '</tr>'."\n";
  }
    
  ?>
</table>
