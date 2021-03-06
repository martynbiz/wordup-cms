<?php
/**
 * Will output a
 */

namespace App\Formatter;

use App\Model\Folder;

class Navigation extends AbstractFormatter implements FormatterInterface
{
    /**
     * Name of formatter
     */
    protected static $name = 'Navigation';

    /**
     * Will return the option that this formatter requires
     * @return array
     */
    public static function getFields()
    {
        return [
            'folder_id' => [
                'label' => 'Folder ID',
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
        $rootFolder = Folder::find((int) $this->options['folder_id']);
        $subFolders = $rootFolder->subfolders();

        $html = $this->options['before_output'];
        foreach($subFolders as $folder) {
            $html.= $this->options['before_link'];
            $html.= '<a href="#">' . $folder->name . '</a>';
            $html.= $this->options['after_link'];
        }
        $html.= $this->options['after_output'];

        return $html;
    }
}
