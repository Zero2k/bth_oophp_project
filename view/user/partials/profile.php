<div class="row">
    <div class="col-md-3 col-sm-12"><img src="<?= $content->gravatar ?>" class="rounded" alt="..."></div>
    <div class="col-md-9 col-sm-12">
        <dl class="row">
            <dt class="col-md-4">Username</dt>
            <dd class="col-md-8"><?= ucfirst($content->username) ?></dd>

            <dt class="col-md-4">Email</dt>
            <dd class="col-md-8"><?= $content->email ?></dd>

            <dt class="col-md-4">Address</dt>
            <dd class="col-md-8"><?= ucfirst($content->address) ?>, <?= ucfirst($content->city) ?></dd>

            <dt class="col-md-4">Country</dt>
            <dd class="col-md-8"><?= ucfirst($content->country) ?></dd>

            <dt class="col-md-4">Created</dt>
            <dd class="col-md-8"><?= $content->created ?></dd>

            <dt class="col-md-4">User Role</dt>
            <dd class="col-md-8"><?= $content->admin === 0 ? 'Customer' : 'Admin' ?></dd>
        </dl>
    </div>
</div>
