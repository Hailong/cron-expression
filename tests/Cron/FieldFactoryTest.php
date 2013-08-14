<?php

//namespace Cron\Tests;

//use Cron\FieldFactory;

/**
 * @author Michael Dowling <mtdowling@gmail.com>
 */
class Cron_FieldFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cron_FieldFactory::getField
     */
    public function testRetrievesFieldInstances()
    {
        $mappings = array(
            0 => 'Cron_MinutesField',
            1 => 'Cron_HoursField',
            2 => 'Cron_DayOfMonthField',
            3 => 'Cron_MonthField',
            4 => 'Cron_DayOfWeekField',
            5 => 'Cron_YearField'
        );

        $f = new Cron_FieldFactory();

        foreach ($mappings as $position => $class) {
            $this->assertEquals($class, get_class($f->getField($position)));
        }
    }

    /**
     * @covers Cron_FieldFactory::getField
     * @expectedException InvalidArgumentException
     */
    public function testValidatesFieldPosition()
    {
        $f = new Cron_FieldFactory();
        $f->getField(-1);
    }
}
