<?php 
header::addJavascript(path::urlLibraries('/pdfjs-1.7.225-dist/build/pdf.js'));
?>
<br />
<iframe src="<?php echo $data['link_document'];?>" style="width: 100%; height:1800px"></iframe>
