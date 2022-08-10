<?php

use LifeSpikes\Models\User;

$users = User::all();

?>

<h1>User List</h1>

<?php if (count($users) < 1): ?>
    <p>No users found.</p>
<?php endif;  ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><img src="<?=sprintf('%s/%s', config('aws')['cdn'], $user->picture);?>" height="30" alt="<?=$user->name;?>" /></td>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->email; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
