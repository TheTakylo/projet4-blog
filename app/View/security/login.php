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

    <?php foreach (Flash::get('danger') as $error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endforeach; ?>

    <label for="inputEmail" class="sr-only">Adresse email</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse email" required
           autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    <div class="form-group mt-4 mb-5">
        <label for="inputCaptcha">Question de sécurité: <?= $captcha->generate(); ?></label>
        <input placeholder="Réponse: " type="text" id="inputCaptcha" name="inputCaptcha" required class="form-control">

    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>

    <a href="<?= Urls::route('pages@index'); ?>" class="d-block mt-3">Retour au site</a>
</form>
</body>
</html>