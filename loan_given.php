
<!doctype html>
<html>
    <head>
        <title>loan Expense </title>

        <style>
    body {
            margin: 0;
            font-family: "Mulish";                      
            background: #ECFDF5;
}
.topnav {
  overflow: hidden;
  background-color: #065F46;
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
    outline:#059669 solid 4px;
    background: #D1FAE5;
    width: 100%;
    margin:5px ;
    
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th{
    background-color:#10B981;
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
  color: #000021;
  background: #1de9b6;
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
            <a class="active" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>    
            <div class="topnav-right">
              <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
            </div>
        </div>
        <div class="custombutton">         
        <form>
            <button class="btn1" formaction="expense.php">Back</button>
            <!-- <button class="btn1"  formaction="addloanacc.php">Add loan</button> -->

           
            <br><br>

            <?php
   
   session_start();

  include("connect.php");
  $id=$_SESSION["id"];
  $date=date("Y-m-d");
  $var=mysqli_query($conn,"SELECT distinct wp.wname,w.moneypaid,w.desci FROM workerdailyupdate w,workerprofile wp where wp.wname in (SELECT wname from workerprofile where wid = w.wid) AND w.moneypaid<>0 and wp.id=w.id and w.id=$id and w.date='$date'");
   echo "<table border size=10>";
   $date=date("Y-m-d");
   echo   "<h1> Date: ($date) </h1>"; 
   echo "
   
   <tr>
       
       <th>NAME</th>
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
   
   $id=$_SESSION["id"];
   $sql = "select sum(moneypaid) from workerdailyupdate where moneypaid<> 0 and id='$id' and date='$date'";
   $res = mysqli_query($conn,$sql);
   if(mysqli_num_rows($res)>0){
    while($arr=mysqli_fetch_row($res)){
   echo"<h1> TOTAL = $arr[0]
   </h1>";
    }}
    echo"<br/>";
    echo"<br/>";
    $var=mysqli_query($conn,"SELECT distinct w.date, wp.wname,w.moneypaid,w.desci FROM workerdailyupdate w,workerprofile wp where wp.wname in (SELECT wname from workerprofile where wid = w.wid) AND w.moneypaid<>0 and wp.id=w.id and w.id='$id'");
    echo "<table border size=10>";
    $date=date("Y-m-d");
    echo   "<h1>All Details</h1>"; 
    echo "    
    <tr>      
        <th>Date</th>
        <th>NAME</th>
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
 
   
    $sql = "select sum(moneypaid) from workerdailyupdate where moneypaid<> 0 and id='$id'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
     while($arr=mysqli_fetch_row($res)){
    echo"<h1>Total Loan = $arr[0]
    </h1>";
     }}



    mysqli_close($conn);
?>



            
        </form>
</div>