<div class="row">
    <div class="col-md-12 col-sm-12">
        <h4>Change Address</h4>
        <form method="post">
            <div class="form-group">
                <label for="inputEmail4">Country</label>
                <input type="text" class="form-control-custom" name="country" value="<?= $content->country ?>" placeholder="Country">
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control-custom" name="address" value="<?= $content->address ?>" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="inputCity">City</label>
                <input type="text" class="form-control-custom" name="city" value="<?= $content->city ?>" placeholder="Sweden">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-user">Save</button>
        </form>
    </div>
</div>
