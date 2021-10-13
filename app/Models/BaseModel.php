<?php


namespace App\Models;


use App\Helpers\{Constants};
use App\Rules\ValidateFilter;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopeFilter($query, $filters = null, $filterOperator = "=")
    {
        if (!empty($filters) && is_array($filters)) {
            foreach ($filters as $field => $value) {
                if ($value == Constants::NULL)
                    $query->whereNull($field);
                elseif ($value == Constants::NOT_NULL)
                    $query->whereNotNull($field);
                elseif ($filterOperator == 'like')
                    $query->where($field,$filterOperator, '%'.$value.'%');
                elseif (is_array($value))
                    $query->whereIn($field, $value);
                else
                    $query->where($field, $value);
            }
        }
        return $query;
    }









    public function searchRules(){
        $columns = array_merge($this->getFillable(), Constants::DEFAULT_COLUMNS);
        return [
            Constants::FILTERS              => ['array', 
                                                new ValidateFilter($columns)
                                            ],
            Constants::ORDER_BY             => 'string|in:'.implode(',',$columns),
            Constants::ORDER_BY_DIRECTION   => 'in:desc,asc',
            Constants::FILTER_OPERATOR      => 'string',
            Constants::PER_PAGE             => 'integer',
            Constants::PAGE                 => 'integer',
        ];
    }



}