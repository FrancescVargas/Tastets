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
       
    $sel="SELECT * from solicituts where tastet_id=".$_GET["id"].";";
        $res=$con->query($sel);
        $dat=$res->fetchAll();
    echo json_encode($dat);
      
       
   }
?>

?>