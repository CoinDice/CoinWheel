<?php

session_start();
if (isset($_SESSION['logged_']) && $_SESSION['logged_']==true)
  $logged=true;
else $logged=false;
//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//
$included=true;
include '../inc/db-conf.php';
include '../inc/wallet_driver.php';
$wallet=new jsonRPCClient($driver_login);
include '../inc/functions.php';

include './post.php';
$settings=mysql_fetch_array(mysql_query("SELECT * FROM `system` WHERE `id`=1 LIMIT 1"));
?>  
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $settings['title']; ?> - ADMINISTRATION</title>
    <meta charset="utf-8">
    <style>
    body { text-align: center; font: 10pt Arial, Halvetica; }
    td { font: 10pt Arial, Halvetica; }
    input { font: 9pt Verdana, Arial; }
    textarea { font: 9pt Verdana, Arial; }
    .strankovani { width: 99.3%;text-align: right; }
    .vypis_table {width: 100%;}
    .vypis_table_head {background-color: #3B68B6;color: white;}
    .vypis_table_obsah { background-color: #EEEEEE; border-top: 1px solid white;}
    a {color: #49619C;font-weight: bold;}
    a:link, a:visited {text-decoration: none;}
    a:hover {background-color: #CCCCCC;text-decoration: underline;}
    .main {width: 750px;margin: auto;background-color: white;border: 1px solid #CCCCCC;}
    .menu { width: 19%; }
    .menu ul { margin: 0; }
    .menu ul li { list-style: none outside none; margin: 0 0 1px -38px; }
    * html .menu ul li { margin: 0 0 -15px 0; padding: 0; }
    .menu ul a { border: 1px solid #9DBADF; border-left: 4px solid #9DBADF; border-right: 4px solid #9DBADF; color: #49619C; padding: 5px 2px 5px 2px; font-weight: bold; display: block; }
    .menu ul a:link,.menu ul a:visited { background-color: #E4EEFF; text-decoration: none; }
    .menu ul a:hover { background-color: #C3CFFF; text-decoration: underline; }    
    .header { text-align: left; padding: 5px 5px 5px 5px; border-bottom: 1px solid #CCCCCC; margin-bottom: 5px; background-color: #EEEEEE; }
    .obsah { width: 78%; float: right; padding: 0 5px 0 5px; text-align: left; margin-bottom: 5px; }    
    .zprava { padding: 3px; margin: 3px; border: 1px solid #CCCCCC; background-color: #EEEEEE; color: black; }
    .zpravagreen { padding: 3px; margin: 3px; border: 1px solid #CCFFCC; background-color: #EEFFEE; color: #003500; }
    .zpravared { padding: 3px; margin: 3px; border: 1px solid #FFCCCC; background-color: #FFEEEE; color: #530000; }
    .paticka { clear: both; background-color: #EEEEEE; margin-top: 5px; border-top: 1px solid #CCCCCC; }
    h1{font: bold 14pt Arial, Halvetica;margin: 0; padding: 0;}
    </style>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">
      function message(type,cont) {
        if (type=='error') {
          color='zpravared';
          h='Error:';
        }
        else if (type=='success') {
          color='zpravagreen';
          h='Success:';
        }
        $("div.messages").html('<div class="'+color+'"><b>'+h+'</b> '+cont+'</div>');
      }
    </script>
  </head>
  <body>
    <em>← Go to <a href="http://<?php echo $settings['url']; ?>"><?php echo $settings['url']; ?></a> <small><small>(<a target="_blank" href="http://<?php echo $settings['url']; ?>">new window</a>)</small></small></em>
    <div class="main">
      <div class="header">
        <font style="font-size: 14pt; font-weight: bold;">Administration - <?php echo $settings['title']; ?></font>
        <br>
        User: <b><?php if ($logged) echo $_SESSION['username'].' | <a href="./login.php?logout">Logout</a>'; else echo 'Unlogged'; ?></b>
      </div>    
      <div class="obsah">
        <?php
        if (!$logged) { 
          if (isset($_GET['login_error'])) echo '<div class="zpravared"><b>Error: </b>Wrong login details.</div>';
          if (isset($_GET['logouted'])) echo '<div class="zpravagreen"><b>Success: </b>You have been logged out.</div>';
        ?>
        <form action="login.php" method="post">
          <table border="0">
            <tr><td>Username:</td><td><input style="width: 150px;" type="text" name="hash_one"></td></tr>
            <tr><td>Password:</td><td><input style="width: 150px;" type="password" name="hash_sec"></td></tr>
            <tr><td colspan="2" style="text-align: center;"><input type="submit" name="prihlaseni" value="Login"></td></tr>
          </table>
         </form>
         <?php
         }
         else {
          echo '<div class="messages"></div>';
          if (!empty($_GET['p']) && file_exists('./pages/'.$_GET['p'].'.php'))
            include './pages/'.$_GET['p'].'.php';
           else if (!isset($_GET['p'])) include './pages/home.php';
           else include '404.php';  
         }
         ?>
      </div>
      <div class="menu">
        <ul>
          <li><a href="./">Home</a></li>
          <?php if ($logged) { ?>
          <li><a href="./?p=players">Players</a></li>
          <li><a href="./?p=spins">Spins</a></li>
          <li><a href="./?p=stats">Stats</a></li>          
          <li><a href="./?p=wallet">Wallet</a></li>
          <li><a href="./?p=news">News</a></li>
          <li><a href="./?p=admins">Admins</a></li>
          <li><a href="./?p=settings">Settings</a></li>          
          <?php } ?>
        </ul>
      </div>
      <div class="paticka">
       &copy; <?php echo date('Y',time()).' '; ?> | <?php echo $settings['title']; ?> Administration
     </div>
    </div>
  </body>
</html>