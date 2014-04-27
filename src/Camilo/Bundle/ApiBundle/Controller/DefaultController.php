<?php

namespace Camilo\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Camilo\Bundle\ApiBundle\Entity\Orders;
use Camilo\Bundle\ApiBundle\Entity\Places;
class DefaultController extends Controller
{
    public function scheduleAction($hall)
    {
        $sessions = $this->get('doctrine')
            ->getRepository('ApiBundle:Sessions')
            ->findby(array('hall'=>$hall));      
        $info = array();
        foreach ($sessions as $session){         
          $start = $session->getDateMovieStart();
          $end = $session->getDateMovieEnd();
          $pelicula = $session->getFilm();
          $info[] = array('session_id'=> $session->getSessionId(),
                          'movie_id' => $pelicula->getFilmId(),
                          'movie_name' => $pelicula->getName(),
                          'start' => date(DATE_RFC2822,$start),
                          'end' => date(DATE_RFC2822,$end));
        }
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
    public function cinemaAction($cinema)
    {
        $halls = $this->get('doctrine')
            ->getRepository('ApiBundle:Halls')
            ->findby(array('cinema'=>$cinema));      
        $info = array();
        foreach ($halls as $hall){                  
          $info[] = array('hall_id'=> $hall->getHallId(),
                          'name' => $hall->getName());
        }
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
    public function indexAction()
    {
        $cinemas = $this->get('doctrine')
            ->getRepository('ApiBundle:Cinemas')
            ->findAll();      
        $info = array();
        foreach ($cinemas as $cinema){                  
          $info[] = array('cinema_id'=> $cinema->getCinemaId(),
                          'name' => $cinema->getName(),
                          'address' => $cinema->getAddress());
        }
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
    public function placesAction($sessionid)
    {
        $session = $this->get('doctrine')
            ->getRepository('ApiBundle:Sessions')
            ->find($sessionid);     
        $info = array();
        if (!empty($session)){        
          $locationstring = $session->getLocationInfo();
          $location = unserialize($locationstring);
          foreach ($location as $key => $place){
            if ($place)
              $info[] = array('place' => $key,'state' => 'free');
            else
              $info[] = array('place' => $key,'state' => 'busy');
            
          }
        }
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
    public function buyAction($sessionid,$placestr)
    {
        $session = $this->get('doctrine')
            ->getRepository('ApiBundle:Sessions')
            ->find($sessionid); 
        $locationstring = $session->getLocationInfo();
        $location = unserialize($locationstring);
        $em = $this->getDoctrine()->getManager();
        $places = array_unique(explode(',',$placestr));
        $flag = true;
        foreach ($places as $place){
          if ($location[$place]){
            $location[$place] = false;
          }
          else{
            $flag = false;          
          }
        }
        if ($flag){
          $order = new Orders();
          $order->setSchedule($session);
          $order->setState('Finished');
          $key = md5(time().$sessionid.$placestr);
          $order->setKey($key);
          $em->persist($order);
          foreach ($places as $place){
            $place_obj = new Places();
            $place_obj->setOrder($order);
            $place_obj->setNumPlace($place);
            $em->persist($place_obj);          
          }          
          $locationstring = serialize($location);
          $session->setLocationInfo($locationstring); 
          $em->persist($session);
          $em->flush();
          $result = 'Success';
        }
        else{
          $result = 'Places were already purchased';
          $key = '';
        }
        $info = array('state' => $result,'key' => $key);
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
    public function cancelAction($keystr)
    {
        $order = $this->get('doctrine')
            ->getRepository('ApiBundle:Orders')
            ->findby(array('key' => $keystr)); 
        if (!empty($order)){
          if ($order[0]->getState() == 'Finished'){
            $order[0]->setState('Rejected');
            $places = $this->get('doctrine')
              ->getRepository('ApiBundle:Places')
              ->findby(array('order' => $order[0]->getOrderId())); 
            $session = $order[0]->getSchedule();
            $locationstring = $session->getLocationInfo();
            $location = unserialize($locationstring);
            foreach ($places as $place){
              $location[$place->getNumPlace()] = true;
            }           
            $locationstring = serialize($location);
            $session->setLocationInfo($locationstring);
            $em = $this->getDoctrine()->getManager();
            $em->persist($order[0]);
            $em->persist($session);
            $em->flush();
            $result = 'Success';
          }
          else{
            $result = 'Transaction is already canceled';
          }
        }
        else{
          $result = "Transaction not found";
        }
        $info = array('state' => $result);
        $response = new Response(json_encode($info));
        $response->headers->set('Content-Type', 'application/json');
        return $response;        
    }
}
