<?php
namespace App;
class administrador extends connect {
    public $_DATA;
    function __construct(){
        parent::__construct();
        $this->_DATA =(file_get_contents('php://input')=="") ? ["Mensaje"=>"Envien datos"] : json_decode(file_get_contents('php://input',true));
    }
    public function getAll(){
        $res = $this->con->prepare("SELECT * FROM campers");
        res->execute();
        $res->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($res);
    }
}


?>