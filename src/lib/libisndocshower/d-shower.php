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
function blogoutput($title,$author,$createtime,$bodydata,$parmlink,$options){
    $blogshower = "ISnow Blog Shower v1.0 Powered by ISnow Document Shower";
    $coltheme = $options["colormode"];
    $pagedesc = $options["descriptions"];
    $metatags = "";
    foreach ($options["addmeta"] as $metavalues) {
        $metatags .= "        <meta";
        foreach ($metavalues as $attrname => $attrvalue) {
            $metatags .= " ";
            $metatags .= $attrname;
            $metatags .= "=\"";
            $metatags .= $attrvalue;
            $metatags .= "\"";
        }
        $metatags .= ">\n";
    }
    $outbuf = <<< __EOF__
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="generator" content="$blogshower">
        <meta name="author" content="$author">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta name="color-scheme" content="$coltheme">
        <meta name="descriptions" content="$pagedesc">
        <!-- 追加のMETA要素 -->
        $metatags
        <title>$title</title>
        <link rel="canonical" content="$parmlink">

    </head>
    <body>
    </body>
</html>
__EOF__;
    return $outbuf;
}