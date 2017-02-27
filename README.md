# [UNMAINTAINED]
This project is not maintained anymore.

# CONTAO EXTENSION: NEWS IMAGE LIST
Extends the news entries with an image gallery. The images can be sorted in the backend using drag'n'drop and support an optional image caption and link. The frontend module renders the images in a unsorted list.

## SETUP AND USAGE
### Prerequisites
 * Contao Version 2.10+
 * dcawizard [https://github.com/isotope/dcawizard](https://github.com/isotope/dcawizard)

### Installation
1. Make sure the `dcawizard` extension is installed and running properly
2. Copy the files into the _modules_ folder from Contao
3. Update the database (e.g. with the _Extension manager_)
4. Display specific setup:
   news-reader: To show the images in the _Newsreader_ be sure to place the _News Imagelist_ _Frontend module_ next to the Newsreader module inside the page
   news-list:   If you want to show the images in the _Newslist_ be sure to select the proper template in the module _news_imagelist_
5. Extend the news with images
6. Enjoy!

## VERSION HISTORY
### 1.0.1 (2012-09-17)*
#### Added support for news list
### 1.0.0 (2012-07-17)*
#### Initial release

## LICENSE
* Author:		Nothing Interactive, Switzerland
* Website: 		[https://www.nothing.ch/](https://www.nothing.ch/)
* Version: 		1.0.1
* Date: 		2012-09-17
* License: 		[GNU Lesser General Public License (LGPL)](http://www.gnu.org/licenses/lgpl.html)
