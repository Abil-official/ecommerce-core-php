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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-to-cart'])) {

    $products_id = $_POST['products_id'];

    // print_r($products_id);

    foreach ($products_id as $key => $product_id) {

        $query = "SELECT * FROM `cart_products` WHERE `user_id` = '$userID' AND `product_id` = '$product_id'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) == 0) {

            $insert = "INSERT INTO `cart_products`(`user_id`, `product_id`) 
            VALUES ('$userID','$product_id')";
            $insertQuary = mysqli_query($con, $insert);

            if (!$insertQuary) {
                header("Location: ./index.php");

                exit;
            }

            $delete = "DELETE FROM `wishlist_products` WHERE `product_id` = $product_id";
            mysqli_query($con, $delete);
        }



    }
    header("Location: ../cart/index.php");

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

    <title>Wishlists</title>

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
                    <h1 class="font-semibold text-2xl text-gray">Your Wishlists</h1>
                </div>
            </div>

            <?php
            $query = "
          SELECT 
          wishlist_products.*
          FROM 
          wishlist_products
          JOIN 
              products ON wishlist_products.product_id = products.product_id
              JOIN 
              users ON  wishlist_products.user_id = users.user_id
          WHERE 
              wishlist_products.user_id = $userID
      ";
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                echo '<form action="" method="post">';
                while ($row = mysqli_fetch_assoc($result)) {
                    $productID = $row['product_id'];

                    $query2 = "SELECT * FROM `products` WHERE `product_id`= '$productID'";
                    $result2 = mysqli_query($con, $query2);

                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $image = json_decode($row2['product_image'], true);
                        ?>
                        <div class="flex justify-center mb-4 product">
                            <div class="flex w-3/4 justify-between items-center border border-green-600 rounded-md px-4 py-3">
                                <!-- product -->
                                <div class="flex gap-6 items-center">
                                    <div class="w-[100px] h-[100px] overflow-hidden">
                                        <img src="<?php echo "../../.." . $image[0]; ?>" alt="" />
                                    </div>
                                    <div class="text-gray">
                                        <p><?php echo $row2['product_name'];?></p>
                                        <p>Price: $<span class="original_price"><?php echo $row2['price'];?></span></p>
                                    </div>
                                </div>
                                <!-- quantity -->
                                <div class="">
                                    <div class="flex gap-4 bottom-0">
                                        <div class="flex gap-1 items-center mt-2">
                                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                            <i class="fa-solid fa-star text-gray-400 text-xs"></i>
                                            <span class="text-gray-400 text-xs">(4)</span>
                                        </div>
                                        <div>
                                            <span><i class="fa-solid fa-heart text-red-600"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <form action="" method="post"> -->
                        <input type="text" value="<?php echo $row2['product_id']; ?>" name="products_id[]" class="hidden">

                        <!-- </form> -->
                        <?php

                    }
                }
                ?>
                <div class="flex justify-center mt-8 gap-4">
                    <div class="w-3/4 rounded-md">
                        <div class="w-full">
                            <button type="submit" name="add-to-cart"
                                class="bg-primary py-2 font-semibold rounded-md text-white w-full" id="add-to-cart">
                                All Add To Cart
                            </button>
                        </div>
                    </div>
                </div>

                <?php
                echo '</form>';
            } else {
                ?>
                <p class="text-red-500">Not Wishlists</p>
                <?php
            }
            ?>


            <!-- cart -->
            <!-- <div class="flex justify-center mt-8 gap-4">
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
                                <button class="bg-primary py-2 font-semibold rounded-md text-white w-full"
                                    id="add-to-cart">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="flex justify-center mt-8">
                <div class="w-3/4">
                    <a href="../../index.php" class="text-gray font-semibold"><i class="fa-solid fa-arrow-left"></i>
                        Back to home</a>
                </div>
            </div>
        </div>
        <!-- end content -->
    </div>

    <!-- {{-- footer --}} -->


    <!-- model -->
    <!-- <div
        class="w-full h-full hidden fixed px-5 py-5 bg-black bg-opacity-30 top-0 flex justify-center items-center model">
        <div class="px-3 py-3 top-0 bg-white rounded-md w-3/4">
            <div class="w-full">
                <div class="float-end close">
                    <button class="btn">X</button>
                </div>
                <h1 class="font-semibold text-xl text-center">Information</h1>
                <div class="mt-4">
                    <form action="">
                        <div class="mt-3 flex gap-4">
                            <input type="text" placeholder="First name"
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                            <input type="text" placeholder="Last name"
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>

                        <div class="mt-1">
                            <input type="email" placeholder="Email address"
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>

                        <div class="mt-1">
                            <input type="text" placeholder="Contact"
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>
                        <div class="mt-1">
                            <input type="text" placeholder="Address"
                                class="px-4 py-2 rounded-md mt-2 bg-transparent border border-gray-500 outline-none w-full" />
                        </div>

                        <button class="bg-primary font-bold text-white w-full py-2 mt-4 text-center rounded-md"
                            type="submit">
                            Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end model -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../js/carousel.js"></script>

    <!-- <script>
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
                var totalQtySet = parent.find(".t_qty");
                var originalPrice = parseInt(parent.find(".original_price").text());

                // Update the quantity and total price
                qty += 1;
                qtyElement.text(qty);

                var total = originalPrice * qty;
                totalPriceSet.text(total);
                totalQtySet.text(qty);
                updateTotals();
            });

            // Event handler for subtracting quantity
            $(".min").click(function () {
                var parent = $(this).closest(".product");
                var qtyElement = parent.find(".quantity");
                var qty = parseInt(qtyElement.text());
                var totalPriceSet = parent.find(".t_price");
                var totalQtySet = parent.find(".t_qty");
                var originalPrice = parseInt(parent.find(".original_price").text());

                if (qty > 1) {
                    qty -= 1;
                    qtyElement.text(qty);

                    var total = originalPrice * qty;
                    totalPriceSet.text(total);
                    totalQtySet.text(qty);
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
    </script> -->

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