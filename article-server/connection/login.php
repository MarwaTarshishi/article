<?php

$db=mysqli_connect("localhost","root","","article");



$password=$username="";
if(isset($_POST["email"])&&isset($_POST["password"])){



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
    $password=$_POST["password"];
    }
 
}
$checkpt="SELECT Password FROM users WHERE email='$email' ";
$p=mysqli_query($db,$checkpt);
$row=mysqli_fetch_row($p);

$n=$row[0];

if(isset($n)){
    if($n==$password){

       ?>
       
       <!DOCTYPE html>
        <html>
      
      <script type="text/javascript">
        alert("loged in successfully");
     window.location.href="../../article-client/home.php"
    </script>
 
        </html>
   <?php

    }else{
        ?>

        <!DOCTYPE html>
        <html>
       
       <script type="text/javascript">
        alert("wrong information");
    
    </script>
   
        </html>
      
      
      

      
      
      
      <?php
    }
    
}


?>
