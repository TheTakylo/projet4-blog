<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?= Assets::css('bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= Assets::css('admin/bootstrap.sign-in.css'); ?>">
</head>
<body class="text-center">
    <form class="form-signin" method="POST">
        
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
    
        <?php if(Flash::has('error')): ?>
            <?php foreach(Flash::get('error') as $error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <label for="inputUsername" class="sr-only">Identifiant</label>
        <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Identifiant" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>

        <a href="<?= Urls::route('pages@index'); ?>" class="d-block mt-3">Retour au site</a>
    </form>
</body>
</html>