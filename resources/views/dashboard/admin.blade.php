@extends('layouts.app')

@section('content')

{{-- TEAM MEMBERS --}}
<div class="bg-white p-4 rounded shadow mb-6">

    <div class="flex justify-between mb-3">
        <h2 class="text-lg font-bold">Team Members</h2>
    </div>

    {{-- Invite Form --}}
    <form method="POST" action="{{ route('invite.member') }}" class="mb-4">
        @csrf

        <input type="text" name="name" placeholder="Member Name" class="border p-2 mr-2" required>

        <input type="email" name="email" placeholder="Member Email" class="border p-2 mr-2" required>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Invite
        </button>
    </form>

    {{-- Members Table --}}
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Total URLs</th>
                <th class="text-center">Clicks</th>
                <th class="text-center">Role</th>
                <th class="text-center">Created On</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="p-2">{{ $user->name }}</td>

                {{-- ✅ Center Email --}}
                <td class="text-center">{{ $user->email }}</td>

                {{-- ✅ Totals --}}
                <td class="text-center">{{ $user->total_urls }}</td>
                <td class="text-center">{{ $user->total_clicks }}</td>

                <td class="text-center">
                    {{ $user->getRoleNames()->first() ?? '-' }}
                </td>

                {{-- ✅ Center + Format --}}
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y h:i A') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $urls->links() }}
</div>

{{-- GENERATE URL --}}
<div class="bg-white p-4 rounded shadow mb-6 mt-3">

    <h2 class="text-lg font-bold mb-3">Generate Short URL</h2>

    <form method="POST" action="{{ route('url.store') }}">
        @csrf

        <input type="text" name="url" placeholder="Enter URL (https://example.com)" class="border p-2 mr-2 w-1/2"
            required>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Generate
        </button>
    </form>

    @if(session('short_url'))
    <div class="mt-3 text-green-600">
        {{ session('short_url') }}
    </div>
    @endif

</div>

{{-- URL LIST --}}
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
                <th class="text-center">Created On</th>
            </tr>
        </thead>

        <tbody>
            @foreach($urls as $url)
            <tr class="border-t">
                <td class="p-3">{{ $url->original_url }}</td>

                <td class="text-center text-blue-600">
                    <a href="{{ url('u/'.$url->short_code) }}" target="_blank" class="underline">
                        {{ url('u/'.$url->short_code) }}
                    </a>
                </td>

                <td class="text-center">{{ $url->clicks }}</td>
                <td class="text-center">{{ $url->created_at }}</td>
            </tr>
            @endforeach


        </tbody>
    </table>

</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $urls->links() }}
</div>

@endsection