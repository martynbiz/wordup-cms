<?php
namespace App\Model;

class ContentValue extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'field_name',
        'value',
    );
}
