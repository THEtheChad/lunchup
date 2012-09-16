<?php
date_default_timezone_set('UTC');

ORM::configure('mysql:host=174.120.195.62:3306;dbname=bishop81_lunchup2');
ORM::configure('username', 'bishop81_lunchup');
ORM::configure('password', '5X#2+L5,g=Jb');

ORM::configure('id_column_overrides', array(
    'AppUsers' => 'UserID',
    'AppEvents' => 'EventID',
    'AppStatus' => 'StatusID',
    'AppVenues' => 'VenueID'
));
/*
    'AppEvent_Users' => '',
    'AppUsers_Facebook' => '',
    'AppUsers_Friends' => '',
    'AppUsers_Twitter' => '',
*/
$UserTbl = 'AppUsers';
$StatusTbl = 'AppStatus';
$EventsTbl = 'AppEvents';
$VenuesTbl = 'AppVenues';
$UserFB = 'AppUsers_Facebook';
$EventUsers = 'AppEvent_Users';

?>