<?php

namespace Playlist\PlaylistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Playlist\PlaylistBundle\Entity\Playlist;
use Playlist\PlaylistBundle\Form\PlaylistType;
use Symfony\Component\HttpFoundation\Request;

class PlaylistController extends Controller
{
    public function playlistbyuserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();

        $getPlaylist = $em->getRepository('PlaylistBundle:Playlist')->findBy(array('user' => $user->getId()));

        if(!$getPlaylist){
            $this->get('session')->getFlashBag()->add('danger', 'Playlist inexistante');
        }
        return $this->render('PlaylistBundle:Playlist:create.html.twig', array('playlists' => $getPlaylist));
    }



    public function createPlaylistAction(Request $request)
    {
        $newplaylist = new Playlist();
        $formPlaylist = $this->createForm(new PlaylistType(), $newplaylist);
        $formPlaylist->handleRequest($request);

        return $this->render('PlaylistBundle:Playlist:create.html.twig', array('form' => $formPlaylist));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletePlaylistAction($id =1)
    {
        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository('PlaylistBundle:Playlist')->find($id);
        $em->remove($playlist);
        $em->flush();


        $this->get('session')->getFlashBag()->add(
            'notice',
            'La playlist a été supprimé'
        );
        return $this->redirect($this->generateUrl('playlist_byuser'));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editPlaylistAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository('PlaylistBundle:Playlist')->find($id);

        if (!$playlist) {
            throw $this->createNotFoundException(
                'Aucun playlist trouvé pour cet id : '.$id
            );
        }

        $form = $this->createForm(new PlaylistType(), $playlist);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice','La playlist a été modifiée'
            );

            return $this->redirect($this->generateUrl('playlist_byuser'));
        }


        return $this->render('PlaylistBundle:Playlist:editplaylist.html.twig', array(
            'id'            => $id,
            'TypeOfAction'  => 'Modification',
            'glyphicon'    =>'glyphicon glyphicon-floppy-disk',
            'bouton'    => 'Modifier',
            'form'      => $form->createView()
        ));
    }


}
