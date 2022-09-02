<?php
    include 'session.php';
?>

<!doctype html>
<html>
<head>
  <title>land details</title>
  <style>
body {
    margin: 0;
    font-family: "Mulish";                      
    background: #e8faff;
}
.topnav {
  overflow: hidden;
  background-color: #00769b;
  height: 60px;
  width: 95%;
  margin: auto;
  margin-top: 15px;
  border: 1px solid black;
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  border-radius: 8px;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 30px;
  font-weight: bold;
}
.topnav a:hover{
    box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
}

.topnav-right {
  float: right;
}

fieldset { 
    max-width: 450px;
	background: #FAFAFA;
	padding: 30px;
	margin: 50px auto;
	box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, 
    rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
	border-radius: 10px;
	border: 6px solid #00526c;


}

legend {
  padding: 0.2em 0.5em;
  border:2px solid rgba(249, 105, 14, 1);
  color:green;
  font-size:90%;
  text-align:center;
  }
  .btn2{
    width:100%;
    height:40px;
    text-align: center;
    cursor:pointer;
    font-family: Mulish;
    display: inline-block;
  outline: none;
  cursor: pointer;
  font-weight: 600;
  border-radius: 3px;
  padding: 12px 24px;
  border: 0;
  color: #000021;
  background: #89e5ff;
  line-height: 1.15;
  font-size: 16px;
}      

.btn2:hover {
      transition: all .1s ease;
      box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
  }             
  

    </style>
</head>

<div class="topnav">
            <a class="active" style="align-text:center;" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>         
            <div class="topnav-right">
              <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
            </div>
        </div>

        <form>
        <button type="submit" formaction="land.php" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;
        cursor:pointer;border-radius:15px; border: 3px solid #009bcb;background-color:#00526c;color:#f2f2f2;font-size:17px;">back</button>
    </form>  


    <form method="post" action="add_land.php"> 
    <fieldset> 

    <input type="text" name="name" placeholder="Enter land name" style="width:100%;height:30px;
            border: 2px solid #00526c; border-radius:5px;  background:transparent;" required>       

            <br><br>

    <input type="number" name="land_id" placeholder="Enter land id" style="width:100%;height:30px;
            border: 2px solid #00526c; border-radius:5px;  background:transparent;" required>       
            

            <br><br>

    <input type="text" id ="place" name="place" placeholder="Enter the place" style="width:100%; height:30px;
            border: 2px solid #00526c; border-radius:5px;" required>

            <br><br>
            
    <input type="number" id ="acre" name="acre" placeholder="Enter the number of acre" style="width:100%; height:30px;
            border: 2px solid #00526c; border-radius:5px;" required>

            <br><br>

    <input class="btn2" type="submit" name="submit" value="ADD" >&ensp;  

  </fieldset>
</form> 
</body>
</html>


<?php
    if(isset($_POST["submit"]))
    {
    // define variables and set to empty values
    include 'connect.php';
  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $name = $_POST["name"];
    $land_id = $_POST["land_id"];
    $place = $_POST["place"];
    $acre = $_POST["acre"];
    $id=$_SESSION['id'];


  $Query3="select count(*) from land WHERE land_id='$land_id' and id='$id'";               
  $Execute1 = mysqli_query($conn,$Query3);
  $count1 = mysqli_fetch_row($Execute1);
  if($count1[0]==0)
  {  

    $sql = "INSERT INTO land(id,name,land_id,place,acre)
    VALUES ($id,'$name','$land_id','$place','$acre')";
    if ($conn->query($sql) == TRUE) {
    echo'
        <div>
            <h1 style="color:#6B7280;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;"> New record for land_id: '.$land_id.' inserted successfully</h1>
        </div>';
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
  else{
    echo '<div>
    <h1 style="color:red;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">the land_id '. $land_id.' already inserted</h1>
       </div>';
}



    $conn->close();
}

?>