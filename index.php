<?php
session_start();

require_once(__DIR__."/Config/Autoloader.php");

Autoloader::charger();

new FrontController();





