<?php

//namespace Cron\Tests;

//use Cron\DayOfWeekField;
//use DateTime;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_DayOfWeekFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_DayOfWeekField::validate
     */
    public function testValdatesField()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->validate('1'));
        $this->assertTrue($f->validate('*'));
        $this->assertTrue($f->validate('*/3,1,1-12'));
        $this->assertTrue($f->validate('SUN-2'));
    }

    /**
     * @covers Cron_DayOfWeekField::isSatisfiedBy
     */
    public function testChecksIfSatisfied()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isSatisfiedBy(new DateTime(), '?'));
    }

    /**
     * @covers Cron_DayOfWeekField::increment
     */
    public function testIncrementsDate()
    {
        $d = new DateTime('2011-03-15 11:15:00');
        $f = new Cron_DayOfWeekField();
        $f->increment($d);
        $this->assertEquals('2011-03-16 00:00:00', $d->format('Y-m-d H:i:s'));

        $d = new DateTime('2011-03-15 11:15:00');
        $f->increment($d, true);
        $this->assertEquals('2011-03-14 23:59:00', $d->format('Y-m-d H:i:s'));
    }

    /**
     * @covers Cron_DayOfWeekField::isSatisfiedBy
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Weekday must be a value between 1 and 5. 12 given
     */
    public function testValidatesHashValueWeekday()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isSatisfiedBy(new DateTime(), '12#1'));
    }

    /**
     * @covers Cron_DayOfWeekField::isSatisfiedBy
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage There are never more than 5 of a given weekday in a month
     */
    public function testValidatesHashValueNth()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isSatisfiedBy(new DateTime(), '3#6'));
    }

    /**
     * @covers Cron_DayOfWeekField::isSatisfiedBy
     */
    public function testHandlesZeroAndSevenDayOfTheWeekValues()
    {
        $f = new Cron_DayOfWeekField();
        $this->assertTrue($f->isSatisfiedBy(new DateTime('2011-09-04 00:00:00'), '0-2'));
        $this->assertTrue($f->isSatisfiedBy(new DateTime('2011-09-04 00:00:00'), '6-0'));
    }
}
