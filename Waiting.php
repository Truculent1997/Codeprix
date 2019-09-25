
<?php
include("connection.php");
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
  echo "Username:".$_SESSION['username'];
  echo nl2br ("\n");
  echo  "College name:".$_SESSION['Collegename'];
  echo nl2br ("\n");
}
else{
  echo "Please Log In First";
  echo "<script>setTimeout(\"location.href = 'http://10.2.112.206/Codeprix/index.php';\",0001);</script>";
}
/*$current=strtotime("now");
echo $current;
echo nl2br ("\n\n\n");*/
/*$sql="SELECT MAX(changetime) as max from Redirect";
$sql1=mysqli_query($mysqli,$sql);
if (!$sql1) {
    printf("Error: %s\n", mysqli_error($mysqli));
    exit();
}
$result = mysqli_fetch_array($sql1);
$change=$result['max'];
//$_SESSION['change']=$change;
echo $change;
//echo json_encode($change);
echo nl2br ("\n\n\n");
*/

?>
 <!DOCTYPE html>
<html>
<title>Your Home Page</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/curtime.js"></script>
<body onload=myhandler()>
<b id="logout"><a href="logout.php">Log Out</a></b>
<p id="demo"></p>
</body>
</html>
<script>
function myhandler(){
  $.ajax({
    type:"GET",
    url:"fetch.php",
    datatype:"html",
    success:function(response){
      var obj=JSON.parse(response);
      var countdown=obj[0]['max'];
      var time_pau = setInterval(function(){
        var d=+ new Date();
        d=(d/1000)|0;
        console.log(countdown);
        console.log(d);
        console.log(obj);
        if(parseInt(countdown)-parseInt(d)<=0){
          var prm = {"mydata":obj};
          $.ajax({
            type:"POST",
            datatype:"JSON",
            url:"Add.php",
            data:prm,
            success:function(data){
              console.log(data);
              clearInterval(time_pau);
              //alert('Change to the question');
              window.location="http://10.2.112.206/Codeprix/form.php";
            },
            error: function(e){
              console.log(e.message);

          }
          });

        }
      },1000);

    }
  });


}
</script>
