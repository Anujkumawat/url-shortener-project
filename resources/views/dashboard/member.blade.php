@extends('layouts.app')

@section('content')

{{-- GENERATE URL--}}
<div class="bg-white p-4 rounded shadow mb-6">

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
<div class="bg-white rounded shadow">

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
                <td class="text-center">{{ $url->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $urls->appends(request()->query())->links() }}
</div>

@endsection