http://ipa-reader.xyz/?text=un%20ma%C9%BEa%2C%20ku%20watu%20singa%20somno%2C%20lile%20mau%CA%83%20%CA%83o%C9%BEu%20pawbu%20t%CA%83el%20supe%C9%BE%20d%CA%92i%20infe%C9%BE%20pe%C9%BE%20te.&voice=Carla

http://ipa-reader.xyz/?text=%CA%83we%CA%83idom&voice=Carla

http://ipa-reader.xyz/?text=d%CA%92aget%CA%83u&voice=Carla

test
<?php

$sentence = strtolower("Un mara, ku watu singa somno, lile maux xoru pawbu cel super ji infer per te.");
$sentence = strtolower("xwexidom");
$sentence = strtolower("jagecu");

$pattern = ['/c/', '/h/', '/j/', '/r/', '/x/', '/y/'];
$replacement = ['tʃ', 'x', 'dʒ', 'ɾ', 'ʃ', 'j'];

echo preg_replace($pattern, $replacement, $sentence);