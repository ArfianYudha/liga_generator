@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- breadcumbs -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Turnamen
            </h1>
        </div>
    </header>
    <div class="mb-20">
        <!-- table -->
        @foreach ($turnamen as $turnamen)
            <div class="pb-4 pt-4 lg:pb-6 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300 table-fixed" style="background-color: #141432">
                                <thead style="background-color: #141432">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            {{ $turnamen->nama_turnamen }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" style="background-color: #141432">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('turnamen.detail', [$turnamen->id]) }}"
                                                class="btn-fill-1-2 items-center border-0 py-3 px-8 focus:outline-none rounded-2xl font-medium text-base mt-6 lg:mt-0">Detail</a>
                                        </td>
                                    </tr>
                                    <!-- More items... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('after-style')
@endpush
