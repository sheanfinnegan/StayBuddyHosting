@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <style>
        @media (max-width: 768px) {
            #log {
                justify-content: center;
                /* default: kiri */
                align-items: center;
                /* default: atas */
            }

            #reg {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    <div class="flex min-h-screen justify-center bg-[#f4f3e6]">
        <div id="log" class="flex-col w-screen flex md:flex-row">
            {{-- Left Side: Form --}}
            <div style="background: #FF5F1F;
background: linear-gradient(170deg,rgba(255, 95, 31, 1) 30%, rgba(245, 234, 202, 1) 81%);"
                class="w-[90%] md:w-[47%] p-10 md:pt-20 md:pl-15 rounded-3xl md:rounded-tl-[0px] md:rounded-bl-[0px] md:rounded-tr-[150px] md:rounded-br-[150px] md:mt-0 md:mb-0 mt-10 mb-10">
                <h2 class="text-putih text-6xl font-popB mb-10 fw-bold text-shadow-lg hidden md:flex">Daftar</h2>
                <div class="logTitle flex flex-col justify-center items-center md:hidden mb-5 gap-3">
                    <div class="w-full flex justify-center">
                        <img class="w-48 h-24" src="{{ asset('assets/LogoStayBuddyDarkMode.png') }}" alt="">
                    </div>
                    <h2 class="text-putih text-[50px] font-popB fw-bold text-shadow-lg flex justify-center ">
                        Daftar
                    </h2>
                </div>

                <form id="reg" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div class="container w-full flex flex-col gap-5">
                        <div class="form-1 w-full flex gap-5 md:gap-10 md:flex-row flex-col">
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Nama depan</label>
                                <input type="text" name="first_name"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-sm focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('first_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Nama belakang</label>
                                <input type="text" name="last_name"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('last_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-2 w-full flex gap-5 md:gap-10 md:flex-row flex-col">
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="username@example.com">
                                @error('email')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Nomor Telepon</label>
                                <input type="test" name="phone_number"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('phone_number')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-3 w-full flex gap-5 md:gap-10 md:flex-row flex-col">
                            <div class="flex flex-col gap-2 w-full md:w-[214px]">
                                <label class="text-putih text-md font-semibold">Pekerjaan</label>
                                <select name="occupation"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]">
                                    <option value="">Pilih pekerjaan</option>
                                    <option value="Student">Pelajar</option>
                                    <option value="Worker">Pekerja</option>
                                    <option value="Businessman">Pebisnis</option>
                                </select>
                                @error('occupation')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2 w-full md:w-[214px]">
                                <label class="text-putih text-md font-semibold">Tanggal lahir</label>
                                <input type="date" name="date"
                                    class="ipt-date w-[100%] px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-4 w-full flex gap-5 md:gap-10 md:flex-row flex-col">
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Password</label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('password')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-md font-semibold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                            </div>
                        </div>

                    </div>

                    <div class="mt-2 md:mt-6 md:w-fit w-full">
                        <label class="text-putih text-md font-semibold">Jenis Kelamin</label>
                        <div class="flex space-x-4 mt-1 text-maroon text-sm ">
                            <div class="gender-1 flex justify-center items-center gap-1 text-[15px]">
                                <input type="radio" name="gender" value="male">
                                <label>Laki-laki</label>
                            </div>
                            <div class="gender-2 flex justify-center items-center gap-1 text-[15px]">
                                <input type="radio" name="gender" value="female">
                                <label>Perempuan</label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-[85%] h-[50px] bg-putih text-maroon py-2 rounded-full font-bold shadow-md 
           hover:bg-maroon hover:text-putih transition-colors duration-300 mt-4">
                        Daftar
                    </button>

                    <p class="text-sm mt-4 text-[#570807]">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-oranye underline font-semibold">Log
                            in</a>
                    </p>
                </form>
            </div>

            {{-- Right Side: Logo --}}
            <div class="w-[50%] bg-[#f4f3e6] hidden items-center justify-center relative md:flex ">
                <img src="{{ asset('assets/RegisBackground.png') }}" alt="StayBuddy Logo" class="w-full">
            </div>
        </div>
    </div>
@endsection
