<?php
    include 'session.php';
?>


<?php

 $_SESSION['user']="rocky";
 
 if(true)                         //isset($_SESSION['user'])
 {

 }
 else{
  echo"<script>location.href='login.html'</script>";
 }
?>

<html>
    <head>
        <title>Expense </title>
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
  h1{
    margin-left:20px;
}
                
     

        </style>   
</head>

<body>
<div class="topnav">
            <a class="active" style="align-text:center;" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"></a>    
                                                               
             <a href="details.php" style="align-item:center;"><img style="width: 45px;height:35px;border-radius:10px;" src="exp1.png"> Income/Expense</a>         


            <div class="topnav-right">
              <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
            </div>
        </div>


    <div class="custombutton">
          <form>
            <!-- <button class="btn1"  formaction="update_expense.php">Update Expense</button> -->
            <button class="btn1"  style="margin-left:1100px;" formaction="loan_given.php">Loan given</button>
            <button class="btn1"   formaction="other_expense.php">Other Expense</button>
        </form>
    </div>
    <h1>Expense (Date: <?php echo date('d/m/Y');?>):</h1>

    <?php
   
        include 'connect.php';
        if(!$conn)
        { 
        die("could not connect".mysql_error());
        }
        $id=$_SESSION["id"];
        $date=date("Y-m-d");
        $var=mysqli_query($conn,"select e.date,sum(l.moneypaid),o.amount,e.total from expense e 
                        inner join other_expense o on e.date=o.date and o.id=$id inner join workerdailyupdate l on l.date=e.date and l.id=$id
                        where e.date='$date' and e.id=$id");
        echo "<table border size=10>";
        echo "<tr>
        <th>Date</th>
        <th>Loan_given</th>
        <th>Other</th>
        <th>Total</th>
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
        
        echo"<br/>";
        echo"<br/>";
        echo"<h1>All Details:</h1>";
        $var=mysqli_query($conn,"select e.date,e.loan_exp,o.amount,e.total from expense e 
                                inner join other_expense o on e.date=o.date where o.id=e.id and e.id='$id'");
        echo "<table border size=10>";
        echo "<tr>
        <th>Date</th>
        <th>Loan_given</th>
        <th>Other</th>
        <th>Total</th>
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