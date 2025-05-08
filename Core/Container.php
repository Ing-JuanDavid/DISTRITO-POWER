<?php

namespace Core;

class Container {
    
    protected $bindidngs;

    public function bind($key, $resolver)
    {
        $this->bindidngs[$key] = $resolver; 
    }

    public function resolve($key)
    {
        if(! array_key_exists($key, $this->bindidngs)) 
            return new \Exception('No se pudo encontrar la clave: ' . $key);

        $resolver = call_user_func($this->bindidngs[$key]);
        return $resolver;
    }
}