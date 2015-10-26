<?php

if (!isset($included)) exit();

if (isset($_POST['_am']) && isset($_POST['_adr'])) {
  if (!empty($_POST['_am']) && is_numeric($_POST['_am'])) {
    $amount=(double)$_POST['_am'];
    if (!empty($_POST['_adr'])) {
      $validate=$wallet->validateaddress($_POST['_adr']);
      if ($validate['isvalid']==true) {
        $txid=$wallet->sendfrom('',$_POST['_adr'],$amount);
        echo '<div class="zpravagreen"><b>Success:</b> Amount was sent.<br>Transaction ID: <i>'.$txid.'</i></div>';
      }
      else echo '<div class="zpravared"><b>Error:</b> '.$settings['currency_sign'].' address is not valid.</div>';      
    }
    else echo '<div class="zpravared"><b>Error:</b> '.$settings['currency_sign'].' address is not valid.</div>';
  }
  else echo '<div class="zpravared"><b>Error:</b> Amount is not numeric.</div>';
} 
?>
<h1>Wallet</h1>
<div class="zprava">
<b>Receiving address:</b><br>
<big>
<?php
  echo $wallet->getnewaddress();
?>
</big>
</div>

<div class="zprava">
<b>Transfer out:</b><br>
<form action="./?p=wallet" method="post">
Amount: <input type="text" name="_am"> <?php echo $settings['currency_sign']; ?> address: <input type="text" name="_adr"> <input type="submit" value="Send">
</form>
</div>
<div class="zprava">
<b>Total balance:</b><br>
<big><?php echo $wallet->getbalance(); ?></big> <?php echo $settings['currency_sign']; ?>
<br><br>
<b>Free balance:</b><br>
<big><?php $usersbal_=mysql_fetch_array(mysql_query("SELECT SUM(`balance`) AS `sum` FROM `players`")); echo $wallet->getbalance()-$usersbal_['sum']; ?></big> <?php echo $settings['currency_sign']; ?>
</div>
