@extends('layouts.app')
@section('title', 'Card')
@section('content')
    <div id="popupCon"
        class="min-h-screen position-absolute top-0 z-30 bg-[rgba(0,0,0,0.4)] flex items-center justify-center">
        <div class="bg-[#f4f3e6] px-6 pb-7 pt-7  rounded-3xl w-[95%] max-w-screen-xl relative h-[70%]">

            <button id="closePopup" class="closeBtn top-8 right-10 text-xl absolute cursor-pointer">
                <img src="{{ asset('assets/closeX.png') }}" alt="" class="w-10 h-10">
                {{-- <i class="fas fa-times"></i> --}}
            </button>
            <!-- Header -->
            <div class=" w-[80%] relative flex gap-80 pb-5">
                <div class="img">
                    <img class="w-30 h-15" src="{{ asset('assets/LogoShadow.png') }}" alt="">
                </div>
                <div class="flex justify-center items-center  text-white px-6 py-2">
                    <h2 class="wlTitle text-4xl font-bold text-center text-maroon">USER AGREEMENT</h2>
                </div>

            </div>

            <!-- Card List -->
            <div id="listCardUser"
                class="flex overflow-x-auto space-x-4 py-4 justify-center bg-white h-[500px] rounded-2xl">
                <div class="w-full px-6 py-4 overflow-y-auto text-justify" style="max-height: 480px;">
                    <h2 class="text-xl font-bold text-center mb-4">Syarat dan Ketentuan Program Stay Buddy</h2>

                    <p>
                        Dengan ini, pengguna yang ingin bergabung dalam program <strong>Stay Buddy</strong> menyatakan telah
                        membaca, memahami, dan menyetujui seluruh syarat dan ketentuan berikut:
                    </p>

                    <ol class="list-decimal pl-5 mt-4 space-y-2">
                        <li>
                            Pengguna wajib mengisi data pribadi dan preferensi secara jujur, akurat, dan lengkap, sesuai
                            dengan kondisi sebenarnya.
                        </li>
                        <li>
                            Pengguna menyadari bahwa sistem akan mencocokkan preferensi berdasarkan algoritma kecocokan dan
                            keputusan akhir bergantung pada hasil tersebut.
                        </li>
                        <li>
                            Pengguna tidak diperkenankan melakukan tindakan diskriminatif, ofensif, atau merugikan pengguna
                            lain selama masa tinggal bersama.
                        </li>
                        <li>
                            Setiap transaksi atau biaya yang muncul sebagai bagian dari program ini wajib diselesaikan
                            sesuai dengan metode dan tenggat yang ditentukan oleh penyelenggara.
                        </li>
                        <li>
                            Apabila terjadi perselisihan antar pengguna selama masa tinggal, penyelenggara berhak melakukan
                            evaluasi dan mengambil tindakan tegas sesuai kebijakan yang berlaku.
                        </li>
                        <li>
                            Privasi dan data pengguna akan dijaga sesuai dengan kebijakan perlindungan data yang berlaku dan
                            tidak akan dibagikan kepada pihak ketiga tanpa persetujuan.
                        </li>
                        <li>
                            Pengguna berhak mengajukan pembatalan partisipasi dengan menyampaikan pemberitahuan maksimal 3
                            (tiga) hari sebelum tanggal keberangkatan yang dijadwalkan.
                        </li>
                        <li>
                            Dengan menekan tombol “Gabung Stay Buddy”, pengguna menyatakan telah membaca dan menyetujui
                            seluruh ketentuan di atas tanpa paksaan dari pihak mana pun.
                        </li>
                    </ol>

                    <p class="mt-6 text-sm italic text-gray-600">
                        Dokumen ini dapat diperbarui sewaktu-waktu oleh penyelenggara tanpa pemberitahuan sebelumnya.
                        Pengguna disarankan untuk memeriksa kembali sebelum melanjutkan pendaftaran.
                    </p>
                </div>
            </div>

            <div class="checkb py-4 flex items-center gap-3">
                <input type="checkbox" name="agree" id="agree" class="scale-[1.2]">
                <label for="agree" class="font-popReg">Saya telah membaca dan menyetujui ketentuan yang berlaku</label>
            </div>
            <div class="w-full text-center">
                <button type="button" id="joinBtn"
                    class="bg-[#601010] text-white font-popReg hover:scale-[1.01] transition-all duration-100 rounded-3xl shadow-[3px_4px_6px_rgba(0,0,0,0.3)] p-4 w-[300px] justify-center border-4 border-yellow-400 items-center cursor-pointer hover:scale-105 transition">


                    Join Buddies
                </button>
            </div>
        </div>
    </div>
@endsection
