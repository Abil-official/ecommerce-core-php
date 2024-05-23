<?php
session_start();
include "../../connection.php";

$user = null;
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
        // Retrieve the ID from the URL
        $id = $_GET['id'];
        settype($id, "integer");
        // Prepare the SQL query using prepared statement
        $query = "SELECT * FROM `users` WHERE `user_id`=?";
        if ($stmt = mysqli_prepare($con, $query)) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "i", $id);
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Get result set
                $result = mysqli_stmt_get_result($stmt);

                // Fetch result as an associative array
                $user = mysqli_fetch_assoc($result);
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                    // Update query with prepared statement
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone_number'];
                    $age = $_POST['age'];
                    $gender = $_POST['gender'];
                    $role = $_POST['role'];
                    $status = $_POST['status'];

                    $insert = "UPDATE users SET first_name='$firstName',`status` = '$status',
                    `last_name`='$lastName', `address`='$address', `age`='$age',`gender`='$gender', `user_role`='$role',`address`='$address' WHERE user_id=$id";
                    $query = mysqli_query($con, $insert);

                    if ($con->query($query) === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                } else {
                    // Handle execution error
                    echo "Error executing query: " . mysqli_error($con);
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }

        } else {
            echo "ID parameter is missing in the URL";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->

    <link rel="stylesheet" href="../../css/admin">


    <title>Users</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../images/logo.jpg">
        </a>
        <ul class="side-menu ">
            <li>
                <a href="#">
                    <i class='bx bxs-home'></i>
                    <span class="text">Home</span>
                </a>
            </li>
            <ul class="side-menu top">
                <li class="">
                    <a href="#">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="traders.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Traders</span>
                    </a>
                </li>
                <li class="">
                    <a href="customers.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="category/index.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">View Order</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Edit Order</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">View all Product</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">Edit all Product</span>
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
                        <i class='bx bx-question-mark'></i>
                        <span class="text">Query</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-user-rectangle'></i>
                        <span class="text">View all Traders</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="logout">
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
                <img src="../../images/profile.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Update
                        <?php echo $user['first_name'] ?>
                    </h1>
                    <ul class="breadcrumb">
                    </ul>
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
                        value="<?php echo ($user['email']) ?>" required>
                </div>

                <div class="form-field">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address"
                        value="<?php echo ($user['address']) ?>" required>
                </div>
                <div class=" form-field">
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
                    <select id="role" name="role">
                        <option value="customer" <?php if ($user['user_role'] == 'customer') {
                            echo "selected";
                        } ?>>
                            Customer
                        </option>
                        <option value=" admin" <?php if ($user['user_role'] == 'admin') {
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

                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="approved" <?php if ($user['status'] == 'approved') {
                            echo "selected";
                        } ?>>
                            Approve
                        </option>
                        <option value="disabled" <?php if ($user['status'] == 'disabled') {
                            echo "selected";
                        } ?>>
                            Disabled
                        </option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password">
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