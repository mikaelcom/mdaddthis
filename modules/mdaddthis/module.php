<?php
//
// Created on: <2011-03-20 17:26:00>
//
// SOFTWARE NAME: mdaddthis extension for eZ Publish
// SOFTWARE RELEASE: 1.1.0
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
$Module = array(
				'name'=>'MD AddThis',
				'variable_params'=>true);
$ViewList['script.js'] = array(
								'functions'=>array(
												'mdaddthis'),
								'script'=>'script.php',
								'params'=>array());
$FunctionList = array();
$FunctionList['mdaddthis'] = array();
?>
