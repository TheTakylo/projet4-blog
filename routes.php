<?php

return [
    ['/', 'pages@index', ['GET']],
    ['/recherche', 'pages@search', ['GET']],
    
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
        ['/commentaires/:id', 'admin@commentValid', ['POST']],
        
        ['/login', 'security@login', ['GET', 'POST']],
        ['/logout', 'security@logout', ['GET']]
        ]
    ],
    
    ['/:error', 'errors@notFound', ['GET']]
];