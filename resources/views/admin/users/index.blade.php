@extends('layouts.admin')
@section('title', 'Foydalanuvchilar')
@section('page_title', 'Foydalanuvchilar')
@section('admin_content')

<div class="flex gap-2 mb-5">
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Qidirish..."
            class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 w-64">
        <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800">Qidirish</button>
    </form>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    @if($users->count())
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Foydalanuvchi</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Rol</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Buyurtmalar</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amallar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center shrink-0">
                            <span class="text-white text-xs font-bold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 hidden sm:table-cell">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $user->role === 'admin' ? 'bg-violet-50 text-violet-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $user->role === 'admin' ? 'Admin' : 'Mijoz' }}
                    </span>
                </td>
                <td class="px-5 py-4 hidden md:table-cell text-sm text-gray-700">{{ $user->orders_count }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-xs font-semibold text-violet-600 hover:underline">Ko'rish</a>
                        <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-xs font-medium px-2.5 py-1 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">
                                {{ $user->role === 'admin' ? 'Mijoz qilish' : 'Admin qilish' }}
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5 border-t border-gray-100">{{ $users->links('partials.pagination') }}</div>
    @else
        <div class="p-12 text-center text-sm text-gray-500">Foydalanuvchilar topilmadi.</div>
    @endif
</div>
@endsection
