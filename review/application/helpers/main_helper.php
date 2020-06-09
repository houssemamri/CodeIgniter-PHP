<?php
if ( !defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Name: Main Helper
 * Author: Scrisoft
 * Created: 22/04/2016
 * Here you will find the following functions:
 * get_browser_class - display the browser name as class
 * publish - publishes posts on the social networks
 * calculate_time - calculates time by using current time and publish time
 * get_site - gets url's content to display a preview for social networks
 * if_scheduled - checks if the post is scheduled
 * get_option - checks if an option is checked
 * get_network_details - get details about a network
 * get_categories - gets categories for the blogs
 * smtp - configures smtp access
 * savi - saves publish status
 * daccounts - display accounts by social networks
 * heads - displays the backend custom colors
 * lheads - displays the custom styles for the login page
 * plan_feature - gets plan's feature
 * plan_explore - gets plan's start time
 * get_user_option - gets the current user option by option name
 * custom_header - custom the user's header
 * */
if ( !function_exists( 'get_browser_class' ) ) {
    
    /**
     * The function returns the browser name
     *
     * @return void
     */
    function get_browser_class() {

        // Verify if browser is
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE ) {
            
            echo ' class="browser-internet-explorer"';
            
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE ) {
            
            echo ' class="browser-google-chrome"';
            
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE ) {
            
            echo ' class="browser-firefox"';
            
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE ) {
            
            echo ' class="browser-opera"';
            
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE ) {
            
            echo ' class="browser-safari"';
            
        }
        
    }
    
}

if ( !function_exists('publish') ) {

    /**
     * The function publishes a post
     * 
     * @param array $args contains the post's data
     * @param integer $user_id contains the user's ID
     * 
     * @return boolean true or false
     */
    function publish($args, $user_id = NULL) {
        
        // Make first word uppercase
        $network = ucfirst($args['network']);
        
        // Require the interface Autopost
        require_once APPPATH . 'interfaces/Autopost.php';
        
        // Verify if social network class exists
        if ( file_exists(APPPATH . 'autopost/' . $network . '.php') ) {
            
            // Require file
            require_once APPPATH . 'autopost/' . $network . '.php';
            
            // Call class
            $get = new $network;
            
            // Publish
            $pub = $get->post($args, $user_id);
            
            // Verify if post was published
            if ( $pub ) {
                
                return @$pub;
                
            } else {
                
                return false;
                
            }
            
        }
        
    }

}

if ( !function_exists( 'calculate_time' ) ) {

    /**
     * The function will calculate time between two dates
     * 
     * @param integer $from contains the time from
     * @param integer $to contains the time to
     * 
     * @return boolean true or false
     */
    function calculate_time($from, $to) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Calculate time difference
        $calculate = $to - $from;
        
        // Get after icon
        $after = ' ' . $CI->lang->line('mm104');
        
        // Define $before variable
        $before = '';
        
        // Verify if the difference time is less than 0
        if ( $calculate < 0 ) {
            
            // Get absolute value
            $calculate = abs($calculate);
            
            // Get icon
            $after = '<i class="fa fa-calendar-check-o pull-left" aria-hidden="true"></i> ';
            
            $before = '';
            
        }
        
        // Verify if the difference time is less than 1 minute
        if ( $calculate < 60 ) {
            
            return $CI->lang->line('mm105');
            
        } else if ( $calculate < 3600 ) {
            
            // Display one minute text
            $calc = $calculate / 60;
            return $before . round($calc) . ' ' . $CI->lang->line('mm106') . $after;
            
        } else if ($calculate > 3600 AND $calculate < 86400) {
            
            // Display one hour text
            $calc = $calculate / 3600;
            return $before . round($calc) . ' ' . $CI->lang->line('mm107') . $after;
            
        } else if ($calculate >= 86400) {
            
            // Display one day text
            $calc = $calculate / 86400;
            return $before . round($calc) . ' ' . $CI->lang->line('mm103') . $after;
            
        }
        
    }

}

if ( !function_exists('get') ) {

    /**
     * The function gets content via http request
     * 
     * @param string $val contains the url
     * 
     * @return string with parsed content
     */
    function get( $val ) {
        
        // Initialize a cURL session
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_FRESH_CONNECT => true, CURLOPT_FAILONERROR => true, CURLOPT_FOLLOWLOCATION => false, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_URL => $val, CURLOPT_HEADER => 'User-Agent: Chrome\r\n', CURLOPT_TIMEOUT => '3L'));
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
        
    }

}

