<?php
/**
 * Groups_helper contains a trait for content displaying
 *
 * PHP Version 5.6
 *
 * Display content in the Posts Planner Tool
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
 * Groups_helper - display the content for the Posts Planner Tool
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
trait Groups_helper {
    // Get all autopost files
    public function get_socials(){
        $CI = & get_instance();
        // Load Options Model
        $CI->load->model('options');
        include_once APPPATH . 'interfaces/Autopost.php';
        $classes = [];
        foreach (glob(APPPATH . 'autopost/*.php') as $filename) {
            include_once $filename;
            $className = str_replace([APPPATH . 'autopost/', '.php'], '', $filename);
            // Check if the administrator has disabled the $className social network
            if ($CI->options->check_enabled(strtolower($className)) == false) {
                continue;
            }
            $get = new $className;
            $info = $get->get_info();
            $classes[] = [$info->color,$info->icon,$className];
        }
        return $classes;
    }
    // Get Class Icons
    public function get_account_assets(){
        $nets = $this->get_socials();
        if($nets){
            $socios = [];
            foreach ($nets as $net){
                $socios[] = ['soci' => strtolower($net[2]), 'value' => '<span class="icon" style="background-color:'.$net[0].'">'.$net[1].'</span>'];
            }
            return json_encode($socios);
        }
    }
    // Display Styles
    public function assets(){
        $CI = get_instance();
        $nets = $this->get_socials();
        return '<style>'
        . ' .btn-default:hover,.btn-default:active,.btn-default:focus{
                color:#333;
                background-color:#e6e6e6;
                border-color:#adadad;
            }
            .new-contu{
                margin-top: 3px;
            }
            .search-conts{
                border-left: 0 !important;
            }
            .resent>div>.panel-heading{
                color: #00a1f1;
            }
            .new-rss>div{
                background: none !important;
                box-shadow: none !important;
            }
            .new-rss .mess-stat{
                padding-left: 0;
            }             
            .new-rss .mess-planner{
                padding-right: 0;
            }
            @media(max-width:992px) {
                .new-rss .mess-stat, .new-rss .mess-planner{
                    padding: 0;
                    margin-bottom: 20px;
                }
                .navbar-nav .open .dropdown-menu {
                    margin-left: -70px;
                }
            }
            .new-rss>div>div>.panel-heading{
                display:none;
            }
            .mess-stat ul>li {
                height: 35px !important;
                min-height: 35px !important;
                margin: 0px !important;
                width: 100% !important;
                line-height: 35px !important;
                margin-bottom: 10px !important;
                font-weight: 400 !important;
                color: #555 !important;
                list-style: none !important;
                padding: 0 15px !important;
                background-color: #ffffff !important;
                border-bottom: 0 !important;
            }
            .mess-stat ul.dropdown-menu>li{
                margin-bottom: 0px !important;
                min-height:30px !important;
                height: 30px !important;
            }
            .mess-stat ul.dropdown-menu>li>a{
                padding-top: 5px !important;
                height: 30px;
            }
            section>.new-rss .open ul.sel{
                border-radius: 0;
                border-bottom: 0;
            }
            section>.new-rss .open ul>li{
                min-height: 26px;
                margin-top: 0;
            }
            .resent{
                padding-bottom: 15px;
                background-color: #f8f8f8 !important;
            }
            .resent>div>.panel-heading{
                padding-top: 10px;
                font-size: 18px;
                background: #f4f4f4 !important;
                border-bottom: 1px solid #e5e5e5 !important;
                height: 60px !important;
                line-height: 43px;
                font-weight: 600;
                color: #00a1f1;
            }
            .resent.spintax>div>.panel-heading>.loading-image {
                margin: 10px 3px auto;
            }
            .resent.spintax textarea {
                margin: 15px 0 0;
            }
            .resent .add-repeat, .resent .spin-refresh{
                border: 1px solid #CDCDCD !important;
                background-color: #fff !important;
                border-radius: 4px;
                margin-top: 5px;
            }
            .resent .add-repeat:hover, .resent .spin-refresh:hover {
                border: 1px solid #656669 !important;
                color: #656669 !important;
            }
            .resent .add-repeat.active {
                border: 1px solid #f05a75 !important;
            }
            .resent .list-group-item {
                background: #fff;
                border-radius: 3px;
                border: 1px solid #CDCDCD !important;
                margin: 15px 0 0;
                min-height: 47px;
                padding: 10px 5px;
            }
            .resent .list-group {
                margin-bottom: 0;
            }
            .resent .list-group-item>div {
                padding: 0 5px !important;
            }
            .resent .list-group-item>div>a{
                display: block;
                background-color: #F05A75;
                color: #fff;
                text-align: center;
                border-radius: 3px;
                padding: 0.25rem 0.3rem;
            }
            .resent .list-group-item>div>a:hover {
                background-color:#ea8e9f;
                text-decoration: none;
            }
            .resent .list-group-item input, .resent .list-group-item select {
                border: 1px solid #ccc;
                color: #999;
                border-radius: 3px;
                padding: 0.15rem 0.3rem;
                width: 100%;
            }
            .resent.netshow-list, .resent.plan-shows-detail {
                padding-bottom: 15px;
            }  
            .mess-stat .panel-heading, .resent>div>.panel-heading{
                margin-top: 0;
            }
            .post-plans .list-group{
                padding-bottom: 15px;
            }
            .mess-stat .list-group{
                padding-top: 10px;            
            }
            .mess-stat .pagination{
                margin-bottom: 10px;
            }
            .mess-stat .pagination>li,.mess-stat .order-by-posts li {
                background-color: transparent !important;            
            }
            .mess-stat .order-by-posts li{
                padding: 0 !important;
                font-size:14px;
            }
            .mess-stat .order-by-posts li.active>a{
                background-color: #f0f8ff !important;
                color: #333;
            }
            .mess-stat .order-by-posts li>a{
                padding-top: 12px !important;
            }
            .mess-stat .pagination>li>a{
                color: #00a1f1;
                border-radius: 0;
                border: none;
            }
            .mess-stat li a.planner-networks{
                color: #00a1f1;
            }
            .mess-stat li a.delete-group{
                color: #7ac3ff;
                margin-right: 10px;
                margin-left: 10px;
            }
            .mess-stat li a.planner-plan{
                color: #00a1f1;
            }
            .plcen:hover{
                opacity: 0.7;
            }
            .post-plans .icon{
                width: 24px;
                height: 24px;
                border-radius: 50%;
                color: #fff;
                display: inline-block;
                margin-right: 5px;
                line-height: 24px;
                text-align: center;
                font-size: 16px;
            }
            .modal .dropdown-toggle{
                margin-top: 12px;
            }
            section>.new-rss .getPost{
                cursor: initial !important;
            }
            .resent .navbar-nav>li>a{
                padding-bottom: 17px;
            }
            .planner-list{
                padding-bottom: 15px;
            }
            .planner-list>p {
                line-height: 35px;
                height: 35px;
                background-color: #ffffff;
                margin-top: 10px;
                padding: 0 10px;
                margin-bottom: 0;
            }
            #general{
                padding:15px;
            }
            .setrow{
                background-color: rgba(255,255,255,0.8);
                background-color: rgb(255,255,255,0.8);
                padding: 0 5px;
                height: 40px;
                min-height: 40px;
            }
            .enablus > label::before{
                border-radius: 2px;	
            }
            .enablus > label::after{
                border-radius: 3px;
            }
            .enablus > input[type=checkbox]:checked + label::after {
                background-color:#00a1f1; 
            }
            .setrow>div{
                line-height: 37px;
            }
            .create-group .btn-primary {
                color: #fff;
                background-color: #00a1f1 !important;
                border-color: #00a1f1 !important;
                margin-top: 12px;
            }
            .create-group .btn-primary:hover{
                background-color: #0398e2 !important;
                border-color: #0398e2 !important;
            }
            .create-group .form-group{
                margin-bottom: 10px;
            }
            @media(max-width:767px) {
                .resent .list-group-item > div > a {
                    margin-top: 10px;
                }
                .order-by-posts {
                    display: table;
                }
                .order-by-posts > li {
                    display: inline-table !important;
                }
            }
            '
        . '</style>'
        . "<script type='text/javascript'>
            window.onload = function(){
                var home = document.getElementsByClassName('navbar-brand')[0];
                var posts = {'page': 1, 'limit': 10, 'by': 1, 'soci': '".@$nets[0][2]."', 'cid': 1};
                function get_socio(tag)
                {
                    var socio = ".$this->get_account_assets().";
                    if(socio.length){
                        for(var f = 0; f < socio.length; f++){
                            if(socio[f].soci == tag){
                                return socio[f].value;
                            }
                        }
                    }
                }
                function create_group(e){
                    e.preventDefault();
                    var name = e.target.getElementsByClassName('group-name')[0].value;
                    var url = home+'user/tool/groups-accounts?action=create-new-group';
                    var csr = e.target.querySelector(\"[name='csrf_test_name']\").value;
                    var params = 'csrf_test_name='+csr+'&group='+name;
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                if(data == 1) {
                                    presults(1);                                
                                } else {
                                    
                                }
                                document.querySelector('.modal.fade.in').click();
                                document.getElementsByClassName('group-name')[0].value = '';
                            }
                            reload_it();
                        }
                    }
                    http.send(params);
                }                
                function add_netu_to_list(e){
                    e.preventDefault();
                    var id = this.getAttribute('data-id');
                    var res = posts.cid;
                    var url = home + 'user/tool/groups-accounts?action=update-selected-accounts&res='+res+'&net='+id;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                var selac = '';
                                data = JSON.parse(data);
                                if(data == 2) {
                                    popup_fon('sube', translation.mm121 + ' " . plan_feature('publish_accounts') . " ' + '" . strtolower($CI->lang->line('mt19')) . "', 1500, 2000);
                                } else {
                                    for (var u = 0; u < data.length; u++)
                                    {
                                        selac += '<div class=\"list-group-item\"><div class=\"col-md-10 col-sm-10 col-xs-10 clean\">'+get_socio(data[u].network_name)+' '+data[u].user_name+'</div><div class=\"col-md-2 col-sm-2 col-xs-2 clean text-right\"><a href=\"#\" data-id=\"'+data[u].meta_id+'\" class=\"delete-selected-accounts\">".$CI->lang->line('mm133')."</a></div></div>';
                                    }
                                    document.querySelector('.sellected-accounts').innerHTML = selac;
                                }
                            } else {
                                document.querySelector('.sellected-accounts').innerHTML = '<p>" . $CI->lang->line('mm127') . "</p>';
                            }
                            document.querySelector('.modal.fade.in').click();
                            document.getElementsByClassName('search-conts')[0].value = '';
                            document.getElementsByClassName('accounts-found')[0].innerHTML = '<tr><td>" . $CI->lang->line('mm127') . "</td></tr>';
                            reload_it();
                        }
                    }
                    http.send();
                }
                function netil(e){
                    e.preventDefault();
                    document.getElementsByClassName('optionss-list')[0].style.display = 'none';
                    document.getElementsByClassName('netshow-list')[0].style.display = 'block';
                    var res = this.closest('li').getAttribute('data-id');
                    posts.cid = res;
                    var url = home+'user/tool/groups-accounts?action=get-selected&res='+res;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                var selac = '';
                                data = JSON.parse(data);
                                for (var u = 0; u < data.length; u++)
                                {
                                    selac += '<div class=\"list-group-item\"><div class=\"col-md-10 col-sm-10 col-xs-10 clean\">'+get_socio(data[u].network_name)+' '+data[u].user_name+'</div><div class=\"col-md-2 col-sm-2 col-xs-2 clean text-right\"><a href=\"#\" data-id=\"'+data[u].meta_id+'\" class=\"delete-selected-accounts\">".$CI->lang->line('mm133')."</a></div></div>';
                                }
                                document.querySelector('.sellected-accounts').innerHTML = selac;
                            } else {
                                document.querySelector('.sellected-accounts').innerHTML = '<p>".$CI->lang->line('mm124')."</p>';
                            }
                            reload_it();
                        }
                    }
                    http.send();
                }
                function show_planner_options(e){
                    e.preventDefault();
                    document.getElementsByClassName('netshow-list')[0].style.display = 'none';
                    document.getElementsByClassName('optionss-list')[0].style.display = 'block';                
                }
                function pnumi(e){
                    e.preventDefault();
                    presults(this.getAttribute('data-page'));
                }
                function sell(e){
                    e.preventDefault();
                    this.closest('.multiple-form-group').getElementsByClassName('concept')[0].innerText = this.innerText;
                    posts.soci = this.getAttribute('href');
                }
                function delete_group(e){
                    e.preventDefault();
                    var id = this.closest('li').getAttribute('data-id');
                    var url = home + 'user/tool/groups-accounts?action=delete-group&group=' + id;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                data = JSON.parse(data);
                                if(data == 1) {
                                    presults(1);                                
                                } else {
                                    
                                }
                            }
                            reload_it();
                        }
                    }
                    http.send();
                }
                function delete_accounts(e){
                    e.preventDefault();
                    var id = this.getAttribute('data-id');
                    var res = posts.cid;
                    var url = home + 'user/tool/groups-accounts?action=delete-accounts&meta=' + id + '&res=' + res;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                var selac = '';
                                data = JSON.parse(data);
                                for (var u = 0; u < data.length; u++)
                                {
                                    selac += '<div class=\"list-group-item\"><div class=\"col-md-10 col-sm-10 col-xs-10 clean\">'+get_socio(data[u].network_name)+' '+data[u].user_name+'</div><div class=\"col-md-2 col-sm-2 col-xs-2 clean text-right\"><a href=\"#\" data-id=\"'+data[u].meta_id+'\" class=\"delete-selected-accounts\">".$CI->lang->line('mm133')."</a></div></div>';
                                }
                                document.querySelector('.sellected-accounts').innerHTML = selac;
                            } else {
                                document.querySelector('.sellected-accounts').innerHTML = '<p>".$CI->lang->line('mm124')."</p>';
                            }
                            reload_it();
                        }
                    }
                    http.send();
                }                
                function search_conts(){
                    var url = home+'user/tool/posts-planner?action=search-accounts';
                    var keys = document.getElementsByClassName('search-conts')[0].value;
                    var csr = document.querySelector(\"[name='csrf_test_name']\").value;
                    var soci = posts.soci;
                    var params = 'csrf_test_name='+csr+'&keys='+keys+'&net='+soci;
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                var show = '';
                                for(var o = 0; o < data.length; o++){
                                    show += '<tr><td>'+data[o].user_name+'</td><td style=\"text-align: right;\"><button class=\"btn-add-to-group btn btn-default btn-xs\" type=\"button\" data-id=\"'+data[o].network_id+'\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></button></td></tr>';
                                }
                                document.getElementsByClassName('accounts-found')[0].innerHTML = show;
                                reload_it();
                            } else {
                                document.getElementsByClassName('accounts-found')[0].innerHTML = '<tr><td>".$CI->lang->line('mm127')."</td></tr>';                            
                            }
                        }
                    }
                    http.send(params);
                }                
                function reload_it(){
                    var delete_g = document.getElementsByClassName('delete-group');
                    if(delete_g.length)
                    {
                        if(delete_g[0].addEventListener){
                            for(var f = 0; f < delete_g.length; f++)
                            {
                                delete_g[f].addEventListener('click', delete_group, false);
                            }
                        }else if(delete_g[0].attachEvent){
                            for(var f = 0; f < delete_g.length; f++)
                            {
                                delete_g[f].attachEvent('onclick', delete_group);
                            }
                        }
                    }
                    var neti = document.getElementsByClassName('planner-networks');
                    if(neti.length)
                    {
                        if(neti[0].addEventListener){
                            for(var f = 0; f < neti.length; f++)
                            {
                                neti[f].addEventListener('click', netil, false);
                            }
                        }else if(neti[0].attachEvent){
                            for(var f = 0; f < neti.length; f++)
                            {
                                neti[f].attachEvent('onclick', netil);
                            }
                        }
                    }
                    var pnum = document.getElementsByClassName('pnum');
                    if(pnum.length)
                    {
                        if(pnum[0].addEventListener){
                            for(var f = 0; f < pnum.length; f++)
                            {
                                pnum[f].addEventListener('click', pnumi, false);
                            }
                        }else if(pnum[0].attachEvent){
                            for(var f = 0; f < pnum.length; f++)
                            {
                                pnum[f].attachEvent('onclick', pnumi);
                            }
                        }
                    }
                    var add_net_to_list = document.getElementsByClassName('btn-add-to-group');
                    if(add_net_to_list.length)
                    {
                        if(add_net_to_list[0].addEventListener){
                            for(var f = 0; f < add_net_to_list.length; f++)
                            {
                                add_net_to_list[f].addEventListener('click', add_netu_to_list, false);
                            }
                        }else if(add_net_to_list[0].attachEvent){
                            for(var f = 0; f < add_net_to_list.length; f++)
                            {
                                add_net_to_list[f].attachEvent('onclick', add_netu_to_list);
                            }
                        }
                    }            
                    var conts = document.getElementsByClassName('search-conts');
                    if(conts.length)
                    {
                        if(conts[0].addEventListener){
                            conts[0].addEventListener('keyup', search_conts, false);
                        }else if(conts[0].attachEvent){
                            conts[0].attachEvent('onkeyup', search_conts);
                        }
                    }
                    var show_planner_o = document.getElementsByClassName('show-planner-options');
                    if(show_planner_o.length)
                    {
                        if(show_planner_o[0].addEventListener){
                            show_planner_o[0].addEventListener('click', show_planner_options, false);
                        }else if(show_planner_o[0].attachEvent){
                            show_planner_o[0].attachEvent('onclick', show_planner_options);
                        }
                    }                    
                    var sel = document.querySelectorAll('.sel>li>a');
                    if(sel.length)
                    {
                        if(sel[0].addEventListener){
                            for(var f = 0; f < sel.length; f++)
                            {
                                sel[f].addEventListener('click', sell, false);
                            }
                        }else if(sel[0].attachEvent){
                            for(var f = 0; f < sel.length; f++)
                            {
                                sel[f].attachEvent('onclick', sell);
                            }
                        }
                    }
                    var form = document.getElementsByClassName('create-group');
                    if(form.length > 0)
                    {
                        if(form[0].addEventListener){
                            for(var f = 0; f < form.length; f++)
                            {
                                form[f].addEventListener('submit', create_group, false);
                            }
                        }else if(form[0].attachEvent){
                            for(var f = 0; f < form.length; f++)
                            {
                                form[f].attachEvent('onsubmit', create_group);
                            }
                        }
                    }
                    var delete_selected_accounts = document.getElementsByClassName('delete-selected-accounts');
                    if(delete_selected_accounts.length > 0)
                    {
                        if(delete_selected_accounts[0].addEventListener){
                            for(var f = 0; f < delete_selected_accounts.length; f++)
                            {
                                delete_selected_accounts[f].addEventListener('click', delete_accounts, false);
                            }
                        }else if(delete_selected_accounts[0].attachEvent){
                            for(var f = 0; f < delete_selected_accounts.length; f++)
                            {
                                delete_selected_accounts[f].attachEvent('onclick', delete_accounts);
                            }
                        }
                    }                    
                }
                function show_pagination(total)
                {
                    // the code bellow displays pagination
                    document.querySelector('.pagination').innerHTML = '';
                    if (parseInt(posts.page) > 1)
                    {
                        var bac = parseInt(posts.page) - 1;
                        var pages = '<li><a href=\"#\" data-page=\"' + bac + '\" class=\"pnum\">' + translation.mm128 + '</a></li>';
                    } else
                    {
                        var pages = '<li class=\"pagehide\"><a href=\"#\">' + translation.mm128 + '</a></li>';
                    }
                    var tot = parseInt(total) / parseInt(posts.limit);
                    tot = Math.ceil(tot) + 1;
                    var from = (parseInt(posts.page) > 2) ? parseInt(posts.page) - 2 : 1;
                    for (var p = from; p < parseInt(tot); p++)
                    {
                        if (p === parseInt(posts.page))
                        {
                            pages += '<li class=\"active\"><a data-page=\"' + p + '\" class=\"pnum\">' + p + '</a></li>';
                        } else if ((p < parseInt(posts.page) + 3) && (p > parseInt(posts.page) - 3))
                        {
                            pages += '<li><a href=\"#\" data-page=\"' + p + '\" class=\"pnum\">' + p + '</a></li>';
                        } else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(posts.page) == 1) || (parseInt(posts.page) == 2)))
                        {
                            pages += '<li><a href=\"#\" data-page=\"' + p + '\" class=\"pnum\">' + p + '</a></li>';
                        } else
                        {
                            break;
                        }
                    }
                    if (p === 1)
                    {
                        pages += '<li class=\"active\"><a data-page=\"' + p + '\">' + p + '</a></li>';
                    }
                    var next = parseInt(posts.page);
                    next++;
                    if (next < Math.round(tot))
                    {
                        document.querySelector('.pagination').innerHTML = pages + '<li><a href=\"#\" data-page=\"' + next + '\">' + translation.mm129 + '</a></li>';
                    } else
                    {
                        document.querySelector('.pagination').innerHTML = pages + '<li class=\"pagehide\"><a href=\"#\">' + translation.mm129 + '</a></li>';
                    }
                }
                function presults(num){
                    posts.page = num;
                    var url = home + 'user/show-lists/' + num + '/social';
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data)
                            {
                                data = JSON.parse(http.responseText);
                                var allposts = '';
                                document.getElementsByClassName('pagination')[0].style.display = 'block';
                                show_pagination(data.total);
                                for (var u = 0; u < data.lists.length; u++)
                                {
                                    var text = (data.lists[u].name.length > 50) ? data.lists[u].name.substring(0, 50) + '...' : data.lists[u].name;
                                    allposts += '<li class=\"getPost\" data-id=\"'+data.lists[u].list_id+'\">'+text+' <div class=\"pull-right\"><a href=\"#\" class=\"delete-group plcen\"><i class=\"fa fa-trash-o\"></i></a><a href=\"#\" class=\"planner-networks plcen\"><i class=\"fa fa-tasks\"></i></a></div></li>';
                                }
                                document.querySelector('.mess-stat .list-group ul').innerHTML = allposts;
                                reload_it();
                            } else {
                                document.getElementsByClassName('pagination')[0].style.display = 'none';
                                document.querySelector('.mess-stat .list-group ul').innerHTML = '<li class=\"getPost\">".$CI->lang->line('mt17')."</li>';
                            }
                        }
                    }
                    http.send();
                }
                reload_it();
                presults(1);
            }
            </script>";
    }
}