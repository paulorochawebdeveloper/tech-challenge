<?php


namespace App\Http\Controllers\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait HasFetchAllRenderCapabilities
{
    private $builder;

    private $conditions = [];

    private $orderField;

    private $orderDirection;

    private $allowedConditions = [
        'like' => 'LIKE',
        'equal' => '=',
        'not_equal' => '!=',
        'greater_than' => '>',
        'greater_or_equal_than' => '>=',
        'lower_than' => '<',
        'lower_or_equal_than' => '<='
    ];

    private function setGetAllBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    private function addGetAllCondition(string $field, ?string $comparator, string $value)
    {
        if ($comparator == null) {
            $comparator = 'like';
        }
        $comparator = strtolower($comparator);
        if (!array_key_exists($comparator, $this->allowedConditions)) {
            $comparator = $this->allowedConditions['like'];
        } else {
            $comparator = $this->allowedConditions[$comparator];
        }
        if ($comparator == $this->allowedConditions['like']) {
            $value = "%$value%";
        }
        $this->conditions[] = [$field, $comparator, $value];
    }

    private function setGetAllOrdering(string $field, string $direction)
    {
        if (in_array($field, $this->getModelAttributes())) {
            $this->orderField = $field;
            $this->orderDirection = $direction;
        }
    }

    private function parseRequestConditions(Request $request)
    {
        $whitelist = array_flip(
            array_map(
                function ($item) {
                    return 'column_' . $item;
                },
                $this->getModelAttributes()
            )
        );
        foreach ($request->all() as $field => $value) {
            if (isset($whitelist[$field]) && $value) {
                $this->addGetAllCondition(
                    $this->getAttributeName($field),
                    $request->get($field . '_condition'),
                    $value
                );
            }
        }
    }

    private function getAttributeName(string $requestName): string
    {
        return (strtolower(substr($requestName, 7)));
    }

    private function getModelAttributes(): array
    {
        $tableName = $this->builder->getModel()->getTable();
        return Schema::getColumnListing($tableName);
    }

    private function getAll()
    {
        $builder = $this->builder->orderBy($this->orderField, $this->orderDirection);
        foreach ($this->conditions as $condition) {
            $builder->where(...$condition);
        }

        return $builder;
    }
}