if ( !function_exists('post') ) {

    /**
     * The function post content via http request
     * 
     * @param string $val contains the url
     * @param array $param contains the params to send
     * @param string $token contains the token
     * 
     * @return data with returned content
     */
    function post($val, $param, $token = NULL) {
        
        // Initialize a cURL session
        $curl = curl_init($val);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($param));
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
        
    }

}

if ( !function_exists( 'get_site' ) ) {
    
    /**
     * The function parses content from url
     * 
     * @param string $url contains the url
     * 
     * @return array with parsed content
     */
    function get_site( $url ) {
        
        // Parse content from url
        $get = @get($url);
        
        // Verify if content was got
        if ( $get ) {
            
            // Define image variable
            $img = "";
            
            // Define description variable
            $desc = "";
            
            // Define title variable
            $title = "";
            
            // Represents an entire HTML or XML document
            $content = new DOMDocument();
            
            // Load HTML from parsed content
            @$content->loadHTML($get);
            
            // Verify if content was loaded
            if ( $content ) {
                
                // Do not remove redundant white space.
                $content->preserveWhiteSpace = false;
                
                // Get meta variables
                foreach ( @$content->getElementsByTagName('meta') as $meta ) {
                    
                    // Get title
                    if ( @$meta->getAttribute('property') == "og:title" ) {
                        
                        // Get og:title
                        $title = $meta->getAttribute('content');
                        
                    }
                    
                    // Get image
                    if ( @$meta->getAttribute('property') == "og:image" ) {
                        
                        // Verify if the image was already token
                        if ( !$img ) {
                            
                            // Get og:image
                            $img = $meta->getAttribute('content');
                            
                        }
                        
                    }
                    
                    
                    if ( @$meta->getAttribute('property') == "twitter:image" ) {
                        
                        // Verify if the image was already token
                        if (!$img) {

                            // Get og:image
                            $img = $meta->getAttribute('content');
                        }
                    }
                    
                    // Verify if the image was already token
                    if ( !$img ) {
                        
                        // If $img is empty will check others methods to find an image in head
                        $tags = @get_meta_tags($url);
                        
                        // Verify if image exists
                        if ( @$tags["og:image"] ) {
                            
                            $img = $tags["og:image"];
                            
                        }
                        
                        if ( @$tags["twitter:image"] ) {
                            
                            $img = $tags["twitter:image"];
                            
                        }
                        
                    }
                    
                    // If is the meta tag description
                    if ( @$meta->getAttribute('property') == "description" ) {
                        
                        // Get meta description
                        $desc = $meta->getAttribute('content');
                        
                    }
                    
                    // If is the og description
                    if ( @$meta->getAttribute('property') == "og:description" ) {
                        
                        // Get og:description
                        $desc = $meta->getAttribute('content');
                        
                    }
                    
                }
                
            }
            
            // Check if title exists
            if ( !$title ) {
                
                // Get title
                $tit = @$content->getElementsByTagName('title');
                
                if ( $tit ) {
                    
                    $title = @$tit->item(0)->nodeValue;
                    
                }
                
                if ( !$title ) {
                    
                    $title = str_replace(["http://", "https://"], ["", ""], $url);
                    
                }
                
            }
            
            if ( !$img ) {
                
                $img = get_instance()->config->base_url() . 'assets/img/no-image.png';
                
            }
            
            // Will be returned an array with title, image, description
            return ['title' => htmlentities($title), 'description' => htmlentities($desc), 'img' => $img];
            
        } else {
            
            // Set not found image
            $img = get_instance()->config->base_url() . 'assets/img/no-image.png';
            
            // Set url
            $url = str_replace(["http://", "https://"], ["", ""], $url);
            
            // Return array with parsed content
            return ['title' => $url, 'description' => $url, 'img' => $img];
            
        }
        
    }

}

if (!function_exists('if_scheduled')) {

    /**
     * The function will check if the RSS's post is scheduled
     * 
     * @param integer $rss_id contains the rss's ID
     * @param string $rss_url contains the rss's url
     * 
     * @return boolean true or false
     */
    function if_scheduled($rss_id, $rss_url) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Rss Model
        $CI->load->model('rss');
        
        if ( $CI->rss->if_post_scheduled($rss_id, $rss_url) ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

}

if ( !function_exists('get_option') ) {

    /**
     * The function gets option by option's name
     * 
     * @param string $name contains the option's name
     * 
     * @return string with option's value
     */
    function get_option( $name ) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Options Model
        $CI->load->model('options');
        
        // Return option's value
        return $CI->options->get_an_option($name);
        
    }

}

