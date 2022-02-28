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
if (!function_exists('is_logged_in')) {

//    protected $CI;

    function is_logged_in() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('userinfo')) {

    function userinfo() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $userdetails = $ci->user_model->get_single_object('tbl_users', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $userdetails;
    }

}

if (!function_exists('newss')) {
    function newss() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $news = $ci->user_model->get_records('tbl_news', array(), '*');
        return $news;
    }
}

if (!function_exists('bankinfo')) {
    function bankinfo() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $userdetails = $ci->user_model->get_single_object('tbl_bank_details', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $userdetails;
    }
}

if (!function_exists('pool_count')) {

    function pool_count() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $pool_count = $ci->user_model->get_single_object('tbl_pool', array('user_id' => $ci->session->userdata['user_id']), 'ifnull(count(id),0) as pool_count');
        return $pool_count;
    }

}
if (!function_exists('pool_levels')) {

    function pool_levels() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $pool_count = $ci->user_model->get_records('tbl_pool', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $pool_count;
    }

}
if (!function_exists('calculate_rank')) {

    function calculate_rank($directs) {
        if ($directs >= 100)
            $rank = 'Diamond';
        elseif ($directs >= 50)
            $rank = 'Emerald';
        elseif ($directs >= 25)
            $rank = 'Topaz';
        elseif ($directs >= 20)
            $rank = 'Pearl';
        elseif ($directs >= 15)
            $rank = 'Gold';
        elseif ($directs >= 10)
            $rank = 'Silver';
        elseif ($directs >= 5)
            $rank = 'Star';
        else
            $rank = 'Associate';

        return $rank;
    }

}
if (!function_exists('calculate_package')) {

    function calculate_package($package_id) {
        if ($package_id == 1)
            $package = '3600';
        elseif ($package_id == 2)
            $package = '1400';

        return $package;
    }

}
if (!function_exists('calculate_rank_bonus')) {

    function calculate_rank_bonus($directs, $package_id) {
        if ($package_id == 1) {
            if ($directs >= 100)
                $income = 200;
            elseif ($directs >= 50)
                $income = 175;
            elseif ($directs >= 25)
                $income = 150;
            elseif ($directs >= 20)
                $income = 125;
            elseif ($directs >= 15)
                $income = 100;
            elseif ($directs >= 10)
                $income = 75;
            elseif ($directs >= 5)
                $income = 50;
            else
                $income = 0;

            return $income;
        }else {
            if ($directs >= 100)
                $income = 105;
            elseif ($directs >= 50)
                $income = 90;
            elseif ($directs >= 25)
                $income = 75;
            elseif ($directs >= 20)
                $income = 60;
            elseif ($directs >= 15)
                $income = 45;
            elseif ($directs >= 10)
                $income = 30;
            elseif ($directs >= 5)
                $income = 15;
            else
                $income = 0;

            return $income;
        }
    }

}
if (!function_exists('notify_user')) {

    function notify_user($user_id, $message) {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $sms_limt = $ci->user_model->get_single_record('tbl_sms_counter', array(''), 'ifnull(count(id),0) as sms_limt');
        if($sms_limt['sms_limt'] < sms_limit){
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GRAMIN";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
            $ci->user_model->add('tbl_sms_counter', $sms_data);
        }
    }

}

if (!function_exists('notify_sms')) {
    function notify_sms($user_id, $message, $entity_id ='1201161518339990262', $temp_id ='') {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $id_count = $ci->user_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
        if($id_count['ids'] < sms_limit){
             $key = "a08f1ade94XX";
             $userkey = "gniweb2";
             $senderid = "MLMSIG";
             $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
             $msg = urlencode($message);
             // $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
             $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1&&entityid='.$entity_id.'&&tempid='.$temp_id;
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_HEADER, 0);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_URL, $url);
             $data = curl_exec($ch);
             curl_close($ch);
             // pr($data);
             $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
             $ci->user_model->add('tbl_sms_counter', $sms_data);
        }
    }

}

if (!function_exists('tax')) {

    function tax() {
        $ci = & get_instance();
        $ci->load->model('user_model');
        $tax = $ci->user_model->get_single_object('tbl_tax', array('id' => 1), '*');
        return $tax->tax;
    }

}

if(!function_exists('sendMail')){
    function sendMail($message,$email){
        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->from(email,title);
        $CI->email->to($email);
        $CI->email->subject(title.'Alert');
        $CI->email->message($message);
        $CI->email->send();
    }
}

