<?php
namespace RussellDorgan\ObjectOriented;
require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;
class Author {
	use ValidateUuid;
	private $authorId;
	private $authorActivationToken;
	private $authorAvatarUrl;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {

		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

		public function getAuthorId() : Uuid {
			return $this->authorId;
		}
		public function setAuthorId($newAuthorId){
			try {
				$uuid = self::validateUuid($newAuthorId);
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			$this->authorId = $uuid;
		}
		public function getAuthorActivationToken() : string {
			return $this->authorActivationToken;
		}
		public function setAuthorActivationToken($newAuthorActivationToken){
			$this->authorActivationToken = $newAuthorActivationToken;
		}
		public function getAuthorAvatarUrl() : string {
			return $this->authorAvatarUrl;
		}
		public function setAuthorAvatarUrl($newAuthorAvatarUrl){
			$this->authorAvatarUrl = $newAuthorAvatarUrl;
		}
		public function getAuthorEmail() : string {
			return $this->authorEmail;
		}
		public function setAuthorEmail($newAuthorEmail){
			$this->authorEmail = $newAuthorEmail;
		}
		public function getAuthorHash() : string {
			return $this->authorHash;
		}
		public function setAuthorHash($newAuthorHash){
			$this->authorHash = $newAuthorHash;
		}
		public function getAuthorUsername() : string {
			return $this->authorUsername;
		}
		public function setAuthorUsername($newAuthorUsername){
			$this->authorUsername = $newAuthorUsername;
		}

}
