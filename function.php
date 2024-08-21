<?php
function alertAndGoTo($msg, $url){
  echo "<script>
    alert(\"$msg\");
    window.location.href = \"$url\";
  </script>";
}
?>