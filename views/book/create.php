<div class="center">
    
    <?php if(isset($edit) && isset($book) && is_a($book, "Book")):?>
        <h1>Edit book <?=$book->getName();?></h1>
        <?php $url_action = BASE_URL."book/save&id=".$book->getId(); ?>
    <?php else: ?>
        <h1>Create book</h1>
        <?php $url_action = BASE_URL."book/save" ?>
    <?php endif; ?>
    
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="isbn">Isbn</label>
            <input class="form-control" type="text" name="isbn" required minlength="10" maxlength="13"
                   value="<?=isset($book) && is_a($book, "Book") ? $book->getIsbn():'';?>"/>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" required minlength="3" maxlength="100"
                   value="<?=isset($book) && is_a($book, "Book") ? $book->getName():'';?>"/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" name="description" required minlength="25" maxlength="1000"
                   ><?=isset($book) && is_a($book, "Book") ? $book->getDescription():'';?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <?php $categories = Utils::showCategories()?>
            <select class="form-control" name="category">
                <?php while ($cat = $categories->fetch_object("Category")): ?>
                <option value="<?=$cat->getId()?>" <?=isset($book) && is_a($book, "Book") && ($cat->getId()==$book->getCategoryId()) ? 'selected':'';?>>
                    <?=$cat->getName()?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <?php $authors = Utils::showAuthors()?>
            <select class="form-control" name="author">
                <?php while ($author = $authors->fetch_object("Author")): ?>
                <option value="<?=$author->getId()?>" <?=isset($book) && is_a($book, "Book") && ($author->getId()==$book->getAuthorId()) ? 'selected':'';?>>
                    <?=$author->getName()?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <?php if(isset($edit) && isset($book) && is_a($book, "Book")):?>
                <img src="<?=BASE_URL?>assets/img/book_covers/<?=$book->getIsbn()?>.png" width="130" height="200"><br>
                <label for="image">Image (only .png) <?="{$book->getIsbn()}.png"?></label><br>
                <input type="file" name="image" value="<?="{$book->getIsbn()}.png"?>" accept="image/png"/>
            <?php else: ?>
                <label for="image">Image (only .png)</label><br>
                <input type="file" name="image" required="" accept="image/png"/>
            <?php endif; ?>
        </div>
        <input class="btn btn-primary mb-3" type="submit" value="Save"/>
    </form>
</div>