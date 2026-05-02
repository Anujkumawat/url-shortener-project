@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
    {{ session('error') }}
</div>
@endif


<div class="flex justify-between mb-3">
    <h2 class="text-lg font-bold">Clients</h2>

    <button class="openInviteModal bg-indigo-600 text-white px-4 py-2 rounded">
        Invite
    </button>
</div>

@include('dashboard.invite-modal')


{{-- Stats --}}
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
    <h2 class="text-lg font-bold mb-3">Clients</h2>

    <table class="w-full text-left">
        <tr class="bg-gray-100">
            <th class="p-2">Company</th>
            <th>Users</th>
            <th>Total URLs</th>
            <th>Total Clicks</th>
        </tr>

        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->users_count }}</td>
            <td>{{ $company->urls_count }}</td>
            <td>{{ $company->urls_sum_clicks ?? 0 }}</td>
        </tr>
        @endforeach
    </table>
</div>

<div class="mt-4">
    {{ $companies->links() }}
</div>


{{-- URL Table --}}
<div class="bg-white rounded shadow mt-6">

    <div class="flex justify-between p-4 border-b">
        <h3 class="text-lg font-bold">Generated URLs</h3>

        <form method="GET">
            <select name="filter" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                <option value="">All</option>
                <option value="today" @selected($filter==='today' )>Today</option>
                <option value="week" @selected($filter==='week' )>Week</option>
                <option value="month" @selected($filter==='month' )>Month</option>
            </select>
        </form>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Original URL</th>
                <th class="text-center">Short URL</th>
                <th class="text-center">Clicks</th>
                <th class="text-center">Company</th>
            </tr>
        </thead>

        <tbody>
            @foreach($urls as $url)
            <tr class="border-t">
                <td class="p-3">{{ $url->original_url }}</td>
                <td class="text-center  text-blue-600">
                    <a href="{{ url('u/'.$url->short_code) }}" target="_blank" class="underline">
                        {{ url('u/'.$url->short_code) }}
                    </a>
                </td>
                <td class="text-center">{{ $url->clicks }}</td>
                <td class="text-center">{{ $url->company->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $urls->links() }}
</div>

@endsection