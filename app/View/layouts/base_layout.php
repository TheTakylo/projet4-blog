<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?> | Jean Forteroche - Billet simple pour l'Alaska</title>

    <link rel="stylesheet" href="<?= Assets::css('bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= Assets::css('bootstrap.blog.css') ?>">
    <link rel="stylesheet" href="<?= Assets::css('style.css') ?>">
    
    <?php if(Session::has('admin')): ?>
      <link rel="stylesheet" href="<?= Assets::css('admin/bootstrap.admin.css'); ?>">
    <?php endif; ?>
</head>
<body>
  <?php if(Session::has('admin')): ?>
    <?php Partials::load('admin/partials/navigation.php'); ?>
  <?php endif; ?>

<div class="container">
  <?= Partials::load('partials/navigation.php'); ?>
</div>

<main role="main" class="container">
  <?= $content; ?>
</main><!-- /.container -->
<?= Partials::load('partials/footer.php'); ?>

</body>
</html>