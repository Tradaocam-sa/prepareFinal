<?php
require_once "database.php";
//create an object to make a connection to 
$dbo = new DataBase();
//how to execute sql commands
//a. write the string version of the command
$cmd = "select * from program_details";
//b.create a prepared statement
$statement = $dbo->conn->prepare($cmd);
//c.execute the prepared statement
$statement->execute();
//d.view the result
$rv=$statement->fetchAll(PDO::FETCH_ASSOC);
//e.display the result
print_r($rv);
?>