<?php
include("connection.php");
session_start();
$sql="SELECT MAX(changetime) as max from Redirect";
$sql1=mysqli_query($mysqli,$sql);
if (!$sql1){
    printf("Error: %s\n", mysqli_error($mysqli));
    exit();
}
$result = mysqli_fetch_assoc($sql1);
echo json_encode(array( $result));
?>
