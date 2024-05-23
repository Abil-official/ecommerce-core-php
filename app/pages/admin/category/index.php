<?php
session_start();
include "../../../connection.php";
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $query = "SELECT * FROM `categories`";
    // Execute the query
    $result = mysqli_query($con, $query);

    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

    <title>Categories</title>
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
                    <a href="../index.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li>
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
                <li class="active">
                    <a href="#">
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
                    <a href="../auth/log-out.php" class="logout">
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
                    <h1>Category</h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>

            <ul class="box-info" style="grid-template-columns:none">
                <li style="justify-content: center;">
                    <a href="add.php"> <span class="text text-center">
                            Add
                        </span></a>
                </li>
            </ul>


            <div class="table-data" style="grid-template-columns:none">
                <div class="order" style="width:100%">
                    <table>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($categories ?? [] as $key => $category) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $key + 1;
                                        ?>
                                    </td>
                                    <td>
                                        <p><?php echo ($category['name']) ?></p>
                                    </td>
                                    <td>

                                        <a href="edit.php?id=<?php echo ($category['category_id']) ?>"
                                            style="border:1px solid red; padding-left: .5em; padding-right: .5em; color:red">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>


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