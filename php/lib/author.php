<?php
namespace RussellDorgan\ObjectOriented;
require_once(dirname(__DIR__, 1) . "/classes/Author.php");


// The pdo object has been created for you.
//require_once("/etc/apache2/capstone-mysql/Secrets.php");
//$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/cfiniello.ini");
//$pdo = $secrets->getPdoObject();
use RussellDorgan\ObjectOriented\Author;
$authorId = "006fb097-31bf-4ead-95a6-717c46e1c7f6";
$authorActivationCode = "the_NEW_activation_code";
$authorAvatarUrl = "https://avatar.org";
$authorEmail = "myfakeemail@somewhere.com";
$authorHash = "a_super_hash";
$authorUsername = "thenewusername3";
$author =  new Author($authorId, $authorActivationCode, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

//var_dump($author->getAuthorHash());
echo "<h2>" . $author->getAuthorEmail() . "</h2>";
