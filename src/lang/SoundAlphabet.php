<?php

/**
 * Sound Alphabet
 * --------------
 *
 * @noinspection PhpPropertyNamingConventionInspection      - Long property names are ok.
 * @noinspection PhpMethodNamingConventionInspection        - Long method names are ok.
 * @noinspection PhpVariableNamingConventionInspection      - Short variable names are ok.
 * @noinspection PhpUnnecessaryLocalVariableInspection      - Ignore for readability.
 * @noinspection PhpArrayShapeAttributeCanBeAddedInspection - Ignore shape for now, add later.
 * @noinspection PhpIllegalPsrClassPathInspection           - Ignore, using PSR 4 not 0.
 * @noinspection PhpUnusedLocalVariableInspection           - Readability.
 */


declare(strict_types=1);

namespace IKM\MadeUpWordGenerator2;

use Exception;

/**
 * Class SoundAlphabet
 */
class SoundAlphabet
{
    private array $sound_alphabet;

    public function __construct()
    {
        // Build alphabet
        $this->buildAlphabet();
    }

    public function getSoundAlphabet(): array
    {
        return $this->sound_alphabet;
    }

    public function getSoundByType(string $sound_type): array
    {
        // Default to empty
        $matching_sounds = [];

        // Get sounds
        $sound_alphabet = $this->sound_alphabet;

        // Populate list of vowel sounds
        foreach($sound_alphabet as $sound_index => $sound){
            $current_sound_type = $sound['sound_type'] ?? '';
            $is_a_match = $current_sound_type === $sound_type;

            // Add sound to list of matching sounds
            if($is_a_match){
                $matching_sounds[] = $sound;
            }
        }

        // Return an array of sounds, else empty array
        return $matching_sounds;
    }

    public function getVowels(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('vowel');
    }

    public function getRhoticVowels(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('rhotic_vowel');
    }

    public function getSemis(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('semi');
    }

    public function getRhoticLiquids(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('rhotic_liquid');
    }

    public function getLateralLiquids(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('lateral_liquid');
    }

    public function getRowels(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('rowel');
    }

    public function getNasals(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('nasal');
    }

    public function getConsonants(): array
    {
        // Return array of sounds, else return an empty array
        return $this->getSoundByType('consonant');
    }

    public function getUnsortedSounds(): array
    {
        // Default to empty
        $unsorted_sounds = [];

        // Get sounds
        $sound_alphabet = $this->sound_alphabet;

        // Populate list of unsorted sounds
        $unsorted_sounds = [];
        foreach($sound_alphabet as $sound_index => $sound){
            // Get sound type
            $sound_type = $sound['sound_type'] ?? '';

            // Check sound type
            $is_vowel          = $sound_type === 'vowel';
            $is_rhotic_vowel   = $sound_type === 'rhotic_vowel';
            $is_semi           = $sound_type === 'semi';
            $is_rhotic_liquid  = $sound_type === 'rhotic_liquid';
            $is_lateral_liquid = $sound_type === 'lateral_liquid';
            $is_rowel          = $sound_type === 'rowel';
            $is_nasal          = $sound_type === 'nasal';
            $is_consonant      = $sound_type === 'consonant';

            // Find if is sorted
            $is_sorted = (
                   $is_vowel
                || $is_rhotic_vowel
                || $is_semi
                || $is_rhotic_liquid
                || $is_lateral_liquid
                || $is_rowel
                || $is_nasal
                || $is_consonant
            );

            // Add unsorted sound to list of unsorted sounds
            if(!$is_sorted){
                $unsorted_sounds[] = $sound;
            }
        }

        // Return array of unsorted sounds, else empty array
        return $unsorted_sounds;
    }

    private function buildAlphabet()
    {
        $alphabet = [];

        /*
        $alphabet[] = [
            'type' => 'fixed_consonant',
            'axiophone' => 'P',
            'short_name' =>'P',
            'name' =>'Pop-pop',
            'examples' => "p in {p}ancake\np in {p}icnic\np in {p}rincess\np in {p}ear\np in {p}o{p}\np in s{p}y\np in soa{p}",
            'description' => "Voiceless bilabial plosive",
            'info_ipa' => 'p',
            'quick_transcription' => 'p',
        ];

        $alphabet[] = [
            'type' => 'trill',
            'axiophone' => 'P',
            'short_name' =>'P-trill',
            'name' =>'Tpotpowe-tpotpowe',
            'examples' => "(No examples in English)\n\ntp in {tp}o{tp}owe\n\t(chicken in Wariʼ)",
            'description' => 'Voiceless bilabial trill',
            'info_ipa' => 'ʙ̥',
            'quick_transcription' => 'p′p′pr',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'axiophone' => 'P',
            'short_name' =>'P-glide-semi-y',
            'name' =>'Pewter-py-pewter',
            'examples' => "p in {p}ew\np in {p}ewter\np in com{p}uter",
            'description' => '',
            'info_ipa' => 'pj',
            'quick_transcription' => 'pꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'ɥ_glide_consonant',
            'axiophone' => 'P',
            'short_name' =>'P-glide-semi-ɥ',
            'name' =>'',
            'examples' => "",
            'description' => '',
            'info_ipa' => 'pɥ',
            'quick_transcription' => 'pieu', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'ɥ_glide_consonant',
            'axiophone' => 'P',
            'short_name' =>'P-glide-semi-ɰ',
            'name' =>'',
            'examples' => "",
            'description' => '',
            'info_ipa' => 'pɰ',
            'quick_transcription' => 'pwh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'w_glide_consonant',
            'axiophone' => 'P',
            'short_name' =>'P-glide-semi-w',
            'name' =>'Poirot-Poirot',
            'examples' => "p in Hercule {P}oirot",
            'description' => "",
            'info_ipa' => "pw",
            'quick_transcription' => 'pw',
            'phone_family' => 'P',
        ];
        */


        // __________________________________


        // ───────────────────────────────────────────
        // Vowels:

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'compressioned_vowel',
            'name' =>'compression',
            'examples' => "' in didn{fg_bright_cyan}'{previous}t\n' in can{fg_bright_cyan}'{previous}t\ndifference when diff{fg_bright_cyan}'{previous}rence\nseveral when sev{fg_bright_cyan}'{previous}ral\ntemperature when temp{fg_bright_cyan}'{previous}rature",
            'description' => ' ',
            'info_ipa' => '(none or ə̆)',
            'quick_transcription' => 'ꞌ', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'central_vowel',
            'name' =>'Around-around',
            'examples' => "a in {fg_bright_cyan}a{previous}bout\na in Tin{fg_bright_cyan}a{previous}\n1st a in {fg_bright_cyan}a{previous}head",
            'description' => 'Mid central vowel',
            'info_ipa' => 'ə',
            'quick_transcription' => 'ah',
        ];

