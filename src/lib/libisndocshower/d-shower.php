<?php
namespace ISnow\LibDocumentShower;
global $sitedata;
$sitedata = array();
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
    $sitedata = json_decode(file_get_contents("./siteinfo.json"),true);
    lib_logger("docshower","libisndocshowerは組み込み関数を正常に終了しました。",ISN_LIB_LOG_INFO,True);
}


function to_wareki($format, $time='now')
{
    // 元号一覧
    $era_list = [
        // 令和(2019年5月1日〜)
        [
            'jp' => '令和', 'jp_abbr' => '令',
            'en' => 'Reiwa', 'en_abbr' => 'R',
            'time' => '20190501'
        ],
        // 平成(1989年1月8日〜)
        [
            'jp' => '平成', 'jp_abbr' => '平',
            'en' => 'Heisei', 'en_abbr' => 'H',
            'time' => '19890108'
        ],
        // 昭和(1926年12月25日〜)
        [
            'jp' => '昭和', 'jp_abbr' => '昭',
            'en' => 'Showa', 'en_abbr' => 'S',
            'time' => '19261225'
        ],
        // 大正(1912年7月30日〜)
        [
            'jp' => '大正', 'jp_abbr' => '大',
            'en' => 'Taisho', 'en_abbr' => 'T',
            'time' => '19120730'
        ],
        // 明治(1873年1月1日〜)
        // ※明治5年以前は旧暦を使用していたため、明治6年以降から対応
        [
            'jp' => '明治', 'jp_abbr' => '明',
            'en' => 'Meiji', 'en_abbr' => 'M',
            'time' => '18730101'
        ],
    ];

    $dt = new \DateTime($time);

    $format_K = '';
    $format_k = '';
    $format_Q = '';
    $format_q = '';
    $format_X = $dt->format('Y');
    $format_x = $dt->format('y');

    foreach ($era_list as $era) {
        $dt_era = new \DateTime($era['time']);
        if ($dt->format('Ymd') >= $dt_era->format('Ymd')) {
            $format_K = $era['jp'];
            $format_k = $era['jp_abbr'];
            $format_Q = $era['en'];
            $format_q = $era['en_abbr'];
            $format_X = sprintf('%02d', $format_x = $dt->format('Y') - $dt_era->format('Y') + 1);
            break;
        }
    }

    $result = '';

    foreach (str_split($format) as $val) {
        // フォーマットが指定されていれば置換する
        if (isset(${"format_{$val}"})) {
            $result .= ${"format_{$val}"};
        } else {
            $result .= $dt->format($val);
        }
    }

    return $result;
}

function getSitedata(){
    global $sitedata;
    return $sitedata;
}

function blogoutput($title,$author,$createtime,$bodydata,$parmlink,$options){
    global $sitedata;
    $blogshower = "ISnow weBlog Shower v1.0 Powered by ISnow Document Shower";
    $options = $options ?? $sitedata["options"] ?? array(
        "colormode" => "#FFAFAF",
        "descriptions" => ""
    );
    $coltheme = $options["colormode"];
    $pagedesc = $options["descriptions"];
    $sitename = $sitedata["site"]["name"];
    $sitecopyright = $sitedata["site"]["copyright"];
    $swname_out = "";
    if ($sitedata["swname"]["out"] == 1){
        $swname_out = $sitedata["swname"]["custom"] ?? "ISnow weBlog Shower v1.0";
    }
    $bodyout = \ISnow\LibweBlogShower\getHtmlFromBBCodeLite($bodydata);
    $cdts = date("Y-M-d",strtotime($createtime));
    $createtimestr = to_wareki("Y(Kx)年n月j日",$createtime);
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
<html lang="ja">
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
        <link rel="canonical" href="$parmlink">
        <link id="mainstyle" name="style-main" rel="stylesheet" href="/css.php?f=main">
        <script id="mainscript" name="script-main" src="/script.php?f=main"></script>
    </head>
    <body>
        <header>
            <a href="/">$sitename</a>
        </header>
        <hr>
        <main>
            <article>
                <section>
                    <h1>$title</h1>
                    <p>
                        <time datetime="$cdts">$createtimestr</time>
                        <address>
                            $author
                        <address>
                    </p>
                </section>
                <hr>
                <section>
                    $bodyout
                </section>
            </article>
        </main>
        <footer>
            <p>
                <small class="copyr">$sitecopyright</small>
            </p>
            $swname_out
        </footer>
    </body>
</html>
__EOF__;
    return $outbuf;
}