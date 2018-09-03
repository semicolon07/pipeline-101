<?php

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase {
	public $fizzBuzz;
	function setUp(){
		$this->fizzBuzz = new FizzBuzz();
	} 
	function testOneShouldBeSayOne() {
		$actualResult = $this->fizzBuzz->say(1);
		$this->assertEquals("1", $actualResult);
	}
	function testTwoShouldBeSayTwo() {
		$actualResult = $this->fizzBuzz->say(2);
		$this->assertEquals("2", $actualResult);
	}
	function testThreeShouldBeSayFizz() {
		$actualResult = $this->fizzBuzz->say(3);
		$this->assertEquals("Fizz", $actualResult);
	}
	function testFiveShouldBeSayBuzz() {
		$actualResult = $this->fizzBuzz->say(5);
		$this->assertEquals("Buzz", $actualResult);
	}
	function testSixShouldBeSayFizz() {
		$actualResult = $this->fizzBuzz->say(6);
		$this->assertEquals("Fizz", $actualResult);
    }
    function testFifteenShouldBeSayFizzBuzz() {
		$actualResult = $this->fizzBuzz->say(15);
		$this->assertEquals("FizzBuzz", $actualResult);
	}

	function testNegativeShouldBeThrowException() {
		$this->expectException(InvalidArgumentException::class);
		$actualResult = $this->fizzBuzz->say(-1);
		//$this->assertEquals("FizzBuzzz", $actualResult);
	}
}
?>