if ( !function_exists('get_network_details') ) {

    /**
     * The function gets user accounts per network
     * 
     * @param string $name contains the network's name
     * 
     * @return array with network's data
     */
    function get_network_details($network) {
        
        // Require Autopost's interface
        require_once APPPATH . 'interfaces/Autopost.php';
        
        // Check if the $network exists in autopost
        if ( file_exists(APPPATH . 'autopost/' . $network . '.php') ) {
            
            // Now we need to get the key
            require_once APPPATH . 'autopost/' . $network . '.php';
            
            // Call the network class
            $get = new $network;
            
            // Get codeigniter object instance
            $CI = get_instance();
            
            // Load Networks Model
            $CI->load->model('networks');
            
            // Load User Model
            $CI->load->model('user');
            
            // Get user's ID
            $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
            
            // Get accounts per network
            $accounts = $CI->networks->get_accounts($user_id, $network);
            
            // Return array with network info and accounts
            return ['network' => $get->get_info(), 'accounts' => $accounts];
            
        }
        
    }

}

if ( !function_exists( 'get_categories' ) ) {

    /**
     * The function gets categories
     * 
     * @param string $name contains the network's name
     * 
     * @return string with categories
     */
    function get_categories( $categories ) {
        
        // Make uppercase first letter
        $network = ucfirst( @$categories['network'] );
        
        // Get blog's id
        $blog_id = @$categories['blog_id'];
        
        // Gets all categories from a blog.
        if ( $network == 'Blogger' ) {
            
            // Require the Autopost's interface
            require_once APPPATH . 'interfaces/Autopost.php';
            
            // Check if the $network exists in autopost
            if ( file_exists(APPPATH . 'autopost/' . $network . '.php') ) {
                
                // Now we need to get the key
                require_once APPPATH . 'autopost/' . $network . '.php';
                
                // Call the network class
                $get = new $network;
                
                // Get Blogger's api
                $key = get_option('blogger_api_key');
                
                // Initialize a cURL session
                $curl = curl_init();
                curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://www.googleapis.com/blogger/v2/blogs/' . $blog_id . '/posts?fields=items&labels&key=' . $key, CURLOPT_HEADER => 'User-Agent: Chrome\r\n', CURLOPT_TIMEOUT => '3L'));
                $getCategories = curl_exec($curl);
                curl_close($curl);
                
                // Decode categories
                $getCategories = json_decode($getCategories);
                
                // Verify if categories exists
                if ( @$getCategories->items ) {
                    
                    $cats = [];
                    
                    $categories = [];
                    
                    foreach ( $getCategories->items as $category ) {
                        
                        // Verify if category was already added
                        if ( !in_array($category->labels[0], $cats) ) {
                            
                            // Add categories
                            $categories[] = '<option value="' . $category->labels[0] . '">' . $category->labels[0] . '</option>';
                            $cats[] = $category->labels[0];
                            
                        }
                        
                    }
                    
                    return $categories;
                    
                }
                
            }
            
        } elseif ( $network == 'Wordpress' ) {
            
            // Require the Autopost's interface
            require_once APPPATH . 'interfaces/Autopost.php';
            
            // Check if the $network exists in autopost
            if ( file_exists(APPPATH . 'autopost/' . $network . '.php' ) ) {
                
                // Now we need to get the key
                require_once APPPATH . 'autopost/' . $network . '.php';
                
                // Call the network class
                $get = new $network;
                
                // Get categories
                $cats = get( 'https://public-api.wordpress.com/rest/v1.1/sites/' . $blog_id . '/categories' );
                
                // Decode response
                $get = json_decode( $cats );
                
                $categories = [];
                
                // Verify if categories exists
                if ( @$get->categories ) {
                    
                    // Lists all categories
                    foreach ( $get->categories as $category ) {
                        
                        $categories[] = '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        
                    }
                    
                    return $categories;
                    
                }
                
            }
            
        } elseif ($network == 'Wordpress_platform') {
            
            // Require the Autopost's interface
            require_once APPPATH . 'interfaces/Autopost.php';
            
            // Check if the $network exists in autopost
            if ( file_exists(APPPATH . 'autopost/' . $network . '.php') ) {
                
                // Now we need to get the key
                require_once APPPATH . 'autopost/' . $network . '.php';
                
                // Call the network's class
                $get = new $network;
                
                // Get codeigniter object instance
                $CI = get_instance();
                
                // Load the User's model
                $CI->load->model('user');
                
                // Load the Networks's model
                $CI->load->model('networks');
                
                // Get user's ID
                $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
                
                // Get site url
                $site_url = $CI->networks->get_account_field($user_id, $blog_id, 'user_avatar');
                
                // Get categories
                $get = @get($site_url . '?key=' . $blog_id . '&catget=1');
                
                // Decode response
                $get = json_decode($get);
                
                // Define the array categories
                $categories = [];
                
                // Verify if categories exists
                if ( @$get ) {
                    
                    // Lists all categories
                    foreach ( $get as $category ) {
                        
                        // Add category to the array $categories
                        $categories[] = '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                        
                    }
                    
                    return $categories;
                    
                }
                
            }
            
        } elseif ($network == 'Reddit') {
            
            $categories = [];
            $categories[] = '<option value="funny">Funny</option>';
            $categories[] = '<option value="gifs">Gifs</option>';
            $categories[] = '<option value="gaming">Gaming</option>';
            $categories[] = '<option value="jokes">Jokes</option>';
            $categories[] = '<option value="personalfinance">Personal Finance</option>';
            $categories[] = '<option value="pics">Pics</option>';
            $categories[] = '<option value="movies">Movies</option>';
            $categories[] = '<option value="music">Music</option>';
            $categories[] = '<option value="worldnews">News</option>';
            $categories[] = '<option value="videos">Videos</option>';
            
            return $categories;
            
        } elseif ($network == 'Youtube') {
            
            $categories = [];
            $categories[] = '<option value="1">Film & Animation</option>';
            $categories[] = '<option value="2">Autos & Vehicles</option>';
            $categories[] = '<option value="10">Music</option>';
            $categories[] = '<option value="15">Pets & Animals</option>';
            $categories[] = '<option value="17">Sports</option>';
            $categories[] = '<option value="18">Short Movies</option>';
            $categories[] = '<option value="20">Gaming</option>';
            $categories[] = '<option value="21">Videoblogging</option>';
            $categories[] = '<option value="22">People & Blogs</option>';
            $categories[] = '<option value="25">News & Politics</option>';
            $categories[] = '<option value="27">Education</option>';
            
            return $categories;
            
        } elseif ($network == 'The_500px') {
            
            $categories = [];
            $categories[] = '<option value="0">Uncategorized</option>';
            $categories[] = '<option value="18">Nature</option>';
            $categories[] = '<option value="11">Animals</option>';
            $categories[] = '<option value="1">Celebrities</option>';
            $categories[] = '<option value="2">Film</option>';
            $categories[] = '<option value="7">People</option>';
            $categories[] = '<option value="3">Journalism</option>';
            $categories[] = '<option value="19">City and Architecture</option>';
            $categories[] = '<option value="20">Family</option>';
            $categories[] = '<option value="23">Food</option>';
            $categories[] = '<option value="13">Travel</option>';
            $categories[] = '<option value="10">Abstract</option>';
            $categories[] = '<option value="14">Fashion</option>';
            
            return $categories;
            
        }
        
    }

}


