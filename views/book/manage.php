<div class="center">
    <h1>Manage books</h1>
    <?php if(isset($_SESSION['state_book'])): ?>
        <?php if(substr($_SESSION['state_book'], 0, 7) == 'Success'): ?>
            <div class="alert alert-success">
                <?=$_SESSION['state_book']?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <?=$_SESSION['state_book']?>
            </div>
        <?php endif; 
        Utils::deleteSession('state_book'); ?>
    <?php endif; ?>
    <a href="<?=BASE_URL?>book/create" class="btn btn-primary mt-3">+ New book</a>
    <table class="table table-hover table_book">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">Isbn</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Author</th>
            <th scope="col">See copies</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    <?php while ($book = $books->fetch_object("Book")): ?>
        <tr>
            <th class="col-md-1"><?=$book->getId();?></th>
            <td class="col-md-1"><?=$book->getIsbn();?></td>
            <td class="col-md-3"><?=$book->getName();?></td>
            <td class="col-md-1"><?=Utils::getCategoryById($book->getCategoryId())->getName();?></td>
            <td class="col-md-1"><?=Utils::getAuthorById($book->getAuthorId())->getName();?></td>
            <td class="col-md-1"><a href="<?=BASE_URL."copy/manage&book_id={$book->getId()}";?>"><i class="fas fa-book"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL."book/edit&id={$book->getId()}";?>"><i class="fas fa-edit"></i></a></td>
            <td class="col-md-1"><a href="<?=BASE_URL."book/delete&id={$book->getId()}";?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>