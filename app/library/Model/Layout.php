<?php
namespace App\Model;

use Handlebars\Handlebars;

class Layout extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'description',
        'template',
    );
}
