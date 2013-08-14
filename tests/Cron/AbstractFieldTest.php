<?php

//namespace Cron\Tests;

//use Cron\DayOfWeekField;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_AbstractFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_AbstractField::isRange
     */
    public function testTestsIfRange()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isRange('1-2'));
        $this->assertFalse($f->isRange('2'));
    }

    /**
     * @covers Cron_AbstractField::isIncrementsOfRanges
     */
    public function testTestsIfIncrementsOfRanges()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertFalse($f->isIncrementsOfRanges('1-2'));
        $this->assertFalse($f->isIncrementsOfRanges('1-2'));
        $this->assertTrue($f->isIncrementsOfRanges('1/2'));
        $this->assertTrue($f->isIncrementsOfRanges('*/2'));
        $this->assertTrue($f->isIncrementsOfRanges('3-12/2'));
    }

    /**
     * @covers Cron_AbstractField::isInRange
     */
    public function testTestsIfInRange()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isInRange(1, '1-2'));
        $this->assertTrue($f->isInRange(2, '1-2'));
        $this->assertTrue($f->isInRange(5, '4-12'));
        $this->assertFalse($f->isInRange(3, '4-12'));
        $this->assertFalse($f->isInRange(13, '4-12'));
    }

    /**
     * @covers Cron_AbstractField::isInIncrementsOfRanges
     */
    public function testTestsIfInIncrementsOfRanges()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isInIncrementsOfRanges(3, '3-59/2'));
        $this->assertTrue($f->isInIncrementsOfRanges(13, '3-59/2'));
        $this->assertTrue($f->isInIncrementsOfRanges(15, '3-59/2'));
        $this->assertTrue($f->isInIncrementsOfRanges(14, '*/2'));
        $this->assertFalse($f->isInIncrementsOfRanges(2, '3-59/13'));
        $this->assertFalse($f->isInIncrementsOfRanges(14, '*/13'));
        $this->assertFalse($f->isInIncrementsOfRanges(14, '3-59/2'));

        $this->assertTrue($f->isInIncrementsOfRanges(4, '4/10'));
        $this->assertTrue($f->isInIncrementsOfRanges(14, '4/10'));
        $this->assertTrue($f->isInIncrementsOfRanges(34, '4/10'));
    }

    /**
     * @covers Cron_AbstractField::isSatisfied
     */
    public function testTestsIfSatisfied()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isSatisfied('12', '3-13'));
        $this->assertTrue($f->isSatisfied('15', '3-59/12'));
        $this->assertTrue($f->isSatisfied('12', '*'));
        $this->assertTrue($f->isSatisfied('12', '12'));
        $this->assertFalse($f->isSatisfied('12', '3-11'));
        $this->assertFalse($f->isSatisfied('12', '3-59/13'));
        $this->assertFalse($f->isSatisfied('12', '11'));
    }
}
