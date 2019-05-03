<div class="row">
    <div class="col-md-8 offset-md-2">
        <?php foreach($chapters as $chapter): ?>
            <div class="blog-post border-bottom">
                <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
                <p class="blog-post-meta">Le <?= date("d M Y", $chapter->created_at); ?> par <a href="#">Jean Fortroche</a></p>
                
                <p><?= Text::truncate($chapter->content); ?></p>
                <a href="<?= Urls::route('chapters@show', ['slug' => $chapter->slug]) ?>" class="d-block mb-2">Voir le chapitre</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>