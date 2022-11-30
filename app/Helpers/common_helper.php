<?php 

if (!function_exists('create_slug')) {
    function formatDate($olddate){
        $now = time();                  //pick present time from server     
        $old = strtotime( $olddate);  //create integer value of old time
        $diff =  $now-$old;             //calculate difference
        $old = new DateTime($olddate);
        $old = $old->format('Y M d');       //format date to "2015 Aug 2015" format

            if ($diff /60 <1)                       //check the difference and do echo as required
            {
                return intval($diff%60)." giây trước";
            }
            else if (intval($diff/60) == 1) 
            {
                return " 1 phút trước";
            }
            else if ($diff / 60 < 60)
            {
                return intval($diff/60)." phút trước";
            }
            else if (intval($diff / 3600) == 1)
            {
                return "1 giờ trước";
            }
            else if ($diff / 3600 <24)
            {
                return intval($diff/3600) . " giờ trước";
            }
            else if ($diff/86400 < 30)
            {
                return intval($diff/86400) . " ngày trước";
            }
            else
            {
                return $old;  ////format date to "2015 Aug 2015" format
            }
    }
}

if (!function_exists('price_format')) {
    function price_format($number)
    {
        return number_format($number, 0, '', ',');
    }
}

// search name product
if (!function_exists('search_text')) {
    function search_text($string, $text)
    {
        if(strstr($string, $text)){
            $new_string = str_replace($text,'<strong class="highlight">'.$text.'</strong>',$string);
            return $new_string;
        }else{
            return $string;
        }
    }
}
/**
 * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
 * @access    public
 * @param string
 * @return    string
 */
if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
if (!function_exists('calc_age')) {
    function calc_age($bod)
    {
        try {
             //explode the date to get month, day and year
            $temp = explode("-", $bod);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $temp[0], $temp[1], $temp[2]))) > date("md")
                ? ((date("Y") - $temp[2]) - 1)
                : (date("Y") - $temp[2]));
            return $age;
        }
        catch (Exception $e) {
            echo "Message: " . $e->getMessage();
        }
    }
}

if (!function_exists('calc_bd')) {
    function calc_bd($bod)
    {
        try {
            $john_bday = new DateTime($bod);
            $today_date = new DateTime();
            
            switch (true) {
                case ($john_bday < $today_date) :
                $today_date->setDate($john_bday->format('Y'), $today_date->format('m'), $today_date->format('d'));
                break;
            
                case ($today_date < $john_bday) :
                $john_bday->setDate($today_date->format('Y'), $john_bday->format('m'), $john_bday->format('d'));
                break;
            }
            
            $john_interval = $john_bday->diff($today_date);
            $john_diff = $john_interval->format('%a');
            echo "Còn $john_diff ngày nữa là đến sinh nhật</br>";
        }
        catch (Exception $e) {
            echo "Message: " . $e->getMessage();
        }
    }
}


if (!function_exists('cat_table')) {
    function cat_table($cat, $parent_id = 0, $char = "")
    {
            foreach($cat as $key => $val){
                if($val['parent_id'] == $parent_id){
                    echo '
                    <tr>
                        <td>' . $val['id'] . '</td>
                        <td>' . $char.$val['title'] . '</td>
                        <td>' . $val['slug'] . '</td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="sửa" href="' . base_url() . '/manage/category/edit/' . $val['id'] . '" class="text-info"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="xóa" href="' . base_url() . '/manage/category/delete/' . $val['id'] . '" class="text-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    ';
                    unset($cat[$key]);
                    cat_table($cat, $val['id'], $char . '&#9866; ' );
                }
            }
        }
}

if (!function_exists('showCategories')) {
    function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                echo '<option value="' . $item['id'] . '">';
                echo $char . $item['title'];
                echo '</option>';
    
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
    
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item['id'], $char . '— ');
            }
        }
    }
}

if (!function_exists('showCategoriesEdit')) {
function showCategoriesEdit($id, $categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
              if($item['id'] == $id){
                echo '<option value="'.$item['id'].'" selected>';
                    echo $char . $item['title'];
                echo '</option>';
              }else{
                echo '<option value="'.$item['id'].'">';
                    echo $char . $item['title'];
                echo '</option>';
              }
                
                 
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategoriesEdit($id, $categories, $item['id'], $char.'— ');
            }
        }
    }
}
