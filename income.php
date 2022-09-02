<?php
    include 'session.php';
?>

<html>
    <head>
        <title>Income</title>

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
       <!-- <button class="btn1" formaction="addincome.php">Add Income</button>                  style=" height: 50px;width: 120px;cursor:pointer;border-radius:15px;border: 3px solid #e69500;background-color: rgba(249, 105, 14, 1);color:#f2f2f2;font-size:15px;" -->
        
        <!-- <button class="btn1" formaction="updateincome.php">update details</button>  -->

        <button class="btn1" style="margin-left:1100px;" formaction="crop.php">Crop</button>

        <button class="btn1" formaction="loanrec.php">Loan</button>

        <button class="btn1" formaction="other_inc.php">Others</button>
    </form>
</div>
<h1 style="margin-left:20px;">Income (Date: <?php echo date('d/m/Y');?>)</h1>

<?php
   
   include 'connect.php';
    if(!$conn)
    { 
        die("could not connect".mysql_error());
    }
    $id=$_SESSION['id'];
    $date=date("Y-m-d");
    $var=mysqli_query($conn,"select c.income,i.loan_rec,o.amount,
        i.total_inc from income i
        inner join crop c on i.date=c.date and c.id='$id'
        inner join other o on i.date=o.date and o.id='$id'
        where i.date='$date' and i.id='$id'");       //select i.date,l.amount_rec,c.income,o.amount,i.total_inc from income i natural join crop c natural join loan_rec l natural join other o where i.date=c.date and i.id=c.id and i.id=l.id and i.date=l.date and o.date=i.date;"  select date,crop_inc,loan_rec,other,total_inc from income where id='$id'
    echo "<table border size=10>";
    if(mysqli_num_rows($var)>0){
    echo "
        <tr>
        <th>Crop_Income</th>
        <th>Loan_Inc</th>
        <th>Other</th>
        <th>Total Income</th>
        </tr>";

    
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

    echo"<br/>";
    echo"<br/>";
    echo"<h1>Income Details</h1>";


    $var=mysqli_query($conn,"select distinct i.date,c.income,i.loan_rec,o.amount,i.total_inc from income i 
    inner join other o on i.date=o.date inner join crop c on c.date=i.date where c.id=i.id and o.id=i.id and i.id='$id'");   // where i.id="$id"    //select i.date,l.amount_rec,c.income,o.amount,i.total_inc from income i natural join crop c natural join loan_rec l natural join other o where i.date=c.date and i.id=c.id and i.id=l.id and i.date=l.date and o.date=i.date;"  select date,crop_inc,loan_rec,other,total_inc from income where id='$id'
    echo "<table border size=10>";
    echo "
        <tr>
        <th>Date</th>
        <th>Crop_Income</th>
        <th>Loan_Inc</th>
        <th>Other</th>
        <th>Total Income</th>
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

        echo "</table>";
        mysqli_free_result($var);
    }

    mysqli_close($conn);
    
    
?>







