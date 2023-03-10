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
                    'description' =>  'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It is often assisted by technologies such as Cascading Style Sheets (CSS) and scripting languages such as JavaScript.',
                ],
                [
                    'name' => 'CSS',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/CSS3_logo_and_wordmark.svg/1200px-CSS3_logo_and_wordmark.svg.png',
                    'description' =>  'Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language such as HTML or XML (including XML dialects such as SVG, MathML or XHTML). CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript.',
                ],
                [
                    'name' => 'JavaScript',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Unofficial_JavaScript_logo_2.svg/180px-Unofficial_JavaScript_logo_2.svg.png',
                    'description' =>  'Today, JavaScript has become a high-level multi-paradigm programming language that serves as the world’s top frontend programming language for the web, handling all the interactions offered by the webpages, such as pop-ups, alerts, events, and many more like them.',
                ],
                [
                    'name' => 'Vue.js',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png',
                    'description' =>  'Vue.js (commonly referred to as Vue; pronounced "view") is an open-source model–view–viewmodel front end JavaScript framework for building user interfaces and single-page applications. It was created by Evan You, and is maintained by him and the rest of the active core team members.',
                ],
                [
                    'name' => 'Php',
                    'logo_path' =>  'https://assets.zabbix.com/img/brands/php.svg',
                    'description' =>  'Today, PHP has become a general-purpose scripting language that’s being used around the globe, primarily for server-side web development. It is fast, simple, and is platform-independent, along with a large open-source software community.',
                ],
                [
                    'name' => 'MySql',
                    'logo_path' =>  'https://d1.awsstatic.com/asset-repository/products/amazon-rds/1024px-MySQL.ff87215b43fd7292af172e2a5d9b844217262571.png',
                    'description' =>  'Designed by Donald D. Chamberlin and Raymond F. Boyce in 1974, the special-purpose programming language has played a key role in enabling developers to create and manage tables and databases for storing relational data over hundreds of thousands of data fields.',
                ],
                [
                    'name' => 'Laravel',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png',
                    'description' =>  'Laravel is a free and open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony.',
                ],
                [
                    'name' => 'BootStrap',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Bootstrap_logo.svg/1200px-Bootstrap_logo.svg.png',
                    'description' =>  'Bootstrap is a free and open-source CSS framework directed at responsive, mobile-first front-end web development. It contains HTML, CSS and (optionally) JavaScript-based design templates for typography, forms, buttons, navigation, and other interface components.',
                ],
                [
                    'name' => 'Tailwind',
                    'logo_path' =>  'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/1024px-Tailwind_CSS_Logo.svg.png',
                    'description' =>  'Tailwind CSS is an open source CSS framework. The main feature of this library is that, unlike other CSS frameworks like Bootstrap, it does not provide a series of predefined classes for elements such as buttons or tables. Instead, it creates a list of "utility" CSS classes that can be used to style each element by mixing and matching.',
                ],
            ];
        foreach ($technologies as $technology) {
            Technology::make($technology)->save();
        }
    }
}
