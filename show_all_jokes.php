<?php 
include 'includes/header.php';   
include 'includes/session.php';
$myTitle = "All Jokes"; 
?>


<!doctype html>
<html lang="en">
<?php ?>
<body>
<h1><?php echo $myTitle?></h1>
<div id="wrapper">
    <?php include 'includes/open_connection.php'; 
    $link = makeConnection("joker");
    $sql = "SELECT * FROM jokes where visible = 1";
    $result = $link->query($sql);

    if(!$result = $link->query($sql)){
        die('There was an error running the query [' . $link->error . ']');
    }

    while ($row = $result->fetch_assoc()){
        
        echo "<div class='background' id='posts'><p> <b>Title: </b> " . $row['title'] .
            "<br><b>Teaser: </b>" . $row['teaser'] .
            "<br><b>Post: </b>" . $row['joke_text'] . "<br><br><div><hr>";
    }
    $result->close();
    $link->close();
    ?>
</div>
<?php
include 'includes/footer.php';
?>
</body>
</html>
