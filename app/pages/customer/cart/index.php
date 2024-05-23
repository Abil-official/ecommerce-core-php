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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order'])) {
    $productIDs = $_POST['products_id'];
    $qauntities = $_POST['qauntities'];

    foreach ($productIDs as $key => $productID) {


        $query = "SELECT * FROM `products` WHERE `product_id` = '$productID'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $totalAmount = $product['price'] * $qauntities[$key];
        }

        $collection_date = date('y-m-d');
        $collection_time = date('H:i:s');
        $collection = "INSERT INTO `collection_slots`(`collection_date`, `collection_time`) 
         VALUES ('$collection_date','$collection_time')";
        mysqli_query($con, $collection);

        $collection_id = mysqli_insert_id($con);


        $totalQty = $qauntities[$key];
        $invoice_no = "inv" . rand(0, 100000);

        $order = "INSERT INTO `orders`(`order_date`, `order_quantity`, `total_amount`, `invoice_no`, `cart_id`, `collection_id`) 
         VALUES ('$collection_date','$totalQty','$totalAmount','$invoice_no','1','$collection_id')";
        mysqli_query($con, $order);

        $order_id = mysqli_insert_id($con);

        $orderProduct = "INSERT INTO `order_products`(`order_id`, `product_id`)
             VALUES ('$order_id','$productID')";
        mysqli_query($con, $orderProduct);

        $delete = "DELETE FROM `cart_products` WHERE `product_id` = $productID";
        mysqli_query($con, $delete);
    }
    header("Location: ../../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Shopping Cart</title>

    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="../../../css/global.css" />
</head>

<body class="overflow-x-hidden">
    <div class="max-auto overflow-x-hidden">

        <!-- {{-- nav-bar --}} -->


        <!-- content code write here -->
        <div class="px-6 mt-8">
            <div class="flex justify-center mb-4">
                <div class="w-3/4">
                    <h1 class="font-semibold text-2xl text-gray">Your Cart</h1>
                </div>
            </div>

            <?php
            $query = "
          SELECT 
          cart_products.*
          FROM 
          cart_products
          JOIN 
              products ON cart_products.product_id = products.product_id
              JOIN 
              users ON  cart_products.user_id = users.user_id
          WHERE 
              cart_products.user_id = $userID
      ";
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<form action='' method='post'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $productID = $row['product_id'];

                    $query2 = "SELECT * FROM `products` WHERE `product_id`= '$productID'";
                    $result2 = mysqli_query($con, $query2);

                    while ($row2 = mysqli_fetch_assoc($result2)) {

                        ?>

                        <div class="flex justify-center mb-4 product">
                            <div class="flex w-3/4 justify-between items-center border border-green-600 rounded-md px-4 py-3">
                                <!-- product -->
                                <div class="flex gap-6 items-center">
                                    <div class="w-[100px] h-[100px] overflow-hidden">
                                        <img src="/image/categories/1691421047.jpg" alt="" />
                                    </div>
                                    <div class="text-gray">
                                        <input type="text" value="<?php echo $row2['product_id']; ?>" name="products_id[]"
                                            class="hidden">
                                        <p><?php echo $row2['product_name'] ?></p>
                                        <p>Price: $<span class="original_price"><?php echo $row2['price'] ?></span></p>
                                        <p>
                                            Qty: <span class="t_qty">1</span> @ $<span
                                                class="t_price"><?php echo $row2['price'] ?></span>
                                        </p>
                                        <input type="text" value="1" name="qauntities[]" class="hidden t_qty input">
                                    </div>
                                </div>

                                <!-- quantity -->
                                <div class="">
                                    <div class="flex gap-4 bottom-0">
                                        <div>
                                            <span>Quntity</span>
                                        </div>
                                        <div class="w-[160px] h-[30px] btn rounded-[15px] flex justify-between items-center px-4">
                                            <div class="">
                                                <i class="fa-solid fa-minus text-gray text-xs cursor-pointer min"></i>
                                            </div>

                                            <div>
                                                <span class="text-xl quantity">1</span>
                                            </div>

                                            <div class="">
                                                <i class="fa-solid fa-plus text-xs cursor-pointer add"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#"><i class="fa-solid fa-trash text-red-500"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- cart -->
                <div class="flex justify-center mt-8 gap-4">
                    <div class="w-3/4 bg-green-100 p-4 rounded-md">
                        <div class="">


                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-gray">Tax</p>
                                <p>£<span id="tax">5</span></p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-gray">Sub-Total</p>
                                <p>£<span id="sub-total">0</span></p>
                            </div>
                            <div class="border-b-2 border-gray-400 mt-4 mb-2"></div>
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-gray">Total</p>
                                <p>£<span id="total">0</span></p>
                            </div>
                        </div>
                        <div class="border-b-2 border-gray-400 mt-2"></div>
                        <div class="">
                            <div class="flex gap-4 mt-8">
                                <div class="w-full">
                                    <button type="submit" class="bg-primary py-2 font-semibold rounded-md text-white w-full"
                                        id="add-to-cart" name="order">
                                        Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                echo "</form>";
            } else {
                ?>
                <div class="flex justify-center mt-8 gap-4">
                    <div class="w-3/4 bg-red-100 p-4 rounded-md">
                        <p class="text-red-500">Not Any Cart Here.</p>
                    </div>

                </div>
            </div>
            <?php
            }
            ?>




        <div class="flex justify-center mt-8">
            <div class="w-3/4">
                <a href="../../index.php" class="text-gray font-semibold"><i class="fa-solid fa-arrow-left"></i>
                    Back to cart</a>
            </div>
        </div>
    </div>
    <!-- end content -->
    </div>

    <!-- {{-- footer --}} -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../js/carousel.js"></script>

    <script>
        $(document).ready(function () {
            function updateTotals() {
                var totalSum = 0;
                $(".product").each(function () {
                    var totalPrice = parseInt($(this).find(".t_price").text());
                    totalSum += totalPrice;
                });

                $("#sub-total").text(totalSum);

                var tax = parseInt($("#tax").text());
                $("#total").text(tax + totalSum);
            }

            // Event handler for adding quantity
            $(".add").click(function () {
                // Get the closest parent container that wraps each product data
                var parent = $(this).closest(".product");

                // Find and parse the relevant data within this parent container
                var qtyElement = parent.find(".quantity");
                var qty = parseInt(qtyElement.text());
                var totalPriceSet = parent.find(".t_price");
                var totalInput = parent.find(".input");
                var totalQtySet = parent.find(".t_qty");
                var originalPrice = parseInt(parent.find(".original_price").text());

                // Update the quantity and total price
                qty += 1;
                qtyElement.text(qty);

                var total = originalPrice * qty;
                totalPriceSet.text(total);
                totalQtySet.text(qty);
                totalInput.val(qty);
                updateTotals();
            });

            // Event handler for subtracting quantity
            $(".min").click(function () {
                var parent = $(this).closest(".product");
                var qtyElement = parent.find(".quantity");
                var qty = parseInt(qtyElement.text());
                var totalPriceSet = parent.find(".t_price");
                var totalInput = parent.find(".input");
                var totalQtySet = parent.find(".t_qty");
                var originalPrice = parseInt(parent.find(".original_price").text());

                if (qty > 1) {
                    qty -= 1;
                    qtyElement.text(qty);

                    var total = originalPrice * qty;
                    totalPriceSet.text(total);
                    totalQtySet.text(qty);
                    totalInput.val(qty);
                }
                updateTotals();
            });

            updateTotals();

            // model code
            $("#add-to-cart").click(function () {
                $(".model").toggleClass("hidden");
            });

            $(".close").click(function () {
                $(".model").toggleClass("hidden");
            });
        });
    </script>

    <!-- <script>
      $(document).ready(function () {
        var qty = parseInt($(".quantity").text());
        var totalPriceSet = $(".t_price");
        var totalQtySet = $(".t_qty");
        var originalPrice = parseInt($(".original_price").text());

        $(".add").click(function () {
          qty += 1;
          $(".quantity").text(qty);

          var total = originalPrice * qty;
          totalPriceSet.text(total);
          totalQtySet.text(qty);
        });

        $(".min").click(function () {
          if (qty > 1) {
            qty -= 1;
            $(".quantity").text(qty);

            var total = originalPrice * qty;
            totalPriceSet.text(total);
            totalQtySet.text(qty);
          }
        });
      });
    </script> -->
</body>

</html>