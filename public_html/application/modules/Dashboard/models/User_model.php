<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table, $where, $select,$queryshow = false) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
        if($queryshow == true)
            echo $this->db->last_query();
        return $res;
    }

    public function get_records($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_records_ordered($table, $where, $select,$level) {
        $this->db->select($select);
        $this->db->order_by($level , 'ASC');
        $this->db->order_by('created_at','ASc');
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
        return $res;
    }

    public function count_cookies($user_id) {
        $this->db->select('ifnull(count(id),0) as cookie_count,sponser_refferal_count');
        $this->db->where(array('sponser_id' => $user_id));
        $this->db->from('tbl_users');
        $this->db->group_by('sponser_refferal_count');
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }
    // public function calculate_team($user_id,$status){
    //     $this->db->select('ifnull(count(tbl_downline_count.downline_id),0) as team, tbl_users.paid_status');
    //     $this->db->from('tbl_users');
    //     $this->db->join('tbl_downline_count', 'tbl_users.user_id = tbl_downline_count.downline_id');
    //     $this->db->where(array('tbl_downline_count.user_id' => $user_id ,'tbl_users.paid_status' => $status ,'tbl_downline_count.level !=' => 1));
    //     $query = $this->db->get();
    //     $res = $query->row_array();
    //     return $res;
    // }

    public function calculate_team($user_id,$status){
        $this->db->select('ifnull(count(tbl_sponser_count.downline_id),0) as team, tbl_users.paid_status');
        $this->db->from('tbl_users');
        $this->db->join('tbl_sponser_count', 'tbl_users.user_id = tbl_sponser_count.downline_id');
        $this->db->where(array('tbl_sponser_count.user_id' => $user_id ,'tbl_users.paid_status' => $status ,'tbl_sponser_count.level !=' => 1));
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }

    public function get_user_package_commison($user_id) {
        $this->db->select('tbl_user_positions.sponser_id,tbl_package.commision');
        $this->db->from('tbl_user_positions');
        $this->db->join('tbl_package', 'tbl_user_positions.package = tbl_package.id');
        $this->db->where(array('tbl_user_positions.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }
    public function update_directs($user_id) {
        $this->db->set('directs',  'directs + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
    }
    public function get_single_object($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_object();
//        echo $this->db->last_query();
        return $res;
    }

//     public function get_tree_user($user_id) {
//         $this->db->select('tbl_user_positions.user_id,tbl_user_positions.sponser_id,tbl_user_positions.upline_id,tbl_user_positions.created_at as topup_date,tbl_user_positions.position,tbl_user_positions.left_node,tbl_user_positions.right_node,tbl_user_positions.left_count,tbl_user_positions.right_count,tbl_users.first_name,tbl_users.last_name,tbl_users.courtesy_title,tbl_users.email,tbl_users.created_at as joining_date,tbl_package.commision');
//         $this->db->from('tbl_user_positions');
//         $this->db->join('tbl_users', 'tbl_user_positions.user_id = tbl_users.user_id');
//         $this->db->join('tbl_package', 'tbl_user_positions.package = tbl_package.id');
//         $this->db->where(array('tbl_user_positions.user_id' => $user_id));
//         $query = $this->db->get();
//         $res = $query->row_object();
// //        echo $this->db->last_query();
//         return $res;
//     }
    public function get_tree_user($user_id) {
        $this->db->select('tbl_users.user_id,tbl_users.name,tbl_users.image,tbl_users.sponser_id,tbl_users.upline_id,tbl_users.position,tbl_users.left_node,tbl_users.right_node,tbl_users.left_count,tbl_users.right_count,tbl_users.leftPower,tbl_users.rightPower,tbl_users.first_name,tbl_users.last_name,tbl_users.package_amount,tbl_users.email,tbl_users.created_at');
        $this->db->from('tbl_users');
        $this->db->where(array('tbl_users.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_object();
    //    echo $this->db->last_query();
        return $res;
    }

    public function add($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $where, $data) {
        $this->db->where($where);
        $res = $this->db->update($table, $data);
//        echo $this->db->last_query();
        return $res;
    }

    public function update_count($position, $user_id) {
        $this->db->set($position, $position . ' + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
//        echo $this->db->last_query();
    }
    public function update_business($position, $user_id , $business) {
        $this->db->set($position, $position . ' + '.$business, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
    //    echo $this->db->last_query();
    }

    public function update_bv($position, $user_id) {
        $this->db->set($position, $position . ' + 1' , FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_pool');
//        echo $this->db->last_query();
    }

    public function update_bv2($position, $user_id,$table) {
        $this->db->set($position, $position . ' + 1' , FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update($table);
//        echo $this->db->last_query();
    }

    public function user_chat($user_id) {
        $this->db->select('tbl_support_message.*,tbl_users.first_name,tbl_users.last_name,tbl_users.image');
        $this->db->from('tbl_support_message');
        $this->db->join('tbl_users', 'tbl_support_message.user_id = tbl_users.user_id','inner');
        $this->db->where(array('tbl_support_message.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }
    public function magic_users() {
        $this->db->select('sum(amount) as total_amount,user_id');
        $this->db->from('tbl_repurchase_income');
        $this->db->having('total_amount > ', 3600);
        $this->db->group_by('user_id');
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }


        public function getLastSingleRecord($table, $where, $select) {
        $this->db->select($select);
        $this->db->order_by('id' , 'DESC');
        $this->db->limit(1);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
        return $res;
    }


}
