const chai = window.chai;
const expect = chai.expect;


/**
 * Test stresses
 */
describe('addStressToWord', () => {
    it ('should skip blanks and null', () => {
        expect(addStressToWord('')).to.equal(''),
        expect(addStressToWord(null)).to.equal(''),
        expect(addStressToWord()).to.equal('')
    }),
    it ('should skip "words" without vowels', () => {
        expect(addStressToWord('dgt')).to.equal('dgt'),
        expect(addStressToWord('k')).to.equal('k'),
        expect(addStressToWord('thqpyl')).to.equal('thqpyl')
    }),
    it ('should skip defined words to skip', () => {
        expect(addStressToWord('ji')).to.equal('ji'),
        expect(addStressToWord('wey')).to.equal('wey'),
        expect(addStressToWord('dur')).to.equal('dur'),
        expect(addStressToWord('xa')).to.equal('xa'),
        expect(addStressToWord('per')).to.equal('per'),
        expect(addStressToWord('kwas')).to.equal('kwas')
    }),
    it ('should stress first letter if 1 vowel', () => {
        expect(addStressToWord('da')).to.equal('ˈda'),
        expect(addStressToWord('sdfgi')).to.equal('ˈsdfgi'),
        expect(addStressToWord('sdfig')).to.equal('ˈsdfig'),
        expect(addStressToWord('sdefg')).to.equal('ˈsdefg'),
        expect(addStressToWord('sudfg')).to.equal('ˈsudfg'),
        expect(addStressToWord('isdfg')).to.equal('ˈisdfg')
    }),
    it ('don\'t shift pass vowels, hypthens or start of word', () => {
        expect(addStressToWord('awk')).to.equal('ˈawk'),
        expect(addStressToWord('aik')).to.equal('aˈik'),
        expect(addStressToWord('aik-awk')).to.equal('aik-ˈawk')
    }),
    // semivowels
    it ('should shift 2 if semivowels y/w after consonant', () => {
        expect(addStressToWord('daokyen')).to.equal('daoˈkyen'),
        expect(addStressToWord('daozwen')).to.equal('daoˈzwen'),
        expect(addStressToWord('manwangu')).to.equal('maˈnwangu'),
        expect(addStressToWord('femwangu')).to.equal('feˈmwangu')
    }),
    it ('should shift 1 if semivowels y/w after vowel or semivowel', () => {
        expect(addStressToWord('daoyyen')).to.equal('daoyˈyen'),
        expect(addStressToWord('daowyen')).to.equal('daowˈyen'),
        expect(addStressToWord('daoeyen')).to.equal('daoeˈyen'),
        expect(addStressToWord('daoiyen')).to.equal('daoiˈyen'),
        expect(addStressToWord('daoywen')).to.equal('daoyˈwen'),
        expect(addStressToWord('daowwen')).to.equal('daowˈwen'),
        expect(addStressToWord('daoewen')).to.equal('daoeˈwen'),
        expect(addStressToWord('daoiwen')).to.equal('daoiˈwen')
    }),
    // approximants
    it ('should shift 2 if approximants r/l after onset consonant', () => {
        expect(addStressToWord('dragonfruta')).to.equal('dragonˈfruta')
        expect(addStressToWord('zzazbriz')).to.equal('zzazˈbriz'),
        expect(addStressToWord('zzazfriz')).to.equal('zzazˈfriz'),
        expect(addStressToWord('zzaztriz')).to.equal('zzazˈtriz'),
        expect(addStressToWord('zzazbliz')).to.equal('zzazˈbliz'),
        expect(addStressToWord('zzazfliz')).to.equal('zzazˈfliz'),
        expect(addStressToWord('zzaztliz')).to.equal('zzazˈtliz')
    }),
    it ('should shift 1 if approximants r/l after coda consonants or vowel', () => {
        expect(addStressToWord('azzzariz')).to.equal('azzzaˈriz'),
        expect(addStressToWord('azzzeriz')).to.equal('azzzeˈriz'),
        expect(addStressToWord('azzziriz')).to.equal('azzziˈriz'),
        expect(addStressToWord('azzzoriz')).to.equal('azzzoˈriz'),
        expect(addStressToWord('azzzuriz')).to.equal('azzzuˈriz'),
        expect(addStressToWord('azzz-riz')).to.equal('azzz-ˈriz'),
        expect(addStressToWord('azzzaliz')).to.equal('azzzaˈliz'),
        expect(addStressToWord('azzzeliz')).to.equal('azzzeˈliz'),
        expect(addStressToWord('azzziliz')).to.equal('azzziˈliz'),
        expect(addStressToWord('azzzoliz')).to.equal('azzzoˈliz'),
        expect(addStressToWord('azzzuliz')).to.equal('azzzuˈliz'),
        expect(addStressToWord('azzz-liz')).to.equal('azzz-ˈliz'),

        expect(addStressToWord('neozawriz')).to.equal('neozawˈriz'),
        expect(addStressToWord('neozaxriz')).to.equal('neozaxˈriz'),
        expect(addStressToWord('neozalriz')).to.equal('neozalˈriz'),
        expect(addStressToWord('neozawliz')).to.equal('neozawˈliz'),
        expect(addStressToWord('neozaxliz')).to.equal('neozaxˈliz'),
        expect(addStressToWord('neozarliz')).to.equal('neozarˈliz')

    }),

    it ('should not shift pass first letter for r/l/w/y', () => {
        expect(addStressToWord('wangu')).to.equal('ˈwangu'),
        expect(addStressToWord('rangu')).to.equal('ˈrangu'),
        expect(addStressToWord('langu')).to.equal('ˈlangu'),
        expect(addStressToWord('yangu')).to.equal('ˈyangu')
    }),

    it ('shift 1 if adjacent is consonant', () => {
        expect(addStressToWord('nini')).to.equal('ˈnini')
        expect(addStressToWord('ergotim')).to.equal('ergoˈtim'),
        expect(addStressToWord('akademi')).to.equal('akaˈdemi'),
        expect(addStressToWord('alimxey')).to.equal('alimˈxey'),
        expect(addStressToWord('yogurtu')).to.equal('yoˈgurtu'),
        expect(addStressToWord('gamibete')).to.equal('gamiˈbete')
    }),
    
    it ('extreme test cases 1', () => {
        expect(addStressToWord('i')).to.equal('ˈi'),
        expect(addStressToWord('iv')).to.equal('ˈiv'),
        expect(addStressToWord('ivi')).to.equal('ˈivi')
        expect(addStressToWord('viv')).to.equal('ˈviv'),
        expect(addStressToWord('vivi')).to.equal('ˈvivi')
        expect(addStressToWord('vvvivvv')).to.equal('ˈvvvivvv'),
        expect(addStressToWord('vvvivviv')).to.equal('vvvivˈviv'),
        expect(addStressToWord('vvvivvivi')).to.equal('vvvivˈvivi')
    })
});


