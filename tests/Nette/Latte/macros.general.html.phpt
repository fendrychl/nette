<?php

/**
 * Test: Nette\Latte\Engine: general HTML test.
 *
 * @author     David Grudl
 * @package    Nette\Latte
 * @subpackage UnitTests
 * @keepTrailingSpaces
 */

use Nette\Latte,
	Nette\Templating\FileTemplate,
	Nette\Utils\Html;



require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/Template.inc';



TestHelpers::purge(TEMP_DIR);


Html::$xhtml = FALSE;
$template = new FileTemplate(__DIR__ . '/templates/general.latte');
$template->registerFilter(new Latte\Engine);
$template->registerHelper('translate', 'strrev');
$template->registerHelper('join', 'implode');
$template->registerHelperLoader('Nette\Templating\DefaultHelpers::loader');

$template->hello = '<i>Hello</i>';
$template->xss = 'some&<>"\'/chars';
$template->people = array('John', 'Mary', 'Paul', ']]>');
$template->menu = array('about', array('product1', 'product2'), 'contact');
$template->comment = 'test -- comment';
$template->el = Html::el('div')->title('1/2"');

$path = __DIR__ . '/expected/' . basename(__FILE__, '.phpt');
Assert::match(file_get_contents("$path.phtml"), codefix($template->compile()));
Assert::match(file_get_contents("$path.html"), $template->__toString(TRUE));
