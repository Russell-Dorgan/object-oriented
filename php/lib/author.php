<?php
namespace RussellDorgan\ObjectOriented;
require_once(dirname(__DIR__, 1) . "/classes/Author.php");


$authorId = "1f08aa8b-2169-4c19-a260-b9e80cad9234";
$authorActivationToken = bin2hex(random_bytes(16));
$authorAvatarUrl = "https://img.img.com/img";
$authorEmail = "RussellDorgan@email.com";
$authorHash = password_hash("password", PASSWORD_ARGON2ID, ["time_cost" => 9]);
$authorUsername = "Russell Dorgan";

$russell = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);
echo $russell->getAuthorId() . " ***** ";
echo $russell->getAuthorActivationToken() . " ***** ";
echo $russell->getAuthorAvatarUrl() . " ***** ";
echo $russell->getAuthorEmail() . " ***** ";
echo $russell->getAuthorHash() . " ***** ";
echo $russell->getAuthorUsername();


