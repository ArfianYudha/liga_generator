@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- breadcrumbs -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Buat Jadwal
            </h1>
        </div>
    </header>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-20 my-6 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert" role="button">
                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a.5.5 0 10-.707-.707L10 8.586 6.36 4.945a.5.5 0 10-.707.707l3.64 3.641-3.64 3.641a.5.5 0 10.707.707l3.64-3.641 3.641 3.641a.5.5 0 10.707-.707L11.414 10l3.641-3.641a.5.5 0 00-.707-.707L10 8.586l-3.641-3.641a.5.5 0 10-.707.707L10 8.586l3.641-3.641a.5.5 0 10-.707-.707L10 8.586l3.641-3.641z" />
                </svg>
            </span>
        </div>
    @endif
    <!-- table -->
    <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8 lg:flex-row flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">

                    <form method="POST" action="{{ route('schedule.generateSchedule') }}">
                        @csrf
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" id="select-all-checkbox"
                                            class="form-checkbox h-5 w-5 text-green-500">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stadium</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Detail</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tim as $team)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <input
                                                    class="h-5 w-5 text-green-500 border border-gray-300 rounded-sm focus:ring-green-500"
                                                    type="checkbox" name="selected_teams[]" value="{{ $team->id }}">
                                                <input type="hidden" name="id_turnamenFK"
                                                    value="{{ request()->route('id_turnamenFK') }}">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap nama-tim">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if ($team->gambar)
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="{{ asset('picture/logo/' . $team->gambar) }}"
                                                            alt="">
                                                    @else
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $team->nama_tim }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $team->stadion }}
                                        </td>
                                    </tr>
                                    <!-- More items... -->
                                @endforeach
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <label for="start_date">Pilih Tanggal Mulai:</label>
                                        <input type="date" id="start_date" name="start_date" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="flex justify-center">
                            <div class="px-2 py-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    type="submit">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
    <style>
        .nama-tim {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 30%;
            /* atau lebar yang diinginkan */
        }
    </style>
@endpush

@push('after-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const checkboxes = document.querySelectorAll('input[name="selected_teams[]"]');

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(checkboxes).every(checkbox => checkbox
                            .checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                });
            });

            const closeButtons = document.querySelectorAll('.close-alert');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.classList.add('hidden');
                });
            });
        });
    </script>
@endpush
