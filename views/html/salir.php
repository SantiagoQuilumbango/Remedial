<?php
require_once('../../config/sesiones.php');
session_destroy();
header('Location:../../index.php');
exit();
