<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Template Livre',
                'type' => 'free',
            ],
            [
                'name' => 'Template Premium',
                'type' => 'premium',
            ],
        ];

        foreach ($templates as $template) {
            Template::firstOrCreate(
                ['type' => $template['type']],
                [
                    'name' => $template['name'],
                ]
            );
        }
    }
}
