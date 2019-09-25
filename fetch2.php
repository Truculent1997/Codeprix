<?php
include("connection.php");
session_start();
$ques=$_SESSION['rowcount'];
$sql="SELECT submitted as checking from questionid where questionno=$ques";
$sql1=mysqli_query($mysqli,$sql);
if (!$sql1){
    printf("Error: %s\n", mysqli_error($mysqli));
    exit();
}
$result = mysqli_fetch_assoc($sql1);
echo json_encode(array( $result));
?>
