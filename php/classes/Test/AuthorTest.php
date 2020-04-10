<?php
namespace RussellDorgan\ObjectOriented\Test;

use RussellDorgan\ObjectOriented\{Author};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

class AuthorTest extends DataDesignTest {

	private $VALID_ACTIVATION_TOKEN; //this will be done in the setup.
	private $VALID_AVATAR_URL = "https://avatar.org";
	private $VALID_AUTHOR_EMAIL = "youremail@email.com";
	private $VALID_AUTHOR_HASH; //this will be done in the setup.
	private $VALID_USERNAME = "your_username";

	public function setUp() : void {
		parent::setUp();

		$password = "your_password";
		$this->VALID_AUTHOR_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);
		$this->VALID_ACTIVATION_TOKEN = bin2hex(random_bytes(16));
	}


	public function testInsertValidAuthor() : void {
		//get count of author records in db before we run the test.
		$numRows = $this->getConnection()->getRowCount("author");

		//insert an author record in the db/
		$authorId = generateUuidV4()->toString();
		$author = new Author($authorId, $this->VALID_ACTIVATION_TOKEN, $this->VALID_AVATAR_URL, $this->VALID_AUTHOR_EMAIL, $this->VALID_AUTHOR_HASH, $this->VALID_USERNAME);
		$author->insert($this->getPDO());


		$numRowsAfterInsert = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 1, $numRowsAfterInsert, "insert checked record count");


	}

	public function testUpdateValidAuthor() : void {

	}

	public function testDeleteValidAuthor() : void {

	}

	public function testGetValidAuthorId() : void {

	}

	public function testGetValidAuthors() : void {

	}
}