<?php $title = "Tous les chapitres"; ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Date d'ajout</th>
      <th scope="col">Dernière modifications</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($chapters as $chapter): ?>
      <tr>
          <td><?= $chapter->title ?></td>
          <td><?= date('d/m/y à H:s', $chapter->created_at); ?></td>
          <td>
              <?php if($chapter->updated_at === null): ?>
               -
              <?php else: ?>
               Modifié le <?= date('d/m/Y à H:s', $chapter->updated_at); ?>
              <?php endif; ?>
          </td>
          <td>
              <a href="#" class="btn btn-sm btn-secondary">Modifier</a>
              <a href="<?= Urls::route('admin@chapterDelete', ['id' => $chapter->id]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes vous sûr de vouloir supprimer le chapitre ?\nCette action est irréversible.')">Supprimer</a>
            </td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>