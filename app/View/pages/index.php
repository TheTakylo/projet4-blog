<?php $title = "Accueil" ?>
<div class="jumbotron text-white jumbotron-home">
    <div class="col-md-12 px-0">
      <h1 class="display-4 font-italic">Billet simple pour l'Alaska</h1>
    </div>
  </div>
  
<div class="row">
  
  <div class="col-md-8 blog-main">
      <?php if(!empty($chapters)): ?>
    <?php foreach($chapters as $chapter): ?>
      <div class="blog-post border-bottom">
        <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
        <p class="blog-post-meta">Le <?= date("d M Y", strtotime($chapter->created_at)); ?> par <a href="#">Jean Forteroche</a></p>
        
        <p><?= Text::truncate(strip_tags($chapter->content)); ?></p>
        <small><?= $chapter->other['comments_count']; ?> commentaire<?= ((int) $chapter->other['comments_count'] > 1) ? 's' : ''; ?></small>
        <a href="<?= Urls::route('chapters@show', ['slug' => $chapter->slug]) ?>" class="d-block mb-2">Voir le chapitre</a>
      </div>
    <?php endforeach; ?>
      <?php else: ?>
          <h3 class="text-center">Aucun chapitre</h3>
      <?php endif; ?>
  </div>

  <aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
      <h4 class="font-italic mb-3">A propos de moi</h4>
      <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
    </div>
  </aside>

</div>