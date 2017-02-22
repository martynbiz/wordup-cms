<?php
/**
 * Will output a
 */

namespace App\Formatter;

class Navigation extends AbstractFormatter implements FormatterInterface
{
    /**
     * Name of formatter
     */
    protected static $name = 'Sitemap';

    /**
     * Will return the option that this formatter requires
     * @return array
     */
    public static function getFields()
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
