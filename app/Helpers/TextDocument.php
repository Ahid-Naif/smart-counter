<?php

namespace App\Helpers;

class TextDocument implements DocumentInterface
{
    protected $path;
    
    /**
     * TextDocument constructor.
     * @param $path
     */
    public function __construct($path){
        $this->path = $path;
    }
    
    /**
     * Get the file's path
     *
     * @return mixed
     */
    public function path(){
        return $this->path;
    }
}