@extends('layouts.admin')
@section('title', 'Xabar')
@section('page_title', 'Xabar')
@section('admin_content')

<div class="max-w-2xl">
    <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
        <div class="grid grid-cols-2 gap-3 text-sm border-b border-gray-100 pb-4">
            <div><span class="text-gray-500">Ism:</span> <span class="font-semibold text-gray-900 ml-1">{{ $contact->name }}</span></div>
            <div><span class="text-gray-500">Email:</span> <a href="mailto:{{ $contact->email }}" class="font-semibold text-violet-600 ml-1">{{ $contact->email }}</a></div>
            @if($contact->phone)
                <div><span class="text-gray-500">Telefon:</span> <span class="font-semibold text-gray-900 ml-1">{{ $contact->phone }}</span></div>
            @endif
            <div><span class="text-gray-500">Sana:</span> <span class="font-semibold text-gray-900 ml-1">{{ $contact->created_at->format('d.m.Y H:i') }}</span></div>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Xabar</p>
            <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 rounded-xl p-4">{{ $contact->message }}</p>
        </div>
        <div class="flex items-center gap-3 pt-2">
            <a href="mailto:{{ $contact->email }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white font-medium rounded-xl text-sm hover:bg-gray-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Email yuborish
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">← Qaytish</a>
        </div>
    </div>
</div>
@endsection
