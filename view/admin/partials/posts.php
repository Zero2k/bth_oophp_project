<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<h4>Posts</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Created</th>
            <th scope="col">UserId</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
            <th scope="row"><?= $post->id ?></th>
            <td><?= ucfirst($post->title) ?></td>
            <td><?= $post->category ?></td>
            <td><?= $post->created ?></td>
            <td><?= ucfirst($post->userId) ?></td>
            <td><a href="<?= $url->create("admin/edit/post/$post->id")?>">Edit</a> | <a href="<?= $url->create("admin/delete/post/$post->id")?>">Delete</a></td>
            </tr>
            <tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"><p class="text-info"><?= $session->getOnce("message") ?></p></th>
            <th colspan="3">
                <a href="<?= $url->create("admin/add/post")?>" class="btn btn-primary float-right">Add Post</a>
            </th>
        </tr>
    </tfoot>
</table>
