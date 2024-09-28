<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

const _DATA_DIR = './data';
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    define('_PROTOCOL', 'https://');
}
else {
    define('_PROTOCOL', 'http://');
}

define('_BASE_URL', _PROTOCOL. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/');
