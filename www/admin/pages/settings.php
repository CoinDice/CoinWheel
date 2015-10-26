<?php

if (!isset($included)) exit();

if (isset($_POST['s_title'])) {
  if (!empty($_POST['s_title']) || !empty($_POST['s_url']) || !empty($_POST['s_desc']) || !empty($_POST['cur']) || !empty($_POST['cur_s'])) {
    echo '<div class="zpravagreen"><b>Success!</b> Data was successfuly saved.</div>';  
  }
  else {
    echo '<div class="zpravared"><b>Error!</b> One of fields is empty.</div>';
  }
}

?>

<h1>Settings</h1>
<br>
<form action="./?p=settings" method="post">
  <table>
    <tr>
      <td>Site Title:</td>
      <td><input type="text" name="s_title" value="<?php echo $settings['title']; ?>"></td>
    </tr>
    <tr>
      <td>Site URL:</td>
      <td><input type="text" name="s_url" value="<?php echo $settings['url']; ?>"></td>
      <td><small><i>without <b>http://</b></i></small></td>
    </tr>
    <tr>
      <td>Site Description:</td>
      <td><input type="text" name="s_desc" value="<?php echo $settings['description']; ?>"></td>
    </tr>
    <tr>
      <td>Currency:</td>
      <td><input type="text" name="cur" value="<?php echo $settings['currency']; ?>"></td>
    </tr>
    <tr>
      <td>Currency Sign:</td>
      <td><input type="text" name="cur_s" value="<?php echo $settings['currency_sign']; ?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" value="Save"></td>
    </tr>
  </table>
</form>
<hr>
<div class="zprava">
<b>Logo Setting</b><br>
<small>
  If you want to display your own logo at the top of the site, upload "<b>logo.png</b>" file
  at the root folder (<?php echo $settings['url']; ?>/<b>logo.png</b>). It automatically
  displays your logo image instead of Site Title. 
</small>
</div>