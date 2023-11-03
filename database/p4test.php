<?php
require_once "database.php";
require_once "ProgrammeDB.php";

$dbo = new DataBase();
$pdo = new ProgrammeDB();

$rv= $pdo->getProgramDetailsById($dbo, 8);
print_r($rv);

$rv = $pdo->updateProgramDetails($dbo,8,"its a cat", "FFF", 34, "x", "y", 6);
print_r($rv); 


$rv= $pdo->getProgramDetailsById($dbo, 8);
print_r($rv);

// $rv = $pdo->getAllProgrammes($dbo);
// print_r($rv);
// echo("<br>");

// $rv=$pdo->createProgramme($dbo, "ECE", "Btech in electronic",8, "UG", "Btech", 6 );
// echo($rv);
// echo("<br>");

// $rv=$pdo->getAllProgrammes($dbo);
// print_r($rv);
?>