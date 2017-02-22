<?php
/**
 * Will output a
 */

namespace App\Formatter;

interface FormatterInterface
{
    /**
     * Get the name of the formatter
     * @return string
     */
    public static function getName();

    /**
     * Get the name of the formatter
     * @return string
     */
    public function getOptions();

    /**
     * Will return the option that this formatter requires
     * @return array
     */
    public static function getFields();

    /**
     * Will render the formatter with the options provided
     * @return string
     */
    public function render();
}
