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
    
        ['/chapitres', 'chapters@index', ['GET']],
        ['/chapitre/:slug', 'chapters@show', ['GET']],

        ['/chapitre/:chapter_id/comment', 'comments@add', ['POST']],
        ['/comments/spam/:comment_id', 'comments@spam', ['GET']],

        ['/admin', [
            ['', 'admin@index', ['GET']],
            ['/chapitres', 'admin@chapters', ['GET']],
            ['/chapitre/nouveau', 'admin@chapterNew', ['GET', 'POST']],
            ['/chapitre/:id', 'admin@chapterDelete', ['DELETE']],
            ['/chapitre/editer/:id', 'admin@chapterEdit', ['GET', 'PUT']],

            ['/commentaires', 'admin@comments', ['GET']],
            ['/commentaires/spam', 'admin@commentsSpam', ['GET']],
            ['/commentaires/:id', 'admin@commentDelete', ['DELETE']],
            ['/commentaires/:id', 'admin@commentDelete', ['DELETE']],

            ['/login', 'security@login', ['GET', 'POST']],
            ['/logout', 'security@logout', ['GET']]
        ]
        ]
    ],

    'Admin' => [
        'email' => 'admin@jean-forteroche.fr',
        'password' => 'admin' 
    ]
];