<?php

require_once 'config/configuration.php';

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'models/UserModel.php';

spl_autoload_register(function ($className) {
  require_once 'core/' . $className . '.php';
});
