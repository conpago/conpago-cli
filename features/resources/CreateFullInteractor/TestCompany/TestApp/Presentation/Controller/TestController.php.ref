<?php
    /**
     * Created by Conpago-Cli.
     * User: Bartosz Gołek
     * Date: 29.10.13
     * Time: 08:43
     */

    namespace TestCompany\TestApp\Presentation\Controller;


    use Conpago\Exceptions\Http400BadRequestException;
    use Conpago\Helpers\Contract\IRequestData;
    use TestCompany\TestApp\Presentation\Contract\Controller\ITestController;
    use TestCompany\TestApp\Business\Contract\Interactor\ITest;
    use TestCompany\TestApp\Presentation\RequestData\TestRequestData;

    class TestController implements ITestController
    {
        /**
         * @var ITest
         */
        private $createUser;

        function __construct(ITest $createUser)
        {
            $this->createUser = $createUser;
        }

        function execute(IRequestData $data)
        {
            $parameters = $data->getParameters();

            if ($parameters == null) {
                throw new Http400BadRequestException("");
            }

            //TODO: Repalce ?entity? with right name
            if (!array_key_exists('?entity?', $parameters) {
                throw new Http400BadRequestException("");
            }

            $requestData = new TestRequestData(
                //TODO: set request data fields as below
                //$parameters['?entity?']['?field?']
            );
            $this->createUser->run($requestData);
        }
    }