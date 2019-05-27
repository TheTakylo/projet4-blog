<?php $title = "Tous les chapitres"; ?>
<a href="<?= Urls::route('admin@chapterNew'); ?>" class="btn btn-primary">Écrire un chapitre</a>
<div class="mt-3 d-block">
  <?php if($chapters): ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Date d'ajout</th>
        <th scope="col">Dernière modifications</th>
        <th scope="col">Commentaires</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($chapters as $chapter): ?>
      <tr>
        <td><a href="<?= Urls::route('chapters@show', ['slug' => $chapter->slug]); ?>"><?= $chapter->title ?></a></td>
        <td><?= date('d/m/Y à H:i:s', strtotime($chapter->created_at)); ?></td>
        <td>
          <?php if($chapter->updated_at === null): ?>
          -
          <?php else: ?>
          Modifié le <?= date('d/m/Y à H:i:s', strtotime($chapter->updated_at)); ?>
          <?php endif; ?>
        </td>
        <td><?= $chapter->other['comments_count']; ?></td>
        <td>
          <a href="<?= Urls::route('admin@chapterEdit', ['id' => $chapter->id]); ?>" class="btn btn-sm btn-secondary">Modifier</a>
          <form class="d-inline-block" method="post" action="<?= Urls::route('admin@chapterDelete', ['id' => $chapter->id]); ?>">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-sm btn-danger" onclick="return confirm('Êtes vous sûr de vouloir supprimer le chapitre ?\nCette action est irréversible.')">Supprimer</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php Paginate::show('App\Repository\ChapterRepository'); ?>
    <?php else: ?>
    <div class="alert alert-primary">Aucun chapitre</div>
<?php endif; ?>
</div>