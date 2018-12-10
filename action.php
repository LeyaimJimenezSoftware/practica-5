<?php
if (isset($_POST['token'])) {
  $token = $_POST['token'];

  $link = mysqli_connect('localhost', 'root', '','notificaciones');
  if (!$link) {
    die('Could not connect: ' . mysqli_error());
  }
  echo 'Connected successfully';
  //mysqli_select_db("notificaciones")or die (mysqli_error());

  $result = mysqli_query($link, "INSERT INTO push(token, fecha) VALUES('$token', now())");
  if (!$result) {
    die('error: ' . mysqli_error());
  }else
    echo('token guardado');

  mysqli_close($link);
}
?>