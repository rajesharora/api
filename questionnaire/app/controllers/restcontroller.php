<?php
error_reporting(E_ALL & ~E_NOTICE);

abstract class RestController extends Controller
{    
    private function getRequestHeaders()
    {
        $arh = array();
        $rx_http = '/\HTTP_/';

        foreach ($_SERVER as $key => $val) {
            if (preg_match($rx_http, $key)) {
                $arh_key = preg_replace($rx_http, '', $key);

                $rx_matches = explode('_', $arh_key);

                if (count($rx_matches) > 0 and strlen($arh_key) > 2) {
                    foreach ($rx_matches as $ak_key => $ak_val) {
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    }

                    $arh_key = implode('-', $rx_matches);
                }

                $arh[strtolower($arh_key)] = $val;
            }
        }
        return ($arh);
    }
}   
?>
    