        // Primary Vowels

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'primary_vowel',
            'name' =>'Attack-attack',
            'examples' => "a in f{fg_bright_cyan}a{previous}t\na in h{fg_bright_cyan}a{previous}t\na in r{fg_bright_cyan}a{previous}t",
            'description' => "Open front unrounded vowel \n/ Low front unrounded vowel",
            'info_ipa' => "a\n(English drifts æ)",
            'quick_transcription' => 'a',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'primary_vowel',
            'name' =>'Easy-easy',
            'examples' => "ee in m{fg_bright_cyan}ee{previous}t\nea in {fg_bright_cyan}ea{previous}st\nea and y in {fg_bright_cyan}ea{previous}s{fg_bright_cyan}y{previous}\nea in b{fg_bright_cyan}ea{previous}n\nie in n{fg_bright_cyan}ie{previous}ce\n1st e in sc{fg_bright_cyan}e{previous}ne\nei in conc{fg_bright_cyan}ei{previous}ve",
            'description' => "close front unrounded vowel\n/ high front unrounded vowel",
            'info_ipa' => 'i',
            'quick_transcription' => 'ee',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'primary_vowel',
            'name' =>'Oops-oops',
            'examples' => "oo in b{fg_bright_cyan}oo{previous}t\noo in {fg_bright_cyan}oo{previous}ps\nu in t{fg_bright_cyan}u{previous}be",
            'description' => "close back rounded vowel\n/ high back rounded vowel",
            'info_ipa' => 'u',
            'quick_transcription' => 'oooo',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'August-August',
            'examples' => "a in {fg_bright_cyan}a{previous}ll\no in d{fg_bright_cyan}o{previous}ll\no in h{fg_bright_cyan}o{previous}t\nou in b{fg_bright_cyan}ou{previous}ght\nau in {fg_bright_cyan}au{previous}tumn (US & Canada)\no in c{fg_bright_cyan}o{previous}t\nau in c{fg_bright_cyan}au{previous}ght",
            'description' => "open back unrounded vowel\n/ low back unrounded vowel",
            'info_ipa' => '(For both ɑ & ɔ)',
            'quick_transcription' => 'au',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'Episode-episode',
            'examples' => "e in b{fg_bright_cyan}e{previous}t\nE in {fg_bright_cyan}E{previous}d\nea in h{fg_bright_cyan}ea{previous}d",
            'description' => "Open-mid front unrounded vowel",
            'info_ipa' => 'ɛ',
            'quick_transcription' => 'e',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'If-if',
            'examples' => "i in b{fg_bright_cyan}i{previous}t\ni in h{fg_bright_cyan}i{previous}d",
            'description' => "near-close front unrounded vowel\n/ near-high front unrounded vowel",
            'info_ipa' => 'ɪ',
            'quick_transcription' => 'i',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'Ocean-ocean',
            'examples' => "oa in b{fg_bright_cyan}oa{previous}t\noe in d{fg_bright_cyan}oe{previous}\no in {fg_bright_cyan}O{previous}mega",
            'description' => "Mid back rounded vowel",
            'info_ipa' => 'o̞',
            'quick_transcription' => 'oh',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'Up-up',
            'examples' => "u in {fg_bright_cyan}u{previous}ndo\nu in {fg_bright_cyan}u{previous}nmade\nu in h{fg_bright_cyan}u{previous}t\nu in b{fg_bright_cyan}u{previous}t",
            'description' => "open-mid back unrounded vowel\n/ low-mid back unrounded vowel",
            'info_ipa' => 'ʌ',
            'quick_transcription' => 'u',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'Ew-Ew',
            'examples' => "oo in g{fg_bright_cyan}oo{previous}se when gyeeoos",
            'description' => "Close back unrounded vowel",
            'info_ipa' => 'ɯ',
            'quick_transcription' => 'ew',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'fixed_vowel',
            'name' =>'Oo-hook-oo-book',
            'examples' => "oo in h{fg_bright_cyan}oo{previous}d\noo in b{fg_bright_cyan}oo{previous}k",
            'description' => "Near-close near-back rounded vowel",
            'info_ipa' => '(For both ʊ and ʊ̞)',
            'quick_transcription' => 'oo',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'glide_vowel',
            'name' =>'Ace-ace',
            'examples' => "a in pl{fg_bright_cyan}a{previous}ce\na in l{fg_bright_cyan}a{previous}te\na in d{fg_bright_cyan}a{previous}ngerous\ney in h{fg_bright_cyan}ey{previous}\nay in d{fg_bright_cyan}ay{previous}\nai in b{fg_bright_cyan}ai{previous}t",
            'description' => "",
            'info_ipa' => 'eɪ',
            'quick_transcription' => 'ay',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'glide_vowel',
            'name' =>'Ice-ice',
            'examples' => "i in h{fg_bright_cyan}i{previous}de\ni in b{fg_bright_cyan}i{previous}te\ni in l{fg_bright_cyan}i{previous}ke",
            'description' => "",
            'info_ipa' => 'aɪ',
            'quick_transcription' => 'igh',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'glide_vowel',
            'name' =>'Oil-oil',
            'examples' => "oy in b{fg_bright_cyan}oy{previous}\noi in {fg_bright_cyan}oi{previous}l\noy in l{fg_bright_cyan}oy{previous}al",
            'description' => "",
            'info_ipa' => 'ɔɪ',
            'quick_transcription' => 'oi',
        ];

        $alphabet[] = [
            'sound_type' => 'vowel',
            'type' => 'glide_vowel',
            'name' =>'Out-out',
            'examples' => "ou in {fg_bright_cyan}ou{previous}t\nou in l{fg_bright_cyan}ou{previous}t\now in h{fg_bright_cyan}ow{previous}\now in n{fg_bright_cyan}ow{previous}\now in br{fg_bright_cyan}ow{previous}n\now in c{fg_bright_cyan}ow{previous}\nou in m{fg_bright_cyan}ou{previous}se",
            'description' => "",
            'info_ipa' => 'aʊ',
            'quick_transcription' => 'ou',
        ];

        // ───────────────────────────────────────────
        // Rhotic Vowels:

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Ar-ar',
            'examples' => "ar in st{fg_bright_cyan}ar{previous}t\nar in c{fg_bright_cyan}ar{previous}",
            'description' => "",
            'info_ipa' => 'ɑ˞',
            'quick_transcription' => 'ar',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Air-air',
            'examples' => "are in squ{fg_bright_cyan}are{previous}\nair in h{fg_bright_cyan}air{previous}\nair in ch{fg_bright_cyan}air{previous}\nare in d{fg_bright_cyan}are{previous}\nare in sh{fg_bright_cyan}are{previous}\near in b{fg_bright_cyan}ear{previous}\near in sw{fg_bright_cyan}ear{previous}\nar in hil{fg_bright_cyan}ar{previous}ious\nar in M{fg_bright_cyan}ar{previous}y\nar in S{fg_bright_cyan}ar{previous}ah\nar in p{fg_bright_cyan}ar{previous}ent\nar in r{fg_bright_cyan}ar{previous}ely\nere in wh{fg_bright_cyan}ere{previous}",
            'description' => '"The square vowel"',
            'info_ipa' => 'ɛəɹ',
            'quick_transcription' => 'air',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Ear-ear',
            'examples' => "ear in {fg_bright_cyan}ear{previous}\near in n{fg_bright_cyan}ear{previous}",
            'description' => "",
            'info_ipa' => 'ɪəʳ',
            'quick_transcription' => 'eer',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Er-er',
            'examples' => "er in dinn{fg_bright_cyan}er{previous}\ner in ass{fg_bright_cyan}er{previous}t\nar in stand{fg_bright_cyan}ar{previous}d\nir in m{fg_bright_cyan}ir{previous}th\nire in Lincolnsh{fg_bright_cyan}ire{previous}\ner in diff{fg_bright_cyan}er{previous}ence (uncompressed)\ner in sev{fg_bright_cyan}er{previous}al (uncompressed)\ner in temp{fg_bright_cyan}er{previous}ature (uncompressed)",
            'description' => "",
            'info_ipa' => 'ɚ',
            'quick_transcription' => 'er',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Ire-Ire',
            'examples' => "ire in h{fg_bright_cyan}ire{previous}",
            'description' => "",
            'info_ipa' => 'aɪɚ',
            'quick_transcription' => 'igher',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Or-or',
            'examples' => "or in n{fg_bright_cyan}or{previous}th\nor in w{fg_bright_cyan}ar{previous}",
            'description' => "",
            'info_ipa' => 'ɔ˞',
            'quick_transcription' => 'or',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Our-our',
            'examples' => "our in {fg_bright_cyan}our{previous}\nour in fl{fg_bright_cyan}our{previous}",
            'description' => "",
            'info_ipa' => 'aʊər',
            'quick_transcription' => 'our',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Tour-oo-ur-detour',
            'examples' => "our in t{fg_bright_cyan}our{previous}\nour in det{fg_bright_cyan}our{previous}\nure in man{fg_bright_cyan}ure{previous}\neur in entrepren{fg_bright_cyan}eur{previous}",
            'description' => "(none)",
            'info_ipa' => 'ʊəɹ',
            'quick_transcription' => 'uer',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_vowel',
            'type' => 'r_colored_vowel',
            'name' =>'Ur-ur',
            'examples' => '',
            'description' => "(Most English ur becomes er)",
            'info_ipa' => 'ʌr',
            'quick_transcription' => 'ur',
        ];

        // ───────────────────────────────────────────
        // Semis:

        $alphabet[] = [
            'sound_type' => 'semi',
            'sound_name' =>'Y-axiophone',
            'axiophone' => 'Y',
            'type' => "fixed_consonant\n\nsemi",
            'name' =>'Yes-yes',
            'examples' => "y in {fg_bright_cyan}y{previous}es\ny in {fg_bright_cyan}y{previous}ellow\nstart of u in universe\ny in {fg_bright_cyan}y{previous}ou",
            'description' => "Voiced palatal approximant",
            'info_ipa' => 'j',
            'quick_transcription' => 'y',
            'phone_family' => 'Y',
        ];

        $alphabet[] = [
            'sound_type' => 'semi',
            'sound_name' =>'YW1-axiophone',
            'axiophone' => 'YW1',
            'type' => "sub_fixed_consonant\n\nsemi",
            'name' =>'Yuè-yuè',
            'examples' => "(No examples in English)\n\n(A sound between yah and wah)\n\ny in {fg_bright_cyan}y{previous}uè (Moon in Mandarin)\nu in f{fg_bright_cyan}u{previous}l (ugly in Swedish)\nü in d{fg_bright_cyan}ü{previous}a (back in Kurdish)",
            'description' => "Voiced labial–palatal approximant",
            'info_ipa' => 'ɥ',
            'quick_transcription' => 'ieu', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'semi',
            'sound_name' =>'YW2-axiophone',
            'axiophone' => 'YW2',
            'type' => "sub_fixed_consonant\n\nsemi",
            'name' =>'Uisa-uisa',
            'examples' => "(No examples in English)\n\nu in {fg_bright_cyan}u{previous}isa (doctor in Korean)",
            'description' => "Voiced velar approximant",
            'info_ipa' => 'ɰ',
            'quick_transcription' => '(gwra)',
        ];

        $alphabet[] = [
            'sound_type' => 'semi',
            'sound_name' =>'W-axiophone',
            'axiophone' => 'W',
            'type' => "fixed_consonant\n\nsemi",
            'name' =>'West-west',
            'examples' => "w in {fg_bright_cyan}w{previous}affle\nw in {fg_bright_cyan}w{previous}ood\nw in {fg_bright_cyan}w{previous}est\nw in {fg_bright_cyan}w{previous}oman",
            'description' => "voiced labial-velar approximant",
            'info_ipa' => "w\n\nAlso for β̞",
            'quick_transcription' => 'w',
            'phone_family' => 'W',
        ];

        $alphabet[] = [
            'sound_type' => 'semi',
            'sound_name' =>'HW-axiophone',
            'axiophone' => 'HW',
            'type' => "h_color\n\nw_glide_consonant\n\nsemi",
            'name' =>'White-white',
            'examples' => "sometimes the wh in  {fg_bright_cyan}wh{previous}ite",
            'description' => "",
            'info_ipa' => "hw\n\nʍ\n\nFrom ʍ to hw\nFrom ʍ to xw",
            'quick_transcription' => 'hw',
            'phone_family' => 'W',
        ];

        // ───────────────────────────────────────────
        // Rhotic Liquids:

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-axiophone',
            'axiophone' => 'R',
            'type' => "fixed_consonant\n\nliquid",
            'name' =>'Roar-roar',
            'examples' => "r in {fg_bright_cyan}r{previous}abbit\nr in {fg_bright_cyan}r{previous}oar",
            'description' => "Voiced postalveolar approximant",
            'info_ipa' => "ɹ\n\n(Also ɾ & ɹ̠)",
            'quick_transcription' => 'r',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-trill',
            'axiophone' => 'R',
            'type' => "trill\n\nliquid",
            'name' =>'Arriba-arriba',
            'examples' => "(No examples in English)\n\nrr in a{fg_bright_cyan}rr{previous}iba in Spanish",
            'description' => 'Voiced alveolar trill',
            'info_ipa' => 'r',
            'quick_transcription' => 'r′r′r',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-breathy',
            'axiophone' => 'R',
            'type' => "trill\n\nliquid",
            'name' =>'Rhagfyr-Rhagfyr',
            'examples' => "(No examples in English)\n\nIn ancient greek, the Rh in {fg_bright_cyan}Rh{previous}o\n\nRh in {fg_bright_cyan}Rh{previous}agfyr\n\t(December in Welsh)",
            'description' => 'Voiceless alveolar trill',
            'info_ipa' => 'r̥',
            'quick_transcription' => 'rh',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-extra-long',
            'axiophone' => 'R',
            'type' => "extra_long_fixed_consonant\n\nliquid",
            'name' =>'Rrrrr-rrrrr',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'rːː',
            'quick_transcription' => 'rrrrr',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-pre-nasal-en-Rer',
            'axiophone' => 'R',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Rer',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ⁿr\n\nAlso for\nⁿɖ͡ʐʐ̩˧",
            'quick_transcription' => 'nr',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-uvular-approximant',
            'axiophone' => 'R',
            'type' => "sub_fixed_consonant\n\nliquid",
            'name' =>'Roed-roed',
            'examples' => "(No examples in English)\n\nr in {fg_bright_cyan}r{previous}ød (red in Danish)",
            'description' => "Voiced uvular approximant",
            'info_ipa' => 'ʁ̞',
            'quick_transcription' => 'r(r)',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-uvular-fricative',
            'axiophone' => 'R',
            'type' => "sub_fixed_consonant\n\nliquid",
            'name' =>'Rek-rek',
            'examples' => "(No examples in English)\n\nr in {fg_bright_cyan}ղ{previous}եկ (rudder in Armenian)",
            'description' => "Voiced uvular fricative",
            'info_ipa' => 'ʁ',
            'quick_transcription' => 'r(rrr)',
            'phone_family' => 'R',
        ];


        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-pharyngealized',
            'axiophone' => 'R',
            'type' => "pharyngealized_approximant\n\nliquid",
            'name' =>'pharyn-Raaa~',
            'examples' => "(used in Dutch,\n& some dialects of\nAmerican English)",
            'description' => 'pharyngealized velar approximant',
            'info_ipa' => 'ɹˤ',
            'quick_transcription' => '`r~',
            'phone_family' => 'R',
        ];

        /*
        $alphabet[] = [
            // ---- Replaced by R-dark-to-w ----
            'sound_type' => 'rhotic_liquid',
            'type' => "pharyngealized_approximant\n\nliquid-to-semi",
            'name' =>'pharyn-Rwaaa~',
            'examples' => "(an r variant in some\nAmerican English)",
            'description' => 'pharyngealized labialized postalveolar approximant',
            'info_ipa' => 'ɹˤw',
            'quick_transcription' => '`rw~',
            //'quick_transcription' => 'rw',
            'phone_family' => 'R',
        ];
        */

        /*
        // ---- Replaced by R-light-to-y ----
        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'type' => "y_glide_consonant\n\nliquid",
            'name' =>'Ryeka-ry-ryeka',
            'examples' => "{р}ека (\"I say\" / \"I tell\"\nin Russian)",
            'description' => '',
            'info_ipa' => "rʲ\n\nrj\n\nOld ᶉ",
            'quick_transcription' => 'rꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'R',
        ];
        */

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-light-to-y',
            'axiophone' => 'R',
            'type' => "liquid-near-semi\n\ny_glide_consonant\n\nliquid",
            'name' =>'R-light-to-y',
            'examples' => "р in {fg_bright_cyan}р{previous}ека (\"I say\" / \"I tell\"\nin Russian)",
            'description' => '',
            'info_ipa' => "rʲ\n\nrj\n\nOld ᶉ",
            'quick_transcription' => 'rꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'sound_type' => 'rhotic_liquid',
            'sound_name' =>'R-dark-to-w',
            'axiophone' => 'R',
            'type' => "liquid-near-semi\n\npharyngealized_approximant\n\nliquid-to-semi\n\nliquid-near-semi",
            'name' =>'R-dark-to-w',
            'examples' => "(an r variant in some\nAmerican English)",
            'description' => 'pharyngealized labialized postalveolar approximant',
            'info_ipa' => 'ɹw & ɹˤw',
            'quick_transcription' => 'rw',
            'phone_family' => 'R',
        ];

        // ───────────────────────────────────────────
        // Lateral Liquids:

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-axiophone',
            'axiophone' => 'L',
            'type' => "fixed_consonant\n\nliquid",
            'name' =>'Level-level',
            'examples' => "l in {fg_bright_cyan}l{previous}et\nl in {fg_bright_cyan}l{previous}ight\nl in c{fg_bright_cyan}l{previous}ick\nl in go{fg_bright_cyan}l{previous}d\nl in {fg_bright_cyan}l{previous}eve{fg_bright_cyan}l{previous}\nboth l's in ye{fg_bright_cyan}ll{previous}ow\nll in be{fg_bright_cyan}ll{previous}",
            'description' => "Voiced alveolar lateral approximant",
            'info_ipa' => "(For l & ʟ & ʎ)\n\nl , l̠ , l̪\nlˠ , lˤ\nʟ\n\n\nsome\nʎ\nl̠ʲ , ʎ̟ , ȴ\n(when not too light)\n\n\nsome\nɫ\n(when not too dark)",
            'quick_transcription' => 'l',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-preaspirated',
            'axiophone' => 'L',
            'type' => "preaspirated_consonant\n\nliquid",
            'name' =>'ha-La',
            'examples' => "(No examples in English)\n\nl in k{fg_bright_cyan}l{previous}appa\n\t(clap in Faroese)",
            'description' => '',
            'info_ipa' => 'ʰl',
            'quick_transcription' => 'h′l',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-breathy',
            'axiophone' => 'L',
            'type' => "breathy_consonant\n\nliquid",
            'name' =>'Lhasa-Lhasa',
            'examples' => "(No examples in English)\n\nLh in {fg_bright_cyan}Lh{previous}asa\n\t(city & river in Tibet)",
            'description' => '',
            'info_ipa' => "lʰ\n\nl̥ when lʰ",
            'quick_transcription' => 'lh',
            'phone_family' => 'L',
        ];


        /*
        // ---- Replaced by L-light-to-y ----
        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'type' => "y_glide_consonant\n\nliquid",
            'name' =>'Ljepuri-ly-ljepuri',
            'examples' => "ll in mi{ll}ion\nlj in {lj}epuri\n\t(rabbit in Aromanian)",
            'description' => 'Voiced palatal lateral approximant',
            'info_ipa' => "lj\n\nʎ\n\nAlt ȴ",
            'quick_transcription' => 'lꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'L',
        ];
        */


        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-light-to-y',
            'axiophone' => 'L',
            'type' => "liquid-near-semi",
            'name' =>'L-light-to-y',
            'examples' => "",
            'description' => '',
            'info_ipa' => "lj\n\n(When light toward y/j)\nʎ\nl̠ʲ , ʎ̟\n\nAlt ȴ",
            'quick_transcription' => 'l′y',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-dark-to-y',
            'axiophone' => 'L',
            'type' => "liquid-near-semi",
            'name' =>'L-dark-to-y',
            'examples' => "",
            'description' => '',
            'info_ipa' => "jl\n\n(When dark toward y/j)\nʎ\nl̠ʲ , ʎ̟\n\nAlt ȴ",
            'quick_transcription' => 'y′l',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-light-to-w',
            'axiophone' => 'L',
            'type' => "liquid-near-semi",
            'name' =>'L-light-to-w',
            'examples' => "",
            'description' => '',
            'info_ipa' => "(When light toward w)\nɫ",
            'quick_transcription' => 'lw',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-dark-to-w',
            'axiophone' => 'L',
            'type' => "liquid-near-semi",
            'name' =>'L-dark-to-w',
            'examples' => "",
            'description' => '',
            'info_ipa' => "(When dark toward w)\nɫ",
            'quick_transcription' => 'wl',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-prestop-gl',
            'axiophone' => 'L',
            'type' => "prestopped_liquid\n\nliquid",
            'name' =>'L-prestop-gl',
            'examples' => "(No examples in English)\n\nPrestop liquid used in Hiw.",
            'description' => '',
            'info_ipa' => "ɡʟ / ᶢʟ",
            'quick_transcription' => 'gl',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-prestop-gya-ly',
            'axiophone' => 'L',
            'type' => "prestopped_liquid\n\nliquid",
            'name' =>'L-prestop-gya-ly',
            'examples' => "(No examples in English)\n\nPrestop liquid used in Aboriginal languages.",
            'description' => '',
            'info_ipa' => "ɟʎ",
            'quick_transcription' => '(g′ya)la',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-prestop-dl',
            'axiophone' => 'L',
            'type' => "prestopped_liquid\n\nliquid",
            'name' =>'L-prestop-dl',
            'examples' => "(No examples in English)\n\nPrestop liquid used in Aboriginal languages.",
            'description' => '',
            'info_ipa' => "d̪l̪, ᵈl, ɖɭ",
            'quick_transcription' => 'dl',
            'phone_family' => 'L',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-belt',
            'axiophone' => 'SSH',
            'type' => 'sub_fixed_consonant',
            'name' =>'Sla-sla',
            'examples' => "(No examples in English)\n\nsl in {fg_bright_cyan}sl{previous}a\n\t(cow in Moloko)\nł in {fg_bright_cyan}ł{previous}aʼ\n\t(some in Navajo)\ntl in ta{fg_bright_cyan}tl{previous}ete\n\t(small/weak in Norwegian)\nll in tege{fg_bright_cyan}ll{previous}\n\t(kettle in Welsh)",
            'description' => "Voiceless alveolar lateral fricative\n\n\"Belted L\"",
            'info_ipa' => "ɬ\n\nl̥ when ɬ\nł when ɬ",
            'quick_transcription' => 'ssh',
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-belt-light-to-y',
            'axiophone' => 'SSH',
            'type' => 'y_glide_consonant',
            'name' =>'Sla-Y',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => "ɬj\n\nAlt ɕ",
            'quick_transcription' => 'sshꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'lateral_liquid',
            'sound_name' =>'L-belt-dark',
            'axiophone' => 'SSH',
            'type' => 'sub_fixed_consonant',
            'name' =>'L-belt-dark',
            'examples' => "(No examples in English)",
            'description' => "Voiceless palatal lateral fricative\n\n\"Belted ʎ\"",
            'info_ipa' => "ʎ̥˔",
            'quick_transcription' => 'ssaw',
        ];

        // ───────────────────────────────────────────
        // Rowels


        $alphabet[] = [
            'sound_type' => 'rowel',
            'sound_name' =>'R-short-rowel',
            'axiophone' => 'R',
            'special_categorization' => "{bold}{bg_dark_cyan} rowel {previous}",
            'type' => 'rowel',
            'name' =>'Krk-r-Krk',
            'examples' => "(No examples in English)\n\nr in k{fg_bright_cyan}r{previous}k\n\t(throat/neck in \n\tCzech & Slovak)",
            'description' => "\"Syllabic R\"",
            'info_ipa' => 'r̩',
            'quick_transcription' => 'ꞌr', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'rowel',
            'sound_name' =>'R-long-rowel',
            'axiophone' => 'R',
            'special_categorization' => "{bold}{bg_dark_cyan} rowel {previous}",
            'type' => 'rowel',
            'name' =>'Vrba-rrrr-Vrba',
            'examples' => "(No examples in English)\n\nr in v{fg_bright_cyan}r{previous}ba\n\t(willow in Slovak)",
            'description' => "",
            'info_ipa' => 'r̩ː',
            'quick_transcription' => 'ꞌrrr', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'rowel',
            'sound_name' =>'L-dark-short-rowel',
            'axiophone' => 'L',
            'special_categorization' => "{bold}{bg_dark_cyan} rowel {previous}",
            'type' => 'rowel',
            'name' =>'Zhlt-L-Zhlt',
            'examples' => "(No examples in English)\n\nl in zh{fg_bright_cyan}l{previous}t\n\t(eat in Czech)",
            'description' => "",
            'info_ipa' => 'ɫ̩',
            'quick_transcription' => 'ꞌl', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'rowel',
            'sound_name' =>'L-dark-long-rowel',
            'axiophone' => 'L',
            'special_categorization' => "{bold}{bg_dark_cyan} rowel {previous}",
            'type' => 'rowel',
            'name' =>'Klb-LLL-Klb',
            'examples' => "(No examples in English)\n\nl in k{fg_bright_cyan}l{previous}b\n\t(joint in Slovak)",
            'description' => "",
            'info_ipa' => 'ɫ̩ː',
            'quick_transcription' => 'ꞌlll', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        // ───────────────────────────────────────────
        // Nasals

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-axiophone',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'type' => 'fixed_consonant',
            'name' =>'Mars-Mars',
            'examples' => "m in {fg_bright_cyan}m{previous}an\nm in {fg_bright_cyan}m{previous}op\nm in la{fg_bright_cyan}m{previous}p\nm in ru{fg_bright_cyan}m{previous}",
            'description' => "voiced bilabial nasal",
            'info_ipa' => 'm',
            'quick_transcription' => 'm',
            'phone_family' => 'M',
        ];


        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-extra-long',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_bright_yellow}extra-long{previous}",
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Mmmmm-mmmmm',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ɱːː',
            'quick_transcription' => 'mmmmm',
            'phone_family' => 'M',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-with-h-color',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_dark_cyan}h-color{previous}",
            'type' => "h_color\n\nnasal",
            'name' =>'Hma-hma',
            'examples' => "hm in {fg_bright_cyan}hm{previous}a\n(black in Jalapa Mazatec)",
            'description' => 'Voiceless bilabial nasal',
            'info_ipa' => 'm̥',
            'quick_transcription' => 'hm',
            'phone_family' => 'M',
        ];


        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-breathy',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_bright_cyan}breathy{previous}",
            'type' => 'breathy_consonant',
            'name' =>'breathy-Ma-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'mʰ',
            'quick_transcription' => 'mh',
            'phone_family' => 'M',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-pharyngealized',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_bright_green}pharyngealized{previous}",
            'type' => 'pharyngealized_nasal',
            'name' =>'pharyn-Maaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen, Ubykh,\nMoroccan Darija,\nand Iraqi Arabic)",
            'description' => '',
            'info_ipa' => 'mˤ',
            'quick_transcription' => '`m~',
            'phone_family' => 'M',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-syllabic',
            'axiophone' => 'M',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{bold}{fg_bright_red}syllabic{previous}",
            'special_categorization' => "{bold}{fg_bright_red}{bg_bright_yellow} syllabic {previous}",
            'type' => 'syllabic_consonant',
            'name' =>'M-m-M',
            'examples' => "(No examples in English)\n\n(Used in Cantonese & Baoulé)",
            'description' => "",
            'info_ipa' => 'm̩',
            'quick_transcription' => '-m-',
            'phone_family' => 'M',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'M-end-syllabic',
            'axiophone' => 'M',
            'special_categorization' => "{bold}{fg_bright_red}{bg_bright_yellow} end-syllabic {previous}",
            'type' => 'end-syllabic_consonant',
            'name' =>'Sedm-Sedm-mmm',
            'examples' => "(No examples in English)\n\nm in sed{fg_bright_cyan}m{previous}\n\t(seven in Czech)",
            'description' => "",
            'info_ipa' => 'm̩',
            'quick_transcription' => 'ꞌm', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'M',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-axiophone',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'type' => 'fixed_consonant',
            'name' =>'Noble-noble',
            'examples' => "n in {fg_bright_cyan}n{previous}ope\nn in te{fg_bright_cyan}n{previous}th\nn in mo{fg_bright_cyan}n{previous}th",
            'description' => "voiced alveolar nasal",
            'info_ipa' => 'n',
            'quick_transcription' => 'n',
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-glide-to-liquid-w',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'special_categorization' => "{fg_dark_cyan}glide-w{previous}",
            'type' => 'w_glide_consonant',
            'name' =>'Noir-noir',
            'examples' => "n in film {fg_bright_cyan}n{previous}oir",
            'description' => "",
            'info_ipa' => "nw",
            'quick_transcription' => 'nw',
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-glide-to-liquid-y',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'special_categorization' => "{fg_dark_cyan}glide-y{previous}",
            'type' => 'y_glide_consonant',
            'name' =>'Enye-ny-enye',
            'examples' => "n in {fg_bright_cyan}n{previous}ew\nñ in espa{fg_bright_cyan}ñ{previous}ol\n\nsometimes the gn in Lasa{fg_bright_cyan}gn{previous}a",
            'description' => 'Voiced palatal nasal',
            'info_ipa' => "nj\n\nɲ\n(when drift to nj)",
            'quick_transcription' => 'nꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-with-h-color',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_dark_cyan}h-color{previous}",
            'type' => "h_color\n\nnasal",
            'name' =>'Nhad-nhad',
            'examples' => "nh in fy {fg_bright_cyan}nh{previous}ad\n(My father in Welsh)",
            'description' => 'Voiceless alveolar nasal',
            'info_ipa' => 'n̥',
            'quick_transcription' => 'hn',
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-pharyngealized',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{fg_bright_green}pharyngealized{previous}",
            'type' => 'pharyngealized_nasal',
            'name' =>'pharyn-Naaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen)",
            'description' => '',
            'info_ipa' => 'nˤ',
            'quick_transcription' => '`n~',
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-syllabic',
            'axiophone' => 'N',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{bold}{fg_bright_red}syllabic{previous}",
            'special_categorization' => "{bold}{fg_bright_red}{bg_bright_yellow} syllabic {previous}",
            'type' => 'syllabic_consonant',
            'name' =>'N-n-N',
            'examples' => "(One-off in English for \"and\")\n\n(used in Cantonese, Yoruba,\n& Baoulé)",
            'description' => "",
            'info_ipa' => 'n̩',
            'quick_transcription' => '-n-',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'N-end-syllabic',
            'axiophone' => 'N',
            'special_categorization' => "{bold}{fg_bright_red}{bg_bright_yellow} end-syllabic {previous}",
            'type' => 'end-syllabic_consonant',
            'name' =>'Njutn-Njutn-nnn',
            'examples' => "(No examples in English)\n\nn in Njut{fg_bright_cyan}n{previous}\n\t(Newton in Serbo-Croatian)",
            'description' => "",
            'info_ipa' => 'n̩',
            'quick_transcription' => 'ꞌn', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'N',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'NH-axiophone',
            'axiophone' => 'NH',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'type' => 'fixed_consonant',
            'name' =>'Enjuto-enjuto',
            'examples' => "(No examples in English)\n\nnj in e{fg_bright_cyan}nj{previous}uto\n\t(withered in Spanish)",
            'description' => "Voiced uvular nasal",
            'info_ipa' => 'ɴ',
            'quick_transcription' => 'nh',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'NG-axiophone',
            'axiophone' => 'NG',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'type' => 'nasal_glide_consonant',
            'name' =>'Ngwee-ngwee',
            'examples' => "ng in ki{fg_bright_cyan}ng{previous}\nng in si{fg_bright_cyan}ng{previous}\nng in ri{fg_bright_cyan}ng{previous}\nng in {fg_bright_cyan}ng{previous}wee\n\t(penny coin in Zambia)\nn in si{fg_bright_cyan}n{previous}k",
            'description' => "voiced velar nasal\n\nalso known as agma",
            'info_ipa' => 'ŋ',
            'quick_transcription' => 'ng',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'NG-syllabic',
            'axiophone' => 'NG',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous},\n{bold}{fg_bright_red}syllabic{previous}",
            'special_categorization' => "{bold}{fg_bright_red}{bg_bright_yellow} syllabic {previous}",
            'type' => 'syllabic_consonant',
            'name' =>'Ng-ng-Ng',
            'examples' => "(No examples in English)\n\nng in {fg_bright_cyan}ng{previous}\n\t(five in Cantonese)",
            'description' => "",
            'info_ipa' => 'ŋ̍',
            'quick_transcription' => '-ng-',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'GN-axiophone',
            'axiophone' => 'GN',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'type' => 'nasal_glide_consonant',
            'name' =>'Gnaeus-Gnaeus',
            'examples' => "Gn in {fg_bright_cyan}Gn{previous}aeus\n\t(An old Roman name)\n\nSometimes the gn in Lasa{fg_bright_cyan}gn{previous}a",
            'description' => "Voiced palatal nasal",
            'info_ipa' => "gn\n\nɲ\n(when drift to gn)",
            'quick_transcription' => 'gn',
        ];

        $alphabet[] = [
            'sound_type' => 'nasal',
            'sound_name' =>'GN-glide-to-liquid-y',
            'axiophone' => 'GN',
            'categorization' => "{bold}{fg_dark_yellow}consonant{previous},\n{bold}{fg_bright_blue}nasal{previous}",
            'special_categorization' => "{fg_dark_cyan}glide-y{previous}",
            'type' => 'y_glide_consonant',
            'name' =>'Magnolia-gny-Magnolia',
            'examples' => "gn in ma{fg_bright_cyan}gn{previous}olia\n\nsometimes the gn in Lasa{fg_bright_cyan}gn{previous}a",
            'description' => 'Voiced palatal nasal',
            'info_ipa' => "gnj\n\nɲ\n(when drift \nto gnj)",
            'quick_transcription' => 'gnꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        // ───────────────────────────────────────────
        // Consonants

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'P-axiophone',
            'axiophone' => 'P',
            'type' => 'fixed_consonant',
            'name' =>'Pop-pop',
            'examples' => "p in {fg_bright_cyan}p{previous}ancake\np in {fg_bright_cyan}p{previous}icnic\np in {fg_bright_cyan}p{previous}rincess\np in {fg_bright_cyan}p{previous}ear\np in {fg_bright_cyan}p{previous}o{fg_bright_cyan}p{previous}\np in s{fg_bright_cyan}p{previous}y\np in soa{fg_bright_cyan}p{previous}",
            'description' => "Voiceless bilabial plosive",
            'info_ipa' => 'p',
            'quick_transcription' => 'p',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'P-trill',
            'axiophone' => 'P',
            'type' => 'trill',
            'name' =>'Tpotpowe-tpotpowe',
            'examples' => "(No examples in English)\n\ntp in {fg_bright_cyan}tp{previous}o{fg_bright_cyan}tp{previous}owe\n\t(chicken in Wariʼ)",
            'description' => 'Voiceless bilabial trill',
            'info_ipa' => 'ʙ̥',
            'quick_transcription' => 'p′p′pr',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'P-prenasalized-mp',
            'axiophone' => 'P',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-em-Per',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᵐp',
            'quick_transcription' => 'mp',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'P-preaspirated',
            'axiophone' => 'P',
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Pa',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'ʰp',
            'quick_transcription' => 'hꞌp', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'P-breathy',
            'axiophone' => 'P',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Pa-hhh',
            'examples' => "(No examples in English)\n\n(Old Greek Phi)",
            'description' => '',
            'info_ipa' => 'pʰ',
            'quick_transcription' => 'pꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'B-axiophone',
            'axiophone' => 'B',
            'type' => 'fixed_consonant',
            'name' =>'Bar-Bar',
            'examples' => "b in {fg_bright_cyan}b{previous}ack\nb in {fg_bright_cyan}b{previous}a{fg_bright_cyan}b{previous}y\nb in {fg_bright_cyan}b{previous}oy\nb in ro{fg_bright_cyan}b{previous}ot\nb in la{fg_bright_cyan}b{previous}",
            'description' => "Voiced bilabial plosive",
            'info_ipa' => "b\n\nAlso for β",
            'quick_transcription' => 'b',
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'B-trill',
            'axiophone' => 'B',
            'type' => 'trill',
            'name' =>'Bbrungɡaɡ-bbrungɡaɡ',
            'examples' => "(No examples in English)\n\nБ in {fg_bright_cyan}Б{previous}унгаг \"bbrungɡaɡ\"\n\t(dung beetle in Komi-Permyak)",
            'description' => 'Voiced bilabial trill',
            'info_ipa' => 'ʙ',
            'quick_transcription' => 'b′b′br',
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'B-prenasalized-mb',
            'axiophone' => 'B',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-em-Ber',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ᵐb\n\nAlt m͜b\n\nOld m̆b",
            'quick_transcription' => 'mb',
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'B-breathy',
            'axiophone' => 'B',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Ba-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'bʰ',
            'quick_transcription' => 'bh',
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'F-axiophone',
            'axiophone' => 'F',
            'type' => 'fixed_consonant',
            'name' =>'Fox-fox',
            'examples' => "f in {fg_bright_cyan}f{previous}all\nf in {fg_bright_cyan}f{previous}ill\nf in {fg_bright_cyan}f{previous}un\nf in el{fg_bright_cyan}f{previous}",
            'description' => "Voiceless labiodental fricative",
            'info_ipa' => 'f',
            'quick_transcription' => 'f',
            'phone_family' => 'F',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'F-prenasalized-mf',
            'axiophone' => 'F',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-em-Fer',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᵐf',
            'quick_transcription' => 'mf',
            'phone_family' => 'F',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'V-axiophone',
            'axiophone' => 'V',
            'type' => 'fixed_consonant',
            'name' =>'Valley-valley',
            'examples' => "v in {fg_bright_cyan}v{previous}alve\nv in {fg_bright_cyan}v{previous}ery\nv in ne{fg_bright_cyan}v{previous}er\nv in oursel{fg_bright_cyan}v{previous}es\nv in ha{fg_bright_cyan}v{previous}e",
            'description' => "Voiced labiodental fricative",
            'info_ipa' => 'v',
            'quick_transcription' => 'v',
            'phone_family' => 'V',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'V-extra-long',
            'axiophone' => 'V',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Vvvvv-vvvvv',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'vːː',
            'quick_transcription' => 'vvvvv',
            'phone_family' => 'V',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'V-prenasalized-mv',
            'axiophone' => 'V',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-em-Ver',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᵐv',
            'quick_transcription' => 'mv',
            'phone_family' => 'V',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'TH-fusion',
            'axiophone' => 'TH',
            'type' => 'fixed_consonant',
            'name' =>'Thunder-thunder',
            'examples' => "(For both th's)\n\nð\nth in {fg_bright_cyan}th{previous}at\nth in wri{fg_bright_cyan}th{previous}e\n\nθ\nth in {fg_bright_cyan}th{previous}ud\nth in wi{fg_bright_cyan}th{previous}",
            'description' => "Both:\nVoiceless dental fricative\n&\nVoiced dental fricative\n\n(In English the 2 th's are often \n\"interdental\" \ninstead of dental)",
            'info_ipa' => "(For both θ and ð)\n\n( θ͡ð ?)",
            'quick_transcription' => 'th',
            'phone_family' => 'TH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'TH-voiced',
            'axiophone' => 'TH',
            'type' => 'fixed_consonant',
            'name' =>'TH-voiced',
            'examples' => "ð\nth in {fg_bright_cyan}th{previous}at\nth in wri{fg_bright_cyan}th{previous}e",
            'description' => "Voiced dental fricative",
            'info_ipa' => "ð",
            'quick_transcription' => 'th',
            'phone_family' => 'TH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'TH-voiceless',
            'axiophone' => 'TH',
            'type' => 'fixed_consonant',
            'name' =>'TH-voiceless',
            'examples' => "θ\nth in {fg_bright_cyan}th{previous}ud\nth in wi{fg_bright_cyan}th{previous}",
            'description' => "Voiceless dental fricative",
            'info_ipa' => "θ",
            'quick_transcription' => 'th',
            'phone_family' => 'TH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-axiophone',
            'axiophone' => 'T',
            'type' => 'fixed_consonant',
            'name' =>'Tap-tap',
            'examples' => "t in {fg_bright_cyan}t{previous}ick\nt in {fg_bright_cyan}t{previous}ool\nt in {fg_bright_cyan}t{previous}op\nt in {fg_bright_cyan}t{previous}ap\nt in {fg_bright_cyan}t{previous}oo{fg_bright_cyan}t{previous}",
            'description' => "Voiceless alveolar plosive",
            'info_ipa' => 't',
            'quick_transcription' => 't',
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-prenasalized-nt',
            'axiophone' => 'T',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Ter',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ⁿt',
            'quick_transcription' => 'nt',
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-preaspirated',
            'axiophone' => 'T',
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Ta',
            'examples' => "(No examples in English)\n\ntt in ha{fg_bright_cyan}tt{previous}ur\n\t(hat in Faroese)",
            'description' => '',
            'info_ipa' => 'ʰt',
            'quick_transcription' => 'hꞌt', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-breathy',
            'axiophone' => 'T',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Ta-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'tʰ',
            'quick_transcription' => 'tꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'T',
        ];

        /*
        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-retroflex',
            'axiophone' => 'T',
            'type' => 'fixed_consonant',
            'name' =>'T-retroflex',
            'examples' => '',
            'description' => 'Voiceless retroflex plosive',
            'info_ipa' => 'ʈ',
            'quick_transcription' => 'tꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'T',
        ];
        */

        /*
        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'T-retroflex-prenasalized-nnt-h',
            'axiophone' => 'T',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-ennn-T-her',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᶯʈ',
            'quick_transcription' => 'nnꞌtꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'T',
        ];
        */

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'D-axiophone',
            'axiophone' => 'D',
            'type' => 'fixed_consonant',
            'name' =>'Day-day',
            'examples' => "d in {fg_bright_cyan}d{previous}ay\nd in {fg_bright_cyan}d{previous}ash\nD in {fg_bright_cyan}D{previous}a{fg_bright_cyan}d{previous}\ndd in a{fg_bright_cyan}dd{previous}",
            'description' => "Voiced alveolar plosive",
            'info_ipa' => 'd',
            'quick_transcription' => 'd',
            'phone_family' => 'D',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'D-prenasalized-nd',
            'axiophone' => 'D',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Der',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ⁿd\n\nAlt n͜d\n\nOld n̆d",
            'quick_transcription' => 'nd',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'D-breathy',
            'axiophone' => 'D',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Da-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'dʰ',
            'quick_transcription' => 'dꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'D',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'S-axiophone',
            'axiophone' => 'S',
            'type' => 'fixed_consonant',
            'name' =>'Sun-sun',
            'examples' => "s in {fg_bright_cyan}s{previous}and\ns in {fg_bright_cyan}s{previous}it\ns in {fg_bright_cyan}s{previous}un\nss in cla{fg_bright_cyan}ss{previous}",
            'description' => "Voiceless alveolar fricative",
            'info_ipa' => 's',
            'quick_transcription' => 's',
            'phone_family' => 'S',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'S-extra-long',
            'axiophone' => 'S',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Sssss-sssss',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'sːː',
            'quick_transcription' => 'sssss',
            'phone_family' => 'S',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'S-prenasalized-ns',
            'axiophone' => 'S',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Ser',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ⁿs',
            'quick_transcription' => 'ns',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Z-axiophone',
            'axiophone' => 'Z',
            'type' => 'fixed_consonant',
            'name' =>'Zoom-zoom',
            'examples' => "z in {fg_bright_cyan}z{previous}oo\nz in {fg_bright_cyan}z{previous}ebra",
            'description' => "Voiced alveolar fricative",
            'info_ipa' => 'z',
            'quick_transcription' => 'z',
            'phone_family' => 'Z',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Z-extra-long',
            'axiophone' => 'Z',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Zzzzz-zzzzz',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'zːː',
            'quick_transcription' => 'zzzzz',
            'phone_family' => 'Z',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Z-prenasalized-nz',
            'axiophone' => 'Z',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Zer',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ⁿz\n\nⁿd͡zz̩˧",
            'quick_transcription' => 'nz',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'SH-axiophone',
            'axiophone' => 'SH',
            'type' => 'fixed_consonant',
            'name' =>'Shy-shy',
            'examples' => "sh in {fg_bright_cyan}sh{previous}ould\nsh in {fg_bright_cyan}sh{previous}op\nsh in ba{fg_bright_cyan}sh{previous}",
            'description' => "Voiceless postalveolar fricative",
            'info_ipa' => 'ʃ',
            'quick_transcription' => 'sh',
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'SH-extra-long',
            'axiophone' => 'SH',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Shhhh-shhhh',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ʃːː',
            'quick_transcription' => 'shhhh',
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'SH-prenasalized-nysh',
            'axiophone' => 'SH',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-eny-Sher',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᶮc',
            'quick_transcription' => 'nyꞌsh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'ZH-axiophone',
            'axiophone' => 'ZH',
            'type' => 'fixed_consonant',
            'name' =>'Genre-genre',
            'examples' => "s in A{fg_bright_cyan}s{previous}ia\ns in mea{fg_bright_cyan}s{previous}ure\nJ in {fg_bright_cyan}J{previous}oyeuse\nJ in {fg_bright_cyan}J{previous}ean-Luc Picard\ng in lanterne rou{fg_bright_cyan}g{previous}e\ns in vi{fg_bright_cyan}s{previous}ion\ng in {fg_bright_cyan}g{previous}enre",
            'description' => "Voiced postalveolar fricative",
            'info_ipa' => 'ʒ',
            'quick_transcription' => 'zh',
            'phone_family' => 'ZH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'ZH-extra-long',
            'axiophone' => 'ZH',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Zhhhh-zhhhh',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ʒːː',
            'quick_transcription' => 'zhhhh',
            'phone_family' => 'ZH',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'K-axiophone',
            'axiophone' => 'K',
            'type' => 'fixed_consonant',
            'name' =>'King-king',
            'examples' => "k in {fg_bright_cyan}k{previous}ing\nc in {fg_bright_cyan}c{previous}at\nk in {fg_bright_cyan}k{previous}iss\nc in {fg_bright_cyan}c{previous}olor\nck in che{fg_bright_cyan}ck{previous}\nch in {fg_bright_cyan}ch{previous}emistry\nc and ch in {fg_bright_cyan}c{previous}lo{fg_bright_cyan}ck{previous}",
            'description' => "Voiceless velar plosive",
            'info_ipa' => 'k',
            'quick_transcription' => 'k',
            'phone_family' => 'K',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'K-prenasalized-ngk',
            'axiophone' => 'K',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-eng-Ker',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᵑk',
            'quick_transcription' => 'ngꞌk', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'K-preaspirated',
            'axiophone' => 'K',
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Ka',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'ʰk',
            'quick_transcription' => 'hꞌk', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'G-axiophone',
            'axiophone' => 'G',
            'type' => 'fixed_consonant',
            'name' =>'Go-go',
            'examples' => "g in {fg_bright_cyan}g{previous}o\ng in {fg_bright_cyan}g{previous}ive\ng in {fg_bright_cyan}g{previous}a{fg_bright_cyan}gg{previous}le",
            'description' => "Voiced velar plosive",
            'info_ipa' => 'g',
            'quick_transcription' => 'g',
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'G-prenasalized-ng-g',
            'axiophone' => 'G',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-eng-Ger',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ᵑɡ\n\nAlt ŋ͡ɡ\n\nOld ŋ̆ɡ",
            'quick_transcription' => 'ngꞌg', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'G-breathy',
            'axiophone' => 'G',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Ga-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'gʰ',
            'quick_transcription' => 'gꞌh', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'H-axiophone',
            'axiophone' => 'H',
            'type' => 'fixed_consonant',
            'name' =>'Hello-hello',
            'examples' => "h in {fg_bright_cyan}h{previous}appy\nh in {fg_bright_cyan}h{previous}op\nh in {fg_bright_cyan}h{previous}igh\nwh in {fg_bright_cyan}wh{previous}o",
            'description' => "voiceless glottal fricative\n/ voiceless glottal transition \n/ the aspirate",
            'info_ipa' => 'h',
            'quick_transcription' => 'h',
        ];

        /*
        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'H-extra-long',
            'axiophone' => 'H',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Hhhhh-hhhhh',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'hːː',
            'quick_transcription' => 'hhhhh',
        ];
        */

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'KH-axiophone',
            'axiophone' => 'KH',
            'type' => 'fixed_consonant',
            'name' =>'Loch-loch',
            'examples' => "ch in lo{fg_bright_cyan}ch{previous}\nch in Johann Sebastian Ba{fg_bright_cyan}ch{previous}",
            'description' => "Voiceless velar fricative",
            'info_ipa' => 'x',
            'quick_transcription' => 'kh',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'KH-extra-long',
            'axiophone' => 'KH',
            'type' => 'extra_long_fixed_consonant',
            'name' =>'Khhhh-khhhh',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'xːː',
            'quick_transcription' => 'khhhh',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'QH-axiophone',
            'axiophone' => 'QH',
            'type' => 'fixed_consonant',
            'name' =>'Qatar-Qatar',
            'examples' => "q in {fg_bright_cyan}Q{previous}atar",
            'description' => "Voiceless uvular plosive",
            'info_ipa' => 'q',
            'quick_transcription' => 'qh',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'QH-prenasalized-nhq',
            'axiophone' => 'QH',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-nh-Qer',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᶰq',
            'quick_transcription' => 'nhꞌq', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Pharyngeal-voiceless',
            'axiophone' => 'Pharyngeal',
            'type' => 'pharyngeal',
            'name' =>'H(hhh)ar',
            'examples' => "(No examples in English)\n\n(used in Avar, Arabic,\nMaltese)\n\n{fg_bright_cyan}ħ{previous}ar (heat in Arabic)",
            'description' => 'Voiceless pharyngeal fricative',
            'info_ipa' => 'ħ',
            'quick_transcription' => 'h(hhh)',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Pharyngeal-voiced',
            'axiophone' => 'Pharyngeal',
            'type' => "pharyngeal\n\nsemi",
            'name' =>'W(rrr)ahyn',
            'examples' => "(No examples in English)\n\n{fg_bright_cyan}ʕ{previous}ajn (eye in Arabic)",
            'description' => 'Voiced pharyngeal fricative',
            'info_ipa' => 'ʕ',
            'quick_transcription' => 'w(rrr)',
            'phone_family' => 'W',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Pharyngeal-voiced-trill',
            'axiophone' => 'Pharyngeal',
            'type' => 'pharyngeal',
            'name' =>'G(rrr)akwa',
            'examples' => "(No examples in English)\n\n(used in Richa dialect Agul,\nIraqi Arabic, Siwa)\n\n{fg_bright_cyan}І{previous}екв (light in Richa)",
            'description' => 'Voiced epiglottal trill',
            'info_ipa' => 'ʢ',
            'quick_transcription' => 'g(rrr)',
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Epiglottal-voiceless',
            'axiophone' => 'Epiglottal',
            'type' => 'pharyngeal',
            'name' =>'Ya(ah)',
            'examples' => "(No examples in English)\n\n(used in Aghul,\nRicha dialect)\n\nйа{fg_bright_cyan}гьІ{previous} (center in Richa)",
            'description' => 'voiceless* pharyngeal (epiglottal) plosive',
            'info_ipa' => 'ʡ',
            'quick_transcription' => '(ah)',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Epiglottal-voiceless-trill',
            'axiophone' => 'Epiglottal',
            'type' => 'pharyngeal',
            'name' =>'H(rrr)atsh',
            'examples' => "(No examples in English)\n\n(used in Agul, Haida)\n\n{fg_bright_cyan}хІ{previous}ач (apple in Richa)",
            'description' => 'Voiceless epiglottal trill',
            'info_ipa' => 'ʜ',
            'quick_transcription' => '(ah)(rrr)',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'Glottal-axiophone',
            'axiophone' => 'Glottal',
            'type' => 'fixed_consonant',
            'name' =>'Uh-oh-uh-oh',
            'examples' => "- in uh{fg_bright_cyan}-{previous}oh",
            'description' => "glottal stop\n/ glottal plosive",
            'info_ipa' => 'ʔ',
            'quick_transcription' => '-ꞌ-', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'TL-axiophone',
            'axiophone' => 'TL',
            'type' => 'sub_fixed_consonant',
            'name' =>'Tla-tla',
            'examples' => "(No examples in English)\n\ntl in {fg_bright_cyan}tl{previous}a\n\t('no' in Cherokee)\ntl in Nahua{fg_bright_cyan}tl{previous}\n\t(Nahuatl in Nahuatl)\ntl in {fg_bright_cyan}tl{previous}eilóo\n\t(butterfly in Tlingit)",
            'description' => "Voiceless alveolar lateral affricate",
            'info_ipa' => 't͡ɬ',
            'quick_transcription' => 'tlꞌ', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'CH-axiophone',
            'axiophone' => 'CH',
            'type' => 'sub_fixed_consonant',
            'name' =>'Church-church',
            'examples' => "ch in {fg_bright_cyan}ch{previous}arm\nch in ri{fg_bright_cyan}ch{previous}\nt in na{fg_bright_cyan}t{previous}ure",
            'description' => "Voiceless postalveolar affricate",
            'info_ipa' => 'tʃ',
            'quick_transcription' => 'ch',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'CH-preaspirated',
            'axiophone' => 'CH',
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Cha',
            'examples' => "(No examples in English)\n\nkk in sø{fg_bright_cyan}kk{previous}ja\n\t(to sink in Faroese)",
            'description' => '',
            'info_ipa' => 'ʰt͡ʃ',
            'quick_transcription' => 'hꞌch', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'J-axiophone',
            'axiophone' => 'J',
            'type' => 'sub_fixed_consonant',
            'name' =>'Jello-jello',
            'examples' => "j in {fg_bright_cyan}j{previous}ump\nJ in {fg_bright_cyan}J{previous}uly\nj & dge in {fg_bright_cyan}j{previous}u{fg_bright_cyan}dge{previous}\ng in {fg_bright_cyan}g{previous}enie",
            'description' => "Voiced postalveolar affricate",
            'info_ipa' => "d͡ʒ\n\n(formerly ʤ)",
            'quick_transcription' => 'j',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'J-prenasalized-nj',
            'axiophone' => 'J',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-en-Jer',
            'examples' => '',
            'description' => '',
            'info_ipa' => "ⁿd͡ʒ\n\nⁿd͡ʑʑ̩˧",
            'quick_transcription' => 'nj',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'J-breathy',
            'axiophone' => 'J',
            'type' => 'breathy_consonant',
            'name' =>'breathy-Ja-hhh',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'd͡ʒʱ',
            'quick_transcription' => 'jh',
        ];

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'GYHA-axiophone',
            'axiophone' => 'GYHA',
            'type' => 'sub_fixed_consonant',
            'name' =>'Gjat-gjat',
            'examples' => "gj in {fg_bright_cyan}gj{previous}at (cat in Friulian)\ngy in {fg_bright_cyan}gy{previous}ám (guardian in Hungarian)\n2nd g in Gaeil{fg_bright_cyan}g{previous}e (Irish in Irish)",
            'description' => "Voiced palatal plosive",
            'info_ipa' => 'ɟ',
            'quick_transcription' => 'g′ya',
        ];

        /*
        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'GYHA-prenasalized-ny-gyha',
            'axiophone' => 'GYHA',
            'type' => 'prenasalized_consonant',
            'name' =>'pre-nasal-eny-Gyer',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ᶮɟ',
            'quick_transcription' => 'n′yug′ya', // <--- Using Latin Capital Letter Saltillo, not quote
        ];
        */

        $alphabet[] = [
            'sound_type' => 'consonant',
            'sound_name' =>'gHhh-axiophone',
            'axiophone' => 'gHhh',
            'type' => 'sub_fixed_consonant',
            'name' =>'Gouda-gouda',
            'examples' => "(No examples in English)\n\ng in {fg_bright_cyan}g{previous}aan ('to go' in Dutch)\ng in {fg_bright_cyan}g{previous}ouda (Dutch city & cheese)",
            'description' => "Voiced velar fricative",
            'info_ipa' => 'ɣ',
            'quick_transcription' => 'gh(hh)',
            'phone_family' => 'GH',
        ];













































































        // ───────────────────────────────────────────


        $alphabet[] = [
            'type' => 'w_glide_consonant',
            'name' =>'Poirot-Poirot',
            'examples' => "p in Hercule {P}oirot",
            'description' => "",
            'info_ipa' => "pw",
            'quick_transcription' => 'pw',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'w_glide_consonant',
            'name' =>'Voila-voila',
            'examples' => "v in {v}oila",
            'description' => "",
            'info_ipa' => "vw",
            'quick_transcription' => 'vw',
            'phone_family' => 'V',
        ];



        $alphabet[] = [
            'type' => 'w_glide_consonant',
            'name' =>'Quick-quick',
            'examples' => "qu in {qu}een\nqu in {qu}ick",
            'description' => "",
            'info_ipa' => "kw",
            'quick_transcription' => 'qu',
            'phone_family' => 'K',
        ];

        $alphabet[] = [
            'type' => 'w_glide_consonant',
            'name' =>'Gwen-Gwen',
            'examples' => "gu in Uru{gu}ay\nGu in {Gu}inevere\nGw in {Gw}en\nGw in {Gw}ynne\nGu in {Gu}adalupe",
            'description' => "",
            'info_ipa' => "gw",
            'quick_transcription' => 'gw',
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'type' => 's_glide_consonant',
            'name' =>'Psi-Psi',
            'examples' => "Ps in {Ps}i",
            'description' => "",
            'info_ipa' => "ps",
            'quick_transcription' => 'ps',
        ];

        $alphabet[] = [
            'type' => 's_glide_consonant',
            'name' =>'Tsar-tsar',
            'examples' => "ts in {ts}ar\n\n(ts in cats when said fast)\n(ts in outset when said fast)",
            'description' => "",
            'info_ipa' => "ts",
            'quick_transcription' => 'ts',
        ];

        $alphabet[] = [
            'type' => 's_glide_consonant',
            'name' =>'Exit-exit',
            'examples' => "x in e{x}cellent\nx in a{x}e\nx in code{x}",
            'description' => "",
            'info_ipa' => "ks",
            'quick_transcription' => 'x',
            'phone_family' => 'KS',
        ];

        $alphabet[] = [
            'type' => 'z_glide_consonant',
            'name' =>'Dzwon-dzwon',
            'examples' => "(No examples in English)\n\n(similar to ds in dads)\n\ndz in {dz}won (bell in Polish)",
            'description' => "Voiced alveolar affricate",
            'info_ipa' => "d͡z",
            'quick_transcription' => 'dz',
        ];

        $alphabet[] = [
            'type' => "z_glide_consonant",
            'name' =>'Rzim-Rzim',
            'examples' => "{Ř}ím (Rome in Czech)",
            'description' => 'voiced alveolar fricative',
            'info_ipa' => "r̝\n\nř",
            'quick_transcription' => 'rz',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'type' => "zh_glide_consonant",
            'name' =>'Rezh',
            'examples' => "(R + Genre-genre)\n\n(reg in regime when said fast)\n\nRz in {Rz}ym (Rome in Polish)",
            'description' => "Voiced retroflex fricative",
            'info_ipa' => "r͡ʒ\n\nAlt ʐ",
            'quick_transcription' => 'rezh',
            'phone_family' => 'R',
        ];

        $alphabet[] = [
            'type' => "zh_glide_consonant",
            'name' =>'Lezh',
            'examples' => "(L + Genre-genre)\n\n(Sometimes the leas in pleasure\nwhen said fast)",
            'description' => "Voiced alveolar lateral fricatives\n\n(sometimes referred to as Lezh)",
            'info_ipa' => "l͡ʒ\n\nAlt ɮ",
            'quick_transcription' => 'lezh',
        ];

        $alphabet[] = [
            'type' => 'zh_glide_consonant',
            'name' =>'Delezh',
            'examples' => "(No examples in English)\n\n(D + L + Genre-genre)",
            'description' => "",
            'info_ipa' => "dl͡ʒ\n\nAlt dɮ",
            'quick_transcription' => 'delezh',
        ];

        $alphabet[] = [
            'type' => 'zh_glide_consonant',
            'name' =>'Jord-jord',
            'examples' => "(No examples in English)\n\n(Y + Genre-genre)\n\nj in {j}ord\n(soil in Swedish)",
            'description' => "Voiced palatal fricative",
            'info_ipa' => "ʝ",
            'quick_transcription' => 'yzh',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Pewter-py-pewter',
            'examples' => "p in {p}ew\np in {p}ewter\np in com{p}uter",
            'description' => '',
            'info_ipa' => 'pj',
            'quick_transcription' => 'pꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Future-fy-future',
            'examples' => "f in {f}uture\nf in {f}ury",
            'description' => '',
            'info_ipa' => 'fj',
            'quick_transcription' => 'fꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'F',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Beautiful-by-beautiful',
            'examples' => "b in {b}eautiful\n\nbe in {be}o\n(alive in Gaelic)",
            'description' => '',
            'info_ipa' => 'bj',
            'quick_transcription' => 'bꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Tuesday-ty-Tuesday',
            'examples' => "T in {T}uesday",
            'description' => '',
            'info_ipa' => 'tj',
            'quick_transcription' => 'tꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Dew-dy-dew',
            'examples' => "d in {d}ew\nd in en{d}uring",
            'description' => '',
            'info_ipa' => 'dj',
            'quick_transcription' => 'dꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'D',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Syoo-sy-syoo',
            'examples' => "s in tis{s}ue\ns in mon{s}ieur",
            'description' => '',
            'info_ipa' => 'sj',
            'quick_transcription' => 'sꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'S',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Zeus-zy-Zeus',
            'examples' => "Z in {Z}eus\ns in re{s}ume",
            'description' => '',
            'info_ipa' => 'zj',
            'quick_transcription' => 'zꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'Z',
        ];








        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Slew-sly-slew',
            'examples' => "Uncommon in modern English\n\n{sl} in (older) {sl}ew",
            'description' => '',
            'info_ipa' => 'slj',
            'quick_transcription' => 'slꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];



        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Shoe-shy-shoe',
            'examples' => "(Not common in English,\nSometimes the {sh} in {sh}oe)",
            'description' => '',
            'info_ipa' => "ʃy\n\nAlt ç",
            'quick_transcription' => 'shꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Azure-zhy-azure',
            'examples' => "s in fu{s}ion\nz in A{z}ure",
            'description' => 'Voiceless alveolo-palatal fricative',
            'info_ipa' => "ʒj\n\nAlt ʑ",
            'quick_transcription' => 'zhꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Cue-ky-cue',
            'examples' => 'c in {c}ube',
            'description' => '',
            'info_ipa' => 'kj',
            'quick_transcription' => 'kꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'K',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Gue-gy-gue',
            'examples' => "g in {g}ue\ng in fi{g}ure\ng in an{g}ular",
            'description' => '',
            'info_ipa' => "gj\n\nAlt ɟ",
            'quick_transcription' => 'gꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Loch-Y',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => "xy\n\nAlt j̊",
            'quick_transcription' => 'khꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Human-hy-Human',
            'examples' => "h in {h}ue\nh in {h}uman",
            'description' => '',
            'info_ipa' => 'hj',
            'quick_transcription' => 'hꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'y_glide_consonant',
            'name' =>'Jump-jy-jump',
            'examples' => "j in {j}ump\n",
            'description' => '',
            'info_ipa' => 'd͡ʒj',
            'quick_transcription' => 'jꞌy', // <--- Using Latin Capital Letter Saltillo, not quote
        ];












        $alphabet[] = [
            'type' => 'extra_long_f_glide_consonant',
            'name' =>'Pffff-pffff',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'pʰfːː',
            'quick_transcription' => 'pffff',
        ];

        $alphabet[] = [
            'type' => 'extra_long_s_glide_consonant',
            'name' =>'Pssss-pssss',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'p͡sːː',
            'quick_transcription' => 'pssss',
        ];

        $alphabet[] = [
            'type' => 'extra_long_s_glide_consonant',
            'name' =>'Tssss-tssss',
            'examples' => '',
            'description' => '',
            'info_ipa' => 't͡sːː',
            'quick_transcription' => 'tssss',
        ];

        $alphabet[] = [
            'type' => 'extra_long_s_glide_consonant',
            'name' =>'Kssss-kssss',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'k͡sːː',
            'quick_transcription' => 'kssss',
        ];

        // -------------------------

        // ------





        // ------



        // ------




        // ------



        // ------



        // ------




        // ------

        // -------------------------





        // -------------------------



        $alphabet[] = [
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Tsa',
            'examples' => '(No examples in English)',
            'description' => '',
            'info_ipa' => 'ʰt͡s',
            'quick_transcription' => 'hꞌts', // <--- Using Latin Capital Letter Saltillo, not quote
        ];


        /*
        $alphabet[] = [
            'type' => 'preaspirated_consonant',
            'name' =>'ha-Ssha',
            'examples' => "(No examples in English)\n\n(used in Sami languages)",
            'description' => '',
            'info_ipa' => 'ʰt͡ɕ',
            'quick_transcription' => 'hꞌssh', // <--- Using Latin Capital Letter Saltillo, not quote
        ];
        */






        //-------





        //-------






        // =============================================

        // <Emphatics>

        /*
        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'pharyn-Paaa~',
            'examples' => "(No examples in English)\n\n(used in Kurmanji, Chechen,\nand Ubykh)",
            'description' => 'pharyngealized voiceless bilabial stop',
            'info_ipa' => 'pˤ',
            'quick_transcription' => '`p~',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'pharyn-Baaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen, Ubykh, Siwa, \nShihhi Arabic and Iraqi Arabic, \nallophonic in Adyghe\nand Kabardian)",
            'description' => 'pharyngealized voiced bilabial stop',
            'info_ipa' => 'bˤ',
            'quick_transcription' => '`b~',
            'phone_family' => 'B',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'Teth~',
            'examples' => "(No examples in English)\n\n(used in Chechen, Berber,\nArabic, Kurmanji, Mizrahi,\nand Classical Hebrew)\n\nTeth is letter of\nthe Semitic abjads,\nbecoming Tet in Hebrew",
            'description' => 'pharyngealized voiceless alveolar stop',
            'info_ipa' => 'tˤ',
            'quick_transcription' => '`t~',
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'Dhad~',
            'examples' => "(No examples in English)\n\n(used in Chechen,\nTamazight and Arabic)",
            'description' => 'pharyngealized voiced alveolar stop',
            'info_ipa' => 'dˤ',
            'quick_transcription' => '`dh~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'Koph~',
            'examples' => "(No examples in English)\n\n(used in Kurmanji)",
            'description' => 'pharyngealized voiceless velar plosive',
            'info_ipa' => 'kˤ',
            'quick_transcription' => '`k~',
            'phone_family' => 'K',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'Goph~',
            'examples' => "(No examples in English)\n\nBoth:\n\n[gˤ] Uncommon\n\n[ɢˤ] (in Tsakhur)",
            'description' => "gˤ\npharyngealized voiced velar plosive\n\nɢˤ\npharyngealized voiced uvular stop",
            'info_ipa' => 'gˤ & ɢˤ',
            'quick_transcription' => '`g~',
            'phone_family' => 'G',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'Qoph~',
            'examples' => "(No examples in English)\n\n(used in Ubykh,\nTsakhur, and Archi)\n\nQoph is a letter of \nthe Semitic abjads, \nincluding Phoenician qop,\nHebrew qup, Aramaic qop,\nSyriac qop, & Arabic qaf ",
            'description' => 'pharyngealized voiceless uvular stop',
            'info_ipa' => 'qˤ',
            'quick_transcription' => '`qh~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_stop',
            'name' =>'pharyn-Uh-Oh~',
            'examples' => "(No examples in English)\n\n(used in Shihhi Arabic;\nallophonic in Chechen)",
            'description' => 'pharyngealized glottal stop',
            'info_ipa' => 'ʔˤ',
            'quick_transcription' => '`-ꞌ-~', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'pharyn-Faaa~',
            'examples' => '(No examples in English)',
            'description' => 'pharyngealized voiceless labiodental fricative',
            'info_ipa' => 'fˤ',
            'quick_transcription' => '`f~',
            'phone_family' => 'F',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'pharyn-Vaaa~',
            'examples' => "(No examples in English)\n\n(used in Ubykh)",
            'description' => 'pharyngealized voiced labiodental fricative',
            'info_ipa' => 'vˤ',
            'quick_transcription' => '`v~',
            'phone_family' => 'V',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'pharyn-Thaaa~',
            'examples' => "(No examples in English)\n\n ðˤ\n(used in Arabic)",
            'description' => "θˤ\npharyngealized voiceless dental fricative\n\nðˤ\npharyngealized voiced dental fricative",
            'info_ipa' => 'θˤ & ðˤ',
            'quick_transcription' => '`th~',
            'phone_family' => 'TH',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Saad~',
            'examples' => "(No examples in English)\n\n(used in Chechen,\nKurmanji, Arabic,\nClassical Hebrew,\nand Northern Berber)",
            'description' => 'pharyngealized voiceless alveolar sibilant',
            'info_ipa' => 'sˤ',
            'quick_transcription' => '`s~',
            'phone_family' => 'S',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Zaad~',
            'examples' => "(No examples in English)\n\n(used in Chechen,\n Berber, Arabic\nand Kurmanji)",
            'description' => 'pharyngealized voiced alveolar sibilant',
            'info_ipa' => "zˤ\n\n(formerly ᵶ)",
            'quick_transcription' => '`z~',
            'phone_family' => 'Z',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Shaad~',
            'examples' => "(No examples in English)\n\n(used in Chechen,\nalso a hypercorrection\nof the\nModern Hebrew\n [t͡ʃ])",
            'description' => 'pharyngealized voiceless postalveolar fricative',
            'info_ipa' => 'ʃˤ',
            'quick_transcription' => '`sh~',
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Zhaad~',
            'examples' => "(No examples in English)\n\n(used in Chechen)",
            'description' => 'pharyngealized voiced postalveolar fricative',
            'info_ipa' => 'ʒˤ',
            'quick_transcription' => '`zh~',
            'phone_family' => 'ZH',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Lezhaad~',
            'examples' => "(No examples in English)\n\n(used in Classical Arabic)",
            'description' => 'pharyngealized voiced alveolar lateral fricative',
            'info_ipa' => 'ɮˤ',
            'quick_transcription' => '`lezh~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'Delezhaad~',
            'examples' => "(No examples in English)\n\n(used in Classical Arabic)",
            'description' => '',
            'info_ipa' => 'd͡ɮˤ',
            'quick_transcription' => '`delezh~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'pharyn-Khaaa~',
            'examples' => "(No examples in English)\n\n(used in Ubykh, Tsakhur,\nArchi, and Bzyb Abkhaz)",
            'description' => 'pharyngealized voiceless uvular fricative',
            'info_ipa' => 'xˤ',
            'quick_transcription' => '`kh~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_fricative',
            'name' =>'pharyn-Haaa~',
            'examples' => "(No examples in English)\n\n(used in Tsakhur)",
            'description' => 'pharyngealized voiceless glottal fricative',
            'info_ipa' => 'hˤ',
            'quick_transcription' => '`h~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_affricate',
            'name' =>'pharyn-Chaaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen and Kurmanji)",
            'description' => 'pharyngealized voiceless postalveolar affricate',
            'info_ipa' => 't͡ʃˤ',
            'quick_transcription' => '`ch~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_affricate',
            'name' =>'pharyn-Jaaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen)",
            'description' => 'pharyngealized voiced postalveolar affricate',
            'info_ipa' => 'd͡ʒˤ',
            'quick_transcription' => '`j~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_affricate',
            'name' =>'Tsade~',
            'examples' => "(No examples in English)\n\n(used in Chechen)\n\n(Tsade is a Hebrew letter\nusually fpr sˤ & t͡s,\n t͡sˤ is rare)",
            'description' => 'pharyngealized voiceless alveolar affricate',
            'info_ipa' => 't͡sˤ',
            'quick_transcription' => '`ts~',
        ];

        $alphabet[] = [
            'type' => 'pharyngealized_affricate',
            'name' =>'pharyn-Dzaaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen)",
            'description' => 'pharyngealized voiced alveolar affricate',
            'info_ipa' => 'd͡zˤ',
            'quick_transcription' => '`dz~',
        ];

        $alphabet[] = [
            'type' => "pharyngealized_approximant\n\nsemi",
            'name' =>'pharyn-Waaa~',
            'examples' => "(No examples in English)\n\n(used in Shihhi Arabic,\nChechen and Ubykh)",
            'description' => 'pharyngealized labialized velar approximant',
            'info_ipa' => 'wˤ',
            'quick_transcription' => '`w~',
            'phone_family' => 'W',
        ];

        $alphabet[] = [
            'type' => "pharyngealized_approximant\n\nliquid",
            'name' =>'pharyn-Laaa~',
            'examples' => "(No examples in English)\n\n(used in Chechen,\n& Northern Standard Dutch)",
            'description' => 'pharyngealized alveolar lateral approximant',
            'info_ipa' => 'lˤ',
            'quick_transcription' => '`l~',
        ];
        */

        // </Emphatics>
        // =============================================


        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Pe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'pʼ',
            'quick_transcription' => 'p---',
            'phone_family' => 'P',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Te---jective',
            'examples' => '',
            'description' => 'Alveolar ejective',
            'info_ipa' => 'tʼ',
            'quick_transcription' => 't---',
            'phone_family' => 'T',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Che---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'cʼ',
            'quick_transcription' => 'ch---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Ke---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'kʼ',
            'quick_transcription' => 'k---',
            'phone_family' => 'K',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Qhe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'qʼ',
            'quick_transcription' => 'qh---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Fe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'fʼ',
            'quick_transcription' => 'f---',
            'phone_family' => 'F',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'The---jective',
            'examples' => '',
            'description' => 'Dental ejective fricative',
            'info_ipa' => 'θʼ',
            'quick_transcription' => 'th---',
            'phone_family' => 'TH',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Se---jective',
            'examples' => '',
            'description' => 'Alveolar ejective fricative or affricate',
            'info_ipa' => 'sʼ',
            'quick_transcription' => 's---',
            'phone_family' => 'S',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'She---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ʃʼ',
            'quick_transcription' => 'sh---',
            'phone_family' => 'SH',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Sshe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'ɬʼ',
            'quick_transcription' => 'ssh---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Tle---jective',
            'examples' => '',
            'description' => 'Alveolar lateral ejective fricative or affricate',
            'info_ipa' => 'tɬʼ',
            'quick_transcription' => 'tl---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Khe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 'xʼ',
            'quick_transcription' => 'kh---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Tse---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 't͡sʼ',
            'quick_transcription' => 'ts---',
        ];

        $alphabet[] = [
            'type' => 'ejective',
            'name' =>'Tthe---jective',
            'examples' => '',
            'description' => '',
            'info_ipa' => 't̪θʼ',
            'quick_transcription' => 'tꞌth---', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'bilabial_click',
            'name' =>'Pppp-Smack',
            'examples' => '',
            'description' => 'Bilabial click',
            'info_ipa' => 'ʘ',
            'quick_transcription' => 'pq*',
        ];

        $alphabet[] = [
            'type' => 'alveolar_click',
            'name' =>'Ka-Click',
            'examples' => '',
            'description' => '(k Alveolar click)',
            'info_ipa' => 'k͜ǃ',
            'quick_transcription' => 'kq!',
        ];

        $alphabet[] = [
            'type' => 'alveolar_click',
            'name' =>'Ga-Click',
            'examples' => '',
            'description' => '(g Alveolar click)',
            'info_ipa' => 'ɡ͜ǃ',
            'quick_transcription' => 'gq!',
        ];

        $alphabet[] = [
            'type' => 'alveolar_click',
            'name' =>'Ng-Click',
            'examples' => '',
            'description' => '(ng Alveolar click)',
            'info_ipa' => 'ŋ͜ǃ',
            'quick_transcription' => 'ngq!',
        ];

        $alphabet[] = [
            'type' => 'alveolar_click',
            'name' =>'Qa-Click',
            'examples' => '',
            'description' => '(q Alveolar click)',
            'info_ipa' => 'q͜ǃ',
            'quick_transcription' => 'qhq!',
        ];

        $alphabet[] = [
            'type' => 'alveolar_click',
            'name' =>'Nh-Click',
            'examples' => '',
            'description' => '(N Alveolar click)',
            'info_ipa' => 'ɴ͜ǃ',
            'quick_transcription' => 'nhq!',
        ];

        $alphabet[] = [
            'type' => 'dental_click',
            'name' =>'Tut-tut-Click',
            'examples' => '',
            'description' => 'Dental click',
            'info_ipa' => 'ʇ',
            'quick_transcription' => '-tsk!-',
        ];

        $alphabet[] = [
            'type' => 'lateral_click',
            'name' =>'Tchick-tchick-Click',
            'examples' => '',
            'description' => 'Lateral click',
            'info_ipa' => 'ʖ',
            'quick_transcription' => '-tchick!-',
        ];

        // -------------------------





        $alphabet[] = [
            'type' => 'end-syllabic_consonant',
            'name' =>'Mostc-Mostc-cck',
            'examples' => "(No examples in English)\n\nc in most{ć}\n\t(bridge in non-\n\tstandard Croatian)",
            'description' => "",
            'info_ipa' => 'k̩',
            'quick_transcription' => 'ꞌck', // <--- Using Latin Capital Letter Saltillo, not quote
            'phone_family' => 'K',
        ];



        $alphabet[] = [
            'type' => 'syllabic_consonant',
            'name' =>'Sh-sh-Sh',
            'examples' => "(No examples in English,\nalthough Shhhh! comes close.)\n\n(One-off in Hungarian for \"and\")",
            'description' => "",
            'info_ipa' => 'ʃ̩',
            'quick_transcription' => '-sh-',
        ];


        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'apical-I-as-zzz',
            'examples' => "(No examples in English)\n\n(used in Mandarin & Miyakoan)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nɿ\n\nIPA:\n\nz̩",
            'quick_transcription' => 'zzz',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'apical-I-as-zhhh',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nʅ\n\nIPA:\n\nʐ̩",
            'quick_transcription' => 'zhhh',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'apical-U-as-zzzw',
            'examples' => "(No examples in English)\n\n(used in Chinese dialects)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nʮ\n\nIPA:\n\nz̩ʷ",
            'quick_transcription' => 'zzzw',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'apical-U-as-zhhhw',
            'examples' => "(No examples in English)\n\n(used in Chinese dialects)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nʯ\n\nIPA:\n\nʐ̩ʷ",
            'quick_transcription' => 'zhhhw',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'shejian-Si',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nsɿ\n\nIPA:\n\nsź̩",
            'quick_transcription' => 'szzz',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'shejian-Zi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\ntsɿ\n\nIPA:\n\ntsź̩",
            'quick_transcription' => 'tszzz',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'shejian-Shi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nʂʅ\n\nIPA:\n\nʂʐ̩́",
            'quick_transcription' => 'shzhhh',
        ];

        $alphabet[] = [
            'type' => 'zowel',
            'name' =>'shejian-Ri',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\nʐʅ\n\nIPA:\n\nʐʐ̩́",
            'quick_transcription' => 'rzhhh',
        ];


        $alphabet[] = [
            'type' => 'lax-zowel',
            'name' =>'lax-shejian-Si',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "sɯ́",
            'quick_transcription' => 'seziu',
        ];

        $alphabet[] = [
            'type' => 'lax-zowel',
            'name' =>'lax-shejian-Zi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "tsɯ́",
            'quick_transcription' => 'tseziu',
        ];

        $alphabet[] = [
            'type' => 'lax-zowel',
            'name' =>'lax-shejian-Shi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "ʂɯ́",
            'quick_transcription' => 'sheziu',
        ];

        $alphabet[] = [
            'type' => 'lax-zowel',
            'name' =>'lax-shejian-Ri',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "ʐɯ́",
            'quick_transcription' => 'reziu',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Zi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[tsɿ]",
            'quick_transcription' => 'tsu',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Ci',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[tsʰɿ]",
            'quick_transcription' => 'ꞌtsꞌhu', // <--- Using Latin Capital Letter Saltillo, not quote
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Si',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[sɿ]",
            'quick_transcription' => 'su',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Zhi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[ʈʂʅ]",
            'quick_transcription' => 'ju',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Chi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[ʈʂʰʅ]",
            'quick_transcription' => 'chu',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Shi',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[ʂʅ]",
            'quick_transcription' => 'shu',
        ];

        $alphabet[] = [
            'type' => 'i-combine-vowel',
            'name' =>'i-combine-Ri',
            'examples' => "(No examples in English)\n\n(used in Mandarin)",
            'description' => "",
            'info_ipa' => "Sinology:\n\n[ʐʅ]",
            'quick_transcription' => 'yu',
        ];


        $this->sound_alphabet = $alphabet;
    }

}