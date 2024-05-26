<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0 20px;
        }

        .main-heading {
            color: #00695c;
            text-align: center;
            font-size: 2.5em;
            margin: 0;
        }

        .subheading {
            color: #004d40;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .register-form {
            background-color: #004d40;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
            font-size: 1.8em;
        }

        .form-control {
            margin-bottom: 15px;
            flex: 1;
        }

        .form-control input, .form-control checkbox {
            width: 100%;
            padding: 12px;
            border: 1px solid #1da58f;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
        }

        .form-control button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background-color: #1b927e;
            color: #e0f7fa;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .form-control button:hover {
            background-color: #00796b;
        }

        .login-link {
            text-align: center;
            color: #e0f7fa;
            margin-top: 15px;
        }

        .login-link a {
            color: #b2dfdb;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <h1 class="main-heading">GITAM HEIRLOOM MARKET</h1>
    <h3 class="subheading">Sell/Buy university-coded products of your choice</h3>

    <div class="register-form">
        <h2>Register</h2>
        <form method="post" action="register.php">
            <?php include('errors.php'); ?>
            <div class="form-control">
                <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="form-control">
                <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="form-control">
                <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-control">
                <input type="password" name="password_1" placeholder="Password" required>
            </div>
            <div class="form-control">
                <input type="password" name="password_2" placeholder="Confirm Password" required>
            </div>
            <div class="form-control">
                <input type="checkbox" name="terms" required> I accept the <a href="#">Terms of Use & Privacy Policy</a>
            </div>
            <div class="form-control">
                <button type="submit" class="btn" name="reg_user">Sign Up</button>
            </div>
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>