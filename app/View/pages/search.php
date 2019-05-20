<?php $title = 'Votre recherche'; ?>

<form method="GET" action="<?= Urls::route('pages@search'); ?>">
  <div class="form-group">
    <label for="inputSearch">Votre recherche</label>
    <input type="text" name="s" class="form-control" id="inputSearch" placeholder="Votre recherche">
  </div>
  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<?php if($chapters): ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <?php foreach($chapters as $chapter): ?>
            <div class="blog-post border-bottom">
                <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
                <p class="blog-post-meta">Le <?= date("d M Y", strtotime($chapter->created_at)); ?> par <a href="#">Jean Forteroche</a></p>
                
                <p><?= Text::truncate(strip_tags($chapter->content)); ?></p>
                <a href="<?= Urls::route('chapters@show', ['slug' => $chapter->slug]) ?>" class="d-block mb-2">Voir le chapitre</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>