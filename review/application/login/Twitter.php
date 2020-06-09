<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!isset($_SESSION))
    session_start();

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter implements Login
{
    /**
      Name: Twitter Login
      Author: Scrisoft
      Created: 05/05/2016
      This class allows users to login by using Twitter Account.
     * */
    protected $connection,$twitter_key,$twitter_secret;
    public $icon = '<i class="fa fa-twitter"></i>';

    public function __construct() {
		$this->twitter_key = get_option("twitter_app_id");
		$this->twitter_secret = get_option("twitter_app_secret");
        require_once FCPATH . 'vendor/autoload.php';
        $this->connection = new TwitterOAuth($this->twitter_key, $this->twitter_secret);
    }

    public function check_availability() {
        // first function check if the Twitter api is configured correctly
        if (($this->twitter_key != "") AND ($this->twitter_secret != "")) {
            return true;
        } else {
            return false;
        }
    }

    public function sign_in() {
        // this function will redirect user to Twitter login page
        $request_token = $this->connection->oauth('oauth/request_token', ['oauth_callback' => base_url() . "callback/twitter"]);
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $this->connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
        header('Location: ' . $url);
    }

    public function get_token() {
        // this function will get access token
        if (isset($_GET['denied'])) {
            get_instance()->session->set_flashdata('error', 'An error occurred while processing your request.<br>Please, try again or signup by using the form above.');
            redirect('auth/signup');
        }
        $twitterOauth = new TwitterOAuth($this->twitter_key, $this->twitter_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        $twToken = $twitterOauth->oauth('oauth/access_token', ['oauth_verifier' => $_GET['oauth_verifier']]);
        $newTwitterOauth = new TwitterOAuth($this->twitter_key, $this->twitter_secret, $twToken['oauth_token'], $twToken['oauth_token_secret']);
        $response = (array) $newTwitterOauth->get('account/verify_credentials', ['include_email' => 'true']);
        if ($twToken['oauth_token']) {
            $userData['id'] = 't.' . $response['id']; // t. in this way we sure that the id not exists. An user can use . for his id.
            $userData['network'] = 'twitter';
            $userData['name'] = @$response['screen_name'];
            $userData['net_id'] = @$response['id'];
            $userData['expires'] = ' ';
            if ($response["email"]) {
                $userData['email'] = $response['email'];
            } else {
                $userData['email'] = '';
            }
            $userData['access_token'] = $twToken['oauth_token'];
            $userData['secret'] = $twToken['oauth_token_secret'];
            $userData['photo'] = $response['profile_image_url'];
            get_instance()->session->set_flashdata('userdata', $userData);
            redirect('auth/signup');
        } else {
            get_instance()->session->set_flashdata('error', 'An error occurred while processing your request.<br>Please, try again or signup by using the form above.');
            redirect('auth/signup');
        }
    }
}
