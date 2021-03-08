<?php
include_once 'src/database/db.php';

$db = new conn();

$db->getConn()->query("insert into users (username, email, pass_hash) values ('admin','admin@admin.com','" .password_hash('admin', PASSWORD_BCRYPT). "')");
header("Location:http://". filter_input(INPUT_SERVER, "SERVER_NAME"));

