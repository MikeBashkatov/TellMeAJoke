<?php include 'includes/session.php';
'includes/db_functions.php'; 
$myTitle = "All Jokes As Pages"; 
?>

<!doctype html>
<html lang="en">
<?php 'includes/header.php'?>
<body>

<?php 
    echo "<h1>$myTitle</h1>"; 
    include 'includes/open_connection.php'; 

    $per_page = 2; 
    if(isset($_GET['page'])){
        $current_page = $_GET['page']; 
        $offset = $per_page *($current_page - 1); 
    }else{
        $current_page = 1; 
        $offset = 0; 
    }

    $link = makeConnection('joker'); 
    $sql = "SELECT * FROM jokes WHERE visible = 1"; 
    $result = $link->query($sql); 
    $total_count = $result->num_rows; 
    $result->close(); 
    
    $sql2 = "SELECT id, title, teaser, joke_text from jokes where visible = '1' LIMIT $per_page OFFSET $offset"; 
    $stmt = $link->prepare($sql2); 
    $stmt->execute(); 
    $stmt->bind_result($id, $title, $teaser, $joke_text); 

    while($stmt->fetch()){
        echo "<div class='background'><b>Title: </b> $title <br>
                <b>Teaser: </b> <a href='joke_details.php?id='$id>$teaser</a><br>
                <b>Joke Text: </b>$joke_text<br><br><br><div>"; 
    }
    echo "<br>"; 

    $count = 1; 
    for($i=0; $i <$total_count; $i += $per_page){
        if($count == $current_page){
            echo "$count&nbsp;"; 
        }else{
            echo "<a href='show_all_jokes_pages.php?page=$count'>$count</a>"; 
        }
        $count++; 
    }
    $stmt->close(); 
    $link->close(); 
?>

<?php 'includes/footer.php'?>
</body>
</html>