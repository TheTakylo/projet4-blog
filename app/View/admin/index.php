<?php $title = 'Accueil'; ?>

<div class="row">
   <div class="col-md-3">
      <div class="card bg-light mb-3" style="max-width: 18rem;">
         <div class="card-header">Chapitres</div>
         <div class="card-body">
            <a href="<?= Urls::route('admin@chapters'); ?>" class="btn btn-primary">Voir tous les chapitres</a>
            <a href="#" class="btn btn-secondary mt-3">Écrire un chapitre</a>
         </div>
      </div>
   </div>
</div>