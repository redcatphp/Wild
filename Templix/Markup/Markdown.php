<?php
namespace RedCat\Framework\Templix\Markup;
use RedCat\Framework\Templix\Parsedown;
class Markdown extends \RedCat\Templix\Markup {
	protected $hiddenWrap = true;
	protected $noParseContent = true;
	function load(){
		$this->remapAttr('file');
		if($this->file)
			$text = file_get_contents($this->file);
		else{
			$text = $this->getInnerMarkups();
			$x = explode("\n",$text);
			foreach($x as &$v)
				$v = ltrim($v);
			$text = implode("\n",$x);
		}
		$this->clearInner();
		
		$md = new Parsedown();
		$this->innerHead[] = $md->text($text);
	}
}