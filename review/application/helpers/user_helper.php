<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Name: User Helper
 * Author: Scrisoft
 * Created: 20/11/2017
 * Here you will find the following functions:
 * check_plan_networks - verifies if a networks will be available
 * get_all_plan_networks - gets allowed networks of the current user
 * generate_user_statstics - generates statics for User Dasboard
 * user_header - gets the user header
 * get_widgets - display widgets in the user dashboard
 * get_accounts_per_network - gets all user accounts from a social network
 * */
if ( !function_exists( 'check_plan_networks' ) ) {
    
    /**
     * The function check_plan_networks verifies if a networks will be available
     * 
     * @param string $network contains the network name
     * 
     * @return boolean true or false
     */
    function check_plan_networks( $network ) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Plans Model
        $CI->load->model('plans');
        
        // Get the user's ID
        $user_id = $CI->ecl('Instance')->user();
        
        // Verify if user can publish in the social network
        $networks = $CI->plans->get_plan_features($user_id, 'allowed_networks');
        
        // Verify if is available
        if ( $networks ) {
            
            if ( $networks == '{}' ) {
                
                return true;
                
            } else {
                
                // Decode networks json object
                $nets = json_decode($networks);
                if ( @$nets->$network ) {
                    
                    return true;
                    
                } else {
                    
                    return false;
                    
                }
                
            }
            
        } else {
            
            return true;
            
        }
        
    }
    
}

if ( !function_exists('get_all_plan_networks') ) {
    
    /**
     * The function get_all_plan_networks gets allowed social networks for the current plan
     * 
     * @param boolean $a allows to decide if the social networks will be displayed or returned 
     * 
     * @return object with networks or void
     */
    function get_all_plan_networks( $a=NULL ) {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Plans Model
        $CI->load->model('plans');
        
        // Get user_id
        $user_id = $CI->ecl('Instance')->user();
        
        // Get allowed social networks per plan
        $networks = str_replace('{}', '', $CI->plans->get_plan_features($user_id, 'allowed_networks'));
        
        if ( $a ) {
            
            return $networks;
            
        } else {
            
            echo json_encode($networks);
            
        }
        
    }
    
}

