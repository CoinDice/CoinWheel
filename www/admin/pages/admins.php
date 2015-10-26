<?php

if (!isset($included)) exit();

if (isset($_POST['nwa_user']) && isset($_POST['nwa_pass'])) {
  if (!empty($_POST['nwa_user']) && !empty($_POST['nwa_pass'])) {
    mysql_query("INSERT INTO `admins` (`username`,`passwd`) VALUES ('".prot($_POST['nwa_user'])."','".md5($_POST['nwa_pass'])."')");
    echo '<div class="zpravagreen"><b>Success:</b> Admin was successfuly created!</div>';
  }
  else echo '<div class="zpravared"><b>Error:</b> One of required fields stayed empty!</div>';
}
?>
<h1>Administrators</h1>
<div class="zprava">
<b>New admin:</b><br>
<form action="./?p=admins" method="post">
  Username: <input type="text" name="nwa_user"> Password: <input type="password" name="nwa_pass"> <input type="submit" value="Create">
</form>
</div>
<table class="vypis_table">
  <tr class="vypis_table_head">
    <th>ID</th>
    <th>Username</th>
    <th>Actions</th>
  </tr>
    <?php
    $qu=mysql_query("SELECT * FROM `admins`");
    while ($row=mysql_fetch_array($qu)) {
      echo '<tr class="vypis_table_obsah" id="rowid_'.$row['id'].'">';
      echo '<td>'.$row['id'].'</td>';
      echo '<td>'.$row['username'].'</td>';
      echo '<td><a href="#" onclick="javascript:removeAdmin('.$row['id'].');return false;" title="Delete Admin"><img src="./imgs/cross.png" style="width: 16px;"></a></td>';
      echo '</tr>';
    }
    ?>
</table>
<script type="text/javascript">
  function removeAdmin(id) {
    if (confirm('Do you really want to delete this admin?')) {
      $.ajax({
        'url': 'ajax/delete_admin.php?_admin='+id,
        'dataType': "json",
        'success': function(data) {
          $("tr#rowid_"+id).remove();
          message('success','Admin has been deleted.');
        }
      });
    }
  }
</script>