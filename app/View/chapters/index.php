<?php $title = "Tous les chapitres" ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
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
</div>