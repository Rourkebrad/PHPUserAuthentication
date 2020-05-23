<?php

function isAuthenticated()
{
  global $session;
  return $session->get('auth_logged_in', false);

}

function saveUserSession($user)
{
  global $session;
  $session->set('auth_logged_in', true);
  $session->set('auth_user_id', (int) $user['id']);

  $session->getFlashBag()->add('success', 'Successfully Logged In');
}

function getAuthenticatedUser()
{
  global $session;
  return findUserByUsername($session->get('auth_user_id'));

}

function requireAuth()
{
  if (!isAuthenticated())
  {
    global $session;
    $session->getFlashBag()->add('error', 'Not authorised to proceed');
    redirect('/login.php');
  }

}


?>
