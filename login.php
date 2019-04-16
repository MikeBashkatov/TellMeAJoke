<!doctype html>

<?php 
include 'includes/header.php';
include 'includes/db_functions.php';
include 'includes/session.php';
$myTitle = "Login";
$link = connect();
?>

<html lang="en">
<body>
<h1><?php echo $myTitle ?></h1>

<?php
if(!empty($_GET['message'])){
    $messagecode = trim($_GET['message']);
    $message = "";

    if($messagecode == 1){
        $message = "You have successfully logged out!";
    }else if($messagecode == 2){
        $message = "Please login...";
    }else if($messagecode == 3){
        $message = "Please login as admin to view this page!";
    }
    echo "<h3 class='message'>$message</h3>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$username = $_POST['username'];
$password = $_POST['password'];

if(login($link, $username, $password)){      
        echo "<p>You are now logged in as " . $_SESSION['username'] . "</p>";
    }else{
        echo "<h3>Invalid username or password</h3>";
        echo "<h3><a href='login.php'>Go back and try again</a></h3>";
    }
}else{
    ?>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username"/>
        <label for="password">Password:</label>
        <input type="password" name="password"/>
        <input type="submit" value="Login"/>
    </form>
    <?php
}
?>

<?php
include 'includes/footer.php';
?>

</body>
</html>


