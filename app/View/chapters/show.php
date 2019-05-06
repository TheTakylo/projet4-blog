<?php $title = $chapter->title; ?>
<div class="row mt-2 mb-3">
    <div class="col-md-10 offset-md-1">
        <div class="blog-post border-bottom">
            <h2 class="blog-post-title"><?= $chapter->title; ?></h2>
            <p class="blog-post-meta">Le <?= date("d M Y", strtotime($chapter->created_at)); ?> par <a href="#">Jean Forteroche</a></p>
            
            <p><?= $chapter->content; ?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-xs-12">
        <form method="POST" action="<?= Urls::route('comments@add', ['chapter_id' => $chapter->id]); ?>">
            <div class="form-row">
                <div class="col">
                    <label for="commentEmail">Adresse email</label>
                    <input type="email" id="commentEmail" name="commentEmail" class="form-control" placeholder="Adresse email">
                </div>
                <div class="col">
                    <label for="commentPseudo">Pseudonyme</label>
                    <input type="text" id="commentPseudo" name="commentPseudo" class="form-control" placeholder="Pseudonyme">
                </div>
            </div>
            <div class="form-row mt-4">
                <label for="commentContent">Commentaire</label>
                <textarea name="commentContent" id="commentContent" class="form-control" placeholder="Commentaire"></textarea>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-secondary mt-3">Valider</button>
            </div>
        </form>
    </div>
    <div class="col-md-7 col-xs-12">
        <?php if(count($comments) >= 1): ?>

           <h4 class="mb-4 d-block"><?= count($comments); ?> commentaire<?= ((int) count($comments) >= 1) ? 's' : ''; ?></h4>

            <?php foreach($comments as $comment): ?>
                <div class="media">
                    <img src="https://gravatar.com/avatar/<?= $comment->email; ?>" class="align-self-start mr-3">
                    <div class="media-body">
                        <h5 class="mt-0"><?= $comment->pseudo ?> <small class="ml-2">le <?= date('d/m/y à H:i', strtotime($comment->created_at)); ?></small></h5>
                        <p><?= $comment->content ?></p>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="alert alert-secondary">Aucun commentaire pour ce chapitre, soyez le premier à le commenter.</div>
        <?php endif; ?>
    </div>
</div>