<?php

namespace Playlist\PlaylistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlaylistController extends Controller
{
    public function indexAction()
    {
        return $this->render('PlaylistBundle:Playlist:index.html.twig');
    }


}
