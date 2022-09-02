<?php
    include 'session.php';
?>

<html>
    <head>

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
</style>

<body>
    <div class="topnav">
    <a class="active" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>             
        <div class="topnav-right">
          <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
        </div>
    </div>
    <form>
        <button type="submit" formaction="worker.php" style="margin-top:50px;margin-left:60px;height: 30px;width: 100px;
        cursor:pointer;border-radius:15px; border: 3px solid #009bcb;background-color:#00526c;color:#f2f2f2;font-size:17px;">back</button>
    </form>
    <h1 style="margin-left:40px; color:#ee243c">Worker Profile Deleted</h1>

    
    <?php

include("connect.php");
    $id=$_SESSION['id'];
    $wid=$_SESSION['wid'];
 
    $sql = "DELETE FROM workerprofile WHERE wid='$wid' and id='$id'";
          if ($conn->query($sql) == TRUE) {
          }  
      
      $conn->close();

      ?>

</body>
</html>