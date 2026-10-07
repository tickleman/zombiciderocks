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
 * @set Blog_Images
 */
class Image
{
	use Component;
	use Has_Caption;
	use Has_Ordering;

	//----------------------------------------------------------------------------------- $blog_entry
	/**
	 * @composite
	 * @link Object
	 * @var Entry
	 */
	public $blog_entry;

	//----------------------------------------------------------------------------------------- $file
	/**
	 * @link Object
	 * @mandatory
	 * @var File
	 */
	public $file;

	//------------------------------------------------------------------------------------------ link
	/**
	 * Gets an HTML link for the image (used by the template)
	 *
	 * @return string
	 */
	public function link()
	{
		return $this->file ? $this->file->link() : '';
	}

}
