<?php
session_start();
include "../../connection.php";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    // $query = "SELECT * FROM `products` WHERE `product_id` = $product_id";
    $query = "
    SELECT 
        products.*, 
        categories.name as category_name,
        shops.shop_name
    FROM 
        products
    JOIN 
        categories ON products.product_category_id = categories.category_id
        JOIN 
        shops ON products.shop_id = shops.shop_id
    WHERE 
        products.product_id = $product_id
";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

    } else {
        echo "No vegetable found with this ID.";
        exit;
    }
    var_dump(isset($_SESSION['user_id']));
    if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['wishlist'])) {
            $insert = "INSERT INTO `wishlist_products`(`product_id`, `user_id`) VALUES ('$product_id','$userID')";
            $query = mysqli_query($con, $insert);
            if ($query) {
                $_SESSION['message'] = "Added to wishlist";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cart'])) {
            $insert = "INSERT INTO `cart_products`(`product_id`, `user_id`) VALUES ('$product_id','$userID')";
            $query = mysqli_query($con, $insert);
            if ($query) {
                $_SESSION['message'] = "Added to cart";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../../css/landing.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style></style>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript"
        src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <!-- <img src="../../images/banner.png" alt="banner" class="banner"> -->

    <div class="row m-0 p-4">
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach (json_decode($row['product_image']) ?? [] as $key => $image) { ?>
                        <?php if ($key < 3) { ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?php echo ($key) ?>" class="active" aria-current="true"
                                aria-label="Slide 1"></button>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach (json_decode($row['product_image']) ?? [] as $key => $image) { ?>
                        <div class="carousel-item <?php if ($key == 0) {
                            echo ('active');
                        } ?>">
                            <img src="../../<?php echo ($image) ?>" class="d-block w-100" alt="...">
                        </div>

                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        <div class="col-md-6 p-5">
            <div class="row m-0">
                <div class="col-md-4">
                    <b>
                        Name
                    </b>
                </div>
                <div class="col-md-8"><?php echo ($row['product_name']) ?></div>
            </div>
            <div class="row m-0">
                <div class="col-md-4">Description</div>
                <div class="col-md-8"><?php echo ($row['product_description']) ?></div>
            </div>
            <div class="row m-0">
                <div class="col-md-4">Price</div>
                <div class="col-md-8">Rs.<?php echo ($row['price']) ?></div>
            </div>
            <div class="row m-0">
                <div class="col-md-4">Allergy Info</div>
                <div class="col-md-8"><?php echo ($row['allergy_info']) ?></div>
            </div>
            <div class="row m-0">
                <div class="col-md-4">Category</div>
                <div class="col-md-8"><?php echo ($row['category_name']) ?></div>
            </div>
            <div class="row m-0">
                <div class="col-md-4">Shop</div>
                <div class="col-md-8"><?php echo ($row['shop_name']) ?></div>
            </div>
            <div class="mt-5 ">
                <form method="POST" class="mb-2">
                    <button class="btn btn-success" type="submit" name="wishlist">Add to Wishlist</button>
                </form>
                <form method="POST">
                    <button class="btn btn-primary" type="submit" name="cart">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>


    </div>

    <!-- <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-3" id="shop">SHOPS</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button"
                        data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mb-3" href="#carouselExampleIndicators2" role="button" data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 1</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 2</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 3</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 4</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 5</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 6</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ee8417f0ea2a50d53a12665820b54e23" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 7</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532777946373-b6783242f211?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=8ac55cf3a68785643998730839663129" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 8</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280"
                                                src="https://images.unsplash.com/photo-1532763303805-529d595877c5?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=5ee4fd5d19b40f93eadb21871757eda6" />
                                            <div class="card-body">
                                                <h4 class="card-title">SHOPS 9</h4>
                                                <p class="card-text">
                                                    <button class="view">VIEW</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script type="text/javascript"></script>

</body>

</html>