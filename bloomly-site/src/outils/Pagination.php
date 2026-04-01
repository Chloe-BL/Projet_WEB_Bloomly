<?php

class Pagination 
{
    private array $items;
    private int $parPage;
    private int $page;

    public function __construct(array $items, int $parPage, int $page){ 
        $this -> items = $items;
        $this -> parPage = $parPage;
        if ($page < 1) {  // Pour ne pas avoir de page négative ou nule
            $page = 1;
        }
        $this -> page = $page;
    }

    public function getTotalItems(){
        return count($this->items);
    }

    public function getTotalPages(){
        return ceil($this -> getTotalItems() / $this -> parPage);
    }

    public function getPage(){
        if ($this -> page > $this -> getTotalPages()) { // Pour ne pas avoir une page supérieure
            $this -> page = $this -> getTotalPages();
        }
        return $this -> page;
    }

    public function getDebut(){
        return ($this -> getPage() - 1) * $this -> parPage;
    }

    public function getItemsPage(){
        return array_slice($this -> items, $this -> getDebut(), $this -> parPage);
    }
}