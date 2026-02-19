@extends('layouts.app')
@section('title', 'Biz haqimizda — CherishStyle')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-14">
        <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-3 block">Bizning hikoyamiz</span>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-4">CherishStyle haqida</h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto">Biz 2020 yildan beri O'zbekistonda premium sneakerlar va sport poyabzallari sohasida faoliyat yuritib kelmoqdamiz.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
        @foreach([
            ['num' => '500+', 'label' => 'Mahsulot turlari', 'color' => 'bg-violet-50'],
            ['num' => '10K+', 'label' => 'Xursand mijozlar', 'color' => 'bg-blue-50'],
            ['num' => '4.9★', 'label' => 'O\'rtacha reyting', 'color' => 'bg-green-50'],
        ] as $stat)
        <div class="{{ $stat['color'] }} rounded-2xl p-7 text-center">
            <p class="text-3xl font-black text-gray-900 mb-1">{{ $stat['num'] }}</p>
            <p class="text-sm text-gray-600">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="space-y-8 text-gray-600 leading-relaxed">
        <p class="text-base">CherishStyle — bu faqat poyabzal do'koni emas, bu sizning hayotiy uslubingiz uchun hamkor. Biz har bir mijozga original, yuqori sifatli mahsulotlarni eng qulay narxda taklif etamiz.</p>
        <p class="text-base">Bizning jamoamiz doimiy ravishda yangi brendlar va kolleksiyalarni kuzatib boradi, shunda siz doimo eng zamonaviy va mashhur modellarni bizdan topa olasiz.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4">
            @foreach([
                ['title' => 'Original mahsulotlar', 'desc' => 'Barcha mahsulotlar to\'liq sertifikatga ega va brend omboridan to\'g\'ridan-to\'g\'ri keladi.'],
                ['title' => 'Tez yetkazish', 'desc' => 'Buyurtmangiz 1-3 ish kuni ichida manzilingizga yetkazib beriladi.'],
                ['title' => 'Qulay qaytarish', 'desc' => '30 kun ichida muammosiz qaytarish imkoni mavjud.'],
                ['title' => '24/7 yordam', 'desc' => 'Har qanday savollaringiz uchun biz doimo yordamga tayyormiz.'],
            ] as $item)
            <div class="bg-white border border-gray-100 rounded-2xl p-5">
                <h3 class="font-bold text-gray-900 mb-1 text-sm">{{ $item['title'] }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
