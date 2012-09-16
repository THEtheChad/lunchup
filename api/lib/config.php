<?php
date_default_timezone_set('UTC');

ORM::configure('mysql:host=localhost;dbname=bishop81_lunchup2');
ORM::configure('username', 'bishop81_lunchup');
ORM::configure('password', '5X#2+L5,g=Jb');

ORM::configure('id_column_overrides', array(
    'AppUsers' => 'UserID',
    'AppEvents' => 'EventID',
    'AppStatus' => 'StatusID',
    'AppVenues' => 'VenueID',
    'AppUsers_Facebook' => 'UserID'
    'AppEvent_Users' => 'EventID',

));
/*
    'AppUsers_Friends' => '',
    'AppUsers_Twitter' => '',
*/
$UserTbl = 'AppUsers';
$StatusTbl = 'AppStatus';
$EventsTbl = 'AppEvents';
$VenuesTbl = 'AppVenues';
$UserFBTbl = 'AppUsers_Facebook';
$EventUsersTbl = 'AppEvent_Users';

?>