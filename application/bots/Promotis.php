<?php
/**
 * Promotis
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Promotis
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
 * Promotis class - allows users to connect to their Promotis and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Promotis implements Boots {
    protected $CI;
    /**
     * Load networks and user model.
     */
    public function __construct() {
        $this->CI =& get_instance();
        // Load User Model
        $this->CI->load->model('user');
    }
    
    /**
     * First function check if the Facebook api is configured correctly.
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
        $upi = '';
        if (get_option('enable-image-uplodad')): 
            $imu .= $this->CI->lang->line('mu34');
            $upi = '<button class="btn imgup" data-type="image" type="button"><i class="fa fa-picture-o"></i></button>';
        endif;
        return $this->assets().' 
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active leposts">
                                    <a href="#campaign_gallery" data-toggle="tab">
                                        <i class="fa fa-file-text-o"></i>
                                    </a>
                                </li>
                                <li class="leprom">
                                    <a href="#bookmarked_comments" data-toggle="tab">
                                        <i class="fa fa-bookmark-o"></i>
                                    </a>
                                </li>
                                <li class="leprom">
                                    <a href="#active_posts" data-toggle="tab">
                                        <i class="fa fa-toggle-on"></i>
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="campaign_gallery">
                                    <div class="promotis-content"></div>
                                    <div class="row">
                                        <div class="col col-lg-12">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bookmarked_comments">
                                    <div class="promotis-content"></div>
                                    <div class="row">
                                        <div class="col col-lg-12">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="active_posts">
                                    <div class="promotis-content"></div>
                                    <div class="row">
                                        <div class="col col-lg-12">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 promotis-comments">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#comments" data-toggle="tab" class="bolis">
                                        <i class="fa fa-comments-o"></i>
                                    </a>
                                </li>
                                <a href="#" class="pull-right" id="promotis-add-new-comment">' . $this->CI->lang->line('mb6') . '</a>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="comment_lists">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 promotis-history">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#histories" data-toggle="tab" class="bolis">
                                        <i class="fa fa-history"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="history_lists">
                                <div class="promotis-content"></div>
                                <div class="row">
                                    <div class="col col-lg-12">
                                        <ul class="pagination">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 promotis-add-new-comment">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#new-comment-promotis" data-toggle="tab" class="bolis">
                                        <i class="fa fa-comment-o"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="new-comment-promotis">
                                '.form_open('#', ['class' => 'add-new-comment']).'
                                    <div class="col-lg-12">
                                        <textarea class="new-post comment form-control" rows="5" placeholder="' . $this->CI->lang->line('mu24') . '" required="true"></textarea>
                                    </div>
                                    <div class="col-lg-12 link">
                                        <div>
                                            <a href="" target="_blank"></a>
                                            <input type="text" class="form-control url">
                                            <button title="' . $this->CI->lang->line('mu26') . '" class="pull-right insert delete-link" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <input type="text" placeholder="' . $this->CI->lang->line('mu28') . '" class="form-control the-link">
                                            <span class="input-group-btn">
                                                <button class="btn add-link" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 imag">
                                        <div>
                                            <a href="" target="_blank"></a>
                                            <input type="text" class="form-control img">
                                            <button title="' . $this->CI->lang->line('mu26') . '" class="pull-right insert delete-img" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <input type="text" placeholder="' . $imu . '" class="form-control the-img">
                                            <span class="input-group-btn">
                                            ' . $upi . '
                                            <button class="btn add-img" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 media-gallery media-gallery-images" data-type="image">
                                       <ul>
                                       </ul>
                                    </div>
                                    <div class="col-lg-12 media-gallery media-gallery-pagination" data-type="image">
                                        <div class="btn-group btn-group-info pull-left">
	                                    <button class="btn btn-default disabled media-images-back" type="button"><i class="fa fa-angle-left"></i></button>
                                            <button class="btn btn-default disabled media-images-next" type="button"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                        <span class="pull-right total-gallery-photos"></span>
                                        </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success pull-right draft-save">' . $this->CI->lang->line('mb7') . '</button>
                                    </div>
                                '.form_close().'
                            </div>
                        </div>
                    </div>' . form_open_multipart('user/bots/promotis', ['class' => 'upim', 'id' => 'upim', 'method' => 'post']) . '<input type="hidden" name="type" id="type" value="image"><input type="file" name="file" id="file" accept=".gif,.jpg,.jpeg,.png">' . form_close();
    }
    
    public function assets() {
        $this->CI = $this->CI;
        return '<script language="javascript">'
        . 'window.onload = function(){
                var home = document.getElementsByClassName(\'navbar-brand\')[0];
                var posts = {\'page\': 1, \'limit\': 10, \'cid\': 0};
                function add_link(e) {
                    e.preventDefault();
                    var uri = document.getElementsByClassName(\'the-link\')[0].value;
                    if (uri.substring(0, 4) !== \'http\') {
                        popup_fon(\'sube\', translation.mm117, 1500, 2000);
                        return;
                    }
                    document.querySelector(\'.link a\').setAttribute(\'href\', uri);
                    document.querySelector(\'.link a\').innerText = uri;
                    document.querySelector(\'.url\').value = uri;
                    document.querySelector(\'.link\').style.display = \'block\';
                }
                function clean_it(a) {
                    var encode = btoa(a);
                    encode = encode.replace(\'/\', \'-\');
                    return encode.replace(/=/g, \'\');
                }
                function add_image(e) {
                    e.preventDefault();
                    var uri = document.getElementsByClassName(\'the-img\')[0].value;
                    if (uri.substring(0, 4) !== \'http\') {
                        popup_fon(\'sube\', translation.mm117, 1500, 2000);
                        return;
                    }
                    document.querySelector(\'.imag a\').setAttribute(\'href\', uri);
                    document.querySelector(\'.imag a\').innerText = uri;
                    document.querySelector(\'.img\').value = uri;
                    document.querySelector(\'.imag\').style.display = \'block\';
                    document.querySelector(\'.the-img\').value = \'\';
                }                
                function delete_link(e) {
                    e.preventDefault();
                    document.querySelector(\'.link a\').setAttribute(\'href\', \'\');
                    document.querySelector(\'.link a\').innerText = \'\';
                    document.querySelector(\'.url\').value = \'\';
                    document.querySelector(\'.link\').style.display = \'none\';
                }
                function delete_img(e) {
                    e.preventDefault();
                    document.querySelector(\'.imag a\').setAttribute(\'href\', \'\');
                    document.querySelector(\'.imag a\').innerText = \'\';
                    document.querySelector(\'.img\').value = \'\';
                    document.querySelector(\'.imag\').style.display = \'none\';
                }
                function open_comments(e) {
                    e.preventDefault();
                    posts.cid = this.closest(\'.panel-default\').getAttribute(\'data-net\');
                    document.getElementsByClassName(\'promotis-add-new-comment\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-history\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-comments\')[0].style.display = \'block\';
                    get_comments();
                }
                function open_hists(e) {
                    e.preventDefault();
                    posts.cid = this.closest(\'.panel-default\').getAttribute(\'data-net\');
                    document.getElementsByClassName(\'promotis-add-new-comment\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-comments\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-history\')[0].style.display = \'block\';
                    show_history(1);
                }
                function imgup(e) {
                    e.preventDefault();
                    document.getElementById(\'file\').click();
                }             
                function promotis_add_new_comment(e) {
                    e.preventDefault();
                    document.getElementsByClassName(\'promotis-comments\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-history\')[0].style.display = \'none\';
                    document.getElementsByClassName(\'promotis-add-new-comment\')[0].style.display = \'block\';
                }                
                function book_it(e) {
                    e.preventDefault();
                    var dthis = this;
                    var act = dthis.closest(\'.panel-default\').getAttribute(\'data-net\');
                    var url = home+\'user/bot/promotis?action=3&act=\'+act;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                if(!dthis.classList.contains(\'active\')) {
                                    dthis.classList.add(\'active\');
                                } else {
                                    dthis.classList.remove(\'active\');
                                }
                                bresults(1);
                            } else {
                                popup_fon(\'sube\', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function promo_opts(e) {
                    e.preventDefault();
                    var dthis = this;
                    var act = posts.cid;
                    var pobi = dthis.closest(\'.panel-body\');
                    var com = dthis.closest(\'.panel-body\').getAttribute(\'data-com\');
                    var type = dthis.getAttribute(\'data-type\');
                    var value = dthis.value;
                    var url = home+\'user/bot/promotis?action=7&act=\'+act + \'&com=\' + com + \'&type=\' + type + \'&value=\' + value;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                if(type === \'rule3\') {
                                    if(value > 0) {
                                        pobi.querySelector(\'.fa-circle-thin\').classList.add(\'fa-circle\');
                                        pobi.querySelector(\'.fa-circle-thin\').classList.remove(\'fa-circle-thin\');
                                    } else {
                                        pobi.querySelector(\'.fa-circle\').classList.add(\'fa-circle-thin\');
                                        pobi.querySelector(\'.fa-circle\').classList.remove(\'fa-circle\');                                    
                                    }
                                    aresults(1);
                                }
                            } else {
                                popup_fon(\'sube\', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function del_com(e) {
                    e.preventDefault();
                    var dthis = this;
                    var act = posts.cid;
                    var com = dthis.closest(\'.panel-body\').getAttribute(\'data-com\');
                    var url = home + \'user/bot/promotis?action=6&com=\' + com + \'&act=\'+act;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                data = JSON.parse(data);
                                if(data == 1) {
                                    get_comments();
                                    reload_it();
                                    popup_fon(\'subi\', \'' . $this->CI->lang->line('mb4') . '\', 1500, 2000);
                                } else {
                                    popup_fon(\'sube\', \'' . $this->CI->lang->line('mb5') . '\', 1500, 2000);
                                }
                            }
                        }
                    }
                    http.send();
                }
                function pnumi(e){
                    e.preventDefault();
                    var dez = this.closest(\'.tab-pane\').getAttribute(\'id\');
                    if(dez === \'campaign_gallery\') {
                        presults(this.getAttribute(\'data-page\'));
                    } else if(dez === \'bookmarked_comments\') {
                        bresults(this.getAttribute(\'data-page\'));
                    } else if(dez === \'active_posts\') {
                        aresults(this.getAttribute(\'data-page\'));
                    } else if(dez === \'history_lists\') {
                        show_history(this.getAttribute(\'data-page\'));
                    }
                }
                function new_comment_form(e) {
                    e.preventDefault();
                    var dthis = this;
                    var act = posts.cid;
                    var url = home+\'user/bot/promotis?action=4&act=\'+act;
                    var comment = e.target.getElementsByClassName(\'comment\')[0].value;
                    var uru = e.target.getElementsByClassName(\'url\')[0].value;
                    var img = e.target.getElementsByClassName(\'img\')[0].value;
                    var csr = e.target.querySelector(\'[name="csrf_test_name"]\').value;
                    var params = \'csrf_test_name=\'+csr+\'&comment=\'+comment+\'&img=\'+img+\'&url=\'+uru;
                    var http = new XMLHttpRequest();
                    http.open(\'POST\', url, true);
                    http.setRequestHeader(\'Content-type\', \'application/x-www-form-urlencoded\');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data){
                                popup_fon(\'subi\', \'' . $this->CI->lang->line('mb3') . '\', 1500, 2000);
                                document.getElementsByClassName(\'add-new-comment\')[0].reset();
                                document.querySelector(\'.link a\').setAttribute(\'href\', \'\');
                                document.querySelector(\'.link a\').innerText = \'\';
                                document.querySelector(\'.url\').value = \'\';
                                document.querySelector(\'.link\').style.display = \'none\';
                                document.querySelector(\'.imag a\').setAttribute(\'href\', \'\');
                                document.querySelector(\'.imag a\').innerText = \'\';
                                document.querySelector(\'.img\').value = \'\';
                                document.querySelector(\'.imag\').style.display = \'none\';
                                document.getElementsByClassName(\'promotis-add-new-comment\')[0].style.display = \'none\';
                                document.getElementsByClassName(\'promotis-comments\')[0].style.display = \'block\';
                                get_comments();
                            } else {
                                popup_fon(\'sube\', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send(params);
                } 
                function reload_it() {
                    var onts = document.getElementsByClassName(\'promotis-coments\');
                    if(onts.length) {
                        if(onts[0].addEventListener){
                            for(var f = 0; f < onts.length; f++) {
                                onts[f].addEventListener(\'click\', open_comments, false);
                            }
                        } else if(onts[0].attachEvent) {
                            for(var f = 0; f < onts.length; f++) {
                                onts[f].attachEvent(\'onclick\', open_comments);
                            }
                        }
                    }
                    var hists = document.getElementsByClassName(\'promotis-histor\');
                    if(hists.length) {
                        if(hists[0].addEventListener){
                            for(var f = 0; f < hists.length; f++) {
                                hists[f].addEventListener(\'click\', open_hists, false);
                            }
                        } else if(hists[0].attachEvent) {
                            for(var f = 0; f < hists.length; f++) {
                                hists[f].attachEvent(\'onclick\', open_hists);
                            }
                        }
                    }
                    var pbookm = document.getElementsByClassName(\'promotis-bookmark\');
                    if(pbookm.length) {
                        if(pbookm[0].addEventListener){
                            for(var f = 0; f < pbookm.length; f++) {
                                pbookm[f].addEventListener(\'click\', book_it, false);
                            }
                        } else if(pbookm[0].attachEvent) {
                            for(var f = 0; f < pbookm.length; f++) {
                                pbookm[f].attachEvent(\'onclick\', book_it);
                            }
                        }
                    }
                    var new_commen = document.getElementById(\'promotis-add-new-comment\');
                    if(new_commen.addEventListener) {
                        new_commen.addEventListener(\'click\', promotis_add_new_comment, false);
                    } else if(new_commen.attachEvent) {
                        new_commen.attachEvent(\'onclick\', promotis_add_new_comment);
                    }
                    var new_comment = document.getElementsByClassName(\'add-new-comment\');
                    if(new_comment.length > 0) {
                        if(new_comment[0].addEventListener){
                            new_comment[0].addEventListener(\'submit\', new_comment_form, false);
                        } else if(new_comment[0].attachEvent){
                            new_comment[0].attachEvent(\'onsubmit\', new_comment_form);
                        }
                    }
                    var add_lin = document.getElementsByClassName(\'add-link\');
                    if(add_lin.length > 0) {
                        if(add_lin[0].addEventListener){
                            add_lin[0].addEventListener(\'click\', add_link, false);
                        } else if(add_lin[0].attachEvent){
                            add_lin[0].attachEvent(\'onclick\', add_link);
                        }
                    }
                    var imgup_lin = document.getElementsByClassName(\'imgup\');
                    if(imgup_lin.length > 0) {
                        if(imgup_lin[0].addEventListener){
                            imgup_lin[0].addEventListener(\'click\', imgup, false);
                        } else if(imgup_lin[0].attachEvent){
                            imgup_lin[0].attachEvent(\'onclick\', imgup);
                        }
                    }                    
                    var delete_lin = document.getElementsByClassName(\'delete-link\');
                    if(delete_lin.length > 0) {
                        if(delete_lin[0].addEventListener){
                            delete_lin[0].addEventListener(\'click\', delete_link, false);
                        } else if(delete_lin[0].attachEvent){
                            delete_lin[0].attachEvent(\'onclick\', delete_link);
                        }
                    }
                    var delete_im = document.getElementsByClassName(\'delete-img\');
                    if(delete_im.length > 0) {
                        if(delete_im[0].addEventListener){
                            delete_im[0].addEventListener(\'click\', delete_img, false);
                        } else if(delete_im[0].attachEvent){
                            delete_im[0].attachEvent(\'onclick\', delete_img);
                        }
                    }
                    var add_img = document.getElementsByClassName(\'add-img\');
                    if(add_img.length > 0) {
                        if(add_img[0].addEventListener){
                            add_img[0].addEventListener(\'click\', add_image, false);
                        } else if(add_img[0].attachEvent){
                            add_img[0].attachEvent(\'onclick\', add_image);
                        }
                    }
                    var del_prom_com = document.getElementsByClassName(\'del-prom-com\');
                    if(del_prom_com.length > 0) {
                        if(del_prom_com[0].addEventListener){
                            for(var f = 0; f < del_prom_com.length; f++) {
                                del_prom_com[f].addEventListener(\'click\', del_com, false);
                            }
                        } else if(del_prom_com[0].attachEvent) {
                            for(var f = 0; f < del_prom_com.length; f++) {
                                del_prom_com[f].attachEvent(\'onclick\', del_com);
                            }
                        }
                    }
                    var opts = document.getElementsByClassName(\'promo-opts\');
                    if(opts.length > 0) {
                        if(opts[0].addEventListener) {
                            for(var f = 0; f < opts.length; f++) {
                                opts[f].addEventListener(\'change\', promo_opts, false);
                            }
                        } else if(opts[0].attachEvent) {
                            for(var f = 0; f < opts.length; f++) {
                                opts[f].attachEvent(\'onchange\', promo_opts);
                            }
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
                }
                function show_pagination(total,id) {
                    // the code bellow displays pagination
                    document.querySelector(id + \' .pagination\').innerHTML = \'\';
                    if (parseInt(posts.page) > 1) {
                        var bac = parseInt(posts.page) - 1;
                        var pages = \'<li><a href="#" data-page="\' + bac + \'" class="pnum">\' + translation.mm128 + \'</a></li>\';
                    } else {
                        var pages = \'<li class="pagehide"><a href="#">\' + translation.mm128 + \'</a></li>\';
                    }
                    var tot = parseInt(total) / parseInt(posts.limit);
                    tot = Math.ceil(tot) + 1;
                    var from = (parseInt(posts.page) > 2) ? parseInt(posts.page) - 2 : 1;
                    for (var p = from; p < parseInt(tot); p++) {
                        if (p === parseInt(posts.page)) {
                            pages += \'<li class="active"><a data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else if ((p < parseInt(posts.page) + 3) && (p > parseInt(posts.page) - 3)) {
                            pages += \'<li><a href="#" data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(posts.page) == 1) || (parseInt(posts.page) == 2))) {
                            pages += \'<li><a href="#" data-page="\' + p + \'" class="pnum">\' + p + \'</a></li>\';
                        } else {
                            break;
                        }
                    }
                    if (p === 1) {
                        pages += \'<li class="active"><a data-page="\' + p + \'">\' + p + \'</a></li>\';
                    }
                    var next = parseInt(posts.page);
                    next++;
                    if (next < Math.round(tot)) {
                        document.querySelector(id + \' .pagination\').innerHTML = pages + \'<li><a href="#" data-page="\' + next + \'">\' + translation.mm129 + \'</a></li>\';
                    } else {
                        document.querySelector(id + \' .pagination\').innerHTML = pages + \'<li class="pagehide"><a href="#">\' + translation.mm129 + \'</a></li>\';
                    }
                }
                function get_comments(){
                    var act = posts.cid;
                    var url = home+\'user/bot/promotis?action=5&act=\'+act;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                data = JSON.parse(http.responseText);
                                console.log(data);
                                var tot = \' \';
                                for(var m = 0; m < data.length; m++) {
                                    var rule2 = data[m].rule2;
                                    var net_id = data[m].net_id;
                                    var avatar = \'http://graph.facebook.com/\' + net_id + \'/picture?type=square\'
                                    if(!net_id) {
                                        avatar = \'https://i.imgur.com/YPl0PNA.jpg\';
                                    }
                                    var user_name = data[m].user_name;
                                    var fs = \'<select class="promo-opts" data-type="rule3"><option value="0">' . $this->CI->lang->line('mb8') . '</option><option value="1">1 ' . $this->CI->lang->line('mb9') . '</option><option value="6">6 ' . $this->CI->lang->line('mb10') . '</option><option value="12">12 ' . $this->CI->lang->line('mb10') . '</option><option value="24">' . $this->CI->lang->line('mb11') . '</option><option value="168">' . $this->CI->lang->line('mb12') . '</option></select>\';
                                    fs = fs.replace(\'value="\' + data[m].fop + \'"\', \'value="\' + data[m].fop + \'" selected\');
                                    var ss = \'<select class="promo-opts" data-type="rule4"><option value="0">' . $this->CI->lang->line('mb14') . '</option><option value="1">' . $this->CI->lang->line('mb15') . '</option><option value="2">' . $this->CI->lang->line('mb16') . '</option></select>\';
                                    ss = ss.replace(\'value="\' + data[m].sop + \'"\', \'value="\' + data[m].sop + \'" selected\');
                                    var ts = \'<select class="promo-opts" data-type="rule5"><option value="0">' . $this->CI->lang->line('mb17') . '</option><option value="1">1 ' . $this->CI->lang->line('mb9') . '</option><option value="6">6 ' . $this->CI->lang->line('mb10') . '</option><option value="12">12 ' . $this->CI->lang->line('mb10') . '</option><option value="24">' . $this->CI->lang->line('mb11') . '</option><option value="168">' . $this->CI->lang->line('mb12') . '</option></select>\';
                                    ts = ts.replace(\'value="\' + data[m].top + \'"\', \'value="\' + data[m].top + \'" selected\');
                                    var os = \'<select class="promo-opts" data-type="rule6"><option value="0">' . $this->CI->lang->line('mb18') . '</option><option value="1">' . $this->CI->lang->line('mb19') . '</option><option value="2">' . $this->CI->lang->line('mb20') . '</option></select>\';
                                    os = os.replace(\'value="\' + data[m].ffop + \'"\', \'value="\' + data[m].ffop + \'" selected\');
                                    var body = \' \';
                                    if(data[m].rule2) {
                                        body = \'<p>\' + data[m].rule2 + \'</p>\';
                                    }
                                    var link = \' \';
                                    if(data[m].rule3) {
                                        link = \'<p><a href="\' + data[m].rule3 + \'">\' + data[m].rule3 + \'</a></p>\';
                                    }
                                    var img = \' \';
                                    if(data[m].rule4) {
                                        img = \'<p><img src="\' + data[m].rule4 + \'" style="max-width: 100%;"></p>\';
                                    }
                                    var fro = \'<i class="fa fa-circle-thin"></i>\';
                                    if(data[m].fop > 0) {
                                        fro = \'<i class="fa fa-circle"></i>\';
                                    }
                                    tot += \'<div class="panel-body" data-com="\' + data[m].bot_id + \'"><div class="panel panel-default"><div class="panel-heading"><img class="img-circle pull-left" src="\' + avatar + \'" alt="My Avatar"><h3>\' + user_name + \' \' + fro + \'</h3> <button type="button" class="btn btn-default del-prom-com pull-right"><i class="fa fa-trash-o"></i></button><h5><span><i class="fa fa-share"></i> 0 times</span></h5>\' + body + link + img + \'</div><div class="panel-footer"><div class="col-md-3">\' + fs + \'</div><div class="col-md-3">\' + ss + \'</div><div class="col-md-3">\' + ts + \'</div><div class="col-md-3">\' + os + \'</div></div></div></div>\';
                                }
                                document.querySelector(\'#comment_lists\').innerHTML = tot;
                                setTimeout(reload_it,500);
                            } else {
                                document.querySelector(\'#comment_lists\').innerHTML = \'<div class="col-lg-12"><p class="no-comments">' . $this->CI->lang->line('mb13') . '</p></div>\';
                            }
                        }
                    }
                    http.send();
                }
                function presults(num){
                    posts.page = num;
                    var url = home+\'user/bot/promotis?action=1&page=\' + num;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                data = JSON.parse(http.responseText);
                                show_pagination(data.total,\'#campaign_gallery\');
                                var tot = \' \';
                                for(var m = 0; m < data.posts.length; m++) {
                                    var post = data.posts[m].body;
                                    if(data.posts[m].title) {
                                        post = data.posts[m].title + \' \' + post;
                                    }
                                    var gettime = calculate_time(data.posts[m].sent_time, data.date);
                                    var neti_id = data.posts[m].neti_id;
                                    var net_id = data.posts[m].net_id;
                                    var avatar = \'http://graph.facebook.com/\' + neti_id + \'/picture?type=square\'
                                    if(!neti_id) {
                                        avatar = \'https://i.imgur.com/YPl0PNA.jpg\';
                                    }
                                    var user_name = data.posts[m].user_name;
                                    var favourite = \'\';
                                    if(data.posts[m].favourite > 0) {
                                        favourite = \' active\';
                                    }
                                    tot += \'<div class="panel panel-default" data-net="\' + net_id + \'"><div class="panel-heading"><img class="img-circle pull-left" src="\' + avatar + \'" alt="My Avatar"><h3><a href="https://www.facebook.com/\' + neti_id + \'" target="_blank">\' + user_name + \'</a></h3><h5><span>' . $this->CI->lang->line('mb21') . ' \' + gettime + \'</span></h5></div><div class="panel-body"><p>\' + post + \'</p></div><div class="panel-footer"><div class="col-md-3"><a href="#" class="promotis-coments"><i class="fa fa-comments-o"></i> ' . $this->CI->lang->line('mb22') . '</a></div><div class="col-md-3"><a href="#" class="promotis-histor"><i class="fa fa-history"></i> ' . $this->CI->lang->line('mb23') . '</a></div><div class="col-md-3"><a href="#" class="promotis-bookmark\' + favourite + \'"><i class="fa fa-bookmark-o"></i> ' . $this->CI->lang->line('mb24') . '</a></div><div class="col-md-3"><a href="\' + home+\'user/tools/monitoris?act=\' + data.posts[m].activity_id + \'" target="_blank"><i class="fa fa-area-chart"></i> ' . $this->CI->lang->line('mb25') . '</a></div></div></div>\';
                                }
                                document.querySelector(\'#campaign_gallery .promotis-content\').innerHTML = tot;
                                reload_it();
                            } else {
                                document.querySelector(\'#campaign_gallery .promotis-content\').innerHTML = \'<p class="no-comments">' . $this->CI->lang->line('mu23') . '</p>\';
                            }
                        }
                    }
                    http.send();
                }
                function show_history(num) {
                    posts.page = num;
                    var act = posts.cid;
                    var url = home+\'user/bot/promotis?action=10&act=\' + act + \'&page=\' + num;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        var data = http.responseText;
                        if (data) {
                            data = JSON.parse(http.responseText);
                            show_pagination(data.total,\'#history_lists\');
                            var tot = \' \';
                            for(var m = 0; m < data.posts.length; m++) {
                                var rule2 = data.posts[m].rule2;
                                var rule5 = data.posts[m].rule5;
                                var net_id = data.posts[m].net_id;
                                var avatar = \'http://graph.facebook.com/\' + net_id + \'/picture?type=square\'
                                if(!net_id) {
                                    avatar = \'https://i.imgur.com/YPl0PNA.jpg\';
                                }
                                var user_name = data.posts[m].user_name;
                                var body = \' \';
                                if(data.posts[m].text) {
                                    body = \'<p>\' + data.posts[m].text + \'</p>\';
                                }
                                var link = \' \';
                                if(data.posts[m].link) {
                                    link = \'<p><a href="\' + data.posts[m].rule3 + \'">\' + data.posts[m].link + \'</a></p>\';
                                }
                                var img = \' \';
                                var time = calculate_time(' . time() . ', data.posts[m].rule4);
                                if(data.posts[m].photo) {
                                    img = \'<p><img src="\' + data.posts[m].photo + \'" style="max-width: 100%;"></p>\';
                                }
                                var ser = \' \';
                                if(rule5) {
                                    ser = \'<span class="on-monitoris">' . $this->CI->lang->line('mb26') . '</span>\';
                                }
                                tot += \'<div class="panel-body" data-com="\' + data.posts[m].bot_id + \'"><div class="panel panel-default"><div class="panel-heading"><img class="img-circle pull-left" src="\' + avatar + \'" alt="My Avatar"><h3>\' + user_name + ser + \' </h3><h5><span>\' + time + \'</span></h5>\' + body + link + img + \'</div></div></div>\';
                            }
                            document.querySelector(\'#history_lists .promotis-content\').innerHTML = tot;
                            setTimeout(reload_it,500);
                        } else {
                            document.querySelector(\'#history_lists .promotis-content\').innerHTML = \'<div class="col-lg-12"><p class="no-comments">' . $this->CI->lang->line('mb27') . '</p></div>\';
                        }
                    }
                    http.send();
                }                
                function bresults(num){
                    posts.page = num;
                    var url = home+\'user/bot/promotis?action=8&page=\' + num;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                data = JSON.parse(http.responseText);
                                show_pagination(data.total,\'#bookmarked_comments\');
                                var tot = \' \';
                                for(var m = 0; m < data.posts.length; m++) {
                                    var post = data.posts[m].body;
                                    if(data.posts[m].title) {
                                        post = data.posts[m].title + \' \' + post;
                                    }
                                    var gettime = calculate_time(data.posts[m].sent_time, data.date);
                                    var neti_id = data.posts[m].neti_id;
                                    var net_id = data.posts[m].net_id;
                                    var avatar = \'http://graph.facebook.com/\' + neti_id + \'/picture?type=square\'
                                    if(!neti_id) {
                                        avatar = \'https://i.imgur.com/YPl0PNA.jpg\';
                                    }
                                    var user_name = data.posts[m].user_name;
                                    var favourite = \'\';
                                    if(data.posts[m].favourite === \'1\') {
                                        favourite = \' active\';
                                    }
                                    tot += \'<div class="panel panel-default" data-net="\' + net_id + \'"><div class="panel-heading"><img class="img-circle pull-left" src="\' + avatar + \'" alt="My Avatar"><h3><a href="https://www.facebook.com/\' + neti_id + \'" target="_blank">\' + user_name + \'</a></h3><h5><span>' . $this->CI->lang->line('mb21') . ' \' + gettime + \'</span></h5></div><div class="panel-body"><p>\' + post + \'</p></div><div class="panel-footer"><div class="col-md-3"><a href="#" class="promotis-coments"><i class="fa fa-comments-o"></i> ' . $this->CI->lang->line('mb22') . '</a></div><div class="col-md-3"><a href="#" class="promotis-histor"><i class="fa fa-history"></i> ' . $this->CI->lang->line('mb23') . '</a></div><div class="col-md-3"><a href="#" class="promotis-bookmark\' + favourite + \'"><i class="fa fa-bookmark-o"></i> ' . $this->CI->lang->line('mb24') . '</a></div><div class="col-md-3"><a href="\' + home+\'user/tools/monitoris?act=\' + data.posts[m].activity_id + \'" target="_blank"><i class="fa fa-area-chart"></i> ' . $this->CI->lang->line('mb25') . '</a></div></div></div>\';
                                }
                                document.querySelector(\'#bookmarked_comments .promotis-content\').innerHTML = tot;
                                reload_it();
                            } else {
                                document.querySelector(\'#bookmarked_comments .promotis-content\').innerHTML = \'<p class="no-comments">' . $this->CI->lang->line('mu23') . '</p>\';
                            }
                        }
                    }
                    http.send();
                }
                function aresults(num){
                    posts.page = num;
                    var url = home+\'user/bot/promotis?action=9&page=\' + num;
                    var http = new XMLHttpRequest();
                    http.open(\'GET\', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if (data) {
                                data = JSON.parse(http.responseText);
                                show_pagination(data.total,\'#active_posts\');
                                var tot = \' \';
                                for(var m = 0; m < data.posts.length; m++) {
                                    var post = data.posts[m].body;
                                    if(data.posts[m].title) {
                                        post = data.posts[m].title + \' \' + post;
                                    }
                                    var gettime = calculate_time(data.posts[m].sent_time, data.date);
                                    var neti_id = data.posts[m].neti_id;
                                    var net_id = data.posts[m].net_id;
                                    var avatar = \'http://graph.facebook.com/\' + neti_id + \'/picture?type=square\'
                                    if(!neti_id) {
                                        avatar = \'https://i.imgur.com/YPl0PNA.jpg\';
                                    }
                                    var user_name = data.posts[m].user_name;
                                    var favourite = \'\';
                                    if(data.posts[m].favourite > 0) {
                                        favourite = \' active\';
                                    }
                                    tot += \'<div class="panel panel-default" data-net="\' + net_id + \'"><div class="panel-heading"><img class="img-circle pull-left" src="\' + avatar + \'" alt="My Avatar"><h3><a href="https://www.facebook.com/\' + neti_id + \'" target="_blank">\' + user_name + \'</a></h3><h5><span>' . $this->CI->lang->line('mb21') . ' \' + gettime + \'</span></h5></div><div class="panel-body"><p>\' + post + \'</p></div><div class="panel-footer"><div class="col-md-3"><a href="#" class="promotis-coments"><i class="fa fa-comments-o"></i> ' . $this->CI->lang->line('mb22') . '</a></div><div class="col-md-3"><a href="#" class="promotis-histor"><i class="fa fa-history"></i> ' . $this->CI->lang->line('mb23') . '</a></div><div class="col-md-3"><a href="#" class="promotis-bookmark\' + favourite + \'"><i class="fa fa-bookmark-o"></i> ' . $this->CI->lang->line('mb24') . '</a></div><div class="col-md-3"><a href="\' + home+\'user/tools/monitoris?act=\' + data.posts[m].activity_id + \'" target="_blank"><i class="fa fa-area-chart"></i> ' . $this->CI->lang->line('mb25') . '</a></div></div></div>\';
                                }
                                document.querySelector(\'#active_posts .promotis-content\').innerHTML = tot;
                                reload_it();
                            } else {
                                document.querySelector(\'#active_posts .promotis-content\').innerHTML = \'<p class="no-comments">' . $this->CI->lang->line('mu23') . '</p>\';
                            }
                        }
                    }
                    http.send();
                }
                presults(1);
                bresults(1);
                aresults(1);
                setTimeout(reload_it,500);
            }
            '
        . '</script>'
        . '<style>'
                . '.fa-circle, .fa-circle-thin {
                    color: #71d775;
                    font-size: 13px;
                }'                
                . '.emails .nav-tabs>li.leposts>a {
                    border-bottom-color: transparent;
                    color: #F36644 !important;
                }'
                . '.tab-pane>div>.panel-default {
                    min-height: 150px;
                }'
                . '.panel-heading .fa-bookmark-o {
                    color: #009688;
                }'
                . '.panel-heading .fa-toggle-on {
                    color: #3CA8E0;
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
                . '#comment_lists .panel-body, .tab-pane#history_lists .panel-body {
                    padding-bottom: 0 !important;
                }'
                . '#comment_lists .panel-default>.panel-heading, #history_lists .panel-default>.panel-heading {
                    min-height: 55px;
                }'                
                . '.tab-pane>div>.panel-default>.panel-heading>img, #comment_lists .panel-default>.panel-heading>img, #history_lists .panel-default>.panel-heading>img {
                    margin-right: 15px;
                }'
                . '#comment_lists .panel-default>.panel-heading>img, #history_lists .panel-default>.panel-heading>img {
                    border-radius: 0;
                    height: 35px;
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
                    min-height: 25px;
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
                . '#comment_lists .panel-default, #comment_lists .panel-default>.panel-heading, #history_lists .panel-default, #history_lists .panel-default>.panel-heading {
                    background-color: #f6f7f9 !important;
                    display: flow-root;
                }'
                . '#comment_lists .panel-default>.panel-heading>h5, #history_lists .panel-default>.panel-heading>h5 {
                    color: #90949c;
                    margin-top: 5px;
                }'
                . '#comment_lists .panel-default>.panel-heading>p, #history_lists .panel-default>.panel-heading>p {
                    line-height: 22px;
                    margin-bottom: 10px;
                    display: block;
                }'
                . '#comment_lists .panel-default>.panel-heading>.btn-default {
                    border: 0;
                    margin-top: -20px;
                    padding: 0;
                    color: #90949c;
                }'
                . '#comment_lists .panel-default>.panel-heading>.btn-default:hover {
                    color: #0e1a35;
                }'                
                . '#comment_lists .panel-default>.panel-footer {
                    border-top: 1px solid #e1e2e3;
                    min-height: 30px;
                    margin-top: 0;
                }'
                . '.emails #comment_lists .panel, .emails #history_lists .panel {
                    min-height: 140px;
                }'
                . '.emails #comment_lists {
                    padding-bottom: 15px;
                }'  
                . '#comment_lists .panel-default>.panel-footer select {
                    width: 100%;
                    border: 0;
                    padding: 3px 10px;
                    color: #9E9E9E;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 3px;
                    margin-top: 7px;
                }' 
                . '.promotis-comments, .promotis-history, .promotis-add-new-comment {
                    display:none;
                }'
                . '.promotis-bookmark.active {
                    color: #009688 !important;
                    font-weight: 600;
                }'
                . '#new-comment-promotis {
                    padding-bottom: 15px;
                    display: grid;
                }'
                . '#new-comment-promotis .col-lg-12 {
                    margin: 15px 0 0;
                }'
                . '.link,.imag, .img {
                    display: none;
                }'           
                . '.link>div,.imag>div {
                    padding: 0px 5px !important;
                    background-color: #fafafa;
                    height: 30px;
                    line-height: 30px;
                    border-radius: 3px;
                    overflow: hidden;
                }'
                . '.link>div>.delete-link,.imag>div>.delete-img {
                    background: none;
                    border: none;
                    height: 20px;
                    color: #009688;
                }'                
                . '.list-group-item.read, .list-group-item.read:hover {
                    border: 1px solid #dddfe2;
                    margin: 20px 10px;
                }'
                . '.media-gallery {
                    clear: both;
                    padding-top: 5px;
                }'                
                . '.media-gallery>ul>li {
                    list-style: none;
                    height: 47px;
                    padding: 10px 0;
                    border-top: 1px solid #f2f2f2;
                }'
                . '.no-comments {
                    line-height:40px;	
                }'
                . '.on-monitoris {
                    display: block;
                    float: right;
                    color: #a94442;
                }
                @media(max-width:767px) {
                    .tab-pane>div>.panel-default>.panel-footer>.col-md-3 {
                        float: inherit;
                    }
                }
                '                
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
                $page = $this->CI->input->get('page', TRUE);
                if(!is_numeric($page)) {
                    exit();
                } else {
                    $page--;
                    $page = $page * 10;
                }
                $schedules = $this->CI->ecl('Instance')->mod('activity', 'activities', [$this->CI->ecl('Instance')->user(),$page]);
                if($schedules) {
                    $total = count($this->CI->ecl('Instance')->mod('activity', 'activities', [$this->CI->ecl('Instance')->user()]));
                    echo json_encode(['posts' => $schedules, 'total' => $total, 'date' => time()]);
                }
                break;
            case '3':
                $act = $this->CI->input->get('act', TRUE);
                $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                if(is_numeric($act_id)) {
                    if(!$this->CI->ecl('Instance')->mod('botis', 'check_bot', ['promotis-favourites', $this->CI->ecl('Instance')->user(),$act_id])) {
                        $new_bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['promotis-favourites', $this->CI->ecl('Instance')->user(),$act_id]);
                        if(is_numeric($new_bot)) {
                            echo json_encode(1);
                        }
                    } else {
                        $del_bot = $this->CI->ecl('Instance')->mod('botis', 'delete_bot', ['promotis-favourites', $this->CI->ecl('Instance')->user(),$act_id]);
                        if($del_bot) {
                            echo json_encode(2);
                        }
                    }
                }
                break;
            case '4':
                if ($this->CI->input->post()) {
                    $this->CI->form_validation->set_rules('comment', 'Comment', 'trim');
                    $this->CI->form_validation->set_rules('url', 'Url', 'trim');
                    $this->CI->form_validation->set_rules('img', 'Image', 'trim');
                    // Get data
                    $comment = $this->CI->input->post('comment');
                    $url = $this->CI->input->post('url');
                    $img = $this->CI->input->post('img');
                    if ($this->CI->form_validation->run()) {
                        if(($comment == "") && ($url == "") && ($img == "")) {
                            exit();
                        }
                        $act = $this->CI->input->get('act', TRUE);
                        $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                        if(is_numeric($act_id)) {
                            $new_bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['promotis-comment', $this->CI->ecl('Instance')->user(), $act_id, $comment, $url, $img]);
                            if(is_numeric($new_bot)) {
                                echo json_encode(1);
                            }
                        }
                    }
                }
                break;
            case '5':
                $act = $this->CI->input->get('act', TRUE);
                $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                $get_all_bots = $this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['promotis-comment', $this->CI->ecl('Instance')->user(),$act_id]);
                if($get_all_bots) {
                    echo json_encode($get_all_bots);
                }
                break;
            case '6':
                $com = $this->CI->input->get('com', TRUE);
                $act = $this->CI->input->get('act', TRUE);
                $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                if(is_numeric($act_id)) {
                    if(is_numeric($com)) {
                        $d_com = $this->CI->ecl('Instance')->mod('botis', 'delete_bot', ['promotis-comment', $this->CI->ecl('Instance')->user(), $act_id, $com]);
                        if($d_com) {
                            echo json_encode(1);
                        }
                    }
                }
                break;
            case '7':
                $com = $this->CI->input->get('com', TRUE);
                $act = $this->CI->input->get('act', TRUE);
                $type = $this->CI->input->get('type', TRUE);
                $value = $this->CI->input->get('value', TRUE);
                $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                if(is_numeric($act_id)) {
                    if(is_numeric($com)) {
                        if($this->CI->ecl('Instance')->mod('botis', 'check_bota', [$com, 'promotis-comment', $this->CI->ecl('Instance')->user(), $act_id])) {
                            if(($type == 'rule3') || ($type == 'rule4') || ($type == 'rule5') || ($type == 'rule6')) {
                                $bot_id = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['promotis-com-opts', $this->CI->ecl('Instance')->user(), $act_id, $com]);
                                if(!$bot_id) {
                                    $bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['promotis-com-opts', $this->CI->ecl('Instance')->user(), $act_id, $com, $type, $value]);
                                } else {
                                    $bot = $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot_id[0]->bot_id, $this->CI->ecl('Instance')->user(), $type, $value]);
                                }
                                if($bot) {
                                    echo json_encode(1);
                                }
                            }
                        }
                    }
                }
                break;
            case '8':
                $page = $this->CI->input->get('page', TRUE);
                if(!is_numeric($page)) {
                    exit();
                } else {
                    $page--;
                    $page = $page * 10;
                }
                $schedules = $this->CI->ecl('Instance')->mod('activity', 'bookmarks', [$this->CI->ecl('Instance')->user(), $page]);
                if($schedules) {
                    $total = count($this->CI->ecl('Instance')->mod('activity', 'bookmarks', [$this->CI->ecl('Instance')->user()]));
                    echo json_encode(['posts' => $schedules, 'total' => $total, 'date' => time()]);
                }
                break;
            case '9':
                $page = $this->CI->input->get('page', TRUE);
                if(!is_numeric($page)) {
                    exit();
                } else {
                    $page--;
                    $page = $page * 10;
                }
                $schedules = $this->CI->ecl('Instance')->mod('activity', 'active', [$this->CI->ecl('Instance')->user(), $page]);
                if($schedules) {
                    $total = count($this->CI->ecl('Instance')->mod('activity', 'active', [$this->CI->ecl('Instance')->user()]));
                    echo json_encode(['posts' => $schedules, 'total' => $total, 'date' => time()]);
                }
                break;
            case '10':
                $act = $this->CI->input->get('act', TRUE);
                $act_id = $this->CI->ecl('Instance')->mod('activity', 'get_act_id', [$act, $this->CI->ecl('Instance')->user()]);
                $page = $this->CI->input->get('page', TRUE);
                if(!is_numeric($page)) {
                    exit();
                } else {
                    $page--;
                    $page = $page * 10;
                }
                if(!is_numeric($act_id)) {
                    exit();
                }
                $get_all_bots = $this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['promotis-history', $this->CI->ecl('Instance')->user(),$act_id,$page]);
                if($get_all_bots) {
                    $total = count($this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['promotis-history', $this->CI->ecl('Instance')->user(),$act_id]));
                    echo json_encode(['posts' => $get_all_bots, 'total' => $total, 'date' => time()]);
                }
                break;
        }
    }

    /**
     * This function displays information about this class.
     */
    public function get_info() {
        return (object) ['slug' => 'promotis'];
    }
    
    /**
     * This function runs the bot schedules
     * 
     * @param integer $user_id contains the user_id
     */
    public function load_cron($user_id) {
        $get_all_bots = $this->CI->ecl('Instance')->mod('botis', 'get_all_bots', ['promotis-com-opts', $user_id]);
        if($get_all_bots) {
            foreach ($get_all_bots as $bot) {
                if($bot->rule3 > 0) {
                    $get_a = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['promotis-history', $user_id, $bot->rule1, $bot->rule2]);
                    if($bot->rule5 > 0) {
                        if($get_a) {
                            foreach ($get_a as $get) {
                                if($get->rule5 > 0) {
                                    continue;
                                }
                                $time = $get->rule4 + $bot->rule5*3600;
                                if($time < time()) {
                                    if (file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php')) {
                                        try {
                                            include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                                            if ((get_option('facebook_user_api_key') == '1') || (get_option('facebook_groups_user_api_key') == '1') || (get_option('facebook_pages_user_api_key') == '1')) {
                                                $app_id = $bot->api_key;
                                                $app_secret = $bot->api_secret;
                                            } else {
                                                $app_id = get_option('facebook_app_id');
                                                $app_secret = get_option('facebook_app_secret');                                                
                                            }
                                            $fb = new Facebook\Facebook(
                                                [
                                                    'app_id' => $app_id,
                                                    'app_secret' => $app_secret,
                                                    'default_graph_version' => 'v2.9',
                                                    'default_access_token' => '{access-token}',
                                                ]
                                            );
                                            $token = $bot->secret;
                                            if(get_option('allow_facebook_commenting')) {
                                                $token = $bot->token;
                                            }
                                            try {
                                                $fb->setDefaultAccessToken($token);
                                                $res = $fb->get('/' . $get->rule3 . '/comments');
                                                $trib = $res->getDecodedBody();
                                                if(@$trib['data']) {
                                                    if($bot->rule6 == 1) {
                                                        $botis = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['promotis-com-opts', $user_id, $bot->rule1, $bot->rule2]);
                                                        if($botis) {
                                                            $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$botis[0]->bot_id, $user_id, 'rule3', 0]);
                                                        }
                                                    } else {
                                                        $fb->delete('/' . $get->rule3);
                                                    }
                                                } else {
                                                    $fb->delete('/' . $get->rule3);
                                                }
                                                $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$get->bot_id, $user_id, 'rule5', 1]);
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        } catch (Facebook\Exceptions\FacebookResponseException $e) {
                                            // When Graph returns an error
                                            echo $e->getMessage();
                                        } catch (Facebook\Exceptions\FacebookSDKException $e) {
                                            // When validation fails or other local issues
                                            echo $e->getMessage();
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if($bot->rule4 == 1) {
                        if($get_a) {
                            continue;
                        }
                    }
                    $time = $bot->rule7 + ($bot->rule3*3600);
                    if($time > time()) {
                        return false;
                    }
                    $this->CI->ecl('Instance')->mod('botis', 'update_bot', [$bot->bot_id, $user_id, 'rule7', time()]);
                    if (file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php')) {
                        try {
                            include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                            if ((get_option('facebook_user_api_key') == '1') || (get_option('facebook_groups_user_api_key') == '1') || (get_option('facebook_pages_user_api_key') == '1')) {
                                $app_id = $bot->api_key;
                                $app_secret = $bot->api_secret;
                            } else {
                                $app_id = get_option('facebook_app_id');
                                $app_secret = get_option('facebook_app_secret');                                                
                            }
                            $fb = new Facebook\Facebook(
                                [
                                    'app_id' => $app_id,
                                    'app_secret' => $app_secret,
                                    'default_graph_version' => 'v2.9',
                                    'default_access_token' => '{access-token}',
                                ]
                            );
                            $comment = $this->CI->ecl('Instance')->mod('botis', 'check_bot', ['promotis-comment', $user_id, $bot->rule1, 1, $bot->rule2]);
                            $message = '';
                            if($comment) {
                                $token = $bot->secret;
                                if(get_option('allow_facebook_commenting')) {
                                    $token = $bot->token;
                                }
                                if($comment[0]->rule2) {
                                    $message = $comment[0]->rule2.' ';
                                }
                                if($comment[0]->rule3) {
                                    $message .= $comment[0]->rule3;
                                }                                
                                $linkData = ['message' => $message];
                                if($comment[0]->rule4) {
                                    $postu = $fb->post('/me/photos', ['url' => $comment[0]->rule4, 'published' => FALSE], $token);
                                    if (@$postu->getDecodedBody()) {
                                        $mo = $postu->getDecodedBody();
                                        if (@$mo['id']) {
                                            $linkData['attachment_id'] = $mo['id'];
                                        }
                                    }
                                }
                                $comment = $fb->post('/' . $bot->neti_id . '/comments', $linkData, $token);
                                if ($comment->getDecodedBody()) {
                                    $mo = $comment->getDecodedBody();
                                    if(@$mo['id']) {
                                        $new_bot = $this->CI->ecl('Instance')->mod('botis', 'save_bot', ['promotis-history', $user_id, $bot->rule1, $bot->rule2, $mo['id'],time()]);
                                    }
                                }   
                            }
                        } catch (Facebook\Exceptions\FacebookResponseException $e) {
                            // When Graph returns an error
                            echo $e->getMessage();
                        } catch (Facebook\Exceptions\FacebookSDKException $e) {
                            // When validation fails or other local issues
                            echo $e->getMessage();
                        }
                    }
                } 
            }
        }
    }    
}
