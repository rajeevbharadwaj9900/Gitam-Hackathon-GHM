<?php
session_start();

// initializing variables
$first_name = "";
$last_name = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project1');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $terms = isset($_POST['terms']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($first_name)) { array_push($errors, "First name is required"); }
  if (empty($last_name)) { array_push($errors, "Last name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }
  if (!$terms) {
    array_push($errors, "You must accept the terms and conditions");
  }

  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO users (first_name, last_name, email, password) 
              VALUES('$first_name', '$last_name', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $first_name; // or use email, if preferred
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  } else {
    $_SESSION['errors'] = $errors;
    header('location: register.php');
  }
}
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$errors = [];

if (isset($_POST['action']) && $_POST['action'] === 'login_user') {
    $db = mysqli_connect('localhost', 'root', '', 'project2'); // Update with your actual database name

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password); // Ensure your passwords are stored using md5 or another hashing method
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: landing_page.html'); // Redirect to landing_page.html upon successful login
            exit(); // Ensure no further code is executed after redirect
        } else {
            array_push($errors, "Wrong email/password combination");
        }
    }

    $_SESSION['errors'] = $errors;
    header('location: login.php');
    exit();
}
?>