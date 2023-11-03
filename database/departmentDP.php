<?php
require_once "database.php";
class DepartmentDB
{
  public function getAllDepartments($dbo)
  {
    $cmd = "select
    dd.id as did,
    dd.title as dtitle,
    dd.code as dcode
      from
    department_details as dd 
    ";

    $statement = $dbo->conn->prepare($cmd);
    $statement->execute();
    $rv = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rv;
  }
}