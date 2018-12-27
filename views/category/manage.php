<div class="center">
    <h1>Manage categories</h1>
    <?php if(isset($_SESSION['newcategory'])): ?>
        <?php if(substr($_SESSION['newcategory'], 0, 7) == 'Success'): ?>
        <div class="alert alert-success">
            <?=$_SESSION['newcategory']?>
        </div>
        <?php else: ?>
        <div class="alert alert-danger">
            <?=$_SESSION['newcategory']?>
        </div>
        <?php endif; 
        Utils::deleteSession('newcategory'); ?>
    <?php endif; ?>
    <table class="table table-hover">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Erase</th>
        </tr>
    <?php while ($cat = $categories->fetch_object()): ?>
        <tr>
            <th class="col-md-1" scope="row"><?=$cat->id;?></th>
            <td class="col-md-4"><?=$cat->category_name;?></td>
            <td class="col-md-1"><a href="<?=BASE_URL."category/delete?id='{$cat->id}'";?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <a href="<?=BASE_URL?>category/create" class="btn btn-primary">+ New category</a>
</div>