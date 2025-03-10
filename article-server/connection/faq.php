<?php
$db = mysqli_connect("localhost", "root", "", "article");


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$question=$_POST['question'];
$answer=$_POST['answer'];
$category=$_POST['category'];


$query = "INSERT INTO questions (question,answer,category) VALUES ('$question', '$answer', '$category')";

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
