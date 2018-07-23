<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Profile</h1>
            <p class="lead">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="row">
                <div class="col-md-3 col-sm-12"><img src="<?= $content->gravatar ?>" class="rounded" alt="..."></div>
                <div class="col-md-9 col-sm-12">
                    <dl class="row">
                        <dt class="col-md-4">Username</dt>
                        <dd class="col-md-8"><?= $content->username ?></dd>

                        <dt class="col-md-4">Email</dt>
                        <dd class="col-md-8"><?= $content->email ?></dd>

                        <dt class="col-md-4">Created</dt>
                        <dd class="col-md-8"><?= $content->created ?></dd>

                        <dt class="col-md-4">User level</dt>
                        <dd class="col-md-8"><?= $content->admin ?></dd>
                    </dl>
                    <!-- <a href="#" class="btn btn-outline-dark no-border" role="button" aria-pressed="true">Dashboard</a> -->
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-12">
            <div class="list-group">
                <a href="?tab=profile" class="list-group-item list-group-item-action">Profile</a>
                <a href="?tab=orders" class="list-group-item list-group-item-action">Orders</a>
                <a href="?tab=address" class="list-group-item list-group-item-action">Address</a>
                <a href="?tab=posts" class="list-group-item list-group-item-action">Posts</a>
            </div>
        </div>
    </div>
</div>