if ( !function_exists('generate_user_statstics') ) {

    /**
     * The function get_all_plan_networks gets allowed social networks for the current plan
     * 
     * @param integer $period contains the time period
     * @param array $posts contains the published user's posts
     * 
     * 
     * @return string with statistics
     */
    function generate_user_statstics($period, $posts = NULL) {
        
        // Verify if parameters aren't null
        if ( $period > 0 AND $posts > 0 ) {
            
            // Increase period
            $period++;
            
            // Define data variable
            $data = '';
            
            // Get all available networks per plan
            $networks = get_all_plan_networks(1);
            
            if ( $networks ) {
                
                $networks = json_decode($networks);
                
            }
            
            // Create an object with statistics
            for ( $i = 0; $i < $period; $i++ ) {
                
                // Get current date
                $current_date = date('Y-m-d', strtotime('-' . $i . 'day', strtotime(date('Y-m-d'))));
                
                if ( array_key_exists($current_date, $posts) ) {
                    
                    $d = '';
                    
                    if ( !$networks || (property_exists($networks, 'facebook') == true) ) {
                        
                        if ( array_key_exists('facebook', $posts[$current_date]) ) {
                            
                            $d .= ', Facebook: ' . $posts[$current_date]['facebook'] . '';
                            
                        } else {
                            
                            $d .= ', Facebook: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'vk') == true) ) {
                        
                        if ( array_key_exists('vk', $posts[$current_date]) ) {
                            
                            $d .= ', Vk: ' . $posts[$current_date]['vk'] . '';
                            
                        } else {
                            
                            $d .= ', Vk: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'twitter') == true) ) {
                        
                        if ( array_key_exists('twitter', $posts[$current_date]) ) {
                            
                            $d .= ', Twitter: ' . $posts[$current_date]['twitter'] . '';
                            
                        } else {
                            
                            $d .= ', Twitter: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'tumblr') == true) ) {
                        
                        if ( array_key_exists('tumblr', $posts[$current_date]) ) {
                            
                            $d .= ', Tumblr: ' . $posts[$current_date]['tumblr'] . '';
                            
                        } else {
                            
                            $d .= ', Tumblr: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'pinterest') == true) ) {
                        
                        if ( array_key_exists('pinterest', $posts[$current_date]) ) {
                            
                            $d .= ', Pinterest: ' . $posts[$current_date]['pinterest'] . '';
                            
                        } else {
                            
                            $d .= ', Pinterest: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'blogger') == true) ) {
                        
                        if ( array_key_exists('blogger', $posts[$current_date]) ) {
                            
                            $d .= ', Blogger: ' . $posts[$current_date]['blogger'] . '';
                            
                        } else {
                            
                            $d .= ', Blogger: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'wordpress') == true) ) {
                        
                        if ( array_key_exists('wordpress', $posts[$current_date]) ) {
                            
                            $d .= ', Wordpress: ' . $posts[$current_date]['wordpress'] . '';
                            
                        } else {
                            
                            $d .= ', Wordpress: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'medium') == true) ) {
                        
                        if ( array_key_exists('medium', $posts[$current_date]) ) {
                            
                            $d .= ', Medium: ' . $posts[$current_date]['medium'] . '';
                            
                        } else {
                            
                            $d .= ', Medium: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'linkedin') == true) ) {
                        
                        if ( array_key_exists('linkedin', $posts[$current_date]) ) {
                            
                            $d .= ', Linkedin: ' . $posts[$current_date]['linkedin'] . '';
                            
                        } else {
                            
                            $d .= ', Linkedin: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'linkedin_companies') == true) ) {
                        
                        if ( array_key_exists('linkedin_companies', $posts[$current_date]) ) {
                            
                            $d .= ', LinkedinCompanies: ' . $posts[$current_date]['linkedin_companies'] . '';
                            
                        } else {
                            
                            $d .= ', LinkedinCompanies: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'flickr') == true) ) {
                        
                        if ( array_key_exists('flickr', $posts[$current_date]) ) {
                            
                            $d .= ', Flickr: ' . $posts[$current_date]['flickr'] . '';
                            
                        } else {
                            
                            $d .= ', Flickr: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'instagram') == true) ) {
                        
                        if ( array_key_exists('instagram', $posts[$current_date]) ) {
                            
                            $d .= ', Instagram: ' . $posts[$current_date]['instagram'] . '';
                            
                        } else {
                            
                            $d .= ', Instagram: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'reddit') == true) ) {
                        
                        if ( array_key_exists('reddit', $posts[$current_date]) ) {
                            
                            $d .= ', Reddit: ' . $posts[$current_date]['reddit'] . '';
                            
                        } else {
                            
                            $d .= ', Reddit: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'facebook_pages') == true) ) {
                        
                        if ( array_key_exists('facebook_pages', $posts[$current_date]) ) {
                            
                            $d .= ', FacebookPages: ' . $posts[$current_date]['facebook_pages'] . '';
                            
                        } else {
                            
                            $d .= ', FacebookPages: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'facebook_groups') == true) ) {
                        
                        if ( array_key_exists('facebook_groups', $posts[$current_date]) ) {
                            
                            $d .= ', FacebookGroups: ' . $posts[$current_date]['facebook_groups'] . '';
                            
                        } else {
                            
                            $d .= ', FacebookGroups: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'youtube') == true) ) {
                        
                        if ( array_key_exists('youtube', $posts[$current_date]) ) {
                            
                            $d .= ', Youtube: ' . $posts[$current_date]['youtube'] . '';
                            
                        } else {
                            
                            $d .= ', Youtube: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'google_plus') == true) ) {
                        
                        if ( array_key_exists('google_plus', $posts[$current_date]) ) {
                            
                            $d .= ', GooglePlus: ' . $posts[$current_date]['google_plus'] . '';
                            
                        } else {
                            
                            $d .= ', GooglePlus: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'dailymotion') == true) ) {
                        
                        if ( array_key_exists('dailymotion', $posts[$current_date]) ) {
                            
                            $d .= ', Dailymotion: ' . $posts[$current_date]['dailymotion'] . '';
                            
                        } else {
                            
                            $d .= ', Dailymotion: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'imgur') == true) ) {
                        
                        if ( array_key_exists('imgur', $posts[$current_date]) ) {
                            
                            $d .= ', Imgur: ' . $posts[$current_date]['imgur'] . '';
                            
                        } else {
                            
                            $d .= ', Imgur: 0';
                            
                        }
                        
                    }
                    
                    if ( !$networks || (property_exists($networks, 'the_500px') == true) ) {
                        
                        if ( array_key_exists('the_500px', $posts[$current_date]) ) {
                            
                            $d .= ', The500px: ' . $posts[$current_date]['the_500px'] . '';
                            
                        } else {
                            
                            $d .= ', The500px: 0';
                            
                        }
                        
                    }
                    
                    $data .= "{period: '" . $current_date . "' " . $d . "},";
                    
                }
                
            }
            
            return "[" . $data . "]";
            
        } else {
            
            return "[{period: '" . date('Y-m-d') . "', sent: 0}]";
            
        }
        
    }

}

if ( !function_exists('user_header') ) {

    /**
     * The function generates statistics for user header
     *
     * @return array with statistics
     */
    function user_header() {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Notifications Model
        $CI->load->model('notifications');
        
        // Load Posts Model
        $CI->load->model('posts');
        
        // Load User Model
        $CI->load->model('user');
        
        // Load Tickets Model
        $CI->load->model('tickets');
        
        // Get user_id
        $user_id = $CI->user->get_user_id_by_username($CI->session->userdata['username']);
        
        // Get last 10 user's posts
        $posts = $CI->posts->get_last_ten_posts($user_id);
        
        // Define the variable $msg
        $msg = "";
        
        $allerrors = 0;
        
        if ( $posts ) {
            
            $count_errors = 0;
            
            foreach ( $posts as $post ) {
                
                // Check posts publishing error by post_id
                $errors = $CI->posts->find_error_publishing_posts($post->post_id);
                
                $allerrors = $allerrors + $errors;
                
                // Short the post and stripe tags
                if (strlen($post->body) > 100) {
                
                    $body = substr(strip_tags($post->body), 0, 99) . "...";
                    
                } else {
                    
                    $body = strip_tags($post->body);
                    
                }
                
                $new = '';
                
                // Verify if post was read
                if ( $post->view == 1 ) {
                    
                    $new = 'new';
                    
                }
                
                $mer = '';
                
                // Verify if one of the last post wasn't published
                if ( $errors > 0 ) {
                    
                    $mer = ' mer';
                    
                }
                
                // Create the post content
                $msg .= '<li class="' . $new . $mer . '">
                            <div class="row">
                                <div class="col-lg-3 col-xs-3"><i class="fa fa-file-text-o" aria-hidden="true"></i></div>
                                <div class="col-lg-9 col-xs-9"><p><a href="' . site_url('user/history') . '#' . $post->post_id . '" class="showmessaggehistory">' . $body . '</a></p><span>' . calculate_time($post->sent_time, time()) . '</span> </div>
                            </div>
                        </li>';
            }
            
        } else {
            
            // No posts message
            $msg = '<li><div class="col-lg-12 col-xs-12"><p class="no-results">' . $CI->lang->line('mm116') . '</p></div></li>';
            
        }
        
        // Get notifications
        $notifications = $CI->notifications->get_notifications($user_id);
        
        $ntfcs = '';
        
        $count = 0;
        
        // Verify if notifications exists
        if ($notifications) {
            
            // List all notifications
            foreach ($notifications as $notification) {
                
                // Define variable new
                $new = '';
                
                // Verify if user has read the notification
                if ( $notification->user_id != $user_id ) {
                    
                    $new = 'new';
                    $count++;
                    
                }
                
                
                $ntfcs .= '<li class="' . $new . '">
                            <div class="row">
                                <div class="col-lg-3 col-xs-3"><i class="fa fa-bell-o"></i></div>
                                <div class="col-lg-9 col-xs-9"><p><a href="' . site_url('user/notifications') . '#' . $notification->id . '">' . $notification->notification_title . '</a></p><span>' . calculate_time($notification->sent_time, time()) . '</span> </div>
                            </div>
                        </li>';
            }
            
        } else {
            
            // No notifications message
            $ntfcs = '<li><div class="col-lg-12 col-xs-12"><p class="no-results">' . $CI->lang->line('mm131') . '</p></div></li>';
            
        }
        
        // Get all tickets
        $all_tickets = $CI->tickets->get_all_tickets_for($user_id);
        
        $tickets = '';
        
        $counti = 0;
        
        // Verify if tickets exists
        if ( $all_tickets ) {
            
            // List all tickets
            foreach ( $all_tickets as $ticket ) {
                
                // Define new variable
                $new = '';
                
                // Verify if the ticket was read already
                if ( $ticket->status == 2 ) {
                    
                    $new = 'new';
                    $counti++;
                    
                }
                
                $tickets .= '<li class="' . $new . '">
                                <div class="row">
                                    <div class="col-lg-3 col-xs-3"><i class="fa fa-question-circle-o"></i></div>
                                    <div class="col-lg-9 col-xs-9"><p><a href="' . site_url('user/get-ticket/' . $ticket->ticket_id) . '">' . $ticket->subject . '</a></p></div>
                                </div>
                            </li>';
            }
            
        } else {
            
            // No tickets found
            $tickets = '<li><div class="col-lg-12 col-xs-12"><p class="no-results">' . $CI->lang->line('mm201') . '</p></div></li>';
            
        }
        
        // Create an array 
        return ['errors' => $allerrors, 'msg' => $msg, 'new_notifications' => $count, 'new_tickets' => $counti, 'notifications' => $ntfcs, 'tickets' => $tickets];
        
    }

}


if ( !function_exists('get_widgets') ) {

    /**
     * The function displays widgets in the user dashboard
     * 
     * @param array $get_plan contains the plan information
     * @param object $lang contains the language
     * @param integer $expires_soon contains the expires time
     *
     * @return array with statistics
     */
    function get_widgets( $get_plan, $lang, $expires_soon ) {
        
        // Verify if plan information exists
        if ($get_plan) {
            
            // Get codeigniter object instance
            $CI = get_instance();
            
            // Load the Plans model
            $CI->load->model('plans');
            
            // Load the User_meta model
            $CI->load->model('user_meta');
            
            // Load the Rss model
            $CI->load->model('rss');
            
            // Load the Scheduled model
            $CI->load->model('scheduled');
            
            // Load the Networks model
            $CI->load->model('networks');
            
            // Define pland id by default
            $plan_id = 1;
            
            // Define plan end by default
            $plan_end = '';
            
            // List all plans
            for ( $k = 0; $k < count($get_plan['plan']); $k++ ) {
                
                if ($get_plan['plan'][$k]->meta_name == 'plan') {
                    
                    $plan_id = $get_plan['plan'][$k]->meta_value;
                    
                } else if ($get_plan['plan'][$k]->meta_name == 'plan_end') {
                    
                    $plan_end = $get_plan['plan'][$k]->meta_value;
                    
                }
                
            }
            
            // Get plans data by id
            $plan = $CI->plans->get_plan($plan_id);
            
            // Define widgets by default
            $widgets = '';
            
            // Verify if $plan_id exists 
            if ($plan_id) {
                
                // Calculate the plan period 
                $time = explode(' ', strip_tags(calculate_time(strtotime($plan_end), time())));
                
                // Clean the plan time
                $from = strip_tags(calculate_time($get_plan['time'], time()));
                
                // Get renew translation key 
                $renew = $lang->line('mu124');
                
                if ( $expires_soon ) {
                    
                    $renew = '<a href="' . site_url('user/plans') . '">' . $lang->line('mu124') . '</a>';
                    
                }
                
                // Create the Widget content
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                <div class="col-lg-12 clean">
                                    <div class="col-lg-4 clean">
                                        <h3 class="text-center">' . $time[0] . '</h3>
                                        <p class="text-center">' . $time[1] . ' ' . $lang->line('mu137') . '</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3><i class="fa fa-user-circle-o"></i> ' . $plan[0]->plan_name . '</h3>
                                        <div class="col-lg-12 clean">
                                            <div class="col-lg-6 clean">
                                                ' . $from . '<br>
                                                <span>' . $lang->line('mu122') . '</span>
                                            </div>
                                            <div class="col-lg-6 clean">
                                                <a href="' . site_url('user/plans') . '">' . $lang->line('mu123') . '</a><br>
                                                <span>' . $renew . '</span>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                            </div>';
                
            }
            
            // Get number of published posts
            $posts_published = $CI->user_meta->get_all_user_options($get_plan['plan'][0]->user_id);
            
            // Verify if user has published posts in this month
            if ( @$posts_published['published_posts'] ) {
                
                // Get number of published posts in this month
                $posts_published = unserialize($posts_published['published_posts']);
                
                if ( ($posts_published['date'] == date('Y-m')) ) {
                    
                    $posts_published = $posts_published['posts'];
                    
                } else {
                    
                    $posts_published = 0;
                    
                }
                
                // Create the widget
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                <div class="col-lg-12 clean">
                                    <div class="col-lg-4 clean">
                                        <h3 class="text-center">' . $posts_published . '</h3>
                                        <p class="text-center">' . $lang->line('mu126') . '</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3><i class="fa fa-file-text-o"></i> ' . $lang->line('mu125') . '</h3>
                                        <div class="col-lg-12 clean">
                                            <div class="col-lg-6 clean">
                                                ' . $plan[0]->publish_posts . '<br>
                                                <span>' . $lang->line('mu127') . '</span>
                                            </div>
                                            <div class="col-lg-6 clean">
                                                ' . ($plan[0]->publish_posts - $posts_published) . '<br>
                                                <span>' . $lang->line('mu128') . '</span>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>';
                
            } else {
                
                // Create the widget
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                <div class="col-lg-12 clean">
                                    <div class="col-lg-4 clean">
                                        <h3 class="text-center">0</h3>
                                        <p class="text-center">' . $lang->line('mu126') . '</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3><i class="fa fa-file-text-o"></i> ' . $lang->line('mu125') . '</h3>
                                        <div class="col-lg-12 clean">
                                            <div class="col-lg-6 clean">
                                                ' . $plan[0]->publish_posts . '<br>
                                                <span>' . $lang->line('mu127') . '</span>
                                            </div>
                                            <div class="col-lg-6 clean">
                                                ' . $plan[0]->publish_posts . '<br>
                                                <span>' . $lang->line('mu128') . '</span>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>';
                
            }
            
            // Verify if RSS Feed is enabled
            if ( get_option('rss_feeds') ) {
                
                // Get all RSS
                $rss = $CI->rss->get_all_rss($get_plan['plan'][0]->user_id);
                
                // Verify if RSS exists
                if ( $rss ) {
                    
                    $all_rss = count($rss);
                    $min_rss = $plan[0]->rss_feeds - $all_rss;
                    
                } else {
                    
                    $all_rss = 0;
                    $min_rss = $plan[0]->rss_feeds;
                    
                }
                
                // Create the widget
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                    <div class="col-lg-12 clean">
                                        <div class="col-lg-4 clean">
                                            <h3 class="text-center">' . $all_rss . '</h3>
                                            <p class="text-center">' . $lang->line('mu129') . '</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <h3><i class="fa fa-rss"></i> ' . $lang->line('mu130') . '</h3>
                                            <div class="col-lg-12 clean">
                                                <div class="col-lg-6 clean">
                                                    ' . $plan[0]->rss_feeds . '<br>
                                                    <span>' . $lang->line('mu131') . '</span>
                                                </div>
                                                <div class="col-lg-6 clean">
                                                    ' . $min_rss . '<br>
                                                    <span>' . $lang->line('mu132') . '</span>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>';
                
            } else {
                
                // Get user networks
                $networks = $CI->networks->get_user_networks($get_plan['plan'][0]->user_id);
                
                // Verify if user has connected accounts
                if ( $networks ) {
                    
                    $networks = count($networks);
                    
                } else {
                    
                    $networks = 0;
                    
                }
                
                // Create the widget
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                <div class="col-lg-12 clean">
                                    <div class="col-lg-4 clean">
                                        <h3 class="text-center">' . $plan[0]->network_accounts . '</h3>
                                        <p class="text-center">' . $lang->line('mu140') . '</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3><i class="fa fa-share-square"></i> ' . $lang->line('mu139') . '</h3>
                                        <div class="col-lg-12 clean">
                                            <div class="col-lg-6 clean">
                                                ' . $plan[0]->network_accounts . '<br>
                                                <span>' . $lang->line('mu138') . '</span>
                                            </div>
                                            <div class="col-lg-6 clean">
                                               ' . $networks . '<br>
                                                <span>' . $lang->line('mu141') . '</span>
                                             </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>';
                
            }
            
            // Get number of sent emails per plan
            $sent_emails = plan_feature('sent_emails');
            
            // Verify if the emails section is enabled
            if ( get_option('email_marketing') && $sent_emails > 0 ):
                
                // Get number of sent emails
                $sent_emails = $CI->scheduled->get_sents($get_plan['plan'][0]->user_id, 'email');
            
            
                if ( $sent_emails ) {
                    
                    $sent = count($sent_emails);
                    $left = $plan[0]->sent_emails - $sent;
                    
                } else {
                    
                    $sent = 0;
                    $left = $plan[0]->sent_emails;
                    
                }
                
                // Create the widget
                $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                <div class="col-lg-12 clean">
                                    <div class="col-lg-4 clean">
                                        <h3 class="text-center">' . $sent . '</h3>
                                        <p class="text-center">' . $lang->line('mu133') . '</p>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3><i class="fa fa-envelope"></i> ' . $lang->line('mu134') . '</h3>
                                        <div class="col-lg-12 clean">
                                            <div class="col-lg-6 clean">
                                                ' . $plan[0]->sent_emails . '<br>
                                                <span>' . $lang->line('mu135') . '</span>
                                            </div>
                                            <div class="col-lg-6 clean">
                                                ' . $left . '<br>
                                                <span>' . $lang->line('mu136') . '</span>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>';
                
            else:
                
                // Verify if user has connected accounts
                if ( isset($networks) ) {
                    
                    $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                    <div class="col-lg-12 clean">
                                        <div class="col-lg-4 clean">
                                            <h3 class="text-center">' . $plan[0]->publish_accounts . '</h3>
                                            <p class="text-center">' . $lang->line('mu140') . '</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> ' . $lang->line('mu142') . '</h3>
                                            <div class="col-lg-12 clean">
                                                <div class="col-lg-6 clean">
                                                    ' . $plan[0]->publish_accounts . '<br>
                                                    <span>' . $lang->line('mu143') . '</span>
                                                </div>
                                                <div class="col-lg-6 clean">
                                                    ' . $plan[0]->publish_accounts . '<br>
                                                    <span>' . $lang->line('mu144') . '</span>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>';
                } else {
                    
                    // Get all user networks
                    $networks = $CI->networks->get_user_networks($get_plan['plan'][0]->user_id);
                    
                    if ( $networks ) {
                        
                        $networks = count($networks);
                        
                    } else {
                        
                        $networks = 0;
                        
                    }
                    
                    // Create the widget
                    $widgets .= '<div class="col-lg-3 col-sm-12 col-xs-12">
                                    <div class="col-lg-12 clean">
                                        <div class="col-lg-4 clean">
                                            <h3 class="text-center">' . $plan[0]->network_accounts . '</h3>
                                            <p class="text-center">' . $lang->line('mu140') . '</p>
                                        </div>
                                        <div class="col-lg-8">
                                            <h3><i class="fa fa-share-square"></i> ' . $lang->line('mu139') . '</h3>
                                            <div class="col-lg-12 clean">
                                                <div class="col-lg-6 clean">
                                                    ' . $plan[0]->network_accounts . '<br>
                                                    <span>' . $lang->line('mu138') . '</span>
                                                </div>
                                                <div class="col-lg-6 clean">
                                                    ' . $networks . '<br>
                                                    <span>' . $lang->line('mu141') . '</span>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>';
                    
                }
                
            endif;

            // Display widgets
            echo $widgets;
            
        }
        
    }

}

if ( !function_exists( 'get_accounts_per_network' ) ) {

    /**
     * The function gets all user accounts from a social network
     * 
     * @param string $network contains the network name
     *
     * @return integer with number of social accounts
     */
    function get_accounts_per_network( $network ) {
            
        // Get codeigniter object instance
        $CI = get_instance();
            
        // Load the Networks model
        $CI->load->model('networks');
        
        
        // Get the user's ID
        $user_id = $CI->ecl('Instance')->user();


        // Get all user networks
        $accounts = $CI->networks->get_user_networks( $user_id, $network );
        
        if ( $accounts ) {
            
            return count( $accounts );
            
        } else {
            
            return '0';
            
        }
        
    }

}