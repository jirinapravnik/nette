<?php

/**
 * Test: Nette\Mail\Message with template.
 *
 * @author     David Grudl
 */

use Nette\Latte,
	Nette\Mail\Message,
	Nette\Templating\FileTemplate,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/Mail.inc';


$mail = new Message();
$mail->addTo('Lady Jane <jane@example.com>');

$template = new Nette\Bridges\ApplicationLatte\Template(new Latte\Engine);
$template->setFile('files/template.phtml');
$mail->htmlBody = $template;

$mailer = new TestMailer();
$mailer->send($mail);

Assert::matchFile(__DIR__ . '/Mail.template.expect', TestMailer::$output);