/**
 * Globasa latin script to IPA
 */
describe('replaceLettersWithIPA', () => {
    it ('should not change vowels', () => {
        expect(replaceLettersWithIPA('aeiou')).to.equal('aeiou')
    }),
    it ('should not change onset consonants', () => {
        expect(replaceLettersWithIPA('bdfgkptv')).to.equal('bdfgkptv')
    }),
    it ('should not change some coda consonants', () => {
        expect(replaceLettersWithIPA('lmnswz')).to.equal('lmnswz')
    }),
    it ('should change other onset consonants', () => {
        expect(replaceLettersWithIPA('cjrxyh')).to.equal('t͡ʃd͡ʒɾʃjx')
    }),
    it ('extra test', () => {
        expect(replaceLettersWithIPA('acejiroxtyphmu')).to.equal('at͡ʃed͡ʒiɾoʃtjpxmu')
    })
});




/**
 * Add stresses to full text
 */
 describe('addStressesToText', () => {
    it ('should add stresses to a full sentence, word by word', () => {
        expect(addStressesToText('denwatu hu yu oko ultra yu, denwatu yu ible xoraham ki xanti fe siko intizar denloka.')).to.equal('deˈnwatu hu ˈyu ˈoko ˈultra ˈyu, deˈnwatu ˈyu ˈible xoraˈham ki ˈxanti fe ˈsiko intiˈzar denˈloka.')
    })
});




/**
 * Full converation
 */
 describe('convertToIpa', () => {
    it ('should convert Globasa to IPA with stresses', () => {
        expect(convertToIpa('Denwatu hu yu oko ultra yu, denwatu yu ible xoraham ki xanti fe siko intizar denloka.')).to.equal('deˈnwatu xu ˈju ˈoko ˈultɾa ˈju, deˈnwatu ˈju ˈible ʃoɾaˈxam ki ˈʃanti fe ˈsiko intiˈzaɾ denˈloka.')
    })
});



/**
 * SSML
 */
 describe('ipaToSsml', () => {
    it ('should add prosody tags', () => {
        expect(ipaToSsml('')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph=""></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('d')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="d"></phoneme><break time="0.25s"/></prosody>')
    }),
    it ('should remove all single ASCII quotes', () => {
        expect(ipaToSsml("'")).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph=""></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml("zz'")).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml("'zz")).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml("zz'zz")).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zzzz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml("'zz zz' zz'zz ' zz 'zz' 'zz.'")).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz zz zzzz  zz zz zz"></phoneme>.<break time="0.25s"/></prosody>') 
    }),
    it ('should remove all double ASCII quotes', () => {
        expect(ipaToSsml('"')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph=""></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('zz"')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('"zz')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('zz"zz')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zzzz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('"zz zz" zz"zz " zz "zz" "zz."')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zz zz zzzz  zz zz zz"></phoneme>.<break time="0.25s"/></prosody>') 
    }),
    it ('should remove all unicode quotes', () => {
        expect(ipaToSsml('“”“”‘’‘’')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph=""></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('“z”“z”‘z’‘z’')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="zzzz"></phoneme><break time="0.25s"/></prosody>'),
        expect(ipaToSsml('“ ” z “z” ‘z’ ‘’')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="  z z z "></phoneme><break time="0.25s"/></prosody>')
    }),
    it ('should change commas to semi colons', () => {
        expect(ipaToSsml('1, 2, 3, 4.')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="1; 2; 3; 4"></phoneme>.<break time="0.25s"/></prosody>')
    }),
    it ('should add break tags except with commas and semi-colons', () => {
        expect(ipaToSsml('t. w.')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="t"></phoneme>.<break time="0.25s"/><phoneme alphabet="ipa" ph="w"></phoneme>.<break time="0.25s"/></prosody>'),
        expect(ipaToSsml('t! w!')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="t"></phoneme>!<break time="0.25s"/><phoneme alphabet="ipa" ph="w"></phoneme>!<break time="0.25s"/></prosody>'),
        expect(ipaToSsml('t: w:')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="t"></phoneme>:<break time="0.25s"/><phoneme alphabet="ipa" ph="w"></phoneme>:<break time="0.25s"/></prosody>'),
        expect(ipaToSsml('t? w?')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="t"></phoneme>?<break time="0.25s"/><phoneme alphabet="ipa" ph="w"></phoneme>?<break time="0.25s"/></prosody>'),
        expect(ipaToSsml('t; w;')).to.equal('<prosody rate="slow"><phoneme alphabet="ipa" ph="t"></phoneme>;<phoneme alphabet="ipa" ph="w"></phoneme>;</prosody>')
    })

});