if ( !function_exists('smtp') ) {

    /**
     * The function provides the smtp configuration
     * 
     * @return array with smtp's configuration
     */
    function smtp() {
        
        // Verify if the smtp option is enabled
        if ( get_option('smtp-enable') ) {
            
            // Set the default protocol
            $protocol = 'sendmail';
            
            // Verify if user have added a protocol
            if ( get_option('smtp-protocol') ) {
                
                $protocol = get_option('smtp-protocol');
                
            }
            
            // Create the configuration array
            $d = ['mailtype' => 'html', 'charset' => 'utf-8', 'smtpauth' => true, 'priority' => '1', 'newline' => "\r\n", 'protocol' => $protocol, 'smtp_host' => get_option('smtp-host'), 'smtp_port' => get_option('smtp-port'), 'smtp_user' => get_option('smtp-username'), 'smtp_pass' => get_option('smtp_password')];
            
            // Verify if ssl is enabled
            if (get_option('smtp-ssl')) {
                
                $d['smtp_crypto'] = 'ssl';
                
            } elseif (get_option('smtp-tls')) {
                
                // Set TSL if is enabled
                $d['smtp_crypto'] = 'tls';
                
            }
            
            return $d;
            
        } else {
            
            return ['mailtype' => 'html', 'charset' => 'utf-8', 'newline' => '\r\n', 'priority' => '1'];
            
        }
        
    }

}

