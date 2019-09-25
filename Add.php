<?php
include("connection.php");
session_start();
function subArraysToString($ar, $sep = ', ') {
    $str = '';
    foreach ($ar as $val) {
        $str .= implode($sep, $val);
        $str .= $sep; // add separator between sub-arrays
    }
    $str = rtrim($str, $sep); // remove last separator
    return $str;
}
if(isset($_POST['mydata'])){
   $obj=$_POST['mydata'];
   $number=(int)(subArraysToString($obj));
   $add=15*60;
   $number+=$add;
   $sql="UPDATE Redirect SET changetime=$number Where 1";
   $sql1=mysqli_query($mysqli,$sql);
   /*echo "
   <script type=\"text/javascript\">
   alert($number);
   </script>
   ";
   // echo $sql1;
   */
}
else{
  echo "Sorry bro yo motherfucker";
}
?>
