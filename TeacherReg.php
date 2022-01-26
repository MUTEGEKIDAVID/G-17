<?php

$page_title = 'Register';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require ('connectdb.php');
    $errors = array();

    if (empty($_POST['first_name']))
    { $errors[] = 'Enter your first name.';}
    else
    {$fn = mysqli_real_escape_string($dbc,
        trim($_POST['first_name']));}
    
    if (empty($_POST['last_name']))
    { $errors[] = 'Enter your last name.';}
    else 
    { $ln = mysqli_real_escape_string( $dbc,
        trim( $_POST['last_name']));}

    if (empty($_POST['email']))
    { $errors[] = 'Enter your email address.';}
    else 
    { $e = mysqli_real_escape_string( $dbc,
        trim( $_POST['email']));}
    
    if (empty($_POST['teacher_ID']))
    { $errors[] = 'Enter your teacher_ID.';}
    else {
        $s = mysqli_real_escape_string( $dbc, trim( $_POST['teacher_ID']));
    }


    if (!empty($_POST['pass1']))
    {
        if ( $_POST['pass1'] != $_POST['pass2'])
        { $errors[] = 'Passwords do not match.';}
        else
        { $p = mysqli_real_escape_string( $dbc,
            trim($_POST['pass1']));}
    } else { $errors[] = 'Enter your password.';}

    if ( empty( $errors))
    {
        $q = "SELECT teacher_ID FROM teacher WHERE email='$e'";
        $r = mysqli_query($dbc, $q);
        if ( mysqli_num_rows($r) != 0)
        {
            $errors[] = 'Email address already registered.
            #<a href="teacherlogin.php">Login</a>';
        }
    }

    if (empty($errors)) 
    {
        $q = "INSERT INTO teacher (first_name, last_name, email, teacher_ID, pass)
              VALUES ('$fn', '$ln', '$e', '$s' ,SHA1('$p'))";
        $r = mysqli_query ($dbc, $q);
        
        if ($r) 
        {
            echo '<h1>Registered!</h1>
            <p>You are now registered.</p>
            <p><a href="teacherlogin.php">Login</a></p>';
        }
        mysqli_close($dbc);
    
        exit();
    }
    else
    {
        echo '<h1>Error!</h1>
        <p id="err_msg">The following error(s) occurred:<br>';
        foreach ($errors as $msg)
        {
            echo "-$msg<br>"; 
        }
        echo 'Please try again.</p>';
        mysqli_close($dbc);
    }
}?>

<html>
    <head>
    <link rel="stylesheet" href="teacherReg.css">
    </head>
    <body>
        <div class="header">
        <h1>Registrationform</h1></head>
        <div class="registrationbox">
        <form action="TeacherReg.php" method="POST">
            <p>
                <label for="firstname" id="fname">Firstname</label>
                <input type="text" name="first_name" id=" firstname"
                value="<?php if (isset( $_POST['first_name']))
                echo $_POST['first_name'];?>">


                <label for="lasttname" id="lname">Lastname</label>
                 <input type="text" name="last_name" id="lastname"
                value="<?php if (isset( $_POST['last_name']))
                echo $_POST['last_name'];?>">
            </p>    
            <p>
            <label for="email" id="email">Email Address</label>
                <input type="text" id="em" name="email"  id="email"
                value="<?php if (isset( $_POST['email']))
                echo $_POST['email'];?>">
            </p>
            <p>
            <label for="teacherID" id="teachID">TeacherID</label>
            <input type="text" id="em" name="teacher_ID" id="teacherID"
                value="<?php if (isset($_POST['teacher_ID']))
                echo $_POST['teacher_ID'];?>">
            </p>
            <p>
            <label for="password" id="pas1">Password</label>
                <input type="password" name="pass1" id="password"
                value="<?php if (isset( $_POST['pass1']))
                echo $_POST['pass1'];?>">

                <label for="password2">Confirm Password</label>
                <input type="password" name="pass2" id="password2"
                value="<?php if (isset( $_POST['pass2']))
                echo $_POST['pass2'];?>">
            </p>
            <p>
                <input type="submit" class="register" value="Register">
            </p>    
            </p>
        </form> </div>

    </body>
</html>