if ( !function_exists('sami') ) {

    /**
     * The function saves publish status
     * 
     * @return void
     */
    function sami($param, $id, $acc, $net, $user_id = NULL) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load the model posts
        $CI->load->model('posts');
        
        // If user is null
        if ( !$user_id ) {
            
            // Get user_id
            $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
            
        }
        
        if ( $param ) {
            
            // Saves response in the database
            $CI->posts->upo($id, $param, $acc, $net, $user_id);
            
        }
        
    }

}

if ( !function_exists('daccounts') ) {

    /**
     * The function displays accounts by social networks
     * 
     * @param string $name contains the network's name
     * @param integer $data contains the selected networks
     * 
     * @return string with categories
     */
    function daccounts($data, $network = NULL) {
        
        // Verify if $data is empty
        if ($data) {
            
            // Get codeigniter object instance
            $CI = get_instance();
            
            // Get networks model
            $CI->load->model('networks');
            
            // Verify if the network as already selected
            if ( property_exists($data, $network) ) {
                
                // Get network id
                $nts = json_decode($data->$network);
                
                // Verify if network 
                if ( $nts ) {
                    
                    // Verify if nts is numeric
                    if ( is_numeric($nts) ) {
                        
                        // Get network details
                        $net = $CI->networks->get_account($nts);
                        
                        // Define the variable $dot
                        $dot = '';
                        
                        if ($net) {
                            
                            // Get expire time if exists
                            $expire = (trim($net[0]->expires) == "") ? 'never' : substr($net[0]->expires, 0, 19);
                            
                            // Add account to the variable dot
                            $dot .= '<li>' . $net[0]->user_name . ' <span class="expires">' . $CI->lang->line('mu39') . ': <strong>' . $expire . '</strong></span><div class="btn-group pull-right"><button type="button" class="btn btn-default select-net active" data-account="' . $nts . '">' . $CI->lang->line('mu206') . '</button></div></li>';
                            
                        }
                        
                        return $dot;
                        
                    } else {
                        
                        // Define the variable $dot
                        $dot = '';
                        
                        // Lists all accounts
                        foreach ($nts as $account) {
                            
                            // Get account
                            $net = $CI->networks->get_account($account);
                            
                            // Verify if account is enabled
                            if ($net) {
                                
                                // Get expire time
                                $expire = (trim($net[0]->expires) == "") ? 'never' : substr($net[0]->expires, 0, 19);
                                
                                // Add account to the variable dot
                                $dot .= '<li>' . $net[0]->user_name . ' <span class="expires">' . $CI->lang->line('mu39') . ': <strong>' . $expire . '</strong></span><div class="btn-group pull-right"><button type="button" class="btn btn-default select-net active" data-account="' . $account . '">' . $CI->lang->line('mu206') . '</button></div></li>';
                                
                            }
                            
                        }
                        
                        return $dot;
                        
                    }
                    
                } else {
                    
                    return false;
                    
                }
                
            } else {
                
                return false;
                
            }
            
        }
        
    }

}

if ( !function_exists('heads') ) {

    /**
     * The function displays the custom colors
     * 
     * @param string $data contains the header
     * 
     * @return string with styles
     */
    function heads( $data ) {
        
        // Get menu color
        $menu = get_option('main-menu-color');
        
        // Get the menu text color
        $menu_text = get_option('main-menu-text-color');
        
        // Get the panel heading colors
        $panel_heading = get_option('panel-heading-color');
        
        // Get the panel heading text colors
        $panel_heading_text = get_option('panel-heading-text-color');
        
        // Verify if one of the color above exists
        if ( ($menu != '') || ($menu_text != '') || ($panel_heading != '') || ($panel_heading_text != '') ) {
            
            // Create the custom styles
            $style = '<style>';
            
            if ( $menu ) {
                
                $style .= 'nav{background-color: ' . $menu . ' !important;}';
                
            }
            
            if ( $menu_text ) {
                
                $style .= 'nav a{color: ' . $menu_text . ' !important;}';
                
            }
            
            if ( $panel_heading ) {
                
                $style .= '.panel-heading {background: ' . $panel_heading . ';}';
                
            }
            
            if ( $panel_heading_text ) {
                
                $style .= '.panel-heading, .panel-heading>h2>a, .panel-heading>h2>span {color: ' . $panel_heading_text . ' !important;}';
                
            }
            
            $style .= '</style></head>';
            
            return str_replace('</head>', $style, $data);
            
        } else {
            
            return $data;
            
        }
        
    }

}

