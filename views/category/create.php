<div class="center">
    <?php if(isset($edit) && isset($cat) && is_a($cat, "Category")):?>
        <h1>Edit category <?=$cat->getName();?></h1>
        <?php $url_action = BASE_URL."category/saveEdit&id=".$cat->getId(); ?>
    <?php else: ?>
        <h1>Create category</h1>
        <?php $url_action = BASE_URL."category/save" ?>
    <?php endif; ?>
    <form action="<?=$url_action?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" required minlength="3" maxlength="25"
                   value="<?=isset($cat) && is_a($cat, "Category") ? $cat->getName():'';?>"/>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="Save"/>
    </form>
</div>