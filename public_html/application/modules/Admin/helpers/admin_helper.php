<?php

if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}
if (!function_exists('is_admin')) {

    function is_admin() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A') {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('pool_count')) {

    function pool_count() {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $pool_count = $ci->Main_model->get_single_record('tbl_pool', array(), 'max(pool_level) as pool_count');
        return $pool_count;
    }

}

if (!function_exists('getName')) {

    function getName($user_id) {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $name = $ci->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name');
        return $name;
    }

}


if (!function_exists('calculate_rank')) {

    function calculate_rank($directs) {
        if($directs >= 100)
            $rank = 'Diamond';
        elseif($directs >= 50)
            $rank = 'Emerald';
        elseif($directs >= 25)
            $rank = 'Topaz';
        elseif($directs >= 20)
            $rank = 'Pearl';
        elseif($directs >= 15)
            $rank = 'Gold';
        elseif($directs >= 10)
            $rank = 'Silver';
        elseif($directs >= 5)
            $rank = 'Star';
        else
            $rank = 'Associate';

        return $rank;
    }
}
if (!function_exists('calculate_package')) {

    function calculate_package($package_id) {
        if($package_id == 1)
            $package = '3600';
        elseif($package_id == 2)
            $package = '1400';
        else
            $package = 'Free';
        return $package;
    }
}

if (!function_exists('incomes')) {

    function incomes() {
        $incomes = array(
            //'direct_income' => 'Direct Referral Income',
            //'single_leg' => 'Binnery Income',
            //'royalty_income' => 'Royalty Income',
            //'prediction_income' => 'Prediction Income',
            'pool_income' => 'Donation',
            'level_income' => 'Level Income',
            'club_income' => 'Club Donation',
            // 'silve_club_royalty' => 'Non-Working silver club Income.',
            // 'gold_club_royalty' => 'Gold club',
            // 'diamond_club_royalty' => 'Diamond club',
            // 'peral_club_royalty' => 'Pearl club',
            // 'crown_club_royalty' => 'Crown club',
            // 'elite_club_royalty' => 'Elite club',
            // 'platinum_club_royalty' => 'Platinum club',
            // 'platinum_star_club_royalty' => 'Platinum Star club',

        );
        // return array_search($income_name, $incomes);
        return $incomes;
    }

}

if(!function_exists('boardList')){
    function boardList(){
        $boardArray = array(
            'silver' => 'Silver',
            'gold' => 'Gold',
            'diamond' => 'Diamond',
            'pearl' => 'Pearl',
            'crown' => 'Crown',
            'elite' => 'Elite',
            'platinum' => 'Platinum',
            'platinumstar' => 'Platinum Star',
        );
        return $boardArray;
    }
}

if (!function_exists('get_income_name')) {

    function get_income_name($income_name) {
        $incomes = array(
            //'direct_income' => 'Direct Referral Income',
            //'single_leg' => 'Binnery Income',
            //'royalty_income' => 'Royalty Income',
            //'prediction_income' => 'Prediction Income',
            'level_income' => 'Level Income',
            'pool_income' => 'Pool Income',
            'club_income' => 'Club Donation',
            'roi_income' => 'Weekly Bonus',
            // 'silve_club_royalty' => 'Non-Working silver club Income.',
            // 'gold_club_royalty' => 'Gold club',
            // 'diamond_club_royalty' => 'Diamond club',
            // 'peral_club_royalty' => 'Pearl club',
            // 'crown_club_royalty' => 'Crown club',
            // 'elite_club_royalty' => 'Elite club',
            // 'platinum_club_royalty' => 'Platinum club',
            // 'platinum_star_club_royalty' => 'Platinum Star club',
            // 'income_transfer' => 'Income Transfer',
            // 'direct_income_withdraw' => 'Withdraw Request',

        );
        // return array_search($income_name, $incomes);
        return $incomes[$income_name];
    }

}
if (!function_exists('calculate_income')) {

    function calculate_income($incomeArr) {

        $incomes = array(
          'direct_income'=> 'Direct Income',
          'royalty_income'=> 'Royalty Income',
          'single_leg'=> 'Single Leg Income',
          'roi_income' => 'Weekly Bonus',
            // 'rewards_income'=> 'Rewards Bonus',
            // 'direct_income_withdraw' => 'Withdraw Request',
            // 'fasttrack_income' => 'FastTrack Income',
        );
        $income_count = array();
        $total_payout = 0;
        foreach($incomes as $key => $income){
            $income_count[$key] = 0;
            foreach($incomeArr as $arr){
                if($arr['type'] == $key){
                    $income_count[$key] = $arr['sum'];
                }
            }
            $total_payout = $income_count[$key] + $total_payout;
        }
        $income_count['total_payout']= $total_payout;
        return $income_count;
    }
}

if (!function_exists('notify_user')) {

    function notify_user($user_id, $message) {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $user = $ci->Main_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        // echo '<pre>';
        // print_r($user);
        $smsCount = $ci->Main_model->get_records('tbl_sms_counter', array(), 'count(id) as record');
        if($smsCount[0]['record'] <= '5000'){
            /* for sms */
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GNIMLM";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user['phone'] . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
            //$ci->Main_model->add('tbl_sms_counter', $sms_data);
            /* for sms */
        }
        /* for email */
        // date_default_timezone_set('Asia/Singapore');
        // $CI = & get_instance();
        // $CI->load->library('email');
        // $CI->email->from('info@godgrace.biz/', 'Godgrace');
        // $CI->email->to($user['email']);
        // $CI->email->subject('Registrataion Alert');
        // $CI->email->message($message);

        // $CI->email->send();
        /* for email */
    }

}
