<div class="center">
    <h1>Reservation</h1>
    <?php if(isset($_SESSION['state_reserve'])): ?>
        <?php if(substr($_SESSION['state_reserve'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_reserve']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_reserve']?>
        </div>
        <?php endif; ?>
        <?=Utils::deleteSession('state_reserve')?>
    <?php endif; ?>
    <form action="<?=BASE_URL?>reserve/checkDates" method="POST">
        <div class="form-group">
            <label for="id">Book Id</label>
            <input class="form-control" type="text" name="id" value="<?=$id?>" readonly=""/>
        </div>
        <div class="form-group">
            <label for="name">Book Name</label>
            <input class="form-control" type="text" name="name" value="<?=$book->getName()?>" readonly=""/>
        </div>
        <div class="form-group">
            <label for="reservation_date">Reservation Date<i class="text-danger">*</i></label>
            <input class="form-control" type="text" id="datepicker" name="reservation_date" required="" autocomplete="off"/>
        </div>
        <?php if(Utils::isLibrarian()): ?>
        <div class="form-group">
            <label for="user">For user</label>
            <select name="user" class="form-control" required="">
            <?php while($user = $users->fetch_object()): ?>
                <option value="<?=$user->login?>">
                    <?=$user->login?>
                </option>
            <?php endwhile; ?>
            </select>
        </div>
        <?php else: ?>
        <label for="user">For user</label>
        <input class="form-control" type="text" name="user" value="<?=$_SESSION['userIdentity']->getLogin()?>" readonly=""/>
        <?php endif;?>
        <input class="btn btn-primary mb-2" type="submit" value="Reserve"/>
    </form>
</div>