<?php
    include_once('config.php');
    if(isset($_POST['id'])){
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    $itemlist =  $con->query("SELECT * FROM item WHERE Type_ID = ".$_POST['id']);
    if ($itemlist->num_rows > 0) {  //WHERE Type_ID = '$_POST[typeid]'
        // output data of each row
        echo ("<select name='item' class='form-control'>
        <option selected disable>กรุณาเลือก</option> ");
        while($row = $itemlist->fetch_assoc()) {
          echo "<option value ='" . $row["ID"]. "'>" . $row["Item"]."</option>";
        }
        echo "</select>";
      }
 
      mysqli_close($con);  
     }
?>