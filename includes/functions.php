<?php
//
function redirect($path='') {
    header(("Location: ".$path));
    exit;
}
//
function getUrl($path='') {
    $protocol = 'http://';
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
        $protocol = 'https://';
    }

    $result = $protocol.$_SERVER['HTTP_HOST'];
    if (!empty($_SERVER['PHP_SELF'])) {
        $result .= dirname($_SERVER['PHP_SELF']);
    }
    if (!empty($path)) {
        if (strstr($path, 'path')==Null) {
            $result .= '?path='.$path;
        }
        $result .= $path;
    }
    return $result;
}