if ( !function_exists('lheads') ) {

    /**
     * The function displays the custom styles for the login page
     * 
     * @return string with styles
     */
    function lheads() {
        
        // Get the login page background color
        $bg_color = get_option('login-bg-color');
        
        // Get the login text color
        $bg_color_text = get_option('login-text-color');
        
        // Get the login button color
        $bg_button = get_option('login-button-color');
        
        // Verify if one of the culors above exists
        if ( ($bg_color != '') || ($bg_color_text != '') || ($bg_button != '') ) {
            
            // Create the custom styles
            $style = '<style>';
            
            if ( $bg_color ) {
                
                $style .= 'body{background-color: ' . $bg_color . ' !important;}';
                
            }
            
            if ($bg_color_text) {
                
                $style .= 'body,a,button{color: ' . $bg_color_text . ' !important;}';
                
            }
            
            if ($bg_button) {
                
                $style .= '.btn-all {background: ' . $bg_button . ' !important;border-color: ' . $bg_button . ' !important;}.btn-sign:hover, .btn-sign:active, .btn-sign:focus{opacity:0.8 !important;}.btn-reset{color: ' . $bg_button . ' !important;opacity:0.5;}.btn-reset:hover{opacity:0.8;}';
                
            }
            
            $style .= '</style>';
            
            echo $style;
            
        }
        
    }

}

if ( !function_exists('plan_explore') ) {

    /**
     * The function gets user plan start time
     * 
     * @return string with time
     */
    function plan_explore($user_id) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load the Plans model
        $CI->load->model('plans');
        
        // Return time when started the plan
        return $CI->plans->plan_started($user_id);
        
    }

}

if (!function_exists('get_user_option')) {
    
    /**
     * The function gets the user options
     * 
     * @return string with time
     */
    function get_user_option($option, $user_id = NULL) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Verify if user_id exists
        if ( !$user_id ) {
            
            // Get user_id
            $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
            
        }
        
        // Load User Meta Model
        $CI->load->model('user_meta');
        
        // Get User's options
        $user_options = $CI->user_meta->get_all_user_options($user_id);
        
        // Verify if user has the option
        if ( @$user_options[$option] ) {
            
            return $user_options[$option];
            
        }
        
    }

}

if (!function_exists('plan_feature')) {
    
    /**
     * The function gets plan's feature
     * 
     * @return string with time
     */
    function plan_feature($feature) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load User Model
        $CI->load->model('user');
        
        // Load Plans Model
        $CI->load->model('plans');
        
        // Get user id
        $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
        
        //Return the plan's feature
        return $CI->plans->get_plan_features($user_id, $feature);
        
    }

}

if (!function_exists('custom_header')) {
    
    /**
     * The function helps to custom the header
     * 
     * @return string with custom code
     */
    function custom_header() {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Add main stylesheet file
        $data = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/user/css/style.css?ver=' . MD_VER . '" media="all"/>';
        
        $data .= "\n";
        if ( $CI->router->fetch_method() == 'emails' ) {
            $data .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/jquery-ui.min.css" media="all"/> ';
            $data .= "\n";
        }
        
        if ( $CI->router->fetch_method() == 'team' ) {
            $data .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/user/css/teams.css?ver=' . MD_VER . '" media="all"/> ';
            $data .= "\n";
        }
        
        if ( $CI->router->fetch_method() == 'emails' || $CI->router->fetch_method() == 'bots' ) {
            $data .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/user/css/emails.css?ver=' . MD_VER . '" media="all"/> ';
            $data .= "\n";
        }
        
        if ( $CI->router->fetch_method() == 'posts' ) {
            $data .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/user/css/posts.css?ver=' . MD_VER . '" media="all"/> ';
            $data .= "\n";
        }
        
        if ( $CI->router->fetch_method() == 'insights_page' ) {
            $data .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/user/css/insights.css?ver=' . MD_VER . '" media="all"/> ';
            $data .= "\n";
        }
        
        return $data;
        
    }

}

if (!function_exists('parse_array')) {
    
    /**
     * The function applies a user function recursively to every member of an array
     * 
     * @return string with custom code
     */
    function parse_array($array) {
        
        $parsed = array();
        
        array_walk_recursive($array, function($a) use (&$parsed) {
            $parsed[] = $a;
        });
        
        return $parsed;
        
    }

}