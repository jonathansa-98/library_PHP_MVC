<?php $books = ['way_of_kings_270x406.png','words_of_radiance_181x270.png',
    'oathbringer_640x973.png','the_fellowship_of_the_ring_312x499.png','chamber_of_secrets_1024x1569.png']; ?>
<div id="books_initial" class="row">
    <?php for ($i = 0; $i < count($books); $i++): ?>
    <div class="card mb-3">
      <h3 class="card-header">Card header</h3>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
      </div>
      <img src="assets/img/<?=$books[$i]?>" alt="<?=$books[$i]?>">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
      </ul>
      <div class="card-body">
        <a href="#" class="card-link">Card link</a>
      </div>
      <div class="card-footer text-muted">
        Added <?php $time = (Date('d')+7)-Date('d');
                if($time<=1):   echo $time . ' day ago';
                else:           echo $time . ' days ago';
                endif;?>
      </div>
    </div>
    <?php endfor; ?> 
</div>
