<?php
session_start();
include("connection.php");
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
  //$_SESSION['currentcode']="";
  $comment=null;
  //echo "Hello2";
  //echo $_SERVER['REQUEST_METHOD'];
  if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['preview-form-comment'])){
    $_SESSION['currentcode']=$_POST['preview-form-comment'];
  }
  if(isset($_SESSION['currentcode'])){
  $comment=$_SESSION['currentcode'];
  }
  $sql="SELECT MAX(Questionno) as max from Current";
  $sql1=mysqli_query($mysqli,$sql);
  if (!$sql1) {
      printf("Error: %s\n", mysqli_error($mysqli));
        exit();
  }
  $result = mysqli_fetch_array($sql1);
  $_SESSION['rowcount']=$result['max'];
  $fileName="Question".$result['max'].".txt";
  $text=file_get_contents($fileName);
  $text = nl2br($text);
  echo $text;
  if($comment!=""){
      include("compiler.php");
  }


?>
<!DOCTYPE html>
<html>
	<head>
    <title>CodeMirror-Form</title>
    <link rel="stylesheet" type="text/css" href="plugin/codemirror/lib/codemirror.css">
    <script type="text/javascript" src="plugin/codemirror/lib/codemirror.js"></script>
    <!--link rel="stylesheet" type="text/javascript" href="plugin/codemirror/lib/codemirror.js"-->
    <link rel="stylesheet" href="plugin/codemirror/theme/neo.css">
    <link rel="stylesheet" href="plugin/codemirror/theme/cobalt.css">
    <link rel="stylesheet" href="plugin/codemirror/theme/idea.css">
    <link rel="stylesheet" href="plugin/codemirror/theme/ambiance.css">
    <link rel="stylesheet" href="plugin/codemirror/addon/search/matchesonscrollbar.css">
    <link rel="stylesheet" href="plugin/codemirror/addon/dialog/dialog.css">
    <script src="plugin/codemirror/addon/selection/active-line.js"></script>
    <script src="plugin/codemirror/addon/edit/closebrackets.js"></script>
    <script src="plugin/codemirror/mode/javascript/javascript.js"></script>
    <script src="plugin/codemirror/mode/css/css.js"></script>
    <script src="js/clike.js"></script>
    <script src="plugin/codemirror/addon/dialog/dialog.js"></script>
    <script src="plugin/codemirror/addon/search/searchcursor.js"></script>
    <script src="plugin/codemirror/addon/search/search.js"></script>
    <script src="plugin/codemirror/addon/scroll/annotatescrollbar.js"></script>
    <script src="plugin/codemirror/addon/search/matchesonscrollbar.js"></script>
    <script src="plugin/codemirror/addon/search/jump-to-line.js"></script>
    <!--script type="text/javascript" src="js/default.js"></script-->
  </head>
	<body>
    <b id="logout"><a href="logout.php">Log Out</a></b>
		<form id="preview-form" method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>" >
      <textarea class="codemirror-textarea" name="preview-form-comment" id="preview-form-comment"><?php echo $comment ?></textarea>
      <br>
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/default.js"></script>
      <input type="submit" onclick="savedata();" name="preview-form-submit" id="preview-form-submit" value="Submit">
    </form>
    <!--showcode();-->

    <p>Select a theme :<select onchange="selectTheme()" id=select>
      <option id="default" selected>default</option>
      <option id="neo">neo</option>
      <option id="cobalt">cobalt</option>
      <option id="idea">idea</option>
      <option id="ambiance">ambiance</option>
    </select>
    </p>
</body>
</html>
<script>
var theme=localStorage.getItem("currenttheme");
window.onload=function myhandler(){
  editor.setOption("theme",theme);
  document.getElementById("select").value=localStorage.getItem("currenttheme");
  $.ajax({
    type:"GET",
    url:"fetch.php",
    datatype:"html",
    success:function(response){
      var obj=JSON.parse(response);
      var countdown=obj[0]['max'];
      var time_pau = setInterval(function(){
      $.ajax({
        type:"GET",
        url:"fetch2.php",
        datatype:"html",
        success:function(response2){
          var obj2=JSON.parse(response2);
          var countdown2=obj2[0]['checking'];
          console.log(countdown2);
          if(parseInt(countdown2)!=0){
              window.location="http://10.2.112.206/Codeprix/Waiting.php";
          }
        }
      });
      var d=+ new Date();
      d=(d/1000)|0;
      console.log(d);
      console.log(countdown);
      if(parseInt(countdown)-parseInt(d)<=0){
        var prm = {"mydata":obj};
        $.ajax({
          type:"POST",
          datatype:"JSON",
          url:"Add2.php",
          data:prm,
          success:function(data){
            console.log(data);
            clearInterval(time_pau);
            //alert('Change to the waiting area');
            window.location="http://10.2.112.206/Codeprix/Waiting.php";
          },
          error: function(e){
            console.log(e.message);

         }
       });
      }
   },1000);
 },
 error:function(e){
   console.log(e.message);
 }
 });
}
</script>
