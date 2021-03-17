<div class="container-fluid">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col" style="width: 10% !important;">E-mail</th>
                <th scope="col">Created at</th>
                <th scope="col">Role</th>
                <th scope="col">Edit role</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($allUsers as $user) { ?>
                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->created_at ?></td>
                    <td><?= $user->role_name ?? '[no role]' ?></td>
                    <td>
                        <form action="admin/userRole/<?= $user->id ?>" method="post">
                            <input type="hidden" name="userId" value="<?= $user->id ?>">
                            <select name="newUserRole" id="newUserRole<?= $user->id ?>">
                                <option value="">select role</option>
                                <?php foreach ($allRoles as $role) { ?>
                                    <option value="<?= $role->id ?>" <?php if ($user->role_id === $role->id) echo 'selected'; ?>><?= $role->role_name ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="saveNewUserRole" class="btn btn-verysmall btn-primary">Save</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>


</div>