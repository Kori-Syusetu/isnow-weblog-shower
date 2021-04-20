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
function getBlogdata($articleid){
    if (file_exists("../../data/blog/" . $articleid . ".bbcodelite")){
        return file_get_contents("../../data/blog/" . $articleid . ".bbcodelite");
    }else{
        return "[h2]記事は見つかりませんでした[/h2]\n存在しない記事ではないかもう一度お確かめくださいませ。";
    }
}

function getBloginfo($articleid){
    if (file_exists("../../data/blog/" . $articleid . ".blogshowerinfo")){
        return file_get_contents("../../data/blog/" . $articleid . ".blogshowerinfo");
    }else{
        return array("title" => "404 Not Found","author" => "System","createdate" => time(),"parmlink" => "","options" => array("colormode" => "#FFAFAF","descriptions" => "記事を見つけることができませんでした。"));
    }
}

function getHtmlFromBBCodeLite($bbcode){
    $retval = htmlspecialchars($bbcode,ENT_HTML5 | ENT_NOQUOTES);
    $retval = str_replace(array("\r\n","\r","\n"),"\n",$retval);
    $retvala = explode("\n",$retval);
    $retval = "";
    foreach ($retvala as $value) {
        $retval .= "<p>";
        $retval .= $value;
        $retval .= "</p>";
    }
    return preg_replace(
        "/\\[b](.*?)\\[\\/b]/",
        "<spab style=\"font-weight: bold\">\1</span>",
        preg_replace(
            "/\\[size=([0-9]+?)](.*?)\\[\\/size]/",
            "<span style=\"font-size: \1px\">\2</span>",
            preg_replace(
                "/\\[h([1-6]{1})](.*?)\\[\\/h[1-6]]/",
                "<h\1>\2</h\1>",
                str_replace(
                    "[br]",
                    "<br>",
                    $bbcode
                )
            )
        )
    );
}