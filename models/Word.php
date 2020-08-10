<? //test
namespace WorldlangDict;
// Added at home in remote. Add in project. Added offline.
class Word {
    public $word;
    public $category;
    public $part;
    public $etymology;

    public $eng, $fra, $rus, $spa, $zho;
    // added before online.
    // Create object from CSV dictionary array
    function __construct($rawWords, $key) {
        $this->word       = $rawWords[$key]['Word'];
        $this->category   = $rawWords[$key]['Category'];
        $this->part       = $rawWords[$key]['Part Of Speech'];
        $this->etymology  = $rawWords[$key]['LeksiliAsel'];

        $this->translation['eng'] = $rawWords[$key]['TranslationEng'];
        $this->translation['fra'] = $rawWords[$key]['TranslationFra'];
        $this->translation['rus'] = $rawWords[$key]['TranslationRus'];
        $this->translation['spa'] = $rawWords[$key]['TranslationSpa'];
        $this->translation['zho'] = $rawWords[$key]['TranslationZho'];
    }
}
