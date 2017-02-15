Feature: interactor
  In order to generate interactor with surroundings
  As an commandline user
  I need to be able to run cli command 'interactor'

  Scenario: Create full interactor
    Given Current date is '2013-10-29'
    Given Current time is '08:43'
    Given Config file exists:
      """
      author: "Bartosz Gołek"
      company: "TestCompany"
      project: "TestApp"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists in 'tmp/src':
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """
    Given I will answer 'yes' to question 'Create access right for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data object for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data validator? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create dao for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create logger for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create presenter model for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create Conpago/DI module for interactor? [yes/no] (yes):'
    When I run 'interactor' cli command with 'Test'
    Then The files exists in 'tmp/src' with content equal to 'CreateFullInteractor' reference file:
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """

  Scenario: Create simple interactor
    Given Current date is '2014-11-19'
    Given Current time is '10:13'
    Given Config file exists:
      """
      author: "Author Name"
      company: "SimpleCompany"
      project: "SimpleApp"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists in 'tmp/src':
      """
      SimpleCompany/SimpleApp/Business/Contract/Dao/ISimpleDao.php
      SimpleCompany/SimpleApp/Business/Contract/Interactor/ISimple.php
      SimpleCompany/SimpleApp/Business/Contract/Logger/ISimpleAccessRightLogger.php
      SimpleCompany/SimpleApp/Business/Contract/Logger/ISimpleLogger.php
      SimpleCompany/SimpleApp/Business/Contract/Presenter/ISimplePresenter.php
      SimpleCompany/SimpleApp/Business/Contract/PresenterModel/ISimplePresenterModel.php
      SimpleCompany/SimpleApp/Business/Contract/PresenterModel/ISimpleValidationResult.php
      SimpleCompany/SimpleApp/Business/Contract/RequestData/ISimpleRequestData.php
      SimpleCompany/SimpleApp/Business/Contract/Validators/ISimpleRequestDataValidator.php
      SimpleCompany/SimpleApp/Business/Interactor/Simple.php
      SimpleCompany/SimpleApp/Business/Interactor/SimpleAccessRight.php
      SimpleCompany/SimpleApp/Business/Logger/SimpleAccessRightLogger.php
      SimpleCompany/SimpleApp/Business/Logger/SimpleLogger.php
      SimpleCompany/SimpleApp/Business/PresenterModel/SimplePresenterModel.php
      SimpleCompany/SimpleApp/Business/PresenterModel/SimpleValidationResult.php
      SimpleCompany/SimpleApp/Business/Validators/SimpleRequestDataValidator.php
      SimpleCompany/SimpleApp/Dao/Business/SimpleDao.php
      SimpleCompany/SimpleApp/Modules/SimpleModule.php
      SimpleCompany/SimpleApp/Presentation/Contract/Controller/ISimpleController.php
      SimpleCompany/SimpleApp/Presentation/Controller/SimpleController.php
      SimpleCompany/SimpleApp/Presentation/Presenter/SimplePresenter.php
      SimpleCompany/SimpleApp/Presentation/RequestData/SimpleRequestData.php
      """
    Given I will answer 'no' to question 'Create access right for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create request data object for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create dao for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create logger for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create presenter model for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create Conpago/DI module for interactor? [yes/no] (yes):'
    When I run 'interactor' cli command with 'Simple'
    Then All questions was asked
    Then The files are still not exists in 'tmp/src':
      """
      SimpleCompany/SimpleApp/Business/Contract/Dao/ISimpleDao.php
      SimpleCompany/SimpleApp/Business/Contract/Logger/ISimpleAccessRightLogger.php
      SimpleCompany/SimpleApp/Business/Contract/Logger/ISimpleLogger.php
      SimpleCompany/SimpleApp/Business/Contract/PresenterModel/ISimplePresenterModel.php
      SimpleCompany/SimpleApp/Business/Contract/PresenterModel/ISimpleValidationResult.php
      SimpleCompany/SimpleApp/Business/Contract/RequestData/ISimpleRequestData.php
      SimpleCompany/SimpleApp/Business/Contract/Validators/ISimpleRequestDataValidator.php
      SimpleCompany/SimpleApp/Business/Interactor/SimpleAccessRight.php
      SimpleCompany/SimpleApp/Business/Logger/SimpleAccessRightLogger.php
      SimpleCompany/SimpleApp/Business/Logger/SimpleLogger.php
      SimpleCompany/SimpleApp/Business/PresenterModel/SimplePresenterModel.php
      SimpleCompany/SimpleApp/Business/PresenterModel/SimpleValidationResult.php
      SimpleCompany/SimpleApp/Business/Validators/SimpleRequestDataValidator.php
      SimpleCompany/SimpleApp/Dao/Business/SimpleDao.php
      SimpleCompany/SimpleApp/Modules/SimpleModule.php
      SimpleCompany/SimpleApp/Presentation/RequestData/SimpleRequestData.php
      """
    Then The files exists in 'tmp/src' with content equal to 'CreateSimpleInteractor' reference file:
      """
      SimpleCompany/SimpleApp/Business/Contract/Interactor/ISimple.php
      SimpleCompany/SimpleApp/Business/Contract/Presenter/ISimplePresenter.php
      SimpleCompany/SimpleApp/Business/Interactor/Simple.php
      SimpleCompany/SimpleApp/Presentation/Contract/Controller/ISimpleController.php
      SimpleCompany/SimpleApp/Presentation/Controller/SimpleController.php
      SimpleCompany/SimpleApp/Presentation/Presenter/SimplePresenter.php
      """

  Scenario: Create interactor without logger
    Given Current date is '2012-09-01'
    Given Current time is '00:00'
    Given Config file exists:
      """
      author: "Some Name"
      company: "NoLoggerCompany"
      project: "NoLoggerAppl"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists in 'tmp/src':
      """
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Dao/IWithoutLoggerDao.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Interactor/IWithoutLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Logger/IWithoutLoggerAccessRightLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Logger/IWithoutLoggerLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Presenter/IWithoutLoggerPresenter.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/PresenterModel/IWithoutLoggerPresenterModel.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/PresenterModel/IWithoutLoggerValidationResult.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/RequestData/IWithoutLoggerRequestData.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Validators/IWithoutLoggerRequestDataValidator.php
      NoLoggerCompany/NoLoggerAppl/Business/Interactor/WithoutLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Interactor/WithoutLoggerAccessRight.php
      NoLoggerCompany/NoLoggerAppl/Business/Logger/WithoutLoggerAccessRightLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Logger/WithoutLoggerLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/PresenterModel/WithoutLoggerPresenterModel.php
      NoLoggerCompany/NoLoggerAppl/Business/PresenterModel/WithoutLoggerValidationResult.php
      NoLoggerCompany/NoLoggerAppl/Business/Validators/WithoutLoggerRequestDataValidator.php
      NoLoggerCompany/NoLoggerAppl/Dao/Business/WithoutLoggerDao.php
      NoLoggerCompany/NoLoggerAppl/Modules/WithoutLoggerModule.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Contract/Controller/IWithoutLoggerController.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Controller/WithoutLoggerController.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Presenter/WithoutLoggerPresenter.php
      NoLoggerCompany/NoLoggerAppl/Presentation/RequestData/WithoutLoggerRequestData.php
      """
    Given I will answer 'yes' to question 'Create access right for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data object for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data validator? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create dao for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create logger for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create presenter model for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create Conpago/DI module for interactor? [yes/no] (yes):'
    When I run 'interactor' cli command with 'WithoutLogger'
    Then All questions was asked
    Then The files are still not exists in 'tmp/src':
      """
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Logger/IWithoutLoggerAccessRightLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Logger/IWithoutLoggerLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Logger/WithoutLoggerAccessRightLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Logger/WithoutLoggerLogger.php
      """
    Then The files exists in 'tmp/src' with content equal to 'CreateInteractorWithoutLogger' reference file:
      """
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Interactor/IWithoutLogger.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Presenter/IWithoutLoggerPresenter.php
      NoLoggerCompany/NoLoggerAppl/Business/Interactor/WithoutLogger.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Contract/Controller/IWithoutLoggerController.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Controller/WithoutLoggerController.php
      NoLoggerCompany/NoLoggerAppl/Presentation/Presenter/WithoutLoggerPresenter.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Dao/IWithoutLoggerDao.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/PresenterModel/IWithoutLoggerPresenterModel.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/PresenterModel/IWithoutLoggerValidationResult.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/RequestData/IWithoutLoggerRequestData.php
      NoLoggerCompany/NoLoggerAppl/Business/Contract/Validators/IWithoutLoggerRequestDataValidator.php
      NoLoggerCompany/NoLoggerAppl/Business/Interactor/WithoutLoggerAccessRight.php
      NoLoggerCompany/NoLoggerAppl/Business/PresenterModel/WithoutLoggerPresenterModel.php
      NoLoggerCompany/NoLoggerAppl/Business/PresenterModel/WithoutLoggerValidationResult.php
      NoLoggerCompany/NoLoggerAppl/Business/Validators/WithoutLoggerRequestDataValidator.php
      NoLoggerCompany/NoLoggerAppl/Dao/Business/WithoutLoggerDao.php
      NoLoggerCompany/NoLoggerAppl/Modules/WithoutLoggerModule.php
      NoLoggerCompany/NoLoggerAppl/Presentation/RequestData/WithoutLoggerRequestData.php
      """

  Scenario: Create full interactor
    Given Current date is '2013-10-29'
    Given Current time is '08:43'
    Given Config file exists:
      """
      author: "Bartosz Gołek"
      company: "TestCompany"
      project: "TestApp"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists in 'tmp/src':
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """
    Given I will answer 'no' to question 'Create access right for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data object for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create request data validator? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create dao for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create logger for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create presenter model for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create Conpago/DI module for interactor? [yes/no] (yes):'
    When I run 'interactor' cli command with 'Test'
    Then The files are still not exists in 'tmp/src':
      """
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      """
    Then The files exists in 'tmp/src' with content equal to 'CreateInteractorWithoutAccessRight' reference file:
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """

  Scenario: Create full interactor
    Given Current date is '2013-10-29'
    Given Current time is '08:43'
    Given Config file exists:
      """
      author: "Bartosz Gołek"
      company: "TestCompany"
      project: "TestApp"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists in 'tmp/src':
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """
    Given I will answer 'yes' to question 'Create access right for interactor? [yes/no] (yes):'
    Given I will answer 'no' to question 'Create request data object for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create dao for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create logger for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create presenter model for interactor? [yes/no] (yes):'
    Given I will answer 'yes' to question 'Create Conpago/DI module for interactor? [yes/no] (yes):'
    When I run 'interactor' cli command with 'Test'
    Then The files are still not exists in 'tmp/src':
      """
      TestCompany/TestApp/Business/Contract/RequestData/ITestRequestData.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestValidationResult.php
      TestCompany/TestApp/Business/Contract/Validators/ITestRequestDataValidator.php
      TestCompany/TestApp/Business/PresenterModel/TestValidationResult.php
      TestCompany/TestApp/Business/Validators/TestRequestDataValidator.php
      TestCompany/TestApp/Presentation/RequestData/TestRequestData.php
      """
    Then The files exists in 'tmp/src' with content equal to 'CreateInteractorWithoutRequestData' reference file:
      """
      TestCompany/TestApp/Business/Contract/Dao/ITestDao.php
      TestCompany/TestApp/Business/Contract/Interactor/ITest.php
      TestCompany/TestApp/Business/Contract/Logger/ITestAccessRightLogger.php
      TestCompany/TestApp/Business/Contract/Logger/ITestLogger.php
      TestCompany/TestApp/Business/Contract/Presenter/ITestPresenter.php
      TestCompany/TestApp/Business/Contract/PresenterModel/ITestPresenterModel.php
      TestCompany/TestApp/Business/Interactor/Test.php
      TestCompany/TestApp/Business/Interactor/TestAccessRight.php
      TestCompany/TestApp/Business/Logger/TestAccessRightLogger.php
      TestCompany/TestApp/Business/Logger/TestLogger.php
      TestCompany/TestApp/Business/PresenterModel/TestPresenterModel.php
      TestCompany/TestApp/Dao/Business/TestDao.php
      TestCompany/TestApp/Modules/TestModule.php
      TestCompany/TestApp/Presentation/Contract/Controller/ITestController.php
      TestCompany/TestApp/Presentation/Controller/TestController.php
      TestCompany/TestApp/Presentation/Presenter/TestPresenter.php
      """