<?php
include "math.php";

class RSA {
  //Instancia da classe Math
  private $math;

  private $p;
  private $q;
  private $e;
  private $d;

  function __construct() {
    $this->math = new Math();
  }

  private function checkE($e) {
      return $this->math->mdc( $e, $this->getN() ) === 1;
  }

  private function getN() {
    return $this->p * $this->q;
  }

  private function getZ() {
    return ($this->p - 1) * ($this->q - 1);
  }

  public function setP($p) {
    if(!$this->math->isPrime($p)) {
      throw new ErrorException('O número de P deve ser primo');
    }
    $this->p = $p;
  }

  public function setQ($q) {
    if(!$this->math->isPrime($q)) {
      throw new ErrorException('O número de Q deve ser primo');
    }
    $this->q = $q;
  }

  private function checkD($d) {
    return ($this->e * $d) % $this->getZ() === 1;
  }

  public function setE($e) {
    if(!$this->checkE($e)) {
      throw new ErrorException('MDC(e,n) deve ser igual a 1');
    }
    $this->e = $e;
    for($this->d=2;!$this->checkD($this->d);$this->d++);
  }

  public function getPossibleE() {
    $e = [];
    for($i=5;$i<=$this->getN();$i++)
      if($this->checkE($i))
        $e[] = $i;

    return $e;
  }

  public function encrypt($message) {
    $message = str_split($message);

    $message_array = [];
    foreach ($message as $char) {
      $message_array[] = ord($char);
    }

    $message_crypt_array = [];
    foreach($message_array as $char) {
      $mod = $this->mod($char, $this->e);

      if(strlen($mod) != strlen($this->getN()))
        $mod += $this->getN();

      $message_crypt_array[] = $mod;
    }
    
    return implode("",$message_crypt_array);
  }

  public function decrypt($message) {
    $len_n = strlen($this->getN());
    $message_array = str_split($message, $len_n);

    $message_crypt_array = [];
    foreach($message_array as $char) {
      if(strlen($char) != strlen($this->getN()))
        $char -= $this->getN();

      $mod = $this->mod($char, $this->d);

      $message_crypt_array[] = $mod;
    }
    
    return $this->arrayToMessage($message_crypt_array);
  }

  private function arrayToMessage($messageArray) {
    $message = '';
    foreach ($messageArray as $char) {
      $message .= chr($char);
    }
    return $message;
  }

  private function mod($block, $key) {
    $num_bin = array_reverse(str_split(decbin($key)));
    $bits_on = array_keys($num_bin, '1');

    $r = 1;
    foreach($bits_on as $bit){
      $mod = $block;
      if($bit === 0)
        $pot = gmp_strval(gmp_mod($mod, $this->getN()));

      for($i=0;$i<$bit;$i++) {
        if($i < $bit) {
          $pot = gmp_strval(gmp_pow($mod, 2));
          $mod = gmp_strval(gmp_mod($pot, $this->getN()));
        }
      }

      $r = gmp_strval(gmp_mul($r, $pot));
    }

    return gmp_strval(gmp_mod($r, $this->getN()));
  }

}
