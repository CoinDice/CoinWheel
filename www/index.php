<?php

$init=true;
include './inc/start.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $settings['title'].' - '.$settings['description']; ?></title>
  <link rel="stylesheet" type="text/css" href="style/main.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/rotate.js"></script>
  <script type="text/javascript" src="content/ext/msgbox/Scripts/jquery.msgBox.js"></script>
  <link rel="stylesheet" type="text/css" href="content/ext/msgbox/Styles/msgBoxLight.css">
  <?php include './js/includer.php'; ?>
</head>
<body>
  <audio id="audio-spinning">
    <source src="./content/sounds/spinning/spinning.mp3" type="audio/mpeg">
    <source src="./content/sounds/spinning/spinning.ogg" type="audio/ogg">
  </audio>
  <audio id="audio-success">
    <source src="./content/sounds/success/success.mp3" type="audio/mpeg">
    <source src="./content/sounds/success/success.ogg" type="audio/ogg">
  </audio>
  <audio id="audio-lose">
    <source src="./content/sounds/lose/lose.mp3" type="audio/mpeg">
    <source src="./content/sounds/lose/lose.ogg" type="audio/ogg">
  </audio>
  <div id="allbody">
    <div id="ab-content">
      <div class="nahore">
        <a href="./" id="logo"><?php echo (file_exists('./logo.png'))?'<img src="./logo.png">':'<span style="position: relative; top: 8px;">'.$settings['title'].'</span>'; ?></a><br>
        <div id="alt-menu"><a href="#" onclick="javascript:return deposit();" class="deposit">Deposit</a><a href="#" onclick="javascript:return withdraw();" class="withdraw">Withdraw</a> </div>
        <table id="wof">
          <tr>
            <td valign="top" align="right"><div style="margin-top: 208px;"><big><big><big><big><b><img src="./content/images/arrow.png" id="arrow"></b></big</big></big></big></div></td>
            <td valign="top" align="left" style="height: 500px;">
              <div id="middler"><!-- multiplier --></div>
              <img src="./content/images/wof.png" id="wof-image">
              <img src="./content/images/wof_center.png" id="wof-image" class="wfcenter">
            </td>
          </tr>
        </table><br><br><br><br><br>
        <div id="left-content">
          <div style="width: 420px; padding-left: 23px;"><span onclick="javascript:getElementById('unique').select();" style="cursor: pointer; cursor: hand;"><b>This is your unique login URL<br>Do not share</b></span><br><input id="unique" readonly="readonly" type="text" class="l unique" title="Click to select all" onclick="javascript:this.select();" value="<?php echo $settings['url']; ?>/?unique=<?php echo $unique; ?>"></div>
          <div id="balance" style="margin-top: 25px;"><big>Your Balance: <b><span id="balance_"><?php echo $player['balance']; ?></span></b> <?php echo $settings['currency_sign']; ?> &nbsp;&nbsp;<a href="./" onclick="javascript:return refreshbalance();"><img id="_refresh" src="./content/images/refresh.png" style="position: relative; top: 4px; width: 18px; height: 18px;" title="Refresh balance"></a></big></div>
          <table cellspacing="0" width="250px;" id="bet_table">
            <tr>
              <td></td>
              <td id="fillPercents">
                <a href="#" onclick="javascript:return _fillPercents(10);">10%</a>
                <a href="#" onclick="javascript:return _fillPercents(50);">50%</a>
                <a href="#" onclick="javascript:return _fillPercents(100);">All</a>
                <a href="#" onclick="javascript:$('#bet_input').val('0');return false;" class="longer">Clear</a>
              </td>
            </tr>
            <tr>
              <td><b>Bet: &nbsp;</b></td>
              <td><input type="text" class="l downseked" onkeypress="return _runEnter(event)" id="bet_input" style="width: 186px;" value="0"></td>
            </tr>
            <tr>
              <td></td>
              <td><a href="#" class="spinButton" onclick="javascript:spin();return false;">SPIN</a></td>
            </tr>
          </table>
          <div style="height: 40px;"></div>

          <div id="balance">
            <b>Options:</b>&nbsp;
            <a href="#" class="randomize options" onclick="javascript:<?php if ($player['password']=='') echo 'passwd_protect();'; else echo 'passwd_unprotect();'; ?>return false;"><?php if ($player['password']=='') echo 'Set Pass'; else echo 'Remove Pass'; ?></a> |
            <a href="#" onclick="javascript:_changeAlias(prompt('Type in your alias:'));return false;" class="randomize options"><?php echo zkrat($player['alias'],15,'...'); ?></a> |
            <a href="#" onclick="javascript:return deposit();" class="randomize options">Deposit</a> |
            <a href="#" onclick="javascript:return withdraw();" class="randomize options">Withdraw</a>
          </div>

          <div id="placer_">
            <br><br>
            <table style="margin-left: auto; margin-right: auto; text-align: center;"><tr>
              <td class="spins_s"><i>Your spins:</i><br><big><span id="yspins"><?php $zsp=mysql_fetch_array(mysql_query("SELECT `t_spins` FROM `players` WHERE `id`=$player[id] LIMIT 1")); echo $zsp['t_spins'] ?></span></big></td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td class="spins_s"><i>Total spins:</i><br><big><span id="tspins"><?php echo mysql_num_rows(mysql_query("SELECT `id` FROM `spins`")); ?></span></big></td>
            </tr></table>
          </div>
        </div>
      </div>
      <div class="dole">
      <div id="centerer">
        <ul id="stats-menu">
          <li><a id="stats_recent_spins" href="#" onclick="javascript:_stats_content('recent_spins');return false;">Recent Spins</a></li>
          <li><a id="stats_leaderbord" href="#" onclick="javascript:_stats_content('leaderbord');return false;">Leaderboard</a></li>
          <li><a id="stats_news" href="#" onclick="javascript:_stats_content('news');return false;">News</a></li>
          <li><a id="stats_fair" href="#" onclick="javascript:_stats_content('fair');return false;">Fair?</a></li>
        </ul>
      </div>
      <div id="stats-content">

      </div>
      <script type="text/javascript">
        _stats_content('recent_spins');
      </script>
      </div>
    </div>
    <div style="width: 100%; text-align: center; margin-top: 12px; padding-top: 12px; border-top: 1px solid #666699;">
      <?php include './inc/footer.php'; ?>
    </div>
    <div style="height: 20px;"></div>
  </div>
</body>
</html>
<?php include './inc/end.php'; ?>