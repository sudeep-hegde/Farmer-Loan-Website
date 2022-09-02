<?php
    include 'session.php';
?>

<?php

  include("connect.php");
  $_SESSION['wid']=$_GET['wid'];
  
  if (isset ($name)||isset ($place)||isset ($phnum)||isset ($workingdays)|| isset($dailywage)||isset ($loanr)||isset ($loanpaid)||isset ($salary)||isset ($tamt))
  {
  $name =      $_POST["name"];
  $place =     $_POST["place"];
  $phnum =     $_POST["phnum"];
  $workingdays =  $_POST["workingdays"];
  $dailywage =   $_POST["dailywage"];
  $loanr=      $_POST["loanr"];
  $loanpaid=   $_POST["loanpaid"];
  $salary=    $_POST["salary"];
  $tamt=      $_POST["tamt"];

    
  }
 
?>



<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>View Worker Profile</title>
     <link rel="stylesheet" href="vworkerprofile.css"/>
 </head>
 <body>

<div class="container">
          <div class="topnav">
                  <a class="active" style="align-text:center;" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>         
                  <div class="topnav-right">
                    <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
                  </div>
              </div>
      <div class="row">


            <div class="profile">
              <img src="wprofile.png"alt="user" width="100"><br><br><br>
                  <?php
                 $id=$_SESSION["id"];
              $sql = "SELECT * from  workerprofile where wid=' ".$_GET["wid"]. "' and id='$id'";
                      $result = mysqli_query($conn,$sql);
                      $resultCheck = mysqli_num_rows($result);

                      if($resultCheck > 0) {
                          while ( $row = mysqli_fetch_assoc($result)) { 
                ?>
                    <br> 
                <label> ID:</label>

                <label>
                          <?php
              
                          echo $row['wid'];
                          ?><br><br>
                </label>
              
                <label> NAME :</label>
                <label>
                    <?php

                      echo $row['wname'];
                      
                        ?><br><br>
                </label>
              
                <label> Place :</label>

              <label>
                      <?php
              
                      echo $row['wplace'];
                      ?><br><br>
              </label>
                <label> Phone number :</label>
              <label>
                      <?php
                    echo $row['wphnum'];
                                  
                      ?><br><br>
              </label>
            </div>

            <div class="info">
              <h1>   INFORMATION         </h1><br>
              <br>    <br>    <br>    <br>    <br>    <br>
              
                      <label> Total number of working days
                      <?php
                    echo $row['noworkingdays'];
                                  
                      ?><br><br>
                          
                      </label>
                <br><br>
            
                <label> Daily wages :</label>
                  <label>
              
              
                  <?php
              
                  echo $row['dailywage'];
                  ?><br><br>
                  </label>  
          
                  <label>Loan taken:</label>
              
                  <label>
                    <?php
              
                        echo $row['loanr'];
                  ?><br><br>

                  </label>
              
                <label>Loan paid :</label>
                
                    <label>
                        <?php
                      
                      echo $row['loanpaid'];
                  ?><br><br>
                    </label>
                      
                        <label> Salary : </label>
                      
                      <label>
                        <?php
                        
                        $sql =  "select (dailywage*noworkingdays)from workerprofile where  wid=' ".$_GET["wid"]. "' and id='$id'";
                        $res = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                        while($arr=mysqli_fetch_row($res)){
                          
                          echo $arr[0];
                      
                        
                        }}
                  ?> 
                  <br><br>
                      </label>
                    
                        <label> Total Amount : </label>
                        <label>
                        <?php 
                        $sql =  "select (dailywage*noworkingdays)+loanpaid-loanr from workerprofile where  wid=' ".$_GET["wid"]. "' and id='$id';";  //select salary-loanr-loanpaid from workerprofile where  wid=' ".$_GET["wid"]. "' and id='$id'
                        $res = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                        while($arr=mysqli_fetch_row($res)){
                        echo  $arr[0];
                        }};
                                  }
                                  } ?><br><br><br>

                        </label>
              </div>   
        </div>
         
          <br>
              <form method="post" action="worker.php" >
              <button class="sbutton">SUBMIT</button>
              </form>
              <form>
            <button formaction="profildel.php" class="dbutton">Delete</button>
          </form>
              <br/>
              <br/>
             <h1 style="color:#D97706;font-size:40px;margin-left:40px;" >All Details</h1>                       
          <div class="table">
          <?php
            $var=mysqli_query($conn,"select date,workat,moneypaid,moneyrec,desci from workerdailyupdate where wid=' ".$_GET["wid"]. "'and attd=1 and id='$id';");
            echo "<table border size=10>";
          
            echo "
            
            <tr>
                
                <th>DATE</th>
                <th>WORKER AT</th>
                <th>MONEY TAKEN</th>
                <th>MONEY GIVEN </th>
                <th>Description</th>
            </tr>";
            if(mysqli_num_rows($var)>0){
                while($arr=mysqli_fetch_row($var))
                { echo "
                <tr>
                    <td>$arr[0]</td>
                    <td>$arr[1]</td>
                    <td>$arr[2]</td>
                    <td>$arr[3]</td>
                    <td>$arr[4]</td>
                    
            
                </tr>";}
              
                mysqli_free_result($var);
            }
          
          ?> 
            
          </div>
            
  </div>

</body>
<br/>
  <br/>
</html> 