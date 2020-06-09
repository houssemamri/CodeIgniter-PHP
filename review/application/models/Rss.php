<?php
/**
 * RSS Model
 *
 * PHP Version 5.6
 *
 * RSS file contains the RSS Model
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined('BASEPATH') ) {
    
    exit('No direct script access allowed');
    
}

/**
 * RSS class - operates the rss table.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class RSS extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'rss';

    /**
     * Initialise the model
     */
    public function __construct() {
        
        // Call the Model constructor
        parent::__construct();
        
        // Set the tables value
        $this->tables = $this->config->item('tables', $this->table);
        
    }

    /**
     * The public method save_new_rss saves new rss
     *
     * @param integer $user_id contains the current user_id
     * @param string $url contains the Feed's url
     * @param string $title contains the Feed's title
     * 
     * @return integer with last inserted id or false
     */
    public function save_new_rss( $user_id, $url, $title ) {
        
        $this->db->select('rss_id');
        $this->db->from($this->table);
        $this->db->where(['user_id' => $user_id, 'rss_url' => $url]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return '1';
            
        }
        
        $data = ['user_id' => $user_id, 'rss_name' => $title, 'rss_url' => $url, 'added' => date('Y-m-d H:i:s')];
        $this->db->insert($this->table, $data);
        
        if ( $this->db->affected_rows() ) {
            
            $insert_id = $this->db->insert_id();
            return $insert_id;
            
        } else {
            
            return '3';
            
        }
        
    }

    /**
     * The public method get_rss gets data by rss_id
     *
     * @param integer $rss_id contains the rss_id
     * @param integer $user_id contains the user's ID
     * 
     * @return object with rss data or false
     */
    public function get_rss( $rss_id, $user_id=NULL ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(['rss_id' => $rss_id]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_rss_post gets rss's post
     *
     * @param integer $post_id contains the post_id
     * @param integer $user_id contains the user's ID
     * 
     * @return object with post's data or false
     */
    public function get_rss_post( $post_id, $user_id=NULL ) {
        
        $this->db->select('*');
        $this->db->from('rss_posts');
        $this->db->where(['post_id' => $post_id]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_all_rss gets all user's rss Feeds by user_id
     *
     * @param integer $user_id contains the user_id
     * 
     * @return object with rss or false
     */
    public function get_all_rss( $user_id ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(['user_id' => $user_id]);
        $this->db->order_by('rss_id', 'desc');
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method enable_or_disable_rss_option enables and disables a rss options. First call, enables social network, second call disable.
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $option contains the option's name
     * 
     * @return boolean true if the option was enabled/disabled or false
     */
    public function enable_or_disable_rss_option( $user_id, $rss_id, $option, $value = NULL ) {
        
        if ( $value ) {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
            $this->db->update($this->table, [$option => $value]);
            
            if ( $this->db->affected_rows() ) {
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        } else {
            
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, $option => '1']);
            $query = $this->db->get();
            
            if ( $query->num_rows() == 1 ) {
                
                // If the option is enabled, will be disabled
                $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
                $this->db->update($this->table, [$option => '0']);
                
            } else {
                
                // If the network not exists, will be added with value 1
                $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
                $this->db->update($this->table, [$option => '1']);
                
            }
            
            // Check if option was saved or deleted successfully
            if ( $this->db->affected_rows() ) {
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        }
        
    }

    /**
     * The public method save_networks saves networks choosen for a rss feed
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $networks contains the networks's name
     * 
     * @return boolean if networks was saved or false
     */
    public function save_networks( $user_id, $rss_id, $networks ) {
        
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
        
        $this->db->update($this->table, ['networks' => $networks]);
        
        // Check if the rss table was updated
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_random_rss gets one random rss feed
     * 
     * @return object with rss or false
     */
    public function get_random_rss() {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(['enabled' => '1', 'completed' => '0', 'pub' => '0']);
        $this->db->order_by('rss_id', 'RANDOM');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_random_rss_m gets one random rss post
     * 
     * @param integer $limit contains the random's limit
     * 
     * @return object with rss or false
     */
    public function get_random_rss_m( $limit ) {
        
        $this->db->select('*,rss.networks AS net');
        $this->db->from($this->table);
        $this->db->join('rss_posts', 'rss.rss_id=rss_posts.rss_id', 'left');
        $this->db->where("rss.enabled='1' AND rss.completed='0' AND rss.pub='1' AND rss_posts.scheduled<'" . time() . "' AND rss_posts.scheduled>'0'");
        $this->db->order_by('post_id', 'RANDOM');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result_array();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method set a post as published
     * 
     * @param integer $post_id contains the post ID
     * 
     * @return boolean true or false
     */
    public function published( $post_id ) {
        
        $this->db->where(['post_id' => $post_id]);
        $this->db->update('rss_posts', ['published' => time(), 'scheduled' => '']);
        
        // Check if the rss table was updated
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method set_completed set completed for a feed
     *
     * @param integer $rss_id contains the rss_id
     * @param integer $num contains the completed value/1
     * 
     * @return boolean true if rss was completed or false
     */
    public function set_completed( $rss_id, $num ) {
        
        $this->db->where(['rss_id' => $rss_id]);
        $this->db->update($this->table, ['completed' => $num]);
        
        // Check if the rss table was updated
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method update_rss_meta updates a rss's meta
     *
     * @param integer $rss_id contains the rss_id
     * @param string $name contains the column name
     * @param string $val contains the column value
     * 
     * @return bolean true or false
     */
    public function update_rss_meta( $rss_id, $name, $val ) {
        
        $this->db->where(['rss_id' => $rss_id]);
        $this->db->update($this->table, [$name => $val]);
        
        // Check if the rss table was updated
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method update_rss_posts_meta updates a rss_posts's meta
     *
     * @param integer $post_id contains the post_id
     * @param string $name contains the column name
     * @param string $val contains the column value
     * 
     * @return bolean true or false
     */
    public function update_rss_posts_meta( $post_id, $name, $val ) {
        
        $this->db->where(['post_id' => $post_id]);
        $this->db->update('rss_posts', [$name => $val]);
        
        // Check if the rss table was updated
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method save_published saves published posts
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $networks contains the networks's name
     * @param string $title contains the feed's title
     * @param string $content contents the feed's content
     * @param string $url contains the post url
     * 
     * @return integer 1 if the post was saved or false
     */
    public function save_published( $user_id, $rss_id, $networks, $title, $content = NULL, $url ) {
        
        $this->db->select('rss_id');
        $this->db->from('rss_posts');
        
        $title = $this->db->escape_like_str($title);
        
        $content = $this->db->escape_like_str($content);
        
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'url' => trim($url)]);
        
        $query = $this->db->get();
        
        if ( $query->num_rows() == 0 ) {
            
            $this->db->insert('rss_posts', ['rss_id' => $rss_id, 'user_id' => $user_id, 'networks' => $networks, 'title' => $title, 'content' => $content, 'url' => $url, 'published' => time()]);
            
            // Check if the post was saved
            if ( $this->db->affected_rows() ) {
                
                return '1';
                
            } else {
                
                return false;
                
            }
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method update_published updates published posts
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $networks contains the networks's name
     * @param string $url contains the post url
     * 
     * @return integer 1 if post was updated or false
     */
    public function update_published( $user_id, $rss_id, $networks, $url ) {
        
        $this->db->select('rss_id');
        $this->db->from('rss_posts');
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'url' => trim($url)]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'url' => trim($url)]);
            $this->db->update('rss_posts', ['rss_id' => $rss_id, 'user_id' => $user_id, 'networks' => $networks, 'published' => time(), 'scheduled' => ' ']);
            
            // Check if the post was updated
            if ( $this->db->affected_rows() ) {
                
                return '1';
                
            } else {
                
                return false;
                
            }
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method schedule_rss allows to schedule the posts from RSS Feeds
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $rss_url contains the url of the post
     * @param string $time contains the time when the post will be published
     * @param string $img contains image if exists
     * 
     * @return integer 1 or bolean false
     */
    public function schedule_rss( $user_id, $rss_id, $rss_url, $time, $title, $content = NULL, $img = NULL ) {
        
        // Set title
        $title = $this->db->escape_like_str($title);
        
        // Set content
        $content = $this->db->escape_like_str($content);
        
        $this->db->select('*');
        $this->db->from('rss_posts');
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'url' => trim($rss_url)]);
        $query = $this->db->get();
        
        if ( $query->num_rows() == 0 ) {
            
            $this->db->insert('rss_posts', ['rss_id' => $rss_id, 'user_id' => $user_id, 'title' => $title, 'content' => $content, 'url' => $rss_url, 'img' => $img, 'scheduled' => $time]);
            
            // Check if the post was saved
            if ( $this->db->affected_rows() ) {
                
                return '1';
                
            } else {
                
                return false;
                
            }
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method if_post_scheduled checks if post is scheduled
     *
     * @param integer $rss_id contains the rss_id
     * @param string $rss_url contains the post url
     * 
     * @return boolean true if post is scheduled or false
     */
    public function if_post_scheduled( $rss_id, $rss_url ) {
        
        $this->db->select('*');
        $this->db->from('rss_posts');
        $this->db->where(['rss_id' => $rss_id, 'url' => trim($rss_url)]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method was_published checks if post was published before
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param string $url contains the post url
     * 
     * @return boolean true or false
     */
    public function was_published( $user_id, $rss_id, $url ) {
        
        $this->db->select('rss_id');
        $this->db->from('rss_posts');
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'url' => trim($url)]);
        $query = $this->db->get();
        
        if ( $query->num_rows() == 0 ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method reset_rss resets all completed RSS
     * 
     * @return boolean true or false
     */
    public function reset_rss() {
        
        $this->db->where(['enabled' => 1, 'completed' => 1]);
        
        $this->db->update($this->table, ['completed' => 0]);
        
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_posts gets published posts from database
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * @param integer $start contains a number where start to displays posts
     * @param integer $limit contains a number which means the limit of displayed posts
     * 
     * @return object with posts or false
     */
    public function get_posts( $user_id, $rss_id, $start, $limit, $pub ) {
        
        $this->db->select('post_id,networks,title,url,published, scheduled', false);
        $this->db->from('rss_posts');
        
        if ( $pub ) {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
            
        } else {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'published >' => 0]);
            
        }
        
        $this->db->order_by('post_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method delete_post_rss deletes the scheduled post
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_url contains the post url
     * 
     * @return boolean true or false
     */
    public function delete_post_rss( $user_id, $rss_url ) {
        
        $this->db->where(['user_id' => $user_id, 'url' => $rss_url]);
        $this->db->delete('rss_posts');
        
        // Check if the RSS Feed's post was deleted
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method count_feeds shows how many feeds has an user
     *
     * @param integer $user_id contains the current user_id
     * 
     * @return integer with number of user's rss
     */
    public function count_feeds( $user_id ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(['user_id' => $user_id]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return $query->num_rows();
            
        } else {
            
            return '0';
            
        }
        
    }

    /**
     * The public method get_rss_feeds gets all user's rss feeds
     *
     * @param integer $user_id contains the current user_id
     * @param integer $start contains a number where start to displays posts
     * @param integer $limit contains a number which means the limit of displayed posts
     * 
     * @return object with all user's feeds or false
     */
    public function get_rss_feeds( $user_id, $start, $limit ) {
        
        $this->db->select('rss.rss_id,rss.rss_name,rss.refferal,rss.rss_url,COUNT(rss_posts.post_id) as num', false);
        $this->db->from($this->table);
        $this->db->join('rss_posts', 'rss.rss_id=rss_posts.rss_id', 'left');
        $this->db->where(['rss.user_id' => $user_id]);
        $this->db->group_by('rss.rss_id');
        $this->db->order_by('rss.rss_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method count_all_feed_posts counts all published posts by $rss_id
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * 
     * @return object with all rss's posts or false
     */
    public function count_all_feed_posts( $user_id, $rss_id, $pub ) {
        
        $this->db->select('*');
        $this->db->from('rss_posts');
        
        if ( $pub ) {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
            
        } else {
            
            $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id, 'published >' => 0]);
            
        }
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return $query->num_rows();
            
        } else {
            
            return '0';
            
        }
        
    }

    /**
     * The public method delete_rss deletes the RSS Feed which have rss_id=$rss_id
     *
     * @param integer $user_id contains the current user_id
     * @param integer $rss_id contains the rss_id
     * 
     * @return boolean true or false
     */
    public function delete_rss( $user_id, $rss_id ) {
        
        $this->db->where(['rss_id' => $rss_id, 'user_id' => $user_id]);
        $this->db->delete($this->table);
        
        // Check if the RSS Feed was deleted
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method delete_all_rss deletes all user's RSS Feeds
     *
     * @param integer $user_id contains the current user_id
     * 
     * @return void
     */
    public function delete_all_rss( $user_id ) {
        
        $feeds_rss = $this->get_all_rss($user_id);
        
        if ( $feeds_rss ) {
            
            foreach ( $feeds_rss as $rss ) {
                
                $this->db->where(['rss_id' => $rss->rss_id]);
                $this->db->delete($this->table);
                
                if ( $this->delete_rss_posts($rss->rss_id) ) {
                    
                    $this->db->where(['rss_id' => $rss->rss_id]);
                    $this->db->delete('rss_posts');
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method delete_rss_posts deletes all user's posts
     *
     * @param integer $rss_id contains the rss_id
     * 
     * @return boolean true if all user's rss posts were delete or false
     */
    protected function delete_rss_posts( $rss_id ) {
        
        $this->db->select('*');
        $this->db->from('rss_posts');
        $this->db->where(['rss_id' => $rss_id]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

/* End of file RSS.php */
