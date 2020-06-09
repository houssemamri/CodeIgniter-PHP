<?php
/**
 * Instagram
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Instagram
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Limits the maximum execution time to unlimited
set_time_limit(0);

// Sets the default timezone used by all date/time functions
date_default_timezone_set('UTC');

/**
 * Instagram class - allows users to connect to their Instagram Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Instagram implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $instagram;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Require the vendor autoload
        include_once FCPATH . 'vendor/autoload.php';
        
    }

    /**
     * The public method check_availability doesn't check if Instagram api was configured correctly.
     *
     * @return will be true
     */
    public function check_availability() {
        
        return true;
        
    }

    /**
     * The public method connect will show a form where the user can add the Instagram's username and password.
     * 
     * @return void
     */
    public function connect() {
        
        // Display the login form
        echo get_instance()->ecl('Social_login')->content('Username', 'Password', 'Connect', $this->get_info(), 'instagram', $this->CI->lang->line('mu209'));
        
    }

    /**
     * The public method save was added only to follow the interface.
     *
     * @param $token contains the token for some social networks
     * 
     * @return void
     */
    public function save($token = null) {
        
    }

    /**
     * The public method post publishes posts on Instagram.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ( $user_id ) {
            
            // If the $user_id variable is not null, will be published a postponed post
            $user_details = $this->CI->networks->get_network_data('instagram', $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data('instagram', $user_id, $args['account']);
            
        }
        
        // Verify if the image is loaded on server
        $im = explode(base_url(), $args['img']);
        
        // If image is on server
        if ( @$im[1] ) {
            
            // Get the path
            $filename = str_replace(base_url(), FCPATH, $args['img']);
            
            // Verify format
            if ( exif_imagetype($filename) != IMAGETYPE_JPEG ) {
                
                $in = get($args['img']);
                
                if ($in) {
                
                    $filename = FCPATH . 'assets/share/' . uniqid() . time() . '.jpg';
                    
                    file_put_contents($filename, $in);
                    
                    if ( file_exists($filename) ) {
                        
                        $file = $filename;
                        
                    } else {
                        
                        return false;
                        
                    }
                    
                } else {
                    
                    return false;
                    
                }
                
            }
            
            $file = $filename;
            
        } else {
            
            $in = get($args['img']);
            
            if ( $in ) {

                $filename = FCPATH . 'assets/share/' . uniqid() . time() . '.jpg';
                
                // Save image on server
                file_put_contents($filename, $in);
                
                // Verify if image was saved
                if ( file_exists($filename) ) {
                    
                    $file = $filename;
                    
                } else {
                    
                    return false;
                    
                }
                
            } else {
                
                return false;
                
            }
            
        }
        
        // Get the post content
        $post = $args['post'];
        
        // If title is not empty
        if ( $args['title'] ) {
            
            $post = $args['title'];
            
        }
        
        // Set the photo
        $photo = $file;
        
        // Set the caption
        $caption = $post;
        
        // Call the Instagram class
        $check = new \InstagramAPI\Instagram(false, false);
        
        // Login
        $check->login($user_details[0]->net_id, $user_details[0]->token);
        
        // Get proxy if exists
        $user_proxy = $this->CI->user->get_user_option($user_id, 'proxy');
        
        // Veirify if proxy exists
        if ( $user_proxy ) {
            
            $check->setProxy($user_proxy);
            
        } else {
            
            // Get global proxy
            $proxies = @trim(get_option('instagram_proxy'));
            
            // Verify if proxy exists
            if ($proxies) {
                
                $proxies = explode('<br>', nl2br($proxies, false));
                
                $rand = rand(0, count($proxies));
                
                if ( @$proxies[$rand] ) {
                    
                    $check->setProxy($proxies[$rand]);
                    
                }
                
            }
            
        }
        
        // Adjust the photo size
        $resizer = new \InstagramAPI\MediaAutoResizer($photo);
        
        // Upload the photo
        try {
            
            $myphoto = $check->timeline->uploadPhoto($resizer->getFile(), ['caption' => $caption]);
            
            if ( $myphoto ) {
            
                $moph = json_encode((array) $myphoto);
                
                $str = explode('media_id":"', $moph);
                
                if ( @$str[1] ) {
                    
                    $rd = explode('"', $str[1]);
                    
                    sami($rd[0], $args['id'], $args['account'], 'instagram', $user_id);
                
                    
                }
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        } catch (Exception $e) {
            
            try {
            
                $myphoto = $check->timeline->uploadPhoto($resizer->getFile(), ['caption' => $caption]);
                
                if ($myphoto) {
                
                    $moph = json_encode((array) $myphoto);
                    
                    $str = explode('media_id":"', $moph);
                    
                    if (@$str[1]) {
                    
                        $rd = explode('"', $str[1]);
                        
                        sami($rd[0], $args['id'], $args['account'], 'instagram', $user_id);
                        
                    }
                    
                    return true;
                    
                } else {
                    
                    return false;
                    
                }
                
            } catch (Exception $e) {
                
                try {
                    
                    sleep(1);
                    
                    $myphoto = $check->timeline->uploadPhoto($resizer->getFile(), ['caption' => $caption]);
                    
                    if ( $myphoto ) {
                        
                        $moph = json_encode((array) $myphoto);
                        
                        $str = explode('media_id":"', $moph);
                        
                        if ( @$str[1] ) {
                            
                            $rd = explode('"', $str[1]);
                            
                            sami($rd[0], $args['id'], $args['account'], 'instagram', $user_id);
                            
                        }
                        
                        return true;
                        
                    } else {
                        
                        return false;
                        
                    }
                    
                } catch (Exception $e) {
                    
                    try {
                        
                        sleep(1);
                        
                        $myphoto = $check->timeline->uploadPhoto($resizer->getFile(), ['caption' => $caption]);
                        
                        if ( $myphoto ) {
                            
                            $moph = json_encode((array) $myphoto);
                            
                            $str = explode('media_id":"', $moph);
                            
                            if ( @$str[1] ) {
                                
                                $rd = explode('"', $str[1]);
                                
                                sami($rd[0], $args['id'], $args['account'], 'instagram', $user_id);
                                
                            }
                            
                            return true;
                            
                        } else {
                            
                            return false;
                            
                        }
                        
                    } catch (Exception $e) {

                        // Save the error
                        $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', $e->getMessage());

                        // Then return false
                        return false;
            
                    }
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) ['color' => '#517fa6', 'icon' => '<i class="fa fa-instagram"></i>', 'rss' => true, 'api' => ['proxy'], 'types' => 'text, links, images', 'categories' => false];
        
    }

    /**
     * The public method preview generates a preview for Instagram.
     *
     * @param $args contains the img or url.
     * 
     * @return object with html
     */
    public function preview($args) {
        
        if (filter_var($args['img'], FILTER_VALIDATE_URL) === FALSE) {
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . display_mess(143) . '</p></div>'];
        }
        
        return (object) [
                    'name' => 'instagram',
                    'icon' => '<button type="button" class="btn"><i class="fa fa-instagram"></i><span data-network="instagram"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="tumblr"><a href="#instagram" data-toggle="tab"><i class="fa fa-instagram"></i></a></li>',
                    'content' => '<div class="tab-pane" id="instagram">
					<div class="instagram forall">
                                                <div>
                                                    <p class="previmg"><img src="' . $args['img'] . '"></p>
                                                    <p class="prevtext"></p>
                                                </div>
                                            </div>
                                    </div>'];
    }

}
