<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shortened URLs Report</title>
    <style>
        body {
            font-family: sans-serif;
            color: #222;
        }

        h1 {
            margin-bottom: 0.25rem;
        }

        .meta {
            margin-bottom: 1rem;
            color: #555;
            font-size: 0.95rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <h1>Shortened URLs Report</h1>
    <div class="meta">
        Filter: {{ $filter ? ucfirst(str_replace('_', ' ', $filter)) : 'All' }}<br>
        Generated on: {{ now()->format('Y-m-d H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Clicks</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($urls as $url)
            <tr>
                <td>{{ $url->original_url }}</td>
                <td>{{ url('u/'.$url->short_code) }}</td>
                <td>{{ $url->clicks }}</td>
                <td>{{ $url->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>