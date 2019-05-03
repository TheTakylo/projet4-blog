<?php

$router->setRoutes([
    ['/', 'pages@index'],
    ['/contact', 'pages@contact'],

    ['/chapitres', 'chapters@index'],
    ['/chapitre-:id', 'chapters@show'],
]);