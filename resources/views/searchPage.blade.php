@extends('layouts.app')

@section('title', 'Search Page')

@section('content')
    <style>
        @media (max-width: 768px) {
            #profIcon {
                bottom: 2rem;
                /* default: atas */
            }

        }
    </style>
    <div id="popupDetail" class="fixed inset-0 position-absolute top-0 z-[100] hidden">
        {{-- @include('popup.rmdetailpopup') --}}
    </div>
    <div class="z-[0]" id="map"></div>
    <div class="fullnav md:w-fit w-full md:pr-7 flex justify-between absolute top-0 left-0 z-10">
        <div
            class="nav md:w-fit w-full pl-5 pt-8 pb-7 flex flex-col gap-4 items-center bg-putih shadow-[2px_3px_5px_rgba(0,0,0,0.25)] h-fit ">
            <div class="flex flex-row gap-2 items-center">
                <div class="img-container w-[30%]">
                    <img class="w-[280px]" src="{{ asset('assets/LogoStayBuddy.png') }}" alt="logo">
                </div>
                <div class="flex flex-col gap-[7px] w-[62%]">
                    <div class="search relative">
                        <input type="text"
                            class="text-[14px] bg-white border-2 border-maroon px-3 py-[4.5px] rounded-2xl w-full pr-6"
                            name="search" id="search" placeholder="Cari Lokasi...">
                        <img src="{{ asset('assets/search.png') }}" alt=""
                            class="searchIcon w-[17px] absolute right-4 top-2">
                    </div>

                    <div class="flex flex-row gap-2 items-center w-full">
                        <select name="price" id="price"
                            class="text-[13px] w-[50%] bg-white border-2 border-maroon pl-1 pr-3 py-[3.5px] rounded-2xl">
                            <option value="">Harga</option>
                            <option value="u15">
                                < 15 Juta</option>
                            <option value="b1517">15 - 17 Juta</option>
                            <option value="b1720">17 - 20 Juta</option>
                            <option value="b3050"> 30 - 50 Juta</option>
                            <option value="b50"> > 50 Juta</option>
                        </select>
                        <select name="jenisSewa" id="jenisSewa"
                            class="text-[13px] w-[50%] bg-white border-2 border-maroon pl-1 pr-3 py-[3px] rounded-2xl">
                            <option value="">Durasi</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="w-full text-center hidden dropArrow">
                <button>
                    <img class="dropDown w-[40px]" src="{{ asset('assets/Dropdown.png') }}" alt="">
                </button>
            </div>
        </div>

    </div>
    <div id="profIcon" class="absolute md:top-0 md:right-0 right-5 z-[10] flex items-center md:mr-10 mt-7">
        @auth
            <a href="{{ route('profile') }}">
                <img src="{{ asset('assets/IconLog.png') }}" alt=""
                    class="w-[80px] pt-3 hover:scale-[1.1] transition-all duration-100">
            </a>
        @else
            <a href="{{ route('login') }}">
                <img src="{{ asset('assets/IconLog.png') }}" alt=""
                    class="w-[80px] pt-3 hover:scale-[1.1] transition-all duration-100">
            </a>
        @endauth
    </div>
    {{-- <div class="bg-[url('/public/assets/maps.png')] w-full h-[100vh]  bg-cover bg-center"></div> --}}

    <div class="homeResult hidden absolute md:top-[150px] top-[150px] left-5 md:left-7 z-50 w-fit md:mr-0 mr-5">
        <div class="flex gap-3">
            <h1 class="text-maroon font-popReg text-[25px] pl-1">Hasil</h1>
            <button id="clsDetail"
                class="cursor-pointer bg-maroon hidden md:hidden px-3 text-white font-popReg rounded-2xl text-sm hover:scale-[1.01] duration-100 transition-all">Tutup
                detail</button>

        </div>

        <div
            class="homeList md:w-[450px] w-[fit] flex flex-col gap-3 mt-[7px] md:h-[570px] h-[500px] overflow-y-auto pl-1 pt-[2px] custom-scroll overflow-auto">


        </div>
    </div>

    <div
        class="homeDetail absolute md:top-0 top-[195px] md:left-[37%] left-6 md:h-full h-fit hidden items-center w-fit md:z-20 z-[50] duration-200">


    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/popup.js') }}"></script>


    <script>
        //map
        let result = document.querySelector('.homeResult');
        let dropDown = document.querySelector('.dropDown');

        // Tambahkan zoom control hanya jika layar besar


        const map = L.map('map', {
            center: [-6.2, 106.8166], // Jakarta
            zoom: 15, // Lebih dekat
            zoomControl: false,
            scrollWheelZoom: true,
            touchZoom: 'center' // Dua jari pinch zoom lebih halus
        });

        let zoomCtrl = L.control.zoom({
            position: 'bottomright'
        });
        let zoomAdded = false; // Flag manual

        function updateZoomControl() {
            if (window.innerWidth < 768) {
                if (zoomAdded) {
                    map.removeControl(zoomCtrl);
                    zoomAdded = false;
                }
            } else {
                if (!zoomAdded) {
                    zoomCtrl.addTo(map);
                    zoomAdded = true;
                }
            }
        }

        function updateClsDetail() {
            const clsDetail = document.getElementById('clsDetail');
            let homeDetail = document.querySelector('.homeDetail');
            if (window.innerWidth < 768) {
                if (homeDetail.innerHTML == '') {
                    clsDetail.classList.add('hidden')
                } else {
                    clsDetail.classList.remove('hidden')
                }
            } else {
                clsDetail.classList.remove('hidden')
            }

        }

        // updateZoomControl();
        // updateClsDetail();
        window.addEventListener('resize', updateZoomControl);
        window.addEventListener('resize', updateClsDetail);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var customIcon = L.icon({
            iconUrl: 'assets/iconOrang.png', // path ke icon di folder public
            iconSize: [40, 40],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var lastMarker = null;
        var lastCircle = null;

        let dropArrow = document.querySelector('.dropArrow');
        let nav = document.querySelector('.nav');
        let marker = [];

        map.on('dblclick', function(e) {
            document.getElementById('price').value = "";
            document.getElementById('jenisSewa').value = "";
            let homeDetail = document.querySelector('.homeDetail');
            homeDetail.innerHTML = '';
            // nav.classList.add('h-screen');
            // nav.classList.remove('h-fit');
            // hapus marker dan lingkaran lama kalau ada
            if (dropArrow.classList.contains('hidden')) {
                dropArrow.classList.remove('hidden');
                nav.classList.remove('pb-7');
                nav.classList.add('pb-3');
            }

            if (lastMarker) {
                map.removeLayer(lastMarker);
            }
            if (lastCircle) {
                map.removeLayer(lastCircle);
            }

            if (marker) {
                marker.forEach(m => map.removeLayer(m));
            }
            marker = [];

            // buat marker baru
            lastMarker = L.marker(e.latlng, {
                    icon: customIcon
                })
                .addTo(map)
                .bindPopup('Mencari Homestay Terdekat...', {
                    className: 'custom-popup'
                })
                .openPopup();


            // buat lingkaran merah transparan radius 5000 meter (5 km)
            lastCircle = L.circle(lastMarker.getLatLng(), {
                color: 'red', // warna garis pinggir
                fillColor: 'red', // warna isi
                weight: 1.5, // ketebalan garis pinggir
                fillOpacity: 0.2, // transparansi isi (0 = transparan penuh, 1 = solid)
                radius: 300 // radius dalam meter
            }).addTo(map);

            fetch(`/ajax/search-nearby?lat=${e.latlng.lat}&lng=${e.latlng.lng}&radius=300`)
                .then(res => res.json())
                .then(data => {
                    const results = data.results;
                    fetch('/ajax/store-home-details-click', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            body: JSON.stringify({
                                homes: data.results
                            })
                        })
                        .then(res => res.json())
                        .then(response => {
                            console.log('Berhasil disimpan:', response);
                            // Tampilkan hasil di frontend seperti biasa
                            const homeDetails = response.details;
                            // const avail = 5 - response.data.length;

                            // Buat index detail biar pencarian cepat
                            const detailMap = {};
                            homeDetails.forEach(detail => {
                                detailMap[detail.details.fsq_id] = detail;
                                // console.log(detailMap);
                            });


                            // Gabungkan apiResults dan homeDetails
                            mergedResults = results.map(item => {
                                const detail = detailMap[item.fsq_id];
                                // const maxPax = detail?.details?.max_pax ?? 5;
                                const joinedUsers = detail?.data?.length ?? 0;
                                const avail = 5 - joinedUsers;
                                return {
                                    ...item,
                                    homeDetails: detailMap[item.fsq_id],
                                    avail
                                };
                            });
                            markersLayer
                                .clearLayers(); // hapus marker lama dulu // pastikan results adalah array
                            if (!results || results.length === 0) {
                                resultsContainer.innerHTML = '<p>Tidak ada hasil.</p>';
                                return;
                            }
                            resultsContainer.innerHTML = '';
                            resultsContainer.innerHTML = mergedResults.map(item => {
                                const starRatingHtml = window.renderStarRating(item.homeDetails
                                    .details
                                    .rating);
                                const categoryName = item.categories?.[0]?.name ||
                                    'Kategori tidak diketahui';
                                const photos = item.photos ||
                            []; // asumsi: sudah merge data di backend


                                const imageHtml = photos.length >
                                    0 ?
                                    `<img class="w-full h-[114px] object-fill" src="${photos[0].url}" alt="${item.name}">` :
                                    `<img class="w-full h-fit" src="${item.homeDetails.details.main_images}" alt="Default image">`;

                                return `
        <div data-fsq-id="${item.fsq_id}"
            class="homeCardContainer flex flex-col gap-5 bg-white border-2 md:w-fit max-w-[700px] border-maroon rounded-xl px-4 py-5 shadow-[2px_3px_5px_rgba(0,0,0,0.25)] hover:scale-[1.005] duration-100 hover:cursor-pointer">
            <div class="homeCard flex flex-col gap-2 items-center">
                <div class="homeInfo1 flex gap-[7px] items-center">
                    <div class="homeTitle w-[65%]">
                        <h1 class="text-[22px] font-popReg text-maroon mb-[1px] leading-[1.3]">${item.homeDetails.details.name}</h1>
                        <div class="flex flex-row gap-1 items-center font-popReg text-[14px] text-[rgba(0,0,0,0.35)] mt-1">
                            <p class="rating">${item.homeDetails.details.rating}</p>
                            ${starRatingHtml}
                            <p class="review">(${JSON.parse(item.homeDetails.details.reviews || '[]').length})</p>
                        </div>
                        <p class="text-[12px] font-nunitoBold text-[rgba(0,0,0,0.35)]">${item.location.formatted_address}</p>
                    </div>
                    <div class="homeImage w-[38%]">
                        ${imageHtml}
                    </div>
                </div>
                <div class="homeInfo2 w-full font-nunitoBold text-[12px] text-[rgba(0,0,0,0.35)] flex gap-4 items-center justify-start">
                    <div class="homePrice">${item.homeDetails.details.duration == "Bulanan" ? `Rp. ${item.homeDetails.details.price} Juta /Bulan (${item.homeDetails.details.max_pax} pax)` :  
                            `Rp. ${item.homeDetails.details.price} Juta /Tahun (${item.homeDetails.details.max_pax} pax)`
                            }</div>
                    <div class="homeStatus flex gap-1 items-center">
                        <div class="w-[7px] h-[7px] rounded-full bg-[rgba(0,0,0,0.35)]"></div>
                        <p class="availWL">Tersedia (${item.avail} Waiting List)</p>
                    </div>
                </div>
            </div>
        </div>`;
                            }).join('');
                            marker = [];

                            // Render marker dan results
                            mergedResults.forEach(item => {
                                // Tambah marker ke map
                                const mark = L.marker([item.geocodes.main.latitude, item.geocodes
                                        .main
                                        .longitude
                                    ])
                                    .addTo(map)
                                    .bindPopup(item.name);
                                marker.push(mark);
                            });
                            if (nav.classList.contains('h-fit')) {
                                nav.classList.add('h-screen');
                                nav.classList.remove('h-fit');
                                result.classList.remove('hidden');
                                // result.classList.add('opacity-100');
                                dropDown.src = "{{ asset('assets/Dropup.png') }}";
                            }

                            let listHome = document.querySelectorAll(".homeCardContainer")
                            console.log(listHome)
                            if (dropArrow.classList.contains('hidden')) {
                                dropArrow.classList.remove('hidden');
                                nav.classList.remove('pb-7');
                                nav.classList.add('pb-3');

                            }
                            listHome.forEach(home => {
                                home.addEventListener("click", () => {
                                    let id = home.getAttribute("data-fsq-id");
                                    console.log(id)
                                    let item = mergedResults.find(i => i.fsq_id ===
                                        id);
                                    // console.log(item);
                                    renderHomeDetail(item);
                                })
                            });

                            const priceSelect = document.getElementById('price');
                            const durationSelect = document.getElementById('jenisSewa');

                            priceSelect.addEventListener('change', filterData);
                            durationSelect.addEventListener('change', filterData);

                            function filterData() {
                                let homeDetail = document.querySelector('.homeDetail');
                                homeDetail.innerHTML = '';
                                const priceVal = priceSelect.value;
                                const durationVal = durationSelect.value;
                                console.log(priceVal, durationVal);

                                let filtered = mergedResults;
                                console.log(filtered);

                                // Filter harga
                                if (priceVal) {
                                    switch (priceVal) {
                                        case 'u15':
                                            filtered = filtered.filter(h => h.homeDetails.details.price <
                                                15);
                                            break;
                                        case 'b1517':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                15 && h.homeDetails.details.price <= 17);
                                            break;
                                        case 'b1720':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                17 && h.homeDetails.details.price <= 20);
                                            break;
                                        case 'b3050':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                30 && h.homeDetails.details.price <= 50);
                                            break;
                                        case 'b50':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >
                                                50);
                                            break;
                                    }
                                }

                                // Filter durasi
                                if (durationVal) {
                                    filtered = filtered.filter(h => h.homeDetails.details.duration
                                        .toLowerCase() ===
                                        durationVal);
                                }

                                // Render hasil
                                renderHomesClick(resultsContainer, filtered);
                            }
                        });


                })
                .catch(err => {
                    lastMarker.getPopup().setContent('Gagal mencari tempat').openOn(map);
                    resultsContainer.innerHTML = '<p>Gagal memuat data.</p>';
                });



        });

        //handle search
        const input = document.getElementById('search');
        const resultsContainer = document.querySelector('.homeList');
        console.log(resultsContainer);
        const searchIcon = document.querySelector('.searchicon');
        let markersLayer = L.layerGroup().addTo(map); // Layer khusus marker supaya gampang clear

        function doSearch() {
            document.getElementById('price').value = "";
            document.getElementById('jenisSewa').value = "";
            let homeDetail = document.querySelector('.homeDetail');
            homeDetail.innerHTML = '';

            if (lastMarker) {
                map.removeLayer(lastMarker);
            }
            if (lastCircle) {
                map.removeLayer(lastCircle);
            }

            if (marker) {
                marker.forEach(m => map.removeLayer(m));
            }
            marker = [];
            const query = input.value.trim();
            console.log(query);
            if (!query) {
                resultsContainer.innerHTML = '';
                markersLayer.clearLayers(); // hapus marker lama juga
                return;
            }

            let mergedResults = null;


            fetch(`/ajax/search-location?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    const results = data.results;


                    fetch('/ajax/store-home-details', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                homes: data.results
                            })
                        })
                        .then(res => res.json())
                        .then(response => {
                            console.log('Berhasil disimpan:', response);
                            const homeDetails = response.details;

                            // Buat index detail biar pencarian cepat
                            const detailMap = {};
                            homeDetails.forEach(detail => {
                                detailMap[detail.details.fsq_id] = detail;
                                // console.log(detailMap);
                            });


                            // Gabungkan apiResults dan homeDetails
                            mergedResults = results.map(item => {
                                const detail = detailMap[item.details.fsq_id];
                                const joinedUsers = detail?.data?.length ?? 0;
                                const avail = 5 - joinedUsers;

                                return {
                                    ...item,
                                    homeDetails: detailMap[item.details.fsq_id],
                                    avail
                                };
                            });

                            markersLayer.clearLayers(); // hapus marker lama dulu // pastikan results adalah array
                            if (!results || results.length === 0) {
                                resultsContainer.innerHTML = '<p>Tidak ada hasil.</p>';
                                return;
                            }

                            resultsContainer.innerHTML = mergedResults.map(item => {
                                const starRatingHtml = window.renderStarRating(item.homeDetails.details
                                    .rating);
                                const categoryName = item.categories?.[0]?.name ||
                                    'Kategori tidak diketahui';
                                const photos = item.photos || []; // asumsi: sudah merge data di backend


                                const imageHtml = photos.length >
                                    0 ?
                                    `<img class="w-full h-[114px] object-fill" src="${photos[0].url}" alt="${item.name}">` :
                                    `<img class="w-full h-fit" src="${item.homeDetails.details.main_images}" alt="Default image">`;

                                return `
        <div data-fsq-id="${item.details.fsq_id}"
            class="homeCardContainer md:w-fit max-w-[700px] flex flex-col gap-5 bg-white border-2 border-maroon rounded-xl px-4 py-5 shadow-[2px_3px_5px_rgba(0,0,0,0.25)] hover:scale-[1.005] duration-100 hover:cursor-pointer">
            <div class="homeCard flex flex-col gap-2 items-center">
                <div class="homeInfo1 flex gap-[7px] items-center">
                    <div class="homeTitle w-[65%]">
                        <h1 class="text-[22px] font-popReg text-maroon mb-[1px] leading-[1.3]">${item.homeDetails.details.name}</h1>
                        <div class="flex flex-row gap-1 items-center font-popReg text-[14px] text-[rgba(0,0,0,0.35)] mt-1">
                            <p class="rating">${item.homeDetails.details.rating}</p>
                            ${starRatingHtml}
                            <p class="review">(${JSON.parse(item.homeDetails.details.reviews || '[]').length})</p>
                        </div>
                        <p class="text-[12px] font-nunitoBold text-[rgba(0,0,0,0.35)]">${item.location.formatted_address}</p>
                    </div>
                    <div class="homeImage w-[38%]">
                        ${imageHtml}
                    </div>
                </div>
                <div class="homeInfo2 w-full font-nunitoBold text-[12px] text-[rgba(0,0,0,0.35)] flex gap-4 items-center justify-start">
                    <div class="homePrice">${item.homeDetails.details.duration == "Bulanan" ? `Rp. ${item.homeDetails.details.price} Juta /Bulan (${item.homeDetails.details.max_pax} pax)` :  
                            `Rp. ${item.homeDetails.details.price} Juta /Tahun (${item.homeDetails.details.max_pax} pax)`
                            }</div>
                    <div class="homeStatus flex gap-1 items-center">
                        <div class="w-[7px] h-[7px] rounded-full bg-[rgba(0,0,0,0.35)]"></div>
                        <p class="availWL">Tersedia (${item.avail} Waiting List)</p>
                    </div>
                </div>
            </div>
        </div>`;
                            }).join('');



                            // Tambahkan marker di peta per hasil search
                            mergedResults.forEach(place => {
                                const lat = place.details.geocodes?.main?.latitude;
                                const lng = place.details.geocodes?.main?.longitude;

                                if (lat && lng) {
                                    mark = L.marker([lat, lng]).addTo(markersLayer);
                                    mark.bindPopup(
                                        `<strong>${place.name}</strong><br>${place.location?.formatted_address ?? ''}`
                                    );
                                    marker.push(mark);
                                }
                            });

                            // Optional: Zoom peta ke semua marker
                            const group = new L.featureGroup(markersLayer.getLayers());
                            map.fitBounds(group.getBounds().pad(0.5));

                            if (nav.classList.contains('h-fit')) {
                                nav.classList.add('h-screen');



                                nav.classList.remove('h-fit');
                                result.classList.remove('hidden');
                                // result.classList.add('opacity-100');
                                dropDown.src = "{{ asset('assets/Dropup.png') }}";
                            }

                            let listHome = document.querySelectorAll(".homeCardContainer")
                            console.log(listHome)
                            if (dropArrow.classList.contains('hidden')) {
                                dropArrow.classList.remove('hidden');
                                nav.classList.remove('pb-7');
                                nav.classList.add('pb-3');

                            }
                            listHome.forEach(home => {
                                home.addEventListener("click", () => {
                                    let id = home.getAttribute("data-fsq-id");
                                    console.log(id)
                                    let item = mergedResults.find(i => i.details.fsq_id === id);
                                    // console.log(item);
                                    renderHomeDetail(item);
                                })
                            });

                            const priceSelect = document.getElementById('price');
                            const durationSelect = document.getElementById('jenisSewa');

                            priceSelect.addEventListener('change', filterData);
                            durationSelect.addEventListener('change', filterData);

                            function filterData() {
                                let homeDetail = document.querySelector('.homeDetail');
                                homeDetail.innerHTML = '';
                                const priceVal = priceSelect.value;
                                const durationVal = durationSelect.value;

                                let filtered = mergedResults;


                                // Filter harga
                                if (priceVal) {
                                    switch (priceVal) {
                                        case 'u15':
                                            filtered = filtered.filter(h => h.homeDetails.details.price <
                                                15);
                                            break;
                                        case 'b1517':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                15 && h.homeDetails.details.price <= 17);
                                            break;
                                        case 'b1720':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                17 && h.homeDetails.details.price <= 20);
                                            break;
                                        case 'b3050':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >=
                                                30 && h.homeDetails.details.price <= 50);
                                            break;
                                        case 'b50':
                                            filtered = filtered.filter(h => h.homeDetails.details.price >
                                                50);
                                            break;
                                    }
                                }

                                // Filter durasi
                                if (durationVal) {
                                    filtered = filtered.filter(h => h.homeDetails.details.duration
                                        .toLowerCase() === durationVal);
                                }

                                // Render hasil
                                renderHomesSearch(resultsContainer, filtered);
                            }



                        });
                });




        }

        // Event enter dan click icon (sama seperti sebelumnya)
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                doSearch();
            }
        });

        function renderHomesSearch(container, mergedItems) {


            if (marker) {
                marker.forEach(m => map.removeLayer(m));
            }
            marker = [];
            if (mergedItems.length == 0) {
                container.innerHTML =
                    '<h1 class="text-maroon font-popReg font-semibold text-2xl mt-2">Tidak ditemukan homestay</h1>'
                return

            }
            container.innerHTML = '';
            container.innerHTML = mergedItems.map(item => {
                const starRatingHtml = window.renderStarRating(item.homeDetails.details.rating);
                const categoryName = item.categories?.[0]?.name ||
                    'Kategori tidak diketahui';
                const photos = item.photos || []; // asumsi: sudah merge data di backend


                const imageHtml = photos.length >
                    0 ?
                    `<img class="w-full h-[114px] object-fill" src="${photos[0].url}" alt="${item.name}">` :
                    `<img class="w-full h-fit" src="${item.homeDetails.details.main_images}" alt="Default image">`;

                return `
        <div data-fsq-id="${item.details.fsq_id}"
            class="homeCardContainer flex flex-col gap-5 bg-white border-2 border-maroon rounded-xl px-4 py-5 shadow-[2px_3px_5px_rgba(0,0,0,0.25)] hover:scale-[1.005] duration-100 hover:cursor-pointer">
            <div class="homeCard flex flex-col gap-2 items-center">
                <div class="homeInfo1 flex gap-[7px] items-center">
                    <div class="homeTitle w-[65%]">
                        <h1 class="text-[22px] font-popReg text-maroon mb-[1px] leading-[1.3]">${item.homeDetails.details.name}</h1>
                        <div class="flex flex-row gap-1 items-center font-popReg text-[14px] text-[rgba(0,0,0,0.35)] mt-1">
                            <p class="rating">${item.homeDetails.details.rating}</p>
                            ${starRatingHtml}
                            <p class="review">(${JSON.parse(item.homeDetails.details.reviews || '[]').length})</p>
                        </div>
                        <p class="text-[12px] font-nunitoBold text-[rgba(0,0,0,0.35)]">${item.location.formatted_address}</p>
                    </div>
                    <div class="homeImage w-[38%]">
                        ${imageHtml}
                    </div>
                </div>
                <div class="homeInfo2 w-full font-nunitoBold text-[12px] text-[rgba(0,0,0,0.35)] flex gap-4 items-center justify-start">
                    <div class="homePrice">${item.homeDetails.details.duration == "Bulanan" ? `Rp. ${item.homeDetails.details.price} Juta /Bulan (${item.homeDetails.details.max_pax} pax)` :  
                            `Rp. ${item.homeDetails.details.price} Juta /Tahun (${item.homeDetails.details.max_pax} pax)`
                            }</div>
                    <div class="homeStatus flex gap-1 items-center">
                        <div class="w-[7px] h-[7px] rounded-full bg-[rgba(0,0,0,0.35)]"></div>
                        <p class="availWL">Tersedia (${item.avail} Waiting List)</p>
                    </div>
                </div>
            </div>
        </div>`;
            }).join('');
            marker = [];
            mergedItems.forEach(place => {
                const lat = place.details.geocodes?.main?.latitude;
                const lng = place.details.geocodes?.main?.longitude;

                if (lat && lng) {
                    mark = L.marker([lat, lng]).addTo(markersLayer);
                    mark.bindPopup(
                        `<strong>${place.name}</strong><br>${place.location?.formatted_address ?? ''}`
                    );
                    marker.push(mark);
                }
            });

            // // Optional: Zoom peta ke semua marker
            // const group = new L.featureGroup(markersLayer.getLayers());
            // map.fitBounds(group.getBounds().pad(0.5));
            let listHome = document.querySelectorAll(".homeCardContainer")
            console.log(listHome)
            if (dropArrow.classList.contains('hidden')) {
                dropArrow.classList.remove('hidden');
                nav.classList.remove('pb-7');
                nav.classList.add('pb-3');

            }
            listHome.forEach(home => {
                home.addEventListener("click", () => {
                    let id = home.getAttribute("data-fsq-id");
                    console.log(id)
                    let item = mergedResults.find(i => i.details.fsq_id === id);
                    // console.log(item);
                    renderHomeDetail(item);
                })
            });

        }

        function renderHomesClick(container, mergedItems) {

            if (marker) {
                marker.forEach(m => map.removeLayer(m));
            }
            marker = [];
            if (mergedItems.length == 0) {
                container.innerHTML =
                    '<h1 class="text-maroon font-popReg font-semibold text-2xl mt-2">Tidak ditemukan homestay</h1>'
                return

            }
            container.innerHTML = mergedItems.map(item => {
                const starRatingHtml = window.renderStarRating(item.homeDetails.details
                    .rating);
                const categoryName = item.categories?.[0]?.name ||
                    'Kategori tidak diketahui';
                const photos = item.photos || []; // asumsi: sudah merge data di backend


                const imageHtml = photos.length >
                    0 ?
                    `<img class="w-full h-[114px] object-fill" src="${photos[0].url}" alt="${item.name}">` :
                    `<img class="w-full h-fit" src="${item.homeDetails.details.main_images}" alt="Default image">`;

                return `
        <div data-fsq-id="${item.fsq_id}"
            class="homeCardContainer flex flex-col gap-5 bg-white border-2 border-maroon rounded-xl px-4 py-5 shadow-[2px_3px_5px_rgba(0,0,0,0.25)] hover:scale-[1.005] duration-100 hover:cursor-pointer">
            <div class="homeCard flex flex-col gap-2 items-center">
                <div class="homeInfo1 flex gap-[7px] items-center">
                    <div class="homeTitle w-[65%]">
                        <h1 class="text-[22px] font-popReg text-maroon mb-[1px] leading-[1.3]">${item.homeDetails.details.name}</h1>
                        <div class="flex flex-row gap-1 items-center font-popReg text-[14px] text-[rgba(0,0,0,0.35)] mt-1">
                            <p class="rating">${item.homeDetails.details.rating}</p>
                            ${starRatingHtml}
                            <p class="review">(${JSON.parse(item.homeDetails.details.reviews || '[]').length})</p>
                        </div>
                        <p class="text-[12px] font-nunitoBold text-[rgba(0,0,0,0.35)]">${item.location.formatted_address}</p>
                    </div>
                    <div class="homeImage w-[38%]">
                        ${imageHtml}
                    </div>
                </div>
                <div class="homeInfo2 w-full font-nunitoBold text-[12px] text-[rgba(0,0,0,0.35)] flex gap-4 items-center justify-start">
                    <div class="homePrice">${item.homeDetails.details.duration == "Bulanan" ? `Rp. ${item.homeDetails.details.price} Juta /Bulan (${item.homeDetails.details.max_pax} pax)` :  
                            `Rp. ${item.homeDetails.details.price} Juta /Tahun (${item.homeDetails.details.max_pax} pax)`
                            }</div>
                    <div class="homeStatus flex gap-1 items-center">
                        <div class="w-[7px] h-[7px] rounded-full bg-[rgba(0,0,0,0.35)]"></div>
                        <p class="availWL">Tersedia (${item.avail} Waiting List)</p>
                    </div>
                </div>
            </div>
        </div>`;
            }).join('');
            marker = [];

            // Render marker dan results
            mergedItems.forEach(item => {
                // Tambah marker ke map
                const mark = L.marker([item.geocodes.main.latitude, item.geocodes
                        .main
                        .longitude
                    ])
                    .addTo(map)
                    .bindPopup(item.name);
                marker.push(mark);
            });

            let listHome = document.querySelectorAll(".homeCardContainer")
            console.log(listHome)
            if (dropArrow.classList.contains('hidden')) {
                dropArrow.classList.remove('hidden');
                nav.classList.remove('pb-7');
                nav.classList.add('pb-3');

            }
            listHome.forEach(home => {
                home.addEventListener("click", () => {
                    let id = home.getAttribute("data-fsq-id");
                    console.log(id)
                    let item = mergedResults.find(i => i.fsq_id ===
                        id);
                    // console.log(item);
                    renderHomeDetail(item);
                })
            });

        }



        function renderHomeDetail(home) {
            // console.log(home);
            let homeDetail = document.querySelector('.homeDetail');
            if (window.innerWidth < 768) {
                const clsBtn = document.getElementById('clsDetail');
                clsBtn.classList.remove('hidden');
                clsBtn.addEventListener('click', () => {
                    homeDetail.innerHTML = '';
                    clsBtn.classList.add('hidden');
                })
            }


            const id = home.id;

            console.log(home);
            let starRating = window.renderStarRating(home.homeDetails.details.rating);
            homeDetail.classList.remove('hidden');
            homeDetail.classList.add('flex');

            // Ambil data gambar dari atribut yang baru
            const mainImage = home.homeDetails.details.main_images;

            // Pastikan photos sudah dalam bentuk array
            let photos = home.homeDetails.details.photos;

            if (typeof photos === 'string') {
                try {
                    photos = JSON.parse(photos);
                } catch (e) {
                    console.error('Invalid photo JSON format', e);
                    photos = [];
                }

            }
            photos = photos.slice(0, 5);


            // const assetPath = "{{ asset('assets/homeTest.png') }}";
            homeDetail.innerHTML = `
            <div
            class="homeDetailCard bg-white border-2 border-maroon rounded-xl px-8    py-3 shadow-[3px_6px_5px_rgba(0,0,0,0.25)] md:w-[350px] w-full md:h-[700px] h-[570px] md:mr-0 mr-5">
            <div class="maxCon w-full md:h-[650px] h-[530px] mt-1 overflow-auto custom-scroll">
                <div class="w-full max-w-xl mx-auto mb-2">
                    <!-- Main Image -->
                    <img id="mainImage" class="w-full h-[160px] object-cover" src="${home.photos?.[0]?.url || mainImage}"
                        alt="Main Image">

                    <!-- Thumbnail Images -->
                    <div class="flex justify-start mt-1 gap-1">
                        ${photos.map((photo, index) => `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <img class="thumb w-[53px] h-10 object-cover cursor-pointer ${index === 0 ? 'opacity-100 border-1 border-yellow-400' : 'opacity-50'}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        src="${photo}" alt="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `).join('')}
                       
                    </div>
                    
                </div>
                <div class="homeTitle w-full">
                    <h1 class="text-[20px] font-popB text-maroon mb-[1px]">${home.homeDetails.details.name}</h1>
                    <div class="flex flex-row gap-1 items-center font-popReg text-[14px] text-[rgba(0,0,0,0.35)]">
                        <p class="rating">${home.homeDetails.details.rating}</p>
                        ${starRating}
                        <p class="review">(${JSON.parse(home.homeDetails.details.reviews || '[]').length})</p>
                    </div>
                    <p class="text-[14px] text-[rgba(0,0,0,0.35)]">${home.location.formatted_address}</p>
                </div>

                <div class="w-full flex flex-col items-center mt-1">
                    <div
                        class="tabControl flex gap-2 text-[14px] text-maroon font-nunitoBold w-full justify-center relative">
                        <p class="tab cursor-pointer" data-tab="overview">Detail</p>
                        <p class="tab cursor-pointer" data-tab="review">Reviews</p>
                        <!-- Underline -->
                        <div id="underline"
                            class="absolute bottom-[-3px] h-[2px] bg-gray-400 transition-all duration-300 left-0">
                        </div>
                    </div>
                </div>

                <div class="tabArea">

                </div>

            </div>

        </div>

            `
            let tabs = null;
            setTimeout(() => {
                tabs = document.querySelectorAll(".tab");
                console.log(tabs);

                let tabContent = document.querySelector(".tabArea")
                renderTab("overview", tabContent, tabs, home);
                tabs.forEach((tab) => {
                    tab.addEventListener("click", () => {
                        // const tabRect = tab.getBoundingClientRect();
                        // const parentRect = tab.parentElement.getBoundingClientRect();
                        renderTab(tab.dataset.tab, tabContent, tabs, home);
                    });
                });

                const mainImage = document.getElementById("mainImage");
                const thumbnails = document.querySelectorAll(".thumb");
                let currentIndex = 0;
                let autoSlide;

                const updateMainImage = (index) => {
                    currentIndex = index;
                    mainImage.src = thumbnails[index].src;

                    thumbnails.forEach((thumb, i) => {
                        if (i === index) {
                            thumb.classList.add("opacity-100", "border-yellow-400", "border-1");
                            thumb.classList.remove("opacity-50");
                        } else {
                            thumb.classList.remove("opacity-100", "border-yellow-400", "border-1");
                            thumb.classList.add("opacity-50");
                        }
                    });
                };

                const startAutoSlide = () => {
                    autoSlide = setInterval(() => {
                        currentIndex = (currentIndex + 1) % thumbnails.length;
                        updateMainImage(currentIndex);
                    }, 5000);
                };

                thumbnails.forEach((thumb, index) => {
                    thumb.addEventListener("click", () => {
                        clearInterval(autoSlide); // stop current interval
                        updateMainImage(index);
                        startAutoSlide(); // restart auto-slide after manual click
                    });
                });

                // Start on page load
                updateMainImage(currentIndex);
                startAutoSlide();


            }, 0);

        }

        function renderReview(home) {
            if (home.homeDetails.details.reviews.length == 0) {
                return `<p class="text-[20px] font-bold text-black text-center mt-5">No Reviews Yet</p>`;
            }
            let reviewsHTML = '';
            let reviews = home.homeDetails.details.reviews;
            if (typeof reviews === 'string') {
                try {
                    reviews = JSON.parse(reviews);
                } catch (e) {
                    reviews = []; // fallback kalau JSON invalid
                }
            }

            reviews.forEach(review => {
                const name = review.name || "Anonymous";
                const rating = review.rating || "-";
                const comment = review.comment || "";
                reviewsHTML += `
            <div class="rev flex gap-2 items-center mt-2 w-full py-1">
                <div class="img">
                    <ion-icon class="text-[30px]" name="person-circle-outline"></ion-icon>
                </div>

                <div class="info flex flex-col text-[12px]">
                    <div class="upperRev flex gap-1 font-nunitoBold">
                        <p class="Username">${name}</p>
                        <p>-</p>
                        <p>${rating}</p>
                    </div>
                    <p class="text-[12px]">${comment}</p>
                </div>
            </div>
        `;
            });
            return reviewsHTML;


        }


        async function renderTab(tab, tabContent, tabs, home) {
            // Render konten
            if (tab === "overview") {
                tabContent.innerHTML = await renderOverview(home);
            } else {
                tabContent.innerHTML = renderReview(home);
            }

            // Geser underline
            const tabEl = [...tabs].find(t => t.dataset.tab === tab);
            const underline = document.getElementById("underline");
            underline.style.width = tabEl.offsetWidth + "px";
            underline.style.left = tabEl.offsetLeft + "px";
        }


        async function checkWaitingList(fsq_id) {
            const res = await fetch(`/check-waiting-list/${fsq_id}`);
            const data = await res.json();
            // console.log(data.dataWL);
            return data;
        }

        async function renderOverview(home) {
            let fsq_id = home.homeDetails.details.fsq_id;
            const data = await checkWaitingList(fsq_id);
            const WaitingList = data.dataWL;
            // console.log(user);
            const homeDet = data.home;

            return `
        <div class="container">
                        <p class="price text-[13px] text-maroon mt-2">Mulai dari</p>
                        <p class="priceInfo font-popB text-red-600 text-[18px]">${home.homeDetails.details.duration == "Bulanan" ? `Rp. ${home.homeDetails.details.price} Juta /Bulan` :  
                            `Rp. ${home.homeDetails.details.price} Juta /Tahun`
                            } </p>
                        <p class="contact text-maroon font-popB text-[18px] mt-2">Kontak</p>
                        <p class="contactInfo text-maroon text-[15px]">+62 81228831149</p>
                        <p class="facTitle text-maroon font-popB text-[18px] mt-2">Fasilitas</p>
                        <div class="facilities w-full flex gap-4 text-[16px] mt-2  text-maroon">
                            <div class="leftFac w-[55%] gap-3 flex flex-col">
                                <div class="area flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="business-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.area} m(sq)</p>
                                </div>
                                <div class="bedrooms flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="bed-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.bedroom} kamar tidur</p>
                                </div>
                                <div class="ac flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="snow-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.air_conditioning} Air Conditioning</p>
                                </div>
                                <div class="bathrooms flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="color-fill-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.bathroom} kamar mandi</p>
                                </div>
                                <div class="kitchen flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="restaurant-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.kitchen} dapur</p>
                                </div>
                            </div>
                            <div class="rightFac w-[45%] gap-3 flex flex-col">
                                <div class="capacity flex items-center gap-2.5">
                                    <ion-icon class="text-[17px] text-black" name="people-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.max_pax} pax</p>
                                </div>
                                <div class="hotWater flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="thermometer-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.air_conditioning} Air Panas</p>
                                </div>
                                <div class="refri flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="cube-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.refrigerator} Kulkas</p>
                                </div>
                                <div class="wifi flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="wifi-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.wifi} Wi-Fi</p>
                                </div>
                                <div class="tv flex items-center gap-2.5">
                                    <ion-icon class="text-[20px] text-black" name="tv-outline"></ion-icon>
                                    <p class="text-[14px]">${home.homeDetails.details.tv} Televisi</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    
                    <div class="waitList w-full mt-5">
                       
                        ${renderWaitingList(WaitingList, fsq_id, homeDet)}
                    </div>
        `

        }

        function renderWaitingList(WaitingList, fsq_id, homeDet) {
            let html = '';
            if (WaitingList) {
                WaitingList.forEach((wl, index) => {
                    html += `
                        <div class="buddies flex justify-between w-full border-black px-2 py-1 items-center border-t-[0.5px] cursor-pointer" data-wlid="${wl.wlid}" data-fsq-id="${fsq_id}">
                            <div class="profile">
                                <div class="flex items-center">
                                    <div class="flex -space-x-4">
                                        <div class="w-7 h-7 rounded-full border border-gray-400 bg-white"></div>
                                        <div class="w-7 h-7 rounded-full border border-gray-400 bg-white"></div>
                                        <div class="w-7 h-7 rounded-full border border-gray-400 bg-white"></div>
                                        <div class="w-7 h-7 rounded-full border border-gray-400 bg-white flex items-center justify-center">
                                            <i class="fas fa-user-plus text-black text-[10px]"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="font-nunitoBold text-[14px]">Buddies ${index + 1}</p>
                            <p class="cntUser font-popReg text-maroon text-[14px]">${wl.user_count}/${homeDet.max_pax}</p>
                        </div>
                    `;
                });

            }



            if (!WaitingList || WaitingList.length < 5) {
                html += `
                    <div data-fsq-id=${fsq_id} class="makeWL flex justify-center gap-1 w-full border-black py-3 items-center border-t-[0.5px] cursor-pointer">
                        <ion-icon class="font-bold" name="add-outline"></ion-icon>
                        <p class="font-nunitoBold text-[13px]">Buat grup baru untuk Buddies</p>
                    </div>
                `;
            }
            return html;

        }

        window.renderWaitingList = renderWaitingList;

        document.addEventListener("DOMContentLoaded", () => {
            const popup = document.getElementById("popupDetail");
            const popupContainer = document.getElementById("popupCon");

            // Show on click buddies or makeWL
            document.addEventListener("click", async function(e) {
                const buddiesEl = e.target.closest(".buddies");
                const makeWLEl = e.target.closest(".makeWL");
                const isLoggedIn = @json(Auth::check());

                let url = "";

                if (buddiesEl) {
                    e.preventDefault();
                    if (!isLoggedIn) {
                        window.location.href = '/login';
                        return;
                    }
                    const wlid = buddiesEl.dataset.wlid;
                    const fsq_id = buddiesEl.dataset.fsqId;
                    url =
                        `/homestay/detail?fsq_id=${fsq_id}&wlid=${wlid}`;

                    fetch(url)
                        .then(res => res.text()) // Expecting HTML
                        .then(html => {
                            // Step 3: Render popup dengan HTML yang sudah include score
                            popup.innerHTML = html;
                            popup.classList.remove('hidden');
                            const popUpagree = `<div id="popupConAgree"
        class="w-full min-h-screen absolute top-0 z-[100] bg-[rgba(0,0,0,0.4)] flex items-center justify-center">
        <div class="bg-[#f4f3e6] px-6 pb-7 pt-7  rounded-3xl w-[95%] max-w-screen-xl relative  md:h-[70%] h-[720px]">

            <button id="closePopupAgree" class="closeBtn top-8 right-10 text-xl absolute cursor-pointer">
                <img src="/assets/closeX.png" alt="" class="w-10 h-10">
                {{-- <i class="fas fa-times"></i> --}}
            </button>
            <!-- Header -->
            <div class=" w-[80%] relative flex md:gap-50 gap-5 pb-5">
                <div class="img">
                    <img class="md:w-30 w-36 h-15" src="/assets/LogoShadow.png" alt="">
                </div>
                <div class="flex justify-center items-center  text-white px-6 py-2">
                    <h2 class="wlTitle md:text-4xl text-2xl font-bold text-center text-maroon">Syarat dan Ketentuan Pengguna</h2>
                </div>

            </div>

            <!-- Card List -->
            <div id="listCardUser"
                class="flex overflow-x-auto space-x-4 py-4 justify-center bg-white md:h-[500px] h-[380px] rounded-2xl">
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
                <label for="agree" class="font-popReg text-sm md:text-md">Saya telah membaca dan menyetujui ketentuan yang berlaku</label>
                <p id="errorLog" class="text-merah"></p>   
            </div>
            <div class="w-full text-center">
                <button type="button" id="joinBtn"
                    class="bg-[#601010] text-white font-popReg hover:scale-[1.01] transition-all duration-100 rounded-3xl shadow-[3px_4px_6px_rgba(0,0,0,0.3)] p-4 w-[300px] justify-center border-4 border-yellow-400 items-center cursor-pointer hover:scale-105 transition">


                    Gabung Buddies
                </button>
            </div>
        </div>
    </div>
                            
                            
                            
                            `

                            const popupAgree = document.getElementById('popupAgree');
                            if (popupAgree) {
                                popupAgree.addEventListener('click', () => {
                                    document.body.insertAdjacentHTML('beforeend',
                                        popUpagree);
                                    setTimeout(() => {
                                        const closeBtnAgree = document
                                            .getElementById(
                                                'closePopupAgree');
                                        const closeAgree = document.getElementById(
                                            'popupConAgree');
                                        console.log(closeBtnAgree);

                                        if (closeBtnAgree) {
                                            closeBtnAgree.addEventListener('click',
                                                () => {
                                                    closeAgree.remove();
                                                });
                                        }
                                    }, 50);

                                    const joinBtn = document.querySelector("#joinBtn");
                                    console.log(joinBtn);
                                    if (joinBtn && typeof window.initPopupEvents ===
                                        "function") {
                                        window.initPopupEvents();
                                    }



                                })
                            }


                            // const joinBtn = document.querySelector("#joinBtn");
                            // if (joinBtn && typeof window.initPopupEvents === "function") {
                            //     window.initPopupEvents();
                            // }



                            const closeBtn = document.querySelector("#closePopup");
                            console.log(closeBtn);
                            if (closeBtn) {
                                closeBtn.addEventListener("click", (e) => {
                                    e.stopPropagation();
                                    popup.classList.add("hidden");
                                });
                            }


                            const card = document.querySelectorAll('.group');
                            card.forEach(card => {
                                card.addEventListener('click', () => {
                                    card.classList.toggle('flipped');
                                });
                            });
                        })
                        .catch(err => console.error("Error:", err));
                } else if (makeWLEl) {
                    e.preventDefault();
                    const fsq_id = makeWLEl.dataset.fsqId;
                    url = `/homestay/newbuddies/${fsq_id}`; // tanpa wlid
                    fetch(url)

                        .then(res => res.text())
                        .then(html => {
                            // setelah HTML popup didapat, langsung tampilkan
                            popup.innerHTML = html;
                            popup.classList.remove('hidden');
                            const popUpagree = `<div id="popupConAgree"
        class="w-full min-h-screen absolute top-0 z-[100] bg-[rgba(0,0,0,0.4)] flex items-center justify-center">
        <div class="bg-[#f4f3e6] px-6 pb-7 pt-7  rounded-3xl w-[95%] max-w-screen-xl relative md:h-[70%] h-[720px]">

            <button id="closePopupAgree" class="closeBtn top-8 right-10 text-xl absolute cursor-pointer">
                <img src="/assets/closeX.png" alt="" class="w-10 h-10">
                {{-- <i class="fas fa-times"></i> --}}
            </button>
            <!-- Header -->
            <div class=" w-[80%] relative flex md:gap-50 gap-5 pb-5">
                <div class="img">
                    <img class="md:w-30 w-36 h-15" src="/assets/LogoShadow.png" alt="">
                </div>
                <div class="flex justify-center items-center  text-white md:px-6 py-2">
                    <h2 class="wlTitle md:text-4xl text-2xl font-bold text-center text-maroon">Syarat dan Ketentuan Pengguna</h2>
                </div>

            </div>

            <!-- Card List -->
            <div id="listCardUser"
                class="flex overflow-x-auto space-x-4 py-4 justify-center bg-white md:h-[500px] h-[380px] rounded-2xl">
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
                <label for="agree" class="font-popReg text-sm md:text-md">Saya telah membaca dan menyetujui ketentuan yang berlaku</label>
                <p id="errorLog" class="text-merah"></p>   
            </div>
            <div class="w-full text-center">
                <button type="button" id="joinBtn"
                    class="bg-[#601010] text-white font-popReg hover:scale-[1.01] transition-all duration-100 rounded-3xl shadow-[3px_4px_6px_rgba(0,0,0,0.3)] p-4 w-[300px] justify-center border-4 border-yellow-400 items-center cursor-pointer hover:scale-105 transition">


                    Gabung Buddies
                </button>
            </div>
        </div>
    </div>
                            
                            
                            
                            `

                            if (isLoggedIn) {
                                const popupAgree = document.getElementById('popupAgree');
                                // console.log(popupAgree)
                                popupAgree.addEventListener('click', () => {
                                    document.body.insertAdjacentHTML('beforeend',
                                        popUpagree);
                                    setTimeout(() => {
                                        const closeBtnAgree = document
                                            .getElementById(
                                                'closePopupAgree');
                                        const closeAgree = document.getElementById(
                                            'popupConAgree');
                                        console.log(closeBtnAgree);

                                        if (closeBtnAgree) {
                                            closeBtnAgree.addEventListener('click',
                                                () => {
                                                    closeAgree.remove();
                                                });
                                        }
                                    }, 50);

                                    const joinBtn = document.querySelector("#joinBtn");
                                    console.log(joinBtn);
                                    if (joinBtn && typeof window.initPopupEvents ===
                                        "function") {
                                        window.initPopupEvents();
                                    }


                                })

                            }







                            const closeBtn = document.querySelector("#closePopup");
                            if (closeBtn) {
                                closeBtn.addEventListener("click", (e) => {
                                    e.stopPropagation();
                                    popup.classList.add("hidden");
                                });
                            }

                            const card = document.querySelectorAll('.group');
                            card.forEach(card => {
                                card.addEventListener('click', () => {
                                    card.classList.toggle('flipped');
                                });
                            });



                        })
                        .catch(error => {
                            console.error("Error during fetch or score process:", error);
                        });
                } else {
                    return; // kalau klik bukan keduanya, abaikan
                }
                const injectedScripts = new Set();




                // Close if clicking outside the popupCon
                popup.addEventListener("click", function(e) {
                    // console.log(e.target.id);
                    if (e.target.id == "popupCon") {
                        popup.classList.add("hidden");
                    }
                });
            });








            dropDown.addEventListener('click', function() {
                // let nav = document.querySelector('nav');
                if (nav.classList.contains('h-fit')) {
                    nav.classList.add('h-screen');

                    nav.classList.remove('h-fit');
                    result.classList.remove('hidden');
                    // result.classList.add('opacity-100');
                    dropDown.src = "{{ asset('assets/Dropup.png') }}";
                } else {
                    // result.classList.remove('opacity-100');
                    result.classList.add('hidden');

                    nav.classList.remove('h-screen');


                    nav.classList.add('h-fit');
                    let homeDetail = document.querySelector('.homeDetail');
                    homeDetail.innerHTML = '';

                    dropDown.src = "{{ asset('assets/Dropdown.png') }}";
                }
            });

            window.renderStarRating = function renderStarRating(rating) {
                let starHtml = '<span class="flex items-end">';
                for (let i = 0; i < 5; i++) {
                    let fill = Math.min(Math.max(rating - i, 0), 1) * 100;

                    starHtml += `
        <span class="fa-star-wrapper" style="position: relative; display: inline-block; width: 1em; height: 1em; margin-right: 0.2em;">
            <i class="far fa-star fa-star-empty" style="position: absolute; top: 0; left: 0; font-size: 12px; color: #e4e5e9;"></i>
            <i class="fas fa-star fa-star-filled" style="position: absolute; top: 0; left: 0; font-size: 12px; color: #facc15; overflow: hidden; white-space: nowrap; width: ${fill}%;"></i>
        </span>`;
                }
                starHtml += '</span>';
                return starHtml;
            }

        });
    </script>
@endsection
