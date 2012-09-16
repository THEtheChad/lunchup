<?php
session_start();
require_once __DIR__.'/mainIncludes.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
$app = new Silex\Application();


$app->before(function (Request $request) {
    // redirect the user to the login screen if access to the Resource is protected
/*
    if ($userId == '') {
        return new RedirectResponse('/login');
    }
*/
});

$app->get('/login', function () use ($app) {
	Header("Location:http://cmmedialc.com/lunchup/api/lib/login.php");
});

$app->get('/logout', function () use ($app) {
	//Get the number of followers
	session_destroy();
});

$app->get('/helloWorld', function () use ($app) {
	$result = "Hello World";
	$responseArr = array('results' => $result);
	$result = fixCallback($responseArr);	
	return $result;
});

$app->get('/hello/{name}', function ($name) use ($app) {
	$result = "Hello " . $name;
	$responseArr = array('results' => $result);
	$result = fixCallback($responseArr);	
	return $result;
});

$app->post('/postEvent', function(Request $request) use ($app) {
	//Create an event first
	//Create a status
	//Attach event to user
	$userId = $_SESSION["UserID"];

	$event = ORM::for_table($EventTbl)->create();
	$event->VenueID = $request->get('venue');
	$event->Created_Time = time();
	$event->EventDateTime = $request->get('eventDateTime');
	$event->save();
	$eventId = $event->id();
	
	$eventUsers = ORM::for_table($EventUsersTbl)->create();
	$eventUsers->EventID = $eventId;
	$eventUsers->USERID = $userId;
	$eventUsers->save();

	$status = ORM::for_table($StatusTbl)->create();
	$status->Status = $request->get('status');
	$status->EventID = $eventId;
	$status->Created_DateTime = time();
	$status->save();

	if ($eventId && $eventUsers->id() && $status->id()) {
		$result = 'success';
	} else {
		$result = 'failed';
	}
	$responseArr = array('results' => $result);
	$result = fixCallback($responseArr);	
	return $result;

});



$app->run();


function fixCallback($responseArr)
{
	if ($_GET["callback"])
	{
		$result = $_GET["callback"] . "(" . json_encode($responseArr) . ")";	
	} else {
		$result = json_encode($responseArr);	
	}
	return $result;
}
?>