<?php
include "../../connection.php";
session_start();
if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
	$userID = $_SESSION['user_id'];

	$query = "SELECT * FROM `users` WHERE `user_id` = '$userID'";
	$result = mysqli_query($con, $query);
	if ($result && mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		if ($user['status'] == 'pending') {
			header("Location: ../auth/login.php");

			exit;
		}
	}

} else {
	header("Location: ../auth/login.php");
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

	<link rel="stylesheet" href="../../css/admin.css">

	<title>Trader Dashboard</title>
</head>

<body>
	<?php

	?>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="../../images/logo.jpg">
		</a>
		<ul class="side-menu ">
			<ul class="side-menu top">
				<li>
					<a href="#">
						<i class='bx bxs-home'></i>
						<span class="text">Home</span>
					</a>
				</li>
				<li class="active">
					<a href="#">
						<i class='bx bxs-dashboard'></i>
						<span class="text">Dashboard</span>
					</a>
				</li>
				<li class="">
					<a href="./profile/view.php">
						<i class='bx bxl-product-hunt'></i>
						<span class="text">Profile</span>
					</a>
				</li>
				<li>
					<a href="shop/index.php">
						<i class='bx bxs-dashboard'></i>
						<span class="text">Shop</span>
					</a>
				</li>
				<li>
					<a href="./product/index.php">
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
                <a href="../auth/logout.php" class="logout">
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
					<h1>Trader Dashboard</h1>
					<ul class="breadcrumb">
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>10</h3>
						<p>Total Products</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Orders</h3>
					</div>
					<table>
						<thead>
							<tr>

								<th>Date Order</th>
								<th>Payment </th>
								<th>Order Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<td>03-10-2024</td>
								<td style="text-align: center;"><span class="Esewa">Esewa</span></td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>

								<td>03-10-2024</td>
								<td style="text-align: center;"><span class="Esewa">Esewa</span></td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>

								<td>03-10-2024</td>
								<td style="text-align: center;"><span class="Esewa">Esewa</span></td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>

								<td>03-10-2024</td>
								<td style="text-align: center;"><span class="Esewa">Esewa</span></td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>

								<td>03-10-2024</td>
								<td style="text-align: center;"><span class="Esewa">Esewa</span></td>
								<td><span class="status completed">Completed</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>My Customers</h3>
						<i class='bx bx-plus'></i>
						<i class='bx bx-filter'></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Aseena Subedi</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Riya Stha</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Simran Stha</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Anshu Kharel</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Preshna Adhikari</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->



	<script src="../../js/script.js"></script>
</body>

</html>