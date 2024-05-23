<?php
session_start();
include "../../../connection.php";
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
    <?php
    $disabledUserCount = null;
    $approvedUserCount = null;
    $pendingUserCount = null;
    $allUsers = null;
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
        // Query to get the count of disabled users
        $query = "SELECT * FROM `users` WHERE `status` = 'disabled'";
        // Execute the query
        $result = mysqli_query($con, $query);
        // Fetch the count result
        $disabledUserCount = mysqli_num_rows($result);
        // Query to get the count of approved users
        $query = "SELECT * FROM `users` WHERE `status` = 'approved'";
        // Execute the query
        $result = mysqli_query($con, $query);
        // Fetch the count result
        $approvedUserCount = mysqli_num_rows($result);
        // Query to get the count of pending users
        $query = "SELECT * FROM `users` WHERE `status` = 'pending'";
        // Execute the query
        $result = mysqli_query($con, $query);
        // Fetch the count result
        $pendingUserCount = mysqli_num_rows($result);
        // Query to get all users
        $query = "SELECT * FROM `users` WHERE user_role='customer'";
        // Execute the query
        $result = mysqli_query($con, $query);

        $allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    ?>

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
                    <a href="#">
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
                    <h1>Product Lists</h1>

                </div>
            </div>

            <div class="mt-6">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                <a href="./add.php" class="btn">Add New Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center bg-transparent w-full border-collapse ">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 bg-stone-500 text-white align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        s.n
                                    </th>
                                    <th
                                        class="px-6 bg-stone-500 text-white align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        name
                                    </th>
                                    <th
                                        class="px-6 bg-stone-500 text-white align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        price
                                    </th>
                                    <th
                                        class="px-6 bg-stone-500 text-white align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        quantity
                                    </th>
                                    <th
                                        class="px-6 bg-stone-500 text-white align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = "SELECT * FROM `products`";
                                $result = mysqli_query($con, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $sn = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <th
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                <?php echo $sn++; ?>
                                            </th>
                                            <th
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                <?php echo $row['product_name']; ?>
                                            </th>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 ">
                                                <?php echo $row['price']; ?>
                                            </td>

                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                <!-- <i class="fas fa-arrow-up text-emerald-500 mr-4"></i> -->
                                                <?php echo $row['quantity']; ?>
                                            </td>

                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                <a href="./view.php?id=<?php echo $row['product_id']; ?>" class="btn"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="./edit.php?id=<?php echo $row['product_id']; ?>" class="btn"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="./delete.php?id=<?php echo $row['product_id']; ?>"
                                                    class="btn text-red-500"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7"
                                            class="border-t-0 text-center font-bold px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                            Not found
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>

                        </table>
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