<?php
/* This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://sam.zoy.org/wtfpl/COPYING for more details. */

require 'Slim/Slim.php';
$app = new Slim();
 
/* CONFIG */
define('DOMAIN', 'http://shre.me/s/');
require_once('ezSQL/shared/ez_sql_core.php');
require_once('ezSQL/mysql/ez_sql_mysql.php');

/* Index */
$app->get('/', function () use ($app) {
/*
$template = <<<EOT
Ya, is that true ?
    <form method="post" action="./makeUrl"/>
				<label for="url">Enter a long url :</label>
				<input type="text" name="url" id="url" placeholder="http://exemple.com/"/>
				
				<label for="custom_alias">Custom alias (optional) :</label>
				<input type="text" name="custom_alias" id="custom_alias"/>
				
				<input type="hidden" name="captcha"/>
				<input type="submit" value="Yeah ! Rock-it baby !"/>
			</form>
EOT;
    echo $template;
*/
$app->render('index.php');
});


/* URL */
$app->get('/:url', function ($url) use ($app){	
	$db = new ezSQL_mysql('user','password','db','host');
	// On va chercher si on trouve une url dans la bdd.
	if($db->get_row('SELECT longURL, stats FROM urls WHERE shortURL = \''.$db->escape($url).'\'')){
		$long_url = $db->get_row(null, OBJECT, 0);
		$u = $long_url->stats+1;
		$db->query('UPDATE urls SET stats = '.$u.' WHERE shortURL = \''.$db->escape($url).'\'');
		header('Location: '.$long_url->longURL);
		exit();
			
	}
	else{
		$app->render('404.php', array('url' => $url));
	}
});


/* Make URL */
$app->post('/makeUrl', function () use ($app) {
    $db = new ezSQL_mysql('user','password','db','host');
 
    if(!empty($_POST['url']) AND empty($_POST['captcha'])){
		
		// On commence par regarder si l'id n'existe pas déjà dans la base, et si il y en a un personnalisé.
		if(empty($_POST['alias']) OR !preg_match('#^[a-z0-9A-Z]+$#',$_POST['alias'])) $alias = GenerateRandomString(4);
		else $alias = $db->escape($_POST['alias']);
		$url = $db->escape($_POST['url']);
		
		if(filter_var($url, FILTER_VALIDATE_URL) !== false){
		
			$k = false;
			while($k == false){
				if($db->get_var('SELECT count(*) FROM urls WHERE shortURL = \''.$db->escape($alias).'\'') == 0){
					$k = true;
				}
			
				else{ $alias = GenerateRandomString(4); }
			}
		
			$db->query('INSERT INTO urls(shortURL, longURL) VALUES(\''.$db->escape($alias).'\', \''.$db->escape($url).'\')');
			$r = '<input type="text" value="'.DOMAIN.$alias.'"/>';
			$app->render('makeurl.php', array( 'content' => $r ));
		}
		
		else{
			$error = 'Invalid url.';
			$app->render('makeurl.php', array( 'error' => $error ));
		}
	}

});

/***************************************************************/

function GenerateRandomString($length = 8)
{
	// 67 allowed characters.
	$allowedCharacters = "abcdefghijklmnopqrstuvwxyz0123456789";

	$randomKey = '';

	for($i = 1; $i <= $length; $i++)
	{
		$randomKey .= $allowedCharacters[rand(0, 35)];
	}

	return $randomKey;
}

$app->run();
