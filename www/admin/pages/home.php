<?php

if (!isset($included)) exit();
?>
<h1>Summary</h1>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>Item</th>
    <th>Value</th>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Total server balance:</td>
    <td>
      <b>
        <?php
        $free=$wallet->getbalance(); echo $free;
        ?>
      </b><?php echo $settings['currency_sign']; ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Server free balance:</td>
    <td><b>
      <?php
      $reservedBalance=mysql_fetch_array(mysql_query("SELECT SUM(`balance`) AS `sum` FROM `players`"));
      $reservedWaitingBalance=mysql_fetch_array(mysql_query("SELECT SUM(`amount`) AS `sum` FROM `deposits`"));
      $serverBalance=$wallet->getbalance();
      $serverFreeBalance=$serverBalance-$reservedBalance['sum']-$reservedWaitingBalance['sum'];
      echo $serverFreeBalance;
      ?>
    </b> <?php echo $settings['currency_sign']; ?></td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Reserved balance (users):</td>
    <td>
      <b>
      <?php
        echo $reservedBalance['sum'];
      ?>
      </b><?php echo $settings['currency_sign']; ?>
    </td>
  </tr>
  <tr class="vypis_table_obsah">
    <td>Reserved deposits (users):</td>
    <td><b><?php echo $reservedWaitingBalance['sum']; ?></b> <?php echo $settings['currency_sign']; ?></td>
  </tr>
</table>