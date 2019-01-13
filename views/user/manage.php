<div class="center">
    <h1>Manage users</h1>
    <?php if(isset($_SESSION['state_user'])): ?>
        <?php if(substr($_SESSION['state_user'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_user']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_user']?>
        </div>
        <?php endif; 
        Utils::deleteSession('state_user'); ?>
    <?php endif; ?>
    <a href="<?=BASE_URL?>user/register" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Add User</a>
    <table class="table table-hover table_user">
        <tr class="thead-dark">
            <th scope="col">Login</th>
            <th scope="col">DNI</th>
            <th scope="col">Email</th>
            <th scope="col">Reserves/Borrows</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    <?php while($user = $users->fetch_object("User")): ?>
        <tr>
            <td class="col-md-2"><?=$user->getLogin()?></td>
            <td class="col-md-1"><?=$user->getDni()?></td>
            <td class="col-md-3"><?=$user->getEmail()?></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>user/reservationBorrow&login=<?=$user->getLogin()?>"><i class="fas fa-paper-plane"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>user/edit&login=<?=$user->getLogin()?>"><i class="fas fa-edit"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>user/delete&login=<?=$user->getLogin()?>"><i class="fas fa-times"></i></a></td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>