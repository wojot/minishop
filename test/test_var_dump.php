<?php

class Student
{
    var $imie;
    var $nazwisko;

    function __construct($imie, $nazwisko)
    {
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
    }

    function getImie()
    {
        return $this->imie;
    }

    function getNazwisko()
    {
        return $this->nazwisko;
    }

    function display()
    {
        return $this->imie . " " . $this->nazwisko;
    }

}


$osoby = array(new Student("biorgul", "nowak"), new Student("drugibiorgul", "nowak2"));


foreach ($osoby as $osoba){
    echo $osoba->display().var_dump($osoba)."<br>";
}