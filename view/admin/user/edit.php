<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Edit User</h1>
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
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control-custom" name="username" value="<?= $user->username ?>" placeholder="J. Doe">
                        </div>
                        <div class="col">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control-custom" name="email" value="<?= $user->email ?>" placeholder="your@email.com">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control-custom" name="address" value="<?= $user->address ?>" placeholder="Address">
                        </div>
                        <div class="col">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control-custom" name="city" value="<?= $user->city ?>" placeholder="City">
                        </div>
                        <div class="col">
                            <label for="inputCountry">Country</label>
                            <input type="text" class="form-control-custom" name="country" value="<?= $user->country ?>" placeholder="Country">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control-custom" name="password" placeholder="******">
                        </div>
                        <div class="col">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control-custom" name="confirm-password" placeholder="******">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-user">Save</button>
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
