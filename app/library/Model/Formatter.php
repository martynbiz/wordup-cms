<?php
namespace App\Model;

class Formatter extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'description',
        'formatter_type_id',
        'options',
    );
}
