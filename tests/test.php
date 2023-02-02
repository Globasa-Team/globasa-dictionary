<?php
namespace WorldlangDict;
include_once 'bootstrap.php';
echo "
***********************
***  T E S T I N G  ***
***********************

SKIP\n\n";
echo "     => ".Word::addStressToWord("") . "\n";
echo "null => ".Word::addStressToWord("") . "\n";
echo "el   => ".Word::addStressToWord("el") . "\n";
echo "em   => ".Word::addStressToWord("em") . "\n";
echo "ex   => ".Word::addStressToWord("ex") . "\n";
echo "fal  => ".Word::addStressToWord("fal") . "\n";
echo "fe   => ".Word::addStressToWord("fe") . "\n";

echo "\n0 OR 1 VOWEL\n\n";
echo "fsdf    => ".Word::addStressToWord("fsdf") . "\n";
echo "asdf    => ".Word::addStressToWord("asdf") . "\n";
echo "sdfilkj => ".Word::addStressToWord("sdfilkj") . "\n";

echo "\nLet's Go\n\n";
echo "awk         => ".Word::addStressToWord("awk") . "\n";
echo "aik         => ".Word::addStressToWord("aik") . "\n";
echo "aik-awk     => ".Word::addStressToWord("aik-awk") . "\n";
echo "daokyen     => ".Word::addStressToWord("daokyen") . "\n";
echo "manwangu    => ".Word::addStressToWord("manwangu") . "\n";
echo "daoyyen     => ".Word::addStressToWord("daoyyen") . "\n";
echo "daoiyen     => ".Word::addStressToWord("daoiyen") . "\n";
echo "dragonfruta => ".Word::addStressToWord("dragonfruta") . "\n";
echo "azzzariz    => ".Word::addStressToWord("azzzariz") . "\n";
echo "neozawriz   => ".Word::addStressToWord("neozawriz") . "\n";
echo "wangu       => ".Word::addStressToWord("wangu") . "\n";
echo "ergotim     => ".Word::addStressToWord("ergotim") . "\n";
echo "alimxey     => ".Word::addStressToWord("alimxey") . "\n";
echo "gamibete    => ".Word::addStressToWord("gamibete") . "\n";



echo "thagreikkokkun=> ".Word::addStressToWord("thagreikkokkun") . "\n";
echo "thagreikkokku => ".Word::addStressToWord("thagreikkokku") . "\n";
echo "thegreen    => ".Word::addStressToWord("thegreen") . "\n";


echo "


********************

";