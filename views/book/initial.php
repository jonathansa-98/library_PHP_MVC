<div class="center">
    <h1>Some of our Books</h1>
    <div class="row books books_initial">
        <?php while($book = $books->fetch_object("Book")):?>
            <?php include 'singleBookReserve.php'; ?>
        <?php endwhile; ?> 
    </div>
</div>
