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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profile_update'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['phone_no'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Server-side validation to ensure no fields are null
    if (empty($first_name) || empty($last_name) || empty($address) || empty($contact) || empty($age) || empty($gender)) {
        $_SESSION['error'] = "All field required!";
        header("Location: ./edit.php");
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
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- My CSS -->

    <link rel="stylesheet" href="../../../css/admin">

    <title>Edit Profile</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../../images/logo.jpg">
        </a>
        <ul class="side-menu">
            <div class="profile-logo">
                <img src="../../../images/profile.png" alt="Profile">
            </div>
            <li>
                <a href="#">
                    <span class="text"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></span>
                </a>
            </li>
        </ul>
        <ul class="side-menu top">
            <li class="">
                <a href="../dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="./view.php">
                    <i class='bx bx-user-circle'></i>
                    <span class="text">My Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Order</span>
                </a>
            </li>
            <li>
                <a href="../../../logout.php" class="logout">
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
                    <h1>Edit Profile</h1>
                    <!-- <ul class="breadcrumb">
                        <h2>Hi (<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>) !</h2>
                    </ul> -->

                </div>
            </div>


            <div class="col-lg-12">
                <div class="card mb-4 p-4">
                    <?php
                    if (isset($_SESSION['error']) || !empty($_SESSION['error'])) {
                        echo '<p class="text-danger">' . $_SESSION['error'] . '</p class="text-danger">';
                        unset($_SESSION['error']);
                    }
                    ?>
                    <!-- <p class="text-danger">Edit Profile</p class="text-danger"> -->
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <label>First Name</label>
                                <input type="text" value="<?php echo $user['first_name']; ?>" class="form-control"
                                    placeholder="Enter first name" name="first_name">
                            </div>
                            <div class="col">
                                <label>Last Name</label>
                                <input type="text" value="<?php echo $user['last_name']; ?>" class="form-control"
                                    placeholder="Enter last name" name="last_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Gender</label>
                                <!-- <input type="text" value="<?php echo $user['gender']; ?>" class="form-control"
                                    placeholder="Enter first name" name="gender"> -->
                                <select class="form-select" name="gender">
                                    <option value="male" <?php echo $user['gender'] == 'm' ? 'selected' : ''; ?>>Male
                                    </option>
                                    <option value="female" <?php echo $user['gender'] == 'f' ? 'selected' : ''; ?>>Female
                                    </option>
                                    <option value="other" <?php echo $user['gender'] == 'o' ? 'selected' : ''; ?>>Other
                                    </option>
                                </select>


                                </select>
                            </div>
                            <div class="col">
                                <label>Age</label>
                                <input type="text" value="<?php echo $user['age']; ?>" class="form-control"
                                    placeholder="Enter last name" name="age">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Phone No.</label>
                                <input type="text" value="<?php echo $user['phone_no']; ?>" class="form-control"
                                    placeholder="Enter first name" name="phone_no">
                            </div>
                            <div class="col">
                                <label>Address</label>
                                <input type="text" value="<?php echo $user['address']; ?>" class="form-control"
                                    placeholder="Enter last name" name="address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Old Password</label>
                                <input type="password" class="form-control" placeholder="....................."
                                    name="old_password">
                            </div>
                            <div class="col">
                                <label>New Password</label>
                                <input type="password" class="form-control" placeholder="......................."
                                    name="new_password">
                            </div>
                        </div>
                        <div>
                            <button type="submit" name="profile_update" class="btn btn-success">Update Profile</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- <div>
                <a href="#" class="btn btn-primary">Edit Profile</a>
            </div> -->
        </main>


        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="script.js"></script>
</body>

</html>