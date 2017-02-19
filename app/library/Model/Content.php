<?php
namespace App\Model;

use Handlebars\Handlebars;

class Content extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'description',
        'content_type_id',
    );

    /**
     * Get the subfolders for this folder
     */
    public function values()
    {
        return $this->hasMany('App\Model\ContentValue');
    }

    /**
     * Get the subfolders for this folder
     */
    public function content_type()
    {
        return $this->belongsTo('App\Model\ContentType');
    }

    /**
     * Will render the content
     */
    public function render($data=[])
    {
        $engine = new Handlebars;

        // popular fields.*
        if (!isset($data['fields'])) $data['fields'] = [];
        foreach ($this->values as $value) {
            $data['fields'][$value->field_name] = $value->value;
        }

        return $engine->render($this->content_type->template, $data);
    }
}
