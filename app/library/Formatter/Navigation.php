<?php
/**
 * Will output a
 */

namespace App\Formatters;

class AbstractFormatter
{
    // /**
    //  * @var Container
    //  */
    // protected $c;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param Container $c
     * @param array $options
     * @param array $currentState e.g. [folder => $folder]
     */
    public function __construct($options, $currentState=[])
    {
        // $this->c = $c;
        $this->options = $options;
        $this->currentState = $currentState;
    }
}

class Navigation extends AbstractFormatter implements FormatterInterface
{
    /**
     * Will return the option that this formatter requires
     * @return array
     */
    public static function getOptionFields()
    {
        return [
            'root_folder' => [
                'label' => 'Root folder ID',
                'type' => 'text',
            ],
            'before_output' => [
                'label' => 'Before output',
                'type' => 'text',
                'placeholder' => 'e.g. <ul>',
            ],
            'after_output' => [
                'label' => 'After output',
                'type' => 'text',
                'placeholder' => 'e.g. </ul>',
            ],
            'before_link' => [
                'label' => 'Before link',
                'type' => 'text',
                'placeholder' => 'e.g. <li>',
            ],
            'after_link' => [
                'label' => 'After link',
                'type' => 'text',
                'placeholder' => 'e.g. </li>',
            ],
        ];
    }

    /**
     * Will render the formatter with the options provided
     * @return string
     */
    public function render()
    {
        $rootFolder = Folder::find((int) $this->options['root_folder']);
        $subFolders = $rootFolder->subfolder();


    }
}

// Root folder: 1
//

$formatter = new Navigation($c, $options, $currentState);
$fields = Navigation::getOptionFields(); // e.g. ['root_folder' => ['name' => 'Root folder', 'input_type' => 'number', ..], ..]
$rendered = $formatter->render();


/*
[
    'top_nav' => 'App\Formatters\TopNavigation', <-- takes a root dir e.g. 1
    'sub_nav' => 'App\Formatters\SubNavigation', <-- uses current folder 
    'site_map' => 'App\Formatters\SiteMap',
    ...
]

<select>
    <option value="top_nav">Top Navigation</option>


{ id:1, name:'top_nav', options:'{root_folder:12}' }

<div>{{{ formatters._123 }}}</div>

*/
