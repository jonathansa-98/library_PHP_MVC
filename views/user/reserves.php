<div class="center">
    <h1>Reserves & Borrows</h1>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">User</th>
            <th scope="col">Book</th>
            <th scope="col">Reservation Date</th>
            <th scope="col">Taken Date</th>
            <th scope="col">Returned?</th>
        </tr>
        <tbody>
            <?php while($reserve = $reserves->fetch_object("Reserve")): ?>
            <tr>
                <td class="col-md-1"><?=$reserve->getId()?></td>
                <td class="col-md-1"><?=$reserve->getUser_login()?></td>
                <?php while($book = $books->fetch_object("Book")):?>
                <?= $book->getId()?>
                <?= $reserve->getBook_id() ."<br>"?>
                    <?php if($book->getId() == $reserve->getBook_id()):?>
                        <td class="col-md-2"><?=$book->getName()?></td>
                    <?php endif; ?>
                <?php endwhile;?>
                <td class="col-md-3"><?=$reserve->getReservation_date()?></td>
                <!--<td class="col-md-1"><a href="<?=BASE_URL?>borrow/add"><i class="fas fa-plus"></i></a></td>-->
                <td class="col-md-1"><a href="#"><i class="fas fa-plus"></i></a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


