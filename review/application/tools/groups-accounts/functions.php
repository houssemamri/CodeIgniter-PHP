<?php
/**
 * Functions
 *
 * PHP Version 5.6
 *
 * In this file is used to process the ajax requests
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
/**
 * Get Selected Accounts
 */
if (get_instance()->input->get('action', TRUE) == 'get-selected') {
    // Load Second Helper
    get_instance()->load->helper('second_helper');
    $page = get_instance()->input->get('res', TRUE);
    if(is_numeric($page) == TRUE) {
        $res = get_group_networks(get_instance()->ecl('Instance')->user(),$page);
        if($res) {
            echo json_encode($res);
        }
    }
}
/**
 * Search Accounts
 */
if (get_instance()->input->get('action', TRUE) == 'search-in-group') {
    // Load Second Helper
    get_instance()->load->helper('second_helper');
    // Load Second Helper
    get_instance()->load->helper('second_helper');    
    $list_id = get_instance()->input->get('list-id', TRUE);
    $key = get_instance()->input->get('key', TRUE);
    if(is_numeric($list_id)) {
        // Load User Model
        get_instance()->load->model('lists');
        $nk = get_instance()->lists->get_lists_meta(get_instance()->ecl('Instance')->user(), 0, $list_id, 4, $key);
        if($nk) {
            echo json_encode(gets_list_meta($nk));
        }
    }
}
/**
 * Add new network account to a post
 */
if (get_instance()->input->get('action', TRUE) == 'update-selected-accounts') {
    // Load Second Helper
    get_instance()->load->helper('second_helper');
    $page = get_instance()->input->get('res', TRUE);
    $net = get_instance()->input->get('net', TRUE);
    // Load User Helper
    get_instance()->load->helper('user_helper');
    $networks = get_instance()->ecl('Instance')->mod('networks', 'get_account', [$net]);
    if ( $networks ) {
        if ( check_plan_networks(strtolower($networks[0]->network_name)) == FALSE ) {
            exit();
        }
    }
    if((is_numeric($net) == TRUE) || (is_numeric($page) == TRUE)) {
        $cham = add_account_to_group(get_instance()->ecl('Instance')->user(),$page,$net);
        if($cham == 2) {
            echo json_encode(2);
            exit();
        }
    }    
    if(is_numeric($page) == TRUE) {
        $res = get_group_networks(get_instance()->ecl('Instance')->user(),$page);
        if($res) {
            echo json_encode($res);
        }
    }
}
/**
 * Delete a Group's account
 */
if (get_instance()->input->get('action', TRUE) == 'delete-accounts') {
    // Load Second Helper
    get_instance()->load->helper('second_helper');
    $meta = get_instance()->input->get('meta', TRUE);
    $page = get_instance()->input->get('res', TRUE);
    if((is_numeric($meta) == TRUE) || (is_numeric($page) == TRUE)) {
        delete_account_group(get_instance()->ecl('Instance')->user(), $page, $meta);
    }    
    if(is_numeric($page) == TRUE) {
        $res = get_group_networks(get_instance()->ecl('Instance')->user(),$page);
        if($res) {
            echo json_encode($res);
        }
    }
}
/**
 * Create a new group
 */
if (get_instance()->input->get('action', TRUE) == 'create-new-group') {
    if ($this->input->post()) {
        $this->form_validation->set_rules('group', 'Group', 'trim|required');
        // Get data
        $group = $this->input->post('group');
        if ($this->form_validation->run()) {
            if(get_instance()->ecl('Instance')->mod('lists', 'save_list', [get_instance()->ecl('Instance')->user(),'social',$group,''])) {
                echo json_encode(1);
            } else {
                echo json_encode(2);
            }
        }
    }
}
/**
 * Delete a group
 */
if (get_instance()->input->get('action', TRUE) == 'delete-group') {
    $group = get_instance()->input->get('group', TRUE);
    if(is_numeric($group)) {
        if(get_instance()->ecl('Instance')->mod('lists', 'delete_list', [get_instance()->ecl('Instance')->user(),$group])) {
            echo json_encode(1);
        } else {
            echo json_encode(2);
        }        
    }
}