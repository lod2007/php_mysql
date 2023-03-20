<?php

function execc($SQL,$params) {
  $mysql_user = $_ENV["MYSQL_USER"];
  $mysql_password = $_ENV["MYSQL_PASSWORD"];
  $mysql_db =  $_ENV["MYSQL_DATABASE"];  
  try {
 
  $connect = new PDO('mysql:host=mysql:3306;dbname='.$mysql_db.'; charset: utf8', $mysql_user, $mysql_password);
  // $connect->exec("SET NAMES 'utf8';"); //если не прописано, в настройках Докера: command: ['mysqld', '--character-set-server=utf8mb4', '--collation-server=utf8mb4_unicode_ci']

  $data = $connect->prepare($SQL);
  $data->execute($params);
    
  if (strrpos($SQL, "INTO")>0) {
      $res=array("id"=>$connect->lastInsertId());
    } else {
      $res= $data->fetchAll(PDO::FETCH_ASSOC); 
    }
 
  } catch (PDOException $e) {
  echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    //include ('includ/NoConnect_view.php'); //отображаем ошибку
  //echo "нет соединения с базой данных, обратитесь в службу подержки\n";
  exit;
  }
  return $res;
}
