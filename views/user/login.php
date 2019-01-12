<div class="center">
    <h1>Login</h1>
    <?php if(isset($_SESSION['login'])): ?>
        <?php if(substr($_SESSION['login'], 0, 5) == 'Error'): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['login']?>
        </div>
        <?php endif; ?>
        <?=Utils::deleteSession('login');?>
    <?php endif;?>
    
    <form action="<?=BASE_URL?>user/saveLogin" method="POST">
        <div class="form-group">
            <label for="login">Login<i class="text-danger">*</i></label>
            <input class="form-control" type="text" name="login" required placeholder="Enter login" 
                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Username'"
                   minlength="3" maxlength="20"/>
        </div>
        <div class="form-group">
            <label for="pass">Password<i class="text-danger">*</i></label>
            <input class="form-control" type="password" name="pass" required="" placeholder="Enter password" 
                   onfocus="this.placeholder = ''" onblur="this.placeholder='Enter Password'"
                   minlength="6" maxlength="30"/>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="login"/>
    </form>
</div>
