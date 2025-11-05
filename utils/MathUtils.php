<?php
class MathUtils {
    public static function mean($values) {
        return array_sum($values) / count($values);
    }

    public static function stdDev($values) {
        $mean = self::mean($values);
        $sumSq = 0;
        foreach ($values as $v) {
            $sumSq += pow($v - $mean, 2);
        }
        return sqrt($sumSq / (count($values) - 1));
    }

    public static function minValue($values) {
        return min($values);
    }

    public static function maxValue($values) {
        return max($values);
    }
}
?>
