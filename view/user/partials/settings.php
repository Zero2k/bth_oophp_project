<div class="row">
    <div class="col-md-12 col-sm-12">
        <h4>Change User</h4>
        <form method="post">
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="inputEmailUsername">Username</label>
                        <input type="text" class="form-control-custom" name="username" value="<?= $content->username ?>" placeholder="J. Doe">
                    </div>
                    <div class="col">
                        <label for="inputEmail">Email</label>
                        <input type="text" class="form-control-custom" name="email" value="<?= $content->email ?>" placeholder="your@email.com">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control-custom" name="password" placeholder="******">
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword">Confirm Password</label>
                <input type="password" class="form-control-custom" name="confirm-password" placeholder="******">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-user">Save</button>
        </form>
    </div>
</div>
