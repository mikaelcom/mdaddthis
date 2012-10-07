<?php
/**
 * Script d'affichage du contenu du script javascript pour la page
 * @date 05/07/2011
 */
/**
 * Contenu
 */
$tpl = $operatorParameters = $rootNamespace = $currentNamespace = $operatorValue = $namedParameters = array(
																											'display_tags'=>false);
$content = addThis::instance()->modify($tpl,'display_addthis',$operatorParameters,$rootNamespace,$currentNamespace,$operatorValue,$namedParameters);
/**
 * Pas de pagelayout
 */
$Result['pagelayout'] = false;
if(class_exists('JSMin',true))
	$content = JSMin::minify($content);
else
{
	$ezjscINI = eZINI::instance('ezjscore.ini');
	foreach($ezjscINI->variable('eZJSCore','JavaScriptOptimizer') as $optimizer)
		$content = call_user_func(array(
										$optimizer,
										'optimize'),$content,3);
}
$Result['content'] = $content;
?>