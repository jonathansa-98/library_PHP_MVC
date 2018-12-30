<div class="center">
    <h1>Copies of <?=$book->getName()?></h1>
    <?php if(isset($_SESSION['status_copy'])): ?>
        <?php if(substr($_SESSION['status_copy'], 0, 7) == 'Success'): ?>
            <div class="alert alert-success">
                <?=$_SESSION['status_copy']?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <?=$_SESSION['status_copy']?>
            </div>
        <?php endif; ?>
        <?=Utils::deleteSession('status_copy');?>
    <?php endif; ?>
    <a href="<?=BASE_URL?>copy/create&book_id=<?=$book->getId()?>" class="btn btn-success">+ New Copy</a>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Copy Id</th>
            <th scope="col">Book Id</th>
            <th scope="col">Name</th>
            <th scope="col">Delete</th>
        </tr>
        <?php while($copy = $copies->fetch_object("Copy")):?>
        <tr>
            <td class="col-md-1"><?=$copy->getId()?></td>
            <td class="col-md-1"><?=$copy->getBookId()?></td>
            <td class="col-md-1"><?=$book->getName()?></td>
            <td class="col-md-1"><a href="<?=BASE_URL?>copy/delete&book_id=<?=$book->getId()?>&id=<?=$copy->getId()?>"><i class="fas fa-times"></i></a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>