<?php

class steal_Model extends Model {
    function steal_news() {
        $this->db->debug=1;
        $url = "http://dantri.com.vn/su-kien.htm"; // URL to POST FORM.
        $ch = curl_init(); // Initialize a CURL session.     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.
        curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
        $result = curl_exec($ch);  // grab URL and pass it to the variable.
        curl_close($ch);  // close curl resource, and free up system resources.
//echo $result; // Print page contents.
        $pattem = "/<h2>(.*)<a(.*)>(.*)<\/a>(.*?)<\/h2>/";
        preg_match_all($pattem, $result, $a_matches);
        $pattem_href = "/href=\"(.*?)\"/";
        $pattem_title = "/<h1 class=\"fon31 mt2\">(.*?)<\/h1>/s";
        $pattem_short_content = "/<h2 class=\"fon33 mt1\">(.*?)<\/h2>/s";
        $pattem_short_content_no_a = "/(.*?)<br>/s";

        $pattem_content = "/<div class=\"fon34 mt3 mr2 fon43\">(.*?)<\/div>/s";
        $pattem_content_no_table = "/<\/TABLE>(.*)/s";
        $pattem_content_no_extend = "/(.*)/s";
        foreach ($a_matches[0] as $v_tag_a) {
            preg_match_all($pattem_href, $v_tag_a, $link);
            $url_item = ('http://dantri.com.vn' . $link[1][0]);
            $ch_item = curl_init();
            curl_setopt($ch_item, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.
            curl_setopt($ch_item, CURLOPT_URL, $url_item);  // Pass URL as parameter.
            $result_item = curl_exec($ch_item);  // grab URL and pass it to the variable.
//    $result_item='<h1 class="fon31 mt2">
//        Luật sư trình chứng cứ gỡ tội tham ô cho Dương Chí Dũng </h1>';
            preg_match($pattem_title, $result_item, $title);

            preg_match($pattem_short_content, $result_item, $short_content);
            $abccc = $short_content[1];
            $is_br = preg_match($pattem_short_content_no_a, $abccc, $short_content_no_a);
            if ($is_br == true) {
                //  var_dump($short_content_no_a[1]);
                $v_short_content = $short_content_no_a[1];
            } else {
                //  var_dump($short_content[1]);
                $v_short_content = $short_content[1];
            }
            //xu ly content

            preg_match($pattem_content, $result_item, $content);
            //kiem tra xem co table hay ko
            if (preg_match($pattem_content_no_table, $content[1], $content_no_table)) {
                preg_match($pattem_content_no_extend, $content_no_table[1], $content_no_extend);
                $v_content = $content_no_extend[1];
            } else {
                $v_content = ($content[1]);
            }
            $arr_data=array(
                'C_TITLE'=>$title[1],
                'C_SHORT_CONTENT'=>$v_short_content,
                'C_CONTENT'=>$v_content,
                'FK_TYPE'=>4,
                'C_LANG'=>'vi',
                
            );
            
           // $sql = "INSERT INTO t_cms_news(C_TITLE,C_SHORT_CONTENT,C_CONTENT) values('$title[1]','$v_short_content','$v_content')";
          //  var_dump($sql);
          //  mysql_query($sql);
            
            $this->db->AutoExecute('t_cms_news', $arr_data);
            $lastest_news_id=$this->db->GetOne('selec max(PK_NEWS) from t_cms_news');
            $arr_data_cate=array(
                'FK_NEWS'=>$lastest_news_id,
                'FK_CATE'=>7
            );
            //echo $result_item;
            echo '<hr/>';
            //  break;
        }
        curl_close($ch_item);
    }

}

?>
