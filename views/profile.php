<?php
/** @var $this \app\core\View */
/** @var $table array */
$this->title = 'User Profile';
?>

<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table as $tables): ?>
                <tr>
                    <th scope="row"><?= $tables['id'] ?></th>
                    <td><?= $tables['firstname'] ?></td>
                    <td><?= $tables['lastname'] ?></td>
                    <td><?= $tables['email'] ?></td>
                    <td>
                        <a href="/updateuser?id=<?= $tables['id'] ?>">Edit</a>
                        <form action="/deleteuser" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $tables['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
