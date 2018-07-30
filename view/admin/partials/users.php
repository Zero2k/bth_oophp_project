<h4>Users</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
            <th scope="row"><?= $user->id ?></th>
            <td><?= ucfirst($user->username) ?></td>
            <td><?= $user->email ?></td>
            <td><?= ucfirst($user->address) ?>, <?= ucfirst($user->city) ?></td>
            <td>Edit | Delete</td>
            </tr>
            <tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th colspan="4">
                <button class="btn btn-primary float-right">Add User</button>
            </th>
        </tr>
    </tfoot>
</table>
