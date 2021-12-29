<?php
// https://venus.ioaffitto.it/classes/Newsboy/Client/v1/tests/navigator.php

$GLOBALS["cms_path"] = __DIR__ .'/../../../../../gccms/';
require_once "{$GLOBALS["cms_path"]}/pages/_inc_main_pubblic_smart.php";

$api = new \Newsboy\Client\v1\ApiPersistent();
$api->login($pagina_root->getCustomElVal("annunci_api_username", $lang_id), $pagina_root->getCustomElVal("annunci_api_password", $lang_id));
$navigator = new \Newsboy\Client\v1\Navigator ($api);


$act = \URL::get ('act', 'list', ['list','detail']);

switch ($act){
	case 'list':
		$page = (int)\URL::get ('page');
		$find = $navigator->find ('affitto_all', $page, [
			'wanted' => ['content','images','price']
		]);
		\Nicer::print_r ($find);
		foreach ($find->items as $item){
			?>
				<a href="?<?=http_build_query(['act'=>'detail', 'id'=>$item->id])?>"><img width="190" src="<?=$item->fields->images[0] ?? 'https://en.wikipedia.org/wiki/File:No_image_available.svg'?>" /></a>
			<?php
		}
		?>
		<hr>
		<a href="?act=list&page=<?=$page >0? $page-1:0?>">[pagina precedente]</a>
		<a href="?act=list&page=<?=$page+1?>">[pagina successiva]</a>
		<?
		break;


	case 'detail':
		$ad = new \Newsboy\Client\v1\Ad ($api);
		$info = $ad->info (URL::get('id'));
		$offset = $navigator->seekTo($info->id);
		$next = $navigator->nextItem();
		$prev = $navigator->previousItem();
		// \Nicer::print_r ($info, 'ad info');
		// \Nicer::print_r ($next, '$next');
		// \Nicer::print_r ($prev, '$prev');
		
		?>
			<h2><?=$info->id?> [<?=$offset?>]</h2>
			<img width="640" src="<?=$info->fields->images[0] ?? 'https://en.wikipedia.org/wiki/File:No_image_available.svg'?>" />

			<hr>
			<a href="?act=detail&id=<?= $prev? $prev->id : 0?>">[precedente]</a>
			<a href="?act=detail&id=<?= $next? $next->id : 0?>">[successivo]</a>
		<?php
		break;
}




