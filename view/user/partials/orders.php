<div class="row">
    <h4>Orders</h4>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Order Nr</th>
        <th scope="col">Full name</th>
        <th scope="col">Created</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($content) : ?>
            <?php foreach ($content as $order) : ?>
            <tr>
                <th scope="row"><?= $order->id ?></th>
                <td><?= $order->fullName ?></td>
                <td><?= $order->created ?></td>
                <td><a href="?tab=view-order&orderId=<?= $order->id ?>">View</a></td>
            </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td align="center" colspan="4">No Orders</td>
            </tr>
        <?php endif ?>
    </tbody>
    </table>
</div>
