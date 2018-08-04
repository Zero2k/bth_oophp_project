<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4 blog-post-title"><?= ucfirst($post->title) ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img src="<?= $url->create("/kmom10/shop/htdocs/img/blog/$post->image")?>" class="img-fluid mx-auto d-block" alt="Responsive image">
                <div class="blog-post">
                    <p class="blog-post-meta"><?= $post->created ?> | <?= ucfirst($post->category) ?></p>
                    <p><?= $post->html ?></p>
                </div>
            </div>

            <aside class="col-md-4">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>
            </aside>
        </div>
    </div>
</main>
