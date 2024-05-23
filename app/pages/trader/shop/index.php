<?php

include "../../../connection.php";

session_start();

if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    $categories = null;
    $query = "SELECT * FROM `users` WHERE `user_id` = '$userID'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['status'] == 'pending') {
            header("Location: ../../auth/login.php");

            exit;
        }
        $shopQuery = "SELECT * FROM `shops`Where user_id=$userID";
        $shopQueryResult = mysqli_query($con, $shopQuery);

        if ($shopQueryResult && mysqli_num_rows($shopQueryResult) > 0) {
            $shop = mysqli_fetch_assoc($shopQueryResult);

        }

    }
} else {
    header("Location: ../../auth/login.php");
    exit;
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

    <title>Trader Dashboard</title>
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
                    <a href="#">
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
                    <a href="../product/list.php">
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
                    <h1>Trader Dashboard</h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <a class="btn btn-primary" href="setup.php" role="button"
                        style="width: 100%; text-align: center">SetUp Shop</a>

                    <!-- <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>$25431</h3>
                        <p>Total Sales</p>
                    </span> -->
                </li>

            </ul>


            <div class="table-data" style="grid-template-columns:none">
                <div class="order">
                    <h3>Shop Details</h3>
                    <p>
                        <b>
                            Name :
                        </b>
                        <?php echo $shop['shop_name'] ?? 'NA' ?>
                    </p>
                    <p>
                        <b>Address :</b>
                        <?php echo $shop['shop_address'] ?? 'NA' ?>
                    </p>

                    <p>
                        <b> Description :</b>
                        <?php echo $shop['shop_description'] ?? 'NA' ?>
                    </p>
                    <p>
                        <b>
                            Type :
                        </b>
                        <?php echo $shop['shop_type'] ?? 'NA' ?>
                    </p>



                </div>

            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>