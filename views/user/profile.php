<div class="center">
    <h1>Profile of <?= $user->getLogin()?></h1>
    
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
    
    <form class="form-group" action="<?=BASE_URL?>user/saveUpdate&login=<?=$user->getLogin()?>" method="POST">
        <div class="form-group">
            <label for="login">Login<i class="text-danger">*</i></label>
            <input class="form-control" type="text" name="login" disabled="" value="<?=$user->getLogin()?>"/>
        </div>
        <div class="form-group">
            <label for="dni">DNI<i class="text-danger">*</i></label>
            <input class="form-control" type="text" name="dni" required="" value="<?=$user->getDni()?>"/>
        </div>
        <div class="form-group">
            <label for="email">Email<i class="text-danger font-weight-bold">*</i></label>
            <input class="form-control" type="email" name="email" required="" value="<?=$user->getEmail()?>"/>
        </div>
        <input type="submit" name="update" value="Update" class="btn btn-primary mb-2"/>
    </form>
</div>