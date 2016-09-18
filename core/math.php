<?php
class Math {

  public function isPrime($number) {
    for($i=2;$i<=$number;$i++) {
      if($number == $i)
        return true;
      else if( $number % $i === 0 )
        return false;
    }
  }

  public function getPrimes($min = 2, $max = 1000) {
    $primes = [];
    while ($min <= $max) {
      if($this->isPrime($min)) {
        $primes[] = $min;
      }
      $min++;
    }
    return $primes;
  }

  public function mdc($num1, $num2){
  	$a = max($num1, $num2);
  	$b = min($num1, $num2);
  	if($a % $b == 0)
  		return $b;
  	else
  		return $this->mdc( $b,($a % $b) );
  }

}
