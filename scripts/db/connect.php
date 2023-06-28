<?php
    namespace App;

    use PDO;
    use PDOException;

    class connect{
        private $conn;
        public function __construct(private $dsn = "mysql", private $port = 3306) {
            try {
                $this->conn = new \PDO($_ENV["DNS"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USER"].";password=".$_ENV["PASSWORD"].";port=".$_ENV["PORT"]);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }
/*
    namespace App;
    class connect{
        public $con;
        function __construct(){
            try {
                $this->con = new \PDO($_ENV["DNS"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USER"].";password=".$_ENV["PASSWORD"].";port=".$_ENV["PORT"]);
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo  $e->getMessage();
            }
        }
    }
*/
?>