if(!function_exists('sendMail2')){
    function sendMail2($to,$subject,$message){
        $CI = & get_instance();
        $data['data'] = $message;
        $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
        );
        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->from(email,title);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $body = $CI->load->view('email',$data,TRUE);
        $CI->email->message($body);
        $CI->email->send();
    }
}


if(!function_exists('sendMail21')){
    function sendMail21($to,$subject,$message){
        $CI = & get_instance();
        $data['data'] = $message;
        $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
        );
        $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->from("info@artisticuniversal.com",title);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $body = $message;
        $CI->email->message($body);
        $dd = $CI->email->send();
        print_r($dd);
    }
}


if(!function_exists('send_email')){
    function send_email($data){
        $CI = & get_instance();
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS =>'{
        //         "Messages":[
        //                 {
        //                         "From": {
        //                                 "Email": "info@artisticuniversal.com",
        //                                 "Name": "Artistic Universal"
        //                         },
        //                         "To": [
        //                                 {
        //                                         "Email": "'.$data['info']['email'].'",
        //                                         "Name": "'.$data['info']['email'].'"
        //                                 }
        //                         ],
        //                         "Subject": "'.$data['info']['title'].'",
        //                         "TextPart": "",
        //                         "HTMLPart": "'.$CI->load->view('mailjet_email',$data,TRUE).'"
        //                 }
        //         ]

        // }',
        //   CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/json',
        //     'Authorization: Basic ZGM0ZmEzMjU5NTVjZDQ5MTg2NWJkNzkyODZjYWY2NDY6MDhlYjk3YmVkMTNhNDFmMWU1MDA0OGNkNWI2Yzg2ZDU='
        //   ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => '176.58.124.217:3000/send_email',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'to='.$data['info']['email'].'&subject='.$data['info']['title'].'&message='.$CI->load->view('mailjet_email',$data,TRUE).'',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,true);
        
    }
}

if (!function_exists('cart_items')) {

    function cart_items() {
        $ci = & get_instance();
        $ci->load->model('Shopping_model');
        $userdetails = $ci->Shopping_model->cart_items($ci->session->userdata['user_id']);
        return $userdetails;
    }

}
if (!function_exists('tree_img')) {

    function tree_img($package_amount, $empty) {
        if ($empty == 0) {
            if ($package_amount > 0) {
                $img = base_url('SiteAssets/treeimage/tree.png');
            } else {
                $img = base_url('SiteAssets/treeimage/male.jpg');
            }
        } else {
            $img = base_url('SiteAssets/treeimage/unknown.jpg');
        }
        return $img;
    }

}


if (!function_exists('get_income_name')) {

    function get_income_name($income_name) {
        $incomes = array(

          // 'daily_roi_income' => 'Weekly Incentive',
          // 'matching_bonus' => 'Matching Income',
          // 'daily_roi_income' => 'Weekly Incentive',
          // 'rewards_income' => 'Rewards Incentive',
         'direct_income' => 'Direct Income',
         'level_income' => 'Level Income',
         'leadership_income' => 'Leadership Income',
         'daily_roi_income' => 'Daily ROI Income',
         // 'pool_level_income' => 'Pool Level Income',
        //    'daily_roi_income' => 'Daily ROI Income',
         'direct_income_withdraw' => 'Direct Income Withdraw',
        //  'upgrade_deduction' => 'Upgrade Deduction',
         'pool_income' => 'Auto Pool Income',
         // 'privilege_income' => 'Privilege Income',

        //   'single_leg' => 'Weekly Growth Bonus',
        //   'daily_growth_income' => 'Alliance Club A',
        //   'daily_growth_income_b' => 'Alliance Club B',
        // 'withdraw_request' => 'Withdraw Request',
        //'matching_withdraw' => 'Matching Withdraw Request',
        // 'income_transfer' => 'Income Transfer',
        // 'bank_transfer' => 'Bank Transfer',
        );
        // return array_search($income_name, $incomes);
        return $incomes[$income_name];
    }

}
if (!function_exists('incomes')) {

    function incomes() {
        $incomes = array(
         'direct_income' => 'Direct Income',
          'level_income' => 'Level Income',
          'leadership_income' => 'Leadership Income',
          'daily_roi_income' => 'Daily ROI Income',
          'pool_income' => 'Auto Pool Income',
          // 'privilege_income' => 'Privilege Income',
            // 'daily_roi_income' => 'Daily ROI Income',
            // 'upgrade_deduction' => 'Upgrade Deduction',
          // 'matching_bonus' => 'Matching Income',
          // 'daily_roi_income' => 'Weekly Incentive',
          // 'rewards_income' => 'Rewards Incentive',
        //  'level_income' => 'Level Income',
        //  'royalty_income' => 'Royalty Income',
          //'single_leg' => 'Weekly Growth Bonus',
        //   'daily_growth_income' => 'Alliance Club A',
        //   'daily_growth_income_b' => 'Alliance Club B',
            // 'withdraw_request' => 'Withdraw Request',
            //'matching_withdraw' => 'Matching Withdraw Request'

        );
        // return array_search($income_name, $incomes);
        return $incomes;
    }

}

