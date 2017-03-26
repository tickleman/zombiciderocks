<?php
namespace Tickleman\ZombicideRocks\Blog;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Tools\Has_Ordering;
use ITRocks\Framework\Traits\Has_Caption;

/**
 * Blog image
 *
 * @display_order blog_entry, file, caption, ordering
 * @link File
 * @set Blog_Images
 */
class Image
{
	use Component;
	use Has_Caption;
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
