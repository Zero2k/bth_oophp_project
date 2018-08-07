<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<h4>Categories</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col" style="width: 15%">#</th>
            <th scope="col" style="width: 70%">Category</th>
            <th scope="col" style="width: 15%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <th scope="row"><?= $category->id ?></th>
                <td><?= ucfirst($category->category) ?></td>
                <td><a href="<?= $url->create("admin/edit/category/$category->id")?>">Edit</a> | <a href="<?= $url->create("admin/delete/category/$category->id")?>">Delete</a></td>
            <tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2"><p class="text-info"><?= $session->getOnce("message") ?></p></th>
            <th>
                <a href="<?= $url->create("admin/add/category")?>" class="btn btn-primary float-right">Add Category</a>
            </th>
        </tr>
    </tfoot>
</table>
