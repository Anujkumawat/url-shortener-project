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
                Send Invitation
            </button>
        </form>

    </div>
</div>

{{-- Modal Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('inviteModal');
    const buttons = document.querySelectorAll('.openInviteModal');
    const close = document.getElementById('closeModal');

    // Open modal
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    // Close modal
    if (close) {
        close.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }

    // Outside click close
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

});
</script>