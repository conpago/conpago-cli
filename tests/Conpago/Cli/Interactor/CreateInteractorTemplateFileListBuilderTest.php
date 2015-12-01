<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 01.11.15
     * Time: 23:08
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Cli\Interactor\Contract\CreateInteractorContext;

    class CreateInteractorTemplateFileListBuilderTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var CreateInteractorTemplateFileListBuilder
         */
        protected $templateFileListBuilder;

        /**
         * @expectedException \PHPUnit_Framework_Error
         * @expectedExceptionMessageRegExp /Argument 1 passed to Conpago\\Cli\\Interactor\\CreateInteractorTemplateFileListBuilder::build\(\) must be an instance of Conpago\\Cli\\Interactor\\Contract\\CreateInteractorContext, null given, called in .+ on line \d+ and defined/
         */
        public function test_WillThrowWhenGotNullContext()
        {
            $this->templateFileListBuilder->build(null);
        }

        public function test_WillReturnAllTemplateFiles()
        {
            $this->assertEquals(
                [
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}AccessRightLogger.php'
                ],
                $this->templateFileListBuilder->build(new CreateInteractorContext())
            );
        }

        public function setUp()
        {
            $this->templateFileListBuilder = new CreateInteractorTemplateFileListBuilder();
        }
    }
