<?php
/**
 * Plans Model
 *
 * PHP Version 5.6
 *
 * Posts file contains the Plans Model
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
 * Plans class - operates the user table.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Plans extends CI_MODEL {
    private $table = 'plans';

    public function __construct() {
        parent::__construct();
        $this->tables = $this->config->item('tables', $this->table);
    }
    
    /**
     * The function save_plan creates a new plan
     *
     * @param string $plan_name contains the plan's name
     * @param string $plan_price contains the plan's price
     * @param string $currency_sign contains the plan currency sign
     * @param string $currency_code contains the plan currency code
     * @param integer $allowed_accounts contains the number of allowed accounts
     * @param integer $allowed_rss contains the number of allowed feeds
     * @param integer $accounts_number contains the number of accounts where a post can be published
     * @param integer $limit_posts_month contains the number of allowed posts per month
     * @param string $features_plan contains the plan's features
     * @param integer $period_plan contains the plan's period
     * @param integer $update contains a number. If 1 the plan will be updated
     * @param integer $update contains a number. If 1 the plan will be updated
     * @param integer $limit_videos contains number of videos
     * @param integer $limit_images contains number of images
     * @param string $allowed_networks contains the allowed social networks
     * @param integer $teams contains the teams option
     * @param integer $status contains the plan status
     * 
     * @return boolean true or false
     */
    public function save_plan($plan_name, $plan_price, $currency_sign, $currency_code, $allowed_accounts, $allowed_rss, $accounts_number, $limit_posts_month, $features_plan, $period_plan, $emails, $update, $limit_videos, $limit_images, $allowed_networks = NULL, $teams = 0, $status = 0) {
        if ($update > 0) {
            $data = ['plan_name' => $plan_name, 'plan_price' => $plan_price, 'currency_sign' => $currency_sign, 'currency_code' => $currency_code, 'network_accounts' => $allowed_accounts, 'rss_feeds' => $allowed_rss, 'publish_accounts' => $accounts_number, 'publish_posts' => $limit_posts_month, 'sent_emails' => $emails, 'features' => $features_plan, 'teams' => $teams, 'visible' => $status, 'period' => $period_plan, 'limit_videos' => $limit_videos, 'limit_images' => $limit_images];
            if ( $allowed_networks ) {
                $data['allowed_networks'] = json_encode($allowed_networks);
            }
            $this->db->set($data);
            $this->db->where('plan_id', $update);
            $this->db->update($this->table);
        } else {
            $data = ['plan_name' => $plan_name, 'plan_price' => $plan_price, 'currency_sign' => $currency_sign, 'currency_code' => $currency_code, 'network_accounts' => $allowed_accounts, 'rss_feeds' => $allowed_rss, 'publish_accounts' => $accounts_number, 'publish_posts' => $limit_posts_month, 'sent_emails' => $emails, 'features' => $features_plan, 'teams' => $teams, 'visible' => $status, 'period' => $period_plan, 'limit_videos' => $limit_videos, 'limit_images' => $limit_images];
            if ( $allowed_networks ) {
                $data['allowed_networks'] = json_encode($allowed_networks);
            }
            $this->db->insert($this->table, $data);
        }
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * The function get_all_plans gets all plans
     * 
     * @param integer $visible contains the status option
     * 
     * @return object with all plans or false
     */
    public function get_all_plans( $visible = NULL ) {
        
        $this->db->select('*');
        
        $this->db->from($this->table);
        
        if ( !$visible ) {
            
            $this->db->where( 'visible IS NULL' );
            $this->db->or_where( 'visible', '0' );
            
        }
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return $query->result();
            
        } else {
            
            return false;
            
        }
    }
    
    /**
     * The function get_plan gets a plan by $plan_id
     *
     * @param $plan_id contains the plan's id
     * 
     * @return object with plan's data or false
     */
    public function get_plan($plan_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('plan_id', $plan_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    /**
     * The function get_user_plan get user plan by user's id
     *
     * @param $user_id contains the user's id
     * 
     * @return object with plan's data or false
     */
    public function get_user_plan($user_id) {
        $this->db->select('*');
        $this->db->from('users_meta');
        $this->db->where('user_id', $user_id);
        $this->db->like('meta_name', 'plan');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    /**
     * The function change_plan changes the user's plan
     *
     * @param $plan contains the plan's id
     * @param $user_id contains user's id
     * 
     * @return boolean true of the plan was changed or false
     */
    public function change_plan($plan, $user_id) {
        $period = $this->get_plan_period($plan);
        // Will be changed the plan
        $this->db->select('*');
        $this->db->from('users_meta');
        $this->db->where(['user_id' => $user_id, 'meta_name' => 'plan']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $plans = $query->result();
            if ($plans[0]->meta_value != $plan) {
                $data = ['meta_value' => $plan];
                $this->db->where(['user_id' => $user_id, 'meta_name' => 'plan']);
                $this->db->update('users_meta', $data);
                $this->db->select('*');
                $this->db->from('users_meta');
                $this->db->where(['user_id' => $user_id, 'meta_name' => 'plan_end']);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $date = strtotime('+' . $period . ' day', time());
                    $plan_end = date('Y-m-d H:i:s', $date);
                    $data = ['user_id' => $user_id, 'meta_name' => 'plan_end', 'meta_value' => $plan_end];
                    $this->db->where(['user_id' => $user_id, 'meta_name' => 'plan_end']);
                    $this->db->update('users_meta', $data);
                } else {
                    $date = strtotime('+' . $period . ' day', time());
                    $plan_end = date('Y-m-d H:i:s', $date);
                    $data = ['user_id' => $user_id, 'meta_name' => 'plan_end', 'meta_value' => $plan_end];
                    $this->db->insert('users_meta', $data);
                }
                return true;
            } else {
                $date = strtotime('+' . $period . ' day', time());
                $plan_end = date('Y-m-d H:i:s', $date);
                // Check if the user plan is not ended yet
                $renew = $this->check_if_plan_ended($user_id);
                if ($renew) {
                    if ($renew < time() + 432000) {
                        $renew = $date + ($renew - time());
                        $plan_end = date('Y-m-d H:i:s', $renew);
                    }
                }
                $data = ['user_id' => $user_id, 'meta_name' => 'plan_end', 'meta_value' => $plan_end];
                $this->db->where(['user_id' => $user_id, 'meta_name' => 'plan_end']);
                $this->db->update('users_meta', $data);
            }
        } else {
            $data = ['user_id' => $user_id, 'meta_name' => 'plan', 'meta_value' => $plan];
            $this->db->insert('users_meta', $data);
            $date = strtotime('+' . $period . ' day', time());
            $plan_end = date('Y-m-d H:i:s', $date);
            $data = ['user_id' => $user_id, 'meta_name' => 'plan_end', 'meta_value' => $plan_end];
            $this->db->insert('users_meta', $data);
            return true;
        }
        return false;
    }
    
    /**
     * The function get_plan_period return plan's period by plan_id
     *
     * @param $plan_id contains the plan's id
     * 
     * @return object with plan's period
     */
    public function get_plan_period($plan_id) {
        $this->db->select('*');
        $this->db->from('plans');
        $this->db->where('plan_id', $plan_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result[0]->period;
        }
    }
    
    /**
     * The function get_plan_price return plan's price by plan_id
     *
     * @param $plan_id contains the plan's id
     * 
     * @return object with plan's price
     */
    public function get_plan_price($plan_id = NULL) {
        $this->db->select('*');
        $this->db->from('plans');
        if ( $plan_id ) {
            $this->db->where('plan_id', $plan_id);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }
    }
    
    /**
     * The function check_payment checks if the transaction not exists in the database and saves it
     *
     * @param $value contains the payed price
     * @param $code contains the currency code
     * @param $plan_id contains the plan's id
     * @param $tx contains the transaction's id
     * @param $user_id contains user's id
     * @param string $source contains the gateway
     * 
     * @return boolean true if the payment was done successfully and plan was changed
     */
    public function check_payment($value, $code, $plan_id, $tx, $user_id, $source) {
        $this->db->select('*');
        $this->db->from('plans');
        $this->db->where(['plan_id' => $plan_id, 'plan_price' => $value, 'currency_code' => $code]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->select('*');
            $this->db->from('payments');
            $this->db->where('txn_id', $tx);
            $query = $this->db->get();
            if ($query->num_rows() < 1) {
                $data = ['user_id' => $user_id, 'txn_id' => $tx, 'payment_amount' => $value, 'payment_status' => 'complete', 'plan_id' => $plan_id, 'created' => date('Y-m-d H:i:s'), 'source' => $source];
                $this->db->insert('payments', $data);
                if ($this->change_plan($plan_id, $user_id)) {
                    return true;
                }
            }
        }
    }
    
    /**
     * The function check_transaction checks if the transaction already exists in the database
     *
     * @param string $tx contains the transaction's id
     * 
     * @return boolean true if the transaction exists
     */
    public function check_transaction($tx) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('txn_id', $tx);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }    
    
    /**
     * The function book_payment books a payment
     *
     * @param $user_id contains user's id
     * 
     * @param string $source contains the gateway
     */
    public function book_payment($user_id, $source, $plan_id) {
        $data = ['user_id' => $user_id, 'plan_id' => $plan_id, 'created' => date('Y-m-d H:i:s'), 'source' => $source];
        $this->db->insert('payments', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * The function trans add transaction id
     *
     * @param $user_id contains user's id
     * 
     * @return boolean true or false
     */
    public function trans($user_id, $txn_id, $price) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where(['user_id' => $user_id, 'source' => 'voguepay']);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $plan_id = $result[0]->plan_id;
            $id = $result[0]->id;
            $plan = $this->get_plan_price($plan_id);
            if($plan[0]->plan_price != $price) {
                return false;
            }
            if ($this->change_plan($plan_id, $user_id)) {
                $data = ['txn_id' => $txn_id, 'payment_amount' => $price, 'payment_status' => 'complete'];
                $this->db->where(['id' => $id]);
                $this->db->update('payments', $data);
                if ($this->db->affected_rows()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    
    /**
     * The function payment_done verifies is the payment was done
     *
     * @param integer $user_id contains user's id
     * @param string $source contains the gateway
     * 
     * @return boolean true or false
     */
    public function payment_done($user_id, $source) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where(['user_id' => $user_id, 'source' => 'voguepay']);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $payment_status = $result[0]->payment_status;
            if($payment_status == 'complete') {
                return true;
            } else {
                return false;
            }
        }
    }
    
    /**
     * The function get_all_payments calculates the earnings
     *
     * @param integer $time contains the time
     * 
     * @return boolean true or false
     */
    public function get_all_payments($time = NULL) {
        $this->db->select('SUM(payment_amount) as tot', false);
        $this->db->from('payments');
        if ( $time ) {
            $time = time() - $time;
            $this->db->where(['UNIX_TIMESTAMP(created)>' => $time]);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            if ( $result[0]->tot ) {
                return $result[0]->tot;
            } else {
                return '0.00';
            }
        } else {
            return '0.00';
        }
    }
    
    /**
     * The function get_plan_features gets features of a plan
     *
     * @param $user_id contains user's id
     * @param $key contains the plan's field
     * 
     * @return string with requested field or false
     */
    public function get_plan_features($user_id, $key) {
		
        $plan_id = 1;
        if ($this->get_user_plan($user_id)) {
            $user_plan = $this->get_user_plan($user_id);
            foreach ($user_plan as $up) {
                $plan_end = time();
                if (@$up->meta_name == 'plan') {
                    $cplan = $up->meta_value;
                }
                if (@$up->meta_name == 'plan_end') {
                    $plan_end = strtotime($up->meta_value);
                }
                if ($plan_end > time()) {
                    $plan_id = @$cplan;
                }
            }
        }
        $this->db->select('*');
        $this->db->from('plans');
        $this->db->where(['plan_id' => $plan_id]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
			
            return $result[0]->$key;
        } else {
            return false;
        }
    }
    
    /**
     * The function check_if_plan_ended checks if user's plan has been ended
     *
     * @param $user_id contains user's id
     * 
     * @return string with date when plan ented or false
     */
    public function check_if_plan_ended($user_id) {
        $plan_id = 1;
        if ($this->get_user_plan($user_id)) {
            $user_plan = $this->get_user_plan($user_id);
            foreach ($user_plan as $up) {
                $plan_end = time();
                if (@$up->meta_name == 'plan') {
                    $cplan = $up->meta_value;
                }
                if (@$up->meta_name == 'plan_end') {
                    $plan_end = strtotime($up->meta_value);
                    return $plan_end;
                }
                if ($plan_end > time()) {
                    $plan_id = $cplan;
                }
            }
        }
        return false;
    }
    
    /**
     * The function delete_user_plan deletes user's plan
     *
     * @param $user_id contains user's id
     * 
     * @return boolean true if user was deleted or false
     */
    public function delete_user_plan($user_id) {
        $data = ['user_id' => $user_id, 'meta_name' => 'plan'];
        $this->db->delete('users_meta', $data);
        $data = ['user_id' => $user_id, 'meta_name' => 'plan_end'];
        $this->db->delete('users_meta', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * The function plan_started gets the time when the user's plan starts
     *
     * @param $user_id contains user's id
     * 
     * @return array with data when plan started
     */
    public function plan_started($user_id) {
        $plan = $this->get_user_plan($user_id);
        if($plan){
            $period = $this->get_plan_features($user_id,'period');
            if(@$plan[1]->meta_value) {
                $end = strtotime($plan[1]->meta_value);
                $tot = $end - ($period*86400);
                return ['plan' => $plan, 'time' => $tot];
            } else {               
                $this->change_plan(1, $user_id);
                return ['plan' => 1, 'time' => time()];                
            }
        } else {
            $this->change_plan(1, $user_id);
            return ['plan' => 1, 'time' => time()];
        }
    }
    
    /**
     * The function delete_plan deletes plans
     *
     * @param $plan_id contains the plan's id
     * 
     * @return boolean true if plan was deleted or false
     */
    public function delete_plan($plan_id) {
        $this->db->delete($this->table, array('plan_id' => $plan_id));
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Plans.php */
