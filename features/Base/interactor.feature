Feature: interactor
  In order to generate interactor with surroundings
  As an commandline user
  I need to be able to run cli command 'interactor'

  Scenario: Create simple interactor
    Given The files are not exists:
      """
      tmp/Space/SubSpace/Business/Contract/Interactor/Test.php
      """
    When I run 'interactor' cli command
    Then File 'tmp/Space/SubSpace/Business/Contract/Interactor/Test.php' exists with following content:
"""
<?php
	namespace Space\SubSpace\Business\Contract\Interactor;

	interface ITest
	{
		function run();
	}
"""

