<?php
/**
 * Ebay_feed_creator
 *
 * PHP Version 5.6
 *
 * Generate a feed RSS from an eBay's page
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
include_once 'groups_helper.php';
/**
 * Ebay_feed_creator - allows to generate a Feed RSS from url
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Groups_accounts implements Tools {
    
    use Groups_helper;
    
    /**
     * The function check_info get tool's information.
     */
    public function check_info() {
        return (object) ['name' => 'Groups Accounts', 'full_name' => 'Groups Accounts', 'logo' => '<button class="btn-tool-icon btn btn-default btn-xs  pull-left" type="button"><i class="fa fa-wrench"></i></button>', 'slug' => 'groups-accounts'];
    }

    /**
     * The function page displays the main page of the tool.
     */
    public function page($args) {
        $CI = get_instance();
        if ( file_exists( APPPATH . 'language/' . $CI->config->item('language') . '/default_tool_lang.php' ) ) {
            $CI->lang->load( 'default_tool', $CI->config->item('language') );
        }
        // Load User Helper
        $CI->load->helper('user_helper');
        $nets = $this->get_socials();
        $netu = '';
        $networ = '';
        if($nets){
            foreach($nets as $net){
                if (check_plan_networks(strtolower($net[2])) == FALSE) {
                    continue;
                }
                $netu .= '<li><a href="'.strtolower($net[2]).'">'.ucwords(str_replace('_', ' ', $net[2])).'</a></li>';
                if ( !$networ ) {
                    $networ = $net[2];
                }
            }
        }
        $display_form = '';
        if(get_user_option('display_groups_form')){
            $display_form = ' checked="checked"';
        }
        $act = (get_option('posts_planner_limit'))?get_option('posts_planner_limit'):'1';
        return (object) ['content' => $this->assets().'
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mess-stat">
                    <div class="col-lg-12 resent">
                        <div class="row">
                            <div class="panel-heading">
                                '.$CI->lang->line('mt11').'         <ul class="nav navbar-nav navbar-right order-by-posts"><li class="dropdown"><a href="#" class="dropdown-toggle display-by" data-toggle="dropdown" role="button" aria-expanded="false">'.$CI->lang->line('mt13').' <span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="#" data-toggle="modal" data-target="#new-group" class="order-planned-posts" data-type="1">'.$CI->lang->line('mt12').'</a></li><li><a href="#" class="show-planner-options">'.$CI->lang->line('mt3').'</a></li></ul></li></ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 post-plans">
                                <div class="list-group">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mess-planner" data-act="'.$act.'">
                    <div class="col-lg-12 resent show-preview plan-add-action">
                        <div class="row">
                            <div class="panel-heading">
                            <i class="fa fa-calendar"></i> '.$CI->lang->line('mu190').' <div class="btn-group pull-right"><button type="button" data-type="main" class="btn btn-default add-repeat">'.$CI->lang->line('mu189').'</button></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 post-plans planner-list">
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 resent show-preview plan-shows-detail">
                        <div class="row">
                            <div class="panel-heading">
                            <i class="fa fa-info-circle"></i> '.$CI->lang->line('mu191').'
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 post-plans">
                                <div class="list-group planner-schedules">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 resent show-preview netshow-list">
                        <div class="row">
                            <div class="panel-heading">
                            <i class="fa fa-share-square"></i> '.$CI->lang->line('mt4').' <div class="btn-group pull-right"><button type="button" data-toggle="modal" data-target="#new-contu" data-type="main" class="btn btn-default new-contu">'.$CI->lang->line('mt5').'</button></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 post-plans">
                                <div class="list-group sellected-accounts">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 resent optionss-list">
                        <div class="row">
                            <div class="panel-heading">
                                <i class="fa fa-sliders" aria-hidden="true"></i> '.$CI->lang->line('mt3').'
                            </div>
                        </div>
                        <div class="row">
                            <div id="general" class="tab-pane active">
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">'.$CI->lang->line('mt14').'</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="display_groups_form" name="display_groups_form" class="setopt" type="checkbox"'.$display_form.'>
                                            <label for="display_groups_form"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
             <div class="modal fade" id="new-contu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        '.form_open('#', ['class' => 'add-accounts']).'
                            <div class="form-group multiple-form-group input-group">
                                <div class="input-group-btn input-group-select">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="concept">'.ucwords(str_replace('_', ' ', $networ)).'</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu sel" role="menu">
                                        '.$netu.'
                                    </ul>
                                </div>
                                <input type="text" name="" placeholder="'.$CI->lang->line('mu88').'" class="form-control search-conts">
                            </div>
                        '.form_close().'
                            <div class="table-responsive"> 
                                <table class="table table-sm table-hover">
                                    <tbody class="accounts-found">
                                        <tr><td>'.$CI->lang->line('mm127').'</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="modal fade" id="new-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        '.form_open('#', ['class' => 'create-group']).'
                            <div class="form-group multiple-form-group input-group">
                                <input type="text" placeholder="'.$CI->lang->line('mt16').'" class="form-control group-name">
                                <div class="input-group-btn input-group-select">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="concept">'.$CI->lang->line('mt15').'</span>
                                    </button>
                                </div>
                            </div>
                        '.form_close().'
                        </div>
                    </div>
                </div>
            </div>
        '];
    }

}
