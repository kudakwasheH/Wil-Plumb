<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin
        User::updateOrCreate(
            ['email' => 'admin@wilplumbing.com'],
            [
                'name' => 'WIL Plumbing Administrator',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );

        // 2. Ensure public directories exist
        Storage::disk('public')->makeDirectory('services');
        Storage::disk('public')->makeDirectory('projects');

        // Helper to generate SVG mock images
        $generateSvg = function ($title, $subtitle, $bgColor1 = '#0f172a', $bgColor2 = '#1e293b', $accentColor = '#0284c7') {
            return <<<XML
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400">
  <defs>
    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:{$bgColor1};stop-opacity:1" />
      <stop offset="100%" style="stop-color:{$bgColor2};stop-opacity:1" />
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" fill="url(#grad)" />
  <circle cx="300" cy="150" r="60" fill="none" stroke="{$accentColor}" stroke-width="4" stroke-dasharray="10, 5" />
  <path d="M290,130 L290,170 M310,130 L310,170 M270,150 L330,150" stroke="{$accentColor}" stroke-width="4" stroke-linecap="round" />
  <text x="300" y="260" font-family="'Outfit', sans-serif" font-size="28" font-weight="bold" fill="#ffffff" text-anchor="middle">{$title}</text>
  <text x="300" y="300" font-family="'Inter', sans-serif" font-size="16" fill="#94a3b8" text-anchor="middle">{$subtitle}</text>
  <rect x="250" y="340" width="100" height="4" rx="2" fill="{$accentColor}" />
</svg>
XML;
        };

        // Before SVGs
        $beforeSvg = function ($title, $detail) {
            return <<<XML
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400">
  <rect width="100%" height="100%" fill="#334155" />
  <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#475569" stroke-width="1"/>
  </pattern>
  <rect width="100%" height="100%" fill="url(#grid)" />
  <!-- Broken pipes drawing -->
  <path d="M 50 200 L 250 200 C 270 200, 270 170, 290 170 L 550 170" fill="none" stroke="#1e293b" stroke-width="24" stroke-linecap="round"/>
  <path d="M 270 185 L 290 230" fill="none" stroke="#ef4444" stroke-width="4" />
  <circle cx="280" cy="205" r="8" fill="#ef4444" />
  <!-- Water spray -->
  <path d="M 280 205 Q 260 160, 220 150 M 280 205 Q 290 150, 310 130 M 280 205 Q 270 130, 260 110" fill="none" stroke="#38bdf8" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
  <rect x="0" y="0" width="600" height="100" fill="rgba(15, 23, 42, 0.6)" />
  <text x="300" y="55" font-family="'Outfit', sans-serif" font-size="24" font-weight="bold" fill="#ef4444" text-anchor="middle">BEFORE: {$title}</text>
  <text x="300" y="85" font-family="'Inter', sans-serif" font-size="14" fill="#cbd5e1" text-anchor="middle">{$detail}</text>
</svg>
XML;
        };

        // After SVGs
        $afterSvg = function ($title, $detail) {
            return <<<XML
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400">
  <rect width="100%" height="100%" fill="#0f172a" />
  <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#1e293b" stroke-width="1"/>
  </pattern>
  <rect width="100%" height="100%" fill="url(#grid)" />
  <!-- Clean shiny copper pipes -->
  <path d="M 50 200 L 250 200 C 270 200, 270 170, 290 170 L 550 170" fill="none" stroke="#b45309" stroke-width="20" stroke-linecap="round"/>
  <!-- Highlight -->
  <path d="M 50 196 L 250 196 C 268 196, 268 166, 288 166 L 550 166" fill="none" stroke="#fbbf24" stroke-width="4" stroke-linecap="round" opacity="0.6"/>
  <!-- Shiny stars -->
  <path d="M 280 140 L 283 147 L 290 148 L 285 153 L 286 160 L 280 156 L 274 160 L 275 153 L 270 148 L 277 147 Z" fill="#fbbf24"/>
  <path d="M 150 160 L 151.5 163.5 L 155 164 L 152.5 166.5 L 153 170 L 150 168 L 147 170 L 147.5 166.5 L 145 164 L 148.5 163.5 Z" fill="#fbbf24"/>
  <rect x="0" y="0" width="600" height="100" fill="rgba(15, 23, 42, 0.8)" />
  <text x="300" y="55" font-family="'Outfit', sans-serif" font-size="24" font-weight="bold" fill="#10b981" text-anchor="middle">AFTER: {$title}</text>
  <text x="300" y="85" font-family="'Inter', sans-serif" font-size="14" fill="#a1a1aa" text-anchor="middle">{$detail}</text>
</svg>
XML;
        };

        // 3. Seed Services
        $services = [
            [
                'name' => 'Leak Detection & Repair',
                'slug' => 'leak-detection-repair',
                'description' => 'Pinpoint water and gas leaks hidden behind walls or underground with advanced acoustic and thermal imaging equipment. We fix leaks quickly with minimal damage to your property.',
                'price_info' => 'From $99',
                'icon' => 'droplet-half',
                'image_name' => 'leak.svg',
                'title' => 'Leak Detection',
                'subtitle' => 'Non-invasive acoustic diagnostic mapping',
                'color1' => '#0f172a', 'color2' => '#1e3a8a', 'accent' => '#38bdf8'
            ],
            [
                'name' => 'Drain Cleaning & Unclogging',
                'slug' => 'drain-cleaning-unclogging',
                'description' => 'Fast clearing of stubborn blockages in sinks, toilets, showers, and main sewer pipes. We use high-pressure hydro-jetting to clean pipe walls and prevent future backups.',
                'price_info' => 'From $120',
                'icon' => 'water',
                'image_name' => 'drain.svg',
                'title' => 'Hydro Jetting & Cleaning',
                'subtitle' => 'High-velocity water blast cleaning',
                'color1' => '#0f172a', 'color2' => '#115e59', 'accent' => '#2dd4bf'
            ],
            [
                'name' => 'Water Heater Services',
                'slug' => 'water-heater-services',
                'description' => 'Installation, repair, and flush maintenance of traditional tank-based and energy-efficient tankless water heaters. Enjoy endless hot water with our top-tier installations.',
                'price_info' => 'From $199',
                'icon' => 'thermometer-half',
                'image_name' => 'water_heater.svg',
                'title' => 'Water Heater Tech',
                'subtitle' => 'Tankless & standard systems integration',
                'color1' => '#0f172a', 'color2' => '#854d0e', 'accent' => '#fbbf24'
            ],
            [
                'name' => 'Pipe Replacement & Repiping',
                'slug' => 'pipe-replacement-repiping',
                'description' => 'Upgrade old, rusted galvanized pipes to durable copper or highly flexible PEX lines. Ensure clean water flow and prevent future structural damage to your home.',
                'price_info' => 'From $499',
                'icon' => 'wrench',
                'image_name' => 'piping.svg',
                'title' => 'Whole House Repiping',
                'subtitle' => 'Modern copper & PEX plumbing systems',
                'color1' => '#0f172a', 'color2' => '#312e81', 'accent' => '#818cf8'
            ],
            [
                'name' => 'Emergency Plumbing Services',
                'slug' => 'emergency-plumbing-services',
                'description' => 'Burst pipes? Overflowing sewer lines? We offer prompt, professional emergency response team services 24 hours a day, 7 days a week. We stop water damage fast.',
                'price_info' => 'Hourly Rates Apply',
                'icon' => 'exclamation-octagon-fill',
                'image_name' => 'emergency.svg',
                'title' => '24/7 Emergency Response',
                'subtitle' => 'Immediate dispatch for critical failures',
                'color1' => '#1e1b4b', 'color2' => '#7f1d1d', 'accent' => '#f87171'
            ]
        ];

        foreach ($services as $srv) {
            Storage::disk('public')->put(
                'services/' . $srv['image_name'],
                $generateSvg($srv['title'], $srv['subtitle'], $srv['color1'], $srv['color2'], $srv['accent'])
            );

            Service::updateOrCreate(
                ['slug' => $srv['slug']],
                [
                    'name' => $srv['name'],
                    'description' => $srv['description'],
                    'price_info' => $srv['price_info'],
                    'icon' => $srv['icon'],
                    'image_path' => 'services/' . $srv['image_name'],
                    'is_active' => true
                ]
            );
        }

        // 4. Seed Projects
        $projects = [
            [
                'title' => 'Kitchen Pipe Restoration',
                'slug' => 'kitchen-pipe-restoration',
                'description' => 'Replaced aged and leaking galvanized steel water lines beneath a residential kitchen sink with high-quality copper and flexible PEX piping, ensuring safe drinking water and zero leaks.',
                'location' => 'Springfield Suburbs',
                'category' => 'Residential',
                'completion_date' => '2026-05-15',
                'is_featured' => true,
                'before_title' => 'Corroded Steel Pipes',
                'before_detail' => 'Severely rusted joints with active slow leaks',
                'after_title' => 'Brand New Copper Fit',
                'after_detail' => 'Soldered copper tubes with durable shutoff valves'
            ],
            [
                'title' => 'Commercial Restaurant Overhaul',
                'slug' => 'commercial-restaurant-overhaul',
                'description' => 'A complete plumbing layout overhaul for a bustling downtown restaurant. Upgraded grease trap connection nodes and heavy-duty commercial kitchen faucets to meet local health code regulations.',
                'location' => 'Downtown Heights',
                'category' => 'Commercial',
                'completion_date' => '2026-05-24',
                'is_featured' => true,
                'before_title' => 'Blocked Restaurant Drain',
                'before_detail' => 'Grease buildup causing severe backflow issues',
                'after_title' => 'Tough Grease Trap Loop',
                'after_detail' => 'Upgraded layout and high-flow steel interceptors'
            ],
            [
                'title' => 'Emergency Main Sewer Unclog',
                'slug' => 'emergency-main-sewer-unclog',
                'description' => 'Dispatched emergency response units to handle a backed-up main sewer pipe that was flooding a residential basement. Cleared root infiltration using heavy-duty hydro-jetting.',
                'location' => 'West End',
                'category' => 'Emergency',
                'completion_date' => '2026-06-01',
                'is_featured' => true,
                'before_title' => 'Blocked Main Sewer Link',
                'before_detail' => 'Root blockage causing backflow into laundry room',
                'after_title' => 'Clean High-Pressure Flush',
                'after_detail' => 'Sewer pipe cleared to 100% original diameter'
            ],
            [
                'title' => 'Trenchless Sewer Replacement',
                'slug' => 'trenchless-sewer-replacement',
                'description' => 'Replaced a collapsed clay pipe sewer main line using trenchless pipe bursting methods. Restored functionality in 1 day without destroying the customer\'s beautiful landscaped front lawn.',
                'location' => 'Oakridge Estate',
                'category' => 'Residential',
                'completion_date' => '2026-06-05',
                'is_featured' => false,
                'before_title' => 'Collapsed Clay Line',
                'before_detail' => 'Sunken ground and broken pipeline segments',
                'after_title' => 'Seamless HDPE Sleeve',
                'after_detail' => 'Pulled seamless heavy-duty pipe with zero lawn damage'
            ]
        ];

        foreach ($projects as $proj) {
            $beforeImgName = $proj['slug'] . '_before.svg';
            $afterImgName = $proj['slug'] . '_after.svg';

            Storage::disk('public')->put('projects/' . $beforeImgName, $beforeSvg($proj['before_title'], $proj['before_detail']));
            Storage::disk('public')->put('projects/' . $afterImgName, $afterSvg($proj['after_title'], $proj['after_detail']));

            Project::updateOrCreate(
                ['slug' => $proj['slug']],
                [
                    'title' => $proj['title'],
                    'description' => $proj['description'],
                    'location' => $proj['location'],
                    'category' => $proj['category'],
                    'completion_date' => $proj['completion_date'],
                    'is_featured' => $proj['is_featured'],
                    'before_image' => 'projects/' . $beforeImgName,
                    'after_image' => 'projects/' . $afterImgName
                ]
            );
        }

        // 5. Seed Testimonials
        Testimonial::create([
            'customer_name' => 'John Doe',
            'customer_role' => 'Homeowner',
            'rating' => 5,
            'review' => 'Excellent response time! PlumbPro solved a major leak under my kitchen sink in less than an hour. The technician was extremely neat and friendly.',
            'is_approved' => true
        ]);

        Testimonial::create([
            'customer_name' => 'Sarah Smith',
            'customer_role' => 'Restaurant Manager',
            'rating' => 5,
            'review' => 'We had a clogged main line during a busy Friday dinner rush. They arrived in 20 minutes and cleared the drain. Absolute lifesavers!',
            'is_approved' => true
        ]);

        Testimonial::create([
            'customer_name' => 'Michael Green',
            'customer_role' => 'Property Manager',
            'rating' => 4,
            'review' => 'Very professional team. They replaced old pipes in our 3-unit apartment building. Pricing was clear, competitive, and work was completed on schedule.',
            'is_approved' => true
        ]);

        Testimonial::create([
            'customer_name' => 'Emily Davis',
            'customer_role' => 'Homeowner',
            'rating' => 5,
            'review' => 'Booking was super simple on the website, and the plumber showed up right on time. Highly recommended!',
            'is_approved' => false // Pending approval
        ]);

        // 6. Seed Contact Messages
        ContactMessage::create([
            'name' => 'Alex Johnson',
            'email' => 'alex@example.com',
            'phone' => '555-0199',
            'subject' => 'Service Range Inquiry',
            'message' => 'Hello, I live slightly outside Springfield (about 15 miles north). Do you service that area or is it out of bounds?',
            'is_read' => false
        ]);

        ContactMessage::create([
            'name' => 'Markus Lee',
            'email' => 'markus@example.com',
            'phone' => '555-0200',
            'subject' => 'Quote Request for Commercial Backflow testing',
            'message' => 'Hi, I need to schedule annual backflow prevention testing for our commercial office building. Can you send an estimate for this?',
            'is_read' => true
        ]);

        // 7. Seed Settings
        Setting::set('site_name', 'WIL Plumbing');
        Setting::set('site_email', 'info@wilplumbing.com');
        Setting::set('site_phone', '+263 77 955 2793');
        Setting::set('whatsapp_number', '263779552793');
        Setting::set('business_address', '123 Plumbing Way, Suite A, Harare');
        Setting::set('business_hours', 'Mon - Fri: 8:00 AM - 6:00 PM, Sat: 9:00 AM - 4:00 PM, Sun: Emergency Only');
        Setting::set('hero_title', 'Expert Plumbing Services When You Need Them Most');
        Setting::set('hero_subtitle', 'Fast, reliable, and professional residential & commercial plumbing solutions from certified local experts.');
        Setting::set('about_content', 'At WIL Plumbing, we have provided high-quality plumbing services for over 15 years. Our team of certified and licensed plumbers is committed to resolving your issues, whether it is a small residential leak or a large commercial repiping project. We pride ourselves on integrity, transparent pricing, and robust emergency dispatch.');
    }
}
