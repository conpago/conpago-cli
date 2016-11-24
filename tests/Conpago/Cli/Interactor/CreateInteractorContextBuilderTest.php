<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 25.10.15
     * Time: 19:16
     */

    namespace Conpago\Cli\Interactor;

    use Conpago\Cli\Contract\IQuestion;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilderConfig;
    use Conpago\Time\Contract\ITimeService;

    class CreateInteractorContextBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CreateInteractorContextBuilder
     */
    protected $createInteractorContextBuilder;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $question;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $config;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $timeService;

    public function test_WillAskForContextData()
    {
        $this->question->expects($this->exactly(7))
                ->method("ask")
                ->withConsecutive(
                    [$this->equalTo("Create access right for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create request data object for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create request data validator?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create dao for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create logger for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create presenter model for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")],
                    [$this->equalTo("Create Conpago/DI module for interactor?"),
                        $this->equalTo(["yes", "no"]),
                        $this->equalTo("yes")]
                );

        $this->createInteractorContextBuilder->build("");
    }

    public function test_WillBuildContextWithGatheredData()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals(
                [
                    $context->getVariable("createAccessRight"),
                    $context->getVariable("createRequestData"),
                    $context->getVariable("createRequestDataValidator"),
                    $context->getVariable("createDao"),
                    $context->getVariable("createLogger"),
                    $context->getVariable("createPresenterModel"),
                    $context->getVariable("createConpagoDiModule")
                ],
                [
                    true,
                    true,
                    true,
                    true,
                    true,
                    true,
                    true
                ]);
    }

    public function test_WillSetAuthorFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getAuthor")->willReturn("Authorrr");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getAuthor(), "Authorrr");
    }

    public function test_WillSetCompanyFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getCompany")->willReturn("Company");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getCompany(), "Company");
    }

    public function test_WillSetProjectFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getProject")->willReturn("Project");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getProject(), "Project");
    }

    public function test_WillSetSourcesFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getSources")->willReturn("Sources");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getSources(), "Sources");
    }

    public function test_WillSetTestsFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getTests")->willReturn("Tests");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getTests(), "Tests");
    }

    public function test_WillSetInteractorNameFromConfig()
    {
        $this->question->expects($this->any())
                           ->method("ask")
                           ->willReturn("yes");
        $this->config->expects($this->once())->method("getTests")->willReturn("Tests");

        $context = $this->createInteractorContextBuilder->build("asd");
        $this->assertEquals($context->getInteractorName(), "asd");
    }

    protected function setUp()
    {
        $this->question = $this->createMock(IQuestion::class);
        $this->config = $this->createMock(ICreateInteractorContextBuilderConfig::class);
        $this->timeService = $this->createMock(ITimeService::class);
        $this->createInteractorContextBuilder = new CreateInteractorContextBuilder($this->question, $this->config, $this->timeService);
    }
}
