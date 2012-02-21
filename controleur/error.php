<?php

function e_database()
{
    return array('data'=>array('view_title'=>'Page non trouvée'),'html'=>'erros/e_database.php');
}


function e_404()
{
   return array('data'=>array('view_title'=>'Erreur critique'),'html'=>'erros/e_404.php');
}

function e_user()
{
   return array('data'=>array('view_title'=>'Erreur identification'),'html'=>'erros/e_user.php');
}