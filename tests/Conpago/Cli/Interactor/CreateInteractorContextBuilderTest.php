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
    use DateTime;
    use PHPUnit_Framework_MockObject_MockObject as MockObject;

    class CreateInteractorContextBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var CreateInteractorContextBuilder */
    protected $createInteractorContextBuilder;

    /** @var IQuestion | MockObject */
    protected $question;

    /** @var ICreateInteractorContextBuilderConfig | MockObject */
    protected $config;

    /** @var ITimeService | MockObject */
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

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $this->createInteractorContextBuilder->build("");
    }

    public function test_WillBuildContextWithGatheredData()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals(
                [
                    $context->getVariable(InteractorParts::ACCESS_RIGHT),
                    $context->getVariable(InteractorParts::REQUEST_DATA),
                    $context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR),
                    $context->getVariable(InteractorParts::DAO),
                    $context->getVariable(InteractorParts::LOGGER),
                    $context->getVariable(InteractorParts::PRESENTER_MODEL),
                    $context->getVariable(InteractorParts::DI_MODULE)
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

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getAuthor(), "Authorrr");
    }

    public function test_WillSetCompanyFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getCompany")->willReturn("Company");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getCompany(), "Company");
    }

    public function test_WillSetProjectFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getProject")->willReturn("Project");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getProject(), "Project");
    }

    public function test_WillSetSourcesFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getSources")->willReturn("Sources");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getSources(), "Sources");
    }

    public function test_WillSetTestsFromConfig()
    {
        $this->question->expects($this->any())
                    ->method("ask")
                    ->willReturn("yes");
        $this->config->expects($this->once())->method("getTests")->willReturn("Tests");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getTests(), "Tests");
    }

    public function test_WillSetInteractorNameFromConfig()
    {
        $this->question->expects($this->any())
                           ->method("ask")
                           ->willReturn("yes");
        $this->config->expects($this->once())->method("getTests")->willReturn("Tests");

        $this->timeService->method('getCurrentTime')->willReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("asd");
        $this->assertEquals($context->getInteractorName(), "asd");
    }

    public function test_WillSetDateFromTimeService()
    {
        $dateTime = new DateTime();
        $this->timeService->method('getCurrentTime')->willReturn($dateTime);

        $context = $this->createInteractorContextBuilder->build("asd");
        $this->assertEquals($dateTime, $context->getDateTime());
    }

    protected function setUp()
    {
        $this->question = $this->createMock(IQuestion::class);
        $this->config = $this->createMock(ICreateInteractorContextBuilderConfig::class);
        $this->timeService = $this->createMock(ITimeService::class);
        $this->createInteractorContextBuilder = new CreateInteractorContextBuilder($this->question, $this->config, $this->timeService);
    }
}
