<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    protected static $challenge;

    public static function setUpBeforeClass(): void
    {
        self::$challenge  = new FalabellaChallenge(1,100);
        self::$challenge->build();
    }

    /**
     * Write a program that prints all the numbers from 1 to 100.
     *
     **/
    public function testGetAllNumbers()
    {
        $numbers = self::$challenge ->getNumbers();
        $this->assertIsArray( $numbers  );
        $this->assertEquals( 100, count( $numbers ) );
    }

    /** 
     *  However, for multiples of 3, instead of the number, print "Falabella". For multiples of 5 print
     *  "IT". For numbers which are multiples of both 3 and 5, print "Integraciones". 
    **/
    public function testGetAllMultiples()
    {
        $numbers = self::$challenge ->getNumbers();

        foreach( $numbers as $key => $number )
        {
            # Multiples of both 3 and 5
            if( $key %3 == 0 && $key %5 == 0 )
                $this->assertEquals( 'Integraciones', $number );
            
            # Multiples of 5
            else if( $key %5 == 0 )
                $this->assertEquals( 'IT', $number );

            # Multiples of 3
            else if( $key %3 == 0)
                $this->assertEquals( 'Falabella', $number );

            else
                $this->assertIsInt( $number );

        }
    }
}