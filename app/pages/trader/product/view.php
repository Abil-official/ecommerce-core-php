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
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
        // Retrieve the ID from the URL
        $id = $_GET['id'];
        $query = "SELECT * FROM `products` WHERE `product_id`='$id'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            var_dump($product);
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- My CSS -->

    <link rel="stylesheet" href="../../../css/admin.css">
    <link rel="stylesheet" href="../../../css/global.css">

    <title>Add New product</title>
</head>

<body>
    <?php

    ?>
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
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">Shop</span>
                    </a>
                </li>
                <li class="active">
                    <a href="./list.php">
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
                    <h1>View <?php echo ($product['product_name']) ?? 'N/A' ?></h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>

            <div class="w-full">

                <?php

                if (isset($_SESSION['error'])) {
                    ?>

                    <h1 class="font-semibold text-xl text-center text-red-500">
                        <?php echo $_SESSION['error']; ?>
                    </h1>
                    <?php
                    unset($_SESSION['error']);
                } ?>
                <div class="mt-4">
                    <?php

                    ?>


                    <div class="mt-3 flex gap-4">
                        <div class="w-full">
                            <p>Name <span class="text-red-500">*</span></p>
                            <input type="text" 
                                value=" <?php echo ($product['product_name']) ?? 'N/A' ?>" disabled
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>
                        <div class="w-full">
                            <p>Stock Check <span class="text-red-500">*</span></p>
                            <input type="text" 
                                value=" <?php echo ($product['stock_check']) ?? 'N/A' ?>" disabled
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>
                    </div>

                    <div class="mt-3 flex gap-4">
                        <div class="w-full">
                            <p>Cost Price (per unit) <span class="text-red-500">*</span></p>
                            <input type="text" 
                                value=" <?php echo ($product['price']) ?? 'N/A' ?>" disabled
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>
                        <div class="w-full">
                            <p>Quantity <span class="text-red-500">*</span></p>
                            <input type="text" 
                                value=" <?php echo ($product['quantity']) ?? 'N/A' ?>" disabled
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>
                    </div>

                    <div class="mt-3 flex gap-4">
                        <div class="w-full">
                            <p>Category Id <span class="text-red-500">*</span></p>
                            <select name="category_id"
                                class="w-full border py-2 px-4 rounded-md text-gray outline-none border-gray-500">
                                <option value="">Category</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="w-full">
                            <p>Shop type <span class="text-red-500">*</span></p>
                            <select name="shop_type"
                                class="w-full border py-2 px-4 rounded-md text-gray outline-none border-gray-500">
                                <option value="">Shop Type</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>




                    <div class="mt-3">
                        <p>Description <span class="text-red-500">*</span></p>
                        <textarea rows="6" name="description" id=""
                            class="w-full px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none"
                            disabled
                            placeholder="Description"><?php echo ($product['product_description']) ?? 'N/A' ?></textarea>
                    </div>

                    <div class="mt-3">
                        <p>Allergy Information <span class="text-red-500">*</span></p>
                        <textarea rows="6" name="allergy_info" id=""
                            class="w-full px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none"
                            disabled
                            placeholder="Allergy Information"><?php echo ($product['allergy_info']) ?? 'N/A' ?></textarea>
                    </div>
                    <div class="mt-3 flex gap-4">

                        <div class="w-full">
                            <p>Image <span class="text-red-500">*</span></p>
                            <?php
                            foreach (json_decode(($product['product_image'])) ?? [] as $image) {
                                ?>
                                <img src="../../../<?php echo ($image) ?>" alt="" srcset=""
                                    style="height: 100px; object-fit: contain;">
                            <?php } ?>

                        </div>
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