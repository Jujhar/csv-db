<?php

// CONFIG
$path = 'name.txt'; // file path

// values = load (10), add (26), list (34), last (41)
$action = filter_var($_GET['action']);
$values = filter_var($_GET['values']);

// display file data
if ($action == 'load' || $action == 'read' || $action == 'list') {
  $row = 1;
  if (($handle = fopen($path, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);
          echo "<hr>\n";
          $row++;
          for ($c=0; $c < $num; $c++) {
              echo $data[$c] . "<br />\n";
          }
      }
      fclose($handle);
  }
}

// add row
else if ($action == 'add' || $action == 'new') {
  $fp = fopen($path, 'a');
  echo $values . "<br> Added";
  fputcsv($fp, explode(",", $values));
  fclose($fp);
}

// list url of csv output
else if ($action == 'path' || $action == 'dir') {
   $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $url = explode("main.php", $url);
   echo $url[0] . $path;
}

// get last row
else if ($action == 'last' || $action == 'end') {
  $row = 1;
  $last = '';
  if (($handle = fopen($path, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);
          $row++;
          for ($c=0; $c < $num; $c++) {
              $last = $data[$c] . "<br />\n";
          }
      }
      fclose($handle);
  }
  echo $last;
}

else {
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("main.php", $url);
  echo $url[0] . "readme.md";
}
//add row (unique)
//TODO check if row there
?>
