<?php

class Author {
	private $authorId;
	private $authorActivationToken;
	private $authorAvatarUrl;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {

	}

	public function getAuthorId(){
	return $this->authorId;
	}
	public function setAuthorId($newAuthorId){
		$this->authorId = $newAuthorId;
	}

}

