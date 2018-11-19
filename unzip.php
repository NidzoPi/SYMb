<?php

$zip = new ZipArchive;
$res = $zip->open('saznajsve.zip');
if ($res === TRUE) {
  $zip->extractTo('./');
  $zip->close();
  echo 'Extracted!';
} else {
  echo 'Can not open archive!';
}

?>