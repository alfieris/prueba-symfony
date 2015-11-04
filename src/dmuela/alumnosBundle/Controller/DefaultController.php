<?php

namespace dmuela\alumnosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use dmuela\alumnosBundle\Entity\Alumnos;

class DefaultController extends Controller
{
  var $alumnos = array(
        array("matricula"=>1,"nombre"=>"Daniel Muela"),
        array("matricula"=>2,"nombre"=>"Juanito Campos")
  );
    public function indexAction($name)
    {
        return $this->render('dmuelaalumnosBundle:Default:index.html.twig', array('name' => $name));
    }

    public function alumnosAction()
    {
        $repository = $this->getDoctrine()->getRepository("dmuelaalumnosBundle:Alumnos");
        $alumnos = $repository->findAll();

        return $this->render('dmuelaalumnosBundle:Default:alumnos.html.twig', array("alumnos" => $alumnos));
    }

    public function alumnoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository("dmuelaalumnosBundle:Alumnos");
        $alumno = $repository->find($id);

        return $this->render('dmuelaalumnosBundle:Default:alumno.html.twig', array("alumno"=>$alumno ));
    }

    public function nuevoAction()
    {
      // Insertar en BD

      $alumno = new Alumnos();
      $alumno->setNombre("Alfieris");
      $alumno->setEmail("alfierisnoe@hotmail.com");
      $alumno->setEdad(39);
      $em=$this->getDoctrine()->getManager();
      $em->persist($alumno);
      $em->flush();

      return $this->redirect($this->generateUrl('dmuelaalumnos_alumnos'));
    }

    public function ejemplosAction()
    {
        return $this->render('dmuelaalumnosBundle:Default:ejemplostwig.html.twig');
    }
}
