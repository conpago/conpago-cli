<?php
    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-19
     * Time: 08:30
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Cli\Contract\IOutput;

class CreateInteractorPresenterTest extends \PHPUnit_Framework_TestCase
{

    /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        protected $output;
        /**
         * @var CreateInteractorPresenter
         */
        protected $createInteractorPresenter;

    protected function setUp()
    {
        $this->output                    = $this->createMock(IOutput::class);
        $this->createInteractorPresenter = new CreateInteractorPresenter($this->output);
    }

    public function testPrintHelp_willPrintHelp()
    {
        $desc = "Desc";
        $this->output->expects($this->exactly(4))
                         ->method('writeLine')
                         ->withConsecutive(
                                 ["Usage: conpago interactor <InteractorName>", null],
                                 [null, null],
                                 [$desc, null],
                                 [null, null]
                         );
        $this->createInteractorPresenter->printHelp($desc);
    }

    public function testPrintMissingParameter_willMissingParameterMessage()
    {
        $this->output->expects($this->exactly(2))
                         ->method('writeLine')
                         ->withConsecutive(
                                 ["Missing parameter <InteractorName>.", null],
                                 [null, null]
                         );
        $this->createInteractorPresenter->printMissingParameter();
    }
}
