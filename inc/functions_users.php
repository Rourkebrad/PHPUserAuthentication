<?php
//functions for users

function findUserByUsername($username)
  {
    global $db;

    try{
      $query = "SELECT * FROM users WHERE username = :username";
      $query = $db->prepare($query);
      $query->bindParam(':username', $username);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);

    } catch (\Exception $e) {
        throw $e;
    }
  }

  function findUserByUserId($id) {
    global $db;
    try {
        $query = $db->prepare('SELECT * from users where id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (\Exception $e) {
        throw $e;
    }
}

function createUser($username, $password)
  {
    global $db;

    try
    {
      $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
      $query = $db->prepare($query);
      $query->bindParam(':username', $username);
      $query->bindParam(':password', $password);
      $query->execute();
      return findUserByUsername($username);

    } catch (\Exception $e) {
      throw $e;
    }

  }

function updatePassword($password,$userId)
{
  global $db;

  try {
    $query = $db->prepare( 'UPDATE users SET password = :password WHERE id = :userId');
    $query->bindParam(':password', $password);
    $query->bindParam(':userId', $userId);
    $query->execute();
  } catch (\Exception $e) {
    throw $e;
  }
return true;
}



?>
