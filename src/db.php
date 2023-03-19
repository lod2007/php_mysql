<?php

function execc($SQL,$params) {
  try {
 
  $connect = new PDO('mysql:host=192.168.0.30:3307;dbname=test; charset: utf8', 'admin', '123456');
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
