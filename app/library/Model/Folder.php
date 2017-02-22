<?php
namespace App\Model;

use Handlebars\Handlebars;

use App\Model\Formatter;

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
     * @param string $baseDir
     */
    public function publish($baseDir, $formatterTypes)
    {
        $this->publishRecursive([$this], $baseDir, $formatterTypes);
    }

    /**
     *
     */
    protected function publishRecursive($folders, $baseDir, $formatterTypes)
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
            file_put_contents($file, $folder->render($formatterTypes));

            // build subdirs
            $subfolders = $folder->subfolders;
            if ($subfolders) {
                $this->publishRecursive($subfolders, $dir, $formatterTypes);
            }
        }
    }

    /**
     * Will render the folder
     */
    public function render($formatterTypes)
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

        // populate formatters
        $formatters = Formatter::all();
        foreach ($formatters as $formatter) {
            $className = $formatterTypes[$formatter->formatter_type_id];
            $options = json_decode($formatter->options, true);
            $f = new $className($options, [
                'folder' => $this,
            ]);
            $data['formatters']['_' . $formatter->id] = $f->render();
        }

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
}
