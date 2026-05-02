<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px;">
        <h3>Invite User</h3>

        <form method="POST" action="{{ route('invite.user') }}">
            @csrf

            <input type="text" name="name" placeholder="Enter Name" required style="padding:8px;margin-right:10px;">

            <input type="email" name="email" placeholder="Enter Email" required style="padding:8px;margin-right:10px;">

            <button type="submit" style="padding:8px 15px;background:#4f46e5;color:white;">
                Invite
            </button>
        </form>
    </div>

    <div style="margin-top:30px;">
        <h3>Shorten URL</h3>

        <form method="POST" action="{{ route('url.store') }}">
            @csrf

            <input type="text" name="url" placeholder="Enter URL" required
                style="padding:8px;margin-right:10px;width:300px;">

            <button type="submit" style="padding:8px 15px;background:green;color:white;">
                Shorten
            </button>
        </form>
    </div>
</x-app-layout>