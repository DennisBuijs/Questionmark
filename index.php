<?php

require_once 'config.php';
require_once 'libs/bootstrap.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/database.php';
require_once 'libs/enquete.php';
require_once 'libs/session.php';
require_once 'libs/hash.php';
require_once 'libs/debug.php';
require_once 'libs/input.php';
require_once 'libs/form.php';
require_once 'libs/Form/val.php';
require_once 'util/auth.php';


$app = new Bootstrap();
$app->init();