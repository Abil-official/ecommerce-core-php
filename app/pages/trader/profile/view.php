<?php
include "../../../connection.php";

session_start();

if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    $query = "SELECT * FROM `users` WHERE `user_id` = '$userID'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['status'] == 'pending') {
            header("Location: ../../auth/login.php");

            exit;
        }
    }

} else {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['phone_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Server-side validation to ensure no fields are null
    if (empty($first_name) || empty($last_name) || empty($address) || empty($contact) || empty($age) || empty($gender)) {
        $_SESSION['error'] = "All field required!";
        header("Location: ./view.php");
        exit;
    }

    $email = $user['email'];

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $update_query = "UPDATE `users` SET 
        `first_name` = '$first_name',
        `last_name` = '$last_name',
        `phone_no` = '$contact',
        `address` = '$address',
        `gender` = '$gender', 
        `age` = '$age'";

        if (password_verify($old_password, $user['password'])) {
            if (!empty($new_password)) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query .= ", `password` = '$hashed_new_password'";
            }
        } else {
            $_SESSION['message'] = "Invalid old password!";
        }
    } else {
        $_SESSION['message'] = "User not found!";
    }
    $update_query .= " WHERE `email` = '$email'";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: ./view.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile!";
    }
    ;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- My CSS -->

    <link rel="stylesheet" href="../../../css/admin.css">

    <link rel="stylesheet" href="../../../css/global.css">

    <title>Trader Profile</title>


</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../../images/logo.jpg">
        </a>
        <ul class="side-menu ">
            <ul class="side-menu top">
                <li>
                    <a href="#">
                        <i class='bx bxs-home'></i>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="">
                    <a href="../dashboard.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="../shop/index.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Shop</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li class="">
                    <a href="../product/index.php">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">Product</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Order</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-credit-card-alt'></i>
                        <span class="text">Payment</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-comment-add'></i>
                        <span class="text">Review</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                <a href="../../auth/logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
            </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>

            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <a href="#" class="Cart">
                <i class='bx bxs-cart bx-md'></i>

                <span class="num">3</span>
            </a>
            <a href="#" class="profile">
                <img src="../../../images/profile.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Update <?php echo $user['first_name'] ?></h1>
                    <?php
                    if (isset($_SESSION['error']) || !empty($_SESSION['error'])) {
                        echo '<p class="text-danger">' . $_SESSION['error'] . '</p class="text-danger">';
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
            </div>
            <form id="registrationForm" method="POST">


                <div class="form-field">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name"
                        value="<?php echo ($user['first_name']) ?>" required>
                </div>
                <div class="form-field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="name" name="last_name" placeholder="Last Name"
                        value="<?php echo ($user['last_name']) ?>" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email"
                        value="<?php echo ($user['email']) ?>" required disabled>
                </div>

                <div class="form-field">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address"
                        value="<?php echo ($user['address']) ?>" required>
                </div>
                <div class="form-field">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number"
                        value="<?php echo ($user['phone_no']) ?>" required>
                </div>
                <div class="form-field">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" placeholder="Age" value="<?php echo ($user['age']) ?>"
                        required>
                </div>
                <div class="form-field">

                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="m" <?php if ($user['gender'] == 'm') {
                            echo "selected";
                        } ?>>Male</option>
                        <option value="f" <?php if ($user['gender'] == 'f') {
                            echo "selected";
                        } ?>>Female
                        </option>
                        <option value="o" <?php if ($user['gender'] == 'o') {
                            echo "selected";
                        } ?>>Other</option>


                    </select>

                </div>
                <div class="form-field">

                    <label for="role"> Role</label>
                    <select id="role" name="role" disabled>
                        <option value="customer" <?php if ($user['user_role'] == 'customer') {
                            echo "selected";
                        } ?>>
                            Customer
                        </option>
                        <option value="admin" <?php if ($user['user_role'] == 'admin') {
                            echo "selected";
                        } ?>>
                            Admin
                        </option>
                        <option value="trader" <?php if ($user['user_role'] == 'trader') {
                            echo "selected";
                        } ?>>
                            Trader
                        </option>
                    </select>

                </div>


                <div class="form-field">
                    <label for="password">Old Password</label>
                    <input type="password" id="password" name="old_password" placeholder="Password">
                </div>

                <div class="form-field">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="new_password" placeholder="Password">
                </div>

                <div class="form-field">
                    <button type="submit" name="update">Update</button>
                </div>


            </form>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>