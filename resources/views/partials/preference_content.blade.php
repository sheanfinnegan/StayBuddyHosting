<style>
    @media (max-width: 768px) {
        .title {
            justify-content: space-between;
            /* default: kiri */
            align-items: center;
            /* default: atas */
        }
    }
</style>
<div class="title pt-10 pb-6.5 ms-12 flex  md:gap-0 md:block">
    <h1 class="font-popReg font-semibold text-3xl text-[#333333]">Preferensi Anda</h1>
    <div id="dropDownNav" class="md:hidden">
        <img class="w-10 h-8 mr-12" src="{{ asset('assets/Dropdown.png') }}" alt="">
    </div>
</div>
<div class="line h-[1px] bg-maroon"></div>
<div class="content ms-12 mr-12 md:mr-0 mt-10 flex md:flex-row flex-col gap-[20px]">
    <div class="left flex flex-col gap-7 md:gap-[60px] md:w-[33%] w-full md:mb-0 mb-2">
        <div class="smoking flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">


                    <ion-icon class="text-[50px] text-maroon" name="logo-no-smoking"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Toleransi merokok</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->smoking }}</h1>
            </div>
        </div>
        <div class="alcoholic flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                    <ion-icon class="text-[45px] text-kuning" name="beer-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">

                <h1 class="font-popReg font-bold pb-1">Toleransi Alcoholic</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->alcoholic }}</h1>

            </div>
        </div>
        <div class="tidiness flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                    <ion-icon class="text-[40px] text-merah" name="trash-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-3">Kerapihan</h1>
                <div class="flex gap-0.5">
                    <!-- Bar 1 (active) -->
                    @for ($i = 1; $i <= 5; $i++)
                        <div
                            class="w-8 h-3 {{ $i <= $preference->tidiness ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                        </div>
                    @endfor
                </div>

            </div>
        </div>
        <div class="age flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                    <ion-icon class="text-[35px] text-oranye" name="people-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">

                <h1 class="font-popReg font-bold pb-1">Preferensi umur</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->prefered_age }}</h1>

            </div>
        </div>

    </div>

    <div class="mid flex flex-col gap-7 md:gap-[55px] md:w-[33%] w-full md:mb-0 mb-2">
        <div class="dailyRoutine flex items-center gap-6">
            <div class="img ">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">

                    <ion-icon class="text-[35px] text-maroon" name="sunny-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Tipe Kegiatan Daily</h1>
                <h1 class="font-popReg text-[#797979] text-[15px]">{{ $preference->routine_type }}</h1>
            </div>
        </div>
        <div class="room flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                    <ion-icon class="text-[40px] text-kuning" name="bed-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Tipe kamar</h1>
                <h1 class="font-popReg text-[#797979] text-[15px]">{{ $preference->room_type }}</h1>
            </div>
        </div>
        <div class="socializing flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                    <ion-icon class="text-[35px] text-merah" name="accessibility-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-3">Tingkat sosialisasi</h1>
                <div class="flex gap-0.5">
                    <!-- Bar 1 (active) -->
                    @for ($i = 1; $i <= 5; $i++)
                        <div
                            class="w-8 h-3 {{ $i <= $preference->socializing ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="cooking flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                    <ion-icon class="text-[35px] text-oranye" name="restaurant-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-3">Frekuensi Masak</h1>
                <div class="flex gap-0.5">
                    <!-- Bar 1 (active) -->
                    @for ($i = 1; $i <= 5; $i++)
                        <div
                            class="w-8 h-3 {{ $i <= $preference->cooking_freq ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                        </div>
                    @endfor
                </div>
            </div>
        </div>

    </div>

    <div class="right flex flex-col gap-7 md:gap-[60px] md:w-[33%] w-full md:mb-0 mb-2">
        <div class="petFriendly flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(202,143,143,0.4)] border border-maroon">
                    <ion-icon class="text-[35px] text-maroon" name="thermometer-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Suhu ruangan</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->room_temperature }}</h1>
            </div>
        </div>
        <div class="workStyle flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(248,169,31,0.4)] border border-kuning">
                    <ion-icon class="text-[40px] text-kuning" name="briefcase-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Tipe bekerja/belajar</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->work_type }}</h1>
            </div>
        </div>
        <div class="noise flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(214,35,0,0.4)] border border-merah">
                    <ion-icon class="text-[40px] text-merah" name="ear-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-3">Toleransi Kebisingan</h1>
                <div class="flex gap-0.5">
                    <!-- Bar 1 (active) -->
                    @for ($i = 1; $i <= 5; $i++)
                        <div
                            class="w-8 h-3 {{ $i <= $preference->noise_tolerance ? 'bg-[#88A825]' : 'bg-[rgba(98,98,98,0.28)]' }} rounded-full">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="gender flex items-center gap-6">
            <div class="img">
                <div
                    class="w-18 h-18 flex items-center justify-center rounded-full bg-[rgba(255,95,31,0.4)] border border-oranye">
                    <ion-icon class="text-[40px] text-oranye" name="male-female-outline"></ion-icon>
                </div>
            </div>
            <div class="info text-[19px]">
                <h1 class="font-popReg font-bold pb-1">Genre Musik</h1>
                <h1 class="font-popReg text-[#797979]">{{ $preference->music_genre }} Music</h1>
            </div>
        </div>
    </div>
</div>
<div class="editCon w-full flex justify-center md:mt-14 md:mb-0">
    <a href="{{ route('questionnaire.show', 1) }}"
        class="mb-7 mt-7 md:mb-0 edit px-5 py-2 bg-[#5E2D2D] font-popReg text-white rounded-sm w-[120px] text-center">
        <button>Ubah</button>
    </a>
</div>
