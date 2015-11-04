<?php

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:28
	 */

	namespace Conpago\Cli;

	use Conpago\Cli\CaseConverter\CaseConverter;
	use Conpago\Cli\Interactor\CreateInteractor;
	use Conpago\Cli\Interactor\CreateInteractorContextBuilder;
	use Conpago\Cli\Interactor\CreateInteractorContextBuilderConfig;
	use Conpago\Cli\Interactor\CreateInteractorTemplateFileListBuilder;
	use Conpago\Cli\Interactor\CreateInteractorPresenter;
	use Conpago\Cli\Templates\Contract\TemplateOptions;
	use Conpago\Cli\Templates\TemplateEnvironment;
	use Conpago\Cli\Templates\TemplateLoader;
	use Conpago\Cli\Templates\TemplateProcessor;
	use Conpago\Config\YamlConfig;
	use Conpago\File\FileSystem;
	use Conpago\File\Path;

	/**
	 * Class ApplicationFactory
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	class ApplicationFactory {

		/**
		 * @return Application
		 */
		public function createApplication() {
			$output = new StreamOutput( STDOUT );
			$fileSystem = new FileSystem();

			return new Application(
				new ApplicationPresenter( $output ),
				new CommandFactory(
					[
						'interactor' => new CreateInteractor(
							new CreateInteractorPresenter($output),
							new CreateInteractorContextBuilder(
								new Question(new StreamInput(STDIN), $output),
								new CreateInteractorContextBuilderConfig(
									new YamlConfig(
										$fileSystem,
										"conpago-cli.yaml"
									)
								)
							),
							new CreateInteractorTemplateFileListBuilder(),
							$fileSystem,
							new TemplateProcessor(
								new TemplateEnvironment(
									new TemplateLoader(),
									new TemplateOptions()
								),
								new CaseConverter()
							),
							new Path()
						)
					]
				)
			);
		}
	}