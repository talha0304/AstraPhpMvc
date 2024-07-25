<?php
/** @var $this \app\core\View */
$this->title = ' User Profile';


?>

<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table as $tables): ?>
                <tr>
                    <th scope="row"><?= $tables['id'] ?></th>
                    <td><?= $tables['firstname'] ?></td>
                    <td><?= $tables['lastname'] ?></td>
                    <td><?= $tables['email'] ?></td>
                </tr>


            <?php endforeach; ?>

        </tbody>
    </table>
</div>