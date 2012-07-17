<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Nothing Interactive 2012 <https://www.nothing.ch/>
 * @author     Fabian Gander <cyclodex@nothing.ch>
 * @author     Weyert de Boer <sprog@nothing.ch>
 * @author     Stefan Pfister <red@nothing.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

/**
 * Config
 */
$GLOBALS['TL_DCA']['tl_news']['config']['ctable'][] = 'tl_news_imagelist';

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('addImage;', 'addImage;{news_imagelist_legend:hide},news_imagelist;', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_news']['fields']['news_imagelist'] = array
(
	'label'                        => &$GLOBALS['TL_LANG']['tl_news']['news_imagelist'],
	'inputType'                    => 'dcaWizard',
	'foreignTable'                 => 'tl_news_imagelist',
	'eval'                         => array('tl_class'=>'clr', 'submitOnChange'=>true),
);

