<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Profile</h1>
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
                <a href="?tab=profile" class="list-group-item list-group-item-action">Profile</a>
                <a href="?tab=orders" class="list-group-item list-group-item-action">Orders</a>
                <a href="?tab=address" class="list-group-item list-group-item-action">Address</a>
                <a href="?tab=settings" class="list-group-item list-group-item-action">Settings</a>
                <?php if ($userRole === 1) : ?>
                    <a href="admin" class="list-group-item list-group-item-action">Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
