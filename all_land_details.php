<?php
    include 'session.php';
?>

<html>
    <head>
        <title>Land details </title>
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
    background-color:#009bcb;
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
            <button class="btn1" style="margin-left:30px;"  formaction="land_details.php">Back</button>
        </form>
    </div>

    <?php
   
      include 'connect.php';
        if(!$conn)
        { 
        die("could not connect".mysql_error());
        }
        //$login_id=$_SESSION['login_id']

        $id=$_SESSION['id'];
        $var=mysqli_query($conn,"select date, land_id,crop,no_workers,fertilizers,fertilizer_name,irrigation,to_do from land_details where id='$id'"); 
        echo "<table border size=10>";
        echo "<tr>
        <th>Date</th>
        <th>Land_ID</th>
        <th>crop</th>
        <th>no_workers</th>
        <th>fertilizer</th>
        <th>fertilizers_names</th>
        <th>irrigation</th>
        <th>to_do</th>
        </tr>";
        if(mysqli_num_rows($var)>0){
            while($arr=mysqli_fetch_row($var))
            { echo "<tr>                 
            <td>$arr[0]</td>
            <td>$arr[1]</td>
            <td>$arr[2]</td>
            <td>$arr[3]</td>
            <td>$arr[4]</td>
            <td>$arr[5]</td>
            <td>$arr[6]</td>
            <td>$arr[7]</td>
            </tr>";}
            echo "</table>";
            mysqli_free_result($var);
          }
        mysqli_close($conn);
       
       
   ?>
