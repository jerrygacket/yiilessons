<?php
$db = require __DIR__ . '/db_local.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=localhost;dbname=calendar';

return $db;
