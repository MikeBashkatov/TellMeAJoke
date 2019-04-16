<?php include 'includes/session.php'; 
include 'includes/db_functions.php'; 
$myTitle = "View User Details"; 
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

    $id = $_GET["uid"]; 
    $userId = intval($id); 

    if(empty($userId) || !is_int($userId)){
        echo "<h3>Invalid data</h3>"; 
        echo "<a href='view_all_users.php'>Go back and try again</a>"; 
    }else{
        if($result = $link->query("CALL getUserDetails($userId)")){
            while($row = $result->fetch_assoc()){
                echo "<div class='background'><b>First Name: </b>" . $row['first_name'] . "<br>"; 
                echo  "<b>Last Name: </b>" . $row['last_name'] . "<br>"; 
                echo  "<b>Email: </b>" . $row['email'] . "<br><br><br>"; 
                echo  "<b>User Type: </b>"  . $row['type'] . "<br><br>"; 
                if($row['avatar'] != ''){
                    echo  "<img height='400px' alt='avatar' src='"  . $row['avatar'] . "'><br><br>";
                }
            }
        }
        $link->close(); 
    }
?>

<?php include 'includes/footer.php'?>
</body>
</html>