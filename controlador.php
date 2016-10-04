<?php
require "vendor/autoload.php";


$app=new Slim\App();
$c=$app->getContainer(); 

$c["bd"]=function()  
{
    $pdo=new PDO("mysql:host=localhost;dbname=tastets","root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
    return $pdo;
};


$c["view"]=new \Slim\Views\PhpRenderer("vista/"); 

$app->get("/detallstastet",function($request,$response,$args)  // sacamos el listado de la búsqueda
          {
              $con=$this->bd; 
              $params=$request->getQueryParams();
              $sql="SELECT * from tastets where tastets.id=".$params['id'].";";
              $res1=$con->query($sql);
             
              $datos= $res1->fetch();
              
              
             
              $response=$this->view->render($response,"plantillatastet.php",$datos); 
              return $response;
            
          });


$app->post("/publicoment", function($request,$response,$args)
          {
               try{
                $con = new PDO('mysql:host=localhost;dbname=tastets', "root"); 
            }catch(PDOException $e){
                echo "<div class='error'>".$e->getMessage()."</div>"; 
                die();
            }
            $con=$this->bd;
            $params=$request->getParsedBody();
            
            $sql="insert into solicituts(centre,comentari,email,nom_i_cognoms,tastet_id,telefon) values('${params["centre"]}','${params["comentari"]}','${params["email"]}','${params["nomicognoms"]}','${params["id_tastet"]}','${params["telefon"]}');";
            $res=$con->exec($sql);
              
            return $response->withRedirect('/Francesc/Tastets/controlador.php/detallstastet?id='.$params['id_tastet'].'&inscrit=si');
              
              
          });
          

$app->run();
?>