<?php

class Algo
{
    
    
    public function sum($a, $b)
    {
        if ($b == 0) {
            return $a;
        }
        
        return $this->sum($a + 1, $b - 1);
    }
    
    public function max($a, $i, $n)
    {
        if ($n == 1) {
            return $a[0];
        }
        
        return max($a[$i], $this->max($a, $i + 1, $n - 1));
    }
}

///$algo = new Algo();
//echo $algo->sum(5, 6) . "\n";

//$a = [4, 6, 5, 44, 2];
//echo $algo->max($a, 0, count($a)) . "\n";


class Node
{
    public $value;
    public $next;
    
    public function __construct($value)
    {
        $this->value = $value;
    }
    
    public function add(self $node)
    {
        if (!$this->next) {
            $this->next = $node;
        }
    }
}


$head = new Node(10);
$headLeaf = new Node(4);
$head->add($headLeaf);

$headLeafLeaf = new Node(3);
$headLeaf->add($headLeafLeaf);

function showValue($head)
{
    if ($head) {
        echo $head->value . "\n";
        showValue($head->next);
    }
}

//showValue($head);

class MyArray
{
    public array $array = [];
    
    public function __construct(array $array)
    {
        $this->array = $array;
    }
    
    public function getByIndex(int $index): mixed
    {
        return $this->array[$index] ?? false;
    }
    
    public function hasValue(int $value): bool
    {
        return (bool)array_search($value, $this->array);
    }
    
    public function getByValue(int $value)
    {
        $index = array_search($value, $this->array);
        if ($index) {
            return $this->array[$index] ?? false;
        }
        
        return false;
    }
    
    public function insertInt(int $elem): void
    {
        $this->array[] = $elem;
    }
    
    public function size(): int
    {
        return count($this->array);
    }
    
    public function delete($elem): bool
    {
        $index = array_search($elem, $this->array);
        if ($index) {
            unset($this->array[$index]);
            
            return true;
        }
        
        return false;
    }
}

//$j=0;
//$buff = [];
//$buff[$j][]=1;
//$buff[$j][]=1;
//var_dump(array_search(1, $buff[$j])); die;

function getStrWithKLen(string $str, int $k)
{
    $buffer = [];
  
    $strToArr = str_split($str);
    if (strlen($str) === $k && count(array_unique($strToArr)) === $k) {
        return strlen($str);
    }
    $j = 1;
    $countChar = count($strToArr);
    for ($i = 0; $i <= $countChar - 1; $i++) {
        $currLeftSym = $strToArr[$i];
        if (!isset($buffer[$j])) {
            $buffer[$j] = [];
        }
        $buffer[$j][] = $currLeftSym;
        
        if (isset($strToArr[$i+1]) && $currLeftSym == $strToArr[$i+1]) {
            continue;
        }
        
        if (count(array_unique($buffer[$j])) >= $k) {
            $j++;
        }
    }
    
    sort($buffer);
    return count(array_pop($buffer));
}

$s = "abcabcbb";
var_export(getStrWithKLen($s, 2));