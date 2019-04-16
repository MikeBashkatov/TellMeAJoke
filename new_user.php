<?php
session_start();
$myTitle = "New User";
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
        $required = array('lName', 'fName', 'email', 'password', 'type', 'username');
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            }
        }

        //validate image
        if($_FILES['theFile']['error'] == 0){
            $file = $_FILES['theFile']['tmp_name']; 
            $file_info = new finfo(FILEINFO_MIME); 
            $mime_type_long = $file_info->buffer(file_get_contents($file)); 
            $intpos = strpos($mime_type_long, ';'); 
            $mime_type = substr($mime_type_long, 0, $intpos); 
    
            if($mime_type == 'image/jpg' || $mime_type == 'image/jpeg' || 
            $mime_type == 'image/gif' || $mime_type == 'image/png' || 
            $mime_type == 'image/bmp'){
                doFileCheck($file); 
            }else{
                echo "Invalid file type... $mime_type";                 
            }
        }else{
            echo "Upload image properly"; 
        }

        if(!$error){
            $lName = $_POST['lName'];
            $fName = $_POST['fName'];
            $email = $_POST['email'];

            $password = $_POST['password'];            
            $algo = PASSWORD_DEFAULT;             
            $hashed_password = password_hash($password, $algo); 
            
            $type = $_POST['type'];
            $username = $_POST['username'];
            $avatar = 'uploads/' . $_FILES['theFile']['name']; 

            //Build a prepared statement to store the entry data
            $link = makeConnection("joker");
            $sql = "INSERT INTO users(first_name, last_name, username, password, email, avatar, type) values (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('sssssss', $fName, $lName, $username, $hashed_password, $email, $avatar, $type);


            if($stmt->execute()){
                //Obtain the unique id for the newly created entry and
                //display to user on confirmation page
                $last_id = $link->insert_id;
                echo "<h1>Saved '" . $username . "' in the database. Yay! New </h1>
                <h1>New user id is $last_id.</h1>";
            }
        }else{
            echo "<p>Missing data</p>";
            echo "<meta http-equiv='refresh' content=2; URL='new_user.php' />";
        }
    }else{
        echo "<h1>You have to summit the form to save the post</h1>";
    }

}else{
    ?>
    
    <div id="posts">
    
        <h1><?php echo $myTitle ?></h1>
        <form method="post" action="new_user.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Create User</legend>
                <label for="fName">First Name</label><br>
                <input type="text" id="fName" name="fName" maxlength="30" required>
                <br>
                <label for="lName">Last Name</label><br>
                <input type="text" id="lName" name="lName" maxlength="30" required>
                <br>
                <label for="username">Username</label><br>
                <input type="text" id="username" name="username" maxlength="30" required>
                <br>
                <label for="password">Password</label><br>
                <input type="text" id="password" name="password" maxlength="255" required>
                <br>
                <label for="type">User Type</label><br>
                <select name="type">
                    <option value="">--Select User Type--</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    </select>
                <br>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" maxlength="60" required>
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" >
                <label>Upload Avatar:</label> <input type="file" name="theFile" >
                <input type="submit" id="btnSave" name="btnSave" value="Save">
                <input type="reset" name="btnReset" value="Cancel">
            </fieldset>
        </form>
    </div> 
<?php
}
function doFileCheck($file){
    $imginfo_array = getimagesize($file); 
    if($imginfo_array !== false){
        $uploaddir = './uploads/'; 
        $uploadfile  = $uploaddir . basename($_FILES['theFile']['name']); 

        if(file_exists($uploadfile)){
            echo "That filename already exists -- try again"; 
        }else{
            if(!move_uploaded_file($_FILES['theFile']['tmp_name'], 
                $uploadfile)){
                    echo "File was not uploaded correctly -- please try again"; 
            }
        }
    }
}

include 'includes/footer.php'
?>

</body>
</html>