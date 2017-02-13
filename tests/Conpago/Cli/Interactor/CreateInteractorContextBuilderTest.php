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
    use Phake;
    use Phake_IMock as Mock;

    class CreateInteractorContextBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var CreateInteractorContextBuilder */
    protected $createInteractorContextBuilder;

    /** @var Mock */
    protected $question;

    /** @var Mock */
    protected $config;

    /** @var Mock */
    protected $timeService;

    public function test_WillAskForContextData()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
            ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        $this->createInteractorContextBuilder->build("");

        Phake::inOrder(
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create access right for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create request data object for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create request data validator?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create dao for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create logger for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create presenter model for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            ),
            Phake::verify($this->question, Phake::times(1))->ask(
                $this->equalTo("Create Conpago/DI module for interactor?"),
                $this->equalTo(["yes", "no"]),
                $this->equalTo("yes")
            )
        );
    }

    public function test_WillNotAskForDataValidatorWhenThereIsNoDataContextData()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('no');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        $this->createInteractorContextBuilder->build("");

        Phake::verify($this->question, Phake::times(0))->ask(
            $this->equalTo("Create request data validator?"),
            $this->anything(),
            $this->anything()
        );
    }

    public function test_WillSetDataValidatorToFalseWhenThereIsNoDataContextData()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('no');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        $context = $this->createInteractorContextBuilder->build("");

        $this->assertFalse($context->getVariable(InteractorParts::REQUEST_DATA_VALIDATOR));
    }

    public function test_WillBuildContextWithGatheredData()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
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
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        Phake::when($this->config)->getAuthor()->thenReturn("Authorrr");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getAuthor(), "Authorrr");
    }

    public function test_WillSetCompanyFromConfig()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        Phake::when($this->config)->getCompany()->thenReturn("Company");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getCompany(), "Company");
    }

    public function test_WillSetProjectFromConfig()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        Phake::when($this->config)->getProject()->thenReturn("Project");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getProject(), "Project");
    }

    public function test_WillSetSourcesFromConfig()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        Phake::when($this->config)->getSources()->thenReturn("Sources");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getSources(), "Sources");
    }

    public function test_WillSetTestsFromConfig()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());
        Phake::when($this->config)->getTests()->thenReturn("Tests");

        $context = $this->createInteractorContextBuilder->build("");
        $this->assertEquals($context->getTests(), "Tests");
    }

    public function test_WillSetInteractorNameFromParameter()
    {
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn(new DateTime());

        $context = $this->createInteractorContextBuilder->build("asd");
        $this->assertEquals($context->getInteractorName(), "asd");
    }

    public function test_WillSetDateFromTimeService()
    {
        $dateTime = new DateTime();
        Phake::when($this->question)
             ->ask($this->anything(), $this->anything(), $this->anything())
             ->thenReturn('yes');

        Phake::when($this->timeService)->getCurrentTime()->thenReturn($dateTime);

        $context = $this->createInteractorContextBuilder->build("asd");
        $this->assertEquals($dateTime, $context->getDateTime());
    }

    protected function setUp()
    {
        $this->question = Phake::mock(IQuestion::class);
        $this->config = Phake::mock(ICreateInteractorContextBuilderConfig::class);
        $this->timeService = Phake::mock(ITimeService::class);

        $this->createInteractorContextBuilder = new CreateInteractorContextBuilder($this->question, $this->config, $this->timeService);
    }
}
