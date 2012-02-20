<?php
	include 'modeles/'.$c.'.php';
        
        // Produire les données à affichée et les données à utiliser. REgarde ce qu'on demande 

function lister()
{
    global $a;
    global $c;
    
    $data = getList(); // Utilisation d'une fct dans le modèle. Utilisation de $c dedans?
    $html = $a . $c . '.php';
    
    return array ('data' => $data, 'html' => $html);
}
        
function modifier()
{
    global $a;
    global $c;
        
        if( $_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if(isset( $_GET['id']))
            {
                if( _isbnExiste ($_GET['id']))
                {
                    $id = $_GET['id'];
                }
                else
                {
                    die('Oops');
                }
            }
            else
            {
               die('Oops mauvais'); 
            }
            
            $data = getOne ($id); // affiche 1 seul livre avec son id
            $html = $a . $c . '.php';
        }
        elseif ( $_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset( $_POST['id']))
            {
                $id = $_POST['id'];
            }
            else
            {
                die('objet'); 
            }
            
            update ($id); // modifier en post on clique sur le bouton
            $a = $GLOBALS['validActions'][0]; // redéfini une action qui est listé 
            $data = getList();
            $html = $a . $c . '.php';
         }
       
         return array ('data' => $data, 'html' => $html);
}

function ajouter() // A modifier!!!!
{
    global $a;
    global $c;
        
        if( $_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if(isset( $_GET['id']))
            {
                if( _isbnExiste ($_GET['id']))
                {
                    $id = $_GET['id'];
                }
                else
                {
                    die('Oops ');
                }
            }
            else
            {
               die('Oops mauvais'); 
            }
            
            $data = getOne ($id); // affiche 1 seul livre avec son id
            $html = $a . $c . '.php';
        }
        elseif ( $_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset( $_POST['id']))
            {
                $id = $_POST['id'];
            }
            else
            {
                die('objet'); 
            }
            
            update ($id); // modifier en post on clique sur le bouton
            $a = $GLOBALS['valideAction'][0]; // redéfini une action qui est listé 
            $data = getList();
            $html = $a . $c . '.php';
         }
       
         return array ('data' => $data, 'html' => $html);
}

function voir() // A modifier!!!
{
    global $a;
    global $c;
        
        if( $_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if(isset( $_GET['id']))
            {
                if( _isbnExiste ($_GET['id']))
                {
                    $id = $_GET['id'];
                }
                else
                {
                    die('Oops ');
                }
            }
            else
            {
               die('Oops mauvais'); 
            }
            
            $data = getOne ($id); // affiche 1 seul livre avec son id
            $html = $a . $c . '.php';
        }
        elseif ( $_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset( $_POST['id']))
            {
                $id = $_POST['id'];
            }
            else
            {
                die('objet'); 
            }
            
            update ($id); // modifier en post on clique sur le bouton
            $a = $GLOBALS['valideAction'][0]; // redéfini une action qui est listé 
            $data = getList();
            $html = $a . $c . '.php';
         }
       
         return array ('data' => $data, 'html' => $html);
}


function _isbnExiste($isbn) // uniquement ds se fichier, commence par un _
{
    if( !getISBNCount($isbn))
    {
        return false;
    }
    else
    {
        return true;
    }
}