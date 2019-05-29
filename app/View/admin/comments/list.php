<?php $title = "Liste des commentaires"; ?>

<div class="mt-5 d-block">
  <?php if($comments): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Pseudo</th>
      <th scope="col">Commentaire</th>
      <th scope="col">Posté le</th>
      <th scope="col">Statut</th>
      <th scope="col">Chapitre du livre</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($comments as $comment): ?>
    <tr>
      <td><?= $comment->pseudo ?></td>
      <td><?= $comment->content ?></td>
      <td><?= date('d/m/Y à H:i:s', strtotime($comment->created_at)); ?></td>
      <td><?= ($comment->is_spam == 0) ? "<div class='badge badge-primary'>normal</div>" : "<div class='badge badge-danger'>spam</div>" ?></td>
      <td><a href="<?= Urls::route('chapters@show', ['slug' => $comment->other['chapter_slug']]); ?>"><?= $comment->other['chapter_title']?></a></td>
      <td>
        <?php if($comment->is_valid == false): ?>
          <form class="d-inline-block" method="post" action="<?= Urls::route('admin@commentValid', ['id' => $comment->id]); ?>">
            <button class="btn btn-sm btn-primary">N'est pas un spam</button>
          </form>
        <?php endif; ?>
        <form class="d-inline-block" method="post" action="<?= Urls::route('admin@commentDelete', ['id' => $comment->id]); ?>">
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-sm btn-danger" onclick="return confirm('Êtes vous sûr de vouloir supprimer le commentaire ?\nCette action est irréversible.')">Supprimer</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
  <div class="alert alert-primary">Aucun <?= (isset($spamPage)) ? 'commentaire n\'a été signalé' : 'commentaire' ?></div>
<?php endif; ?>
</div>