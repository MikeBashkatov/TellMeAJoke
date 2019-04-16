<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "Joke`s Details"; 
confirm_logged_in_as_admin(); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'?>
<body>

<?php  
    echo "<h1>$myTitle</h1>";
    include 'includes/open_connection.php'; 
    $link = makeConnection('joker'); 

    $id = $_GET["id"]; 
    $jokeId = intval($id); 

    if(empty($jokeId) || !is_int($jokeId)){
        echo "<h3>Invalid data</h3>"; 
        echo "<a href='approve_jokes.php'>Go back and try again</a>"; 
    }else{
        if($result = $link->query("CALL getJokeDetails($jokeId)")){
            while($row = $result->fetch_assoc()){
                echo "<div class='background'><b>Title: </b>" . $row['title'] . "<br>"; 
                echo  "<b>Joke ID: </b>" . $row['id'] . "<br><br>"; 
                echo  "<b>Teaser: </b>" . $row['teaser'] . "<br><br>"; 
                echo  "<b>Joke Text: </b>"  . $row['joke_text'] . "<br><br>"; 
                echo "<b>Delete: </b>"; 
                echo  "<a href='joke_delete.php?id=" . $row['id'] . "'>Delete this Joke</a></div>";
            }
        }
        $link->close(); 
    }
?>

<?php include 'includes/footer.php'?>
</body>
</html>