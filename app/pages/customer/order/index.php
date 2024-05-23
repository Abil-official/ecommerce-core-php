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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- My CSS -->

    <link rel="stylesheet" href="../../../css/admin.css">

    <title>Profile</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="../../../images/logo.jpg">
        </a>
        <ul class="side-menu">
            <div class="profile-logo">
                <img src="../../../images/profile.png" alt="Profile">
            </div>
            <li>
                <a href="#">
                    <span class="text"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></span>
                </a>
            </li>
        </ul>
        <ul class="side-menu top">
            <li class="">
                <a href="../dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../profile/view.php">
                    <i class='bx bx-user-circle'></i>
                    <span class="text">My Profile</span>
                </a>
            </li>
            <li class="active">
                <a href="">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Order</span>
                </a>
            </li>
            <li>
                <a href="../../../logout.php" class="logout">
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
                    <h1>My Order</h1>
                </div>
            </div>

            <div class="table-data" style="grid-template-columns: none;">
                <div class="order">
                    <div class="head">
                        <h3></h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Quantity</th>
                                <th>Totat Amount </th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM `orders` WHERE `user_id` = '$userID'";
                            $result = mysqli_query($con, $query);
                            if ($result && mysqli_num_rows($result) > 0) {
                                // echo "<form action='' method='post'>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $row['invoice_no'] ?></td>
                                        <td><?php echo $row['total_amount'] ?></td>
                                        <td><?php echo $row['order_quantity'] ?></td>
                                        <!-- <td style="text-align: center;"><span class="Esewa">Esewa</span></td> -->
                                        <td><span class="status approved"><?php echo $row['order_date'] ?></span>
                                        </td>


                                    </tr>

                                    <?php
                                }
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



    <script src="script.js"></script>
</body>

</html>