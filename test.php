<?php
interface Storable {
	function getContentsAsText();
}
 
class Document implements Storable {
	public function getContentsAsText() {
		return "This is Text of the Document\n";
	}
}
 
class Indexer {
	public function readAndIndex(Storable $s) {
		$textData = $s->getContentsAsText();
		//do necessary logic to index
		echo $textData;
	}
}
 
$p = new Document();

//var_dump($p);
echo $p->getContentsAsText();
//$i = new Indexer();
//$i->readAndIndex($p);

?>