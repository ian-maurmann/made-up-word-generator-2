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

        // Lateral Liquids
        $this->showLateralLiquids();

        // Rowels
        $this->showRowels();

        // Nasals
        $this->showNasals();

        // Consonants
        $this->showConsonants();

        // Glide Consonants
        $this->showGlideConsonants();
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
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
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
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
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

    public function showLateralLiquids(){
        $this->writer->writeLine('Lateral Liquids:');

        $sounds = $this->sound_alphabet->getLateralLiquids();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-cyan',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
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

    public function showNasals(){
        $this->writer->writeLine('Nasals:');

        $sounds = $this->sound_alphabet->getNasals();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'dark-red',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'special_categorization',
                'label' => "Special\nCategorization",
                'text_align' => 'center',
            ],
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

    public function showRowels(){
        $this->writer->writeLine('Rowels:');

        $sounds = $this->sound_alphabet->getRowels();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'bright-black',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'special_categorization',
                'label' => "Special\nCategorization",
                'text_align' => 'center',
            ],
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
            'table_border_fg_color' => 'bright-yellow',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'special_categorization',
                'label' => "Special\nCategorization",
                'text_align' => 'center',
            ],
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

        $this->table_builder->buildTable($consonant_sounds, $table_style, $table_columns);
    }

    public function showGlideConsonants(){
        $this->writer->writeLine('Glide Consonants:');

        $glide_consonant_sounds = $this->sound_alphabet->getGlideConsonants();

        $table_style = [
            'table_text_align' => 'left', // 'left' | 'right' | 'center'
            'table_border_fg_color' => 'bright-yellow',
            'table_show_head' => true,
            'table_head_text_align' => 'center',
            'table_head_bg_color' => 'dark-blue',
            'table_head_weight' => 'bold',
        ];

        $table_columns = [
            [
                'attribute' => 'axiophone',
                'label'     => 'Axiophone',
                'text_align' => 'center',
            ],
            [
                'attribute' => 'sound_name',
                'label'     => 'Sound Name',
                'text_align' => 'left',
            ],
            [
                'attribute' => 'special_categorization',
                'label' => "Special\nCategorization",
                'text_align' => 'center',
            ],
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

        $this->table_builder->buildTable($glide_consonant_sounds, $table_style, $table_columns);
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