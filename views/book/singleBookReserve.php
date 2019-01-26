        <div class="card mb-3">
            <h4 class="card-header"><?=$book->getName()?></h4>
            <img class="mt-4" src="<?=BASE_URL."assets/img/book_covers/{$book->getIsbn()}.png"?>" alt="<?="{$book->getIsbn()}.png"?>">
            <div class="card-body">
                <p class="card-text"><?= Utils::resumeText($book->getDescription(), 35)?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Category: <?=Utils::getCategoryById($book->getCategoryId())->getName();?></li>
                <li class="list-group-item">Author: <?=Utils::getAuthorById($book->getAuthorId())->getName();?></li>
                <a href="<?=BASE_URL."reserve/create&id={$book->getId()}"?>" class="btn btn-primary">Reserve</a>
            </ul>
        </div>