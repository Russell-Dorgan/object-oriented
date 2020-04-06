<?php
require_once(dirname(__DIR__, 1) . "/classes/Author.php");
// The pdo object has been created for you.
//require_once("/etc/apache2/capstone-mysql/Secrets.php");
//$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/cfiniello.ini");
//$pdo = $secrets->getPdoObject();
use RussellDorgan\ObjectOriented\Author;
$author = new Author(newAuthorId, newAuthorActivationToken, newAuthorAvatarUrl, newAuthorEmail, newauthorHash, newAuthorUsername);
