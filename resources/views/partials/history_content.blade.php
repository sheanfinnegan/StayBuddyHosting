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

<div id="popupDetail" class="fixed inset-0 position-absolute top-0 z-[100] hidden">
    {{-- @include('popup.rmdetailpopup') --}}
</div>
<div class="title pt-10 pb-6.5 ms-12 flex  md:gap-0 md:block">
    <h1 class="font-popReg font-semibold text-3xl text-[#333333]">Transaksi Anda</h1>
    <div id="dropDownNav" class="md:hidden">
        <img class="w-10 h-8 mr-12" src="{{ asset('assets/Dropdown.png') }}" alt="">
    </div>
</div>
<div class="line h-[1px] bg-maroon"></div>
<div class="content ms-12 mr-12 md:mr-0 mt-10 flex gap-12">
    {{-- nanti diganti for each --}}
    {{-- @for ($i = 0; $i < 4; $i++) --}}
    @if ($waitingLists->isEmpty())
        <h1 class="text-maroon text-3xl font-popB">Belum ada transaksi</h1>
    @else
        @foreach ($waitingLists as $waitingList)
            @php

                $userCount = $waitingList->users->count();
                $maxPax = $waitingList->homestay->max_pax;
                $paidCount = $waitingList->payment->where('paid', true)->count();

                // Ambil payment user login
                $myPayment = $waitingList->paymentForUser;

                \Carbon\Carbon::setLocale('id');
                $startDate = \Carbon\Carbon::parse($waitingList->created_at);

                if ($waitingList->homestay->duration == 'Bulanan') {
                    $endDate = $startDate->copy()->addMonth();
                } elseif ($waitingList->homestay->duration == 'Tahunan') {
                    $endDate = $startDate->copy()->addYear();
                } else {
                    $endDate = $startDate;
                }

                $startformatted = $startDate->translatedFormat('d F Y'); // Contoh: 18 Juli 2022
                $endformatted = $endDate->translatedFormat('d F Y');
                // dd($waitingList->paymentForUser->payment_id);
            @endphp
            <div
                class="flex md:flex-row flex-col border-2 border-maroon rounded-xl p-4 shadow-xl bg-white hover:scale-[1.02] transition-all duration-100 cursor-pointer md:w-[60%] w-full">
                {{-- <div class="flex border-2 border-maroon rounded-xl p-4 shadow-md bg-white"> --}}
                <img src="{{ asset($waitingList->homestay->main_images) }}" alt="Kos"
                    class="md:w-50 md:mb-0 mb-3 w-full h-full  object-cover rounded-md mr-4 mt-1">
                <div class="flex flex-col w-full h-full gap-y-1">
                    <h2 class="text-xl font-semibold text-[#651B1B]">{{ $waitingList->homestay->name }}</h2>
                    <p class="text-sm text-gray-600 flex items-center ">
                        <span class="text-yellow-500 mr-1">{{ $waitingList->homestay->rating }}</span>
                        <x-star-rating :rating="$waitingList->homestay->rating" />
                    </p>
                    <p class="text-sm text-gray-600">{{ $waitingList->homestay->alamat }}</p>

                    <div class="flex flex-col h-[70%] w-full mt-3 md:gap-y-3 gap-y-5">
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col w-[50%]">
                                <p class="text-sm text-gray-600">Awal Sewa</p>
                                <h3 class="text-l font-semibold ">{{ $startformatted }}</h3>
                            </div>
                            <div class="flex flex-col w-[50%]">
                                <p class="text-sm text-gray-600">Akhir Rent ({{ $waitingList->homestay->duration }})</p>
                                <h3 class="text-l font-semibold">{{ $endformatted }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col w-[50%]">
                                <p class="text-sm text-gray-600">Info Pembayaran</p>
                                @if ($myPayment->paid == 0)
                                    @if ($userCount < $maxPax)
                                        <h3 class="text-l font-semibold ">Menunggu buddies lain</h3>
                                    @else
                                        <h3 class="text-l font-semibold ">Lakukan pembayaran</h3>
                                    @endif
                                @else
                                    <h3 class="text-l font-semibold text-maroon">Selesai
                                        ({{ $paidCount . '/' . $waitingList->homestay->max_pax }})
                                    </h3>
                                @endif


                            </div>
                            <div class="flex flex-col w-[50%]">
                                <p class="text-sm text-gray-600">Harga / pax</p>
                                <h3 class="text-l font-semibold">
                                    {{ $waitingList->paymentForUser->price }} Juta</h3>
                            </div>
                        </div>

                        @if ($myPayment->paid == 0)
                            @if ($userCount == $maxPax)
                                <div class="flex items-center gap-4 pr-2">
                                    <form action="{{ route('payment.cancel') }}" method="POST"
                                        class="w-[50%]  text-right">
                                        @csrf
                                        <input type="hidden" name="payment_id"
                                            value="{{ $waitingList->paymentForUser->payment_id }}">

                                        <button type="submit"
                                            class="cancelWL text-md text-abu font-popReg rounded-2xl text-right py-2 hover:text-maroon hover:underline cursor-pointer">
                                            cancel
                                        </button>
                                    </form>

                                    <div data-wlid = "{{ $waitingList->paymentForUser->payment_id }}"
                                        class="pay-now w-[55%] text-md text-white font-popReg rounded-2xl bg-[#88A825] text-center py-2 px-3">
                                        Bayar sekarang
                                    </div>

                                </div>
                            @endif
                        @endif



                    </div>

                </div>
            </div>
        @endforeach
    @endif
    {{-- @endfor --}}


</div>
