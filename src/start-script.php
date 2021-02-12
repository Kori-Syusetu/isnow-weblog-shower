<?php
define("ISN_LIB_LOG_DEBUG",0);
define("ISN_LIB_LOG_INFO",1);
define("ISN_LIB_LOG_WARN",2);
define("ISN_LIB_LOG_ERROR",3);
define("ISN_LIB_LOG_FATAL",4);
define("ISN_LIB_LOGBASE", __DIR__ . DIRECTORY_SEPARATOR . "log.d" . DIRECTORY_SEPARATOR . "log-");
define("ISN_LIB_LIBBASE", __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR);
define("DS", DIRECTORY_SEPARATOR);
$_lib = array();
function lib_load($libname){
    lib_logger("libloader","ライブラリ：\"" . $libname . "\"を組み込んでいます。",ISN_LIB_LOG_INFO,True);
    require_once(ISN_LIB_LIBBASE . $libname . DS . "lib_main.loaderscript");
    lib_logger("libloader","ライブラリ：\"" . $libname . "\",バージョン：'" . $_lib["byDir"][$libname]["versionstr"] ."'を組み込みました。",ISN_LIB_LOG_INFO,True);
}
function lib_logger($libname = "libs",$message = "",$msgrank = ISN_LIB_LOG_INFO,$isgloballog = false,$nowtime = time()){
    switch ($msgrank) {
        case ISN_LIB_LOG_DEBUG:
            $ranktxt = "デバッグ";
            break;
        case ISN_LIB_LOG_INFO:
            $ranktxt = "情報";
            break;
        case ISN_LIB_LOG_WARN:
            $ranktxt = "警告";
            break;
        case ISN_LIB_LOG_ERROR:
            $ranktxt = "エラー";
            break;
        case ISN_LIB_LOG_FATAL:
            $ranktxt = "致命的";
            break;
        
        default:
            $ranktxt = "情報";
            break;
    }
    if (!file_exists(ISN_LIB_LOGBASE . date("Y-M-d-",$nowtime) . $libname . ".log")){
        file_put_contents(ISN_LIB_LOGBASE . date("Y-M-d-",$nowtime) . $libname . ".log" ,hex2bin("EFBBBF"));
    }
    file_put_contents(ISN_LIB_LOGBASE . date("Y-M-d-",$nowtime) . $libname . ".log" ,"[" . $ranktxt . date(":Y-M-d_H-i-s:",$nowtime) . $libname . "]" . $message . "\n",FILE_APPEND);
    if ($isgloballog){
        if (!file_exists(ISN_LIB_LOGBASE . "global" . ".log")){
            file_put_contents(ISN_LIB_LOGBASE . "global" . ".log",hex2bin("EFBBBF"));
        }
        file_put_contents(ISN_LIB_LOGBASE . "global" . ".log","[" . $ranktxt . date(":Y-M-d_H-i-s:",$nowtime) . $libname . "]" . $message . "\n",FILE_APPEND);
    }
}

lib_load("");