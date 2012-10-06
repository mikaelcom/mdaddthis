<?php
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Add This Interface
// SOFTWARE RELEASE: 1.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2010 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//
class addThis
{
	/**
	 * @var string
	 */
	private static $ini;
	/**
	 * 
	 * Enter description here ...
	 */
	function addThis()
	{
		addThis::$ini = eZINI::instance('addthis.ini');
	}
	function operatorList()
	{
		return array(
					'display_addthis');
	}
	function namedParameterPerOperator()
	{
		return true;
	}
	function namedParameterList()
	{
		return array(
					'display_addthis'=>array());
	}
	function modify($tpl,$operatorName,$operatorParameters,&$rootNamespace,&$currentNamespace,&$operatorValue,&$namedParameters)
	{
		$namedParameters = array_merge(array(
											'display_tags'=>true),$namedParameters);
		$buttons = $this->getIni()->variable('SiteSettings','Buttons');
		$size = $this->getIni()->variable('SiteSettings','Size');
		$sizes = $this->getIni()->variable('SiteSettings','Sizes');
		$identifier = $this->getIni()->variable('SiteSettings','Identifier');
		$containerClasses = $this->getIni()->variable('SiteSettings','ContainerClasses');
		$containerIds = $this->getIni()->variable('SiteSettings','ContainerIds');
		$availableSizes = $this->getIni()->variable('Availables','Sizes');
		$data_ga_property = class_exists('googleAnalytics',true)?googleAnalytics::instance()->getIni()->variable('SiteSettings','GoogleAccount'):'';
		if(!empty($buttons) && !empty($size) && array_key_exists($size,$availableSizes) && !empty($identifier) && (!empty($containerClasses) || !empty($containerIds)))
		{
			switch($operatorName)
			{
				case 'display_addthis':
					$tpl = eZTemplate::factory();
					$tpl->setVariable('identifier',$identifier);
					$tpl->setVariable('size',$availableSizes[$size]);
					$tpl->setVariable('buttons',$buttons);
					$tpl->setVariable('containerClasses',$containerClasses);
					$tpl->setVariable('containerIds',$containerIds);
					$tpl->setVariable('data_ga_property',$data_ga_property);
					$siteSizes = array();
					if(is_array($sizes) && count($sizes))
					{
						foreach($sizes as $button=>$size)
						{
							if(array_key_exists($size,$availableSizes))
								$siteSizes[$button] = $availableSizes[$size];
						}
					}
					$tpl->setVariable('sizes',$siteSizes);
					foreach($namedParameters as $namedParameterName=>$namedParameterValue)
						$tpl->setVariable($namedParameterName,$namedParameterValue);
					return ($operatorValue = $tpl->fetch('design:addthis.tpl'));
					break;
			}
		}
	}
	/**
	 * Instanciate ini object
	 * @param string ini file name
	 * @return addThis
	 */
	public static function instance($_fileName = 'addthis.ini')
	{
		$self = new self();
		addThis::$ini = eZINI::instance($_fileName);
		return $self;
	}
	/**
	 * Return ezIni object
	 * @return eZINI
	 */
	public function getIni()
	{
		return addThis::$ini;
	}
}
?>
