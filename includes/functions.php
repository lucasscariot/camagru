<?php
function getUser($mysqli, $id)
{
  $query = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '".$id."'");
  $user = mysqli_fetch_array($query);
  if ($user) {
    return $user;
  }
  return (NULL);
}
