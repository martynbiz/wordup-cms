<?php
namespace App\Model;

use Handlebars\Handlebars;

class Folder extends Base
{
    /**
    * @var array
    */
    protected $fillable = array(
        'name',
        'description',
        'dir_name',
        'menu_link',
        'active',
        'parent_id',
        'layout_id',
    );

    /**
     * Get the subfolders for this folder
     */
    public function layout()
    {
        return $this->belongsTo('App\Model\Layout');
    }

    /**
     * Get the subfolders for this folder
     */
    public function parent()
    {
        return $this->belongsTo('App\Model\Folder', 'parent_id');
    }

    /**
     * Get the subfolders for this folder
     */
    public function subfolders()
    {
        return $this->hasMany('App\Model\Folder', 'parent_id');
    }

    /**
     * Get the subfolders for this folder
     */
    public function contents()
    {
        return $this->hasMany('App\Model\Content');
    }

    /**
     * Will render the folder
     */
    public function render()
    {
        $data = [
            'meta' => [
                'title' => $this->name,
            ],
            'folders' => [],
            'site_info' => [],
            'formatters' => [],
            'media' => [],
        ];

        $contents = $this->contents;
        $rendered = '';
        foreach ($contents as $content) {
            $rendered.= $content->render($data);
        }

        // layout
        $engine = new Handlebars;
        $data['content'] = $rendered;
        $rendered = $engine->render($this->layout->template, $data);

        return $rendered;
    }

    /**
     * @param string $baseDir
     */
    public function publish($baseDir)
    {
        $this->publishRecursive([$this], $baseDir);
    }

    /**
     *
     */
    protected function publishRecursive($folders, $baseDir)
    {
        foreach($folders as $folder) {

            if ($folder->parent_id > 0) {
                $dir = $baseDir . '/' . $folder->dir_name;
                mkdir($dir);
            } else {
                $dir = $baseDir;
            }

            // create index.html file inside directory
            $file = $dir . '/index.html';
            file_put_contents($file, $folder->render());

            // build subdirs
            $subfolders = $folder->subfolders;
            if ($subfolders) {
                $this->publishRecursive($subfolders, $dir);
            }
        }
    }
}
