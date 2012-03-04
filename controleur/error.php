 <?php

function e_database()
{
    return array('data'=>array('view_title'=>'Page non trouvée'),'html'=>'errors/e_database.php');
}


function e_404()
{
   return array('data'=>array('view_title'=>'Erreur critique'),'html'=>'errors/e_404.php');
}

function e_user()
{
   return array('data'=>array('view_title'=>'Erreur identification'),'html'=>'errors/e_user.php');
}