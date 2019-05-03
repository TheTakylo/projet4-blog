<?php $title = "Accueil" ?>

<div class="row">
  <div class="col-md-8 blog-main">

    <?php foreach($chapters as $chapter): ?>
      <div class="blog-post border-bottom">
        <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
        <p class="blog-post-meta">Le <?= date("d M Y", $chapter->created_at); ?> par <a href="#">Jean Fortroche</a></p>
        
        <p><?= Text::truncate($chapter->content); ?></p>
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