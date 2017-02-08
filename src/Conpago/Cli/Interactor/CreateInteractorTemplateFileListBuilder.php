<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 01.11.15
     * Time: 23:04
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorTemplateFileListBuilder;

    /**
     * Class CreateInteractorTemplateFileListBuilder
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CreateInteractorTemplateFileListBuilder implements ICreateInteractorTemplateFileListBuilder
    {

        /**
         * @param CreateInteractorContext $context
         *
         * @return string[]
         */
        public function build(CreateInteractorContext $context)
        {
            $result = [];

            if ($context->getVariable(InteractorParts::DAO)) {
                $result[] = 'Business/Contract/Dao/I{{name}}Dao.php';
            }
            $result[] = 'Business/Contract/Interactor/I{{name}}.php';

            if ($context->getVariable(InteractorParts::ACCESS_RIGHT) &&
                $context->getVariable(InteractorParts::LOGGER)
            ) {
                $result[] = 'Business/Contract/Logger/I{{name}}AccessRightLogger.php';
            }
            if ($context->getVariable(InteractorParts::LOGGER)) {
                $result[] = 'Business/Contract/Logger/I{{name}}Logger.php';
            }
            $result[] = 'Business/Contract/Presenter/I{{name}}Presenter.php';
            if ($context->getVariable(InteractorParts::PRESENTER_MODEL)) {
                $result[] = 'Business/Contract/PresenterModel/I{{name}}PresenterModel.php';
            }
            if ($context->getVariable(InteractorParts::REQUEST_DATA) &&
                $context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR)
            ) {
                $result[] = 'Business/Contract/PresenterModel/I{{name}}ValidationResult.php';
            }
            if ($context->getVariable(InteractorParts::REQUEST_DATA)) {
                $result[] = 'Business/Contract/RequestData/I{{name}}RequestData.php';
                if ($context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR)) {
                    $result[] = 'Business/Contract/Validators/I{{name}}RequestDataValidator.php';
                }
            }
            $result[] = 'Business/Interactor/{{name}}.php';

            if ($context->getVariable(InteractorParts::ACCESS_RIGHT)) {
                $result[] = 'Business/Interactor/{{name}}AccessRight.php';
                if ($context->getVariable(InteractorParts::LOGGER)) {
                    $result[] = 'Business/Logger/{{name}}AccessRightLogger.php';
                }
            }

            if ($context->getVariable(InteractorParts::LOGGER)) {
                $result[] = 'Business/Logger/{{name}}Logger.php';
            }
            if ($context->getVariable(InteractorParts::PRESENTER_MODEL)) {
                $result[] = 'Business/PresenterModel/{{name}}PresenterModel.php';
            }
            if ($context->getVariable(InteractorParts::REQUEST_DATA) &&
                $context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR)
            ) {
                $result[] = 'Business/PresenterModel/{{name}}ValidationResult.php';
            }
            if ($context->getVariable(InteractorParts::REQUEST_DATA) &&
                $context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR)
            ) {
                $result[] = 'Business/Validators/{{name}}RequestDataValidator.php';
            }
            if ($context->getVariable(InteractorParts::DAO)) {
                $result[] = 'Dao/Business/{{name}}Dao.php';
            }
            if ($context->getVariable(InteractorParts::DI_MODULE)) {
                $result[] = 'Modules/{{name}}Module.php';
            }
            $result[] = 'Presentation/Contract/Controller/I{{name}}Controller.php';
            $result[] = 'Presentation/Controller/{{name}}Controller.php';
            $result[] = 'Presentation/Presenter/{{name}}Presenter.php';
            if ($context->getVariable(InteractorParts::REQUEST_DATA)) {
                $result[] = 'Presentation/RequestData/{{name}}RequestData.php';
            }

            return $result;
        }
    }
