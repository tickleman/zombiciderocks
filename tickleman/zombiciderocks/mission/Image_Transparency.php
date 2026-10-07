<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\AOP\Joinpoint\Around_Method;
use ITRocks\Framework\Plugin\Register;
use ITRocks\Framework\Plugin\Registerable;
use ITRocks\Framework\Tools\Image;

/**
 * Preserve alpha when session images are encoded and rotated, including editor requests.
 */
class Image_Transparency implements Registerable
{

    //------------------------------------------------------------------------------------------------------ beforeSave
    /**
     * @param $object Image
     * @return void
     */
	public function beforeSave(Image $object) : void
	{
		if ($object->hasTransparency()) {
			imagesavealpha($object->resource, true);
		}
	}

    //-------------------------------------------------------------------------------------------------------- register

    /**
     * @param $register Register
     * @return void
     */
	public function register(Register $register) : void
	{
		$register->aop->beforeMethod([Image::class, 'save'], [$this, 'beforeSave']);
		$register->aop->aroundMethod([Image::class, 'rotate'], [$this, 'rotate']);
	}

    //---------------------------------------------------------------------------------------------------------- rotate
    /**
     * @param $object    Image
     * @param $angle     float
     * @param $joinpoint Around_Method
     * @return Image
     */
	public function rotate(Image $object, float $angle, Around_Method $joinpoint) : Image
	{
		if (!$object->hasTransparency()) {
			return $joinpoint->result = $joinpoint->process();
		}
		// Copy into a true-color alpha canvas, also preserving indexed PNG/GIF transparency.
		$source = clone $object;
		$angle = fmod($angle, 360.0);
		if (!$angle) {
			return $joinpoint->result = $source;
		}
		$background = imagecolorallocatealpha($source->resource, 0, 0, 0, 127);
		$resource = imagerotate($source->resource, $angle, $background);
		imagealphablending($resource, false);
		imagesavealpha($resource, true);
		// GD rotates quarter turns without interpolation; derive dimensions from the result.
		$class = get_class($object);
		return $joinpoint->result = new $class(
			imagesx($resource), imagesy($resource), $resource, $object->type
		);
	}

}
