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
        $query = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
            $name = $_POST['name'];
            $insert = "UPDATE categories SET name='$name' WHERE category_id=$id";
            $query = mysqli_query($con, $insert);
            header('Location:index.php');
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
                    <a href="../approval-requests.php">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">Users</span>
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
                    <h1>Update Category</h1>
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

                    <form action="" method="post" class="px-2">
                        <div class="mt-3 flex gap-4">
                            <div class="w-full">
                                <p>Name <span class="text-red-500">*</span></p>
                                <input type="text" placeholder="Category Name" name="name" value="<?php
                                echo ($category['name'])
                                    ?>"
                                    class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            </div>
                        </div>
                        <input type="submit"
                            class="bg-primary font-semibold text-white w-full py-2 mt-4 text-center rounded-md"
                            value="update" name="update">
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