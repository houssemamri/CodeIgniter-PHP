<?php
/**
 * Teams Controller
 *
 * PHP Version 5.6
 *
 * Teams contains the Teams Controller
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
 * Teams class - contains all methods for Teams
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Front extends MY_Controller {
    
    
    
   
	 public function index(){
		 
		 $this->load->view('front/index');
	 }
    
}

/* End of file Teams.php */
