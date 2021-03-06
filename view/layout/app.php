<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>

        <?php foreach ($stylesheets as $stylesheet) : ?>
        <link rel="stylesheet" type="text/css" href="<?= $this->asset($stylesheet) ?>">
        <?php endforeach; ?>

    </head>
    <body>

    <?php if ($this->regionHasContent("header")) : ?>
        <div class="header-wrap">
            <?php $this->renderRegion("header") ?>
        </div>
    <?php endif; ?>

    <?php if ($this->regionHasContent("navbar")) : ?>
        <div class="navbar-wrap">
            <?php $this->renderRegion("navbar") ?>
        </div>
    <?php endif; ?>

    <?php if ($this->regionHasContent("main")) : ?>
        <?php $this->renderRegion("main") ?>
    <?php endif; ?>

    <?php if ($this->regionHasContent("footer")) : ?>
        <?php $this->renderRegion("footer") ?>
    <?php endif; ?>

    </body>
</html>
