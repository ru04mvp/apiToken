<?php
/**
 *  檢查碼
 */
class Apitoken {

    function __construct() {
    }

    static function generate($arParameters = array(), $HashToken = '') {
        $sMacValue = '';
        if (isset($arParameters)) {
            unset($arParameters['CheckMacValue']);

            // echo '<br>' . "######### 起始加密作業..." . '<br>';

            // 組合字串
            $sMacValue = 'HashToken=' . $HashToken;

            //
            foreach ($arParameters as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $rowIndex => $row) {
                        $sMacValue .= '&' . $rowIndex . '=' . $row;
                    }
                } else {
                    $sMacValue .= '&' . $key . '=' . $value;
                }
            }

            // echo "---> 組合字串: " . '<br>' . $sMacValue . '<br>';

            // URL Encode編碼
            $sMacValue = urlencode($sMacValue);
            // echo "---> URL Encode編碼: " . '<br>' . $sMacValue . '<br>';

            // 轉成小寫
            $sMacValue = strtolower($sMacValue);
            // echo "---> 轉成小寫: " . '<br>' . $sMacValue . '<br>';

            // 取代為與 dotNet 相符的字元
            $sMacValue = str_replace('%2d', '-', $sMacValue);
            $sMacValue = str_replace('%5f', '_', $sMacValue);
            $sMacValue = str_replace('%2e', '.', $sMacValue);
            $sMacValue = str_replace('%21', '!', $sMacValue);
            $sMacValue = str_replace('%2a', '*', $sMacValue);
            $sMacValue = str_replace('%28', '(', $sMacValue);
            $sMacValue = str_replace('%29', ')', $sMacValue);
            // echo "---> 取代為與 dotNet 相符的字元: " . '<br>' . $sMacValue . '<br>';

            // MD5 編碼
            $sMacValue = md5($sMacValue);
            $sMacValue = strtoupper($sMacValue);
            // echo "---> MD5 編碼: " . '<br>' . $sMacValue . '<br>';

            // echo "######### 加密作業結束..." . '<br>' . '<br>';

        }
        return $sMacValue;
    }
}
