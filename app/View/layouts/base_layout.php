<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>

    <link rel="stylesheet" href="<?= Assets::css('bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= Assets::css('bootstrap.blog.css') ?>">
</head>
<body>
<div class="container">
  <?= Partials::load('partials/navigation.php'); ?>
</div>

<main role="main" class="container">
  <?= $content; ?>
</main><!-- /.container -->
<?= Partials::load('partials/footer.php'); ?>

</body>
</html>