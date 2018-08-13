<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4"><?= $product->name ?></h1>
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
                            <img src="<?= $url->create("/kmom10/shop/htdocs/img/orange_shirt_01.jpg")?>" class="img-responsive img-fluid" alt="">
                        </div>
                        <div class="item carousel-item">
                            <img src="<?= $url->create("/kmom10/shop/htdocs/img/orange_shirt_02.jpg")?>" class="img-responsive img-fluid" alt="">
                        </div>
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
                        <form method="post">
                            <div style="margin-bottom: 0.3rem" class="form-group">
                                <select class="form-control-custom" id="colors" required>
                                    <option value="" selected>Select Size</option>
                                    <option value="1">S</option>
                                    <option value="2">M</option>
                                    <option value="3">L</option>
                                    <option value="4">XL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity:</label>
                                <label class="pull-right">Stock: 20</label>
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
                        <div class="reviews_product ptb-20">
                            3 reviews
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
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
                            <!-- <?= $allCategories = implode(', ', array_column($categories, "category")) ?> -->
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
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
                </div>
            </div>
        </div>
    </div>
</div>