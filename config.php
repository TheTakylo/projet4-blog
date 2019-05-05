<?php

return [

    'Database' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'projet4'
    ],

    'Routes' => [
        ['/', 'pages@index', ['GET']],
        ['/contact', 'pages@contact', ['GET']],
    
        ['/chapitres', 'chapters@index', ['GET']],
        ['/chapitre/:slug', 'chapters@show', ['GET']],
    
        ['/admin', 'admin@index', ['GET']],
        ['/admin/chapitres', 'admin@chapters', ['GET']],
        ['/admin/chapitre/nouveau', 'admin@chapterNew', ['GET', 'POST']],
        ['/admin/chapitre/:id', 'admin@chapterDelete', ['DELETE']],

        ['/admin/commentaires', 'admin@comments', ['GET']],

        ['/admin/login', 'security@login', ['GET', 'POST']],
        ['/admin/logout', 'security@logout', ['GET']]
    ],

    'Admin' => [
        'username' => 'jfortroche',
        'password' => 'jfortroche' 
    ]
];