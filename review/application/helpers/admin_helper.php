<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Name: Admin Helper
 * Author: Scrisoft
 * Created: 25/11/2017
 * Here you will find the following functions:
 * get_admin_widgets - displays the admin widgets
 * generate_admin_statstics - generates statics for Admin Dasboard
 * admin_header - displays information about updates and scheduled posts in admin area
 * */
if ( !function_exists('check_plan_networks') ) {
    
    /**
     * The function get_admin_widgets displays the admin widgets
     * 
     * @param string $network contains the network name
     * 
     * @return boolean true or false
     */
    function get_admin_widgets() {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Plans Model
        $CI->load->model( 'plans' );
        
        // Calculates total earnings
        $total = $CI->plans->get_all_payments();
        
        // Get plan curency
        $currency = $CI->plans->get_plan_price();
        
        // Gets earnings from the last 30 days
        $month = $CI->plans->get_all_payments(2592000);
        
        // Gets number of total registered users
        $CI->load->model( 'user' );
        
        // Calculates total users
        $total_users = $CI->user->count_all_users();
        
        // Calculates new users from last 30 days
        $last_30_users = $CI->user->count_all_users(0, 30);
        
        // Get total active users in last 30 days
        $last_active_users = $CI->user->get_active_users(1, 1, 30, 1);
        
        // If bigger than 0, create a link
        if ( $last_active_users > 0 ) {
            
            $last_active_users = '<a href="' . site_url(['admin', 'user-activities', 1]) . '">' . $last_active_users . '</a>';
            
        }
        
        // Get total active users in last 24 hours
        $last_active_24_users = $CI->user->get_active_users(1, 1, 1, 1);
        
        // If bigger than 0, create a link
        if ( $last_active_24_users > 0 ) {
            
            $last_active_24_users = '<a href="' . site_url(['admin', 'user-activities', 1]) . '">' . $last_active_24_users . '</a>';
            
        }
        
        echo '<div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="col-lg-12">
                    <h3><i class="fa fa-money"></i> ' . $CI->lang->line('ma169') . '</h3>
                    <div class="col-lg-12 clean">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $currency[0]->currency_sign . ' ' . $total . '<br>
                            <span>' . $CI->lang->line('ma170') . '</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $currency[0]->currency_sign . ' ' . $month . '<br>
                            <span>' . $CI->lang->line('ma171') . '</span>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="col-lg-12">
                    <h3><i class="fa fa-users"></i> ' . $CI->lang->line('ma172') . '</h3>
                    <div class="col-lg-12 clean">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $total_users . '<br>
                            <span>' . $CI->lang->line('ma170') . '</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $last_30_users . '<br>
                            <span>' . $CI->lang->line('ma171') . '</span>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="col-lg-12">
                    <h3><i class="fa fa-briefcase"></i> ' . $CI->lang->line('ma173') . '</h3>
                    <div class="col-lg-12 clean">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $last_active_24_users . '<br>
                            <span>today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            ' . $last_active_users . '<br>
                            <span>' . $CI->lang->line('ma171') . '</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="col-lg-12">
                    <h3><i class="fa fa-calculator"></i> ' . $CI->lang->line('ma174') . '</h3>
                    <div class="col-lg-12 clean">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            0<br>
                            <span>' . $CI->lang->line('ma170') . '</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clean">
                            0<br>
                            <span>' . $CI->lang->line('ma171') . '</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
}


if ( !function_exists('generate_admin_statstics') ) {

    /**
     * The function generates admin's statistics
     * 
     * @param integer $period contains the time's period
     * @param integer $user contains the user's ID
     *
     * @return string with statistcs
     */
    function generate_admin_statstics( $period, $users = NULL ) {
        
        // Generates statistics for admin dashboard
        if ( $period > 0 AND $users > 0 ) {
            
            // Increase the period + 1
            $period++;
            
            // Define variable data
            $data = '';
            
            // Create an object with statistics
            for ( $i = 0; $i < $period; $i++ ) {
                
                // Get current time
                $current_date = date('Y-m-d', strtotime('-' . $i . 'day', time()));
                
                // Verify if current date exists in array
                if ( array_key_exists( $current_date, $users) ) {
                    
                    $data .= "{period: '" . $current_date . "', newusers: " . $users[$current_date] . "},";
                    
                }
                
            }
            
            return "[" . $data . "]";
            
        } else {
            
            return "[{period: '" . date('Y-m-d') . "', newusers: 0}]";
            
        }
        
    }

}

if ( !function_exists('admin_header') ) {

    /**
     * The function displays information about updates and scheduled posts in admin area
     *
     * @return array with information for admin 
     */
    function admin_header() {
        
        // Get codeigniter object instance
        $CI = get_instance();
        
        // Load Posts Model
        $CI->load->model('posts');
        
        // Get all scheduled posts
        $all_scheduled = $CI->posts->count_all_scheduled_posts();
        
        // Load Options Model
        $CI->load->model('options');
        
        // Verify if updates exists
        $check_update = $CI->options->check_enabled('update');
        
        // Load Tickets Model
        $CI->load->model('tickets');
        
        // Get all tickets
        $all_tickets = $CI->tickets->get_all_tickets_for();
        
        // Return array with admin information
        return ['all_scheduled' => $all_scheduled, 'check_update' => $check_update, 'all_tickets' => $all_tickets];
        
    }

}