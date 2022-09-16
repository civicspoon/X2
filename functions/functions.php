<?php 
    include_once('config.php');
    
    class DB_CON{
        function __construct()
        {
            $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            $this->conn=$connection;
            if($connection->connect_errno){
                echo "Not connect Database";
            }
     

        }
        public function sql($sql){
            $result = mysqli_query($this->conn,$sql);
            return $result;
            }
        
        public function login($uid,$pass){
            $result = mysqli_query($this->conn,"Select * from user where ID = '$uid' AND Password = md5('$pass')");
            return $result;
        
        }

        public function who_is($whoid){
            $result =  mysqli_query($this->conn,"Select * from user where ID = '$whoid'");
            return $result;
        }
    }
?>