<style>
    @media (max-width: 768px) {
        .profile {
            justify-content: space-between;
            /* default: kiri */
            align-items: center;
            /* default: atas */
        }

        .sidebar {
            display: none;
        }
    }
</style>
<div
    class="sidebar fixed top-0 left-0 w-full md:w-[414px] bg-krem px-5 py-8 h-screen md:min-h-screen flex flex-col justify-between z-[30]">
    <div class="h-[630px] flex flex-col justify-between">
        <div>
            <div class="profile flex flex-row items-center gap-5">
                <div class="img hidden md:block">
                    <img class="rounded-full w-[80px] h-[80px]" src="{{ asset('assets/profile.png') }}" alt="">
                </div>
                <div class="username flex flex-col gap-2 ml-5 md:ml-0">
                    <p class="text-[17px] text-abu">Selamat datang kembali</p>
                    <h2 class="text-2xl font-popB text-maroon">{{ Auth::user()->name }}</h2>
                </div>
                <div class="close md:hidden">
                    <img class="w-8 h-8 mr-4" src="{{ asset('assets/closeX.png') }}" alt="">
                </div>
            </div>
            <div class="upperNav ms-1 mt-15 font-popReg ">
                <div class="up flex flex-col gap-5">
                    <div id="load-profile"
                        class="profileDetail flex items-center justify-between active-bar hover:bg-putih ps-5 py-0.5 rounded-xl hover:cursor-pointer">
                        <div class="flex gap-4 items-center">
                            <ion-icon class="text-abu text-[27px] font-bold" name="person-outline"></ion-icon>
                            <p id="prof" class="text-[18px] ">Profil</p>
                        </div>

                        <img class="w-[60px]" src="{{ asset('assets/iconNext.png') }}" alt="">

                    </div>
                    <div id="load-preference"
                        class="preferences flex items-center justify-between ps-5 py-0.5 rounded-xl hover:bg-putih hover:cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <ion-icon class="text-abu text-[35px] font-bold" name="cog-outline"></ion-icon>
                            <p id="pref" class="text-[18px] ">Preferensi</p>
                        </div>

                        <img class="w-[60px]" src="{{ asset('assets/iconNext.png') }}" alt="">

                    </div>
                    <div id="load-history"
                        class="history flex items-center justify-between ps-5 py-0.5 rounded-xl hover:bg-putih hover:cursor-pointer">
                        <div class="flex gap-4 items-center">
                            <ion-icon class="text-abu text-[30px] font-bold" name="arrow-undo-outline"></ion-icon>
                            <p id="his" class="text-[18px]">Transaksi</p>
                        </div>

                        <img class="w-[60px]" src="{{ asset('assets/iconNext.png') }}" alt="">

                    </div>
                </div>
            </div>
        </div>
        <div class="bottom ms-1 font-popReg">
            <a href="{{ route('searchPage') }}" class="map flex gap-4 items-center hover:bg-putih ps-5 py-4 rounded-xl">

                <ion-icon class="text-[30px] text-maroon" name="map-outline"></ion-icon>
                <p class="text-[18px]">Maps</p>



            </a>
        </div>

    </div>




    <div class="bottomNav ms-1 mt-4">
        <div class="h-[1px] w-full bg-maroon md:mb-8 mb-4 mt-3 md:mt-0"></div>
        <form method="POST" action="{{ route('logout') }}" class="signOut ps-5 py-4 hover:bg-putih rounded-xl">
            @csrf
            <button type="submit " class="flex gap-4 items-center   font-popReg hover:cursor-pointer">
                <ion-icon class="text-[30px] text-maroon" name="log-out-outline"></ion-icon>
                <p class="text-[18px]">Sign Out</p>
            </button>
        </form>
    </div>

</div>
