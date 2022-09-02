<?php
    include 'session.php';
?>
<!doctype html>
<html>
    <head>
        <title>loan details </title>

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

table {
    font-family: "Mulish";
    font-weight:bold;
    border-collapse: collapse;
    outline:#484c7a solid 4px;
    background: #d6d6e7;
    width: 100%;
    margin:5px ;
    
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th{
    background-color:#777aaf;
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
    display: inline-block;
    outline: none;
    cursor: pointer;
    font-weight: 600;
    border-radius: 3px;
    padding: 12px 24px;
    border: 0;
    color: #3a4149;
    background: #e7ebee;
    line-height: 1.15;
    font-size: 16px;
    font-family: Mulish;
}        

.btn1:hover {
    transition: all .1s ease;
    box-shadow: 0 0 0 0 #fff, 0 0 0 3px #1de9b6;
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

        <div class="custombutton">         
        <form>
            <button class="btn1" formaction="income.php">Back</button>
           
            <br><br>

            



<?php

  include("connect.php");
  $id=$_SESSION["id"];
  $date=date("Y-m-d");
  $var=mysqli_query($conn,"SELECT distinct wp.wname,w.moneyrec,w.desci FROM workerdailyupdate w,workerprofile wp where wp.wname in (SELECT wname from workerprofile where wid = w.wid) AND w.moneyrec<>0 AND date='$date' and w.id=wp.id and w.id='$id'");
   echo "<table border size=10>"; 
   echo   "<h1>Loan Details (Date: ($date)</h1>"; 
   echo "  
   <tr>
       <th>Name</th>
       <th>Loan Amount</th>      
       <th>Description</th>
   </tr>";
   if(mysqli_num_rows($var)>0){
       while($arr=mysqli_fetch_row($var))
       { echo "
       <tr>
           <td>$arr[0]</td>
           <td>$arr[1]</td>
           <td>$arr[2]</td>
          
    
       </tr>";}
     
       echo "</table>";
       mysqli_free_result($var);
   }

  
   $sql = "select sum(moneyrec) from workerdailyupdate where moneyrec <> 0 and date='$date' and id='$id'";
   $res = mysqli_query($conn,$sql);
   if(mysqli_num_rows($res)>0){
    while($arr=mysqli_fetch_row($res)){
   echo"<h1> Total loan Income = $arr[0]
   </h1>";
    }}
    mysqli_close($conn);
?>

<?php

include("connect.php");
$id=$_SESSION["id"];
$date=date("Y-m-d");
$var=mysqli_query($conn,"SELECT distinct w.date,wp.wname,w.moneyrec,w.desci FROM workerdailyupdate w,workerprofile wp where wp.wname in (SELECT wname from workerprofile where wid = w.wid) AND w.moneyrec<>0 and wp.id=w.id AND w.id='$id'");
 echo "<table border size=10>"; 
 echo   "<h1> All Details </h1>"; 
 echo "  
 <tr>
    <th>Date</th>
     <th>Name</th>
     <th>Loan Amount</th>      
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
  
     </tr>";}
   
     echo "</table>";
     mysqli_free_result($var);
 }


 $sql = "select sum(moneyrec) from workerdailyupdate where moneyrec <> 0 and id='$id'";
 $res = mysqli_query($conn,$sql);
 if(mysqli_num_rows($res)>0){
  while($arr=mysqli_fetch_row($res)){
 echo"<h1> Total = $arr[0]
 </h1>";
  }}
  mysqli_close($conn);
?>
            
        </form>
</div>