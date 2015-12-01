<?php

    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 13.10.15
     * Time: 22:58
     */

    namespace Conpago\Cli\CaseConverter;

class CaseConverterTest extends \PHPUnit_Framework_TestCase
{

    public function testUpperWordWillNotBeChanged()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("WORD");
        $this->assertEquals("WORD", $result);
    }

    public function testUpperWordWillBeMadeUpper()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("word");
        $this->assertEquals("WORD", $result);
    }

    public function testPascalCaseWillBeMadeUpperWithUnderscores()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("PascalCase");
        $this->assertEquals("PASCAL_CASE", $result);
    }

    public function testCamelCaseWillBeMadeUpperWithUnderscores()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("camelCase");
        $this->assertEquals("CAMEL_CASE", $result);
    }
}
