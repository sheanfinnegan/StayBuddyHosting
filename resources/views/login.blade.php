@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <style>
        @media (max-width: 768px) {
            #log {
                justify-content: center;
                /* default: kiri */
                align-items: center;
                /* default: atas */
            }
        }
    </style>
    <div class="flex min-h-screen justify-center bg-[#f4f3e6] ">
        <div id="log" class="flex-col w-screen flex md:flex-row">
            {{-- Left Side: Form --}}
            <div class="w-[55%] bg-[#f4f3e6] hidden items-center justify-center relative md:flex">
                <img src="{{ asset('assets/RegisBackground.png') }}" alt="StayBuddy Logo" class="w-full">
            </div>

            {{-- Right Side: Logo --}}
            <div style="background: #FF5F1F;
background: linear-gradient(170deg,rgba(255, 95, 31, 1) 30%, rgba(245, 234, 202, 1) 81%);"
                class="w-[90%] md:w-[47%] p-10 md:pt-20 md:pl-15 md:pr-10 rounded-3xl md:rounded-tr-[0px] md:rounded-br-[0px] md:rounded-tl-[150px] md:rounded-bl-[150px] ">
                <h2
                    class="text-putih text-[80px] font-popB mb-15 fw-bold text-shadow-lg justify-center mt-10 md:flex hidden">
                    Login
                </h2>
                <div class="logTitle flex flex-col justify-center items-center md:hidden mb-5 gap-3">
                    <div class="w-full flex justify-center">
                        <img class="w-48 h-24" src="{{ asset('assets/LogoStayBuddyDarkMode.png') }}" alt="">
                    </div>
                    <h2 class="text-putih text-[50px] font-popB fw-bold text-shadow-lg flex justify-center ">
                        Login
                    </h2>
                </div>

                <form method="POST" action="{{ route('doLogin') }}"
                    class="space-y-4 flex justify-center items-center flex-col">
                    @csrf
                    <div class="container w-full flex flex-col gap-8 items-center justify-center md:pl-10">
                        <div class="form-2 w-full md:pr-10">
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-sm font-semibold text-[20px]">Email</label>
                                <input type="email" name="email"
                                    class="w-full h-[50px] px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('email')
                                    <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-4 w-full md:pr-10">
                            <div class="flex flex-col gap-2">
                                <label class="text-putih text-sm font-semibold text-[20px]">Password</label>
                                <input type="password" name="password"
                                    class="w-full h-[50px] px-4 py-2 rounded-full bg-maroon text-putih shadow-md focus:outline-none border border-[#f4f3e6]"
                                    placeholder="Type here...">
                                @error('password')
                                    <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-[70%] h-[50px] bg-putih text-maroon py-2 rounded-full font-bold shadow-md 
           hover:bg-[#5E2D2D] hover:text-putih transition-colors duration-300 mt-15">
                        Log In
                    </button>

                    <p class="text-sm mt-6 text-maroon">
                        Belum Punya Akun? <a href="{{ route('register') }}"
                            class="underline font-semibold text-oranye">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
