<div class="center">
    <h1>See our catalog of books</h1>
    <div class="row books books_catalog">
        <?php while($book = $books->fetch_object("Book")):?>
            <?php include 'singleBookReserve.php'; ?>
        <?php endwhile; ?> 
    </div>
</div>

