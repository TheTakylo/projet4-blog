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
        ['/admin/chapitres', 'admin@chapters'],
        ['/admin/chapitre/nouveau', 'admin@chapterNew'],
        ['/admin/chapitre/:id', 'admin@chapterDelete'],

        ['/admin/commentaires', 'admin@comments'],

        ['/admin/login', 'security@login'],
        ['/admin/logout', 'security@logout']
    ],

    'Admin' => [
        'username' => 'jfortroche',
        'password' => 'jfortroche' 
    ]
];