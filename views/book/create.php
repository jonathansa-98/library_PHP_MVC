<div class="center">
    <?php if(isset($edit) && isset($book) && is_a($book, "Book")):?>
        <h1>Edit book <?=$book->getName();?></h1>
        <?php $url_action = BASE_URL."book/saveEdit&isbn=".$book->getIsbn(); ?>
    <?php else: ?>
        <h1>Create book</h1>
        <?php $url_action = BASE_URL."book/save" ?>
    <?php endif; ?>
    <form action="<?=$url_action?>" method="POST">
        <div class="form-group">
            <label for="isbn">Isbn</label>
            <input class="form-control" type="text" name="isbn" required minlength="13" maxlength="13"
                   value="<?=isset($book) && is_a($book, "Book") ? $book->getIsbn():'';?>"/>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" required minlength="3" maxlength="100"
                   value="<?=isset($book) && is_a($book, "Book") ? $book->getName():'';?>"/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" name="description" required="" minlength="25" maxlength="1000"
                   value="<?=isset($book) && is_a($book, "Book") ? $book->getDescription():'';?>"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <?php $categories = Utils::showCategories()?>
            <select class="form-control" name="category">
                <?php while ($cat = $categories->fetch_object("Category")): ?>
                <option value="<?=$cat->getId()?>">
                    <?=$cat->getName()?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="Save"/>
    </form>
</div>