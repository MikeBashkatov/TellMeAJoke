<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "Jokes Approval"; 
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

        if($result=$link->query("CALL approveJoke($jokeId)")){
            echo "<h3 class='message'>Joke Id " . $jokeId . " has been approved!</h3>
            <a href='approve_jokes.php'>Approve more jokes</a>";  
        }else{
            echo "<h3 class='message'>Error! Update failed.</h3>"; 
        }
    }
?>

<?php include 'includes/footer.php'?>
</body>
</html>