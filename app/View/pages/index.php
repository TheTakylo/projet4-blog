<?php $title = "Accueil" ?>
<div class="jumbotron text-white jumbotron-home">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Billet simple pour l'Alaska</h1>
    </div>
  </div>
  
<div class="row">
  
  <div class="col-md-8 blog-main">

    <?php foreach($chapters as $chapter): ?>
      <div class="blog-post border-bottom">
        <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
        <p class="blog-post-meta">Le <?= date("d M Y", strtotime($chapter->created_at)); ?> par <a href="#">Jean Forteroche</a></p>
        
        <p><?= Text::truncate(strip_tags($chapter->content)); ?></p>
        <small><?= $chapter->comments_count; ?> commentaire<?= ((int) $chapter->comments_count > 1) ? 's' : ''; ?></small>
        <a href="<?= Urls::route('chapters@show', ['slug' => $chapter->slug]) ?>" class="d-block mb-2">Voir le chapitre</a>
      </div>
    <?php endforeach; ?>

  </div>

  <aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
      <h4 class="font-italic">About</h4>
      <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
  </aside>

</div>