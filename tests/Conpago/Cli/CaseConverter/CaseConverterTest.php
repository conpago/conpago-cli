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

    public function testToMacroCaseWillLeaveUpperWordNotBeChanged()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("WORD");
        $this->assertEquals("WORD", $result);
    }

    public function testToMacroCaseWillUpperWord()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("word");
        $this->assertEquals("WORD", $result);
    }

    public function testToMacroCaseWillChangePascalCaseToUpperWithUnderscores()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("PascalCase");
        $this->assertEquals("PASCAL_CASE", $result);
    }

    public function testToMacroCaseWillChangeCamelCaseToUpperWithUnderscores()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toMacroCase("camelCase");
        $this->assertEquals("CAMEL_CASE", $result);
    }

    public function testToCamelCaseWillChangeMacroCaseToCamelCase()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toCamelCase("MACRO_CASE");
        $this->assertEquals("macroCase", $result);
    }

    public function testToCamelCaseWillChangeLowerCaseToCamelCase()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toCamelCase("lower_case");
        $this->assertEquals("lowerCase", $result);
    }

    public function testToCamelCaseWillChangePascalCaseToCamelCase()
    {
        $caseConverter = new CaseConverter();
        $result = $caseConverter->toCamelCase("PascalCase");
        $this->assertEquals("pascalCase", $result);
    }
}
