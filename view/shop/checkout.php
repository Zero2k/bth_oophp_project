<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">Checkout</h1>
            </div>
        </div>
    </div >
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill"><?= count($cart) ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php foreach ($cart as $product) : ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0"><?= $product["name"] ?></h6>
                    <small class="text-muted">Quantity: <?= $product["quantity"] ?>. Size: <?= $product["size"] ?></small>
                </div>
                <span class="text-muted">$<?= $product["price"] ?></span>
                </li>
                <?php endforeach ?>
                <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$<?= $total ?></strong>
                </li>
            </ul>

            </div>
            <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="post">
                <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                    <input class="form-control-custom" placeholder="Username" value="<?= $user->username ?>" type="text" readonly>
                    <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                    </div>
                </div>
                </div>

                <div class="mb-3">
                <label for="email">Email</label>
                <input class="form-control-custom" placeholder="you@example.com" value="<?= $user->email ?>" type="email" readonly>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>

                <div class="mb-3">
                <label for="address">Address</label>
                <input class="form-control-custom" placeholder="1234 Main St" value="<?= $user->address ?>" type="text" readonly>
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
                </div>

                <div class="row">
                <div class="col-md-6 mb-6">
                    <label for="country">Country</label>
                    <input class="form-control-custom" value="<?= $user->country ?>" type="text" readonly>
                    <div class="invalid-feedback">
                    Please select a valid country.
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="state">City</label>
                    <input class="form-control-custom" value="<?= $user->city ?>" type="text" readonly>
                    <div class="invalid-feedback">
                    Please select a valid city.
                    </div>
                </div>
                </div>
                <small>Go to your <a href="<?= $url->create("profile")?>">profile</a> to change the information</small>
                <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input class="form-control-custom" id="cc-name" placeholder="Joey Doe" name="fullName" type="text" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                    Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input class="form-control-custom" id="cc-number" placeholder="5741 2487 5487 9854" name="cardNumber" type="text" required>
                    <div class="invalid-feedback">
                    Credit card number is required
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input class="form-control-custom" id="cc-expiration" placeholder="10/19" name="expiration" type="text" required>
                    <div class="invalid-feedback">
                    Expiration date required
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">CVV</label>
                    <input class="form-control-custom" id="cc-cvv" placeholder="325" name="cvv" type="text" required>
                    <div class="invalid-feedback">
                    Security code required
                    </div>
                </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Order</button>
            </form>
            </div>
        </div>
</div>
