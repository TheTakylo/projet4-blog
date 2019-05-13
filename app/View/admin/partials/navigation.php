<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark p-0 shadow">
    <a class="navbar-brand px-5 mr-0" href="<?= Urls::route('admin@index'); ?>">Billet simple pour l'Alaska</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="nav navbar-nav mr-auto pl-4">

        <?php if(Urls::prefix('/admin')): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= Urls::route('pages@index'); ?>">Retour au site</a> 
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= Urls::route('admin@index'); ?>">Aller à l'administration</a> 
        </li>
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right px-3">
        <li class="nav-item">
          <a class="nav-link" href="<?= Urls::route('security@logout'); ?>">Déconnexion</a>
        </li>
      </ul>
    </div>
</nav>
<div class="mb-5"></div>