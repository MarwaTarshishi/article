<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Reference Architecture Q&A</title>
  <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cards.css">

</head>
<body>
    <header>
        <div class="header-content">
            <h1>Reference Architecture Q&A</h1>
            <div class="user-controls">
                <span id="username"></span>
           <a href="index.html">   <button id="logoutBtn" name="logoutBtn"  class="btn btn-outline">Logout</button></a> 
            </div>
        </div>
    </header>

    <main>
        <div class="filter-container">
            <div class="filter-buttons">

                <form  method="post">
                 <button class="btn filter-btn active" data-filter="all" name="btna" id="btna">All</button> 
         
              
                <button class="btn filter-btn" data-filter="DevOps" name="btndevops" id="btndevops">DevOps</button>
         
           
                <button class="btn filter-btn" data-filter="Cloud" name="btncloud" id="btncloud">Cloud</button>
       
        
                <button class="btn filter-btn" data-filter="Security" name="btnsecurity" id="btnsecurity">Security</button>
       
                <button class="btn filter-btn" data-filter="Microservices" name="btnmicro" id="btnmicro">Microservices</button>
            </form>

            </div>
            <button id="addQuestionBtn" class="btn btn-primary" onclick="window.location.href='faq.html'">
                <span class="plus-icon">+</span> Add Question
            </button>
        </div>

        <div class="cards-container" id="cardsContainer">
          
        </div>
    </main>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions as Cards</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">

   <?php
   include('../article-server/models/select.php"');
    
 
  
   
$category="";

if(isset($_POST["btnsecurity"])){
 
    


    $category="Security";
    $query7="SELECT question, answer FROM questions WHERE category='$category' ";
    $result7 = $db->query($query7);
    $questions7 = [];
    if ($result7->num_rows > 0) {
        while($row7 = $result7->fetch_assoc()) {
            $questions7[] = $row7; 
        }
        foreach ($questions7 as $question) {
            echo '
            <div class="card">
                <h3 class="card-title">Question: ' . $question['question'] . '</h3>
                <p class="card-answer">Answer: ' . $question['answer'] . '</p>
            </div>';
    }
}
}
else if(isset($_POST["btndevops"])){
    $category="DevOps";
    $query2="SELECT question, answer FROM questions WHERE category='$category' ";
    $result = $db->query($query2);
    $questions8 = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions8[] = $row; // Store the data in an array
        } foreach ($questions8 as $question) {
            echo '
            <div class="card">
                <h3 class="card-title">Question: ' . $question['question'] . '</h3>
                <p class="card-answer">Answer: ' . $question['answer'] . '</p>
            </div>';
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
        foreach ($questions as $question) {
            echo '
            <div class="card">
                <h3 class="card-title">Question: ' . $question['question'] . '</h3>
                <p class="card-answer">Answer: ' . $question['answer'] . '</p>
            </div>';
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
        foreach ($questions as $question) {
            echo '
            <div class="card">
                <h3 class="card-title">Question: ' . $question['question'] . '</h3>
                <p class="card-answer">Answer: ' . $question['answer'] . '</p>
            </div>';
    }
    }


}else if ((isset($_POST["btna"]))){
   
    $query="SELECT * FROM questions ";
    $result = $db->query($query);
    $questions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row; 
        }
        foreach ($questions as $qu) {
            echo '
            <div class="card">
                <h3 class="card-title">Question: ' . $qu['question'] . '</h3>
                <p class="card-answer">Answer: ' . $qu['answer'] . '</p>
            </div>';
    }
    }

}

 if(isset($_POST["logoutBtn"]))
 {
    header('index.html');
 }

    ?>




     
</div>











</body>
</html>
