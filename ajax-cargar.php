<?php
session_start();
    header('Content-type: application/json; charset=utf-8');
   if(isset($_GET["id"]))
    {   
        try{
            $con = new PDO('mysql:host=localhost;dbname=tastets', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
       
    $sel="SELECT * from tastets where tastets.id=".$_GET["id"].";";
        $res=$con->query($sel);
       
        $dat=$res->fetch();
       $sel2="select dispany.disp from dispany,tastets where dispany.id=tastets.int_dispany and dispany.id=".$dat["int_dispany"].";";
       $res2=$con->query($sel2);
       
       if($res2) $dat["dispany"]=$res2->fetch();
       else $dat["dispany"]["disp"]="";
      
       
      
   echo json_encode($dat);
       
   }
?>