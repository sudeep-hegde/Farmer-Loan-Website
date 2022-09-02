<?php
    include 'session.php';
?>

<!doctype html>
<html>
<head>
  <title>crop details</title>
  <style>
body {
    margin: 0;
    font-family: "Mulish";                      
    background: #b6b7d5;
}
.topnav {
  overflow: hidden;
  background-color: #141d61;
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
	border: 6px solid #5a5e9a;


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
    display: inline-block;
    outline: none;
    cursor: pointer;
    font-weight: 600;
    border-radius: 7px;
    padding: 12px 24px;
    border: 0;
    color: white;
    background: #1e2b8f;
    line-height: 1.15;
    font-size: 16px;
    font-family: Mulish;
}        

.btn2:hover {
    transition: all .1s ease;
    box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
}          

.name option {
    background: rgba(0,0,0,0.3);
    color:red;
}

    </style>
</head>

<body>
<div class="topnav">
            <a class="active" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>    
            <div class="topnav-right">
              <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
            </div>
        </div>

    <form>
        <button type="submit" formaction="crop.php" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;cursor:pointer;border-radius:15px;
        border: 3px solid #3333ff;background-color:#2b3cbb;color:#f2f2f2;font-size:19px;font-family:Mulish">back</button>
    </form>  


    <form method="post" action="cropdetails.php"> 
    <fieldset> 

    <input type="number" name="crop_id" placeholder="Enter the crop Id" style="width:100%; height:30px;
            border: 2px solid #9698c3; border-radius:5px;" required>

            <br><br> 
    <input type="text" id ="crop" name="crop" placeholder="Enter the crop" style="width:100%; height:30px;
            border: 2px solid #9698c3; border-radius:5px;" required>

            <br><br>

    <input class="btn2" type="submit" name="submit" value="ADD">&ensp;  

  </fieldset>
</form> 
</body>
</html>

<?php
    if(isset($_POST["submit"]))
  {
    // define variables and set to empty values
    include 'connect.php';
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo "  CONNECTION ESTABLISHED \r\n";
    //echo "  INSERTION IN PROCESS";
    $crop_id = $_POST["crop_id"];
    $crop = $_POST["crop"];
    $id=$_SESSION['id'];


    $Query3="select count(*) from cropid WHERE crop_id='$crop_id' and id='$id'";
    $Execute1 = mysqli_query($conn,$Query3);
    $count1 = mysqli_fetch_row($Execute1);
    if($count1[0]==0)
    {
      $sql = "INSERT INTO cropid(id,crop_id,crop)
      VALUES ('$id','$crop_id','$crop')";
      if ($conn->query($sql) == TRUE) {
      echo'
      <div>
          <h1 style="color:#f2f2f2;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">New record for crop: '
          .$crop.' inserted successfully</h1>
      </div>';
      }
      else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    else{
      echo '<div>
      <h1 style="color:red;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">the crop: '. $crop.' already exist</h1>
         </div>';
    }
    $conn->close();
  }


?>