<?php
class LANG{
    public static $_arr_dictionary=array(); 
    public static function set_dictionnary(){
        self::$_arr_dictionary['add_new']='Add new';
        self::$_arr_dictionary['delete']='Delete';
        self::$_arr_dictionary['update']='Update';
       // self::$_arr_dictionary['']='Thêm mớ';
        self::$_arr_dictionary['new_news']='New News';
        self::$_arr_dictionary['title']='Home | News Live Electronic';
        self::$_arr_dictionary['home']='Home';
        self::$_arr_dictionary['search']='Search';
        self::$_arr_dictionary['image_news']='Image News';
        self::$_arr_dictionary['most_view']='Most Views';
        self::$_arr_dictionary['read_continue']='Read';
        self::$_arr_dictionary['continue']='Continue';
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