if (!function_exists('getIndianCurrency')) {

    function getIndianCurrency($number) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else
                $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

}



function notify_mail2($to_email , $message,$subject){
    $personalizations = new stdClass();

    $content = new stdClass();
    $from = new stdClass();
    $reply_to = new stdClass();

    $content->type  = 'text/plain';
    $content->value = $message;
    $from->email = 'artisticuniversal@gmail.com';
    $from->name = 'Artistic Universal';


    $reply_to->email = 'artisticuniversal@gmail.com';
    $reply_to->name = 'Artistic Universal';

    $to[0] = ['email' => $to_email];
    $personalizations->subject = $subject;
    $post_data['personalizations'][0] = $personalizations;
    $post_data['personalizations'][0]->to = $to;
    $post_data['content'][0] = $content;
    $post_data['from'] = $from;

    $post_data['reply_to'] = $reply_to;
    // echo json_encode($post_data);
    // pr($post_data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($post_data),
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer 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",
        "cache-control: no-cache",
        "content-type: application/json",
    ),
    ));

    echo $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

function notify_mail_Reg($to_email , $message,$subject){
    $ci = & get_instance();
    $ci->load->model('user_model');
    $data['info'] = $ci->user_model->get_single_record('tbl_users',['email' => $to_email],'*');
    $data['data'] = $message;
    $personalizations = new stdClass();

    $content = new stdClass();
    $from = new stdClass();
    $reply_to = new stdClass();
    $content->type  = 'text/html';
    $body = $ci->load->view('email',$data,TRUE);
    $content->value = $body;
    $from->email = 'artisticuniversal@gmail.com';
    $from->name = 'Artistic Universal';


    $reply_to->email = 'artisticuniversal@gmail.com';
    $reply_to->name = 'Artistic Universal';

    $to[0] = ['email' => $to_email];
    $personalizations->subject = $subject;
    $post_data['personalizations'][0] = $personalizations;
    $post_data['personalizations'][0]->to = $to;
    $post_data['content'][0] = $content;
    $post_data['from'] = $from;

    $post_data['reply_to'] = $reply_to;
    // echo json_encode($post_data);
    // pr($post_data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($post_data),
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer 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",
        "cache-control: no-cache",
        "content-type: application/json",
    ),
    ));

    echo $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}





function notify_mail($to_email , $message){
    $personalizations = new stdClass();

    $content = new stdClass();
    $from = new stdClass();
    $reply_to = new stdClass();

    $content->type  = 'text/plain';
    $content->value = $message;
    $from->email = 'btcalliance.co@gmail.com';
    $from->name = 'btcalliance';


    $reply_to->email = 'btcalliance.co@gmail.com';
    $reply_to->name = 'btcalliance';

    $to[0] = ['email' => $to_email];
    $personalizations->subject = 'Registration Alert';
    $post_data['personalizations'][0] = $personalizations;
    $post_data['personalizations'][0]->to = $to;
    $post_data['content'][0] = $content;
    $post_data['from'] = $from;

    $post_data['reply_to'] = $reply_to;
    // echo json_encode($post_data);
    // pr($post_data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($post_data),
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer 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",
        "cache-control: no-cache",
        "content-type: application/json",
    ),
    ));

    echo $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

