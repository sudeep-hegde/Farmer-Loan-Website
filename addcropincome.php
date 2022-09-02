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


    <form method="post" action="addcropincome.php"> 
    <fieldset> 

    <input type="date" name="date" style="width:100%; height:30px;
            border: 2px solid #9698c3; border-radius:5px;" required>

            <br><br> 
    
<?php
        include 'connect.php';
        $id=$_SESSION['id'];
        $sql = "SELECT * FROM `cropid` where id=$id";
    $all_categories = mysqli_query($conn,$sql);


?>
            <label>Crop Name:</label>
        <select name="c_id" style="width:150px; margin-left:25px;cursor:pointer;border-radius:5px;
        border: 3px solid #3333ff;background-color:#3c4fe0;color:#f2f2f2;font-size:19px;font-family:Mulish">
            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($category = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $category["crop_id"];
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

    <input type="number" step=any id ="income" name="income" placeholder="Enter the crop income (Rs)" style="width:100%; height:30px;
            border: 2px solid #9698c3; border-radius:5px;" required>

            <br><br>

    <input type="text" id ="quantity" name="quantity" placeholder="Enter the quantity sold" style="width:100%; height:30px;
            border: 2px solid #9698c3; border-radius:5px;" required>

            <br><br>

    <input type="text" name="buyer" placeholder="Enter buyer name" style="width:100%;height:30px;
    border: 2px solid #9698c3; border-radius:5px;  background:transparent;" required>

              <br><br>

    <input class="btn2" type="submit" name="submit" value="Add">&ensp;  

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
    $date = $_POST["date"];
    $c_id = $_POST["c_id"];
    // $name = $_POST["name"];
    $income = $_POST["income"];
    $quantity = $_POST["quantity"];
    $buyer = $_POST["buyer"];
    $id=$_SESSION['id'];


    $Query3="select count(*) from crop WHERE date='$date' and id='$id'";
    $Execute1 = mysqli_query($conn,$Query3);
    $count1 = mysqli_fetch_row($Execute1);
    if($count1[0]==0)
    {
      $sql = "INSERT INTO crop(id,date,crop_id,income,quantity,buyer)
      VALUES ('$id','$date','$c_id','$income','$quantity','$buyer')";
      if ($conn->query($sql) == TRUE) {
      echo'
      <div>
          <h1 style="color:#f2f2f2;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">New record for date: '
          .$date.' and crop_id: '.$c_id. ' inserted successfully</h1>
      </div>';
      }
      else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    //update crop income value to income table 
    $date = $_POST["date"];
     $Query2="select count(*) from other WHERE date='$date' and id='$id'";
     $Execute = mysqli_query($conn,$Query2);
     $count = mysqli_fetch_row($Execute);

     if($count[0]==0)
     {
         $sql1 = "INSERT INTO other(id, date)
                 VALUES ('$id','$date')";
         if ($conn->multi_query($sql1) == TRUE) {
                 
         } 
         else{
                 echo "Error: " . $sql1 . "<br>" . $conn->error;
         }
     }
    
    else{
      echo '<div>
      <h1 style="color:red;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">the date: '. $date.' already inserted</h1>
         </div>';

    
    }
    $conn->close();
  }


?>