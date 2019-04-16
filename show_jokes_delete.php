<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "Joke`s Details"; 
confirm_logged_in_as_admin(); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'?>
<body>

<?php include 'includes/open_connection.php';
    $link = makeConnection("joker");
    $sql = "SELECT * FROM jokes";
    $result = $link->query($sql);

    if(!$result = $link->query($sql)){
        die('There was an error running the query [' . $link->error . ']');
    }

    while ($row = $result->fetch_assoc()){
        
        echo "<div class='background' id='posts'><p> <b>Title: </b> " . $row['title'] .
            "<br><b>Teaser: </b>" . $row['teaser'] .
            "<br><b>Post: </b>" . $row['joke_text'] . "<br><br>" .
            "<br><a href='joke_delete.php?id=" . $row['id'] . "'>Delete Joke</a></div><hr>";
    }
    $result->close();
    $link->close();
    ?>

<?php include 'includes/footer.php'?>
</body>
</html>