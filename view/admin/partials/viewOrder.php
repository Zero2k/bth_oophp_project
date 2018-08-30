<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1"><?= ucfirst($user->username) ?></p>
                            <p><?= $user->email ?></p>
                            <p class="mb-1"><?= ucfirst($user->city) ?>, <?= ucfirst($user->country) ?></p>
                            <p class="mb-1"><?= ucfirst($user->address) ?></p>
                        </div>

                        <div class="col-md-6 text-md-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Credit Card</p>
                            <p class="mb-1"><span class="text-muted">Card Number: </span> <?= $content->cardNumber ?></p>
                            <p class="mb-1"><span class="text-muted">Expiration Date: </span> <?= $content->expiration ?></p>
                            <p class="mb-1"><span class="text-muted">Name: </span> <?= $content->fullName ?></p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Size</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($content->orderRows as $product) : ?>
                                    <tr>
                                        <td><?= $product->productName ?></td>
                                        <td><?= $product->quantity ?></td>
                                        <td><?= $product->size ?></td>
                                        <td>$<?= $product->price ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Total</div>
                            <div class="h2 font-weight-light">$<?= $total ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
