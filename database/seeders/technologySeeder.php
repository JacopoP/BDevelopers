<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technology;

class TechnologySeeder extends Seeder
{

    public function run()
    {
        $technologies =
        [
            [
                'name' => 'Html',
                'logo_path' =>  'https://cdn-icons-png.flaticon.com/512/732/732212.png',
                'description' =>  null,
            ],
            [
                'name' => 'CSS',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/CSS3_logo_and_wordmark.svg/1200px-CSS3_logo_and_wordmark.svg.png',
                'description' =>  null,
            ],
            [
                'name' => 'JavaScript',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Unofficial_JavaScript_logo_2.svg/180px-Unofficial_JavaScript_logo_2.svg.png',
                'description' =>  null,
            ],
            [
                'name' => 'Vue.js',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png',
                'description' =>  null,
            ],
            [
                'name' => 'Php',
                'logo_path' =>  'https://assets.zabbix.com/img/brands/php.svg',
                'description' =>  null,
            ],
            [
                'name' => 'MySql',
                'logo_path' =>  'https://d1.awsstatic.com/asset-repository/products/amazon-rds/1024px-MySQL.ff87215b43fd7292af172e2a5d9b844217262571.png',
                'description' =>  null,
            ],
            [
                'name' => 'Laravel',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png',
                'description' =>  null,
            ],
            [
                'name' => 'BootStrap',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Bootstrap_logo.svg/1200px-Bootstrap_logo.svg.png',
                'description' =>  null,
            ],
            [
                'name' => 'Tailwind',
                'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/1024px-Tailwind_CSS_Logo.svg.png',
                'description' =>  null,
            ],
        ];
        foreach($technologies as $technology){
            Technology::make($technology)->save();
        }
    }
}

