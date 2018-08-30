<?php
    $url = $this->di->get("url");
?>

<div class="list-group">
    <a href="<?= $url->create("admin")?>" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="<?= $url->create("admin?tab=orders&limit=20")?>" class="list-group-item list-group-item-action">Orders</a>
    <a href="<?= $url->create("admin?tab=products&limit=20")?>" class="list-group-item list-group-item-action">Products</a>
    <a href="<?= $url->create("admin?tab=categories&limit=20")?>" class="list-group-item list-group-item-action">Categories</a>
    <a href="<?= $url->create("admin?tab=posts&limit=20")?>" class="list-group-item list-group-item-action">Posts</a>
    <a href="<?= $url->create("admin?tab=users&limit=20")?>" class="list-group-item list-group-item-action">Users</a>
    <a href="<?= $url->create("admin?tab=settings")?>" class="list-group-item list-group-item-action">Settings</a>
</div>
