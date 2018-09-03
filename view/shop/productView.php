<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4"><?= $product->name ?></h1>
            </div>
            <div class="row">
                <p class="lead">
                    <?= $product->description ?>
                    </p>
                </div>
            </div>
    </div >
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="myCarousel" class="carousel-product slide ptb-20" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item carousel-item active">
                            <img src="<?= $url->asset("img/$product->image")?>" class="img-responsive img-fluid" alt="">
                        </div>
                        <?php if ($product->image_two) : ?>
                            <div class="item carousel-item">
                                <img src="<?= $url->asset("img/$product->image_two")?>" class="img-responsive img-fluid" alt="">
                            </div>
                        <?php endif ?>
                        <?php if ($product->image_three) : ?>
                            <div class="item carousel-item">
                                <img src="<?= $url->asset("img/$product->image_three")?>" class="img-responsive img-fluid" alt="">
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <p class="product-price">
                            <?php if ($product->old_price) : ?>
                                <strike class="old">$<?= $product->old_price ?></strike> 
                            <?php endif ?>
                            <span class="new">$<?= $product->price ?></span>
                        </p>
                        <form method="post" action="<?= $url->create("cart/add")?>">
                            <input type="hidden" name="productId" value="<?= $product->id ?>">
                            <div style="margin-bottom: 0.3rem" class="form-group">
                                <select class="form-control-custom" name="size" id="colors" required>
                                    <option value="" selected>Select Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity:</label>
                                <label class="pull-right">Stock: <?= $product->stock >= 1 ? $product->stock : "48h" ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="quantity-left-minus btn btn-danger no-border" data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="quantity" name="quantity" min="1" max="100" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="quantity-right-plus btn btn-success no-border" data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success no-border btn-block">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                        </form>
                        <small><?= $session->getOnce("message-$product->id") ?></small>
                        <div class="reviews_product ptb-20">
                            1 reviews
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            (4/5)
                            <a data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="pull-right" href="#reviews">View all reviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->

        <hr>

        <div class="accordion ptb-20" id="accordionExample">
            <div class="card mb-2">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Description
                    </button>
                </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <?= $product->text ?>
                    </div>
                    <div class="card-footer">
                        <span>Categories: 
                            <?= $allCategories = implode(', ', array_column($categories, "category")) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Reviews
                    </button>
                </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                            <p class="text-secondary text-center">15 Minutes Ago</p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                <a class="float-left" href="#"><strong>Mark Webber</strong></a>
                                <span class="float-right"><i class="fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                        </p>
                        <div class="clearfix"></div>
                            <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>
                                <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                        </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
