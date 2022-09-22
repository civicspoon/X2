<?php 
    include_once('functions/functions.php');
?>
<form method="POST" enctype="multipart/form-data">
<div class="row shadow p-3">
    <div class="col-md-6 ">
        <div class="header">
            <h4>ภาพที่ 1</h4>
        </div>
            <input type="file" name="img1" id="img1" class="form-control" accept="image/*" onchange="showPreview1(event)">
        <div class="col-md-12 card">
        <div class="text-center">
        <img src="img/imgplaceholder.png" height="300px" id="prev1" class="rounded gray-300">
        </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="header"><h4>ภาพที่ 2</h4></div>
        <input type="file" name="img2" id="img2" class="form-control"  accept="image/*" onchange="showPreview2(event)">
        <div class="text-center">
             <img src="img/imgplaceholder.png" height="300px" id="prev2"  class="rounded gray-300">
        </div>
        </div>
   
</div>
<div class="row">
    <div class="col-md-6 card">
        <select  name="type" id="type" class="form form-control" onchange="listt()">
            <option disabled selected>ประเภทวัตถุ</option>
           
        <?php 
            $type_list = $con->type_list();
           
            if ($type_list->num_rows > 0) {
                // output data of each row
                while($row = $type_list->fetch_assoc()) {
                  echo "<option value ='" . $row["ID"]. "'>" . $row["Type"]."</option>";
                }
              } else {
                echo "0 results";
              }
            
            ?>
            </select> 
    </div>
    <div class="col-md-6 card">
               <span id="optitem"></span>
     </div>
</div>
    <div class="row p-2">
        <div class="col-md-12">
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="upload" value="บันทึก">
        </div>
    </div>

</form>
<div class="row p-2">
    <button data-toggle="modal" data-target="#staticBackdrop" class="btn btn-dark">เพิ่มชนิด Item</button>
</div>

<div class="modal bg-register-image fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id ="staticBackdropLabel">เพิ่มชนิด Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
      <select  name="type" id="type" class="form form-control">
            <option disabled selected>กรุณาเลือกประเภทวัตถุ</option>
           
        <?php 
            $type_list = $con->type_list();
           
            if ($type_list->num_rows > 0) {
                // output data of each row
                while($row = $type_list->fetch_assoc()) {
                  echo "<option value ='" . $row["ID"]. "'>" . $row["Type"]."</option>";
                }
              } else {
                echo "0 results";
              }
            
            ?>
            </select> 
            <label for="basic-url" class="form-label">กรอก Item ที่ต้องการเพิ่ม</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">เพิ่มรายการ Item</span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>

            <input class="btn btn-primary btn-block" type="submit" href="#" role="button">
        </form>
      </div>
       
    </div>
  </div>
</div>


<script>
    function listt(){
        var id=document.getElementById('type').value;
        $.post("functions/itemlist.php",{
            id:id
        },function(result){
    document.getElementById('optitem').innerHTML=result;
         });
    }

    function showPreview1(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("prev1");
    preview.src = src;
    preview.style.display = "block";
  }
}

function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("prev2");
    preview.src = src;
    preview.style.display = "block";
  }
}
</script>

<?php 
  if(isset($_POST['upload']))
  {
    if(isset($_FILES["img1"]["tmp_name"])){
     
        if(move_uploaded_file($_FILES["img1"]["tmp_name"],"xsim_img/".$_FILES["img1"]["name"]))
          {
            $img = array($_FILES["img1"]["name"]);
          }
    }
    if(isset($_FILES["img2"]["tmp_name"])){
      $file1 = $_FILES["img2"]["name"];
        if(move_uploaded_file($_FILES["img2"]["tmp_name"],"xsim_img/".$_FILES["img1"]["name"]))
          {
              array_push($img,$_FILES["img2"]["name"]);
          }
          $insertimg = $con->insert_image($img,$_POST['item']);


    }
  }
 

		// //*** Insert Record ***//
		// $objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database");
		// $objDB = mysql_select_db("mydatabase");
		// $strSQL = "INSERT INTO files ";
		// $strSQL .="(FilesName) VALUES ('".$_FILES["filUpload"]["name"]."')";
		// $objQuery = mysql_query($strSQL);		

?>