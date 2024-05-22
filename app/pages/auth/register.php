<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include "../../connection.php"; ?>
    <link rel="stylesheet" href="../../css/registrationstyles.css">
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $register_as = $_POST['register_as'];
        $password = $_POST['password'];

        // Server-side validation to ensure no fields are null
        if (empty($first_name) || empty($last_name) || empty($email) || empty($address) || empty($age) || empty($gender) || empty($age) || empty($register_as) || empty($password)) {
            $_SESSION['error'] = "All field required!";
            header("Location: ../auth/registration.php");
            exit();
        }
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // insert data into db
        $insert = "INSERT INTO `users`(`first_name`, `last_name`, `email`,`address`,
                        `phone_no`,`age`,`gender`,`password`,`user_role`) VALUES ('$first_name','$last_name','$email',
                        '$address','$phone_number','$age','$gender','$hashed_password','$register_as')";

        $query = mysqli_query($con, $insert);
        if ($query) {
            $_SESSION['message'] = "Registered successfully! Please check your email";
            header("Location: ../auth/login.php");
            exit();
        } else {
            ?>
            <script>
                alert("Something wrong!");
            </script>
            <?php
        }

    }
    ?>
    <header>
        <div class="navigation">
            <div class="opt">

                <div class="left">
                    <img class="menu" src="../../images/list.png">
                    <img class="logo" src="../../images/TSlogo.jpg">
                </div>

                <div class="middle">
                    <div class="search">
                        <input class="searchbar" type="searchtext" placeholder="Search">
                        <img class="menu" src="../../images/search.png">
                    </div>
                </div>

                <div class="right">
                    <img class="menu" src="../../images/image.jpg">
                    <img class="menu" src="../../images/image.jpg">
                </div>

            </div>
        </div>
        <!-- Header content goes here -->
    </header>

    <main>
        <div class="register-container">
            <?php
            if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {

                echo '<h1 class="text-white px-4 py-2 bg-red-500">' . $_SESSION['error'] . '</h1>';
                unset($_SESSION['error']);
            }
            ?>
            <form id="registrationForm" method="POST">
                <h2>Register</h2>

                <div class="form-field">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="name" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-field">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" required>
                </div>
                <div class="form-field">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>
                </div>
                <div class="form-field">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" placeholder="Age" required>
                </div>
                <div class="form-field">

                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>

                    </select>
                </div>
                <div class="form-field">

                    <label for="registerAs">Register As</label>
                    <select id="register_as" name="register_as">
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="trader">Trader</option>

                    </select>
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-field">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password"
                        required>
                </div>


                <div class="form-field">
                    <label>
                        <input type="checkbox" id="terms" name="terms" required>
                        I accept the terms of users & privacy policy
                    </label>
                </div>

                <div class="form-field">
                    <button type="submit" name="register">REGISTER</button>
                </div>

                <div class="login-link">
                    Already registered? <a href="/login.html">Login</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="fsection">
                <div class="fleft">
                    about us
                </div>
                <div class="fmiddle">
                    table
                </div>
                <div class="fright">
                    contact
                </div>
            </div>
            <div class="copyright">
                @copyrights
            </div>
        </div>
        </div>
        <!-- Footer content goes here -->
    </footer>

    <script src="scripts.js"></script>
</body>

</html>