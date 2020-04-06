<?php
namespace RussellDorgan\ObjectOriented;
class Author {
	private $authorId;
	private $authorActivationToken;
	private $authorAvatarUrl;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		$this->setAuthorId($newAuthorId);
		$this->setAuthorActivationToken($newAuthorActivationToken);
		$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
		$this->setAuthorEmail($newAuthorEmail);
		$this->setAuthorHash($newAuthorHash);
		$this->setAuthorUsername($newAuthorUsername);

	}

		public function getAuthorId(){
			return $this->authorId;
		}
		public function setAuthorId($newAuthorId){
			$this->authorId = $newAuthorId;
		}
		public function getAuthorActivationToken(){
			return $this->authorActivationToken;
		}
		public function setAuthorActivationToken($newAuthorActivationToken){
			$this->authorActivationToken = $newAuthorActivationToken;
		}
		public function getAuthorAvatarUrl(){
			return $this->authorAvatarUrl;
		}
		public function setAuthorAvatarUrl($newAuthorAvatarUrl){
			$this->authorAvatarUrl = $newAuthorAvatarUrl;
		}
		public function getAuthorEmail(){
			return $this->authorEmail;
		}
		public function setAuthorEmail($newAuthorEmail){
			$this->authorEmail = $newAuthorEmail;
		}
		public function getAuthorHash(){
			return $this->authorHash;
		}
		public function setAuthorHash($newAuthorHash){
			$this->authorHash = $newAuthorHash;
		}
		public function getAuthorUsername(){
			return $this->authorUsername;
		}
		public function setAuthorUsername($newAuthorUsername){
			$this->authorUsername = $newAuthorUsername;
		}

}
