<?php

//namespace Cron\Tests;

//use Cron\YearField;
//use DateTime;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_YearFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_YearField::validate
     */
    public function testValdatesField()
    {
        $f = new Cron_YearField();
        $this->assertTrue($f->validate('2011'));
        $this->assertTrue($f->validate('*'));
        $this->assertTrue($f->validate('*/10,2012,1-12'));
    }

    /**
     * @covers Cron_YearField::increment
     */
    public function testIncrementsDate()
    {
        $d = new DateTime('2011-03-15 11:15:00');
        $f = new Cron_YearField();
        $f->increment($d);
        $this->assertEquals('2012-01-01 00:00:00', $d->format('Y-m-d H:i:s'));
        $f->increment($d, true);
        $this->assertEquals('2011-12-31 23:59:00', $d->format('Y-m-d H:i:s'));
    }
}
