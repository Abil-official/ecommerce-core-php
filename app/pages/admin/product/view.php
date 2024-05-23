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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    // $query = "SELECT * FROM `products` WHERE `product_id` = $product_id";
    $query = "
    SELECT 
        products.*, 
        categories.name as category_name,
        shops.shop_name
    FROM 
        products
    JOIN 
        categories ON products.product_category_id = categories.category_id
        JOIN 
        shops ON products.shop_id = shops.shop_id
    WHERE 
        products.product_id = $product_id
";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No product found with this ID.";
        exit;
    }
} else {
    echo "Invalid ID.";
    exit;
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

    <link rel="stylesheet" href="../../../css/admin">
    <link rel="stylesheet" href="../../../css/global.css">

    <title>All Product Lists</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../../images/logo.jpg">
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
                    <a href="../index.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li class="">
                    <a href="../traders.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Traders</span>
                    </a>
                </li>
                <li class="">
                    <a href="../customers.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="../category/index.php">
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
                <li class="active">
                    <a href="./index.php">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">All Product</span>
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
                <img src="../../../images/profile.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
        <div class="head-title">
                <div class="left">
                    <h1>View Product</h1>

                </div>
            </div>
            <div class="px-2 mt-6 w-full h-[405px] relative">
                <!-- <p class="text-gray text-xs">Vegetables</p> -->
                <h1 class="mt-1 text-2xl"><?php echo $row['product_name']; ?></h1>

                <!-- <div class="mt-2">
                    <p class="text-gray-400 text-xs">
                        By <span class="text-green"><?php echo $row['brand_or_producer']; ?></span>
                    </p>
                </div> -->
                <div class="mt-8 flex gap-2">

                    <?php

                    $images = json_decode($row['product_image'], true);

                    if (is_array($images)) {
                        foreach ($images as $image) {

                            ?>
                            <div class="w-[120px] h-[120px]">
                                <img src="<?php echo "../../.." . $image; ?>" alt="" class="h-full w-full" />
                            </div>
                            <?php
                        }
                    } else {
                        echo "No images.";
                    }

                    ?>


                    <!-- 
                    <div class="w-[120px] h-[120px]">
                        <img src="../image/categories/1691421065.jpg" alt="" class="h-full w-full" />
                    </div>
                    <div class="w-[120px] h-[120px]">
                        <img src="../image/categories/1691421065.jpg" alt="" class="h-full w-full" />
                    </div>
                    <div class="w-[120px] h-[120px]">
                        <img src="../image/categories/1691421065.jpg" alt="" class="h-full w-full" />
                    </div> -->
                </div>
                <div class="mt-2 flex justify-between items-center border-b-1 pb-8">
                    <!-- <p class="font-bold text-2xl">£1</p> -->
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <span>Price</span>
                    <span>Rs.<?php echo $row['price']; ?></span>
                </div>
                <!-- <div class="flex justify-between items-center">
                    <span>Selling Price</span>
                    <span><?php echo $row['selling_price']; ?></span>
                </div> -->
                <div class="flex justify-between items-center">
                    <span>Quantities</span>
                    <span><?php echo $row['quantity']; ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span>Category</span>
                    <span><?php echo $row['category_name'] ?? 'NA' ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span>Shop</span>
                    <span><?php echo $row['shop_name'] ?? 'NA' ?></span>
                </div>
                <div class="flex justify-between items-center border-b-1 pb-8">
                    <span>Stock Check</span>
                    <span><?php echo $row['stock_check']; ?></span>
                </div>


                <div class=" mt-8">
                    <span>Description</span>
                    <p class="text-gray-400">
                        <?php echo $row['product_description']; ?>
                    </p>
                </div>
                <div class=" mt-8">
                    <span>Allergy Info</span>
                    <p class="text-gray-400">
                        <?php echo $row['allergy_info']; ?>
                    </p>
                </div>
            </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>