<?php

use Litipk\BigNumbers\Decimal as Decimal;


date_default_timezone_set('UTC');


class DecimalLog10Test extends PHPUnit_Framework_TestCase
{
    public function testZeroLog10()
    {
        $zero = Decimal::fromInteger(0);

        $zero_log = $zero->log10();

        $this->assertTrue($zero_log->isNegative());
        $this->assertTrue($zero_log->isInfinite());
    }

    
    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage Decimal can't handle logarithms of negative numbers (it's only for real numbers).
     */
    public function testNegativeLog10()
    {
        Decimal::fromInteger(-1)->log10();
    }

    public function testBigNumbersLog10()
    {
        $bignumber = Decimal::fromString(bcpow('10', '2417'));
        $pow = Decimal::fromInteger(2417);

        $this->assertTrue($bignumber->log10()->equals($pow));
    }

    public function testLittleNumbersLog10()
    {
        $littlenumber = Decimal::fromString(bcpow('10', '-2417', 2417));
        $pow = Decimal::fromInteger(-2417);

        $this->assertTrue($littlenumber->log10()->equals($pow));
    }

    public function testMediumNumbersLog10()
    {
        $this->assertTrue(Decimal::fromInteger(75)->log10(5)->equals(Decimal::fromString('1.87506')));
        $this->assertTrue(Decimal::fromInteger(49)->log10(7)->equals(Decimal::fromString('1.6901961')));
    }
}
