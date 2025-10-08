<x-layouts.app>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <div class="space-y-4">
        <a href="/tes"
            class="inline-block cursor-pointer rounded-md bg-gray-800 px-4 py-3 text-center text-sm font-semibold uppercase text-white transition duration-200 ease-in-out hover:bg-gray-900">
            Test Redirect SweetAlert2
        </a>

        <button onclick="testSweetAlert()"
            class="inline-block cursor-pointer rounded-md bg-gray-800 px-4 py-3 text-center text-sm font-semibold uppercase text-white transition duration-200 ease-in-out hover:bg-gray-900">
            Test SweetAlert2
        </button>
    </div>

    <script>
        function testSweetAlert() {
            Swal.fire({
                title: 'SweetAlert2 Berhasil!',
                text: 'SweetAlert2 telah berhasil diinisialisasi di aplikasi Laravel Anda.',
                icon: 'success',
                confirmButtonText: 'Keren!'
            });
        }
    </script>
</x-layouts.app>
