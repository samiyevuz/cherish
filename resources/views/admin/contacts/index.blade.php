@extends('layouts.admin')
@section('title', 'Xabarlar')
@section('page_title', 'Aloqa xabarlari')
@section('admin_content')

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    @if($contacts->count())
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Yuboruvchi</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Xabar</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amallar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($contacts as $contact)
            <tr class="hover:bg-gray-50 transition-colors {{ !$contact->is_read ? 'bg-blue-50/30' : '' }}">
                <td class="px-5 py-4">
                    <div>
                        <div class="flex items-center gap-1.5">
                            @if(!$contact->is_read)
                                <span class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></span>
                            @endif
                            <p class="text-sm font-semibold text-gray-900">{{ $contact->name }}</p>
                        </div>
                        <p class="text-xs text-gray-500">{{ $contact->email }}</p>
                        <p class="text-xs text-gray-400">{{ $contact->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <p class="text-xs text-gray-600 line-clamp-2 max-w-xs">{{ $contact->message }}</p>
                </td>
                <td class="px-5 py-4 hidden sm:table-cell">
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $contact->is_read ? 'bg-gray-100 text-gray-600' : 'bg-blue-50 text-blue-700' }}">
                        {{ $contact->is_read ? 'O\'qilgan' : 'Yangi' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-xs font-semibold text-violet-600 hover:underline">Ko'rish</a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('O\'chirasizmi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5 border-t border-gray-100">{{ $contacts->links('partials.pagination') }}</div>
    @else
        <div class="p-12 text-center text-sm text-gray-500">Xabarlar yo'q.</div>
    @endif
</div>
@endsection
