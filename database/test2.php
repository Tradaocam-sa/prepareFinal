<?php 
require_once "database.php";
//create a connection
$dbo = new DataBase();

$t='Department of Electronics';
$code='ESC';
$cmd="insert into department_details (title,code) values(:title, :code )";
$stmnt = $dbo->conn->prepare($cmd);
try{
  $stmnt->execute([":title"=>$t, ":codex"=> $code]);
}

catch(exception $ee)
{
  echo ($ee->getMessage()."<br>");
}



$cmd = "select * from department_details";
$statement = $dbo->conn -> prepare($cmd);
$statement -> execute();

$rv = $statement->fetchAll(PDO::FETCH_ASSOC);
print_r($rv);
?>