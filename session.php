
<?php
    session_start();
    if(isset($_SESSION['username']))         //$_SESSION['login_id'] or  $_SESSION['active']==true
    {

    }
    else{
    echo"<script>location.href='./login/login.php'</script>";
 }
?>
<?php
    //session_start();
    //if(isset($_SESSION['user']))
    //{

    //}
    //else{
    //echo"<script>location.href='login.html'</script>";
 //}
?> 
