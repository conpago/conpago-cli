<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 01.11.15
     * Time: 23:08
     */

    namespace Conpago\Cli\Interactor;

    use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
    use Phake;

    class CreateInteractorTemplateFileListBuilderTest extends \PHPUnit_Framework_TestCase
    {
        protected $createInteractorContext;
        /**
         * @var CreateInteractorTemplateFileListBuilder
         */
        protected $templateFileListBuilder;

        public function test_WillReturnAllTemplateFiles()
        {
            $this->initContext(
                true,
                true,
                true,
                true,
                true,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesButAccessRight()
        {
            $this->initContext(
                false,
                true,
                true,
                true,
                true,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesButRequestData()
        {
            $this->initContext(
                true,
                false,
                true,
                true,
                true,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesButRequestDataValidator()
        {
            $this->initContext(
                true,
                true,
                false,
                true,
                true,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesWithoutDao()
        {
            $this->initContext(
                true,
                true,
                true,
                false,
                true,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesWithoutLogger()
        {
            $this->initContext(
                true,
                true,
                true,
                true,
                false,
                true,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesButPresenterModel()
        {
            $this->initContext(
                true,
                true,
                true,
                true,
                true,
                false,
                true
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Modules/{{name}}Module.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function test_WillReturnAllTemplateFilesButDiModule()
        {
            $this->initContext(
                true,
                true,
                true,
                true,
                true,
                true,
                false
            );

            $this->assertEquals(
                [
                    'Business/Contract/Dao/I{{name}}Dao.php',
                    'Business/Contract/Interactor/I{{name}}.php',
                    'Business/Contract/Logger/I{{name}}AccessRightLogger.php',
                    'Business/Contract/Logger/I{{name}}Logger.php',
                    'Business/Contract/Presenter/I{{name}}Presenter.php',
                    'Business/Contract/PresenterModel/I{{name}}PresenterModel.php',
                    'Business/Contract/PresenterModel/I{{name}}ValidationResult.php',
                    'Business/Contract/RequestData/I{{name}}RequestData.php',
                    'Business/Contract/Validators/I{{name}}RequestDataValidator.php',
                    'Business/Interactor/{{name}}.php',
                    'Business/Interactor/{{name}}AccessRight.php',
                    'Business/Logger/{{name}}AccessRightLogger.php',
                    'Business/Logger/{{name}}Logger.php',
                    'Business/PresenterModel/{{name}}PresenterModel.php',
                    'Business/PresenterModel/{{name}}ValidationResult.php',
                    'Business/Validators/{{name}}RequestDataValidator.php',
                    'Dao/Business/{{name}}Dao.php',
                    'Presentation/Contract/Controller/I{{name}}Controller.php',
                    'Presentation/Controller/{{name}}Controller.php',
                    'Presentation/Presenter/{{name}}Presenter.php',
                    'Presentation/RequestData/{{name}}RequestData.php',
                ],
                $this->templateFileListBuilder->build($this->createInteractorContext)
            );
        }

        public function setUp()
        {
            $this->createInteractorContext = Phake::mock(CreateInteractorContext::class);
            $this->templateFileListBuilder = new CreateInteractorTemplateFileListBuilder();
        }

        /**
         * @param $accessRight
         * @param $requestData
         * @param $requestDataValidator
         * @param $dao
         * @param $logger
         * @param $presenterModel
         * @param $diModule
         */
        public function initContext(
            $accessRight,
            $requestData,
            $requestDataValidator,
            $dao,
            $logger,
            $presenterModel,
            $diModule
        ) {
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::ACCESS_RIGHT)->thenReturn($accessRight);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::REQUEST_DATA)->thenReturn($requestData);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR)->thenReturn($requestDataValidator);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::DAO)->thenReturn($dao);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::LOGGER)->thenReturn($logger);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::PRESENTER_MODEL)->thenReturn($presenterModel);
            Phake::when($this->createInteractorContext)->getVariable(InteractorParts::DI_MODULE)->thenReturn($diModule);
        }
    }
