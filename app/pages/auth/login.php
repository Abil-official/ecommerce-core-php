<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../../css/loginstyle">

    <?php include "../../connection.php"; ?>
</head>

<body>
    <?php
    /* The code `if (["REQUEST_METHOD"] == "POST" && isset(['login'])) {` is checking if
    the current request method is POST and if a form input field with the name 'login' exists in the
    submitted form data. */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {


        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {

                if ($user['status'] == 'disabled') {
                    $_SESSION['error'] = "Profile under review";
                    header("Location: ../auth/login.php");
                }
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['user_role'];
                $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['phone'] = $user['phone_no'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['age'] = $user['age'];

                if ($user['status'] == 'disabled') {
                    $_SESSION['message'] = "Account is " . $user['status'];

                    exit();

                }

                $_SESSION['message'] = "Login successful!";
                switch ($user['user_role']) {
                    case 'admin':
                        header("Location: ../admin/index.php");
                        break;
                    case 'trader':
                        header("Location: ../trader/dashboard.php");
                        break;
                    default:
                        header("Location: ../home/index.php");
                        break;
                }


                // echo "Welcome to dashboard!" . $user['first_name'];
                exit();
            } else {
                $_SESSION['error'] = "Invalid username or password!";
            }
        } else {
            echo "NOT FOUND";
            $_SESSION['error'] = "Invalid username or password!";
        }
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: ../auth/login.php");
        exit();
    }
    ?>
    <header>
        <div class="navigation">
            <div class="opt">
                <div class="left">
                    <img class="menu" src="../../images/list.png">
                    <img class="logo" src="../../images/TSlogo.jpg"> <!-- Fixed backslash in the path -->
                </div>

                <div class="middle">
                    <div class="search">
                        <input class="searchbar" type="search" placeholder="Search"> <!-- Changed type to "search" -->
                        <img class="menu" src="../../images/search.png">
                    </div>
                </div>

                <div class="right">
                    <img class="menu" src="../../images/image.jpg">
                    <img class="menu" src="../../images/image.jpg">
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="login-container">
            <form id="loginForm" method="post">
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
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
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