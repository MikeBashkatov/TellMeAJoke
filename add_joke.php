<?php
session_start();
$myTitle = "Save New Post";
include 'includes/header.php';
include 'includes/db_functions.php';

//Connect to the database
include 'includes/open_connection.php';
if(!isset($_SESSION['username'])){
    redirect_to("login.php");
}
//Verify the information was submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    

    //Verify that the Save button was clicked
    if(isset($_POST['btnSave'])){

        //Verify that all form fields have been filled out
        // Required field names
        $required = array('title', 'teaser', 'joke_text', 'category_id');
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            }
        }
        if(!$error){
            $title = $_POST['title'];
            $teaser = $_POST['teaser'];
            $joke_text = $_POST['joke_text'];
            $user_id = $_SESSION['id'];
            $visible = 0; 
            $category_id = $_POST['category_id']; 

            //Build a prepared statement to store the entry data
            $link = makeConnection("joker");
            $sql = "INSERT INTO jokes(title, teaser, joke_text, visible, user_id, category_id) 
            values (?, ?, ?, ?, ?, ?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('sssiii', $title, $teaser, $joke_text, $visible, $user_id, $category_id);


            if($stmt->execute()){
                //Obtain the unique id for the newly created entry and
                //display to user on confirmation page
                $last_id = $link->insert_id;
                echo "<h1>You have successfully created a new joke! Joke id is $last_id.</h1>";
            }
        }else{
            echo "<p>Missing data</p>";
            echo "<meta http-equiv='refresh' content=2; URL='add_joke.php' />";
        }
    }else{
        echo "<h1>You have to summit the form to save the post</h1>";
    }

}else{
    ?>
    
    <div id="posts">
    
        <h1><?php echo $myTitle ?></h1>
        <form method="post" action="add_joke.php">
            <fieldset>
                <legend>Add Joke</legend>
                <label for="title">Title</label><br>
                <input type="text" id="title" name="title" maxlength="150" required>
                <br>
                <label for="teaser">Teaser</label><br>
                <input type="text" id="teaser" name="teaser" maxlength="150" required>
                <br>
                <label for="joke_text">Joke Text</label><br>
                <textarea id="joke_text" name="joke_text" cols="45" rows="10"></textarea>
                <br>
                <label for="joke_text">Joke Category</label><br>
                <select name="category_id">
                    <option value="">--Select a Category--</option>
                    <?php
                        $link = makeConnection("joker"); 
                        $sql = "select id, category from categories"; 
                        $result = $link->query($sql);
                        while($row = $result->fetch_assoc()){
                            echo "<option value=" . $row['id'] .">" . $row['category'] . "</option>"; 
                        }
                    ?>
                    </select>
                <br>
                <input type="submit" id="btnSave" name="btnSave" value="Save">
                <input type="reset" name="btnReset" value="Cancel">
            </fieldset>
        </form>
    </div> 
<?php
}
include 'includes/footer.php'
?>

</body>
</html>