<?php

/**
 * Alphabet Display
 * ----------------
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
use IKM\CLI\CommandLineFormatter;
use IKM\CLI\CommandLineWriter;
use IKM\CLI\CommandLineTableBuilder;

/**
 * Class AlphabetDisplay
 */
class AlphabetDisplay
{
    private CommandLineFormatter    $formatter;
    private CommandLineWriter       $writer;
    private CommandLineTableBuilder $table_builder;
    private SoundAlphabet           $sound_alphabet;

    public function __construct()
    {
        $this->sound_alphabet = new SoundAlphabet();

        // Get CLI tools
        $this->writer        = new CommandLineWriter();
        $this->formatter     = new CommandLineFormatter();
        $this->table_builder = new CommandLineTableBuilder();
    }

    public function showSoundAlphabet()
    {
        // Unsorted
        $this->showUnsortedSounds();

        // Vowels
        $this->showVowels();

        // Rhotic Vowels
        $this->showRhoticVowels();

        // Semis
        $this->showSemis();

        // Rhotic Liquids
        $this->showRhoticLiquids();

        // Consonants
        $this->showConsonants();
    }

    public function showVowels(){
        $this->writer->writeLine('Vowels:');

        $vowel_sounds = $this->sound_alphabet->getVowels();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-yellow',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'name',
                'label'     => 'Name',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'examples',
                'label'     => 'Examples',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'description',
                'label'     => 'Description',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($vowel_sounds, $table_style, $table_columns);
    }

    public function showRhoticVowels(){
        $this->writer->writeLine('Rhotic Vowels:');

        $vowel_sounds = $this->sound_alphabet->getRhoticVowels();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-blue',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'name',
                'label'     => 'Name',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'examples',
                'label'     => 'Examples',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'description',
                'label'     => 'Description',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($vowel_sounds, $table_style, $table_columns);
    }

    public function showSemis(){
        $this->writer->writeLine('Semis:');

        $vowel_sounds = $this->sound_alphabet->getSemis();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-green',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'name',
                'label'     => 'Name',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'examples',
                'label'     => 'Examples',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'description',
                'label'     => 'Description',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($vowel_sounds, $table_style, $table_columns);
    }

    public function showRhoticLiquids(){
        $this->writer->writeLine('Rhotic Liquids:');

        $sounds = $this->sound_alphabet->getRhoticLiquids();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'bright-blue',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'name',
                'label'     => 'Name',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'examples',
                'label'     => 'Examples',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'description',
                'label'     => 'Description',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($sounds, $table_style, $table_columns);
    }

    public function showConsonants(){
        $this->writer->writeLine('Consonants:');

        $consonant_sounds = $this->sound_alphabet->getConsonants();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-yellow',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'short_name',
                'label'     => 'Allophone',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($consonant_sounds, $table_style, $table_columns);
    }

    public function showUnsortedSounds(){
        $this->writer->writeLine('Unsorted:');

        $unsorted_sounds = $this->sound_alphabet->getUnsortedSounds();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-yellow',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'type',
                'label'     => 'Type',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'name',
                'label'     => 'Name',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'examples',
                'label'     => 'Examples',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'description',
                'label'     => 'Description',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'info_ipa',
                'label'     => 'IPA',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'quick_transcription',
                'label'     => 'Quick Transcription',
                'text_align' => 'center',
            ],
        ];

        $this->table_builder->buildTable($unsorted_sounds, $table_style, $table_columns);
    }
}