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
include_once 'parse_ebay.php';
include_once 'rss_show.php';
/**
 * Ebay_feed_creator - allows to generate a Feed RSS from url
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Ebay_feed_creator implements Tools {

    use Parse_ebay, RSS_show;

    /**
     * The function check_info get tool's information.
     */
    public function check_info() {
        return (object) ['name' => 'Ebay RSS Creator', 'full_name' => 'Ebay RSS Creator', 'logo' => '<button class="btn-tool-icon btn btn-default btn-xs  pull-left" type="button"><i class="fa fa-wrench"></i></button>', 'slug' => 'ebay-feed-creator'];
    }

    /**
     * The function page displays the main page of the tool.
     */
    public function page($args) {
        if(isset($args['rss-url'])) {
            $content = $this->generate(base64_decode($args['rss-url']));
            if($content) {
                return $content;
            }
            else {
                return false;
            }
            exit();
        }
        $content = '<p>'.get_instance()->lang->line('mu60').'</p>'.get_instance()->lang->line('mu118');
        $url = '';
        $title = '';
        $show = '';
        $CI = & get_instance();
        // Check if data was submitted
        if ($CI->input->post()) {
            // Add form validation
            $CI->form_validation->set_rules('feed-url', 'Feed URL', 'trim|required');
            $CI->form_validation->set_rules('title', 'Title', 'trim');
            $CI->form_validation->set_rules('curl', 'Url', 'trim');
            // Get data
            $feed_url = $CI->input->post('feed-url');
            $title = $CI->input->post('title');
            $curl = $CI->input->post('curl');
            if ($CI->form_validation->run() == false) {
                return false;
            } else {
                $url = $feed_url;
            }
            if ($url) {
                $get_content = $this->parse($url);
                if (@$get_content['feed']) {
                    $content = $get_content['feed'];
                }
                if (@$get_content['title']) {
                    $show = ' style="display: inline-block;"';
                    $title = $get_content['title'];
                } else {
                	$parse = parse_url($url);
                	$title = $parse['host'];
                }
            }
            if ((@$curl == @$url) && (@$title != '')) {
                $check = '';
                // Get user by ID
                $user_id = $CI->ecl('Instance')->user();
                // Load RSS Model
                $CI->load->model('rss');
                // Load Plans Model
                $CI->load->model('plans');
                // Get all RSS Feeds
                $all_rss = $CI->rss->get_all_rss($user_id);
                // Get RSS Feeds per plan
                $rss_limit = $CI->plans->get_plan_features($user_id, 'rss_feeds');
                if(($all_rss?count($all_rss):0) < $rss_limit){
                    $response = $CI->rss->save_new_rss($args['user_id'], site_url('user/tools/ebay-feed-creator').'?rss-url='.base64_encode($url).'&tool='.$this->check_info()->slug, $title);
                } else {
                    $response = 0;
                }
                if ($response == 1) {
                    $check = 'popup_fon(\'sube\', \''.get_instance()->lang->line('mu113').'\', 1500, 2000);';
                } elseif ($response > 3) {
                    $check = 'popup_fon(\'subi\', \''.get_instance()->lang->line('mu114').'\', 1500, 2000);';
                } elseif ($response == 3) {
                    $check = 'popup_fon(\'sube\', \''.get_instance()->lang->line('mu115').'\', 1500, 2000);';
                } elseif ($response == 0) {
                    $check = 'popup_fon(\'sube\', \''.get_instance()->lang->line('mu211').'\', 1500, 2000);';
                }
                return (object) ['content' => '
                    <script language="javascript">window.onload = function() {' . $check . '}</script>
                    <div class="row">
                        <div class="col-lg-12">
                                <ul>
                                    <li>
                                        <div class="col-md-12 clean">
                                        ' . form_open('user/tools/ebay-feed-creator') . '
                                            <div class="input-group search">
                                                <input type="text" name="feed-url" placeholder="'.get_instance()->lang->line('mu117').'" value="' . $url . '" class="form-control rss-url" required="true">
                                                <input type="hidden" name="title" value="' . $title . '">
                                                <input type="hidden" name="curl" value="' . $url . '">
                                                <span class="input-group-btn search-m">
                                                    <button class="btn save-rss" type="submit" type=""' . $show . '><i class="fa fa-floppy-o"></i></button>
                                                    <button class="btn parse" type="submit"><i class="fa fa-rss"></i></button>
                                                </span>
                                            </div>
                                            ' . form_close() . '
                                        </div>
                                    </li>
                                </ul>
                                <ul class="feed-rss">
                                    ' . $content . '
                                </ul>
                        </div>
                    </div>                        
                '];
            }
        }
        return (object) ['content' => '
                <div class="row">
                    <div class="col-lg-12">
                        <ul>
                            <li>
                                <div class="col-md-12 clean">
                                ' . form_open('user/tools/ebay-feed-creator') . '
                                    <div class="input-group search">
                                        <input type="text" name="feed-url" placeholder="'.get_instance()->lang->line('mu117').'" value="' . $url . '" class="form-control rss-url" required="true">
                                        <input type="hidden" name="title" value="' . $title . '">
                                        <input type="hidden" name="curl" value="' . $url . '">
                                        <span class="input-group-btn search-m">
                                            <button class="btn save-rss" type="submit" type=""' . $show . '><i class="fa fa-floppy-o"></i></button>
                                            <button class="btn parse" type="submit"><i class="fa fa-rss"></i></button>
                                        </span>
                                    </div>
                                    ' . form_close() . '
                                </div>
                            </li>
                        </ul>
                        <ul class="feed-rss">
                            ' . $content . '
                        </ul>
                    </div>
                </div>                    
            '];
    }

}
