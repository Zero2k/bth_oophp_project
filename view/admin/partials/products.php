<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<h4>Products</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Old Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
            <th scope="row"><?= $product->id ?></th>
            <td><?= ucfirst($product->name) ?></td>
            <td>$<?= $product->price ?></td>
            <td>$<?= $product->old_price ?></td>
            <td><?= $product->stock ?></td>
            <td><a href="<?= $url->create("admin/edit/product/$product->id")?>">Edit</a> | <a href="<?= $url->create("admin/delete/product/$product->id")?>">Delete</a></td>
            </tr>
            <tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"><p class="text-info"><?= $session->getOnce("message") ?></p></th>
            <th colspan="3">
                <a href="<?= $url->create("admin/add/product")?>" class="btn btn-primary float-right">Add Product</a>
            </th>
        </tr>
    </tfoot>
</table>
