<?php
namespace ISnow\LibweBlogShower;
function lib_init(){
    $_lib["byNs"]["ISnow"]["LibweBlogShower"] = array(
        "versioncode" => 1,
        "versionid" => 1.0,
        "versionstr" => "1.0",
        "depends" => array(
            "Php" => "7.3<=x",
            "ISnow\LibDocumentShower" => "1.0<=x<2.0"
        )
    );
    $_lib["byDir"]["libisnblogshower"] =array(
        "versioncode" => 1,
        "versionid" => 1.0,
        "versionstr" => "1.0",
        "depends" => array(
            "Php" => "7.3<=x",
            "ISnow\LibDocumentShower" => "1.0<=x<2.0"
        )
    );
    lib_logger("blogshower","libisnblogshowerは組み込み関数を正常に終了しました。",ISN_LIB_LOG_INFO,True);
}