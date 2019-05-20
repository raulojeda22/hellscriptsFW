<?php

include_once dirname(__FILE__).'/../../../../vendor/autoload.php';

use Auth0\SDK\Auth0;

$auth0 = new Auth0([
  'domain' => 'raulojeda.eu.auth0.com',
  'responseMode' => 'form_post',
  'client_id' => '0qDeBksiQ6DMDWfISnE5cyvuTp4Ftynz',
  'client_secret' => file_get_contents(dirname(__FILE__).'/../../../../auth0ApiSecretKey.txt'),
  'redirect_uri' => 'http://localhost/hellscriptsFW/www/modules/auth0callback/model/auth0callback.php',
  'scope' => 'openid profile email offline_access',
  'audience' => 'https://raulojeda.eu.auth0.com/userinfo',
  'persist_id_token' => true,
  'persist_access_token' => true,
  'persist_refresh_token' => true,
]);

$auth0->login();
