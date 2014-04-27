<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('get_schedule', new Route('/api/hall/{hall}/schedule/', array(
    '_controller' => 'ApiBundle:Default:schedule',
)));
$collection->add('get_halls', new Route('/api/cinema/{cinema}/', array(
    '_controller' => 'ApiBundle:Default:cinema',
)));
$collection->add('get_cinemas', new Route('/api/cinemas/', array(
    '_controller' => 'ApiBundle:Default:index',
)));
$collection->add('get_places', new Route('/api/session/{sessionid}/places/', array(
    '_controller' => 'ApiBundle:Default:places',
)));
$collection->add('buy_tickets', new Route('/api/tickets/buy/{sessionid}/places/{placestr}/', array(
    '_controller' => 'ApiBundle:Default:buy',
)));
$collection->add('cancel_tickets', new Route('/api/tickets/reject/{keystr}/', array(
    '_controller' => 'ApiBundle:Default:cancel',
)));
return $collection;
