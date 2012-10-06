{* Template d'affichage du code pour addthis *}
{if and(is_set($identifier),is_array($buttons),is_set($size),$buttons|count(),or(and(is_array($containerClasses),$containerClasses|count()),and(is_array($containerIds),$containerIds|count())))}
	{if and(is_set($display_tags),eq($display_tags,true()))}
	<script src="/mdaddthis/script.js" type="text/javascript" charset="utf-8"></script>
	{else}
		{* Génération du conteneur principal*}
		var divContainer = document.createElement('div');
		{* Génération des boutons *}
		{foreach $buttons as $button}
		var buttonLink = document.createElement('a');
		buttonLink.setAttribute('class','{$button}');
		divContainer.appendChild(buttonLink);
		{/foreach}
		{* Ajout à la/aux zones de la page *}
		{if and(is_array($containerClasses),$containerClasses|count())}
		{foreach $containerClasses as $containerClass}
		if(document.querySelectorAll && document.querySelectorAll('.{$containerClass}').length)
		{literal}{{/literal}
		clone = divContainer.cloneNode(true);
		{if is_set($sizes[$containerClass])}
		clone.setAttribute('class','addthis_toolbox addthis_default_style{$sizes[$containerClass]}');
		{else}
		clone.setAttribute('class','addthis_toolbox addthis_default_style{$size}');
		{/if}
		document.querySelectorAll('.{$containerClass}').item(0).appendChild(clone);
		{literal}}{/literal}
		{/foreach}
		{/if}
		{if and(is_array($containerIds),$containerIds|count())}
		{foreach $containerIds as $containerId}
		if(document.getElementById('{$containerId}'))
		{literal}{{/literal}
		clone = divContainer.cloneNode(true);
		{if is_set($sizes[$containerId])}
		clone.setAttribute('class','addthis_toolbox addthis_default_style{$sizes[$containerId]}');
		{else}
		clone.setAttribute('class','addthis_toolbox addthis_default_style{$size}');
		{/if}
		document.getElementById('{$containerId}').appendChild(clone);
		{literal}}{/literal}
		{/foreach}
		{/if}
		{literal}
		var addthis_config = {'data_track_clickback':true};
		{/literal}
		{if ne($data_ga_property,'')}
			addthis_config.data_ga_property = '{$data_ga_property}';
		{/if}
		var script = document.createElement('script');
		script.setAttribute('src','http://s7.addthis.com/js/250/addthis_widget.js#pubid={$identifier}&domready=1');
		script.setAttribute('type','text/javascript');
		document.getElementsByTagName('body').item(0).appendChild(script);
	{/if}
{/if}