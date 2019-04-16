<div id="footer">
    <?php 
        if(isset($_SESSION['type'])){
            if($_SESSION['type'] == 'admin'){
                include 'admin_footer.php'; 
            }else if($_SESSION['type'] == 'user'){
                include 'user_footer.php';
            }
        }else{
            ?>
            <br>
            <a href="show_all_jokes.php">Show all Jokes</a>|
            <a href="login.php">Login</a>|
    <?php
        }
    ?>
</div>
</body>
</html>
