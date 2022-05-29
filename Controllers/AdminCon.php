<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Google_Client;
use Google_Service;

/* upore 2 line first */
class AdminCon extends Controller
{
public function login()
{
    $data=[];
    /* after below code  */
    require_once APPPATH."libraries/vendor/autoload.php";
    $google_client = new Google_Client();
    $google_client-> setClientId("667586205727-5o0jtpr3m2ietohib467qrusjcj68rlv.apps.googleusercontent.com");
    $google_client->setClientSecret("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");
    /* terpor uporer information gulo nicher object a niye jabe */
    $google_client->setRedirectUri(base_url("/AdminCon/login"));
    /* akhon amar kon kon inpormation lage tha get korbo */
    $google_client->addScope("email") ;
    $google_client->addScope("profile");
    if($this->request->getVar('code'));
    /* getVar er madoome j code gulo pabo tha token a rakha hoyece */
    {
        $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if(!isset($token['error']))
        /* uporer line mean kore token a jodi error na thake */
        {
            $google_client->setAccessToken($token["access_token"]);
            $google_service = new Google_Service_Oauth2($google_client);
            /*  ekhon sokol data google service er kace*/
            /* er porer kaj hocce g service theke data collect kora */
            $google_user_data = $google_service->userinfo->get();
            print_r($google_user_data);


        }
    }
    $data ['lnk'] =$google_client->createAuthUrl();
    /* uporer var ekta authentic url create korbe */
    return view('loginview',$data);
}
}