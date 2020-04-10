<?php

namespace RussellDorgan\ObjectOriented;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class Author implements \JsonSerializable {
	use ValidateUuid;
	private $authorId;
	private $authorActivationToken;
	private $authorAvatarUrl;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	public function __construct($newAuthorId, string $newAuthorActivationToken, ?string $newAuthorAvatarUrl, string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {

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

	public function setAuthorId($newAuthorId): void {
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

	public function setAuthorActivationToken($newAuthorActivationToken): void {

		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}

		try {
			$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
			if(ctype_xdigit($newAuthorActivationToken) === false) {
				throw(new\RangeException("author activation is not valid"));
			}
			$newAuthorActivationToken = filter_var($newAuthorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		if(strlen($newAuthorActivationToken) > 32) {
			throw(new \RangeException("author activation token has to be 32 characters"));
		}

		$this->authorActivationToken = $newAuthorActivationToken;

	}

	public function getAuthorAvatarUrl(): string {
		return $this->authorAvatarUrl;
	}

	public function setAuthorAvatarUrl(?string $newAuthorAvatarUrl): void {

		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		try {
			if(strlen($newAuthorAvatarUrl) > 255) {
				throw(new \RangeException("Avatar URL too long"));
			}
			}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}

	public function setAuthorEmail($newAuthorEmail): void {

		try {
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("Author Email is Invalid"));
		}
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Author Email is Invalid "));
		}
		}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorEmail = $newAuthorEmail;
	}

	public function getAuthorHash(): string {
		return $this->authorHash;
	}

	public function setAuthorHash(string $newAuthorHash): void {

		try {
			$newAuthorHash = trim($newAuthorHash);
			$newAuthorHash = filter_var($newAuthorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newAuthorHash) === true) {
				throw(new \InvalidArgumentException("author password hash empty"));
			}

			$authorHashInfo = password_get_info($newAuthorHash);
			if($authorHashInfo["algoName"] !== "argon2id") {
				throw(new \InvalidArgumentException("author hash is not a valid hash"));
			}
			if(strlen($newAuthorHash) > 97) {
				throw(new \RangeException("Author hash is too long"));
			}
			}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorHash = $newAuthorHash;
	}

	public function getAuthorUsername(): string {
		return $this->authorUsername;
	}

	public function setAuthorUsername($newAuthorUsername): void {

		try {
			$newAuthorUsername = trim($newAuthorUsername);
			$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newAuthorUsername) === true) {
				throw(new \RangeException("username is empty or insecure"));
			}
			if(strlen($newAuthorUsername) > 32) {
				throw(new \RangeException("username must be 32 characters or less"));
			}
			}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorUsername = $newAuthorUsername;
	}

	public function insert(\PDO $pdo) : void {
		$query = "INSERT INTO author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES (:authorId, :authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId"=>$this->authorId->getBytes(), "authorActivationToken"=>$this->authorActivationToken, "authorAvatarUrl"=>$this->authorAvatarUrl, "authorEmail"=>$this->authorEmail, "authorHash"=>$this->authorHash, "authorUsername"=>$this->authorUsername];
		$statement->execute($parameters);
		}

		public function delete(\PDO $pdo) : void {

			$query = "DELETE FROM author WHERE authorId = authorId";
			$statement = $pdo->prepare($query);

			$parameters = ["authorId" => $this->authorId->getBytes()];
			$statement->execute($parameters);
		}

	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE author SET (authorActivationToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = authorUsername) WHERE authorId = author Id";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId"=>$this->authorId->getBytes(), "authorActivationToken"=>$this->authorActivationToken, "authorAvatarUrl"=>$this->authorAvatarUrl, "authorEmail"=>$this->authorEmail, "authorHash"=>$this->authorHash, "authorUsername"=>$this->authorUsername];
		$statement->execute($parameters);
	}











	public static function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?Author {

		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the tweet id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);


		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$author = newAuthor($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($author);
	}





















	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["authorId"] = $this->authorId->toString();
		unset($fields["authorActivationToken"]);
		unset($fields["authorHash"]);
		return ($fields);
	}

}

