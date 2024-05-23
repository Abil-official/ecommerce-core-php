<?php

include "../connection.php";
$query = "SELECT * FROM `products`";
// Execute the query
$result = mysqli_query($con, $query);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/landing.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <style></style>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>

</head>

<body>
    <img src="../images/banner.png" alt="banner" class="banner">

    <!-- Shopa -->
    <section class="pt-5 pb-5">
        <div class="container">

            <div class="d-flex justify-content-center">
            <h3 class="mb-3 text-center py-1 text-white px-5" style="background-color: #D1BB9E;">SHOPS</h3>
            </div>
            
             <div class="row">
                <!-- Control -->

                <!-- slider -->
                <div class="col-12">
                    <div class=" text-right">
                        <a class="btn btn-text-secondary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-text-secondary mb-3" href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel--111111">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="card" style="background-color: #D1BB9E;">
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d" />
                                            <div class="card-body py-4">
                                                <h4 class="card-title" style="font-size: 18px;">SHOPS 1</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae obcaecati molestias sit reiciendis accusantium ab tenetur assumenda qui officiis consectetur?</p>
                                                <div class="read-more text-center">
                                                    <button class="view border-0 text-white" style="background-color: #A79277;">VIEW</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card" style="background-color: #D1BB9E;">
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d" />
                                            <div class="card-body py-4">
                                                <h4 class="card-title" style="font-size: 18px;">SHOPS 1</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae obcaecati molestias sit reiciendis accusantium ab tenetur assumenda qui officiis consectetur?</p>
                                                <div class="read-more text-center">
                                                    <button class="view border-0 text-white" style="background-color: #A79277;">VIEW</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card" style="background-color: #D1BB9E;">
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d" />
                                            <div class="card-body py-4">
                                                <h4 class="card-title" style="font-size: 18px;">SHOPS 1</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae obcaecati molestias sit reiciendis accusantium ab tenetur assumenda qui officiis consectetur?</p>
                                                <div class="read-more text-center">
                                                    <button class="view border-0 text-white" style="background-color: #A79277;">VIEW</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card" style="background-color: #D1BB9E;">
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d" />
                                            <div class="card-body py-4">
                                                <h4 class="card-title" style="font-size: 18px;">SHOPS 1</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae obcaecati molestias sit reiciendis accusantium ab tenetur assumenda qui officiis consectetur?</p>
                                                <div class="read-more text-center">
                                                    <button class="view border-0 text-white" style="background-color: #A79277;">VIEW</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4" />
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
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840" />
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
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e" />
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
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ee8417f0ea2a50d53a12665820b54e23" />
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
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532777946373-b6783242f211?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=8ac55cf3a68785643998730839663129" />
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
                                            <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532763303805-529d595877c5?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=5ee4fd5d19b40f93eadb21871757eda6" />
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
    </section>

    <!-- Shops -->
    <div class="shop best">
        <div class="seller">Products</div>
        <div class="row">
            <?php
            foreach ($products ?? [] as $product) {
            ?>
                <div class="col-md-4">
                    <a href="products/view.php?id=<?php echo ($product['product_id']) ?>">
                        <div class="card mb-3">
                            <?php
                            $product_images = json_decode($product['product_image']) ?? [];
                            foreach ($product_images ?? [] as $key => $image) {
                                // Construct the image URL
                                $image_url = '../' . htmlspecialchars($image);
                            ?>
                                <img src="<?php echo $image_url; ?>" class="card-img-top" alt="Product Image">
                                <?php break; // Stop the loop after the first iteration 
                                ?>
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($product['product_name']) ?> </h5>
                                <p class="card-text">Price: $<?php echo ($product['price']) ?> </p>

                                <div class="buttons-cart">
                                    <button class="btn btn-primary" id="add-to-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            <?php } ?>

        </div>

    </div>

    <!-- Footer Section -->
    <div style="background-color: #D1BB9E;">
        <div class="container">
            <footer class="pt-5 ">
                <div class="row pb-4">
                    <!-- <div class="col-3 offset-1">
                        <div class="">
                            <h5>Subscribe to our newsletter</h5>
                            <p>Monthly digest of whats new and exciting from us.</p>
                        </div>
                    </div> -->

                    <div class="col-4">
                        <h5 class="text-white">About Us</h5>
                        <div class="text-muted">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis quia, quod cumque fugit dolores ipsum officiis consectetur ab quasi eveniet!
                        </div>
                    </div>


                    <div class="col-2">
                        <h5 class="text-white">Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>

                    <div class="col-2">
                        <h5 class="text-white">Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>


                    <div class="col-2">
                        <h5 class="text-white">Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>

                    <div class="col-2">
                        <h5 class="text-white">Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        </ul>
                    </div>


                </div>
            </footer>
        </div>
        <!-- Copyright -->
        <div class="d-flex justify-content-center align-items-center py-3" style="background-color: #A79277;">
            <p class="mb-0 text-white">© 2021 Company, Inc. All rights reserved.</p>

        </div>
    </div>
</body>

</html>