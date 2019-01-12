<div class="center">
    <h1>Manage authors</h1>
    <?php if(isset($_SESSION['state_aut'])): ?>
        <?php if(substr($_SESSION['state_aut'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_aut']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_aut']?>
        </div>
        <?php endif; 
        Utils::deleteSession('state_aut'); ?>
    <?php endif; ?>
    <a href="<?=BASE_URL?>author/create" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Add author</a>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    <?php while ($aut = $authors->fetch_object("Author")): ?>
        <tr>
            <th class="col-md-1" scope="row"><?=$aut->getId();?></th>
            <td class="col-md-5"><?=$aut->getName();?></td>
            <td class="col-md-1"><a href="<?=BASE_URL."author/edit&id={$aut->getId()}";?>"><i class="fas fa-edit"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL."author/delete&id={$aut->getId()}";?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>