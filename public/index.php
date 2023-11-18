<?php

use App\RMVC\App;
use App\RMVC\DB\DB;

session_start();

require "../vendor/autoload.php";
require "../routes/web.php";

DB::start();
App::run();