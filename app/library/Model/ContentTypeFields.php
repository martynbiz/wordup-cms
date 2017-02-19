<?php
namespace App\Model;

class ContentTypeFields extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'data_type',
        'field_name',
    );
}
