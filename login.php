<?php
include("connection.php");
session_start();
$error="";
if(isset($_POST['submit1'])){
  if(isset($_POST['username'])){
    $username=$mysqli->real_escape_string($_POST['username']);
    if(isset($_POST['Collegename'])){
      $college=$mysqli->real_escape_string($_POST['Collegename']);
      $sql="Select * from basic where '$username'=username";
      $result=mysqli_query($mysqli,$sql);
      if (!$result) {
          printf("Error: %s\n", mysqli_error($mysqli));
          exit();
      }
      $count=mysqli_num_rows($result);
      if($count==1){
        $_SESSION['username']=$username;
        $_SESSION['Collegename']=$college;
        $_SESSION['loggedin']=true;
        header("location: Waiting.php");
      }
      else{
        $error="Username is not present";
      }
    }
  }
}
?>
