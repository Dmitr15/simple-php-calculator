<?php

namespace App;

class Calculator
{
    public function validate($num1, $num2 = null)
    {
        if (!is_numeric($num1)) {
            return "Number 1 must be numeric.";
        }

        if ($num2 !== null && $num2 !== '' && !is_numeric($num2)) {
            return "Number 2 must be numeric.";
        }

        return '';
    }

    public function calculate($operation, $num1, $num2 = null)
    {
        $num1 = (float)$num1;
        $num2 = $num2 !== null ? (float)$num2 : null;

        switch ($operation) {
            case 'add':
                return $num1 + $num2;
            case 'sub':
                return $num1 - $num2;
            case 'mul':
                return $num1 * $num2;
            case 'div':
                if ($num2 == 0) {
                    throw new \Exception("Division by zero is not allowed.");
                }
                return $num1 / $num2;
            case 'mod':
                return $num1 % $num2;
            case 'square-root':
                if ($num1 < 0) {
                    throw new \Exception("Cannot take square root of a negative number.");
                }
                return sqrt($num1);
            case 'sin':
                return sin($num1);
            case 'cos':
                return cos($num1);
            case 'tan':
                return tan($num1);
            case 'log':
                if ($num1 <= 0) {
                    throw new \Exception("Logarithm of zero or negative is undefined.");
                }
                return log($num1);
            case 'log10':
                if ($num1 <= 0) {
                    throw new \Exception("Log10 of zero or negative is undefined.");
                }
                return log10($num1);
            case 'pow':
                return pow($num1, $num2);
            default:
                throw new \Exception("Invalid operation.");
        }
    }
}
