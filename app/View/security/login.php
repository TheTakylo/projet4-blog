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
    <form class="form-signin" method="post">
        
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>

        <label for="inputEmail" class="sr-only">Identifiant</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Identifiant" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>

        <a href="<?= Urls::route('pages@index'); ?>" class="d-block mt-3">Retour au site</a>
    </form>
</body>
</html>