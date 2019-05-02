
# Configuration

**Route :**
	Pour définir une **route**, utiliser un tableau sous la forme:
	*Inutile de rajouter **Controller***
    
    ['url', 'controller@action']
   
   Pour une route avec des paramètres dans l'URL
   
    ['url/**:parametre'**, 'controller@action']
    
   
  Dans le fichier **routes.php** à la racine
  
    <?php
    // routes.php
    
    $router->setRoutes([
        ['/', 'pages@index'],
        ['/:parametre', 'pages@index']
    ]);

# Controller

Les controllers doivent être créés dans **app/Controller**
Les controllers doivent hériter du **AbstractController**
Les controllers doivent renvoyer un objet du type ***Response***

    // Exemple d'un PagesController
    // app/Controller/PagesController.php
    <?php
    namespace  App\Controller;
   
    use Framework\Http\Response;
    use Framework\Controller\AbstractController;
    
    class  PagesController  extends  AbstractController
    {
    
		protected  $layout = 'base_layout'; // un layout peut-être déclaré
											// si un layout est défini le contenu de la page 
											// est stocké dans $content
    
	    public  function  index($parametre): Response
	    {
		    return  $this->render('pages/index.php', ['param' => $parametre]);
	    }
    
    }

Pour retourner une page, utiliser la méthode **render**, qui prend en second paramètre les variables à faire passer à la vue.

