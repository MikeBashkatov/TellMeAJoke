<div id="adminfooter">
    <br>
    <a href="show_all_jokes.php">Show All Jokes</a> |
    <a href="add_joke.php">Add Jokes</a> |
    <a href="approve_jokes.php">Approve Jokes</a> |
    <a href="show_jokes_delete.php">Delete Jokes</a> |
    <a href="view_all_users.php">View All Users</a> |
    <a href="new_user.php">New User</a> |
    <a href="logout.php">Logout</a> |


    <?php
        if(isset($_SESSION['username'])){
            echo "Logged in as " . $_SESSION['username']; 
        }
    ?>
</div>