function country_dropdown($name, $id, $class, $selected_country, $top_countries = array(), $all, $selection = NULL, $show_all = TRUE) {
    // Getting the array of countries from the config file
    $countries = config_item('country_list');
    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if (in_array($selection, $top_countries)) {
        $top_selection = $selection;
        $all_selection = NULL;
    } else {
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if (!empty($selected_country) && $selected_country != 'all' && $selected_country != 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_country}'{$selected}>{$countries[$selected_country]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'all') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if (!empty($all) && $all == 'all' && $selected_country != 'all') {
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if (!empty($all) && $all == 'select' && $selected_country != 'select') {
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if (!empty($top_countries)) {
        $html .= "<optgroup label='Top Countries'>";
        foreach ($top_countries as $value) {
            if (array_key_exists($value, $countries)) {
                if ($value === $top_selection) {
                    $selected = "SELECTED";
                }
                $html .= "<option value='{$value}'{$selected}>{$countries[$value]}</option>";
                $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }
    if ($show_all) {
        $html .= "<optgroup label='All Countries'>";
        foreach ($countries as $key => $country) {
            if ($key === $all_selection) {
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
}

if (!function_exists('calculate_income')) {

    function calculate_income($incomeArr) {

        $incomes = incomes();
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

if(!function_exists('downlineTeam')){
    function downlineTeam($user_id,$status,$position){
        $ci = & get_instance();
        $ci->load->model('User_model');
        $team = $ci->User_model->calculate_Position_team($user_id,$status,$position);
        //pr($team);
        return $team['team'];
    }
}

if(!function_exists('orgCheck')){
    function orgCheck($org){
        $ci = & get_instance();
        $ci->load->library('session');
        $ci->load->model('User_model');
        $record = $ci->User_model->get_single_record('tbl_pool',"user_id = '".$ci->session->userdata['user_id']."' and org = '".$org."'",'id,pool_id');
        $position = $ci->User_model->get_single_record('tbl_pool',['id' => $record['id']],'position');
        if($position['position'] == 1){$plus = 1;}else{ $plus = (($position['position'])+($position['position']-1));}
        $newValue = $position['position'] + $plus;
        $response['newValue'] = []; 
        for($i=1;$i<=3;$i++){
            $response['newValue'][$i] = $newValue;
            $newValue += 1;
        }
        return $response;
    }
}

if(!function_exists('totalPoolId')){
    function totalPoolId($org){
        $ci = & get_instance();
        $ci->load->library('session');
        $ci->load->model('User_model');
        $record = $ci->User_model->get_single_record('tbl_pool',['org' => $org],'count(id) as record');
        return $record['record'];
    }
}



if(!function_exists('mail_from_sendgrid')){ 
    function mail_from_sendgrid($data = ''){
        // modify by sk (SMART SEND GRID)
        $CI = & get_instance();
        $to = $data['info']['email'];
        $subject = $data['info']['title'];
        $params=[
            'from'=> "info@artisticuniversal.com",
            'fromname'=> title,
            'subject'=> $subject,
            'text'=> preg_replace("/\n\s+/","\n",rtrim(html_entity_decode(strip_tags($CI->load->view('sendgrid_email',$data,TRUE))))),
            'html'=> $CI->load->view('sendgrid_email',$data,TRUE),
        ];
        if (is_array($to)) {
            $i=0;
            foreach($to as $t) $params['to['.$i++.']']=$t;
        } else {
            $params['to']=$to;
        }
        
        $_curl_session = curl_init('https://api.sendgrid.com/api/mail.send.json');
        curl_setopt ($_curl_session , CURL_SSLVERSION_TLSv1 , true );
        // curl_setopt($_curl_session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($_curl_session, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.SENDGRID_API_KEY));
        curl_setopt($_curl_session, CURLOPT_POST, true);
        curl_setopt($_curl_session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($_curl_session, CURLOPT_HEADER, false);
        curl_setopt($_curl_session, CURLOPT_RETURNTRANSFER, true);
        $_response = curl_exec($_curl_session);
        curl_close($_curl_session);
        if(!empty($_response)){

            $response = json_decode($_response,true);
            
            if($response['message'] == 'success'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('getPaidTeam')){ 
    function getPaidTeam($user_id){
        $ci = & get_instance();
        $ci->load->library('session');
        $ci->load->model('User_model');
        $userinfo = $ci->User_model->get_single_record('tbl_users',['sponser_id' => $user_id,'paid_status' => 1],'count(id) as direct');
        $users = $ci->User_model->get_records('tbl_sponser_count',['user_id' => $user_id,'level' => 1],'user_id,downline_id,level');
        $getPaidTeam = $ci->User_model->getPaidTeam($user_id,1,3);
        $status = false;
        foreach($users as $key => $user){
            $user2 = $ci->User_model->get_single_record('tbl_users',['sponser_id' => $user['downline_id'],'paid_status' => 1],'count(id) as direct');
            if($user2['direct'] >= 4 && $getPaidTeam >= 64 && $userinfo['direct'] >= 4){
                $status = true;
            } 
        }
        return $status;
    }
}


