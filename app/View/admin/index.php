<?php $title = 'Accueil'; ?>

<div class="row">
   <div class="col-md-4 col-xs-12">
      <div class="card bg-light mb-3">
         <div class="card-header">Chapitres</div>
         <div class="card-body">
            <a href="<?= Urls::route('admin@chapters'); ?>" class="btn btn-primary mt-3">Voir les chapitres</a>
            <a href="<?= Urls::route('admin@chapterNew'); ?>" class="btn btn-secondary mt-3">Écrire un chapitre</a>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-xs-12">
      <div class="card bg-light mb-3">
         <div class="card-header">Commentaires</div>
         <div class="card-body">
            <a href="<?= Urls::route('admin@comments'); ?>" class="btn btn-primary mt-3">Voir les commentaires</a>
         </div>
      </div>
   </div>
   <?php if($hasSpam): ?>
      <div class="col-md-4 col-xs-12">
         <div class="card text-white bg-danger mb-3">
            <div class="card-header">Spam</div>
            <div class="card-body">
               <h5 class="card-title">Un ou plusieurs commentaires ont été signalées comme spam</h5>
               <p class="card-text mt-4"><a href="<?= Urls::route("admin@commentsSpam"); ?>" class="btn btn-light">Voir</a></p>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>