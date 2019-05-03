<?php $title = $chapter->title; ?>

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="blog-post border-bottom">
            <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
            <p class="blog-post-meta">Le <?= date("d M Y", $chapter->created_at); ?> par <a href="#">Jean Fortroche</a></p>
            
            <p><?= $chapter->content; ?></p>
        </div>
    </div>
</div>