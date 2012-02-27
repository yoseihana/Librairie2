<?php

include ('modeles/'.$c.'.php');

function connecter()
{
    
  global $a, $c;
  
  
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
      $email = $_POST['email'];
      $mdp = sha1 ($_POST['mdp']); // car crypter en sha1 ds bdd
      $_SESSION['connected'] = _membreExiste(array('email'=>$email, 'mdp'=>$mdp)); // pq retourner un array?
      header('Location:'.$_SERVER['PHP_SELF']);
      
  }
  elseif($_SERVER['REQUEST_METHOD'] == 'GET')
  {
      $data['view_title'] = 'Connexion';
      return array('data'=> $data, 'html'=> $a.$c.'.php');
  }

}

function deconnecter()
{
    session_unset();
    session_destroy();
    
    header('Location:'.$_SERVER['PHP_SELF']);
}


function _membreExiste($data)
{
    if(getMemberCount($data))
    {
        return true;
    }
    else 
    {
        
        return false;
    
    }
}