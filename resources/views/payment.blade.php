<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @php
        $transaction = 2000000;
        $discount = 0;
        $splitBill = 4;
        $total = ($transaction - $discount) / $splitBill;
    @endphp
    <a href="{{ url()->previous() }}" class="absolute top-6 left-10 text-[#570807] text-2xl font-bold z-50 items-center">
        <image src="{{ asset('image/Back Button.png') }}" alt="Back" class="w-15 h-15 inline-block ">
            Back
    </a>
    <div class="min-h-screen bg-[#f4f3e6] justify-center">
        <div class="flex-row justify-center items-center ">
            <div class="flex flex-row p-10 gap-4 w-[100%] h-[45%]">
                <div class="w-[100%] h-[100%] p-7 pb-3">
                    <div class="inline-flex h-[30%] w-[100%] gap-4 mt-5">
                        <button
                            class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[100px] flex items-center justify-center gap-4 p-4">
                            <div class="relative">
                                <div class="flex justify-center items-center text-white">
                                    <img src="{{ asset('image/MasterCard.png') }}" alt="foto"
                                        class="w-[90px] h-auto object-contain"
                                        onclick="showpaymentdetail('MasterCard')">
                                </div>
                            </div>
                        </button>
                        <button
                            class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[100px] flex items-center justify-center gap-4 p-4">
                            <div class="relative">
                                <div class="flex justify-center items-center  text-white">
                                    <img src="{{ asset('image/Qris.png') }}" alt="foto"
                                        class="w-full h-full object-contain" onclick="showpaymentdetail('Qris')">
                                </div>
                            </div>
                        </button>
                        <button
                            class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[100px] flex items-center justify-center gap-4 p-4">
                            <div class="relative">
                                <div class="flex justify-center items-center  text-white">
                                    <img src="{{ asset('image/Visa.png') }}" alt="foto"
                                        class="w-full h-full object-contain" onclick="showpaymentdetail('Visa')">
                                </div>
                            </div>
                        </button>
                        <button
                            class="bg-white rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[100px] flex items-center justify-center gap-4 p-4">
                            <div class=" relative">
                                <div class="flex justify-center items-center  text-white">
                                    <img src="{{ asset('image/Paypal.png') }}" alt="foto"
                                        class="w-[250px] h-auto object-contain" onclick="showpaymentdetail('Paypal')">
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="bg-white w-[100%] h-[100%] p-5 rounded-xl mt-10 justify-center flex-row items-center">
                        <h1 class="text-2xl font-bold flex justify-center">Pmebayaran dengan Master Card</h1>
                        <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex items-center">
                            <input type="text" placeholder="Card Number" class="p-4 w-[100%] h-[100%] rounded-xl">
                        </div>
                        <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex items-center">
                            <input type="text" placeholder="Card Number" class="p-4 w-[100%] h-[100%] rounded-xl">
                        </div>
                        <div class="inline-flex w-[100%] h-[25%] gap-4">
                            <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                                <input type="date" placeholder="Expiration Date"
                                    class="p-4 w-[100%] h-[100%] rounded-xl">
                            </div>
                            <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                                <input type="number" placeholder="CVV" class="p-4 w-[100%] h-[100%] rounded-xl">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-[100%] w-[100%] ">
                    <div
                        class="bg-[#f4f3e6] rounded-xl mx-auto max-w-screen-xl w-[100%] relative h-[100%] gap-4 flex justify-center items-center ">
                        <div
                            class="bg-white w-[90%] h-[490px] p-7 rounded-xl mx-auto justify-center flex-col items-center ">
                            <div class="flex justify-start items-center w-[100%]">
                                <h1 class="text-[#570807] text-3xl font-bold text-left">Detail Transaksi</h1>
                            </div>
                            <div
                                class="outline-2 w-[100%] h-[40%] mt-6 rounded-xl outline-[#570807] shadow-[4px_4px_12px_rgba(0,0,0,0.7)] p-4 justify-center text-center items-center flex-row my-auto">
                                <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                    <h1 class="text-[#570807] text-2xl font-bold italic">Transaction</h1>
                                    <h1 class="text-[#570807] text-2xl font-bold">Rp.
                                        {{ number_format($transaction, 2, ',', '.') }}</h1>
                                </div>
                                <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                    <h1 class="text-[#570807] text-2xl font-bold italic">Discount</h1>
                                    <h1 class="text-[#570807] text-2xl font-bold">Rp.
                                        {{ number_format($discount, 0, ',', '.') }}</h1>
                                </div>
                                <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                    <h1 class="text-[#570807] text-2xl font-bold italic">Split Bill</h1>
                                    <h1 class="text-[#570807] text-2xl font-bold">{{ $splitBill }} Orang</h1>
                                </div>
                            </div>

                            <hr class="border-t border-black mt-10 mb-5 w-[80%] justify-centeer mx-auto" />

                            <div class="flex justify-between items-center w-[100%] mt-2 mb-2">
                                <h1 class="text-[#570807] text-2xl font-bold italic">Total</h1>
                                <h1 class="text-[#570807] text-2xl font-bold">Rp.
                                    {{ number_format($total, 2, ',', '.') }}</h1>
                            </div>
                            <button class="w-[80%] h-[10%] mt-10 justify-center items-center flex mx-auto">
                                <h1
                                    class=" bg-[#ff5f1f] text-[#570807] text-2xl font-bold w-[100%] p-6 pl-15 pr-15 rounded-4xl shadow-[4px_4px_12px_rgba(0,0,0,0.7)]">
                                    Payment</h1>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" bg-white p-4 ml-17 mr-18 h-[170px] rounded-xl shadow-[4px_4px_12px_rgba(0,0,0,0.7)]">
                <div class="h-[100%] w-[100%] bg-grey rounded-xl border-2 flex flex-row">
                    {{-- Gambar --}}
                    <div class="h-[100%] w-[20%] border-1 flex flex-row justify-center items-center">
                        <img id="mainImage" src="{{ asset('image/Gambar1.png') }}" alt="Deskripsi Gambar"
                            class="object-cover w-[75%] h-full rounded-xl border-1">

                        <div class="flex flex-col gap-2 ml-2">
                            <img src="{{ asset('image/Gambar1.png') }}" alt="Gambar 1"
                                class="w-[100%] h-[35px] object-cover cursor-pointer"
                                onclick="changeImage('{{ asset('image/Gambar1.png') }}')">
                            <img src="{{ asset('image/Gambar2.png') }}" alt="Gambar 2"
                                class="w-[100%] h-[35px] object-cover cursor-pointer"
                                onclick="changeImage('{{ asset('image/Gambar2.png') }}')">
                            <img src="{{ asset('image/Gambar3.png') }}" alt="Gambar 3"
                                class="w-[100%] h-[35px] object-cover cursor-pointer"
                                onclick="changeImage('{{ asset('image/Gambar3.png') }}')">
                        </div>
                    </div>
                    <div class="h-[100%] w-[20%] border-1 flex justify-center flex-col p-2">
                        <h1 class="text-[#570807] text-xl font-bold">KOS BU HANI - 0.5 km</h1>
                        <h1 class="text-grey-200">Rating / Bintang / Jarak</h1>
                        <h1 class="text-grey-200">Alamat</h1>
                        <h1>Mulai dari</h1>
                        <h1 class="text-red-200 text-xl font-bold">Harga</h1>
                    </div>
                    <div class="h-[100%] w-[60%] border-1">
                        <div class="h-[20%] w-[100%] border-1 flex justify-center">
                            <h1 class="text-[#570807] text-xl ">Fasilitas</h1>
                        </div>
                        <div class="h-[80%] w-[100%] border-1 flex flex-row justify-center items-center">
                            <div class="h-[100%] w-[25%] border-1 flex justify-center items-center flex-col">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                            </div>
                            <div class="h-[100%] w-[25%] border-1 flex justify-center items-center flex-col">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                            </div>
                            <div class="h-[100%] w-[25%] border-1 flex justify-center items-center flex-col">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                            </div>
                            <div class="h-[100%] w-[25%] border-1 flex justify-center items-center flex-col">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                                <img src="{{ asset('image/AC.png') }}" alt="AC"
                                    class="w-[50px] h-[50px] object-cover">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(thumbnail) {
            document.getElementById('mainImage').src = thumbnail;
        }
    </script>
</body>

</html>
