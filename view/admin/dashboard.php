<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Dashboard</h1>
            <p class="lead">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <?php if ($this->regionHasContent("partial")) : ?>
                <div>
                    <?php $this->renderRegion("partial") ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-3 col-sm-12">
            <div class="list-group">
                <a href="admin" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="?tab=orders" class="list-group-item list-group-item-action">Orders</a>
                <a href="?tab=products" class="list-group-item list-group-item-action">Products</a>
                <a href="?tab=categories" class="list-group-item list-group-item-action">Categories</a>
                <a href="?tab=posts" class="list-group-item list-group-item-action">Posts</a>
                <a href="?tab=users" class="list-group-item list-group-item-action">Users</a>
                <a href="?tab=settings" class="list-group-item list-group-item-action">Settings</a>
            </div>
        </div>
    </div>
</div>
