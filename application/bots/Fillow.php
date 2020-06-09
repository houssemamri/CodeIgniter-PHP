<?php
/**
 * Fillow
 *
 * PHP Version 5.6
 *
 * Find new friends on 500px
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
/**
 * Fillow class - allows users to search and follow friends from 500px.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Fillow implements Boots {
    protected $CI, $token, $secret, $check;
    /**
     * Load networks and user model.
     */
    public function __construct() {
        $this->CI =& get_instance();
        // Load Networks Model
        $this->CI->load->model('networks');
        // Load User Model
        $this->CI->load->model('user');
        $nets = $this->CI->networks->get_all_accounts($this->CI->ecl('Instance')->user(),'the_500px');
        if($nets) {
            $this->token = $nets[0]->token;
            $this->secret = $nets[0]->secret;
        }
        if(file_exists(FCPATH . 'vendor/oauth/_500PXOAuth.php')) {
            $this->consumer_key = get_option('the_500px_consumer_key');
            $this->consumer_secret = get_option('the_500px_consumer_secret');
            include_once FCPATH . 'vendor/oauth/OAuth.php';
            include_once FCPATH . 'vendor/oauth/_500PXOAuth.php';
        }
    }
    
    /**
     * First function check if the 500px api is configured correctly.
     *
     * @return will be true if the client and client_secret is not empty
     */
    public function check_availability() {
        return true;
    }
    
    /**
     * First function content provides bot's content
     *
     * @return string with the bot's content
     */
    public function content() {
        $imu = $this->CI->lang->line('mu33');
        $search = '<div class="col col-lg-12 clean search-zon">
                        <div class="input-group search">
                            <input type="text" placeholder="' . $this->CI->lang->line('mb47') . '" class="form-control search_users">
                            <span class="input-group-btn search-m">
                                <button class="btn save-search" type="button"><i class="fa fa-floppy-o"></i></button>
                                <button class="btn search-users" type="button"><i class="fa fa-binoculars"></i><i class="fa fa-times"></i></button>
                            </span>
                        </div>
                    </div>';
        if(($this->token == '') || ($this->secret == '')) {
            $search = '<p>' . $this->CI->lang->line('mb72') . '</p>';
        }
        return $this->assets().' 
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active leposts">
                                    <a href="#twilos_main" data-toggle="tab">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>
                                <li class="leprom">
                                    <a href="#saved_search" data-toggle="tab">
                                        <i class="fa fa-history"></i>
                                    </a>
                                </li>
                                <img src="' . base_url() . 'assets/img/load-prev2.gif" class="loading-image">
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="twilos_main">
                                    <div class="row clean">
                                        ' . $search . '
                                    </div>
                                    <div class="row">
                                        <div class="clean col-lg-12">
                                            <ul class="user-results">
                                                                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="saved_search">
                                    <div class="row">
                                        <div class="clean col-lg-12">
                                            <ul class="search-results">
                                            </ul>
                                        </div>
                                    </div>                                
                                    <div class="row">
                                        <div class="col clean col-lg-12">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fillow-comments">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#fillow-options" data-toggle="tab" class="bolis">
                                        <i class="fa fa-sliders"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#fillow-members" data-toggle="tab" class="bolis2">
                                        <i class="fa fa-users"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#fillow-stats" data-toggle="tab" class="bolis3">
                                        <i class="fa fa-area-chart"></i>
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="fillow-options">
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">' . $this->CI->lang->line('mb71') . '</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-center fillow-account-select">
                                        <a href="" data-toggle="modal" data-target="#new-contu">@' . $this->CI->lang->line('mb48') . '</a>
                                    </div>
                                </div>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">' . $this->CI->lang->line('mb32') . '</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-center fillow-status">
                                        active
                                    </div>
                                </div>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">' . $this->CI->lang->line('mb29') . '</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="fillow_auto_follow" name="fillow_auto_follow" class="setopti" type="checkbox">
                                            <label for="fillow_auto_follow"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">' . $this->CI->lang->line('mb30') . '</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="fillow_auto_unfollow" name="fillow_auto_unfollow" class="setopti" type="checkbox">
                                            <label for="fillow_auto_unfollow"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">' . $this->CI->lang->line('mb31') . '</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="fillow_delete" name="fillow_delete" class="setopti" type="checkbox">
                                            <label for="fillow_delete"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="fillow-members">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="fillow-members-results">
                                        </ul>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col clean col-lg-12">
                                        <ul class="pagination">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="fillow-stats">
                            
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
                                            <span class="concept">500px</span>
                                        </button>
                                    </div>
                                    <input type="text" name="" placeholder="' . $this->CI->lang->line('mu88') . '" class="form-control search-conts">
                                </div>
                            '.form_close().'
                                <div class="table-responsive"> 
                                    <table class="table table-sm table-hover">
                                        <tbody class="accounts-found">
                                            <tr><td>' . $this->CI->lang->line('mm127') . '</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
    
    public function assets() {
        $this->CI = $this->CI;
        return '<script language="javascript">'
        . 'window.onload = function(){
                var home = document.getElementsByClassName(\'navbar-brand\')[0];
                var twi = {\'page\': 1, \'limit\': 10, \'cid\': 0};
                function search_users(e) {
                    e.preventDefault();
                    var key = document.getElementsByClassName(\'search_users\')[0].value;
                    document.getElementsByClassName(\'loading-image\')[0].style.display = \'block\';
                    var url = home+\'user/bot/fillow?action=1&key=\'+key;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                var tot = \' \';
                                for(var m = 0; m < data.length; m++) {
                                    tot += \'<li><div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 clean"><img src="\' + data[m][3] + \'"></div><div class="col-lg-11 col-md-11 col-sm-10 col-xs-9"><h3>\' + data[m][1] + \'</h3><h4>' . $this->CI->lang->line('mb40') . ': \' + data[m][2] + \'</h4></div></li>\';
                                }
                                document.querySelector(\'.user-results\').innerHTML = tot;
                                document.querySelector(\'#twilos_main .search .btn.save-search\').style.visibility = \'visible\';
                                reload_it();
                            } else {
                                document.querySelector(\'.user-results\').innerHTML = \'<p class="no-comments">' . $this->CI->lang->line('mb36') . '<p>\';
                            }
                            document.getElementsByClassName(\'loading-image\')[0].style.display = \'none\';
                        }
                    }
                    http.send();
                }
                function search_usi() {
                    document.querySelector(\'#twilos_main .search .btn.save-search\').style.visibility = \'hidden\';
                }
                function follow() {
                    var dthis = this;
                    var user = dthis.closest(\'li\').getAttribute(\'data-id\');
                    var url = home+\'user/bot/fillow?action=9&user=\' + user + \'&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data == 1) {
                                popup_fon(\'subi\', \'' . $this->CI->lang->line('mb73') . '\', 1500, 2000);
                                dthis.style.display = \'none\';
                                dthis.closest(\'li\').querySelector(\'.label-danger\').style.display = \'block\';
                                reload_it();
                                get_stats();
                            } else if(data == 2) {
                                popup_fon(\'sube\', \'' . $this->CI->lang->line('mb33') . '\', 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function unfollow() {
                    var dthis = this;
                    var user = dthis.closest(\'li\').getAttribute(\'data-id\');
                    var url = home+\'user/bot/fillow?action=10&user=\' + user + \'&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data == 1) {
                                popup_fon(\'subi\', \'' . $this->CI->lang->line('mb42') . '\', 1500, 2000);
                                dthis.style.display = \'none\';
                                dthis.closest(\'li\').querySelector(\'.label-default\').style.display = \'block\';
                                reload_it();
                                get_stats();
                            }
                        }
                    }
                    http.send();
                }
                function save_search(e) {
                    e.preventDefault();
                    document.getElementsByClassName(\'loading-image\')[0].style.display = \'block\';
                    var key = document.getElementsByClassName(\'search_users\')[0].value;
                    var url = home+\'user/bot/fillow?action=2&key=\'+key;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data > 0) {
                                document.querySelector(\' .leprom a\').click();
                                document.getElementsByClassName(\'loading-image\')[0].style.display = \'none\';
                                document.getElementsByClassName(\'search_users\')[0].value = \'\';
                                document.getElementsByClassName(\'user-results\')[0].innerHTML = \'\';
                                document.querySelector(\'#twilos_main .search .btn.save-search\').style.visibility = \'hidden\';
                                show_searches(1);
                            } else {
                                popup_fon(\'sube\', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function pnumi(e){
                    e.preventDefault();
                    var dez = this.closest(\'.tab-pane\').getAttribute(\'id\');
                    if(dez === \'saved_search\') {
                        show_searches(this.getAttribute(\'data-page\'));
                    }
                }
                function manage_search(e){
                    e.preventDefault();
                    var dez = this.getAttribute(\'data-id\');
                    if(dez) {
                        twi.cid = dez;
                        show_members();
                    }
                }
                function search_conts(){
                    var key = document.getElementsByClassName(\'search-conts\')[0].value;
                    if(!key) {
                        return;
                    }
                    var url = home+\'user/bot/fillow?action=5&key=\' + key;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                var show = \'\';
                                for(var o = 0; o < data.length; o++){
                                    show += \'<tr><td>\'+data[o].user_name+\'</td><td style="text-align: right;"><button class="btn-add-to-account btn btn-default btn-xs" type="button" data-id="\' + data[o].network_id + \'"><i class="fa fa-plus" aria-hidden="true"></i></button></td></tr>\';
                                }
                                document.getElementsByClassName(\'accounts-found\')[0].innerHTML = show;
                                reload_it();
                            } else {
                                document.getElementsByClassName(\'accounts-found\')[0].innerHTML = \'<tr><td>' . $this->CI->lang->line('mm127') . '</td></tr>\';                            
                            }
                        }
                    }
                    http.send();
                }
                function load_options() {
                    document.getElementsByClassName(\'fillow-comments\')[0].style.display = \'block\';
                    document.getElementById(\'fillow_auto_follow\').checked = false;
                    document.getElementById(\'fillow_auto_unfollow\').checked = false;
                    document.getElementsByClassName(\'fillow-status\')[0].innerText = \'inactive\';
                    document.getElementsByClassName(\'fillow-status\')[0].style.color = \'#F44336\';
                    var url = home+\'user/bot/fillow?action=7&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                if(data[0].rule2) {
                                    document.getElementsByClassName(\'fillow-account-select\')[0].innerHTML = \'@\' + data[0].rule2;
                                } else {
                                    document.getElementsByClassName(\'fillow-account-select\')[0].innerHTML = \'<a href="#" data-toggle="modal" data-target="#new-contu">@account</a>\';
                                }
                                if(data[0].rule3 > 0) {
                                    document.getElementById(\'fillow_auto_follow\').checked = true;
                                }
                                if(data[0].rule4 > 0) {
                                    document.getElementById(\'fillow_auto_unfollow\').checked = true;
                                }
                                if(data[0].rule5 > 0) {
                                    document.getElementsByClassName(\'fillow-status\')[0].innerText = \'active\';
                                    document.getElementsByClassName(\'fillow-status\')[0].style.color = \'#337ab7\';
                                }                              
                            } else {
                                document.getElementsByClassName(\'fillow-account-select\')[0].innerHTML = \'<a href="#" data-toggle="modal" data-target="#new-contu">@' . $this->CI->lang->line('mb48') . '</a>\';
                            }
                        }
                    }
                    http.send();
                }
                function add_netu_to_list(e){
                    e.preventDefault();
                    var id = this.getAttribute(\'data-id\');
                    document.querySelector(\'.modal.fade.in\').click();
                    document.getElementsByClassName(\'search-conts\')[0].value = \'\';
                    document.getElementsByClassName(\'accounts-found\')[0].innerHTML = \'<tr><td>' . $this->CI->lang->line('mm127') . '</td></tr>\';
                    var url = home+\'user/bot/fillow?action=6&id=\' + id + \'&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                document.getElementsByClassName(\'fillow-account-select\')[0].innerHTML = \'@\' + data;
                                show_members();
                                reload_it();
                            } else {
                                popup_fon(\'sube\', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function setopti(){
                    var id = this.getAttribute(\'id\');
                    var checked = this.checked;
                    var val = 0;
                    if(checked) {
                        val++;
                    }
                    var url = home+\'user/bot/fillow?action=8&type=\' + id + \'&val=\' + val + \'&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                if(id === \'fillow_auto_follow\') {
                                    document.getElementById(\'fillow_auto_unfollow\').checked = false;
                                } else if(id === \'fillow_auto_unfollow\') {
                                    document.getElementById(\'fillow_auto_follow\').checked = false;
                                } else if(id === \'fillow_delete\') {
                                    popup_fon(\'subi\', \'' . $this->CI->lang->line('mb34') . '\', 1500, 2000);
                                    document.getElementsByClassName(\'fillow-comments\')[0].style.display = \'none\';
                                    document.getElementById(\'fillow_delete\').checked = false;
                                    show_searches(1);
                                    setTimeout(reload_it,500);
                                    return;
                                }
                                if(val > 0) {
                                    document.getElementsByClassName(\'fillow-status\')[0].innerText = \'active\';
                                    document.getElementsByClassName(\'fillow-status\')[0].style.color = \'#337ab7\';
                                } else {
                                    document.getElementsByClassName(\'fillow-status\')[0].innerText = \'inactive\';
                                    document.getElementsByClassName(\'fillow-status\')[0].style.color = \'#F44336\';
                                }
                            } else {
                                if(id === \'fillow_delete\') {
                                    popup_fon(\'sube\', translation.mm3, 1500, 2000);
                                } else {
                                    document.getElementById(\'fillow_auto_follow\').checked = false;
                                    document.getElementById(\'fillow_auto_unfollow\').checked = false;
                                    popup_fon(\'sube\', \'' . $this->CI->lang->line('mb33') . '\', 1500, 2000);
                                }
                            }
                        }
                    }
                    http.send();
                }                
                function reload_it() {
                    var users_search = document.getElementsByClassName(\'search-users\');
                    if(users_search.length) {
                        if(users_search[0].addEventListener){
                            users_search[0].addEventListener(\'click\', search_users, false);
                        } else if(users_search[0].attachEvent) {
                            users_search[0].attachEvent(\'onclick\', search_users);
                        }
                    }
                    var search_us = document.getElementsByClassName(\'search_users\');
                    if(search_us.length) {
                        if(search_us[0].addEventListener){
                            search_us[0].addEventListener(\'keyup\', search_usi, false);
                        } else if(search_us[0].attachEvent) {
                            search_us[0].attachEvent(\'onkeyup\', search_usi);
                        }
                    }
                    var save_sear = document.getElementsByClassName(\'save-search\');
                    if(save_sear.length) {
                        if(save_sear[0].addEventListener){
                            save_sear[0].addEventListener(\'click\', save_search, false);
                        } else if(save_sear[0].attachEvent) {
                            save_sear[0].attachEvent(\'onclick\', save_search);
                        }
                    }
                    var pnum = document.getElementsByClassName(\'pnum\');
                    if(pnum.length) {
                        if(pnum[0].addEventListener) {
                            for(var f = 0; f < pnum.length; f++) {
                                pnum[f].addEventListener(\'click\', pnumi, false);
                            }
                        } else if(pnum[0].attachEvent) {
                            for(var f = 0; f < pnum.length; f++) {
                                pnum[f].attachEvent(\'onclick\', pnumi);
                            }
                        }
                    }
                    var manage = document.getElementsByClassName(\'manage-saved-search\');
                    if(manage.length) {
                        if(manage[0].addEventListener) {
                            for(var f = 0; f < manage.length; f++) {
                                manage[f].addEventListener(\'click\', manage_search, false);
                            }
                        } else if(manage[0].attachEvent) {
                            for(var f = 0; f < manage.length; f++) {
                                manage[f].attachEvent(\'onclick\', manage_search);
                            }
                        }
                    }
                    var conts = document.getElementsByClassName(\'search-conts\');
                    if(conts.length) {
                        if(conts[0].addEventListener) {
                            conts[0].addEventListener(\'keyup\', search_conts, false);
                        } else if(conts[0].attachEvent) {
                            conts[0].attachEvent(\'onkeyup\', search_conts);
                        }
                    }
                    var add_net_to_list = document.getElementsByClassName(\'btn-add-to-account\');
                    if(add_net_to_list.length) {
                        if(add_net_to_list[0].addEventListener){
                            for(var f = 0; f < add_net_to_list.length; f++) {
                                add_net_to_list[f].addEventListener(\'click\', add_netu_to_list, false);
                            }
                        } else if(add_net_to_list[0].attachEvent) {
                            for(var f = 0; f < add_net_to_list.length; f++) {
                                add_net_to_list[f].attachEvent(\'onclick\', add_netu_to_list);
                            }
                        }
                    }
                    var setopt = document.getElementsByClassName(\'setopti\');
                    if(setopt.length) {
                        if(setopt[0].addEventListener) {
                            for(var f = 0; f < setopt.length; f++) {
                                setopt[f].addEventListener(\'click\', setopti, false);
                            }
                        } else if(setopt[0].attachEvent) {
                            for(var f = 0; f < setopt.length; f++) {
                                setopt[f].attachEvent(\'onclick\', setopti);
                            }
                        }
                    }
                    var btn_follow = document.getElementsByClassName(\'btn-follow\');
                    if(btn_follow.length) {
                        if(btn_follow[0].addEventListener) {
                            for(var f = 0; f < btn_follow.length; f++) {
                                btn_follow[f].addEventListener(\'click\', follow, false);
                            }
                        } else if(btn_follow[0].attachEvent) {
                            for(var f = 0; f < btn_follow.length; f++) {
                                btn_follow[f].attachEvent(\'onclick\', follow);
                            }
                        }
                    }
                    var btn_unfollow = document.getElementsByClassName(\'btn-unfollow\');
                    if(btn_unfollow.length) {
                        if(btn_unfollow[0].addEventListener) {
                            for(var f = 0; f < btn_unfollow.length; f++) {
                                btn_unfollow[f].addEventListener(\'click\', unfollow, false);
                            }
                        } else if(btn_unfollow[0].attachEvent) {
                            for(var f = 0; f < btn_unfollow.length; f++) {
                                btn_unfollow[f].attachEvent(\'onclick\', unfollow);
                            }
                        }
                    }                    
                }
                function show_pagination(total,id) {
                    // the code bellow displays pagination
                    if (parseInt(twi.page) > 1) {
                        var bac = parseInt(twi.page) - 1;
                        var pages = \'<li><a href="#" data-page="\' + bac + \'" class="pnum">\' + translation.mm128 + \'</a></li>\';
                    } else {
                        var pages = \'<li class="pagehide"><a href="#">\' + translation.mm128 + \'</a></li>\';
                    }
                    var tot = parseInt(total) / parseInt(twi.limit);
                    tot = Math.ceil(tot) + 1;
                    var from = (parseInt(twi.page) > 2) ? parseInt(twi.page) - 2 : 1;
                    for (var p = from; p < parseInt(tot); p++) {
                        if (p === parseInt(twi.page)) {
                            pages += \'<li class="active"><a data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else if ((p < parseInt(twi.page) + 3) && (p > parseInt(twi.page) - 3)) {
                            pages += \'<li><a href="#" data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(twi.page) == 1) || (parseInt(twi.page) == 2))) {
                            pages += \'<li><a href="#" data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else {
                            break;
                        }
                    }
                    if (p === 1) {
                        pages += \'<li class="active"><a data-page="\' + p + \'">\' + p + \'</a></li>\';
                    }
                    var next = parseInt(twi.page);
                    next++;
                    if (next < Math.round(tot)) {
                        document.querySelector(id + \' .pagination\').innerHTML = pages + \'<li><a href="#" data-page="\' + next + \'">\' + translation.mm129 + \'</a></li>\';
                    } else {
                        document.querySelector(id + \' .pagination\').innerHTML = pages + \'<li class="pagehide"><a href="#">\' + translation.mm129 + \'</a></li>\';
                    }
                }
                function show_searches(num) {
                    twi.page = num;
                    var url = home+\'user/bot/fillow?action=3&page=\' + num;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        var data = http.responseText;
                        if(data) {
                            data = JSON.parse(http.responseText);
                            show_pagination(data.total,\'#saved_search\');
                            var tot = \' \';
                            for(var m = 0; m < data.members.length; m++) {
                                tot += \'<li><div class="col-lg-10 col-md-10 col-sm-10 col-xs-9 clean"><h3>\' + data.members[m][1] + \'</h3><h4>\' + data.members[m][2] + \' ' . $this->CI->lang->line('mb87') . '</h4></div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 clean text-right"><button type="button" data-id="\' + data.members[m][0] + \'" class="btn btn-labeled btn-primary manage-saved-search"><span class="btn-label">' . $this->CI->lang->line('mb67') . '</span></button></div></li>\';
                            }
                            document.querySelector(\'#saved_search .search-results\').innerHTML = tot;
                            setTimeout(reload_it,500);
                        } else {
                            document.querySelector(\'#saved_search .search-results\').innerHTML = \'<p class="no-comments">' . $this->CI->lang->line('mb35') . '<p>\';
                        }
                    }
                    http.send();
                }
                function show_members() {
                    var url = home+\'user/bot/fillow?action=4&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        var data = http.responseText;
                        if(data) {
                            if(data.search(\']\') < 0) {
                                return;
                            }
                            load_options();
                            get_stats();
                            data = JSON.parse(data);
                            var tot = \' \';
                            for(var m = 0; m < data.length; m++) {
                                var si = \'<button type="button" class="btn label label-success btn-follow pull-right">' . $this->CI->lang->line('mb37') . '</button><button type="button" class="btn label label-danger btn-unfollow pull-right note-group-select-from-files">' . $this->CI->lang->line('mb38') . '</button><button type="button" class="btn label label-default pull-right note-group-select-from-files">' . $this->CI->lang->line('mb39') . '</button>\';
                                if(data[m].fol == 1) {
                                    si = \'<button type="button" class="btn label label-danger btn-unfollow pull-right">' . $this->CI->lang->line('mb38') . '</button><button type="button" class="btn label label-default pull-right note-group-select-from-files">' . $this->CI->lang->line('mb39') . '</button>\';
                                } else if(data[m].fol == 2) {
                                    si = \'<button type="button" class="btn label label-default pull-right">' . $this->CI->lang->line('mb39') . '</button>\';
                                }
                                tot += \'<li data-id="\' + data[m].rule2 + \'"><div class="col-lg-1 col-md-1 col-sm-2 col-xs-3"><img src="\' + data[m].rule7 + \'"></div><div class="col-lg-11 col-md-11 col-sm-10 col-xs-9"><h3>\' + data[m].rule3 + si + \'</h3><h4>' . $this->CI->lang->line('mb40') . ': \' + data[m].rule4 + \'</h4></div></li>\';
                            }
                            document.querySelector(\'.fillow-members-results\').innerHTML = tot;
                            reload_it();
                        }
                    }
                    http.send();
                }
                function get_stats() {
                    var url = home+\'user/bot/fillow?action=11&res=\' + twi.cid;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        var data = http.responseText;
                        if(data) {
                            data = JSON.parse(data);
                            document.querySelector(\'#fillow-stats\').innerHTML = data;
                        }
                    }
                    http.send();
                }
                show_searches(1);
                setTimeout(reload_it,500);
            }
            '
        . '</script>'
        . '<style>'
                . '.fillow-comments {
                    display: none;
                }'
                . '.fa-circle, .fa-circle-thin {
                    color: #71d775;
                    font-size: 13px;
                }'                
                . '.emails .nav-tabs>li.leposts>a {
                    border-bottom-color: transparent;
                    color: #F7A251 !important;
                }'
                . '.tab-pane>div>.panel-default {
                    min-height: 150px;
                }'
                . '.panel-heading .fa-history {
                    color: #84CCEB !important;
                }'
                . '#history_lists .pagination {
                    margin: 15px;
                }'                
                . '.tab-pane>div>.panel-default, .tab-pane#history_lists .panel-default {
                    border: 1px solid #ebeae8;
                    border-radius: 3px;
                    box-shadow: 0 0 1px #ebeae8;
                    margin-bottom: 20px !important;
                    padding: 10px 10px 14px;
                }'
                . '.tab-pane>div>.panel-default>.panel-heading {
                    background: #ffffff !important;
                }'
                . '.tab-pane#history_lists .panel-default>.panel-heading {
                    padding: 10px 0 !important;
                }'                
                . '.tab-pane>div>.panel-default>.panel-heading {
                    padding: 10px 0 0 !important;
                }'
                . '.tab-pane#history_lists .panel-default, .tab-pane#comment_lists .panel-default {
                    margin-bottom: 0 !important;
                }'             
                . '.tab-pane>div>.panel-default>.panel-heading>img, #comment_lists .panel-default>.panel-heading>img, #history_lists .panel-default>.panel-heading>img {
                    margin-right: 15px;
                }'
                . '.tab-pane>div>.panel-default>.panel-heading>h3, #comment_lists .panel-default>.panel-heading>h3, #history_lists .panel-default>.panel-heading>h3 {
                    margin: 0;
                    font-weight: 600;
                    font-size: 14px;
                }'
                . '.tab-pane>div>.panel-default>.panel-heading>h5 {
                    color: #90949c;
                }'
                . '.tab-pane>.panel-body {
                    padding: 15px 15px 0 !important;
                }'
                . '.tab-pane>.panel-body:last-child {
                    padding: 15px !important;
                }'
                . '.tab-pane>div>.panel-default>.panel-footer {
                    margin-top: 0;
                    border-top: 1px solid #e5e5e5;
                    background-color: transparent;
                    padding: 0;
                    height: 25px;
                }'
                . '.tab-pane>div>.panel-default>.panel-footer>.col-md-3 {
                    height: 35px;
                    line-height: 35px;
                }'
                . '.tab-pane>div>.panel-default>.panel-footer>.col-md-3>a {
                    color: #999;
                }'
                . '.tab-pane>div>.panel-default>.panel-footer>.col-md-3>a:hover {
                    color: #616770;
                    text-decoration: none;
                }'                
                . '.tab-pane>div>.panel-default>.panel-footer>.col-md-3>a>.fa {
                    margin-right: 10px;
                }'
                . '.search-zon, .user-results > li, .search-results > li, .fillow-members-results > li {
                    border-radius: 3px;
                    border: 1px solid #e1e8ed;
                    height: 50px;
                }'
                . '#twilos_main, #saved_search, #fillow-members, #fillow-options {
                    padding: 0 15px;
                }'
                . '#twilos_main .search input {
                    height: 48px;
                    border: 0;
                    box-shadow: none;
                    width: 98%;
                }'
                . '#twilos_main .search input:focus, #twilos_main .search input:active {
                    border: 0 !important;
                    box-shadow: none !important;
                    outline: focus !important;
                }'
                . '#twilos_main .search .btn {
                    height: 38px;
                    box-shadow: none;
                    border: 0;
                    color: #fff;
                    margin-right: 5px;
                    border-radius: 5px;
                }'
                . '#twilos_main .search .btn.search-users {
                    background: #F7A251 !important;
                }'
                . '#twilos_main .search .btn.search-users:hover {
                    background: #FACA84 !important;
                }'                
                . '#twilos_main .search .btn.save-search {
                    background: #84CCEB !important;
                    visibility: hidden;
                }'
                . '#twilos_main .search .btn.save-search:hover {
                    background: #94D8EE !important;
                }'                
                . '.search .input-group-btn>.btn {
                    margin-top: 0;
                }'
                . '.fillow-members-results {
                    padding: 0;
                }'                
                . '.user-results > li, .fillow-members-results > li {
                    list-style: none;
                    height: auto;
                    min-height: 80px;
                    margin-top: 10px;
                    padding: 15px 0;
                }'
                . 'li > .col-lg-1 > img {
                    max-width: 50px;
                }'                
                . '.search-results > li {
                    list-style: none;
                    height: auto;
                    min-height: 66px;
                    padding: 7px 0;
                    margin-bottom: 15px;
                }'                
                 . '.user-results > li > div > h3, .fillow-members-results > li > div > h3, .search-results > li > div > h3 {
                    margin: 0;
                    font-size: 16px;
                }'
                 . '.user-results > li > div > h4, .fillow-members-results > li > div > h4, .search-results > li > div > h4 {
                    font-size: 14px;
                    color: #999;
                }'
                 . '.manage-saved-search {
                    height: 35px;
                    margin-top: 6px;
                    background-color: #84CCEB;
                    border-color: #84CCEB;
                }'
                 . '.manage-saved-search:hover, .manage-saved-search:focus, .manage-saved-search:active {
                    background-color: #94D8EE !important;
                    border-color: #94D8EE !important;
                }'
                 . '.emails .nav-tabs>li>a.bolis, .emails .nav-tabs>li.active>a.bolis {
                    color: #466E8C !important;
                }'
                 . '.emails .nav-tabs>li>a.bolis2 {
                    color: #EA7562 !important;
                }'
                 . '.emails .nav-tabs>li>a.bolis3 {
                    color: #f04370 !important;
                }'                
                 . '.enablus > label::after {
                    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
                    background: #466e8c;
                    height: 16px;
                    left: 2px;
                    margin-top: -4px;
                    position: absolute;
                    top: -4px;
                    transition: all 0.3s ease-in-out;
                    width: 16px;
                }'
                 . '.enablus > input:checked + label::after {
                    background: #516CCF;
                }'          
                 . '.enablus>label::before {
                    background-color: #d3d3d3;
                    background: #d3d3d3;
                    height: 8px;
                    margin-top: -4px;
                    width: 40px;
                }'
                 . '.label-success {
                    background-color: #84CCEB;
                    background: #84CCEB;
                    border: 0;
                }'
                 . '.label-danger {
                    background-color: #F6694D;
                    background: #F6694D;
                    border: 0;
                }'
                 . '.label-default {
                    background-color: #A0D46A;
                    background: #A0D46A;
                    border: 0;
                }'
                 . '.label:focus, .label:active {
                    outline: none;
                    border: 0;
                }'
                 . '.fillow-account-select, .fillow-account-select > a, .fillow-account-select > a:focus {
                    color: #F0A580;
                    outline: 0;
                }'
                 . '.search-conts {
                    border-left: 0 !important;
                    margin-top: 12px;
                }'
                 . '.emails .dropdown-toggle {
                    margin-top: 12px;
                    height: 34px !important;
                }'
                 . '.emails .btn-add-to-account {
                    height: 24px !important;
                    padding: 1px 5px !important;
                    font-size: 12px !important;
                }'
                 . '.emails .table-responsive>.table>tbody>tr:first-child>td {
                    border-top: 1px solid #ddd !important
                }'
                 . '.fillow-status {
                    color: #337ab7;
                    font-weight: 600;
                }'
                 . '.user-results .no-comments {
                    margin-top: 15px;
                }'
                 . '.loading-image {
                    margin-top: 5px;
                }'
                 . '#fillow-stats {
                    padding: 15px;
                }'
                 . '#fillow-stats > ul > li {
                    border-radius: 3px;
                    border: 1px solid #e1e8ed;
                    padding: 10px;
                    margin-bottom: 15px;
                }'
                . '#fillow-stats > ul > li > span {
                    font-weight: 600;
                    color: #f04370;
                    font-size: 16px;
                }'               
        . '</style>';
    }
    
    /**
     * First function load was created for http requests
     *
     * @param string $act contains parameter
     */
    public function load($act) {
        switch ($act) {
            case '1':
                $key = $this->CI->input->get('key', TRUE);
                if($key) {
                    $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $this->token, $this->secret);
                    $search = $this->check->get('users/search?term=' . $key);
                    if(@$search['users']) {
                        $tot = [];
                        $i = 0;
                        foreach ($search['users'] as $res) {
                            if($i > 19) {
                                break;
                            }
                            $tot[] = [$res['id'], $res['username'], $res['country'], $res['userpic_url']];
                            $i++;
                        }
                        echo json_encode($tot);
                    }
                }
                break;
            case '2':
                $key = $this->CI->input->get('key', TRUE);
                if($key) {
                    $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $this->token, $this->secret);
                    $search = $this->check->get('users/search?term=' . $key);
                    if(@$search['users']) {
                        $new_bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['fillow-search', $this->CI->ecl('Instance')->user(),$key]);
                        $count = 0;
                        foreach ($search['users'] as $res) {
                            $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['fillow-follow', $this->CI->ecl('Instance')->user(), $new_bot, $res['id'], $res['username'], $res['country'], $res['userpic_url'], 1]);
                            $count++;
                        }
                        if($count > 0) {
                            echo 1;
                        }
                    }
                }
                break;
            case '3':
                $page = $this->CI->input->get('page', TRUE);
                if(!is_numeric($page)) {
                    exit();
                } else {
                    $page--;
                    $page = $page * 10;
                }
                $get_all_bots = $this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['fillow-search', $this->CI->ecl('Instance')->user(),0,$page]);
                if($get_all_bots) {
                    $total = count($this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['fillow-search', $this->CI->ecl('Instance')->user()]));
                    $members = [];
                    $i = 0;
                    foreach ($get_all_bots as $bot) {
                        $toti = count($this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['fillow-follow', $this->CI->ecl('Instance')->user(),$bot->bot_id]));
                        $members[] = [$bot->bot_id,$bot->rule1,$toti];
                        $i++;
                    }
                    echo json_encode(['members' => $members, 'total' => $total]);
                }
                break;
            case '4':
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $get_all_bots = $this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['fillow-follow', $this->CI->ecl('Instance')->user(), $res]);
                if($get_all_bots) {
                    $members = [];
                    foreach($get_all_bots as $bot) {
                        $fol = 0;
                        $bots = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['fillow-opts', $this->CI->ecl('Instance')->user(), $res]);
                        if(@$bots[0]->rule6) {
                            $account = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$bots[0]->rule6]);
                            if($account) {
                                $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule2' => $bot->rule2, 'rule6' => $account[0]->net_id]]);
                                if($check) {
                                    if($check[0]->rule5 == 1) {
                                        $fol = 1;
                                    } else if($check[0]->rule5 == 2) {
                                        $fol = 2;
                                    }
                                }
                            }
                        }
                        $members[] = ['rule2' => $bot->rule2, 'rule3' => $bot->rule3, 'rule4' => $bot->rule4, 'fol' => $fol, 'rule7' => $bot->rule7];
                    }
                    echo json_encode($members);
                }
                break;
            case '5':
                $key = $this->CI->input->get('key', TRUE);
                if(!$key) {
                    exit();
                }
                $this->CI->load->helper('second_helper');
                get_accounts_by_search('the_500px',$key);
                break;
            case '6':
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $id = $this->CI->input->get('id', TRUE);
                if(!is_numeric($id)) {
                    exit();
                }
                // First we need to verify if the user is owner of the bot
                $bot_owner = $this->CI->ecl('Instance')->mod('botis', 'check_bota', [$res, 'fillow-search', $this->CI->ecl('Instance')->user()]);
                if(!$bot_owner) {
                    exit();
                }
                // Then verify if user is the owner of the id
                $account_owner = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$id]);
                if( $account_owner[0]->user_id != $this->CI->ecl('Instance')->user() ) {
                    exit();
                }
                // Verify if the social network is correct
                if ( $account_owner[0]->network_name != 'the_500px' ) {
                    exit();
                }  
                $bot_id = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['fillow-opts', $this->CI->ecl('Instance')->user(), $res]);
                if(!$bot_id) {
                    $bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['fillow-opts', $this->CI->ecl('Instance')->user(), $res, $account_owner[0]->user_name]);
                    if($bot) {
                        $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot, $this->CI->ecl('Instance')->user(), 'rule6', $id]);
                        echo json_encode($account_owner[0]->user_name);
                    }
                }
                break;
            case '7':
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }            
                $bots = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['fillow-opts', $this->CI->ecl('Instance')->user(), $res]);
                if($bots) {
                    echo json_encode($bots);
                }
                break;
            case '8':
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $id = $this->CI->input->get('type', TRUE);
                if(($id != 'fillow_auto_follow') && ($id != 'fillow_auto_unfollow') && ($id != 'fillow_delete')) {
                    exit();
                }
                $val = $this->CI->input->get('val', TRUE);
                if(!is_numeric($val)) {
                    exit();
                }
                // First we need to verify if the user is owner of the bot
                $bot_owner = $this->CI->ecl('Instance')->mod('botis', 'check_bota', [$res, 'fillow-search', $this->CI->ecl('Instance')->user()]);
                if(!$bot_owner) {
                    exit();
                }
                $bot_id = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['fillow-opts', $this->CI->ecl('Instance')->user(), $res]);
                if($id != 'fillow_delete') {
                    if($bot_id) {
                        if($id == 'fillow_auto_follow') {
                            if($this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule3', $val])) {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule4', 0]);
                                echo 1;
                            }
                            if($val == 1) {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 1]);
                            } else {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 0]);
                            }
                        } else if($id == 'fillow_auto_unfollow') {
                            if($this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule4', $val])) {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule3', 0]);
                                echo 1;
                            }
                            if($val == 1) {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 1]);
                            } else {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 0]);
                            }
                        }
                    }
                } else {
                    $del_bot = $this->CI->ecl('Instance')->mod('botis', 'delete_bot', ['fillow-search', $this->CI->ecl('Instance')->user(), $res]);
                    if($del_bot) {
                        echo 1;
                    }
                }
                break;
            case '9':
                $user = $this->CI->input->get('user', TRUE);
                if(!is_numeric($user)) {
                    exit();
                }
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $get_one_bot = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-opts', 'rule1' => $res]]);
                if(!@$get_one_bot[0]->rule6) {
                    echo 2;
                    exit();
                }
                $account_owner = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$get_one_bot[0]->rule6]);
                $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $account_owner[0]->token, $account_owner[0]->secret);
                $response = $this->check->post('users/' . $user . '/friends');
                if($response) {
                    $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $res, 'rule2' => $user]]);
                    if($check) {
                        $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$check[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 1]);
                        if($get_one_bot) {
                            if($get_one_bot[0]->rule6) {
                                if($account_owner) {
                                    $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$check[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule6', $account_owner[0]->net_id]);
                                }
                            }
                        }
                    }
                    echo 1;
                }
                break;
            case '10':
                $user = $this->CI->input->get('user', TRUE);
                if(!is_numeric($user)) {
                    exit();
                }
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $get_one_bot = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-opts', 'rule1' => $res]]);
                if(!@$get_one_bot[0]->rule6) {
                    echo 2;
                    exit();
                }
                $account_owner = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$get_one_bot[0]->rule6]);
                $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $account_owner[0]->token, $account_owner[0]->secret);
                $response = $this->check->delete('users/' . $user . '/friends');
                if($response) {
                    $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $res, 'rule2' => $user]]);
                    if($check) {
                        $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$check[0]->bot_id, $this->CI->ecl('Instance')->user(), 'rule5', 2]);
                    }
                    echo 1;
                }
                break;
            case '11':
                $res = $this->CI->input->get('res', TRUE);
                if(!is_numeric($res)) {
                    exit();
                }
                $sv = 0;
                $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $res]]);
                if($check) {
                    $sv = count($check);
                }
                $fw = 0;
                $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $res, 'rule5' => 1]]);
                if($check) {
                    $fw = count($check);
                }                
                $uw = 0;
                $check = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $res, 'rule5' => 2]]);
                if($check) {
                    $uw = count($check);
                } 
                echo json_encode('<ul class="list-unstyled">
                                    <li>' . $this->CI->lang->line('mb43') . ' <span class="pull-right">' . $sv . '</span></li>
                                    <li>' . $this->CI->lang->line('mb44') . ' <span class="pull-right">' . $fw . '</span></li>
                                    <li>' . $this->CI->lang->line('mb45') . ' <span class="pull-right">' . $uw . '</span></li>
                                </ul>');
                break;
        }
    }

    /**
     * This function displays information about this class.
     */
    public function get_info() {
        return (object) ['slug' => 'fillow'];
    }
    
    /**
     * This function runs the bot schedules
     * 
     * @param integer $user_id contains the user_id
     */
    public function load_cron($user_id) {
        $check2 = rand(0,3);
        if($check2 == 2) {
            $get_one_bot = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-opts', 'rule3' => 1, 'rule5' => 1, 'user_id' => $user_id]]);
            if($get_one_bot) {
                $count = count($get_one_bot)-1;
                if($count > 0) {
                    $count = rand(0,$count);
                }
                $id = $get_one_bot[$count]->rule6;
                $get_to_folow = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $get_one_bot[$count]->rule1, 'LENGTH(rule5) <' => 1, 'user_id' => $user_id]]);
                if($get_to_folow) {
                    $count = count($get_to_folow);
                    $count--;
                    if($count > 0) {
                        $count = rand(0,$count);
                    }
                    if($id) {
                        $account_owner = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$id]);
                        if($account_owner) {
                            $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $account_owner[0]->token, $account_owner[0]->secret);
                            $verify = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule2' => $get_to_folow[$count]->rule2, 'rule5 >' => 0, 'rule6' => $account_owner[0]->net_id]]);
                            if($verify) {
                                $response = 1;
                            } else {
                                $response = $this->check->post('users/' . $get_to_folow[$count]->rule2 . '/friends');
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get_to_folow[$count]->bot_id, $user_id, 'rule6', $account_owner[0]->net_id]);
                            }
                            if($response) {
                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get_to_folow[$count]->bot_id, $user_id, 'rule5', 1]);
                            }
                        }
                    }
                } else {
                    $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get_one_bot[$count]->bot_id, $user_id, 'rule5', 0]);
                }
            }
        }
        $get_one_bot = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-opts', 'rule4' => 1, 'rule5' => 1, 'user_id' => $user_id]]);
        if($get_one_bot) {
            $count = count($get_one_bot)-1;
            if($count > 0) {
                $count = rand(0,$count);
            }
            $id = $get_one_bot[$count]->rule6;
            $get_to_folow = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule1' => $get_one_bot[$count]->rule1, 'rule5' => 1, 'user_id' => $user_id]]);
            if($get_to_folow) {
                $count = count($get_to_folow);
                $count--;
                if($count > 0) {
                    $count = rand(0,$count);
                }
                if($id) {
                    $account_owner = $this->CI->ecl('Instance')->mod('networks', 'get_account', [$id]);
                    if($account_owner) {
                        $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $account_owner[0]->token, $account_owner[0]->secret);
                        $verify = $this->CI->ecl('Instance')->mod('botis', 'get_bot', [['type' => 'fillow-follow', 'rule2' => $get_to_folow[$count]->rule2, 'rule5 >' => 1, 'rule6' => $account_owner[0]->net_id]]);
                        if($verify) {
                            $response = 1;
                        } else {
                            $response = $this->check->delete('users/' . $get_to_folow[$count]->rule2 . '/friends');
                        }
                        if($response) {
                            $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get_to_folow[$count]->bot_id, $user_id, 'rule5', 2]);
                        }
                    }
                }
            } else {
                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get_one_bot[$count]->bot_id, $user_id, 'rule5', 0]);
            }
        }
    }    
}
