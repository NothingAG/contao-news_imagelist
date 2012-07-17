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

class ModuleNewsImagelist extends Module
{

	protected $strTemplate = 'mod_news_imagelist';


	protected function compile()
	{
		$time = time();

		// Get current news item
		$current_obj = $this->Database->prepare("SELECT *, author AS authorId, (SELECT title FROM tl_news_archive WHERE tl_news_archive.id=tl_news.pid) AS archive, (SELECT jumpTo FROM tl_news_archive WHERE tl_news_archive.id=tl_news.pid) AS parentJumpTo, (SELECT name FROM tl_user WHERE id=author) AS author FROM tl_news WHERE (id=? OR alias=?)" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<?) AND (stop='' OR stop>?) AND published=1" : ""))
									  ->limit(1)
									  ->execute((is_numeric($this->Input->get('items')) ? $this->Input->get('items') : 0), $this->Input->get('items'), $time, $time);

		if ($current_obj->numRows < 1)
		{
			// No news item found
			return;
		}

		// Id of element
		$ID = $current_obj->id;

		// Generate image array for template
		$objImages = $this->Database->prepare("SELECT * FROM tl_news_imagelist WHERE pid=? ORDER BY sorting")
									->execute($ID, 1);
		
		if ($objImages->numRows < 1)
		{
			// No images found
			return;
		}

		while ($objImages->next())
		{
			// Resize image
			$image = $this->getImage($objImages->image, 180, 130, 'proportional');

			$arrImagelist[] = array
			(
				'name'        => $objImages->name,
				'description' => $objImages->description,
				'image'       => $image,
				'imageUrl' 	  => $objImages->imageUrl,
				'target'      => $objImages->target,
			);
		}

		$this->Template->images = $arrImagelist;
	}


}
