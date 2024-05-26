<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0 20px;
        }

        .signin-form {
            background-color: #004d40;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .signin-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
            font-size: 1.8em;
        }

        .form-control {
            margin-bottom: 15px;
            flex: 1;
        }
        .form-control input {
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

        .show-password {
            display: flex;
            align-items: center;
            color: #e0f7fa;
            margin-bottom: 15px;
        }

        .show-password input {
            margin-right: 10px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="signin-form">
    <h2>Sign In</h2>
    <?php
    session_start();
    if (isset($_SESSION['errors'])) {
        echo '<div class="error">';
        foreach ($_SESSION['errors'] as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
        unset($_SESSION['errors']);
    }
    ?>
<form id="signin-form" action="server.php" method="post">
        <input type="hidden" name="action" value="login_user">
        <div class="form-control">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-control">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="show-password">
            <input type="checkbox" id="show-password-checkbox">
            <label for="show-password-checkbox">Show Password</label>
        </div>
        <div class="form-control">
            <button type="submit">Sign In</button>
        </div>
    </form>
    <div class="login-link">
        Don't have an account? <a href="register.php">Sign up here</a>
    </div>
</div>

<script>
    document.getElementById('show-password-checkbox').addEventListener('change', function() {
        var passwordField = document.getElementById('password');
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
</script>

</body>
</html>
