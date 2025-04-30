<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactCategory;

class ContactCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'VIP Clients',
                'color' => '#FFD700',
                'description' => 'High-priority contacts and key accounts'
            ],
            [
                'name' => 'Potential Leads',
                'color' => '#90EE90',
                'description' => 'Prospective clients and business opportunities'
            ],
            [
                'name' => 'Support Cases',
                'color' => '#FF6B6B',
                'description' => 'Technical support and customer service inquiries'
            ],
            [
                'name' => 'Partners',
                'color' => '#87CEEB',
                'description' => 'Business partners and collaborators'
            ],
            [
                'name' => 'Newsletter Subscribers',
                'color' => '#DDA0DD',
                'description' => 'Contacts subscribed to newsletters and updates'
            ]
        ];

        foreach ($categories as $category) {
            ContactCategory::create($category);
        }
    }
}