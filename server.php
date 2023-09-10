<?php
// initializing variables
$name = $email = $password_1 = $password_2 = $gender = $website = $tacs = $folder = $filename = $uploadOk = $imageFileType = $check = $result = "";
$name_err = $email_err = $password_1_err = $password_2_err = $password_match_err = $gender_err = $website_err = $tacs_err = "";
$error_count = 0;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration(question4)');

// REGISTER USER
if (isset($_POST['submit'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $website = mysqli_real_escape_string($db, $_POST['website']);
    $folder = "./images/";
    $filename = $folder . basename($_FILES["uploadfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // form validation: ensure that the form is correctly filled ...
    if (empty($name)) {
        $name_err = "Name is required!";
        $error_count++;
    }
    if (empty($email)) {
        $email_err = "Email is required!";
        $error_count++;
    }
    if ($_POST["password_1"] != $_POST["password_2"]) {
        echo "The two passwords do not match!";
        $error_count++;
    }
    if (empty($password_1)) {
        $password_1_err = "Password is required!";
        $error_count++;
    }
    if (empty($password_2)) {
        $password_2_err = "Password is not confirmed!";
        $error_count++;
    }
    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required!";
        $error_count++;
    } else {
        $gender = $_POST['gender'];
    }
    if (empty($_POST["tacs"])) {
        $tacs_err = "You must accept the terms and conditions!";
        $error_count++;
    } else {
        $tacs = $_POST['tacs'];
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        if ($user['name'] === $name) {
            echo "Name already exists. ";
            $error_count++;
        }
        if ($user['email'] === $email) {
            echo "Email already exists. ";
            $error_count++;
        }
    }

    // Finally, register user if there are no errors in the form
    if ($error_count == 0) {
        $password = md5($password_1); // encrypt the password before saving in the database

        // Create the target directory if it doesn't exist
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $query = "INSERT INTO users (name, email, password, gender, website, profilepic, uploadtime, tacs) VALUES('$name', '$email', '$password', '$gender', '$website', '$filename', now(), '$tacs')";
        mysqli_query($db, $query);

        // if everything is ok, try to upload file
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $filename);
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password_1;
        $_SESSION['gender'] = $gender;
        $result = '<p style="color:green">Signup Successful!</p>';
    } else {
        $result = '<p style="color:red">Signup Unsuccessful!</p>';
    }
}
?>
