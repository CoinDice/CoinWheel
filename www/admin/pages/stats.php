<?php

if (!isset($included)) exit();

?>
<h1>Stats</h1>
<div class="zprava">
<small>
<b>Note:</b>
Stats are computed from spins history. If you delete spins history, stats will be limited to the remaining data.
</small>
</div>
<br>
<b>Players Luck</b>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>Period</th>
    <th>0x</th>
    <th>0.25x</th>
    <th>1.25x</th>
    <th>1.5x</th>
    <th>2x</th>
    <th>3x</th>
    <th>House edge*</th>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last hour</td><?php $interval="60 MINUTE"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last 24h</td><?php $interval="24 HOUR"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last 7d</td><?php $interval="7 DAY"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last 30d</td><?php $interval="30 DAY"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last 6m</td><?php $interval="6 MONTH"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Last 12m</td><?php $interval="12 MONTH"; ?>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m AND `time`>NOW()-INTERVAL $interval")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Since start</td>
    <td><?php $m=0; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=0.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.25; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=1.5; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=2; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <td><?php $m=3; $per["$m"]=mysql_num_rows(mysql_query("SELECT `id` FROM `spins` WHERE `multiplier`=$m")); echo $per["$m"]; $per["$m"].='|'.$m; ?></td>
    <?php
    $all=0;
    $div=0;
    foreach ($per as $howm) {
      $howm=explode('|',$howm);
      $all+=(int)$howm[0]*(float)$howm[1];
      $div+=(int)$howm[0];  
    }
    ?>
    <td title="<?php echo ((1-(round($all/$div,4)))*100).'%'; ?>">
      <?php
      echo '<b>'.(1-(round($all/$div,4))).'</b>x';      
      ?>
    </td>
  </tr>
</table>
<b>*</b> <i>Ideal (calculated) house edge: <span title="1.5625%"><b>0.015625</b>x</span></i>
<br>
<br>
<b>Last Spin:</b>
<div class="zprava" style="margin-left: 30px;">
  <small>
  <?php
  $lspin=mysql_fetch_array(mysql_query("SELECT * FROM `spins` ORDER BY `time` DESC LIMIT 1"));
  if (mysql_num_rows(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$lspin[player] LIMIT 1"))!=0) {
    $player_inf_=mysql_fetch_array(mysql_query("SELECT `alias` FROM `players` WHERE `id`=$lspin[player] LIMIT 1"));
    $lspin['player']=$player_inf_['alias'];
  }                                                                                    
  else $lspin['player']='<i>[unknown]</i>';

  echo 'Time: <b>'.$lspin['time'].'</b><br>';
  echo 'Wager: <b>'.$lspin['wager'].'</b><br>';
  echo 'Result: <b>'.$lspin['multiplier'].'x</b><br>';
  echo 'Returned: <b>'.($lspin['wager']*$lspin['multiplier']).'x</b><br>';
  echo 'Player: <b>'.$lspin['player'].'</b><br>';  
  ?>
  </small>
</div>