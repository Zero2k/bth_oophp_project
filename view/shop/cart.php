<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">Shopping Cart</h1>
            </div>
        </div>
    </div >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Product</th>
                                <th scope="col">Available</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($products) : ?>
                                <?php foreach ($products as $product) : ?>
                                <tr>
                                    <form method="post">
                                        <td><img class="product-img" src="<?= $url->create("/kmom10/shop/htdocs/img/$product[image]")?>" /> </td>
                                        <td class="align-middle">
                                            <a href="<?= $url->create("shop/product/$product[productId]")?>"><?= $product["name"] ?></a>
                                        </td>
                                        <td class="align-middle"><?= $product["available"] === 1 ? 'In stock' : '48h' ?></td>
                                        <td class="align-middle">
                                            <input style="border-radius: 0" class="form-control" type="number" name="quantity" value="<?= $product["quantity"] ?>" />
                                        </td>
                                        <td class="align-middle">
                                            <select style="border-radius: 0" name="size" class="form-control">
                                                <option <?= $product["size"] === "M" ? ' selected="selected"' : '' ?> value="M">M</option>
                                                <option <?= $product["size"] === "S" ? ' selected="selected"' : '' ?> value="S">S</option>
                                                <option <?= $product["size"] === "L" ? ' selected="selected"' : '' ?> value="L">L</option>
                                                <option <?= $product["size"] === "XL" ? ' selected="selected"' : '' ?> value="XL">XL</option>
                                            </select>
                                        </td>
                                        <td class="align-middle">$<?= $product["price"] ?></td>
                                        <td class="align-middle text-right">
                                            <button type="submit" name="delete" value="<?= $product["id"] ?>" class="btn btn-sm btn-danger no-border"><i class="fa fa-trash"></i> </button>
                                            <button type="submit" name="update" value="<?= $product["id"] ?>" class="btn btn-sm btn-success no-border"><i class="fa fa-refresh"></i> </button>
                                        </td>
                                    </form>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td align="center" colspan="7">No Products</td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <td colspan="2"><?= $session->getOnce("message") ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong>$<?= $total ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <a href="<?= $url->create("shop")?>" class="btn btn-block btn-secondary no-border">Return to Shop</a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a href="<?= $url->create("cart/remove")?>" class="btn btn-block btn-dark no-border">Delete Cart</a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a href="<?= $url->create("cart/checkout")?>" class="btn btn-block btn-success no-border">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
