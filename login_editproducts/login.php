<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginstyle.css">
    <?php include "../connection.php"; ?>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['message'] = "Login successful!";
                header("Location: ../pages/dashboard.php");

                // echo "Welcome to dashboard!" . $user['first_name'];
                exit();
            } else {
                $_SESSION['error'] = "Invalid username or password!";
            }
        } else {
            echo "NOT FOUND";
            $_SESSION['error'] = "Invalid username or password!";
        }

        header("Location: sign-in.php");
        exit();
    }
    ?>
    <header>
        <div class="navigation">
            <div class="opt">
                <div class="left">
                    <img class="menu" src="images/list.png">
                    <img class="logo" src="images/TSlogo.jpg"> <!-- Fixed backslash in the path -->
                </div>

                <div class="middle">
                    <div class="search">
                        <input class="searchbar" type="search" placeholder="Search"> <!-- Changed type to "search" -->
                        <img class="menu" src="images/search.png">
                    </div>
                </div>

                <div class="right">
                    <img class="menu" src="images/image.jpg">
                    <img class="menu" src="images/image.jpg">
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="login-container">
            <form id="loginForm" action="/login-endpoint" method="post">
                <h2>Login</h2>

                <div class="form-field">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-options">
                    <div style="display: flex; justify-content: flex-end; width: 100%;">
                        <label for="rememberMe" style="margin-right: 20px;">
                            <input type="checkbox" id="rememberMe" name="remember_me"> Remember me
                        </label>
                        <a href="/forgot-password" class="forgot-password">Forgot your password?</a>
                    </div>
                </div>

                <div class="form-field" style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="button" name="login">Login</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="fsection">
                <div class="fleft">
                    About us
                </div>
                <div class="fmiddle">
                    Table
                </div>
                <div class="fright">
                    Contact
                </div>
            </div>
            <div class="copyright">
                © 2024 All rights reserved.
            </div>
        </div>
    </footer>

    <script src="scripts.js"></script>
</body>

</html>