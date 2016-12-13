<?php
class LANG{
    public static $_arr_dictionary=array(); 
    public static function set_dictionnary(){
        self::$_arr_dictionary['add_new']='Thêm mới';
        self::$_arr_dictionary['delete']='Xóa';
        self::$_arr_dictionary['update']='Cập nhật';
        self::$_arr_dictionary['add_new']='Thêm mới';
        self::$_arr_dictionary['new_news']='Tin Mới';
        self::$_arr_dictionary['title']='Trang chủ | Báo điện tử News Live';
        self::$_arr_dictionary['home']='Trang chủ';
        self::$_arr_dictionary['search']='Tìm kiếm';
        self::$_arr_dictionary['image_news']='Tin Ảnh';
        self::$_arr_dictionary['most_view']='Đọc nhiều nhất';
        self::$_arr_dictionary['read_continue']='Đọc thêm';
        self::$_arr_dictionary['continue']='Xem tiếp';
    }
    public static function translate($text_key, $params = array())
    {
        self::set_dictionnary();
        if (!isset(static::$_arr_dictionary[strval($text_key)]))
        {
            trigger_error('Thieu ngon ngu cho ' . $text_key);
            return "[[$text_key]]";
        }
        $string = static::$_arr_dictionary[strval($text_key)];
        $arr_search = array();
        $params = array_values($params);
        for ($i = 0; $i < count($params); $i++)
        {
            $arr_search[] = '$' . ($i + 1);
        }
        return str_replace($arr_search, $params, $string);
    }
    
}
?>
