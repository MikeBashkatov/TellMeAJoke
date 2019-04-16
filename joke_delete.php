<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "Joke Delete"; 
confirm_logged_in_as_admin(); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'?>
<body>

<?php  
    echo "<h1>$myTitle</h1>";
    include 'includes/open_connection.php'; 
    
    $id = $_GET['id']; 
    $jokeId = intval($id); 

    if(empty($jokeId) || !is_int($jokeId)){
        echo "<h3>Invalid data</h3>"; 
        echo "<a href='approve_jokes.php'>Go back and try again</a>"; 
    }else{
        $link = makeConnection('joker'); 

        if($result=$link->query("CALL deleteJoke($jokeId)")){
            echo "<h3 class='message'>Deleted Joke Id " . $jokeId . "</h3>
            <h4><a href='show_jokes_delete.php'>Take me to delete more jokes! The world does not need laughter!</a></h4>";  
        }else{
            echo "<h3 class='message'>Error! Update failed.</h3>"; 
        }
    }
?>

<?php include 'includes/footer.php'?>
</body>
</html>