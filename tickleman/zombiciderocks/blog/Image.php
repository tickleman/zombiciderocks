<?php
namespace Tickleman\ZombicideRocks\Blog;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Tools\Has_Ordering;

/**
 * Blog image
 *
 * @link File
 * @set Blog_Images
 */
class Image extends File
{
	use Component;
	use Has_Ordering;

	//----------------------------------------------------------------------------------------- $file
	/**
	 * @composite
	 * @link Object
	 * @mandatory
	 * @var File
	 */
	public $file;

	//----------------------------------------------------------------------------------- $blog_entry
	/**
	 * @composite
	 * @link Object
	 * @mandatory
	 * @var Entry
	 */
	public $blog_entry;

}
