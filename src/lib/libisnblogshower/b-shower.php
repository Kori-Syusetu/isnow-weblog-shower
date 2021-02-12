<?php
namespace ISnow\LibweBlogShower;
function lib_init(){
    $_lib["ISnow"]["LibweBlogShower"] = array(
        "versioncode" => 1,
        "versionid" => 1.0,
        "versionstr" => "1.0",
        "depends" => array(
            "Php" => "7.3<=x",
            "ISnow\LibDocumentShower" => "1.0<=x<2.0"
        )
    );
}