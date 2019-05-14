<form method="get" action="<?= Urls::route('pages@search'); ?>">
  <div class="form-group">
    <label for="inputSearch">Votre recherche</label>
    <input type="text" name="s" class="form-control" id="inputSearch" placeholder="Votre recherche">
  </div>
  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>