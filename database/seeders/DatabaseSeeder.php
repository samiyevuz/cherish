<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
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
        $products = [
            // Men's products
            [
                'category_id' => $categories['men']->id,
                'name'        => 'Nike Air Max 270',
                'slug'        => 'nike-air-max-270',
                'description' => "Nike Air Max 270 — rahat va zamonaviy sneaker. Keng Air birliği tagi kundalik foydalanish uchun mukammal qulaylik ta'minlaydi. Engil materiali va nafas oluvchi to'ri bilan uzoq kunlik taqishda oyoqlaringiz hech qachon charchamaydi.\n\nMaterial: to'r + sintetik\nOstki qism: guma\nYopish turi: bog'ich",
                'price'       => 890000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'airmax1', 'primary' => true],
                    ['seed' => 'airmax2', 'primary' => false],
                    ['seed' => 'airmax3', 'primary' => false],
                ],
                'sizes'       => ['40' => 5, '41' => 8, '42' => 10, '43' => 7, '44' => 4, '45' => 2],
            ],
            [
                'category_id' => $categories['men']->id,
                'name'        => 'Adidas Ultra Boost 22',
                'slug'        => 'adidas-ultra-boost-22',
                'description' => "Adidas Ultra Boost 22 — engil vazn va maksimal qulaylikni taqdim etuvchi yugurish krossovkasi. Primeknit+ to'r yuqori qismi oyoqni jarayon davomida mahkam ushlab turadi.\n\nMaterial: Primeknit+\nOstki qism: Continental™ guma\nYopish turi: bog'ich",
                'price'       => 1150000,
                'sale_price'  => null,
                'is_new'      => false,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'ultraboost1', 'primary' => true],
                    ['seed' => 'ultraboost2', 'primary' => false],
                ],
                'sizes'       => ['40' => 3, '41' => 6, '42' => 9, '43' => 5, '44' => 3],
            ],
            [
                'category_id' => $categories['men']->id,
                'name'        => 'New Balance 990v5',
                'slug'        => 'new-balance-990v5',
                'description' => "New Balance 990v5 — klassik dizayn va zamonaviy texnologiyalar uyg'unlashtirgan iconic model. ENCAP va Blown Rubber texnologiyalari kundalik taqish uchun ideal qulaylik ta'minlaydi.\n\nMaterial: charm + mesh\nOstki qism: ENCAP + Blown Rubber\nYopish turi: bog'ich",
                'price'       => 1320000,
                'sale_price'  => null,
                'is_new'      => false,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'nb990v5a', 'primary' => true],
                    ['seed' => 'nb990v5b', 'primary' => false],
                ],
                'sizes'       => ['40' => 2, '41' => 4, '42' => 7, '43' => 6, '44' => 5, '45' => 1],
            ],
            [
                'category_id' => $categories['men']->id,
                'name'        => 'Jordan 1 Retro High OG',
                'slug'        => 'jordan-1-retro-high-og',
                'description' => "Air Jordan 1 Retro High OG — barcha zamonlarning eng mashhur basketbol krossovkasi. Yuqori kiyimdan iborat klassik silhouette va Air-Sole yostiqchasi bilan qulaylik va uslubni birlashtiradi.\n\nMaterial: charm\nOstki qism: guma\nYopish turi: bog'ich",
                'price'       => 1580000,
                'sale_price'  => null,
                'is_new'      => false,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'jordan1hoga', 'primary' => true],
                    ['seed' => 'jordan1hogb', 'primary' => false],
                ],
                'sizes'       => ['40' => 1, '41' => 3, '42' => 6, '43' => 4, '44' => 2],
            ],
            [
                'category_id' => $categories['men']->id,
                'name'        => 'Puma RS-X Reinvention',
                'slug'        => 'puma-rs-x-reinvention',
                'description' => "Puma RS-X Reinvention — 80-yillar Running System texnologiyasidan ilhomlanib yaratilgan zamonaviy chunky sneaker. Ko'p qatlamli dizayn va RS-X tagi bilan ajralib turadi.\n\nMaterial: to'r + sintetik\nOstki qism: RS texnologiyasi\nYopish turi: bog'ich",
                'price'       => 680000,
                'sale_price'  => 544000,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'pumarsx1', 'primary' => true],
                    ['seed' => 'pumarsx2', 'primary' => false],
                ],
                'sizes'       => ['40' => 4, '41' => 7, '42' => 9, '43' => 6, '44' => 3, '45' => 1],
            ],
            [
                'category_id' => $categories['men']->id,
                'name'        => 'Converse Chuck 70 Hi',
                'slug'        => 'converse-chuck-70-hi',
                'description' => "Converse Chuck 70 Hi — zamonaviy estetika bilan klassik dizaynni birlashtirgan ikonik model. Kuchaytirilgan qora rang va premium materiallar bilan original Chuckdan farq qiladi.\n\nMaterial: kanvas\nOstki qism: guma\nYopish turi: bog'ich",
                'price'       => 540000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'chuck70hi1', 'primary' => true],
                ],
                'sizes'       => ['38' => 3, '39' => 5, '40' => 8, '41' => 6, '42' => 4, '43' => 2],
            ],
            // Women's products
            [
                'category_id' => $categories['women']->id,
                'name'        => 'Nike Air Force 1 Shadow',
                'slug'        => 'nike-air-force-1-shadow',
                'description' => "Nike Air Force 1 Shadow — klassik AF1 ning yo'l-yo'l qatlamlangan versiyasi. Qo'shimcha qatlamlar va rangli aksentlar bu modelni maxsus qiladi.\n\nMaterial: charm + sintetik\nOstki qism: Air-Sole birlik\nYopish turi: bog'ich",
                'price'       => 920000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'af1shadow1', 'primary' => true],
                    ['seed' => 'af1shadow2', 'primary' => false],
                ],
                'sizes'       => ['36' => 4, '37' => 7, '38' => 9, '39' => 6, '40' => 3],
            ],
            [
                'category_id' => $categories['women']->id,
                'name'        => 'Adidas Stan Smith W',
                'slug'        => 'adidas-stan-smith-w',
                'description' => "Adidas Stan Smith W — ikonik tennis krossovkasining ayollar versiyasi. Oddiy va elegantligi bilan har qanday kiyim bilan uyg'unlashadi.\n\nMaterial: charm\nOstki qism: guma\nYopish turi: bog'ich",
                'price'       => 720000,
                'sale_price'  => 576000,
                'is_new'      => false,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'stansmithw1', 'primary' => true],
                    ['seed' => 'stansmithw2', 'primary' => false],
                ],
                'sizes'       => ['36' => 5, '37' => 8, '38' => 10, '39' => 7, '40' => 2],
            ],
            [
                'category_id' => $categories['women']->id,
                'name'        => 'New Balance 327 W',
                'slug'        => 'new-balance-327-w',
                'description' => "New Balance 327 W — 70-yillar yugurishdan ilhomlanib yaratilgan retro model. Katta N logotipi va kontrast rang kombinatsiyasi bilan ajralib turadi.\n\nMaterial: zamsha + mesh\nOstki qism: EVA + guma\nYopish turi: bog'ich",
                'price'       => 840000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'nb327w1', 'primary' => true],
                    ['seed' => 'nb327w2', 'primary' => false],
                ],
                'sizes'       => ['36' => 3, '37' => 6, '38' => 8, '39' => 5, '40' => 2],
            ],
            [
                'category_id' => $categories['women']->id,
                'name'        => 'Vans Old Skool Platform W',
                'slug'        => 'vans-old-skool-platform-w',
                'description' => "Vans Old Skool Platform W — klassik Vans Old Skool modelining platforma versiyasi. Ekstra balandlik va ikonik Sidestripe bilan stilish ko'rinish beradi.\n\nMaterial: kanvas + zamsha\nOstki qism: platformali guma\nYopish turi: bog'ich",
                'price'       => 620000,
                'sale_price'  => null,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'vansplatw1', 'primary' => true],
                ],
                'sizes'       => ['35' => 3, '36' => 5, '37' => 7, '38' => 6, '39' => 4, '40' => 2],
            ],
            [
                'category_id' => $categories['women']->id,
                'name'        => 'Reebok Classic Leather W',
                'slug'        => 'reebok-classic-leather-w',
                'description' => "Reebok Classic Leather W — 80-yillardan beri sevimli bo'lib kelayotgan charm krossovka. Yumshoq charm qoplami va EVA oraliq tagi bilan kundalik taqishga ideal.\n\nMaterial: yumshoq charm\nOstki qism: EVA + guma\nYopish turi: bog'ich",
                'price'       => 580000,
                'sale_price'  => 464000,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'reebokclw1', 'primary' => true],
                ],
                'sizes'       => ['36' => 4, '37' => 6, '38' => 8, '39' => 5, '40' => 3],
            ],
            // New arrivals (category = new)
            [
                'category_id' => $categories['new']->id,
                'name'        => 'Asics Gel-Nimbus 25',
                'slug'        => 'asics-gel-nimbus-25',
                'description' => "Asics Gel-Nimbus 25 — uzoq masofaga yugurish uchun yaratilgan premium krossovka. FF BLAST PLUS ECO va GEL texnologiyalari bilan maksimal qulaylik ta'minlanadi.\n\nMaterial: engineered mesh\nOstki qism: AHAR+ + GEL\nYopish turi: bog'ich",
                'price'       => 1450000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => true,
                'images'      => [
                    ['seed' => 'gelnimbus1', 'primary' => true],
                    ['seed' => 'gelnimbus2', 'primary' => false],
                ],
                'sizes'       => ['40' => 3, '41' => 5, '42' => 7, '43' => 4, '44' => 2],
            ],
            [
                'category_id' => $categories['new']->id,
                'name'        => 'Saucony Kinvara 14',
                'slug'        => 'saucony-kinvara-14',
                'description' => "Saucony Kinvara 14 — engil va moslashuvchan yugurish krossovkasi. PWRRUN yostiqchasi va flexfilm texnologiyasi bilan tez yugurishni qo'llab-quvvatlaydi.\n\nMaterial: FORMFIT mesh\nOstki qism: PWRRUN + IC guma\nYopish turi: bog'ich",
                'price'       => 980000,
                'sale_price'  => null,
                'is_new'      => true,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'kinvara14a', 'primary' => true],
                ],
                'sizes'       => ['40' => 4, '41' => 6, '42' => 8, '43' => 5, '44' => 3],
            ],
            // Sale products
            [
                'category_id' => $categories['sale']->id,
                'name'        => 'Nike Revolution 6',
                'slug'        => 'nike-revolution-6',
                'description' => "Nike Revolution 6 — kundalik yugurish uchun yaratilgan qulaylik va tejamkorlikni birlashtirgan model. Yumshoq ko'pikli oraliq tagi amortizatsiya ta'minlaydi.\n\nMaterial: mesh\nOstki qism: guma\nYopish turi: bog'ich",
                'price'       => 480000,
                'sale_price'  => 336000,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'nikerev6a', 'primary' => true],
                ],
                'sizes'       => ['39' => 5, '40' => 8, '41' => 10, '42' => 7, '43' => 4, '44' => 2],
            ],
            [
                'category_id' => $categories['sale']->id,
                'name'        => 'Adidas Runfalcon 3.0',
                'slug'        => 'adidas-runfalcon-3',
                'description' => "Adidas Runfalcon 3.0 — iqtisodiy va qulaylikni birlashtirgan kundalik yugurish krossovkasi. Cloudfoam yostiqchasi bilan har qadamda qulaylik his qilasiz.\n\nMaterial: mesh\nOstki qism: Cloudfoam + guma\nYopish turi: bog'ich",
                'price'       => 420000,
                'sale_price'  => 294000,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'runfalcon3a', 'primary' => true],
                ],
                'sizes'       => ['39' => 4, '40' => 7, '41' => 9, '42' => 6, '43' => 3, '44' => 1],
            ],
            [
                'category_id' => $categories['sale']->id,
                'name'        => 'Puma Softride Premier',
                'slug'        => 'puma-softride-premier',
                'description' => "Puma Softride Premier — yumshoq tagi va hafif vazni bilan kundalik taqishga ideal. SoftFoam+ ichki yostiqchasi butun kun davomida oyoqlaringizni qulaylikda saqlaydi.\n\nMaterial: mesh\nOstki qism: SoftFoam+ + guma\nYopish turi: bog'ich",
                'price'       => 380000,
                'sale_price'  => 266000,
                'is_new'      => false,
                'is_featured' => false,
                'images'      => [
                    ['seed' => 'pumapremier1', 'primary' => true],
                ],
                'sizes'       => ['39' => 3, '40' => 6, '41' => 8, '42' => 5, '43' => 2],
            ],
        ];

        foreach ($products as $productData) {
            $imagesData = $productData['images'];
            $sizesData  = $productData['sizes'];
            unset($productData['images'], $productData['sizes']);

            $product = Product::firstOrCreate(['slug' => $productData['slug']], $productData);

            // Images — using picsum URLs directly for demo (no local storage needed)
            if ($product->images()->count() === 0) {
                foreach ($imagesData as $img) {
                    $seedNum = abs(crc32($img['seed'])) % 900 + 100;
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => "https://picsum.photos/seed/{$img['seed']}/600/800",
                        'is_primary'  => $img['primary'],
                    ]);
                }
            }

            // Sizes
            if ($product->sizes()->count() === 0) {
                foreach ($sizesData as $size => $stock) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size'       => (string) $size,
                        'stock'      => $stock,
                    ]);
                }
            }
        }

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
