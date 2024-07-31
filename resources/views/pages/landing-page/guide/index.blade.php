@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- table -->
    <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <h4 class="text-2xl text-center mb-2 font-bold dark:text-white">Panduan Menggunakan Liga Generator</h4>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-800 dark:text-gray-800">
                        <tbody class="mb-3 text-lg text-black dark:text-gray-400">
                            <tr class="">
                                <td class="pt-5">
                                    1.
                                </td>
                                <td class="pr-6 pt-5">
                                    Untuk menggunakan liga generator, daftar akun dengan klik tombol daftar, jika sudah
                                    memiliki akun silahkan klik tombol login.
                                </td>
                            </tr>
                            <tr class="py-4 ">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6 ">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/1.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    2.
                                </td>
                                <td class="pr-6 pt-5">
                                    Isi form sesuai identitas anda, jika sudah klik tombol daftar.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/2.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    3.
                                </td>
                                <td class="pr-6 pt-5">
                                    Setelah mendaftar akan ada email masuk,kemudian verifikasi akun dengan klik tombol
                                    verify pada email masuk.
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    4.
                                </td>
                                <td class="pr-6 pt-5">
                                    Masukkan email dan password.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/3.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    5.
                                </td>
                                <td class="pr-6 pt-5">
                                    Halaman awal setelah login, Klik buat turnamen jika ingin membuat turnamen.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/4.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    6.
                                </td>
                                <td class="pr-6 pt-5">
                                    Isikan nama turnamen.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/5.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    7.
                                </td>
                                <td class="pr-6 pt-5">
                                    Tampilan seluruh turnamen yang ada.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/6.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    8.
                                </td>
                                <td class="pr-6 pt-5">
                                    Klik My Turnamen, untuk melihan tampilan seluruh turnamen yang anda buat.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/7.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr class="h-px my-8 bg-gray-200 border-10 dark:bg-gray-800">
                <h4 class="text-2xl text-center mb-2 font-bold dark:text-white">Panduan Membuat Liga</h4>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-800 dark:text-gray-800">
                        <tbody class="mb-3 text-lg text-black dark:text-gray-400">
                            <tr class="">
                                <td class="pt-5">
                                    1.
                                </td>
                                <td class="pr-6 pt-5">
                                    Klik tombol detail pada turnamen yang anda buat di bagian My Turnamen.
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    2.
                                </td>
                                <td class="pr-6 pt-5">
                                    Klik tab tim.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/8.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    3.
                                </td>
                                <td class="pr-6 pt-5">
                                    Klik tambah tim.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/9.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    4.
                                </td>
                                <td class="pr-6 pt-5">
                                    Isi data tim kemudian klik simpan.
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    5.
                                </td>
                                <td class="pr-6 pt-5">
                                    Masuk ke halaman jadwal, kemudian klik tambah jadwal.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/10.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    6.
                                </td>
                                <td class="pr-6 pt-5">
                                    Pilih tim yang ingin di tandingkan dalam liga, kemudian klik generate.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/11.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    7.
                                </td>
                                <td class="pr-6 pt-5">
                                    Berikut ini hasil dari generate tersebut.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/12.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pt-5">
                                    8.
                                </td>
                                <td class="pr-6 pt-5">
                                    Masuk ke halaman klasemen untuk melihat klasemen liga tersebut.
                                </td>
                            </tr>
                            <tr class="py-4">
                                <td class="pt-5">
                                </td>
                                <td class="pr-6">
                                    <img class="h-auto max-w-lg" src="{{ asset('picture/guide/13.png') }} "
                                        alt="image description">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('after-style')
@endpush
