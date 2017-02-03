<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 17.10.15
     * Time: 23:38
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\CommandHelp;
    use Conpago\Cli\Contract\IApplicationPresenter;
    use Conpago\Cli\Contract\IOutput;

    /**
     * Class ApplicationPresenter
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class ApplicationPresenter implements IApplicationPresenter
    {

        private $version = "0.0.1-alpha";
        private $author = "Bartosz Gołek";

        /**
         * @var IOutput
         */
        protected $output;

        /**
         * ApplicationPresenter constructor.
         *
         * @param IOutput $output
         */
        public function __construct(IOutput $output)
        {
            $this->output = $output;
        }

        /**
         * @param CommandHelp[] Commands help
         *
         * @return void
         */
        public function printHelp(array $commands_help = null)
        {
            $this->output->writeLine("Usage: conpago <command> [command_options]");
            if ($commands_help != null && count($commands_help) > 0) {
                $this->output->writeLine();
                $this->output->writeLine("Commands:");
                $this->output->writeLine();

                /** @var CommandHelp $command_help */
                foreach ($commands_help as $command_help) {
                    $padded_name = str_pad($command_help->getName(), 25, " ", STR_PAD_RIGHT);
                    $this->output->writeLine("  %s %s.", [$padded_name, $command_help->getHelpText()]);
                }
            }
            $this->output->writeLine();
            $this->output->writeLine("Miscellaneous Options:");
            $this->output->writeLine();
            $this->output->writeLine("  -h|--help                 Prints this usage information.");
            $this->output->writeLine("  -h|--help <command>       Prints detailed command usage information.");
            $this->output->writeLine("  --version                 Prints the version and exits.");
        }

        public function printVersion()
        {
            $this->output->writeLine("Conpago %s by %s", [$this->version, $this->author]);
            $this->output->writeLine();
        }

        /**
         * @param string $command_name
         *
         * @return void
         */
        public function printCommandNotFound($command_name)
        {
            $this->output->writeLine('Could not find command \'%s\'!', [$command_name]);
            $this->output->writeLine();
        }
    }
