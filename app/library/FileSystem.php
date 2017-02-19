<?php
namespace App;

class FileSystem
{
    /**
     * Remove dir and files
     * @param $dir string
     * @param $safeDir string Only dirs within this dir can be removed
     */
    public function emptyDir($dir, $safeDir='/var/www/') {

        // just encase eh
        if (strpos($dir, $safeDir) != 0) return false;

        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file)) $this->emptyDir($file); else unlink($file);
        }
        rmdir($dir);
    }
}
