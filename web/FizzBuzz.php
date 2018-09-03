<?php
class FizzBuzz {
	
	public function say( $numberTo ) {
		$sayWord = $numberTo;
		if($this->divideByThree($numberTo)){
			$sayWord = "Fizz";
		}
		if($this->divideByFive($numberTo)){
			$sayWord = "Buzz";
		}
		if($this->divideByThreeAndFive($numberTo)){
			$sayWord = "FizzBuzz";
		}

		return $sayWord;
	}
	public function divideByThree ($numberTo){
		return $numberTo % 3 == 0;
	}
	public function divideByFive ($numberTo){
		return $numberTo % 5 == 0;
	}

	public function divideByThreeAndFive ($numberTo){
		return $this->divideByThree($numberTo) && $this->divideByFive($numberTo); 
	}
}	
?>