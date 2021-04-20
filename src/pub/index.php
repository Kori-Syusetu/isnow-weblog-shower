<?php
require_once "../start-script.php";
if (empty($_GET["id"])){
    $si = ISnow\LibDocumentShower\getSitedata();
    $swname_out = "";
    if ($si["swname"]["out"] == 1){
        $swname_out = $si["swname"]["custom"] ?? "ISnow weBlog Shower v1.0";
    }
    $json = json_decode(file_get_contents("../data/bloglist",true));
    $bodyout = "";
    $l = 0;
    $bodyout .= "Page " . $_GET["pg"] ?? "1";
    for ($i=1 * intval($_GET["pg"] ?? "1"); $i <= count($json); $i++) { 
        $bodyout .= "<div><h3><a href=\"/?id=";
        $bodyout .= $json[$i-1]["id"];
        $bodyout .= "\">";
        $bodyout .= $json[$i-1]["title"];
        $bodyout .= "</a></h3><p>";
        $bodyout .= $json[$i-1]["desc"];
        $bodyout .= "</p></div>";
        $l++;
        if ($l == 9){
        break;
        }
    }
    $bodyout .= "<div>";
    for ($i=1; $i <= ceil(count($json) / (intval($_GET["pg"] ?? "1") * 10)); $i++) { 
        if ($i == intval($_GET["pg"] ?? "0")){
            $bodyout .= "<a>";
            $bodyout .= $i;
            $bodyout .= "</a>";
        }else{
            $bodyout .= "<a href=\"/?pg=";
            $bodyout .= $i;
            $bodyout .= "\">";
            $bodyout .= $i;
            $bodyout .= "</a>";
        }
    }
    $bodyout .= "</div>";
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="generator" content="ISnow weBlog Shower v1.0 Powered by ISnow Document Shower">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <title><?=$si["site"]["name"]?></title>
        <link rel="canonical" href="https://<?=$si["site"]["hostname"]?>/">
        <link id="mainstyle" name="style-main" rel="stylesheet" href="/css.php?f=main">
        <script id="mainscript" name="script-main" src="/script.php?f=main"></script>
    </head>
    <body>
        <header>
            <?=$si["site"]["name"]?>
        </header>
        <hr>
        <main>
            <article>
                <section>
                    <h1>記事LIST</h1>
                </section>
                <hr>
                <section>
                    <?=$bodyout?>
                </section>
            </article>
        </main>
        <footer>
            <p>
                <small class="copyr"><?=$si["site"]["copyright"]?></small>
            </p>
            <?=$swname_out?>
        </footer>
    </body>
</html>
<?php
}else{
?>
<?php
}