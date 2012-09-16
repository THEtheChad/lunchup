<?php
  session_start();
  require_once '../mainIncludes.php';

  // include hybridauth lib
  $config = dirname(__FILE__) . '/hybridauth/config.php';
  require_once( "hybridauth/Hybrid/Auth.php" );
  $provider = 'facebook';

  try {
        $hybridauth = new Hybrid_Auth( $config );

        $adapter = $hybridauth->authenticate( $provider );
        $user_profile = $adapter->getUserProfile();
        //print_r($user_profile);


      // Check to see if the user is already logged in
      //echo $_SESSION["UserID"];
      if ($_SESSION["UserID"] != 0)
      {
        $user = ORM::for_table($UserTbl)->where('UserID', $_SESSION["UserID"])->find_one();

        if ($user) {
          if ($user->UserName == '')
          {
            $user->set('UserName', $user_profile->displayName);
          }
          if ($user->EmailAddress == '')
          {
            $user->set('EmailAddress', $user_profile->email);
          }
          if ($user->Gender == '')
          {
            if ($user_profile->gender == "male")
            {
              $user->set('Gender', 'MALE');
            } else {
              $user->set('Gender', 'FEMALE');
            }
            
          }
          if ($user->Image_URL == '') {
            $user->set('Image_URL', $user_profile->photoURL);
          }
          if ($user->Local == '') {
            $user->set('Locale', $user_profile->region);
          }
          $user->save();
          //echo (ORM::for_table($UserFB)->where('UserID', $_SESSION["UserID"])->count());
          $userFB = ORM::for_table($UserFB)->where('UserID', $_SESSION["UserID"])->find_one();
          if ($userFB) {
            if ($userFB->FacebookID == '') {
              $userFB->set('FacebookID', $user_profile->identifier);
            }
          } else {
            $userFB = ORM::for_table($UserFB)->creat();
            $userFB->FacebookID = $user_profile->identifier;
          }
          //$userFB->set('AccessToken', $adapter->getAccessToken());
          $userFB->save();
        }

        
      } else {
        $userFB = ORM::for_table($UserFB)->where('FacebookID', $user_profile->identifier)->find_one();
        $user = ORM::for_table($UserTbl)->where('UserID', $userFB->UserID)->find_one();
       if ($user) {
          if ($user->UserName == '')
          {
            $user->set('UserName', $user_profile->displayName);
          }
          if ($user->EmailAddress == '')
          {
            $user->set('EmailAddress', $user_profile->email);
          }
          if ($user->Gender == '')
          {
            if ($user_profile->gender == "male")
            {
              $user->set('Gender', 'MALE');
            } else {
              $user->set('Gender', 'FEMALE');
            }
            
          }
          if ($user->Image_URL == '') {
            $user->set('Image_URL', $user_profile->photoURL);
          }
          if ($user->Local == '') {
            $user->set('Locale', $user_profile->region);
          }
          $user->save();

          if ($userFB->FacebookID == '') {
            $userFB->set('FacebookID', $user_profile->identifier);
          }
          //$userFB->set('AccessToken', $adapter->getAccessToken());
          $userFB->save();
          $_SESSION["UserID"] = $user->UserID;
        } else {

          $user = ORM::for_table($UserTbl)->create();
          $user->UserName = $user_profile->displayName;
          $user->EmailAddress = $user_profile->email;
          if ($user_profile->gender == "male")
          {
            $user->Gender = 'MALE';
          } else {
            $user->Gender = 'FEMALE';
          }
          $user->Image_URL = $user_profile->photoURL;
          $user->save();
          $userId = $user->id();
          $userFB = ORM::for_table($UserFB)->create();
          $userFB->UserID = $userId;
          $userFB->FacebookID = $user_profile->identifier;
          //$userFB->AccessToken = $adapter->getAccessToken();
          $userFB->save();
          $_SESSION["UserID"] = $userId;
        }
      }
  } catch (Exception $ex) {

    //echo $ex . "<br />" . $config;
  }
  Header("Location:http://cmmedialc.com/lunchup/index.html");

?>