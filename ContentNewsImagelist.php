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
 * @copyright  Nothing 2012
 * @author     Weyert de Boer <sprog@nothing.ch>
 * @author     Fabian Gander <cyclodex@nothing.ch>
 * @author     Stefan Pfister <red@nothing.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Class ContentNewsImagelist
 *
 * Front end content element "news imagelist".
 * @copyright  Nothing 2012
 * @author     Stefan Pfister <red@nothing.ch>
 */
class ContentNewsImagelist extends ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_news_imagelist';

    /**
     * News alias
     * var string
     */
    protected $strNewsAlias;

    public function __construct($objTemplate)
    {
        $this->Database = Database::getInstance();
        $this->type = 'news_images';
        $this->strNewsAlias = $objTemplate->alias;
    }

    /**
     * Generate content element
     */
    protected function compile()
    {
        // Retrieve the news item from the current url of the page
        global $objPage;
        $time = time();

        // Get the current news
		$objNews = $this->Database->prepare("SELECT *, author AS authorId, (SELECT title FROM tl_news_archive WHERE tl_news_archive.id=tl_news.pid) AS news_archive, (SELECT name FROM tl_user WHERE id=author) author FROM tl_news WHERE (id=? OR alias=?)" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<?) AND (stop='' OR stop>?) AND published=1" : ""))
								   ->limit(1)
								   ->execute((is_numeric($this->strNewsAlias) ? $this->strNewsAlias : 0), $this->strNewsAlias, $time, $time);
		
		if ($objNews->numRows < 1)
		{
			// No entries found
			return;
		}

		// Id of element
		$ID = $objNews->id;

		// Generate image array for template
		$objImagelist = $this->Database->prepare("SELECT * FROM tl_news_imagelist WHERE pid=? ORDER BY sorting")
									   ->execute($ID);

		if ($objImagelist->numRows < 1)
		{
			// No images found
			return;
		}

		while ($objImagelist->next())
		{
			// Resize image
			$image = $this->getImage($objImagelist->image, 184, 0, 'center_center');

			$arrImagelist[] = array
			(
				'name'        	=> $objImagelist->name,
				'description'	=> $objImagelist->description,
				'image'       	=> $image,
				'imageUrl'		=> $objImagelist->imageUrl,
				'target'      	=> $objImagelist->target,
			);
		}

		$this->Template->images = $arrImagelist;
	}

}
