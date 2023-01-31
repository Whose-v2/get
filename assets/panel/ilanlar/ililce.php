<?php
class db{
    protected static $db;

    public function __construct(){
        try{
            self::$db = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
            self::$db->exec("SET NAMES utf8");
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception)
        {
            print $exception->getMessage();
        }
    }

    public function getIlList(){
        $data=array();
        $query = self::$db->query("SELECT DISTINCT il from ilveilce", PDO::FETCH_ASSOC);
        if($query->rowCount())
        {
            foreach ($query as $row)
            {
                $data[]=$row["il"];
            }
        }
        echo json_encode($data);
    }

    public function getIlceList($il){
        $data=array();
        $query = self::$db->prepare("SELECT DISTINCT ilce FROM ilveilce WHERE il=:il");
        $query->execute(array(":il"=>$il));
        if($query->rowCount())
        {
            foreach ($query as $row)
            {
                $data[]=$row["ilce"];
            }
        }
        echo json_encode($data);
    }
}

$getir = @$_POST["action"];

switch ($getir){
    case "il":
        $db=new db();
        return $db->getIlList();
        break;

    case "ilce":
        $db=new db();
        $il=$_POST["name"];
        return $db->getIlceList($il);
        break;
}
?>