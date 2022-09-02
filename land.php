<?php
    include 'session.php';
?>

<html>
    <head>
        <title>Land </title>
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

table {
    font-family: "Mulish";
    font-weight:bold;
    border-collapse: collapse;
    outline:#00526c solid 4px;
    background: #b9efff;
    width: 100%;
    margin:5px ;
    
}

td, th {
    border: 1px solid #00526c;
    text-align: left;
    padding: 8px;
}
th{
    background-color:#00769b;
    color: white;
}


.custombutton{
  margin:25px;
  
}input[type=text] {
    width: 20%;
    padding: 12px 20px;
   margin:8px ;
    border: 2px solid red;
    background:transparent;
    color:#000000;        
}    
.btn1{
  font-family: "Mulish";
    display: inline-block;
    outline: none;
    cursor: pointer;
    font-weight: 600;
    border-radius: 3px;
    padding: 12px 24px;
    border: 0;
    color: #fff;
    background: #00526c;
    line-height: 1.15;
    font-size: 16px;
}
    .btn1:hover {
        transition: all .1s ease;
        box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
    }
                
 
           
     

        </style>   
</head>

<body>
<div class="topnav">
            <a class="active" style="align-text:center;" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>         
            <div class="topnav-right">
              <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
            </div>
        </div>


    <div class="custombutton">
          <form>
            <button class="btn1" style="margin-left:30px;"  formaction="add_land.php">Add land</button>
            <button class="btn1"  style="margin-left:800px;" formaction="land_details.php">Land Details</button>
        </form>
    </div>
    <h1 style="margin-left:20px;">Land</h1>

    <?php
   
   include 'connect.php';
        if(!$conn)
        { 
        die("could not connect".mysql_error());
        }
        $id=$_SESSION['id'];
        $var=mysqli_query($conn,"select land_id,name,place,acre from land where id='$id'");    //select l.land_no,l.name,l.place,l.acre from land l login ll where ll.login_id='$login_id'
        echo "<table border size=10>";
        echo "<tr>
        <th>Land_ID</th>
        <th>Land_Name</th>
        <th>Place</th>
        <th>Acre</th>
        </tr>";
        if(mysqli_num_rows($var)>0){
            while($arr=mysqli_fetch_row($var))
            { echo "<tr>                 
            <td>$arr[0]</td>
            <td>$arr[1]</td>
            <td>$arr[2]</td>
            <td>$arr[3]</td>
            </tr>";}
            echo "</table>";
            mysqli_free_result($var);
        }
        
        mysqli_close($conn);
       
       
   ?>


<div class="lastblock" style="margin-top:25px;">
<form action="land.php" method="post">
    <input  id="dbutton"  style="border: 3px solid #009bcb;"type="text" name="t1" placeholder="Enter the land-id to delete" required>
    <input name="b1" class="btn1"type="submit" value="Delete">
</form> 
</div>
<?php

if(isset($_POST["b1"]))
{
        include 'connect.php';

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      $l_id=$_POST["t1"];
      
      $Query2="select count(*) from land where land_id='$l_id' and id='$id'";
      $Execute = mysqli_query($conn,$Query2);
      $count = mysqli_fetch_row($Execute);
      
      
      if($count[0]==1)
      { 
          
          $sql = "DELETE FROM land WHERE land_id='$l_id' and id='$id'";
          if ($conn->query($sql) == TRUE) {
              echo '<div>
          <h1 style="margin-left:20px;color:#34D399;font-family:Mulish;">Data deleted successfully</h1>
             </div>'; 
             $page = $_SERVER['PHP_SELF'];
            $sec = "2";
            header("Refresh: $sec; url=$page");
          }
           else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
      else{
          echo '<div>
          <h1 style="margin-left:20px;color:#DC2626;font-family:Mulish;"> Data not found</h1>
             </div>';
      }
      $conn->close();
}
      ?>

</body>
</html>