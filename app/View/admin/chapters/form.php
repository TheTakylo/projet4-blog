<?php $title = 'Écrire un chapitre'; ?>

<?php $script_container = "
<script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=680gbxqmf0h6zgyhj1k2o972aksvf0uq6t3laj8yk6jumzi2'></script>
<script>
  tinymce.init({
    selector: '#chapterContent',
    language: 'fr_FR',
    language_url: '". Assets::js('admin/tinymce/langs/fr_FR.js') ."'
  });
  </script>
"; ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <form method="post">
            <?php if(isset($edit)): ?>
                <input type="hidden" name="_method" value="PUT">
            <?php endif; ?>

            <div class="form-group">
                <label for="chapterName">Nom du chapitre</label>
                <input value="<?= $chapter->title ?? ''; ?>" type="text" name="chapterName" class="form-control" id="chapterName">
            </div>
            <div class="form-group">
                <label for="chapterContent">Contenu</label>
                <textarea rows="20" id="chapterContent" name="chapterContent" class="form-control"><?= $chapter->content ?? ''; ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
</div>