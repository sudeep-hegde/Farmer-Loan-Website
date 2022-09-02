<?php
    include 'session.php';
?>
<!doctype html>
<html>
    <head>
        <title>Income/Expense</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
        margin: 0;
        font-family: "Mulish";                      
        background: #fff5f5
}
.topnav {
  overflow: hidden;
  background-color: #ba0202;
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

.screen
{
    /* background-size:contain;
    width:100%;
    height:auto; */
    max-width: 600px;
	background: #FAFAFA;
	padding: 30px;
  margin-bottom:10px;
	margin: 50px auto;
	box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, 
    rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
	border-radius: 10px;
	border: 6px solid #00526c;
     
} 
.btn2 {
    background-color: #F87171; 
    color: black; 
    border-radius: 5px;
    /* display: block; margin-right: auto; margin-left: auto; */
    /* border: 3px solid #F87171; */
}
    
.btn2:hover {
      transition: all .1s ease;
      box-shadow: 0 0 0 0 #fff, 0 0 0 3px #F87171;
  }

  label {
    text-align: center;
    line-height: 150%;
    font-size: 1.3em;
}

.tt{
  display: block; margin-right: auto; margin-left: auto;
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
        <input type="button" onclick="history.back();" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;cursor:pointer;border-radius:15px;
        border: 3px solid #DC2626;background-color:#F87171;color:#f2f2f2;font-size:19px;font-family:Mulish;" value="Back">
    </form>

       
    <div class="screen">
      <!-- <div class="screen"> -->
         <h1>Income/Expense-</h1> 
         <form method="post" action="details.php">
          <input type="number" step=any placeholder="Enter year"  name="yr" style="width:20%;height:30px;
             border: 2px solid #10B981; border-radius:5px;" required>


          <input class="btn2" type="submit"  name="submit" value="Show"   >&ensp;
         </form> 
         <br/>
    <div class="tt">     
    <?php
    

    if(isset($_POST["submit"]))
    { 
      include 'connect.php';
        if(!$conn)
        { 
        die("could not connect".mysql_error());
        }
        $yr= $_POST["yr"];
        $date1= $yr.'-01-01';
        $date2= $yr.'-12-31';
        $id=$_SESSION['id'];

        $var=mysqli_query($conn,"select SUM(total_inc) from income where id=$id and date between '$date1' and '$date2'");
        echo "<label>Total income:  </label>";
        if(mysqli_num_rows($var)>0){
          $arr=mysqli_fetch_row($var);
            echo "<label>$arr[0]</label>";
        }
        echo '</br>';

        $var=mysqli_query($conn,"select SUM(total) from expense where id=$id and date between '$date1' and '$date2'");
        echo "<label>Total expense:  </label>";
        if(mysqli_num_rows($var)>0){
          $arr=mysqli_fetch_row($var);
            echo"<label>$arr[0]</label>";
        }
        mysqli_close($conn);
    }
    ?>
    </div>
    <!-- </div> -->
    <hr/>
    
    <div class="screen">                                        
         <h1>Land- (Date <?php echo date('d/m/Y');?>):  </h1> 
         <?php
          include 'connect.php';
          if(!$conn)
          { 
            die("could not connect".mysql_error());
          }
          $id=$_SESSION['id'];
          $date=date("Y-m-d");
          $var=mysqli_query($conn,"select distinct ll.name,l.land_id,l.crop from land_details l, land ll where l.date='$date' and ll.id=l.id and l.id=$id and ll.name in (select name from land where land_id=l.land_id)");

          if(mysqli_num_rows($var)==0){
              echo"<label>No data  </label>";
              echo '</br>';
            }
            
          
          if(mysqli_num_rows($var)>0){
            while($arr=mysqli_fetch_row($var)){
              echo"<label>Land Name:  </label>";
              echo "<label>$arr[0]</label>";
              echo '</br>';
              echo"<label>Land Id:  </label>";
              echo "<label>$arr[1]</label>";
              echo '</br>';
              echo"<label>Crop :  </label>";
              echo "<label>$arr[2]</label>";
              echo '</br>';
              echo '</br>';
            }
            
          }
        mysqli_close($conn);
    ?>
    </div>


    <div class="screen">                                        
         <h1>Workers- (Date <?php echo date('d/m/Y');?>):  </h1> 
         <?php
          include 'connect.php';
          if(!$conn)
          { 
            die("could not connect".mysql_error());
          }
          $id=$_SESSION['id'];
          $date=date("Y-m-d");
          $var=mysqli_query($conn,"select count(*) from workerdailyupdate where date='$date' and attd=1 and id='$id'");    //select count(*) from dailyworkerupdate where date='$date' and attd=1

          if(mysqli_num_rows($var)==0){
              echo"<label>Number of Workers: </label>";
              echo '<br/>';
            }
            
          
          if(mysqli_num_rows($var)>0){
            while($arr=mysqli_fetch_row($var)){
              echo"<label>Number of Workers:  </label>";
              echo "<label>$arr[0]</label>";
              echo '</br>';
            }
           
          }
        mysqli_close($conn);
    ?>
    </div>
  </div>
    </body>
   
</html>



