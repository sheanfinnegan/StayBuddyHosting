@php
    // dd($users);
    $userCount = $users->count();
    $id = Auth::id();
    $hasCurrentUser = false;
    if ($id) {
        $hasCurrentUser = $users->contains('id', $id);
    }

    // dd($home->first()->max_pax, $userCount);

@endphp
<style>
    #conLuar::-webkit-scrollbar {
        display: none;
    }

    #conLuar {
        -ms-overflow-style: none;
        /* IE & Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>
<div id="popupCon"
    class="min-h-screen position-absolute top-0 z-30 bg-[rgba(0,0,0,0.4)] flex items-center justify-center">
    <div id="conLuar"
        class="bg-[#f4f3e6] px-6 py-10 rounded-2xl md:rounded-3xl w-[95%] max-w-screen-xl relative md:h-[80%] h-[650px] overflow-auto md:overflow-hidden ">

        <button id="closePopup" class="closeBtn md:top-8 md:right-10 right-4 text-xl absolute cursor-pointer">
            <img src="{{ asset('assets/closeX.png') }}" alt="" class="w-10 h-10">
            {{-- <i class="fas fa-times"></i> --}}
        </button>
        <!-- Header -->
        <div class=" w-[80%] mx-[10%] relative">
            <div class="flex justify-center items-center bg-[#570807] text-white px-6 py-2">
                <h2 class="wlTitle text-2xl font-bold text-center">
                    {{ $userCount != 0 ? 'BUDDIES DETAIL' : 'BUAT BUDDIES' }}</h2>
            </div>
            <div id="uCount" class="text-xl absolute md:top-2 top-3 right-10 font-bold text-[#FF5F1F]">
                {{ $userCount . '/' . $home->first()->max_pax }}</div>

        </div>

        <!-- Card List -->
        <div id="listCardUser"
            class="flex md:flex-row flex-col overflow-x-auto  space-x-4 py-4 justify-center items-center h-fit">
            <!-- Card 1-->
            @if (!$users->isEmpty())
                @foreach ($users as $index => $user)
                    <div class="group perspective w-[300px] h-[480px] cursor-pointer md:mb-0 mb-7">
                        <div class="relative w-full h-full transition-transform duration-700 transform-style-preserve-3d group-[.flipped]:rotate-y-180"
                            id="cardInner">
                            {{-- Front Side --}}
                            <div
                                class="absolute w-full h-full backface-hidden bg-[#570807] text-white rounded-3xl shadow-lg border-4 border-[#f8A91f] p-4">
                                <img src="{{ asset($user->profile_picture) }}"
                                    class="rounded-lg h-52 object-cover w-full mb-4" alt="Foto" />
                                <div class="text-xl font-bold">{{ $user->name }}</div>
                                <div class="flex gap-2 items-center">
                                    <div class="text-sm">
                                        Rating: {{ number_format($user->rating, 1) }}
                                    </div>
                                    <x-star-rating :rating="$user->rating" />
                                </div>
                                <div class="text-sm">
                                    Umur: {{ \Carbon\Carbon::parse($user->bod)->age }} Tahun<br />
                                    No. telp: {{ $user->phone_num }} <br />
                                    Email: {{ $user->email }}<br />
                                </div>

                                {{-- Match Circle --}}
                                @auth
                                    @if ($user->id == Auth::id())
                                        <div class="mb-20"></div>
                                    @else
                                        <div class="relative flex justify-center items-center mt-3">
                                            <svg class="w-17 h-17 transform -rotate-90" viewBox="0 0 100 100">
                                                <circle cx="50" cy="50" r="45" stroke="#e5e7eb"
                                                    stroke-width="10" fill="transparent" />
                                                <circle cx="50" cy="50" r="45" stroke="#f4f3e6"
                                                    stroke-width="10" fill="transparent" stroke-dasharray="282.6"
                                                    stroke-dashoffset="56.52" stroke-linecap="round" />
                                            </svg>
                                            <div class="absolute text-center flex flex-col">
                                                <span class="text-md font-bold">{{ $user->score }}%</span>
                                                <span class="text-sm font-bold">match</span>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="mb-20"></div>

                                @endauth

                                <div class="mt-1 text-center text-white underline">Preferensi User</div>
                            </div>

                            <div
                                class="absolute w-full h-full backface-hidden rotate-y-180 bg-[#570807] text-white rounded-3xl shadow-lg border-4 border-[#f8A91f] p-4">

                                <div class="h-full overflow-y-auto pr-1 pb-6 scrollbar-hide">
                                    <h1 class="w-full text-center font-popReg font-semibold text-[20px] py-3">
                                        {{ $user->name }}
                                        Preferensi</h1>
                                    <div class="text-sm space-y-5 flex flex-col items-center">
                                        <!-- konten pertanyaan -->
                                        <div class="smoking flex items-center gap-4">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">


                                                    <ion-icon class="text-[50px] text-maroon"
                                                        name="logo-no-smoking"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Toleransi merokok</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->smoking }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="alcoholic flex items-center gap-4">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                                                    <ion-icon class="text-[45px] text-kuning"
                                                        name="beer-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">

                                                <h1 class="font-popReg font-bold pb-1">Toleransi Alcoholic</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->alcoholic }}</h1>

                                            </div>
                                        </div>
                                        <div class="tidiness flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                                                    <ion-icon class="text-[40px] text-merah"
                                                        name="trash-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">

                                                <h1 class="font-popReg font-bold pb-3">Kerapihan</h1>
                                                <div class="flex gap-0.5">
                                                    <!-- Bar 1 (active) -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div
                                                            class="w-7 h-3 {{ $i <= $user->preference->tidiness ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                                                        </div>
                                                    @endfor
                                                </div>

                                            </div>
                                        </div>

                                        <div class="age flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                                                    <ion-icon class="text-[35px] text-oranye"
                                                        name="people-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">

                                                <h1 class="font-popReg font-bold pb-1">Preferensi umur</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->prefered_age }}</h1>

                                            </div>
                                        </div>
                                        <div class="dailyRoutine flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">

                                                    <ion-icon class="text-[35px] text-maroon"
                                                        name="sunny-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Tipe Kegiatan Daily</h1>
                                                <h1 class="font-popReg text-[#797979] text-[15px]">
                                                    {{ $user->preference->routine_type }}</h1>
                                            </div>
                                        </div>
                                        <div class="room flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                                                    <ion-icon class="text-[40px] text-kuning"
                                                        name="bed-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Tipe kamar</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->room_type }}</h1>
                                            </div>
                                        </div>
                                        <div class="socializing flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                                                    <ion-icon class="text-[35px] text-merah"
                                                        name="accessibility-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-3">Tingkat sosialisasi</h1>
                                                <div class="flex gap-0.5">
                                                    <!-- Bar 1 (active) -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div
                                                            class="w-7 h-3 {{ $i <= $user->preference->socializing ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cooking flex items-center gap-4">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                                                    <ion-icon class="text-[35px] text-oranye"
                                                        name="restaurant-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-3">Frekuensi Masak</h1>
                                                <div class="flex gap-0.5">
                                                    <!-- Bar 1 (active) -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div
                                                            class="w-7 h-3 {{ $i <= $user->preference->cooking_freq ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="petFriendly flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">
                                                    <ion-icon class="text-[35px] text-maroon"
                                                        name="thermometer-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Suhu ruangan</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->room_temperature }}</h1>
                                            </div>
                                        </div>
                                        <div class="workStyle flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                                                    <ion-icon class="text-[40px] text-kuning"
                                                        name="briefcase-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Tipe bekerja/belajar</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->work_type }}</h1>
                                            </div>
                                        </div>
                                        <div class="noise flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                                                    <ion-icon class="text-[40px] text-merah"
                                                        name="ear-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-3">Toleransi Kebisingan</h1>
                                                <div class="flex gap-0.5">
                                                    <!-- Bar 1 (active) -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div
                                                            class="w-7 h-3 {{ $i <= $user->preference->noise_tolerance ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gender flex items-center gap-4 w-full pl-1.5">
                                            <div class="img w-[30%]">
                                                <div
                                                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                                                    <ion-icon class="text-[40px] text-oranye"
                                                        name="male-female-outline"></ion-icon>
                                                </div>
                                            </div>
                                            <div class="info text-[16px] w-[70%]">
                                                <h1 class="font-popReg font-bold pb-1">Genre Musik</h1>
                                                <h1 class="font-popReg text-[#797979]">
                                                    {{ $user->preference->music_genre }} Music</h1>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                            </div>


                            {{-- Back Side --}}

                        </div>
                    </div>
                @endforeach
            @endif

            @if ($userCount < $home->first()->max_pax)
                <div class="joincard">


                    <input type="hidden" id="homestay_id" name="homestay_id" value="{{ $home->first()->fsq_id }}">
                    <input type="hidden" id="wlid" name="wlid" value="{{ $wlid }}">
                    @auth
                        <button type="button" id="popupAgree"
                            class="bg-[#601010] text-white rounded-3xl shadow-[3px_4px_6px_rgba(0,0,0,0.3)] p-4 w-[300px] min-h-[480px] flex flex-col justify-center border-4 border-yellow-400 items-center cursor-pointer hover:scale-105 transition">
                            <div
                                class="bg-white rounded-lg mb-2 text-5xl mx-auto min-w-[200px] h-70 flex items-center justify-center">
                                <img src="{{ asset('assets/invite.png') }}" alt="" class="w-24 h-28">
                            </div>
                            <div class="bg-white text-[#601010] font-bold rounded-2xl mt-15 py-4 w-[85%] text-center">
                                Gabung
                                Buddies</div>
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-[#601010] text-white rounded-3xl shadow-[3px_4px_6px_rgba(0,0,0,0.3)] p-4 w-[300px] min-h-[480px] flex flex-col justify-center border-4 border-yellow-400 items-center cursor-pointer hover:scale-105 transition">
                            <div
                                class="bg-white rounded-lg mb-2 text-5xl mx-auto min-w-[200px] h-70 flex items-center justify-center">
                                <img src="{{ asset('assets/invite.png') }}" alt="" class="w-24 h-28">
                            </div>
                            <div class="bg-white text-[#601010] font-bold rounded-2xl mt-15 py-4 w-[85%] text-center">Login
                            </div>
                        </a>

                    @endauth



                </div>
            @endif

        </div>
        @if ($userCount == $home->first()->max_pax && $hasCurrentUser == true)
            <div class="w-full flex justify-center">
                <div
                    class="cursor-pointer shadow-md border-3 border-putih bg-[#88A825] py-4 rounded-2xl flex items-center justify-center gap-2 md:w-[30%] w-[80%] hover:scale-[1.03] duration-100 transition-all">
                    <div class="title text-white font-popReg font-semibold text-xl">
                        Gabung Grup WA Buddies
                    </div>
                    <div class="image">
                        <img class="w-8 h-8" src="{{ asset('assets/wa.png') }}" alt="">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
