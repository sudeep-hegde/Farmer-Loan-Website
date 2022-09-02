<?php
    include 'session.php';
?>
<!doctype html>
<html>
    <head>
        <title>Workers</title>

        
           <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="worker.css"/>
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


<?php

  include("connect.php");

  if (isset ($wid)||isset ($name))
  {
  $wid =       $_POST["wid"];
  $name =      $_POST["name"];
   
  }
        $id=$_SESSION["id"];
        $sql = "SELECT * from  workerprofile where id='$id' ";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);
?>

<body>
<body>
    <div class="topnav">
    <a class="active" href="home.html"><img style="width: 45px;height:35px;border-radius:10px;"src="home.png"> Home</a>             
        <div class="topnav-right">
          <a href="logout.php"><img style="width: 100px;height:auto;" src="logout.png"></a>
        </div>
    </div>
        <h1 style="margin-top:30px;margin-left:30px;font-size:25px" class="heading">WORKER ATTENDENCE- date:(<?php echo date("d/m/Y")?>)</h1>
        <form method ="POST" formaction="worker.php"> 
             <table class="table">
            
              
                <th class="id">ID</th>
                <th class="name">NAME</th>
                <th class="attendence">ATTENDENCE</th>
                <th class="workat">WORK PLACE</th>
                <th class="money">MONEY PAID</th>
                <th class="money">LOAN TAKEN</th>                 
                <th class="desc">DESCRIPTION</th> 
                <th class="vpro">PROFILE</th>
                  

                <?php  
                if($resultCheck > 0) {
                    while ( $row = mysqli_fetch_assoc($result)) { 
                        ?>
                  
               <tr>
                <td>  <?php echo $row['wid']  ?>  </td>
                 <input type ="hidden" value=" <?php echo $row['wid'] ;
                ?> "name ="wid[]"/>
                  <td>   <?php echo $row['wname'] ?> </td>
               
                 

                   <td>  <select name="attd[]">
                       <option name="attd[]" value="0">ABSENT</option>
                       <option name="attd[]" value="1">PRESENT</option>
                       </select>
                   </td> 
                
                   <td>     
                     <?php
                        include 'connect.php';
                        $sql = "SELECT * FROM `land` where id='$id'";
                        $all_categories = mysqli_query($conn,$sql);
                     ?>
        <select name="workat[]" >
            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($category = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $category["name"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $category["name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select> </td>

                   <td>    <input type="number" name="moneyrec[]" required/></td>
                     
                   <td>     <input type="number" name="moneypaid[]" required/></td>

                  <td>       <input type="text" name="desci[]" required/></td>
                   
                 </form>

                       <td>  <a href="vworkerprofile.php?wid=<?php echo $row["wid"]; ?>"> <img src="profile.png"alt="user"style="width: 45px;border-radius:5px; display:block;margin-left=20px;"></a></td>
                 
                       <?php
                    }
                  }
                  ?>   
            
               </tr>   
          </table>
          <!-- <input class="sbutton" type="submit" name="submit" value="ADD"   >&ensp;             formaction="tq.php" -->
          <button class="sbutton" type ="submit" name="submit">SAVE</button>
         
        
         </form>
         <form>
         <button class="abutton" type ="submit" formaction="addworker.php">ADD NEW WORKER</button>
         </form>
  </div>
  <?php
  if(isset($_POST["submit"]))
    {
      $Query3="select count(*) from workerprofile WHERE id='$id'";               
      $Execute1 = mysqli_query($conn,$Query3);
      $count1 = mysqli_fetch_row($Execute1);
      if($count1[0]==0)
      {  
        echo'
            <div>
                <h1 style="color:#6B7280;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;"> no workers present</h1>
            </div>';
        }
else{
  $count=0;
  $date= date("Y-m-d");
  $id=$_SESSION["id"];
  $Query3="select count(*) from workerdailyupdate WHERE date='$date' and id='$id'";
  $Execute1 = mysqli_query($conn,$Query3);
  $count1 = mysqli_fetch_row($Execute1);
  if($count1[0]==0)
  {
  $sql =  "select count(*) from workerprofile where id=$id";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)>0){
   while($arr=mysqli_fetch_row($res)){
 $arr[0];
 $count=$arr[0]; 
   }}
   for($i=0; $i <$count; $i++)
{
  $id=$_SESSION["id"];
  $query = "INSERT INTO workerdailyupdate (id,date,wid,attd,workat,moneypaid,moneyrec,desci)
   VALUES ('$id','$date','".$_POST['wid'][$i]."','".$_POST['attd'][$i]."','".$_POST['workat'][$i]."','".$_POST['moneypaid'][$i]."','".$_POST['moneyrec'][$i]."','".$_POST['desci'][$i]."')";
   echo'
   <div>
       <h1 style="color:#6B7280;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;""> Attendence taken for the date ('.$date.') taken</h1>
   </div>';

   mysqli_query($conn,$query);
}
}
else{
  echo'
      <div>
          <h1 style="color:red;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;""> Attendence taken for the date ('.$date.')</h1>
      </div>';
  }
}
}
        ?>
</body>
</html>