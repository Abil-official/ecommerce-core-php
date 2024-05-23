<?php

include "../../../connection.php";

session_start();

if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    $categories = null;
    $shops = null;
    $query = "SELECT * FROM `users` WHERE `user_id` = '$userID'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['status'] == 'pending') {
            header("Location: ../../auth/login.php");

            exit;
        }
        $categoryQuery = "SELECT * FROM `categories`";
        $categoryQueryResult = mysqli_query($con, $categoryQuery);
        if ($categoryQueryResult && mysqli_num_rows($categoryQueryResult) > 0) {
            $categories = mysqli_fetch_all($categoryQueryResult, MYSQLI_ASSOC);
        }
        $shopQuery = "SELECT * FROM `shops` WHERE `user_id` = '$userID'";
        $shopQueryResult = mysqli_query($con, $shopQuery);
        if ($shopQueryResult && mysqli_num_rows($shopQueryResult) > 0) {
            $shops = mysqli_fetch_all($shopQueryResult, MYSQLI_ASSOC);
        }
       
    }
} else {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $stock_check = mysqli_real_escape_string($con, $_POST['stock_check']);
    $price = floatval($_POST['price']);
    $product_category_id = intval($_POST['category_id']);
    $quantity = intval($_POST['quantity']);
    $product_image = json_encode($_POST['images'] ?? [""]);
    $shop_id = $_POST['shop_type'];
    $allergy_info = mysqli_real_escape_string($con, $_POST['allergy_info']);
    $product_description = mysqli_real_escape_string($con, $_POST['description']);


    if (empty($product_name) || empty($stock_check) || empty($price) || empty($product_category_id) || empty($quantity) || empty($product_image) || empty($shop_id) || empty($allergy_info) || empty($product_description)) {
        $_SESSION['error'] = "All field required.";

        header("Location: ./add.php");
        exit;
    }

    if (!empty($_FILES['images']['name'][0])) {
        $targetDir = "../../../images/products/uploads/";
        $uploadedFiles = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            $savePath = "/images/products/uploads/" . $fileName;
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $uploadedFiles[] = $savePath;
            }
        }

        $product_image = json_encode($uploadedFiles);
    }

    // insert data into db
    $insert = "INSERT INTO `products`(`product_name`, `product_description`, `price`, `quantity`, `stock_check`, `allergy_info`, `product_image`, `product_category_id`, `shop_id`) 
    VALUES ('$product_name','$product_description','$price','$quantity','$stock_check','$allergy_info','$product_image','$product_category_id','$shop_id')";

    $query = mysqli_query($con, $insert);
    if ($query) {
        $_SESSION['message'] = "Created Successfully";
        header("Location: ./list.php");
        exit();
    } else {
        echo '<script>alert("Something went wrong!");</script>';
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
                    <a href="../profile/view.php">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">Profile</span>
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
                    <h1>Add New Product</h1>
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

                    <form action="" method="post" class="px-2" enctype="multipart/form-data">
                        <div class="mt-3 flex gap-4">
                            <div class="w-full">
                                <p>Name <span class="text-red-500">*</span></p>
                                <input type="text" placeholder="Carrot" name="product_name"
                                    class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                            <div class="w-full">
                                <p>Stock Check <span class="text-red-500">*</span></p>
                                <input type="number" placeholder="Stock Check" name="stock_check"
                                    class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                        </div>

                        <div class="mt-3 flex gap-4">
                            <div class="w-full">
                                <p>Cost Price (per unit) <span class="text-red-500">*</span></p>
                                <input type="number" placeholder="47" name="price"
                                    class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                            <div class="w-full">
                                <p>Quantity <span class="text-red-500">*</span></p>
                                <input type="text" placeholder="Quantity/Stock Level" name="quantity"
                                    class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                        </div>

                        <div class="mt-3 flex gap-4">
                            <div class="w-full">
                                <p>Category Id <span class="text-red-500">*</span></p>
                                <select name="category_id"
                                    class="w-full border py-2 px-4 rounded-md text-gray outline-none border-gray-500">
                                    <?php
                                    foreach ($categories ?? [] as $category) {
                                        ?>
                                        <option value="<?php echo ($category['category_id']) ?>">
                                            <?php echo ($category['name']) ?>
                                        </option>
                                    <?php } ?>


                                </select>
                            </div>

                            <div class="w-full">
                                <p>Shop <span class="text-red-500">*</span></p>
                                <select name="shop_type"
                                    class="w-full border py-2 px-4 rounded-md text-gray outline-none border-gray-500">
                                    <?php
                                    foreach ($shops ?? [] as $shop) {
                                        ?>
                                        <option value="<?php echo ($shop['shop_id']) ?>"><?php echo ($shop['shop_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 flex gap-4">

                            <div class="w-full">
                                <p>Image <span class="text-red-500">*</span></p>
                                <input type="file" name="images[]" multiple
                                    class="px-4 py-1 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                        </div>


                        <div class="mt-3">
                            <p>Description <span class="text-red-500">*</span></p>
                            <textarea rows="6" name="description" id=""
                                class="w-full px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none"
                                placeholder="Description"></textarea>
                        </div>

                        <div class="mt-3">
                            <p>Allergy Information <span class="text-red-500">*</span></p>
                            <textarea rows="6" name="allergy_info" id=""
                                class="w-full px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none"
                                placeholder="Allergy Information"></textarea>
                        </div>



                        <input type="submit"
                            class="bg-primary font-semibold text-white w-full py-2 mt-4 text-center rounded-md"
                            value="Add New Product" name="submit">
                        </input>
                    </form>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>