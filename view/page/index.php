<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 slider-image" src="img/01.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 slider-image" src="img/02.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <h5>First slide label</h5>
                    <a href="#"><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></a>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 slider-image" src="img/03.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 ptb-50">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <h2><i class="fa fa-truck fa-2x"></i></h2>
                            </div>
                            <div class="col-9 align-self-center">
                                <h6>FREE SHIPPING & RETURN</h6>
                                <p>Get free shipping for all orders $99 or more</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ptb-50">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <h2><i class="fa fa-undo fa-2x"></i></h2>
                            </div>
                            <div class="col-9 align-self-center">
                                <h6>MONEY BACK GUARANTEE</h6>
                                <p>Get the item you ordered, or your money back</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ptb-50">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <h2><i class="fa fa-phone fa-2x"></i></h2>
                            </div>
                            <div class="col-9 align-self-center">
                                <h6>ONLINE SUPPORT 24/7</h6>
                                <p>Chat with experts or have us call you right away</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-divider"><span>Featured Products</span></h3>
        <div class="row">
            <div class="col-md-12">
                <div id="myCarousel" class="carousel-product slide" data-ride="carousel">
                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    <div class="item carousel-item active">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/orange_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Pleated Halter Blouse</h4>
                                        <p class="item-price"><strike>$40.00</strike> <span>$34.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/black_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Michael Stars Front Halter</h4>
                                        <p class="item-price"><strike>$25.00</strike> <span>$21.99</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/grey_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Cinch Athletic Poly Spandex Tech Polo</h4>
                                        <p class="item-price"><strike>$69.00</strike> <span>$23.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/green_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Sleeveless Chiffon Zebra Fresco</h4>
                                        <p class="item-price"><strike>$35.00</strike> <span>$25.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item carousel-item">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/green_woman_shorts_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Patagonia Baggies Short</h4>
                                        <p class="item-price"><strike>$28.00</strike> <span>$26.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/darkgrey_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Under Armour Tank</h4>
                                        <p class="item-price"><strike>$39.00</strike> <span>$26.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/blue_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Lucky Brand Neptune Records Graphic Tee</h4>
                                        <p class="item-price"><strike>$49.00</strike> <span>$39.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="img/white_red_shirt_01.jpg" class="img-responsive img-fluid" alt="">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>Calvin Klein Short Sleeve Jersey</h4>
                                        <p class="item-price"><strike>$59.00</strike> <span>$56.00</span></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <h3 class="text-divider"><span>Summer Sale</span></h3>
        <div class="row row-eq-height text-center text-lg-left">
            <div class="col-md-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid" src="<?= $url->create("/kmom10/shop/htdocs/img/sale/summer_sale_alt1.jpeg")?>" alt="">
                </a>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="<?= $url->create("/kmom10/shop/htdocs/img/sale/summer_sale_alt2.jpeg")?>" alt="">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="<?= $url->create("/kmom10/shop/htdocs/img/sale/summer_sale_alt3.jpeg")?>" alt="">
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid" src="<?= $url->create("/kmom10/shop/htdocs/img/sale/summer_sale_alt4.jpeg")?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ptb-50">
            <div class="col-md-4 col-sm-12">
                <div class="widget widget-featured-products">
                    <h3 class="widget-title">Top Sellers</h3>
                    <?php foreach ($latestProducts as $product) : ?>
                    <div class="product">
                        <div>
                            <img class="product-thumb" src="<?= $url->create("/kmom10/shop/htdocs/img/$product->image")?>" alt="Product">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title"><a href="<?= $url->create("shop/product/$product->id")?>"><?= $product->name ?></a></h4><span class="entry-meta">$<?= $product->price ?></span>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="widget widget-featured-products">
                    <h3 class="widget-title">New Arrivals</h3>
                    <?php foreach ($latestProducts as $product) : ?>
                    <div class="product">
                        <div>
                            <img class="product-thumb" src="<?= $url->create("/kmom10/shop/htdocs/img/$product->image")?>" alt="Product">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title"><a href="<?= $url->create("shop/product/$product->id")?>"><?= $product->name ?></a></h4><span class="entry-meta">$<?= $product->price ?></span>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="widget widget-featured-products">
                    <h3 class="widget-title">Best Offers</h3>
                    <?php foreach ($latestProducts as $product) : ?>
                    <div class="product">
                        <div>
                            <img class="product-thumb" src="<?= $url->create("/kmom10/shop/htdocs/img/$product->image")?>" alt="Product">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title"><a href="<?= $url->create("shop/product/$product->id")?>"><?= $product->name ?></a></h4><span class="entry-meta">$<?= $product->price ?></span>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <h5 style="color: #9da9b9; font-size: 14px">CATEGORIES</h5>
            <?= $categoryCloud ?>
        </div>

        <h3 class="text-divider"><span>Latest News</span></h3>
        <div id="myCarousel" class="slide" data-ride="carousel">
            <!-- Wrapper for carousel items -->
            <?php if ($latestPosts) : ?>
            <div class="carousel-inner">
                <div class="item carousel-item active">
                    <div class="row">
                        <?php foreach (array_slice($latestPosts, 0, 2) as $post) : ?>
                        <div class="col-md-6">
                            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                                <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary"><?= ucfirst($post->category) ?></strong>
                                <h4 class="mb-0">
                                    <a class="text-dark" href="<?= $url->create("blog/$post->slug")?>"><?= ucfirst($post->title) ?></a>
                                </h4>
                                <div class="mb-1 text-muted" style="padding-top: 5px"><?= $post->created ?></div>
                                <p class="card-text mb-auto"><?= substr(strip_tags($post->content), 0, 70) ?></p>
                                <a href="<?= $url->create("blog/$post->slug")?>">Read more</a>
                                </div>
                                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px; object-fit: cover;" src="<?= $url->create("/kmom10/shop/htdocs/img/blog/$post->image")?>" data-holder-rendered="true">
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="item carousel-item">
                    <div class="row">
                        <?php foreach (array_slice($latestPosts, 2, 4) as $post) : ?>
                        <div class="col-md-6">
                            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                                <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary"><?= ucfirst($post->category) ?></strong>
                                <h4 class="mb-0">
                                    <a class="text-dark" href="#"><?= ucfirst($post->title) ?></a>
                                </h4>
                                <div class="mb-1 text-muted" style="padding-top: 5px"><?= $post->created ?></div>
                                <p class="card-text mb-auto"><?= substr(strip_tags($post->content), 0, 70) ?></p>
                                <a href="<?= $url->create("blog/$post->slug")?>">Read more</a>
                                </div>
                                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px; object-fit: cover;" src="<?= $url->create("/kmom10/shop/htdocs/img/blog/$post->image")?>" data-holder-rendered="true">
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php else : ?>
                <div class="text-center">
                    <h3>No posts found</h3>
                </div>
            <?php endif ?>
        </div>
    </div>
</main>
