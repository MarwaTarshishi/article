<?php
$db = mysqli_connect("localhost", "root", "", "article");


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$fn = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO users (FN, email,password) VALUES ('$fn', '$email', '$password')";

if (mysqli_query($db, $query)) {
    echo "User inserted successfully.";
    ?>
  <!DOCTYPE html>
        <html>
      
      <script type="text/javascript">
        alert("loged in successfully");
     window.location.href="../../article-client/home.php"
    </script>
 
        </html>
        <?php
    
} else {
    echo "Error: " . mysqli_error($db);
}

mysqli_close($db);
?>
