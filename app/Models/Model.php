<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as OriginModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Model
 * @package App\Models
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder select($columns = ['*'])
 * @method static Builder whereNotNull($column, $boolean = 'and')
 * @method static Builder whereNull($column, $boolean = 'and', $not = false)
 * @method static Builder orderBy($column, $direction = 'asc')
 * @method static Builder leftJoin($table, $first, $operator = null, $second = null)
 * @method static Builder skip($value)
 * @method static Builder take($value)
 * @method static Builder lockForUpdate()
 * @method static Builder sharedLock()
 * @method static mixed|Collection  find($id, $columns = ['*'])
 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder whereNotIn($column, $values, $boolean = 'and')
 * @method static Int insertGetId(array $values, $sequence = null)
 * @method static Int count($columns = '*')
 * @method static bool insert(array $values)
 * @method static Builder from($table)
 * @method static array|Collection get($columns = ['*'])
 * @method static array first($columns = ['*'])
 */
abstract class Model extends OriginModel
{
    public function isNew()
    {
        return !($this->getAttribute($this->primaryKey) > 0);
    }
}
