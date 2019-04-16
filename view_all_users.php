<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "All Users"; 
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

    if($result=$link->query("CALL getAllUsers()")){
        while($row = $result->fetch_assoc()){
            echo "<div class='background'><b>Username: </b>" . $row['username'] . 
            "<br>"; 
            echo  "<b>Name: </b>" . $row['first_name'] . " " . $row['last_name']; 
            echo  "<br><a href='view_user_details.php?uid=" . $row['id'] . "'>View User Details</a></div>"; 
            echo "<hr>"; 
        }
    }
    $link->close(); 
?>

<?php include 'includes/footer.php'?>
</body>
</html>