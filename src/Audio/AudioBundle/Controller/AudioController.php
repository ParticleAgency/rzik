<?php

namespace Audio\AudioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Audio\AudioBundle\Entity\Audio;
use Audio\AudioBundle\Form\AudioType;
use Audio\AudioBundle\Services\FileUploader;

class AudioController extends Controller
{

	public function indexAction(Request $request)
	{
		$audioFiles = $this->getDoctrine()->getRepository('AudioBundle:Audio')->findAll();

		$audioFilesCount = count($audioFiles);

        return $this->render('AudioBundle:Default:index.html.twig', array('audioFiles' => $audioFiles,
                                                                          'audioFilesCount' => $audioFilesCount
                                                                                                            ));
	}


	/**
	* @param Request $request
	* @return \Symfony\Component\HttpFoundation\Response
	*/
    public function newAction(Request $request)
    {
    	$audio = new Audio();
    	$formAudio = $this->createForm(new AudioType(), $audio);
    	$formAudio->handleRequest($request);

	    if ($formAudio->isSubmitted() && $formAudio->isValid()) {

            var_dump($formAudio->getData());

	        // save the audio informations
            $em = $this->getDoctrine()->getManager();

            $audio->setTransferdate(new \DateTime('Now'));

            $em->persist($audio);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

			// set flash messages
			$session = new Session();
			$session->getFlashBag()->add('message', 'Informatons du fichier audio enregistrées');
	    }
        else if ($formAudio->isSubmitted()) {
            var_dump($formAudio->getData());
            // set flash messages
            $session = new Session();
            $session->getFlashBag()->add('message', 'Formulaire invalide');
        }

        return $this->render('AudioBundle:Default:add.html.twig',
        						array(
        							'formAudio' => $formAudio->createView()
        						)
        					);
    }


    public function viewAction($id)
    {
    	$audioFileView = $this->getDoctrine()->getRepository('AudioBundle:Audio')->findBy(array('id' => $id));
        return $this->render('AudioBundle:Default:view.html.twig',
        						array(
        							'audioFileView' => $audioFileView
        						)
        					);
    }

}
