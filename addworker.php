<?php
    include 'session.php';
?>

<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add Worker</title>
     <link rel="stylesheet" href="addworker.css"/>
     <style>
    body {
            margin: 0;
            font-family: "Mulish";                      
            background: #FFFBEB;
}
.topnav {
  overflow: hidden;
  background-color: #92400E;
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
        <button type="submit" formaction="worker.php" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;
        cursor:pointer;border-radius:15px; border: 3px solid #FBBF24;background-color:#FBBF24;color:#f2f2f2;font-size:17px;">back</button>
    </form> 

        <div class="container">
           <div class="profile">
                 <div class="img">
                    <img src="wprofile.png"alt="user" width="100" style="display:block; margin-left:200px;border-radius:20px"><br>
                    <hr style="border-top: 3px solid black;"><br>
                   </div>

                <form method ="POST" action="addworker.php"> 
                    
                      <label> ID :</label>
                      <input type="number" required
                      name="wid"><br/>
                    
                      <label> NAME :</label>
                      <input type="text"
                      name ="name" required><br/>
                    
                      <label> Place :</label>
                      <input type="text"
                      name ="place" required><br/>
                    
                      <label> Phone Number :</label>
                      <input type="number"
                      name ="phnum" required><br/>
              
                      <label> Daily wages </label>
                      <input type="number"
                      name ="dailywage" required><br/>
                      
                 <input type="submit" class="sbutton" name="b1" value="SAVE">    
                
                </form>    
       </div>
<?php

include("connect.php");

if(isset($_POST["b1"]))
{

$wid =       $_POST['wid'];
$name =      $_POST['name'];
$place =     $_POST['place'];
$phnum =     $_POST['phnum'];
$dailywage =   $_POST['dailywage'];

$id=$_SESSION["id"];

$Query3="select count(*) from workerprofile WHERE id='$id' and wid='$wid'";               
$Execute1 = mysqli_query($conn,$Query3);
$count1 = mysqli_fetch_row($Execute1);
if($count1[0]==0)
{
$query = "INSERT INTO workerprofile (id,wid, wname,wplace, wphnum,dailywage) 
           VALUES  ('$id','$wid','$name','$place','$phnum','$dailywage')";
    mysqli_query($conn,$query); 
    echo'
        <div>
            <h1 style="color:#6B7280;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;"> New worker worker id: '.$wid.' inserted successfully</h1>
        </div>';
      }
  else{
    echo '<div>
    <h1 style="color:red;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">the worker worker id: '. $wid.' already exists</h1>
       </div>';
}
$conn->close();
}
?>


</body>
</html> 