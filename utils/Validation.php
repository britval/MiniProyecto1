<?php
class Validation {
    public static function sanitizeInput($data) {
        return htmlspecialchars(trim($data));
    }

    public static function isNumeric($value) {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    public static function isPositive($value) {
        return self::isNumeric($value) && $value > 0;
    }
}
?>  
