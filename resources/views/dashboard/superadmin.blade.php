@extends('layouts.app')

@section('content')

{{-- Invite Modal --}}
<div id="inviteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white p-6 rounded shadow w-full max-w-lg relative">

        <h2 class="text-lg font-bold mb-4">
            {{ auth()->user()->hasRole('superadmin') ? 'Invite Client (Admin)' : 'Invite Team Member' }}
        </h2>

        {{-- Close Button --}}
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">
            ✕
        </button>

        <form method="POST"
            action="{{ auth()->user()->hasRole('superadmin') ? route('invite.admin') : route('invite.member') }}"
            class="flex flex-col gap-3">
            @csrf

            <input type="text" name="name"
                placeholder="{{ auth()->user()->hasRole('superadmin') ? 'Company Name' : 'Member Name' }}"
                class="border p-2 rounded" required>

            <input type="email" name="email"
                placeholder="{{ auth()->user()->hasRole('superadmin') ? 'Admin Email' : 'Member Email' }}"
                class="border p-2 rounded" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                {{ auth()->user()->hasRole('superadmin') ? 'Send Invitation' : 'Send Invitation' }}
            </button>
        </form>

    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow text-center">
        <h3 class="text-gray-500">Companies</h3>
        <p class="text-2xl font-bold">{{ count($companies) }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <h3 class="text-gray-500">Users</h3>
        <p class="text-2xl font-bold">
            {{ $companies->sum('users_count') }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow text-center">
        <h3 class="text-gray-500">URLs</h3>
        <p class="text-2xl font-bold">{{ count($urls) }}</p>
    </div>
</div>

{{-- Clients Table --}}
<div class="bg-white p-4 rounded shadow mb-6">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-bold">Clients</h2>

        @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
        <button type="button" id="openModal" class="bg-indigo-600 text-white px-4 py-2 rounded">
            Invite
        </button>
        @endif
    </div>

    <table class="w-full text-left">
        <tr class="bg-gray-100">
            <th class="p-2">Company</th>
            <th>Users</th>
            <th>Total Generated URLs</th>
            <th>Total Clicks</th>
        </tr>

        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->users_count }}</td>
            <td>{{ $company->urls_count }}</td>
            <td>{{ $company->urls_sum_clicks }}</td>
        </tr>
        @endforeach
    </table>
</div>

<div class="mt-4">
    {{ $companies->links() }}
</div>

{{-- URL Table --}}
<div class="bg-white rounded shadow mt-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 border-b gap-3">
        <div class="flex items-center gap-2">
            <h3 class="text-lg font-bold">Generated URLs</h3>
            @if(!empty($filter))
            <span class="px-2 py-1 text-sm text-gray-700 bg-gray-100 rounded">
                {{ ucfirst(str_replace('_', ' ', $filter)) }}
            </span>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <form method="GET" action="{{ route('dashboard') }}">
                <select name="filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                    <option value="">All</option>
                    <option value="today" @selected($filter==='today' )>Today</option>
                    <option value="last_week" @selected($filter==='last_week' )>Last Week</option>
                    <option value="last_month" @selected($filter==='last_month' )>Last Month</option>
                </select>
            </form>

            <a href="{{ route('urls.download', ['filter' => $filter]) }}" target="_blank"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Download
            </a>
        </div>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Original URL</th>
                <th class="text-center">Short URL</th>
                <th class="text-center">Clicks</th>
                <th class="text-center">User</th>
            </tr>
        </thead>

        <tbody>
            @foreach($urls as $url)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $url->original_url }}</td>
                <td class="text-center text-blue-600">
                    <a href="{{ url('u/'.$url->short_code) }}" target="_blank" class="underline">
                        {{ url('u/'.$url->short_code) }}
                    </a>
                </td>
                <td class="text-center">{{ $url->clicks }}</td>
                <td class="text-center">
                    {{ $url->user->name ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div class="mt-4">
    {{ $urls->appends(request()->query())->links() }}
</div>


{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('inviteModal');
    const openBtn = document.getElementById('openModal');
    const closeBtn = document.getElementById('closeModal');

    // Open modal
    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    // Close modal
    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Outside click close
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

});
</script>

@endsection