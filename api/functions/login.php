<?php
  session_start();
  require_once '../mainIncludes.php';

  // include hybridauth lib
  $config = '../lib/hybridauth/config.php';
  require_once( "../lib/hybridauth/Hybrid/Auth.php" );
  $provider = 'facebook';

  try {
        $hybridauth = new Hybrid_Auth( $config );

        $adapter = $hybridauth->authenticate( $provider );

        $user_profile = $adapter->getUserProfile();

        print_r($user_profile);
/*
      if ($_SESSION["UserID"] != 0)
      {
        $user = ORM::for_table($UserTbl)->where('UserID', $_SESSION["UserID"])->find_one();

        if ($user) {
          if ($user->FirstName == '')
          {
            $user->set('FirstName', $user_profile->firstName);
          }
          if ($user->LastName == '')
          {
            $user->set('LastName', $user_profile->lastName);
          }
          if ($user->FBID == '')
          {
            $user->set('FBID', $user_profile->identifier);
          }
          if ($user->EmailAddress == '')
          {
            $user->set('EmailAddress', $user_profile->email);
          }
          if ($user->Gender == '')
          {
            if ($user_profile->gender == "male")
            {
              $user->set('Gender', 'M');
            } else {
              $user->set('Gender', 'F');
            }
            
          }
          if ($user->ProfilePic == '') {
            $url = 'http://graph.facebook.com/' . $user_profile->displayName . '/picture?type=normal';
            $session_id= $_SESSION["UserID"]; // User session id
            $ext = 'jpg';
            $actual_image_name = time().$session_id.".".$ext;
            file_put_contents('uploads/' . $actual_image_name, file_get_contents($url));
            $user->set('ProfilePic', $actual_image_name);

          }
          $user->set('FBAccessToken', $adapter->getAccessToken());
          $user->save();
        }

        
      } else {
        $user = ORM::for_table('UserTbl')->where('FBID', $user_profile->identifier)->find_one();
       if ($user) {
          if ($user->FirstName == '')
          {
            $user->set('FirstName', $user_profile->firstName);
          }
          if ($user->LastName == '')
          {
            $user->set('LastName', $user_profile->lastName);
          }
          if ($user->FBID == '')
          {
            $user->set('FBID', $user_profile->identifier);
          }
          if ($user->EmailAddress == '')
          {
            $user->set('EmailAddress', $user_profile->email);
          }
          if ($user->Gender == '')
          {
            if ($user_profile->gender == "male")
            {
              $user->set('Gender', 'M');
            } else {
              $user->set('Gender', 'F');
            }
            
          }
          $_SESSION["UserID"] = $user->UserID;
          if ($user->ProfilePic == '') {
            $url = 'http://graph.facebook.com/' . $user_profile->displayName . '/picture?type=normal';
            $session_id= $_SESSION["UserID"]; // User session id
            $ext = 'jpg';
            $actual_image_name = time().$session_id.".".$ext;
            file_put_contents('uploads/' . $actual_image_name, file_get_contents($url));
            $user->set('ProfilePic', $actual_image_name);

          }
          $user->set('FBAccessToken', $adapter->getAccessToken());
          $user->save();
        } else {

          $user = ORM::for_table('UserTbl')->create();
          $user->FirstName = $user_profile->firstName;
          $user->LastName = $user_profile->lastName;
          $user->FBID = $user_profile->identifier;
          $user->EmailAddress = $user_profile->email;
          if ($user_profile->gender == "male")
          {
            $user->Gender = 'M';
          } else {
            $user->Gender = 'F';
          }
          $url = 'http://graph.facebook.com/' . $user_profile->displayName . '/picture?type=normal';
          $session_id= rand(); // User session id
          $ext = 'jpg';
          $actual_image_name = time().$session_id.".".$ext;
          file_put_contents('uploads/' . $actual_image_name, file_get_contents($url));
          $user->ProfilePic = $actual_image_name;
          $user->IPAddress = $_SERVER["REMOTE_ADDR"];
          $user->Timestamp = time();
          $user->FBAccessToken = $adapter->getAccessToken();
          $user->save();
          $_SESSION["UserID"] = $user->id();
        }
      }
  */    
  } catch (Exception $ex) {
echo $ex;

  }
  //Header("Location:index.php");

?>