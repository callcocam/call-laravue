<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use SIGA\Makes\Models\MakeField;
use SIGA\Makes\Models\MakeFieldOption;

class MakeFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MakeField::query()->forceDelete();

        $fields = [
            [
                'icon' => 'fa-text-width',
                'name' => 'Input text',
                'type' => 'text',
                'span' => '12'
            ],
            [
                'icon' => 'fa-regular-check-square',
                'name' => 'Input checkbox',
                'type' => 'checkbox',
                'span' => '12',
                'options' => ['One', 'Thu']
            ],
            [
                'icon' => 'fa-regular-check-circle',
                'name' => 'Input radio',
                'type' => 'radio',
                'span' => '12',
                'options' => ['One', 'Thu']
            ],
            [
                'icon' => 'fa-list-alt',
                'name' => 'Input Select',
                'type' => 'select',
                'span' => '12',
                'options' => ['One', 'Thu']
            ]
        ];

        foreach ($fields as $field) {
            $options = data_get($field, 'options');
            unset($field['options']);
            $model = MakeField::factory()->create($field);
            if ($options) {
                foreach ($options as $option) {
                    MakeFieldOption::factory()->create([
                        'make_field_id' => $model->id,
                        'name' => Str::lower($option),
                        'description' => $option,
                    ]);
                }
            }
        }
    }
}
