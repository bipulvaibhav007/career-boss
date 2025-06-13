<?php

    use App\Models\Auth_model;

    if(!function_exists('is_privilege')){
        function is_privilege($menu_id, $functionId = null){
            if(session()->has('userlogin')){
                $auth = model('App\Models\Auth_model', false);
                $authenticData = $auth->is_user_privilege(session('privilege_id'), $menu_id, $functionId);
                if(!empty($authenticData)){
                    //print_r($data); exit;
                    return $menu_id;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }
    // check franchise url
    if(!function_exists('is_franchise')){
        function is_franchise(){
            if(session()->has('MemberIsLoggedIn')){
                $member_type = session('member_type');
                if($member_type == 1){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }
    // franchise students status array
    if(!function_exists('franchise_statuses')){
        function franchise_statuses(){
            return ['New','Inprogress', 'Edit', 'Generated', 'Reject'];
        }
    }
    if(!function_exists('get_franchise_student_status_txt')){
        function get_franchise_student_status_txt($status=null){
            if($status < 1){
                $statusText = '<span class="btn btn-primary btn-sm">New</span>';
            }else if($status == 1){
                $statusText = '<span class="btn btn-warning btn-sm">Inprogress</span>';
            }else if($status == 2){
                $statusText = '<span class="btn btn-dark btn-sm">Edit</span>';
            }else if($status == 3){
                $statusText = '<span class="btn btn-success btn-sm">Generated</span>';
            }else if($status == 4){
                $statusText = '<span class="btn btn-danger btn-sm">Reject</span>';
            }else if($status == 5){
                $statusText = '<span class="btn btn-danger btn-sm">On Approval</span>';
            }else if($status == 6){
                $statusText = '<span class="btn btn-primary btn-sm">Approved</span>';
            }else if($status == 7){
                $statusText = '<span class="btn btn-warning btn-sm">Denied</span>';
            }else if($status == 10){
                $statusText = '<span class="btn btn-dark btn-sm">Edit Request</span>';
            }else{
                $statusText = '<span class="btn btn-danger btn-sm">Not Defined</span>';
            }
            return $statusText;
        }
    }
    if(!function_exists('get_examinee_status_txt')){
        function get_examinee_status_txt($status=null){
            if($status < 1){
                $statusText = '<span class="btn btn-warning btn-sm">Pending</span>';
            }else if($status == 1){
                $statusText = '<span class="btn btn-dark btn-sm">Present</span>';
            }else if($status == 2){
                $statusText = '<span class="btn btn-success btn-sm">Completed</span>';
            }else{
                $statusText = '<span class="btn btn-danger btn-sm">Not Defined</span>';
            }
            return $statusText;
        }
    }
    if(!function_exists('alertBS')){
        function alertBS($message, $type){
            return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
                        '.$message.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }

    if(!function_exists('display_error')){
        function display_error($validation, $field){
            if($validation->hasError($field)){
                return $validation->getError($field);
            }else{
                return false;
            }
        }
    }

    if(!function_exists('get_error')){
        function get_error($validation, $field){
            if(isset($validation[$field])){
                return $validation[$field];
            }else{
                return false;
            }
        }
    }

    if(!function_exists('get_badge_wh_status')){
        function get_badge_wh_status($whStatus = null){
            if($whStatus == 1){
                $whStatusTxt = '<span class="badge badge-primary ">Read</span>';
            }else if($whStatus == 2){
                $whStatusTxt = '<span class="badge badge-warning ">Reply</span>';
            }else if($whStatus == 3){
                $whStatusTxt = '<span class="badge badge-info ">Delivered</span>';
            }else if($whStatus == 4){
                $whStatusTxt = '<span class="badge badge-success ">Sent</span>';
            }else{
                $whStatusTxt = '<span class="badge badge-dark ">Chat</span>';
            }
            return $whStatusTxt;
        }
    }
    if ( ! function_exists('get_student_status')){
        function get_student_status($status = ''){
            if($status < 1){
                return '<span class="btn btn-warning btn-sm">Inactive</span>';
            }else if($status == 1){
                return '<span class="btn btn-primary btn-sm">Active</span>';
            }else if($status == 2){
                return '<span class="btn btn-success btn-sm">Completed</span>';
            }else if($status == 3){
                return '<span class="btn btn-danger btn-sm">Cancel</span>';
            }else if($status == 4){
                return '<span class="btn btn-success btn-sm">Certified</span>';
            }else{
                return '<span class="btn btn-danger btn-sm">Not Defined</span>';
            }
        }
    }
    if(!function_exists('custom_pagination')){
        function custom_pagination($page_config){
            $tot_record = $page_config['tot_record'];
            $rec_limit = $page_config['rec_limit'];
            $btn_limit = $page_config['btn_limit'];
            $page = $page_config['current_page'];
            $url = $page_config['url'];
            $url_param = $page_config['url_param'];
            $colspan = $page_config['colspan'];

            if($tot_record <= $rec_limit){
                $out['limit'] = $rec_limit;
                $out['offset'] = 0;
                $out['pagination_html'] = '';
                
            }else{
                $total_page = ceil($tot_record / $rec_limit);
                $offset = 0;
                if($page){
                    $offset = ($page * $rec_limit) - $rec_limit;
                }
                if(floor($page/$btn_limit) < 1){
                    $i_ = 1;
                }else{
                    $i_ = floor($page/$btn_limit)*$btn_limit;
                }
                $pagination_html = 
                        '<tfoot>
                            <tr>
                                <td colspan="'.$colspan.'" class="text-center">';
                if($i_ > 1){
                    $f_URL = $url.'?'.$url_param.'=1';
                    $pre_URL = $url.'?'.$url_param.'='.$i_-1;
                    
                    
                    $pagination_html .= '<a href="'.$f_URL.'" class="btn btn-outline-primary mx-1"><strong><<</strong></a>';
                    $pagination_html .= '<a href="'.$pre_URL.'" class="btn btn-outline-primary mx-1"><strong><</strong></a>';
                }
                for($i=$i_; $i<($i_+$btn_limit) && $i<=$total_page; $i++){ 
                    $cur_URL = $url.'?'.$url_param.'='.$i;
                    $actv = ($page == $i)?'active':'';
                    $pagination_html .= '<a href="'.$cur_URL.'" class="btn btn-outline-primary '.$actv.' mx-1">'.$i.'</a>';
                }
                if($page != $total_page && $i <= $total_page){
                    $next_URL = $url.'?'.$url_param.'='.$i;
                    $l_URL = $url.'?'.$url_param.'='.$total_page;
                    $pagination_html .= '<a href="'.$next_URL.'" class="btn btn-outline-primary mx-1"><strong>></strong></a>';
                    $pagination_html .= '<a href="'.$l_URL.'" class="btn btn-outline-primary mx-1"><strong>>></strong></a>';
                }
                $pagination_html .= '</td></tr></tfoot>';
                $out['limit'] = $rec_limit;
                $out['offset'] = $offset;
                $out['pagination_html'] = $pagination_html;
            }
            return $out;
        }
    }
    if(!function_exists('base64url_encode')){
        function base64url_encode($data){
            return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
        }
    }
    if(!function_exists('base64url_decode')){
        function base64url_decode($data) {
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
        }
    }
    if(!function_exists('get_logo')){
        function get_logo($key) {
            if(isset(SUBJECT_LOGO[$key])){
                return SUBJECT_LOGO[$key];
            }else{
                return 'career-logo.jpg';
            }
        }
    }
    if(!function_exists('course_cat')){
        function course_cat() {
            return [
                'C' => ['Diploma Course','primary'],
                'P' => ['Professional Course','secondary'],
                'T' => ['Typing','warning'],
                'U' => ['University Course','success'],
                'F' => ['Certificate Course','danger']
            ];
        }
    }
    if(!function_exists('get_course_cat')){
        function get_course_cat($key) {

            return '<span class="badge badge-'.course_cat()[$key][1].'">'.course_cat()[$key][0].'</span>';
            
        }
    }
?>