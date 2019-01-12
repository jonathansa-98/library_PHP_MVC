<div class="center">
    <h1>Manage categories</h1>
    <?php if(isset($_SESSION['state_cat'])): ?>
        <?php if(substr($_SESSION['state_cat'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_cat']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$_SESSION['state_cat']?>
        </div>
        <?php endif; 
        Utils::deleteSession('state_cat'); ?>
    <?php endif; ?>
    <a href="<?=BASE_URL?>category/create" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Add category</a>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    <?php while ($cat = $categories->fetch_object("Category")): ?>
        <tr>
            <th class="col-md-1" scope="row"><?=$cat->getId();?></th>
            <td class="col-md-5"><?=$cat->getName();?></td>
            <td class="col-md-1"><a href="<?=BASE_URL."category/edit&id={$cat->getId()}";?>"><i class="fas fa-edit"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL."category/delete&id={$cat->getId()}";?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>