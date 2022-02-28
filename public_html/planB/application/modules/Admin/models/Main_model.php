<?php

class Main_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_single_record_desc($table, $where, $select) {
        $this->db->select($select);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function withdraw_users($minimum_amount) {
        $this->db->select('sum(amount) as total_amount,user_id');
        $this->db->from('tbl_income_wallet');
        $this->db->having(array('total_amount >=' => $minimum_amount));
        $this->db->group_by('user_id');
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function get_records($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_limit_records($table, $where, $select, $limit, $offset) {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id','DESC');
        $query = $this->db->get($table);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }


      public function get_limit_recordss($table, $where, $select, $limit, $offset) {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->group_by("user_id");
        $this->db->limit($limit, $offset);
        $this->db->order_by('total','DESC');
        $query = $this->db->get($table);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_sum($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_object();
        return $res->sum;
    }


     public function get_sums($table, $where, $select) {
        $this->db->select($select);
        $this->db->group_by("user_id");
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
        return $res;
    }

    public function get_incomes($table, $where, $select) {
        $this->db->select($select);
        $this->db->group_by('type');
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
        return $res;
    }

    public function payout_summary() {
        $this->db->select('date(created_at) as date');
        $this->db->group_by('date');
        $query = $this->db->get('tbl_income_wallet');
        $res = $query->result_array();
        return $res;
    }

    public function payout_summary2($where) {
        $this->db->select('date(created_at) as date');
        $this->db->group_by('date');
        // $query = $this->db->get('tbl_income_wallet');
        $query = $this->db->get_where('tbl_income_wallet', $where);
        $res = $query->result_array();
        return $res;
    }

    public function get_chat_users() {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.first_name,tbl_users.last_name,tbl_users.phone,tbl_users.sponser_id,tbl_users.image,tbl_support_message.*');
        $this->db->from('tbl_users');
        $this->db->group_by('tbl_users.user_id');
        $this->db->join('tbl_support_message', 'tbl_users.user_id = tbl_support_message.user_id', 'inner');
        $this->db->where(array());
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function get_all_users() {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.name,tbl_users.first_name,tbl_users.last_name,tbl_users.phone,tbl_users.sponser_id,tbl_users.created_at');
        $this->db->from('tbl_users');
        // $this->db->join('countries', 'tbl_users.country = countries.id');
        $this->db->where(array());
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function position_paid_users() {
        $this->db->select('count( DISTINCT position ) as position_count, sponser_id ,count(id)');
        $this->db->from('tbl_users');
        // $this->db->join('countries', 'tbl_users.country = countries.id');
        $this->db->where(array('paid_status' => 1));
        $this->db->group_by('sponser_id');
        $this->db->having(array('position_count > ' => 1));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function update_business($position, $user_id, $business) {
        $this->db->set($position, $position . ' + ' . $business, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        //    echo $this->db->last_query();
    }
    public function count_position_directs($user_id){
        $this->db->select('user_id');
        $this->db->group_by('position');
        $this->db->where(['sponser_id' => $user_id , 'paid_status' => 1]);
        $query = $this->db->get('tbl_users');
        $res = $query->result_array();
        return $res;
    }
    public function update_directs($user_id) {
        $this->db->set('directs', 'directs + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
    }

    public function get_single_object($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function add($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $where, $data) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function update_count($position, $user_id) {
        $this->db->set($position, $position . ' + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
//        echo $this->db->last_query();
    }

    public function delete($table, $id) {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    public function get_tree_user($user_id) {
        $this->db->select('tbl_user_positions.user_id,tbl_user_positions.sponser_id,tbl_user_positions.upline_id,tbl_user_positions.created_at as topup_date,tbl_user_positions.position,tbl_user_positions.left_node,tbl_user_positions.right_node,tbl_user_positions.left_count,tbl_user_positions.right_count,tbl_users.first_name,tbl_users.last_name,tbl_users.courtesy_title,tbl_users.email,tbl_users.created_at as joining_date');
        $this->db->from('tbl_user_positions');
        $this->db->join('tbl_users', 'tbl_user_positions.user_id = tbl_users.user_id');
        $this->db->where(array('tbl_user_positions.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_object();
//        echo $this->db->last_query();
        return $res;
    }

    public function update_bv($position, $user_id, $bv) {
        $this->db->set($position, $position . ' + ' . $bv, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_user_positions');
//        echo $this->db->last_query();
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

    public function user_chat($user_id) {
        $this->db->select('tbl_support_message.*,tbl_users.first_name,tbl_users.last_name,tbl_users.image');
        $this->db->from('tbl_support_message');
        $this->db->join('tbl_users', 'tbl_support_message.user_id = tbl_users.user_id', 'inner');
        $this->db->where(array('tbl_support_message.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function todayPair(){
        $where = 'type = "matching_bonus" and date(created_at) = date(now()) - 1';
        $this->db->select('amount');
        $this->db->order_by('amount','ASC');
        $this->db->limit('1');
        $query = $this->db->get_where('tbl_income_wallet',$where);
        $result = $query->result_array();
        if(!empty($result)){
            return $result[0];
        }
        
    }
    public function get_roi_users($having){
        $this->db->select('*,day(created_at) as date ,DATEDIFF(now(),created_at)as date_diff');
        $this->db->having($having);
        $this->db->where(['amount >' => 0 , 'type !=' => 'salary']);
        $query = $this->db->get('tbl_roi');
        $res = $query->result_array();
        return $res;
    }

    public function level_records($table, $where, $select, $limit, $offset) {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->order_by('level',"ASC");
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function getLimitrecords($table, $limit, $offset,$where) {
        $this->db->select('count(id) as ids,sponser_id');
        $this->db->where($where);
        $this->db->group_by('sponser_id');
        $this->db->having(['ids >=' => 28]);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function getSum($where) {
        $this->db->select('count(id) as ids,sponser_id');
        $this->db->group_by('sponser_id');
        $this->db->where($where);
        $this->db->having(['ids >=' => '28']);
        $query = $this->db->get('tbl_users');
        $res = $query->result_array();
        return $res;
    }

      public function getSumdate($where) {
        $this->db->select('count(id) as ids,topup_date');
        $this->db->group_by('date(topup_date)');
        $this->db->where($where);
        $query = $this->db->get('tbl_users');
        $res = $query->result_array();
        return $res;
    }

     public function get_limit_recordsdate($where,$select ,$limit, $offset) {
         $this->db->select($select);
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('topup_date','DESC');
        $query = $this->db->get('tbl_users');
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function pending_crypto_transactions($where,$limit,$offset) {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.tron,tbl_users.usdt,tbl_users.wallet_address,tbl_users.private_key,tbl_block_address.value,tbl_block_address.id');
        $this->db->from('tbl_block_address');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_block_address.user_id');
        $this->db->where($where);
        $this->db->order_by('tbl_block_address.id', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $res = $query->result_array();
        echo $this->db->last_query();
        return $res;
    }
    // $query = $this->db->query("select id,user_id,api_key,secret_key,binance_balance from tbl_users where 
    // api_key != '' and paid_status = 1 and wallet_amount > 10
    // and id not in (SELECT user_id FROM `binance_trades` WHERE `squre_off` = '0' and batch_id = '".$batch_id."')  and
    // user_id not in (SELECT user_id FROM `skiped_trades` where batch_id = '".$batch_id."') 
    // order by binance_balance desc limit $limit ");

    // AU55311 : 20 
    // AU12017 : 3
    // AU63663 : 20
    // AU22913 : 21.032
    // AU11226 : 20.006574
    // AU88910 : 10
    // AU98402 : 20
    // AU60684 : 8.9997


    // public function pending_crypto_transactions($where,$limit,$offset) {
    //     $query = $this->db->query("SELECT id,user_id,usdt,tron,wallet_address,private_key FROM `tbl_users` where usdt > 1 ORDER BY `tbl_users`.`tron`
    //      and user_id not in ('AU55311','AU12017','AU63663','AU22913','AU11226','AU88910','AU98402','AU60684')");
    //     // $query = $this->db->get();
    //     $res = $query->result_array();
    //     echo $this->db->last_query();
    //     return $res;
    // }


    // public function getLimitrecordstest() {
    //     $this->db->select('count(id) as ids,sponser_id');
    //     $this->db->group_by('sponser_id');
    //     $this->db->having(['ids >=' => 28]);
    //     $query = $this->db->get('tbl_users');
    //     $res = $query->result_array();
    //     return $res;
    // }
    public function tronTransactionUsers() {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.tron,tbl_users.usdt,tbl_users.wallet_address,tbl_users.private_key,tbl_block_address2.value,tbl_block_address2.id');
        $this->db->from('tbl_block_address2');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_block_address2.user_id');
        $this->db->where(['tbl_block_address2.id >' => 15]);
        $this->db->order_by('tbl_block_address2.id', 'desc');
        // $this->db->limit(10);
        $this->db->group_by('tbl_users.user_id');
        $query = $this->db->get();
        $res = $query->result_array();
        echo $this->db->last_query();
        return $res;
    }
    public function wrong_usdt_transactions() {
        $this->db->select('tbl_block_address.id,tbl_block_address.value,tbl_users.user_id,tbl_users.country_code,tbl_users.phone,tbl_users.name,tbl_users.wallet_address');
        $this->db->from('tbl_block_address');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_block_address.user_id');
        $this->db->where('tbl_block_address.to != tbl_users.wallet_address and tbl_block_address.id > 16');
        $this->db->order_by('tbl_block_address.id', 'desc');
        // $this->db->limit(10);
        // $this->db->group_by('tbl_users.user_id');
        $query = $this->db->get();
        $res = $query->result_array();
        // echo $this->db->last_query();
        return $res;
    }


    public function count_level_directss($user_id) {
        $this->db->select('count(id) as level_count,level,user_id');
        $this->db->from('tbl_sponser_count');
        $this->db->where(array('user_id' => $user_id ,'level'=> 3, 'paid_status >' => 0));
        $this->db->group_by('level');
        // $this->db->having('level <=',12);
        // $this->db->order_by('level','asc');
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function getPaidTeam($user_id,$status,$level){
        $this->db->select('count(tbl_sponser_count.downline_id) as team');
        $this->db->from('tbl_users');
        $this->db->join('tbl_sponser_count', 'tbl_users.user_id = tbl_sponser_count.downline_id');
        $this->db->where(array('tbl_sponser_count.user_id' => $user_id ,'tbl_users.paid_status' => $status ,'tbl_sponser_count.level' => $level));
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['team'];
    }


}
