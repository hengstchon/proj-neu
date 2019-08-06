<?php
echo "(\n";

class Test {
  private $v;
  private $test;
  function getV() {
    return $this->v;
  }
  function setV($value) {
    $a = 'v';
    $this->$a = $value;
  }

/*
  function __call($fun, $args){
    if (substr($fun, 0, 3) == 'get') {
      $var = strtolower(substr($fun, 3, 1)).substr($fun, 4);
      return $this->$var;
    } else if (substr($fun, 0, 3) == 'set') {
      $var = strtolower(substr($fun, 3, 1)).substr($fun, 4);
      $this->$var = $args[0];
    }
  }
*/

  function __set($name, $value) {
    $this->$name = $value;
  }

  function __get($name) {
    return $this->$name;
  }

  function myset($name, $value) {
    $this->$name = $value;
  }
  function myget($name) {
    return $this->$name;
  }
}

$t = new Test();
$t->setV(5);
$o = $t->getV();
$radtxt = 'just test';
$t->myset('test', 666);
echo $t->myget('test');

echo "\n)\n";
?>
