<?php

/**
 * Test: Nette\Collections\ArrayList adding items.
 *
 * @author     David Grudl
 * @category   Nette
 * @package    Nette\Collections
 * @subpackage UnitTests
 */

use Nette\Collections\ArrayList;



require __DIR__ . '/../initialize.php';

require __DIR__ . '/Collections.inc';



$list = new ArrayList(NULL, 'Person');

$jack = new Person('Jack');
$mary = new Person('Mary');
$foo = new ArrayObject();



T::note("Adding Jack");
$list->append($jack);

T::note("Adding Mary");
$list->append($mary);

try {
	T::note("Adding invalid item");
	$list->append($foo);

} catch (Exception $e) {
	T::dump( $e );
}

T::note("Adding Jack using []");
$list[] = $jack;

try {
	T::note("Adding invalid item using []");
	$list[] = $foo;

} catch (Exception $e) {
	T::dump( $e );
}



T::dump( $list->count(), 'count:' );
T::dump( count($list) );


T::dump( $list );

T::dump( (array) $list );



T::note("Get Interator:");
foreach ($list as $key => $person) {
	echo $key, ' => ', $person->sayHi();
}



T::note("Clearing");
$list->clear();

T::dump( $list );



__halt_compiler() ?>

------EXPECT------
Adding Jack

Adding Mary

Adding invalid item

Exception InvalidArgumentException: Item must be 'Person' object.

Adding Jack using []

Adding invalid item using []

Exception InvalidArgumentException: Item must be 'Person' object.

count: int(3)

int(3)

object(%ns%ArrayList) (3) {
	"0" => object(Person) (1) {
		"name" private => string(4) "Jack"
	}
	"1" => object(Person) (1) {
		"name" private => string(4) "Mary"
	}
	"2" => object(Person) (1) {
		"name" private => string(4) "Jack"
	}
}

array(3) {
	0 => object(Person) (1) {
		"name" private => string(4) "Jack"
	}
	1 => object(Person) (1) {
		"name" private => string(4) "Mary"
	}
	2 => object(Person) (1) {
		"name" private => string(4) "Jack"
	}
}

Get Interator:

0 => My name is Jack

1 => My name is Mary

2 => My name is Jack

Clearing

object(%ns%ArrayList) (0) {}