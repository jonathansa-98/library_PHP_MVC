<div class="center">
    <h1>Some of our Books</h1>
    <div id="books_initial" class="row">
        <?php while($book = $books->fetch_object("Book")):?>
        <div class="card mb-3">
          <h4 class="card-header"><?=$book->getName()?></h4>
          <img class="mt-4" src="assets/img/book_covers/<?="{$book->getIsbn()}.png"?>" alt="<?="{$book->getIsbn()}.png"?>">
          <div class="card-body">
              <p class="card-text"><?= Utils::resumeText($book->getDescription(), 35)?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Category: <?=Utils::getCategoryById($book->getCategoryId())->getName();?></li>
            <li class="list-group-item">Author: <?=Utils::getAuthorById($book->getAuthorId())->getName();?></li>
            <a href="#" class="btn btn-primary">Reserve</a>
          </ul>
        </div>
        <?php endwhile; ?> 
    </div>
</div>
