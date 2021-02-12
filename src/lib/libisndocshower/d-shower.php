<?php
namespace ISnow\LibDocumentShower;
function lib_init(){
    $_lib["byNs"]["ISnow"]["LibDocumentShower"] = array(
        "versioncode" => 1,
        "versionid" => 1.0,
        "versionstr" => "1.0",
        "depends" => array(
            "Php" => "7.3<=x"
        )
    );
    $_lib["byDir"]["libisndocshower"] =array(
        "versioncode" => 1,
        "versionid" => 1.0,
        "versionstr" => "1.0",
        "depends" => array(
            "Php" => "7.3<=x"
        )
    );
    lib_logger("docshower","libisndocshowerは組み込み関数を正常に終了しました。",ISN_LIB_LOG_INFO,True);
}