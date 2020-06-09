<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facebook implements Login {
    /**
      Name: Facebook Login
      Author: Scrisoft
      Created: 05/05/2016
      This class allows users to login by using Facebook Account.
     * */
    protected $fb,$app_id,$app_secret;
    public $icon = '<i class="fa fa-facebook"></i>';
    
    public function __construct() {
		$this->app_id = get_option("facebook_app_id");
		$this->app_secret = get_option("facebook_app_secret");
        if (file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php')) {
			if (($this->app_id != "") AND ($this->app_secret != "")) {
                require FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                $this->fb = new Facebook\Facebook([
                    'app_id' => $this->app_id,
                    'app_secret' => $this->app_secret,
                    'default_graph_version' => 'v2.5',
                    'default_access_token' => '{access-token}',
                ]);
            }
        }
    }

    public function check_availability() {
        // check if the Facebook api is configured correctly
        if (($this->app_id != "") AND ($this->app_secret != "")) {
            return true;
        } else {
            return false;
        }
    }

    public function sign_in() {
        // this function will redirect user to facebook login page
		$helper = $this->fb->getRedirectLoginHelper();
                if (get_option('facebook_user_api_key')) {
                    $permissions = ['email'];
                } else {
                    $permissions = ['email', 'publish_actions'];
                }
		$loginUrl = $helper->getLoginUrl(get_instance()->config->base_url() . 'callback/facebook', $permissions);
		header('Location:' . $loginUrl);
    }

    public function get_token() {
        // this function will get access token
		try {
			$helper = $this->fb->getRedirectLoginHelper();
			$access_token = $helper->getAccessToken();
			$access_token = (array) $access_token;
			$access_token = array_values($access_token);
			if ( array_key_exists(0, $access_token) ) {
				// Get cURL resource
				$curl = curl_init();
				// Set some options - we are passing in a useragent too here
				curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . $access_token[0],CURLOPT_HEADER => false));
				// Send the request & save response to $resp
				$resp = curl_exec($curl);
				// Close request to clear up some resources
				curl_close($curl);
				$getUserdata = json_decode($resp);
				if (isset($getUserdata->id)) {
					$userData = ['id' => "f." . $getUserdata->id]; // f. in this way we sure that the id not exists. An user can use . for his id.
					$userData['network'] = "facebook";
					$userData['name'] = $getUserdata->name;
					$userData['photo'] = 'http://graph.facebook.com/' . $getUserdata->id . '/picture?type=square';
					$userData['net_id'] = $getUserdata->id;
					$a = (array) $access_token[1];
					$userData['expires'] = (@$a["date"])?$a["date"]:' ';
					if (isset($getUserdata->email)) {
						$userData['email'] = str_replace("\u0040", "@", $getUserdata->email);
					} else {
						$userData['email'] = '';
					}
					$userData['access_token'] = $access_token[0];
					get_instance()->session->set_flashdata('userdata', $userData);
					redirect('auth/signup');
				} else {
					get_instance()->session->set_flashdata('error', 'An error occurred while processing your request.<br>Please, try again or signup by using the form above.');
					redirect('auth/signup');
				}
			} else {
				get_instance()->session->set_flashdata('error', 'An error occurred while processing your request.<br>Please, try again or signup by using the form above.');
				redirect('auth/signup');
			}
		} catch (Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			get_instance()->session->set_flashdata('error', 'Graph returned an error: ' . $e->getMessage());
			redirect('auth/signup');
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			get_instance()->session->set_flashdata('error', 'Facebook SDK returned an error: ' . $e->getMessage());
			redirect('auth/signup');
		}
    }
}
