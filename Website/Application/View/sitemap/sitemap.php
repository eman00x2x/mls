<?php

header("Content-type: text/xml");

$html[] = "<?xml version='1.0' encoding='UTF-8'?>";

$html[] = "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";

$html[] = "<url>";
    $html[] = "<loc>https://www.mlspareb.com/</loc>";
    $html[] = "<changefreq>always</changefreq>";
$html[] = "</url>";

for($i=0; $i<count($data['pages']); $i++) {
    $html[] = "<url>";
        $html[] = "<loc>".rtrim(DOMAIN, "/")."/".$data['pages'][$i]."/</loc>";
    $html[] = "</url>";
}

if($data['listings']) {
    for($i=0; $i<count($data['listings']); $i++) {
        $html[] = "<url>";
            $html[] = "<loc>".rtrim(DOMAIN, "/")."/p-".$data['listings'][$i]['name']."/</loc>";
            $html[] = "<lastmod>".date("Y-m-d", $data['listings'][$i]['modified_at'])."</lastmod>";
            $html[] = "<changefreq>monthly</changefreq>";
            $html[] = "<priority>0.8</priority>";
        $html[] = "</url>";
    }
}

if($data['accounts']) {
    for($i=0; $i<count($data['accounts']); $i++) {

        $account_name = strtolower(sanitize($data['accounts'][$i]['account_name']['firstname']." ".$data['accounts'][$i]['account_name']['lastname']));

        $html[] = "<url>";
            $html[] = "<loc>".rtrim(DOMAIN, "/")."/profile/".$data['accounts'][$i]['account_id']."/$account_name/</loc>";
            $html[] = "<priority>0.5</priority>";
        $html[] = "</url>";
    }
}

if($data['articles']) {
    for($i=0; $i<count($data['articles']); $i++) {
        $html[] = "<url>";
            $html[] = "<loc>".rtrim(DOMAIN, "/")."/articles/".$data['articles'][$i]['name']."/</loc>";
            $html[] = "<priority>0.6</priority>";
        $html[] = "</url>";
    }
}

if($data['open_house']) {
    for($i=0; $i<count($data['open_house']); $i++) {
        $html[] = "<url>";
            $html[] = "<loc>".rtrim(DOMAIN, "/")."/openHouses/".$data['open_house'][$i]['announcement_id']."/</loc>";
            $html[] = "<lastmod>".date("Y-m-d", $data['open_house'][$i]['created_at'])."</lastmod>";
            $html[] = "<changefreq>monthly</changefreq>";
            $html[] = "<priority>0.6</priority>";
        $html[] = "</url>";
    }
}

$html[] = "</urlset>";
