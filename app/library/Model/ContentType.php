<?php
namespace App\Model;

class ContentType extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'description',
        'template',
    );

    /**
     * Get the comments for the blog post.
     */
    public function fields()
    {
        return $this->hasMany('App\Model\ContentTypeFields'); //, 'content_type_id');
    }

    /**
     * Get the subfolders for this folder
     */
    public function contents()
    {
        return $this->hasMany('App\Model\Contents');
    }
}
