<div class="center">
    <h1>Register</h1>
    
    <?php if(isset($_SESSION['register'])): ?>
        <?php if(substr($_SESSION['register'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['register']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['register']?>
        </div>
        <?php endif; 
        Utils::deleteSession('register'); ?>
    <?php endif; ?>
    
    <form action="<?=BASE_URL?>user/saveRegister" method="POST">             
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
        <div class="form-group">
            <label for="dni">Dni<i class="text-danger">*</i></label>
            <input class="form-control" type="text" name="dni" required="" placeholder="12345678A" 
                   onfocus="this.placeholder = ''" onblur="this.placeholder='12345678A'"
                   minlength="9" maxlength="9"/>
        </div>
        <div class="form-group">
            <label for="email">Email<i class="text-danger">*</i></label>
            <input class="form-control" type="email" name="email" required="" placeholder="myself@domain.com" 
                   onfocus="this.placeholder = ''" onblur="this.placeholder='myself@domain.com'"/>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="Register" name="register" />
     </form>
</div>