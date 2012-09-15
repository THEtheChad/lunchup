<?php
session_start();
require_once __DIR__.'/lib/vendor/autoload.php';
require_once __DIR__.'/lib/idiorm.php';
require_once __DIR__.'/config.php';

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