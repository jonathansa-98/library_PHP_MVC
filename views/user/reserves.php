<div class="center">
    <h1>Reserves & Borrows</h1>
    <?php if(isset($_SESSION['borrow_state'])): ?>
        <?php if(substr($_SESSION['borrow_state'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['borrow_state']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['borrow_state']?>
        </div>
        <?php endif; 
        Utils::deleteSession('borrow_state'); ?>
    <?php endif; ?>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">User</th>
            <th scope="col">Book ID</th>
            <th scope="col">Book</th>
            <th scope="col">Reservation Date</th>
            <th scope="col">Taken Date</th>
            <th scope="col">Returned?</th>
        </tr>
        <?php while($reserve = $reserves->fetch_object("Reserve")): ?>
        <tr>
            <td class="col-md-1"><?=$reserve->getId()?></td>
            <td class="col-md-1"><?=$reserve->getUser_login()?></td>
            <td class="col-md-1"><?=$reserve->getBook_id()?></td>
            <td class="col-md-3"><?=Utils::getBookNameById($reserve->getBook_id())?></td>
            <td class="col-md-2"><?=$reserve->getReservation_date()?></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>borrow/take&login=angel&id=<?=$reserve->getId()?>"><i class="fas fa-calendar-plus"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>borrow/return&reserve_id=<?=$reserve->getId()?>"><i class="fas fa-calendar-minus"></i></a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


