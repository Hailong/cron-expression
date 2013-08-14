<?php

//namespace Cron\Tests;

//use Cron\HoursField;
//use DateTime;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_HoursFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_HoursField::validate
     */
    public function testValdatesField()
    {
        $f = new Cron_HoursField();
        $this->assertTrue($f->validate('1'));
        $this->assertTrue($f->validate('*'));
        $this->assertTrue($f->validate('*/3,1,1-12'));
     }

    /**
     * @covers Cron_HoursField::increment
     */
    public function testIncrementsDate()
    {
        $d = new DateTime('2011-03-15 11:15:00');
        $f = new Cron_HoursField();
        $f->increment($d);
        $this->assertEquals('2011-03-15 12:00:00', $d->format('Y-m-d H:i:s'));

        $d->setTime(11, 15, 0);
        $f->increment($d, true);
        $this->assertEquals('2011-03-15 10:59:00', $d->format('Y-m-d H:i:s'));
    }
}
