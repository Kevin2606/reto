<?php
header("Access-Control-Allow-Origin: *");
require "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../")->load();
$router = new \Bramus\Router\Router();
$credenciales = new App\connect;

$router->get('/', function() {
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('SELECT * FROM campers');
    $res -> execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});
$router->post("/", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    var_dump($_DATA);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("INSERT INTO campers (nombreCamper, apellidoCamper, fechaNac, idReg) VALUES (:NOMBRE, :APELLIDO, :FECHANAC, :IDREG);");
    $res->bindParam("NOMBRE", $_DATA['nombreCamper']);
    $res->bindParam("APELLIDO", $_DATA['apellidoCamper']);
    $res->bindParam("FECHANAC", $_DATA['fechaNac']);
    $res->bindParam("IDREG", $_DATA['idReg']);
    $res->execute();
    $res = $res->rowCount();
    print_r($res);
    //echo json_encode($res);
});
$router->put('/', function() {
    $_DATA = json_decode(file_get_contents('php://input'),true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare('UPDATE campers SET nombreCamper = :NOMBRE, apellidoCamper = :APELLIDO, fechaNac =:FECHANAC, idReg=:IDREG  WHERE idCamper=:ID');
    $res->bindvalue("ID", $_DATA['idCamper']);
    $res->bindvalue("NOMBRE", $_DATA['nombreCamper']);
    $res->bindvalue("APELLIDO", $_DATA['apellidoCamper']);
    $res->bindvalue("FECHANAC", $_DATA['fechaNac']);
    $res->bindvalue("IDREG", $_DATA['idReg']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});
$router->delete("/", function(){
    $_DATA = json_decode(file_get_contents("php://input"), true);
    global $credenciales;
    $conn = $credenciales->getConnection();
    $res = $conn->prepare("DELETE FROM campers WHERE idCamper = :ID");
    $res->bindParam("ID", $_DATA['idCamper']);
    $res->execute();
    $res = $res->rowCount();
    echo json_encode($res);
});

$router -> run();


?>