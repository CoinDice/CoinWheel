<?php

if (isset($_POST['s_title']) && !empty($_POST['s_title']) && !empty($_POST['s_url']) && !empty($_POST['s_desc']) && !empty($_POST['cur']) && !empty($_POST['cur_s']))
    mysql_query("UPDATE `system` SET `title`='".prot($_POST['s_title'])."',`url`='".prot($_POST['s_url'])."',`currency`='".prot($_POST['cur'])."',`currency_sign`='".prot($_POST['cur_s'])."',`description`='".prot($_POST['s_desc'])."' WHERE `id`=1 LIMIT 1");  
?>