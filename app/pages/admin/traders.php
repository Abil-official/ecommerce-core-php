<?php
session_start();
include "../../connection.php";
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
    <?php
    $disabledUserCount = null;
    $approvedUserCount = null;
    $pendingUserCount = null;
    $allUsers = null;
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
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
        $query = "SELECT * FROM `users` WHERE user_role='trader'";
        // Execute the query
        $result = mysqli_query($con, $query);

        $allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    ?>

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
                    <a href="index.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li class="active">
                    <a href="#">
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
                    <h1>Users</h1>
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>

            <ul class="box-info">

                <li>
                    <i class='bx bx-user-circle'></i>
                    <span class="text">
                        <h3><?php echo ($approvedUserCount) ?></h3>
                        <p>Approved</p>
                    </span>
                </li>

                <li>
                    <i class='bx bx-user-circle'></i>
                    <span class="text">
                        <h3><?php echo ($disabledUserCount) ?></h3>
                        <p>Disabled</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-user-circle'></i>
                    <span class="text">
                        <h3><?php
                        echo ($pendingUserCount)
                            ?></h3>
                        <p>Pending</p>
                    </span>
                </li>
            </ul>


            <div class="table-data" style="grid-template-columns: none;">
                <div class="order">
                    <div class="head">
                        <h3></h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>User Type </th>
                                <th>Approval Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($allUsers ?? [] as $user) {
                                ?>

                                <tr>

                                    <td>
                                        <img src="../../images/user.png">
                                        <a href="edit-request.php?id=<?php echo ($user['user_id']) ?>">
                                            <p><?php echo ($user['first_name'] . ' ' . $user['last_name']) ?></p>
                                        </a>
                                    </td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['user_role'] ?></td>
                                    <!-- <td style="text-align: center;"><span class="Esewa">Esewa</span></td> -->
                                    <td><span
                                            class="status <?php echo $user['status'] ?>"><?php echo $user['status'] ?></span>
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