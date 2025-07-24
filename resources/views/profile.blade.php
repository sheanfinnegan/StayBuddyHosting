@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="outerContainer w-full md:flex">
        @include('components.sidebar')
        <div id="main-content" class="md:ml-[414px] md:w-[72%]">
            @include('partials.profile_content')
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/popup.js') }}"></script>

    <script>
        $(window).on('resize', function() {
            if (window.innerWidth <= 768) {
                $('.sidebar').hide(); // Sembunyikan sidebar di layar kecil
            } else {
                $('.sidebar').show(); // Tampilkan sidebar di layar besar
            }
        });

        let shouldLoadPreference = @json($loadPreference);
        let shouldLoadHistory = @json($loadHistory);

        $(document).ready(function() {
            if (shouldLoadPreference) {
                $('#load-preference').addClass('active-bar');
                $('#load-profile').removeClass('active-bar');
                $('#load-history').removeClass('active-bar');
                $('#prof').removeClass('font-semibold');
                $('#his').removeClass('font-semibold');
                $('#pref').addClass('font-semibold');

                loadContent('{{ route('preference.content') }}');
            } else if (shouldLoadHistory) {
                $('#load-preference').removeClass('active-bar');
                $('#load-profile').removeClass('active-bar');
                $('#load-history').addClass('active-bar');
                $('#prof').removeClass('font-semibold');
                $('#his').addClass('font-semibold');
                $('#pref').removeClass('font-semibold');

                loadContent('{{ route('history.content') }}');
            } else {
                $('#load-profile').addClass('active-bar');
                $('#prof').addClass('font-semibold');
                loadContent('{{ route('profile.content') }}');

            }
        });

        function loadContent(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {

                    $('#main-content').html(response);
                    $('#dropDownNav').on('click', function() {
                        $('.sidebar').slideToggle(300);
                    });
                    $('.close').on('click', function() {
                        if ($('.sidebar').is(':visible')) {
                            $('.sidebar').slideUp(300);
                        }
                    });
                    const popup = document.getElementById("popupDetail");
                    const allPayNowButtons = document.querySelectorAll('.pay-now');
                    console.log(allPayNowButtons);

                    allPayNowButtons.forEach(button => {
                        button.addEventListener("click", async (e) => {


                            const wlid = button.getAttribute("data-wlid");

                            try {
                                const response = await fetch(`/pay/detail/${wlid}`, {
                                    method: "GET",
                                    headers: {
                                        "X-Requested-With": "XMLHttpRequest"
                                    }
                                });

                                if (!response.ok) {
                                    throw new Error("Gagal mengambil data pembayaran");
                                }

                                const html = await response.text();

                                const popup = document.getElementById("popupDetail");
                                popup.innerHTML = html;
                                popup.classList.remove("hidden");
                                // showpaymentdetail('MasterCard');
                                // setTimeout(() => {
                                //     showpaymentdetail('MasterCard');
                                // }, 0);
                                if (typeof window.initShowPayment === "function") {
                                    window.initShowPayment('MasterCard'); // ← di sini
                                }

                                const mcard = document.getElementById('method-MasterCard');
                                const qris = document.getElementById('method-Qris');
                                const visa = document.getElementById('method-Visa');
                                const paypal = document.getElementById('method-Paypal');
                                mcard.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    window.initShowPayment('MasterCard')
                                });
                                qris.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    window.initShowPayment('Qris')
                                });
                                visa.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    window.initShowPayment('Visa')
                                });
                                paypal.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    window.initShowPayment('Paypal')
                                });




                                // Sembunyikan konten utama jika mau
                                // document.querySelector('.content').classList.add("hidden");
                                const closeBtn = document.querySelector("#closePopup");
                                if (closeBtn) {
                                    closeBtn.addEventListener("click", (e) => {
                                        e.stopPropagation();
                                        popup.classList.add("hidden");
                                    });
                                }

                            } catch (err) {
                                alert("Terjadi kesalahan: " + err.message);
                            }
                        });
                    });

                    popup.addEventListener("click", function(e) {
                        // console.log(e.target.id);
                        if (e.target.id == "popupCon") {
                            popup.classList.add("hidden");
                        }
                    });



                    // Optional: hide popup when click outside the box
                    document.addEventListener('click', function(e) {
                        const popupContainer = document.getElementById('popupCon');
                        if (popupContainer && e.target.id === 'popupCon') {
                            popupContainer.classList.add('hidden');
                        }
                    });

                    // document.addEventListener('DOMContentLoaded', function() {

                    // });
                },
                error: function(xhr) {
                    alert('hai.');
                }
            });
        }



        $('#load-profile').on('click', function() {
            if ($('.sidebar').is(':visible') && window.innerWidth < 768) {
                $('.sidebar').slideToggle(300);
            }
            if (!$(this).hasClass('active-bar')) {
                $('#load-preference').removeClass('active-bar');
                $('#load-profile').addClass('active-bar');
                $('#load-history').removeClass('active-bar');
                $('#prof').addClass('font-semibold');
                $('#his').removeClass('font-semibold');
                $('#pref').removeClass('font-semibold');
            }
            loadContent('{{ route('profile.content') }}');
        });

        $('#load-preference').on('click', function() {
            if ($('.sidebar').is(':visible') && window.innerWidth < 768) {
                $('.sidebar').slideToggle(300);
            }
            if (!$(this).hasClass('active-bar')) {
                $('#load-preference').addClass('active-bar');
                $('#load-profile').removeClass('active-bar');
                $('#load-history').removeClass('active-bar');
                $('#prof').removeClass('font-semibold');
                $('#his').removeClass('font-semibold');
                $('#pref').addClass('font-semibold');
            }

            loadContent('{{ route('preference.content') }}');
        });

        $('#load-history').on('click', function() {
            if ($('.sidebar').is(':visible') && window.innerWidth < 768) {
                $('.sidebar').slideToggle(300);
            }
            if (!$(this).hasClass('active-bar')) {
                $('#load-preference').removeClass('active-bar');
                $('#load-profile').removeClass('active-bar');
                $('#load-history').addClass('active-bar');
                $('#prof').removeClass('font-semibold');
                $('#his').addClass('font-semibold');
                $('#pref').removeClass('font-semibold');
            }

            loadContent('{{ route('history.content') }}');

        });

        document.addEventListener('click', function(e) {
            const popupContainer = document.getElementById('popupCon');
            if (popupContainer && e.target.id === 'popupCon') {
                popupContainer.classList.add('hidden');
            }
        });
    </script>



@endsection
