<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Delete User</h1>
            <p class="lead">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <form method="post">
                <input type="hidden" class="form-control-custom" name="id" value="<?= $user->id ?>">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control-custom" name="username" value="<?= $user->username ?>" placeholder="J. Doe" disabled>
                        </div>
                        <div class="col">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control-custom" name="email" value="<?= $user->email ?>" placeholder="your@email.com" disabled>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-user">Delete User</button>
            </form>
        </div>
        
        <div class="col-md-3 col-sm-12">
            <?php if ($this->regionHasContent("sidebar")) : ?>
                <div>
                    <?php $this->renderRegion("sidebar") ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
