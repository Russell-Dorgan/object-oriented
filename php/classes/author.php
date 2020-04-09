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
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function getAuthorId(): Uuid {
		return $this->authorId;
	}

	public function setAuthorId($newAuthorId) {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorId = $uuid;
	}

	public function getAuthorActivationToken(): string {
		return $this->authorActivationToken;
	}

	public function setAuthorActivationToken($newAuthorActivationToken) {
		// verify the tweet content is secure
		$newAuthorActivationToken = trim($newAuthorActivationToken);
		$newAuthorActivationToken = filter_var($newAuthorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// verify the tweet content will fit in the database
		if(strlen($newAuthorActivationToken) > 32) {
			throw(new \RangeException("Author Activation Token Too Long"));
		}

		$this->authorActivationToken = $newAuthorActivationToken;

	}

	public function getAuthorAvatarUrl(): string {
		return $this->authorAvatarUrl;
	}

	public function setAuthorAvatarUrl($newAuthorAvatarUrl) {

		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("Author Activation Token Too Long"));
		}

		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}

	public function setAuthorEmail($newAuthorEmail) {

		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("Author Email is Invalid"));
		}
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Author Email is Invalid "));
		}
		$this->authorEmail = $newAuthorEmail;
	}

	public function getAuthorHash(): string {
		return $this->authorHash;
	}

	public function setAuthorHash($newAuthorHash) {
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = filter_var($newAuthorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("Password is Invalid"));
		}
		if(strlen($newAuthorHash) > 97) {
			throw(new \RangeException("Password is Invalid"));
		}
		$this->authorHash = $newAuthorHash;
	}

	public function getAuthorUsername(): string {
		return $this->authorUsername;
	}

	public function setAuthorUsername($newAuthorUsername) {
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var(newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(strlen($newAuthorUsername) > 255) {
			throw(new \RangeException("Author Username Invalid"));
		}
		$this->authorUsername = $newAuthorUsername;
	}
}

