<?php

return [

    'Database' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'projet4'
    ],

    'Routes' => [
        ['/', 'pages@index'],
        ['/contact', 'pages@contact'],
    
        ['/chapitres', 'chapters@index'],
        ['/chapitre/:slug', 'chapters@show'],
    
        ['/admin', 'admin@index'],
        ['/admin/login', 'security@login']
    ]


];