<?php
$db=mysql_connect('54.225.135.94', 'imperium', 'mysqladmin');
if (!$db) {
          die('Could not connect: ' . mysql_error());
 }

mysql_select_db("webapp_civicrm", $db);

?>

