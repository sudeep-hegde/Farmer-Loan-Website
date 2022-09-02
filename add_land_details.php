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
        <button type="submit" formaction="land_details.php" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;
        cursor:pointer;border-radius:15px; border: 3px solid #009bcb;background-color:#00526c;color:#f2f2f2;font-size:17px;">back</button>
    </form>  


    <form method="post" action="add_land_details.php"> 
    <fieldset> 

    <input type="date" name="date" style="width:100%; height:30px;
            border: 2px solid #00526c; border-radius:5px;" value="<?php echo date('Y-m-d');?>" disabled>

            <br><br>

    <!-- <input type="text" name="land_id" placeholder="Enter land id" style="width:100%;height:30px;
            border: 2px solid #00526c; border-radius:5px;  background:transparent;" required>        -->

            <?php
        include 'connect.php';
        $id=$_SESSION['id'];
        $sql = "SELECT * FROM `land` where id=$id";
    $all_categories = mysqli_query($conn,$sql);


?>
            <label>Land: </label>
        <select name="land_id" style="width:150px; margin-left:66px;cursor:pointer;border-radius:5px;
        border: 3px solid #3333ff;background-color:#3c4fe0;color:#f2f2f2;font-size:19px;font-family:Mulish">
            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($category = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $category["land_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $category["name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>

            <br><br>

    <!-- <input type="text" name="crop" placeholder="Enter crop name planted in land" style="width:100%;height:30px;
            border: 2px solid #00526c; border-radius:5px;  background:transparent;" required> -->

            <?php
        include 'connect.php';
        $id=$_SESSION['id'];
        $sql = "SELECT * FROM `cropid` where id=$id";
    $all_categories = mysqli_query($conn,$sql);


?>
            <label>Crop Name:</label>
        <select name="crop" style="width:150px; margin-left:25px;cursor:pointer;border-radius:5px;
        border: 3px solid #3333ff;background-color:#3c4fe0;color:#f2f2f2;font-size:19px;font-family:Mulish">
            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($category = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $category["crop"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $category["crop"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>

                   

            <br><br>

    <input type="number"  step=any name="no_workers" placeholder="Enter the number of workers" style="width:100%;height:30px;
            border: 2px solid #00526c;border-radius:5px; " required>
            
            <br><br>    


    <!-- <input type="text" id ="fertilizers" name="fertilizers" placeholder="Enter the fertilizers used" style="width:100%; height:30px; -->
    <!-- border: 2px solid #00526c; border-radius:5px;" required> -->


    <label style="color:#6B7280F;" for="fertilizer">fertilizer: </label>
            <select style="color:#6B7280;width:100%; height:30px;border: 2px solid #00526c; border-radius:5px;" name="fertilizer" id="fertilizer">
            <option value="no">No</option>
              <option value="yes">Yes</option>
              </select>


            <br><br>

            <input type="text" id ="fertilizers_name" name="fertilizers_name" placeholder="Enter the fertilizers used" style="width:100%; height:30px; -->
             border: 2px solid #00526c; border-radius:5px;" required>


            <br><br>

            <label style="color:#6B7280F;" for="irrigation">Irrigation: </label>
            <select style="color:#6B7280;width:100%; height:30px;border: 2px solid #00526c; border-radius:5px;" name="irrigation" id="irrigation">
            <option value="no">No</option>
              <option value="yes">Yes</option>
              </select>


            <br><br>

    <input type="text" id ="todo" name="todo" placeholder="Enter to do" style="width:100%; height:30px;
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

    $date = date("Y-m-d");
    $land_id = $_POST["land_id"];
    $crop = $_POST["crop"];
    $no_workers = $_POST["no_workers"];
    $fertilizer = $_POST["fertilizer"];
    $fertilizer_name = $_POST["fertilizers_name"];
    $irrigation = $_POST["irrigation"];
    $todo= $_POST["todo"];

    
    $id=$_SESSION['id'];


  $Query3="select count(*) from land_details WHERE land_id='$land_id' and date='$date' and id='$id'";               
  $Execute1 = mysqli_query($conn,$Query3);
  $count1 = mysqli_fetch_row($Execute1);
  if($count1[0]==0)
  {  

    $sql = "INSERT INTO land_details(id,date,land_id,crop,no_workers,fertilizers,fertilizer_name,irrigation,to_do)
    VALUES ('$id','$date','$land_id','$crop','$no_workers','$fertilizer','$fertilizer_name','$irrigation','$todo')";
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