<?php

use PHPUnit\Framework\TestCase;
use App\Calculator;

class CalculatorTest extends TestCase
{
    public function testAddition()
    {
        $calc = new Calculator();
        $res = $calc->calculate('add', 2, 3);

        self::assertEquals(5, $res);
    }

    public function testSub()
    {
        $calc = new Calculator();
        $res = $calc->calculate('sub', 2, 3);

        self::assertEquals(-1, $res);
    }

    public function testSubLessThenZero()
    {
        $calc = new Calculator();
        $res = $calc->calculate('sub', 2, -3);

        self::assertEquals(5, $res);
    }

    public function testSubNegativeRes()
    {
        $calc = new Calculator();
        $res = $calc->calculate('sub', -2, 2);

        self::assertEquals(-4, $res);
    }


    public function testAdditionZeroResult()
    {
        $calc = new Calculator();
        $res = $calc->calculate('add', -2, 2);

        self::assertEquals(0, $res);
    }

    public function testMul()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mul', 2, 3);

        self::assertEquals(6, $res);
    }

    public function testMulNegativeSecondNum()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mul', 2, -3);

        self::assertEquals(-6, $res);
    }

    public function testMulNegativeFirstNum()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mul', -2, 3);

        self::assertEquals(-6, $res);
    }

    public function testMulZero()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mul', -2, 0);

        self::assertEquals(0, $res);
    }


    public function testMulBothNegative()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mul', -2, -5);

        self::assertEquals(10, $res);
    }

    public function testDiv()
    {
        $calc = new Calculator();
        $res = $calc->calculate('div', 24, 2);

        self::assertEquals(12, $res);
    }


    public function testDivSecondNumMore()
    {
        $calc = new Calculator();
        $res = $calc->calculate('div', 2, 20);

        self::assertEquals(0.1, $res);
    }

    public function testDivSameNums()
    {
        $calc = new Calculator();
        $res = $calc->calculate('div', 20, 20);

        self::assertEquals(1, $res);
    }


    public function testDivNegative()
    {
        $calc = new Calculator();
        $res = $calc->calculate('div', 44, -2);

        self::assertEquals(-22, $res);
    }

    public function testDivisionByZero()
    {
        $this->expectException(Exception::class);
        $calc = new Calculator();
        $res = $calc->calculate('div', 5, 0);

        self::assertEquals("Division by zero is not allowed.", $res);
    }

    public function testDivisionByZeroFirstNegative()
    {
        $this->expectException(Exception::class);
        $calc = new Calculator();
        $res = $calc->calculate('div', -4, 0);

        self::assertEquals("Division by zero is not allowed.", $res);
    }

    public function testInvalidNumber()
    {
        $calc = new Calculator();
        $error = $calc->validate('abc', 3);

        self::assertEquals("Number 1 must be numeric.", $error);
    }

    public function testSquareRootNegative()
    {
        $this->expectException(Exception::class);
        $calc = new Calculator();
        $calc->calculate('square-root', -9);

        $this->expectExceptionMessage("Cannot take square root of a negative number.");
    }

    public function testModPositive()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mod', 10, 3);
        self::assertEquals(1, $res);
    }

    public function testModNegativeDividend()
    {
        $calc = new Calculator();
        $res = $calc->calculate('mod', -10, 3);
        self::assertEquals(-1, $res);
    }

    public function testModByZero()
    {
        $this->expectException(\DivisionByZeroError::class);
        $calc = new Calculator();
        $calc->calculate('mod', 10, 0);
    }


    public function testSin()
    {
        $calc = new Calculator();
        $res = $calc->calculate('sin', 0);
        self::assertEquals(0, $res, '', 0.0001);
    }

    public function testCos()
    {
        $calc = new Calculator();
        $res = $calc->calculate('cos', 0);
        self::assertEquals(1, $res, '', 0.0001);
    }

    public function testLogValid()
    {
        $calc = new Calculator();
        $res = $calc->calculate('log', 1);
        self::assertEquals(0, $res, '', 0.0001);
    }


    public function testLogNonPositive()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Logarithm of zero or negative is undefined.");
        $calc = new Calculator();
        $calc->calculate('log', 0);
    }

    public function testPowPositive()
    {
        $calc = new Calculator();
        $res = $calc->calculate('pow', 2, 3);
        self::assertEquals(8, $res);
    }

    public function testPowFractional()
    {
        $calc = new Calculator();
        $res = $calc->calculate('pow', 4, 0.5);
        self::assertEquals(2, $res);
    }

    public function testValidateSecondNumberMissing()
    {
        $calc = new Calculator();
        $error = $calc->validate(5, null);
        self::assertEquals('', $error);
    }

    public function testValidateUnaryOperationWithInvalidSecondNum()
    {
        $calc = new Calculator();
        $error = $calc->validate(25, 'abc');
        self::assertEquals("Number 2 must be numeric.", $error);
    }
}
