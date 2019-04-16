<div id="userfooter">
    <br>
    <a href="show_all_jokes.php">Show All Jokes</a> |
    <a href="add_joke.php">Add Jokes</a> |
    <a href="logout.php">Logout</a> |

    <?php
        if(isset($_SESSION['username'])){
            echo "Logged in as " . $_SESSION['username']; 
        }
    ?>
</div>