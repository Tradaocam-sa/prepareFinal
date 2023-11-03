<?php 
$root = $_SERVER["DOCUMENT_ROOT"];
include_once $root."/sms/database/database.php";
include_once $root."/sms/database/ProgrammeDB.php";
include_once $root."/sms/database/departmentDP.php";

$action=$_POST["action1"];

if($action=="getProgramDetails")
{
  $dbo = new DataBase();
  $pdo = new ProgrammeDB() ;

  $result = $pdo->getAllProgrammes($dbo);

  $rv=json_encode($result);
  echo($rv);
  exit();
}

if($action== "getDepartmentDetails"){
  $dbo=new DataBase();
  $ddo=new DepartmentDB();
  $result=$ddo->getAllDepartments($dbo);
  $rv=json_encode($result);
  echo $rv;
  exit();
}

      // code:code,
      // title:title,
      // nob:nob,
      // department:department,
      // techLevel:techLevel,
      // gradLevel:gradLevel,
if($action== "saveData")
{
  $code=$_POST['code'];
  $title=$_POST['title'];
  $nos=$_POST['nos'];
  $department=$_POST['department'];
  $techLevel=$_POST['techLevel'];
  $gradLevel=$_POST['gradLevel'];

  $dbo=new DataBase();
  $pdo = new ProgrammeDB() ;
  $rv=$pdo->createProgramme($dbo, $code, $title, $nos, $gl, $tl, $department );
  echo json_encode($rv);
  exit();
}
?>