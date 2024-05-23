<?php
session_start();
include "../../../connection.php";

$disabledUserCount = null;
$approvedUserCount = null;
$pendingUserCount = null;
$allUsers = null;
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Query to get all products
    $query = "
    SELECT 
        products.*, 
        categories.name AS category_name,
        shops.shop_name
    FROM 
        products
    JOIN 
        categories ON products.product_category_id = categories.category_id
    JOIN 
        shops ON products.shop_id = shops.shop_id
    WHERE 
        shops.user_id = $userId
";

    // Execute the query
    $result = mysqli_query($con, $query);

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- My CSS -->

    <link rel="stylesheet" href="../../../css/admin.css">

    <link rel="stylesheet" href="../../../css/global.css">

    <title>Admin Dashboard</title>


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
                        <i class='bx bxl-product-hunt'></i>
                        <span class="text">Shop</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
                    <h1>Lists</h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>
            <div class="table-data" style="grid-template-columns: none;">

                <div class="order">
                    <div class="head">
                        <a href="./add.php" class="status completed btn">Add New Product</a>
                    </div>
                    <table>
                        <thead>
                            <tr>

                                <th>Product Name</th>
                                <th>Cost Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products ?? [] as $key => $product) { ?>
                                <tr>

                                    <td>
                                        <img src="../../../images/user.png">
                                        <span>
                                            <?php echo $product['product_name'] ?>
                                        </span>

                                    </td>

                                    <td>Rs. <?php echo $product['price'] ?></td>
                                    <!-- <td style="text-align: center;"><span class="Esewa">Esewa</span></td> -->
                                    <td>
                                        <?php echo $product['quantity'] ?>
                                    </td>
                                    <td>
                                        <a href="view.php?id=<?php echo ($product['product_id']) ?>"
                                            style="border: 1px solid green; padding-left:.5em; padding-right:.5em; color:green">View</a>
                                        <a href="edit.php?id=<?php echo ($product['product_id']) ?>"
                                            style="border: 1px solid blue; padding-left:.5em; padding-right:.5em; color:blue">EDIT</a>

                                    </td>


                                </tr>
                                <?php
                            }
                            ?>




                        </tbody>
                    </table>
                </div>

            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <script src="../../js/script.js"></script>
</body>

</html>