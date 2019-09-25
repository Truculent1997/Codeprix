<?php
include("connection.php");
include("login.php");
if(isset($_SESSION['username'])){
    header("location: Waiting.php");
}
?>
<!DOCTYPE HTML>
<html>
  <body>
    <form method="post" action="">
      Code provided:
      <input type="text" name="username" value="<?php echo isset($_POST["username"])?
      $_POST["username"] : '';?>" required/>
      <br>
      College name:
      <input type="text" name="Collegename" value="<?php echo isset($_POST["Collegename"])?
      $_POST["Collegename"] : '';?>" required/>
      <br>
      <input name="submit1" type="submit" value="Login!!"/>
      <span><?php echo $error; ?></span>
    </form>
  </body>
</html>
