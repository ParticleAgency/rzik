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
use Symfony\Component\HttpFoundation\File\File;

class AudioController extends Controller
{

	public function indexAction(Request $request)
	{
		$audioFiles = $this->getDoctrine()->getRepository('AudioBundle:Audio')->findAll();

		$audioFilesCount = count($audioFiles);

        return $this->render('AudioBundle:Default:index.html.twig',
        						array(
        							'audioFiles' => $audioFiles,
        							'audioFilesCount' => $audioFilesCount
        						)
        					);
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
            // save the audio informations
            $em = $this->getDoctrine()->getManager();

            $audio->setTransferdate(new \DateTime());

            $em->persist($audio);
            $em->flush();

            // get the id of the element inserted
            $id = $audio->getId();

            //upload audio file
            $file = $audio->getAudiofilename();
            $filename = 'music_'.$id.'.'.$file->getClientOriginalExtension();

            $file->move(
                $this->getParameter('upload_directory'),
                $filename
            );

            $audio->setAudiofilename($filename);
            $audio->setImagefilename('cover_'.$id.'.jpg');

            $em->persist($audio);
            $em->flush();

            // set flash messages
            $session = new Session();
            $session->getFlashBag()->add('message', 'Informatons du fichier audio enregistrées');

        }

        return $this->render('AudioBundle:Default:add.html.twig',
        						array(
        							'formAudio' => $formAudio->createView()
        						)
        					);
    }


    public function editAction(Request $request, Audio $audio)
    {      
        $em = $this->getDoctrine()->getManager();

        $audioname = $audio->getAudiofilename();
        $imagename = $audio->getImagefilename();

        $audio->setAudiofilename(
            new File($this->getParameter('upload_directory').'/'.$audioname)
        );
        $audio->setImagefilename(
            new File($this->getParameter('upload_directory').'/'.$imagename)
        );



        $formAudio = $this->createForm(new AudioType(), $audio);
        $formAudio->handleRequest($request);
        
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
