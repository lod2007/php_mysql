<?php require_once 'db.php';

echo "Привет, мир!<br>";
//echo phpinfo();
// var_dump(execc("show DATABASES;",array()));
$users = execc("select * from users where id>:id",array("id"=>'1'));

 foreach ($users as $key) { ?>
 <?="<p>Привет, ".$key['Name']."!"; ?>
 <?}?>


