<style>
    #payCon::-webkit-scrollbar {
        display: none;
    }

    #payCon {
        -ms-overflow-style: none;
        /* IE & Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<div id="popupCon"
    class="min-h-screen position-absolute top-0 z-30 bg-[rgba(0,0,0,0.4)] flex items-center justify-center">
    @php

        // $maxPax = $waitingList->homestay->max_pax;

        \Carbon\Carbon::setLocale('id');
        $startDate = \Carbon\Carbon::parse($data->waitingList->created_at);

        if ($data->waitingList->homestay->duration == 'Bulanan') {
            $endDate = $startDate->copy()->addMonth();
        } elseif ($data->waitingList->homestay->duration == 'Tahunan') {
            $endDate = $startDate->copy()->addYear();
        } else {
            $endDate = $startDate;
        }

        $startformatted = $startDate->translatedFormat('d F Y'); // Contoh: 18 Juli 2022
        $endformatted = $endDate->translatedFormat('d F Y');
        // dd($waitingList->paymentForUser->payment_id);
        // $transaction = 2000000;
        $discount = 0;
        // $splitBill = 4;
        // $total = ($transaction - $discount) / $splitBill;
    @endphp


    <form action="{{ route('payment.confirm') }}" method="POST" class="flex justify-center items-center">
        {{-- <form action="{{ route('payment.confirm') }}" method="POST"> --}}
        @csrf
        <div class="md:w-[80%] w-[95%] h-[700px] bg-[#f4f3e6] justify-center rounded-2xl">

            <div class="flex flex-col justify-center items-center relative ">
                <div id="payCon"
                    class="flex flex-col md:flex-row px-10 pt-5 md:pt-10 pb-2 gap-4 w-[100%] md:h-[45%] overflow-auto h-[630px] md:mt-0 mt-7">
                    <button id="closePopup"
                        class="closeBtn top-5 right-5 md:top-18 md:right-18 text-xl absolute cursor-pointer z-[20]">
                        <img src="{{ asset('assets/closeX.png') }}" alt="" class="w-6 h-6">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>

                    <div class="flex flex-col ">
                        <div class="w-[100%] h-[100%] pt-0 pb-3">
                            <div class="inline-flex w-[100%] gap-4">
                                <button id="method-MasterCard"
                                    class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[80px] flex items-center justify-center gap-4">
                                    <div class="relative">
                                        <div class="flex justify-center items-center text-white">
                                            <img src="{{ asset('image/MasterCard.png') }}" alt="foto"
                                                class="w-[90px] h-auto object-contain">
                                        </div>
                                    </div>
                                </button>
                                <button id="method-Qris"
                                    class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[80px] flex items-center justify-center gap-4">
                                    <div class="relative">
                                        <div class="flex justify-center items-center  text-white">
                                            <img src="{{ asset('image/Qris.png') }}" alt="foto"
                                                class="w-[90px] h-full object-contain">
                                        </div>
                                    </div>
                                </button>
                                <button id="method-Visa"
                                    class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[80px] flex items-center justify-center gap-4">
                                    <div class="relative">
                                        <div class="flex justify-center items-center  text-white">
                                            <img src="{{ asset('image/Visa.png') }}" alt="foto"
                                                class="w-[90px] h-full object-contain">
                                        </div>
                                    </div>
                                </button>
                                <button id="method-Paypal"
                                    class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[80px] flex items-center justify-center gap-4">
                                    <div class=" relative">
                                        <div class="flex justify-center items-center  text-white">
                                            <img src="{{ asset('image/Paypal.png') }}" alt="foto"
                                                class="w-[250px] h-auto object-contain">
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="formPay"
                                class="bg-white w-[100%] p-5 rounded-xl mt-5 justify-center flex-row items-center">
                                <h1 id="payTitle" class="text-2xl font-bold flex justify-center">Pembayaran dengan
                                    Master Card
                                </h1>
                                <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex items-center">
                                    <input type="text" placeholder="Card Number"
                                        class="p-4 w-[100%] h-[100%] rounded-xl">
                                </div>
                                <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex sitems-center">
                                    <input type="text" placeholder="Card Number"
                                        class="p-4 w-[100%] h-[100%] rounded-xl">
                                </div>
                                <div class="inline-flex w-[100%] h-[25%] gap-4">
                                    <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                                        <input type="date" placeholder="Expiration Date"
                                            class="p-4 w-[100%] h-[100%] rounded-xl">
                                    </div>
                                    <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                                        <input type="text" placeholder="CVV"
                                            class="p-4 w-[100%] h-[100%] rounded-xl">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" bg-white mt-2 md:h-[170px] h-fit rounded-xl w-[100%] ">
                            <div
                                class="h-[100%] w-[100%] bg-grey rounded-xl border-2 flex md:flex-row flex-col p-4 gap-5">
                                {{-- Gambar --}}
                                <div class="h-[100%] md:w-[30%] w-full flex flex-row justify-center items-center">
                                    <img id="mainImage" src="{{ asset($data->waitingList->homestay->main_images) }}"
                                        alt="Deskripsi Gambar" class="object-cover w-100 h-full">
                                </div>

                                <div class="h-[100%] md:w-[70%] w-full flex justify-center flex-row p-2 gap-2">
                                    <div class="flex flex-col w-[60%]">

                                        <h1 class="text-[#570807] text-xl font-bold">
                                            {{ $data->waitingList->homestay->name }}</h1>
                                        <h1 class="text-grey-200 text-[15px]">
                                            {{ $data->waitingList->homestay->alamat }}
                                        </h1>
                                    </div>
                                    <div class="flex flex-col w-[40%] gap-2">
                                        <div class="flex flex-col">
                                            <p class="text-sm text-gray-600">Awal Sewa</p>
                                            <h3 class="text-l font-semibold ">{{ $startformatted }}</h3>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-sm text-gray-600">Akhir Sewa
                                                ({{ $data->waitingList->homestay->duration }})</p>
                                            <h3 class="text-l font-semibold">{{ $endformatted }}
                                            </h3>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="h-[600px] w-[100%] ">
                        <div
                            class="bg-[#f4f3e6] rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-full gap-4 flex justify-center items-center ">
                            <div
                                class="bg-white w-[100%] h-full p-7 rounded-xl mx-auto flex flex-col items-center justify-between ">
                                <div class="flex justify-start items-center w-[100%]">
                                    <h1 class="text-[#570807] text-2xl md:text-4xl mb-4 font-bold text-left">Detail
                                        Transaksi</h1>
                                </div>
                                <div
                                    class="outline-2 w-[100%] h-fit mt-6 rounded-xl outline-[#570807] shadow-xl p-4 justify-center text-center items-center flex-row my-auto">
                                    <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                        <h1 class="text-[#570807] md:text-xl text-md font-bold italic">Transaksi</h1>
                                        <h1 class="text-[#570807] md:text-xl text-md font-bold">Rp.
                                            {{ $data->waitingList->homestay->price }}.000.000</h1>
                                    </div>
                                    <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                        <h1 class="text-[#570807] md:text-xl text-md font-bold italic">Diskon</h1>
                                        <h1 class="text-[#570807] md:text-xl text-md font-bold">Rp.
                                            {{ number_format($discount, 0, ',', '.') }}</h1>
                                    </div>
                                    <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                        <h1 class="text-[#570807] md:text-xl text-md font-bold italic">Bayar per orang
                                        </h1>
                                        <h1 class="text-[#940f0d] md:text-xl text-md font-bold">
                                            Rp{{ number_format($data->price * 1000000, 0, ',', '.') }} per
                                            pax
                                        </h1>
                                    </div>
                                </div>



                                <div class="flex justify-between items-center w-[100%] md:mt-6 mt-3 md:mb-2 mb-5">
                                    <h1 class="text-[#570807] text-xl font-bold italic">Total</h1>
                                    <h1 class="text-[#570807] text-xl font-bold">Rp.
                                        {{ $data->price }}.000.000</h1>
                                </div>
                                <input type="hidden" name="payment_id" value="{{ $data->payment_id }}">
                                <input type="hidden" name="payment_method" id="selectedMethod" value="MasterCard">
                                <button type="submit"
                                    class="md:w-[65%] w-[80%] h-[10%] mt-10 justify-center items-center flex mx-auto hover:scale-[1.02] transition-all duration-100">
                                    <h1
                                        class=" bg-[#ff5f1f] text-putih md:text-xl text-[17px] font-bold w-[100%] py-5 rounded-4xl shadow-md cursor-pointer hover:sc">
                                        Konfirmasi Pembayaran</h1>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>


</div>
