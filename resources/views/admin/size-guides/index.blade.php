@extends('layouts.admin')
@section('title', "O'lcham jadvali")
@section('page_title', "O'lcham jadvali boshqaruvi")
@section('admin_content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Add form --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <h2 class="font-bold text-gray-900 text-sm mb-4">Yangi o'lcham qo'shish</h2>
        <form action="{{ route('admin.size-guides.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Turi *</label>
                <select name="type" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <option value="men">Erkaklar</option>
                    <option value="women">Ayollar</option>
                </select>
            </div>
            @foreach(['eu' => 'EU', 'uk' => 'UK', 'us' => 'US', 'length_cm' => 'Uzunlik (sm)'] as $field => $label)
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ $label }} *</label>
                <input type="text" name="{{ $field }}" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            @endforeach
            <button type="submit" class="w-full py-2.5 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">Qo'shish</button>
        </form>
    </div>

    {{-- Tables --}}
    <div class="lg:col-span-2 space-y-6" x-data="{ tab: 'men' }">
        <div class="flex gap-2">
            <button @click="tab = 'men'" :class="tab === 'men' ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Erkaklar</button>
            <button @click="tab = 'women'" :class="tab === 'women' ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-700 hover:bg-gray-50'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Ayollar</button>
        </div>

        @foreach(['men' => $menSizes, 'women' => $womenSizes] as $type => $sizes)
        <div x-show="tab === '{{ $type }}'">
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                @if($sizes->count())
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            @foreach(['EU', 'UK', 'US', 'Uzunlik'] as $h)
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $h }}</th>
                            @endforeach
                            <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($sizes as $size)
                        <tr>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $size->eu }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $size->uk }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $size->us }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $size->length_cm }}</td>
                            <td class="px-4 py-3 text-right">
                                <form action="{{ route('admin.size-guides.destroy', $size) }}" method="POST" onsubmit="return confirm('O\'chirasizmi?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1 text-gray-400 hover:text-red-500 rounded transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="p-8 text-center text-sm text-gray-500">O'lchamlar yo'q.</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
