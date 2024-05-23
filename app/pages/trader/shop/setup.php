<?php
session_start();
include "../../../connection.php";
$userId = null;
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM `shops` WHERE `user_id`=$userId";
    $result = mysqli_query($con, $query);
    $shop = mysqli_fetch_assoc($result);
    if ($shop) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            if (empty($name) || empty($address) || empty($type) || empty($description)) {
                $_SESSION['error'] = "All field required!";
            }
            $insert = "UPDATE  `shops` SET shop_name='$name', `shop_address`='$address',`shop_type`='$type',`shop_description`='$description' 
            WHERE user_id=$userId";
            $query = mysqli_query($con, $insert);

        }
    } else {
        echo ($_SERVER["REQUEST_METHOD"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {

            $name = $_POST['name'];
            $address = $_POST['address'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            if (empty($name) || empty($address) || empty($type) || empty($description)) {
                $_SESSION['error'] = "All field required!";
            }
            $insert = "INSERT INTO `shops`(`shop_name`, `shop_address`, `shop_type`,`shop_description`, `user_id`)
             VALUES
              ('$name','$address','$type','$description','$userId')";
            $query = mysqli_query($con, $insert);
            if ($query) {
                $_SESSION['message'] = "Shop added successfully!";
            }
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

    <link rel="stylesheet" href="../../../css/admin">

    <title>Shop SetUp</title>
</head>

<body>
    <?php

    ?>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../../images//logo.jpg">
        </a>
        <ul class="side-menu ">
            <ul class="side-menu top">
                <li>
                    <a href="">
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
                <li class="active">
                    <a href="index.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Shop</span>
                    </a>
                </li>
                <li class="">
					<a href="../profile/view.php">
						<i class='bx bxs-dashboard'></i>
						<span class="text">Profile</span>
					</a>
				</li>
                <li>
                    <a href="../product/view.php">
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
                <img src="../../../images//profile.png">
            </a>
        </nav>
        <!-- NAVBAR -->
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Shop SetUp</h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>
            <form id="shop" method="POST">

                <div class="form-field">
                    <label for="name"> Name</label>
                    <input type="text" id="name" name="name" placeholder="Shop Name" value="<?php
                    echo ($shop['shop_name'] ?? null)
                        ?>" required>
                </div>
                <div class="form-field">
                    <label for="address"> Address</label>
                    <input type="text" id="address" name="address" placeholder="Shop Address" value="<?php
                    echo ($shop['shop_address'] ?? null)
                        ?>" required>
                </div>


                <div class="form-field">
                    <label for="type"> Type</label>
                    <input type="text" id="type" name="type" placeholder="Shop Type" value="<?php
                    echo ($shop['shop_type'] ?? null)
                        ?>" required>
                </div>
                <div class=" form-field">
                    <label for="description"> Description</label>
                    <input type="text" id="description" name="description" placeholder="Shop Description" value="<?php
                    echo ($shop['shop_description'] ?? null)
                        ?>" required>
                </div>
                <div class="form-field">
                    <button type="submit" name="save">Save</button>
                </div>


            </form>




        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>