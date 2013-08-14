<?php

//namespace Cron\Tests;

//use Cron\MonthField;
//use DateTime;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_MonthFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_MonthField::validate
     */
    public function testValdatesField()
    {
        $f = new Cron_MonthField();
        $this->assertTrue($f->validate('12'));
        $this->assertTrue($f->validate('*'));
        $this->assertTrue($f->validate('*/10,2,1-12'));
    }

    /**
     * @covers Cron_MonthField::increment
     */
    public function testIncrementsDate()
    {
        $d = new DateTime('2011-03-15 11:15:00');
        $f = new Cron_MonthField();
        $f->increment($d);
        $this->assertEquals('2011-04-01 00:00:00', $d->format('Y-m-d H:i:s'));

        $d = new DateTime('2011-03-15 11:15:00');
        $f->increment($d, true);
        $this->assertEquals('2011-02-28 23:59:00', $d->format('Y-m-d H:i:s'));
    }

    /**
     * @covers Cron_MonthField::increment
     */
    public function testIncrementsYearAsNeeded()
    {
        $f = new Cron_MonthField();
        $d = new DateTime('2011-12-15 00:00:00');
        $f->increment($d);
        $this->assertEquals('2012-01-01 00:00:00', $d->format('Y-m-d H:i:s'));
    }

    /**
     * @covers Cron_MonthField::increment
     */
    public function testDecrementsYearAsNeeded()
    {
        $f = new Cron_MonthField();
        $d = new DateTime('2011-01-15 00:00:00');
        $f->increment($d, true);
        $this->assertEquals('2010-12-31 23:59:00', $d->format('Y-m-d H:i:s'));
    }
}
