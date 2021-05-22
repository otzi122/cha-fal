<?php declare(strict_types=1);

/** Challenge – Backend Developer

Write a program that prints all the numbers from 1 to 100. However, for
multiples of 3, instead of the number, print "Falabella". For multiples of 5 print
"IT". For numbers which are multiples of both 3 and 5, print "Integraciones".
But here's the catch: you can use only one `if`. No multiple branches, ternary
operators or `else`.

# Requirements
* 1 if
* You can't use `else`, `else if` or ternary
* Unit tests
* Feel free to apply your SOLID knowledge
* You can write the challenge in any language you want. Here at Falabella we are
big fans of PHP, Kotlin and TypeScript

# Submission
Create a repository on GitLab, GitHub or any other similar service and just send us the link.

 */

class FalabellaChallenge
{
	protected $min;
	protected $max;
	protected $base;
	protected $replacements = [
		'Falabella' 	=> [3],
		'IT' 			=> [5],
		'Integraciones'	=> [3,5],
	];
	
	function __construct( $min, $max )
	{
		$this->min = $min;
		$this->max = $max;

		$this->base = $this->generateNumberRange();
	}

	public function getNumbers()
	{
		return $this->base;
	}

	public function generateNumberRange()
	{
		return array_combine( range( $this->min, $this->max ), range( $this->min, $this->max ) );
	}

	public function generateMultipleRange( $multiple )
	{
		return array_filter( $this->generateNumberRange(), function( $item ) use ( $multiple )
		{
			return $item % $multiple == 0;
		});
	}

	public function generateTextRange( $text, $multiples )
	{
		$range_a = $this->generateMultipleRange( $multiples[0] );
		$range_b = $this->generateMultipleRange( $multiples[1] ?? $multiples[0] );

		return array_fill_keys( array_intersect_assoc( $range_a, $range_b) , $text );
	}

	public function build()
	{
		foreach ($this->replacements as $text => $multiples )
			$this->base = array_replace( $this->base, $this->generateTextRange( $text, $multiples ) );
	}
	

	public function hereWeGo()
	{
		$this->build();

		foreach( $this->base as $number ) echo "{$number} \n";
	}
}


$challenge = new FalabellaChallenge( 1, 100 );
$challenge->hereWeGo();
