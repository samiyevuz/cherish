<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Faq;
use App\Models\SizeGuide;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin & Demo Users ───────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@cherishstyle.uz'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'phone'    => '+998901234567',
                'city'     => 'Toshkent',
                'role'     => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'demo@cherishstyle.uz'],
            [
                'name'     => 'Demo Foydalanuvchi',
                'password' => Hash::make('password'),
                'phone'    => '+998901234568',
                'city'     => 'Samarqand',
                'role'     => 'customer',
            ]
        );

        // ─── Categories ───────────────────────────────────────────────────
        $categoriesData = [
            ['name' => 'Erkaklar',           'slug' => 'erkaklar',    'type' => 'men'],
            ['name' => 'Ayollar',            'slug' => 'ayollar',     'type' => 'women'],
            ['name' => 'Yangi mahsulotlar',  'slug' => 'yangi',       'type' => 'new'],
            ['name' => 'Aksiya',             'slug' => 'aksiya',      'type' => 'sale'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['type']] = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // ─── Products ─────────────────────────────────────────────────────
        $this->call(ProductSeeder::class);

        // ─── FAQs ─────────────────────────────────────────────────────────
        $faqs = [
            [
                'question'   => 'Buyurtma qilish uchun ro\'yxatdan o\'tish shartmi?',
                'answer'     => 'Ha, buyurtma qilish va buyurtmangizni kuzatish uchun ro\'yxatdan o\'tishingiz kerak. Bu tez va bepul jarayon.',
                'sort_order' => 1,
            ],
            [
                'question'   => 'Yetkazib berish qancha vaqt oladi?',
                'answer'     => 'Toshkent shahri ichida 1-2 ish kuni, viloyatlarga 2-5 ish kuni ichida yetkazib beriladi.',
                'sort_order' => 2,
            ],
            [
                'question'   => 'Yetkazib berish narxi qancha?',
                'answer'     => 'Toshkent shahri ichida 25 000 so\'m. Viloyatlarga 35 000 so\'m. 500 000 so\'mdan yuqori buyurtmalarda yetkazib berish bepul.',
                'sort_order' => 3,
            ],
            [
                'question'   => 'To\'lovni qanday amalga oshirish mumkin?',
                'answer'     => 'Hozirda naqd pul bilan yetkazib berganda to\'lash imkoniyati mavjud. Tez orada karta orqali to\'lash ham qo\'shiladi.',
                'sort_order' => 4,
            ],
            [
                'question'   => 'Mahsulotni qaytarish mumkinmi?',
                'answer'     => 'Ha, mahsulotni qabul qilgan kunidan boshlab 14 kun ichida qaytarish mumkin. Mahsulot ishlatilmagan va original qadoqda bo\'lishi kerak.',
                'sort_order' => 5,
            ],
            [
                'question'   => 'O\'lchamni qanday tanlash kerak?',
                'answer'     => 'Saytimizda batafsil o\'lcham jadvali mavjud. Oyoq uzunligingizni o\'lchab, jadvalga qarang. Ikki o\'lcham orasida qolsangiz, kattaroqni tanlashingizni maslahat beramiz.',
                'sort_order' => 6,
            ],
            [
                'question'   => 'Savat saqlaniladimi?',
                'answer'     => 'Ha, hisobingizga kirgan bo\'lsangiz, savatingizdagi mahsulotlar keyingi tashrif uchun saqlanib qoladi.',
                'sort_order' => 7,
            ],
            [
                'question'   => 'Buyurtma statusini qanday bilib olaman?',
                'answer'     => '"Buyurtmani kuzatish" sahifasiga o\'tib, buyurtma raqamingizni (CTS-XXXXX formatida) kiriting. Joriy status ko\'rsatiladi.',
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }

        // ─── Size Guides ──────────────────────────────────────────────────
        $menSizes = [
            ['eu' => '38', 'uk' => '5',   'us' => '6',   'length_cm' => '24.0'],
            ['eu' => '39', 'uk' => '6',   'us' => '7',   'length_cm' => '24.7'],
            ['eu' => '40', 'uk' => '6.5', 'us' => '7.5', 'length_cm' => '25.3'],
            ['eu' => '41', 'uk' => '7',   'us' => '8',   'length_cm' => '26.0'],
            ['eu' => '42', 'uk' => '8',   'us' => '9',   'length_cm' => '26.7'],
            ['eu' => '43', 'uk' => '9',   'us' => '10',  'length_cm' => '27.3'],
            ['eu' => '44', 'uk' => '9.5', 'us' => '10.5','length_cm' => '28.0'],
            ['eu' => '45', 'uk' => '10.5','us' => '11.5','length_cm' => '28.7'],
            ['eu' => '46', 'uk' => '11',  'us' => '12',  'length_cm' => '29.3'],
        ];

        $womenSizes = [
            ['eu' => '35', 'uk' => '2.5', 'us' => '5',   'length_cm' => '22.0'],
            ['eu' => '36', 'uk' => '3',   'us' => '5.5', 'length_cm' => '22.7'],
            ['eu' => '37', 'uk' => '4',   'us' => '6.5', 'length_cm' => '23.3'],
            ['eu' => '38', 'uk' => '5',   'us' => '7.5', 'length_cm' => '24.0'],
            ['eu' => '39', 'uk' => '5.5', 'us' => '8',   'length_cm' => '24.7'],
            ['eu' => '40', 'uk' => '6.5', 'us' => '9',   'length_cm' => '25.3'],
            ['eu' => '41', 'uk' => '7',   'us' => '9.5', 'length_cm' => '26.0'],
            ['eu' => '42', 'uk' => '8',   'us' => '10.5','length_cm' => '26.7'],
        ];

        if (SizeGuide::where('type', 'men')->count() === 0) {
            foreach ($menSizes as $size) {
                SizeGuide::create(array_merge($size, ['type' => 'men']));
            }
        }

        if (SizeGuide::where('type', 'women')->count() === 0) {
            foreach ($womenSizes as $size) {
                SizeGuide::create(array_merge($size, ['type' => 'women']));
            }
        }

        $this->command->info('✅ Seeder yakunlandi!');
        $this->command->info('   Admin: admin@cherishstyle.uz / password');
        $this->command->info('   Demo:  demo@cherishstyle.uz / password');
    }
}
