@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- breadcumbs -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                EDIT PERTANDINGAN
            </h1>
        </div>
    </header>

    <!-- table -->
    <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $schedule->match_date }}</< /th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $schedule->homeTeam->stadion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center flex-row-reverse">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($schedule->homeTeam->gambar)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/' . $schedule->homeTeam->gambar) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="mr-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <b>(H)</b> {{ $schedule->homeTeam->nama_tim }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <input type="text" name="gol_home" placeholder="Home Team Score">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            VS
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <input type="text" name="gol_away" placeholder="Away Team Score">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center ">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($schedule->awayTeam->gambar)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/' . $schedule->awayTeam->gambar) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $schedule->awayTeam->nama_tim }} <b>(A)</b>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- More items... -->
                            </tbody>
                        </table>
                        <div class="grid gap-6 ml-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update
                                    Tanggal</label>
                                <input type="datetime-local" name="match_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date and time" value="{{ $schedule->match_date }}">
                            </div>
                        </div>
                        <button type="submit"
                            class="mx-6 mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
@endpush

@push('after-script')
    {{-- <script>
        document.getElementById('updateScoreForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response from backend
                    console.log(data);
                    // Update klasemen table or show success message
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error message or handle error case
                });
        });
    </script> --}}
@endpush
