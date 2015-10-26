<?php
mysql_query("UPDATE `players` SET `time_last_active`=NOW(),`lastip`='".$_SERVER['REMOTE_ADDR']."' WHERE `id`=$player[id] LIMIT 1");
mysql_close();
?>