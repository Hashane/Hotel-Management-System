<?php

namespace App\Utilities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * http://hotel-system.test/rooms?type=standard&popular
 */
class FilterBuilder
{
    protected Builder $query;
    protected array $filters;
    protected string $namespace;

    public function __construct($query, $filters, $namespace){
        $this->query = $query;
        $this->filters = $filters;
        $this->namespace = $namespace;
    }

    public function apply(): Builder
    {
        foreach($this->filters as $name => $value){
            $normalizedName = Str::studly($name);
            $class = $this->namespace . "\\{$normalizedName}";

            if(!class_exists($class)){
                continue;
            }


            // If query param has a value (even '0'), pass it
            if (!is_null($value) && $value !== '') {          // if(strlen($value)){
                (new $class($this->query))->handle($value);
            }
            else{
                (new $class($this->query))->handle();
            }
        }
        return $this->query;
    }
}
