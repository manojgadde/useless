<?php
if (@$_REQUEST["c"]!="")
{
 if (strpos(@$_REQUEST["c"],"/")==0)
  $url = getlink("https://youtube.com/" . 'results?search_query=' . str_replace(" ","+", @$_REQUEST["c"]));
 else
  $url = getlink("https://youtube.com/" . @$_REQUEST["c"]);
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/vnd.apple.mpegurl");
 header("Access-Control-Allow-Origin: *");
 header('Content-Type: video/mp2t');
 header("Location: $url");
 header('Location: ' . $url);
}
function getlink($url)
{
 header("Content-Type: text/plain");
 $page=file_get_contents($url);
 $str = '"url":"/watch?v=';
 $url = "https://www.youtube.com/" . str_replace('\\', '', substr($page, strpos($page, $str) + 8, strlen('watch?v=9Auq9mYxFEE')));
 $page = file_get_contents($url); 
 //die ($page);
 $str= strpos($page,'https://manifest.googlevideo.com/api/manifest/hls_variant/');
 $url = str_replace('\\','',substr($page,strpos($page,'https://manifest.googlevideo.com/api/manifest/hls_variant/'),4+strpos($page,'m3u')-strpos($page,'https://manifest.googlevideo.com/api/manifest/hls_variant/')));
 if(isset($_GET['q']))
 {
  $page = file_get_contents($url); 
  //header("Content-Type: text/plain");
  $page = file_get_contents($url);
  $str1= @$_REQUEST["q"] . ',FRAME-RATE=30,CLOSED-CAPTIONS=NONE';
  $str2="m3u8";
  if (strpos($page,$str1)>0)
  $url=substr($page,strpos($page,$str1)+strlen($str1)+1,strlen($str2)+strpos($page,$str2,strpos($page,$str1)+strlen($str1)+1)-strpos($page,$str1)-strlen($str1));
 }
  return $url;
}
?>
