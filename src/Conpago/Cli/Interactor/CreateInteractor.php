<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 08.10.15
	 * Time: 22:17
	 */

	namespace Conpago\Cli\Interactor;

	use Conpago\Cli\Contract\ICommand;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;

	class CreateInteractor implements ICommand {

		/**
		 * @var ICreateInteractorPresenter
		 */
		private $presenter;

		function __construct(ICreateInteractorPresenter $presenter) {
			$this->presenter = $presenter;
		}

		function getHelp() {
			return "Usage: conpago interactor <InteractorName>".PHP_EOL.
				PHP_EOL.
				$this->getDescription().
		        PHP_EOL;
		}

		function run( array $args ) {
			if (count($args) < 1)
			{
				echo "Missing parameter <InteractorName>.".PHP_EOL;
				echo PHP_EOL;
				$this->getHelp();
				return;
			}

			$templates_dir = __DIR__.DIRECTORY_SEPARATOR."templates";
			$src_dir = $templates_dir.DIRECTORY_SEPARATOR."src";
			$namespace = "Name\\Space";
			$interactor = $args[0];

			echo $src_dir.PHP_EOL;
			echo $namespace.PHP_EOL;
			echo $interactor.PHP_EOL;

			$loader = new Twig_Loader_Filesystem($src_dir);
			$twig = new Twig_Environment($loader);

			$this->process_directory($src_dir, null, $namespace, $interactor, $twig);
		}

		function process_directory($base_path, $sub_path, $namespace, $interactor, Twig_Environment $twig)
		{
			$dir = $base_path . DIRECTORY_SEPARATOR . $sub_path;
			$scanned_directory = array_diff(scandir( $dir ), array('..', '.'));
			foreach ($scanned_directory as $item)
			{
				if (is_dir($dir . DIRECTORY_SEPARATOR . $item)) {
					$this->process_directory($base_path, $sub_path.DIRECTORY_SEPARATOR.$item, $namespace, $interactor, $twig);
				} else {
					$target_path = getcwd().DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR.str_replace("\\", DIRECTORY_SEPARATOR, $namespace);
					echo $target_path.PHP_EOL;
					$target_file = str_replace("_", $interactor, $item);
					echo $target_file.PHP_EOL;
					echo $namespace.PHP_EOL;
					$target_namespace = $namespace . implode("\\", explode(DIRECTORY_SEPARATOR, $sub_path));
					echo $target_namespace.PHP_EOL;
					$target_content = $twig->render(
							$sub_path.DIRECTORY_SEPARATOR.$item,
							array(
								'base_namespace' => $namespace,
								'namespace' => $target_namespace,
								'name' => $interactor
							)
					);
					echo $target_content.PHP_EOL;
				}
			}
		}

		function getDescription() {
			return "Generate interactor with interfaces and adapters stubs. It also generate tests stubs.".PHP_EOL;
		}
	}