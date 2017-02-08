<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 07.02.17
     * Time: 20:04
     */

    namespace Conpago\Cli\Templates\Twig;

    use Conpago\File\Contract\IPathBuilder;
    use Twig_Environment;
    use Twig_Loader_Filesystem;


    /**
     * Class TwigFactory
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     **/
    class TwigFactory
    {
        /** @var string */
        private $path;

        /** @var string */
        private $cache;

        /** @var IPathBuilder */
        private $pathBuilder;

        /**
         * TwigFactory constructor.
         *
         * @param IPathBuilder $pathBuilder
         * @param $path
         * @param $cache
         */
        public function __construct($pathBuilder, $path, $cache)
        {
            $this->path = $path;
            $this->cache = $cache;
            $this->pathBuilder = $pathBuilder;
        }

        /**
         * @param $subPath
         *
         * @return Twig_Environment
         */
        public function create($subPath)
        {
            $templatePath = $this->pathBuilder->createPath([$this->path, $subPath]);

            $loader = new Twig_Loader_Filesystem($templatePath);
            return new Twig_Environment($loader, array(
                'cache' => $this->cache,
            ));
        }
    }