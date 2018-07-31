<?php
    $url = $this->di->get("url");
?>

<div class="list-group">
    <a href="<?= $url->create("admin")?>" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="<?= $url->create("admin?tab=orders")?>" class="list-group-item list-group-item-action">Orders</a>
    <a href="<?= $url->create("admin?tab=products")?>" class="list-group-item list-group-item-action">Products</a>
    <a href="<?= $url->create("admin?tab=categories")?>" class="list-group-item list-group-item-action">Categories</a>
    <a href="<?= $url->create("admin?tab=posts")?>" class="list-group-item list-group-item-action">Posts</a>
    <a href="<?= $url->create("admin?tab=users")?>" class="list-group-item list-group-item-action">Users</a>
    <a href="<?= $url->create("admin?tab=settings")?>" class="list-group-item list-group-item-action">Settings</a>
</div>
