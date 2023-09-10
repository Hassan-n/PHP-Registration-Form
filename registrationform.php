<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="heading">
        <h1>Registration Form</h1>
        <br>
        <span class="error">* Required field.</span>
    </div>
    <form action="registrationform.php" method="POST" enctype="multipart/form-data">
        <?php include "server.php" ?>
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="" placeholder="Enter Name" value="<?php echo $name; ?>">
            <span class="error">* <?php echo $name_err ?></span>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="" placeholder="Enter Email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $email_err ?></span>
        </div>
        <div>
            <label for="password_1">Password:</label>
            <input type="password" name="password_1" id="" placeholder="Enter Password">
            <span class="error">* <?php echo $password_1_err ?></span>
        </div>
        <div>
            <label for="password_2">Confirm Password:</label>
            <input type="password" name="password_2" id="" placeholder="Confirm Password:">
            <span class="error">* <?php echo $password_2_err ?></span>
        </div>
        <div>
            <label>Gender:</label>
            <span class="gender_radio">
                <input type="radio" name="gender" value="female" id="">Female
                <input type="radio" name="gender" value="male" id="">Male
            </span>
            <span class="error">* <?php echo $gender_err ?></span>
        </div>
        <div>
            <label for="website">Website:</label>
            <input type="text" name="website" id="" placeholder="Website" value="<?php echo $website; ?>">
        </div>
        <div>
            <label for="uploadfile">Profile Picture:</label>
            <input type="file" name="uploadfile" id="" value="">
        </div>
        <div>
            <input type="checkbox" name="tacs" id="" value="accepted">I accept the terms & conditions.
            <span class="error">* <?php echo $tacs_err ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </div>
    </form>
    <br>
    <?php echo $result ?>
</body>
</html>
