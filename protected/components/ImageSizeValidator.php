<?php
class ImageSizeValidator extends CValidator {
	public $maxWidth = 600;
	public $maxHeight = 450;
	public function validateAttribute($object, $attribute) {
        $class = get_class($object);
        $files = $_FILES[$class];
        $filename = $files['name'][$attribute];
        if (isset($filename) and '' != $filename) {
            $tmp_path = $files['tmp_name'][$attribute];
            if (isset($tmp_path) and '' != $tmp_path) {
                list($width, $height) = getimagesize($tmp_path);
                if ($width > $this->maxWidth or $height > $this->maxHeight) {
                    $this->addError($object, $attribute, "Uploaded image should not be larger than {$this->maxWidth}x{$this->maxHeight} pixels");
                }
            }
        }
	}	
}
?>
