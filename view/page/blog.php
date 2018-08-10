<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">Blog & News</h1>
                <p class="lead">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($posts as $post) : ?>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="blog text-center blog-item">
                        <span class="category-badge"><?= ucfirst($post->category) ?></span>
                        <img src="<?= $url->create("/kmom10/shop/htdocs/img/blog/$post->image")?>" alt="" width="100%">
                        <h4 class="blog-title">
                            <a class="text-dark" href="<?= $url->create("blog/$post->slug")?>"><?= ucfirst($post->title) ?></a>
                        </h4>
                        <p><?= substr(strip_tags($post->content), 0, 110); ?>...</p>
                        <a href="<?= $url->create("blog/$post->slug")?>">Read More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
