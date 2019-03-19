<div class="center">
    <h1>Reserves & Borrows</h1>
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
            <td class="col-md-1"><a href="#"><i class="fas fa-calendar-plus"></i></a></td>
            <td class="col-md-1"><a href="#"><i class="fas fa-calendar-minus"></i></a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


