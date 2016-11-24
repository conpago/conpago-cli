<?php
/**
 * Created by PhpStorm.
 * User: bgolek
 * Date: 2016-11-24
 * Time: 17:01
 */

namespace Conpago\Cli;


use Conpago\File\Contract\IPathBuilder;

class PathBuilderMock implements IPathBuilder
{

    /**
     * Build path from string elements.
     *
     * @param string[] $elements The elements to join.
     *
     * @return string Returns a string of elements joined with DIRECTORY_SEPARATOR.
     */
    public function createPath(array $elements)
    {
        return implode("/", $elements);
    }

    /**
     * Get file name from path.
     *
     * @param string $filePath Path to a file.
     *
     * @return string Returns file name without path of directories.
     */
    public function fileName($filePath)
    {
        return basename(str_replace('\\', '/', $filePath));
    }
}