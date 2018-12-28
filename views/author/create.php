<div class="center">
    <?php if(isset($edit) && isset($aut) && is_a($aut, "Author")):?>
        <h1>Edit author <?=$aut->getName();?></h1>
        <?php $url_action = BASE_URL."author/saveEdit&id=".$aut->getId(); ?>
    <?php else: ?>
        <h1>Create author</h1>
        <?php $url_action = BASE_URL."author/save" ?>
    <?php endif; ?>
    <form action="<?=$url_action?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" required minlength="3" maxlength="50"
                   value="<?=isset($aut) && is_a($aut, "Author") ? $aut->getName():'';?>"/>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="Save"/>
    </form>
</div>