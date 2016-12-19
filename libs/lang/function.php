<?php
 function __($text_key, $params = array())
    {
        LANG::set_dictionnary();
        if (!isset(LANG::$_arr_dictionary[strval($text_key)]))
        {
            trigger_error('Thieu ngon ngu cho ' . $text_key);
            return "[[$text_key]]";
        }
        $string = LANG::$_arr_dictionary[strval($text_key)];
        $arr_search = array();
        $params = array_values($params);
        for ($i = 0; $i < count($params); $i++)
        {
            $arr_search[] = '$' . ($i + 1);
        }
        return str_replace($arr_search, $params, $string);
    }
?>
