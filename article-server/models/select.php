<?php

$db=mysqli_connect("localhost","root","","article");



$category="";
if(isset($_POST["btnsecurity"])){
    $category="Security";
    $query="SELECT question, answer FROM questions WHERE category='$category' ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
    }



}else if(isset($_POST["btndevops"])){
    $category="DevOps";
    $query="SELECT question, answer FROM questions WHERE category='$category' ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
    }

}
else if(isset($_POST["btncloud"])){
    $category="Cloud";
    $query="SELECT question, answer FROM questions WHERE category='$category' ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
    }

}
else if(isset($_POST["btnmicro"])){
    $category="Microservices";
    $query="SELECT question, answer FROM questions WHERE category='$category' ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
    }


}else{
   
    $query="SELECT * FROM questions ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
    }


}

?>
