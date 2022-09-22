<?php 
    include_once('config.php');
    
    class DB_CON{
        function __construct(){
            $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            $this->conn=$connection;
            if($connection->connect_errno){
                echo "Not connect Database";
            }
     

        }

        public function page($pid){
            $pages = mysqli_query($this->conn,"SELECT * FROM `page` WHERE ID = '$pid'");
            return $pages;
                }

        public function login($uid,$pass){
            $result = mysqli_query($this->conn,"Select * from user where ID = '$uid' AND Password = md5('$pass')");
            return $result;
                }

        public function who_is($whoid){
            $result =  mysqli_query($this->conn,"Select * from user where ID = '$whoid'");
            return $result;
        }

        public function type_list(){
            $typlist = mysqli_query($this->conn,"SELECT * FROM `type`");
            return $typlist;
        }

        public function insert_image($img,$ans){
            $insertimage = mysqli_query($this->conn,"INSERT INTO `xrayimage`(`IMG`, `Item_ID`) VALUES ('$img','$ans')");
            return $insertimage;
        }
     
}


?>