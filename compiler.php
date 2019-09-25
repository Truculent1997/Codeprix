<?php

          //echo "hello";

          echo nl2br ("\n\n\n");
          if(isset($_POST['preview-form-comment'])&&!empty($_POST['preview-form-comment'])){
            $code=$_POST['preview-form-comment'];
            $CC="gcc";
            $printer="echo";
            $username1=$_SESSION['username'];
            $out="./".$username1.".out";

            $No=$_SESSION['rowcount'];
            echo nl2br ("\n\n\n");
            $filename_code=$username1.$No.".c";
            echo nl2br ("\n\n\n");
            $create=$printer." ".htmlentities($code)."  > ".$filename_code;
            exec("chmod 777 $filename_code");
            $file_code=fopen($filename_code,"w+");
          	fwrite($file_code,$code);
          	fclose($file_code);
            $executable="a";
            $filename_error=trim($username1)."error.txt";
            $command=$CC." -lm ".$filename_code." -o ".$username1.".out";
            $command_error=$command." 2>".$filename_error;
            exec("chmod 777 $username1");
            exec("chmod 777 $executable");
            exec("chmod 777 $filename_error");
            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            //echo $input1;
            $input1="input".($No).".txt";
            //echo nl2br ("\n\n\n");
            exec("chmod 777 $input1");
            $input=file_get_contents($input1);
            $output="";
            if(trim($error)=="")
            {
              if(trim($input)==""){
                //echo "Do you know";
                $output=shell_exec($out);
                echo $output;
              }
              else {
                //echo "Yeah Do you know";
                $out=$out." < ".$input1;
                //echo $out;
          			$output=shell_exec($out);
                echo $output;
              }
              $output1="Output".($No).".txt";
              exec("chmod 777 $output1");
              $CorOutput=file_get_contents($output1);
              if(strcmp(trim($CorOutput),trim($output))){
                echo "
                <script type=\"text/javascript\">
                alert(\"Wrong Output Dude\");
                </script>
                ";
                header("location: form.php");
                //echo "Code is wrong";
              }
              else{
                      echo "Code is correct";
                      //echo "Marks is:" ;
                      //echo $_SESSION['rowcount'];
                      //echo $No;
                      //echo $NO;
                      $sql="UPDATE basic SET marks=marks+(($No)*10) Where username=\"$username1\"";
                      //echo $sql;
                      $sql1=mysqli_query($mysqli,$sql);
                      $sql="UPDATE Current SET Questionno=Questionno+1 Where 1";
                      $sql1=mysqli_query($mysqli,$sql);
                      $number=(int)strtotime("15 seconds");
                      $sql="UPDATE Redirect SET changetime=$number Where 1";
                      $sql1=mysqli_query($mysqli,$sql);
                      $sql="UPDATE questionid SET submitted=1 Where questionno=$No";
                      $sql1=mysqli_query($mysqli,$sql);
                      $_POST['preview-form-comment']="";
                      $_SESSION['currentcode']="";
                      header("location: Waiting.php");
                  }
            }
            else if(!strpos($error,"error")){
              if(trim($input)==""){
                //echo "Do you know part 2";
                $output=shell_exec($out);
                echo $output;
              }
              else {
                //echo "Yeah Do you know part 2";
                $out=$out." < ".$input1;
                //echo $out;
          			$output=shell_exec($out);
                echo $output;
              }
              $output1="Output".($No+1).".txt";
              exec("chmod 777 $output1");
              $CorOutput=file_get_contents($output1);
              if(strcmp(trim($CorOutput),trim($output))){
                echo "
                <script type=\"text/javascript\">
                alert(\"Wrong Output Dude\");
                </script>
                ";
                header("location: form.php");
                //echo "Wrong Output";
              }
              else{
                    //echo "Successfully Submitted";
                    $sql="UPDATE basic SET marks+=(($No)*10) Where username=\"$username1\"";
                    $sql1=mysqli_query($mysqli,$sql);
                    $sql="UPDATE Current SET Questionno=Questionno+1 Where 1";
                    $sql1=mysqli_query($mysqli,$sql);
                    $number=(int)strtotime("15 seconds");
                    $sql="UPDATE Redirect SET changetime=$number Where 1";
                    $sql1=mysqli_query($mysqli,$sql);
                    $sql="UPDATE questionid SET submitted=1 Where questionno=$No";
                    $sql1=mysqli_query($mysqli,$sql);
                    $_POST['preview-form-comment']="";
                    $_SESSION['currentcode']="";
                    header("location: Waiting.php");
                  }
            }
            else{
              echo "ERROR";
              echo "<pre>$error</pre>";

            }


          }



?>
