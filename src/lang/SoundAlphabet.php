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
    private array $alphabet;

    public function __construct()
    {
        // Build alphabet
        $this->buildAlphabet();
    }

    public function getSoundAlphabet(): array
    {
        return $this->alphabet;
    }


    private function buildAlphabet()
    {
        $alphabet = [];

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



        $this->alphabet = $alphabet;
    }
}