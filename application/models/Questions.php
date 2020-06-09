<?php
/**
 * Questions Model
 *
 * PHP Version 5.6
 *
 * Questions file contains the Questions Model
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
 * Questions class - operates the questions table.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Questions extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'questions';

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
     * The public method save_question saves a new question in the database
     *
     * @param string $question contains the question
     * @param string $response contains the response
     * @return boolean true or false
     */
    public function save_question( $question, $response ) {
        
        // Set data
        $data = ['question' => $question, 'response' => $response, 'created' => time()];
        
        // Save data
        $this->db->insert($this->table, $data);
        
        // Verify if data was saved
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    /**
     * The public method get_questions search questions in the database
     *
     * @param string $key contains the search key
     * @return object with questions or false
     */
    public function get_questions( $key ) {
        
        // Get questions if exists
        $this->db->select('*');
        $this->db->from($this->table);
        $key = $this->db->escape_like_str($key);
        $this->db->like('question', $key);
        $this->db->or_like('response', $key);
        $this->db->limit(10);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    /**
     * The public method delete_question deletes a question by id
     *
     * @param integer $question_id contains the question_id
     * @return boolean true or false
     */
    public function delete_question( $question_id ) {
        
        $this->db->delete($this->table, ['question_id' => $question_id]);
        
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

/* End of file Questions.php */