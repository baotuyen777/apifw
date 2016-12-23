<?php
class LANG {

    public static $_dictionary = array();

    public static function set_dictionnary() {
        self::$_dictionary = array(
            /** message */
            "IdNotFound" => "not found or deactive"
        );
    }

    public static function __($text_key, $params = array()) {
        self::set_dictionnary();
        if (!isset(static::$_dictionary[strval($text_key)])) {
            trigger_error('Thieu ngon ngu cho ' . $text_key);
            return "[[$text_key]]";
        }
        $string = static::$_dictionary[strval($text_key)];
        $arr_search = array();
        $params = array_values($params);
        for ($i = 0; $i < count($params); $i++) {
            $arr_search[] = '$' . ($i + 1);
        }
        return str_replace($arr_search, $params, $string);
    }

}

?>
