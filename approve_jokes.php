<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "Approve Jokes"; 
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

    if($result = $link->query("CALL getJokesForApproval()")){
        while($row = $result->fetch_assoc()){
            echo "<div class='background'><b>Title: </b>" . $row['title'] . 
            "<br>"; 
            echo  "<b>Teaser: </b>"; 
            echo "<a href='joke_details.php?id=" .$row['id'] . "'>" . $row['teaser'] . "</a><br>"; 
            echo  "<b>Joke Text: </b>"  . $row['joke_text'] . "<br>"; 
            echo  "<a href='joke_approval.php?id=" . $row['id'] . "'>Approve Joke</a></div>"; 
            echo "<hr>"; 
        }

        if($result->num_rows == 0){
            echo  "<h3>There are no jokes to be approved </h3>"; 
        }
    }
    $link->close(); 
?>

<?php include 'includes/footer.php'?>
</body>
</html>