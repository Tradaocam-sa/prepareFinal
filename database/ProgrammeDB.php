<?php
require_once "database.php";

class ProgrammeDB 
{
  public function getAllProgrammes($dbo)
  {
    $cmd="select 
    pd.id as pid,
    pd.code as pcode,
    pd.title as ptitle,
    pd.no_of_sem as nos,
    pd.technical_level as tl,
    pd.graduation_level as gl,
    pd.department_id as did,
    dd.title as dtitle,
    dd.code as dcode
      from program_details as pd,
    department_details as dd
    where pd.department_id=dd.id";

  $statement= $dbo->conn->prepare($cmd);
  $statement->execute();
  $rv=$statement->fetchAll(PDO::FETCH_ASSOC);
  return $rv;
  }
  public function createProgramme($dbo,$code, $title, $nos, $gl, $tl, $did){
    $cmd= "insert into program_details
    (title, code, no_of_sem, graduation_level, technical_level, department_id)
    values
    (:title, :code, :no_of_sem, :graduation_level, :technical_level, :department_id)
    ";
    $statement= $dbo->conn->prepare($cmd);
    try{
      $statement->execute([":title"=>$title,
      ":code" => $code,
      ":no_of_sem"=>$nos,
      ":graduation_level"=> $gl,
      ":technical_level"=> $gl,
      ":department_id"=>$did,
    ]);
    return 1;
    }
    catch(Exception $ee){
      return 0;
    }
  
  }

  public function getProgramDetailsByCode($dbo, $code){
    $cmd= "select
    pd.id as pid,
    pd.code as pcode,
    pd.title as ptitle,
    pd.no_of_sem as nos,
    pd.technical_level as tl,
    pd.graduation_level as gl,
    dd.title as dtitle,
    dd.code as dcode
       from program_details as pd,
    department_details as dd
    where pd.department_id=dd.id
    and pd.code=:code";

    $statement= $dbo->conn->prepare($cmd);
    $statement->execute([":code"=>$code]); 
    $rv=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $rv;
  }

  public function getProgramDetailsById($dbo, $id)
  {
    $cmd= "select
    pd.id as pid,
    pd.code as pcode,
    pd.title as ptitle,
    pd.no_of_sem as nos,
    pd.technical_level as tl,
    pd.graduation_level as gl,
    dd.title as dtitle,
    dd.code as dcode
      from program_details as pd,
    department_details as dd
    where pd.department_id=dd.id
    and
    pd.id=:id 
    ";

    $statement = $dbo->conn->prepare($cmd);
    $statement->execute([":id"=>$id]);
    $rv = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rv;
  }

  public function updateProgramDetails($dbo, $pid, $title, $code, $nos, $gl, $tl, $did)
  {
    $cmd= "update program_details
    set code = :code,
    title =:title,
    no_of_sem = :no_of_sem,
    graduation_level=:graduation_level,
    technical_level=:technical_level,
    department_id =:department_id

    where id=:id
    ";
    $statement= $dbo->conn->prepare($cmd);
    try {
    $statement->execute([
      ":code" => $code,
      ":department_id" => $did,
      ":title" => $title,
      ":no_of_sem"=>$nos,
      ":graduation_level" => $gl,
      ":technical_level" => $tl,
      ":id" => $pid
    ]);
    return 1;
  }
  catch(Exception $ee)
  {
    return 0;
  }
  }
}
?>
