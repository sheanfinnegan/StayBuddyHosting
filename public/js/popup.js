
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".flip-card").forEach(card => {
            card.addEventListener("click", () => {
                card.classList.toggle("flipped");
            });
        });
    });

window.initPopupEvents = function () {
    // const isLoggedIn = @json(Auth::check());
    const checkbox = document.getElementById("agree");
    const joinBtn = document.getElementById("joinBtn");
    console.log(joinBtn);

    document.getElementById("joinBtn").addEventListener("click", function(e) {
         if (!checkbox.checked) {
                const errorLog = document.getElementById('errorLog')
                errorLog.textContent = "Centang persetujuan terlebih dahulu"
                return;
            }
        console.log("hello");
        // e.preventDefault();
        const wlid = document.getElementById("wlid").value;
        const fsq = document.getElementById("homestay_id").value;

        fetch("/buddies/join", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    homestay_id: fsq,
                    wlid: wlid
                })
            })
            .then(res => res.json())
            .then(data => {
                 const closeAgree = document.getElementById('popupConAgree');

                closeAgree.remove();
                                        
                if (data.user) {
                    // 1. Buat kartu baru dan inject ke dalam container popup
                    const cardList = document.querySelector("#listCardUser");
                    const newCard = document.createElement("div");
                    // newCard.classList.add("flip-card", "w-fit", "h-fit");
                    newCard.innerHTML = `
                <div class="group perspective w-[300px] h-[480px] cursor-pointer">
                        <div class="relative w-full h-full transition-transform duration-700 transform-style-preserve-3d group-[.flipped]:rotate-y-180"
                            id="cardInner">
                            <div
                                class="absolute w-full h-full backface-hidden bg-[#570807] text-white rounded-3xl shadow-lg border-4 border-[#f8A91f] p-4">
                                <img src="/${data.user.profile_picture}"
                                    class="rounded-lg h-52 object-cover w-full mb-4" alt="Foto" />
                                <div class="text-xl font-bold">${data.user.name}</div>
                                <div class="flex gap-2">
                                    <div class="text-sm">
                                        Rating: ${data.user.rating.toFixed(1)}
                                    </div>
                                    ${window.renderStarRating(data.user.rating)}
                                </div>
                                <div class="text-sm">
                                    Umur: ${ data.age } Tahun<br />
                                    No. telp: ${data.user.phone_num} <br />
                                    Email: ${data.user.email}<br />
                                </div>

                                <div class="mb-20">
                                    
                                </div>

                                <div class="mt-1 text-center text-white underline">Preferensi User</div>
                            </div>

                            <div
                                class="absolute w-full h-full backface-hidden rotate-y-180 bg-[#570807] text-white rounded-3xl shadow-lg border-4 border-[#f8A91f] p-4">

                                <div class="h-full overflow-y-auto pr-1 pb-6 scrollbar-hide">
                                    <h1 class="w-full text-center font-popReg font-semibold text-[20px] py-3">
                                        ${ data.user.name } Preferensi</h1>
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
                                                <h1 class="font-popReg text-[#797979]">${ data.user.preference.smoking }
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
                                                    ${ data.user.preference.alcoholic }</h1>

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
                                                     ${generateLevelBarHTML(data.user.preference.tidiness)}
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
                                                    ${ data.user.preference.prefered_age }</h1>

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
                                                    ${ data.user.preference.routine_type }</h1>
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
                                                    ${data.user.preference.room_type}</h1>
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
                                                    ${generateLevelBarHTML(data.user.preference.socializing)}
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
                                                     ${generateLevelBarHTML(data.user.preference.cooking_freq)}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="petFriendly flex items-center gap-4">
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
                                                    ${data.user.preference.room_temperature }</h1>
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
                                                    ${ data.user.preference.work_type }</h1>
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
                                                     ${generateLevelBarHTML(data.user.preference.noise_tolerance)}
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
                                                    ${ data.user.preference.music_genre} Music</h1>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
            `;
            
                    cardList.insertBefore(newCard, cardList.lastElementChild); // sebelum tombol join
                    const conluar = document.getElementById('conLuar')

                    const joinWA = `<div class="w-full flex justify-center">
                <div
                    class="cursor-pointer shadow-md border-3 border-putih bg-[#88A825] py-4 rounded-2xl flex items-center justify-center gap-2 md:w-[30%] w-[80%] hover:scale-[1.03] duration-100 transition-all">
                    <div class="title text-white font-popReg font-semibold text-xl">
                        Gabung Grup WA Buddies
                    </div>
                    <div class="image">
                        <img class="w-8 h-8" src="/assets/wa.png" alt="">
                    </div>
                </div>

            </div>`

            if(data.cnt == data.home.max_pax) {
                conluar.insertAdjacentHTML('beforeend', joinWA);
            }


                    
                    const card = document.querySelectorAll('.group');
                        card.forEach(card => {
                            card.addEventListener('click', () => {
                                card.classList.toggle('flipped');
                            });
                            // reset semua card
                        });
                    // console.log(data.home);
                    const countUpdate = document.getElementById("uCount");
                    countUpdate.textContent = `${data.cnt}/${data.home.max_pax}`;

                    const wlTitle = document.querySelector(".wlTitle");
                    wlTitle.textContent = "BUDDIES DETAIL";

                    // const targetCntUsers = document.querySelector(`.buddies[data-wlid="${wlid}"] .cntUser`);
                    // targetCntUsers.textContent = `${data.cnt}/${data.home.max_pax}`;


                    // console.log(countUpdate);

                    const waitContainer = document.querySelector(".waitList");
                    let html = window.renderWaitingList(data.waitingList, data.home.fsq_id, data.home);
                    waitContainer.innerHTML = html;
                    console.log(data.home.fsq_id);
                console.log(document.querySelector(`.homeCardContainer[data-fsq-id="${data.home.fsq_id}"]`));

                    const homeCard = document.querySelector(`.homeCardContainer[data-fsq-id="${data.home.fsq_id}"] .availWL`);
                    

                    homeCard.textContent = `Available (${data.joinedCount} Waiting List)`;

                    // 2. Tambahkan event toggle flip
                    newCard.addEventListener("click", () => newCard.classList.toggle("flipped"));

                    const joinCard = document.querySelector(".joincard");
                    if(data.cnt >= data.home.max_pax) {
                        joinCard.classList.add("hidden");
                    }

                } else {
                    alert(data.message || "Gagal join");
                }
            })
            .catch(err => {
                console.error("Error:", err);
            });
    });



}

function generateLevelBarHTML(level, activeColor = '#88A825', inactiveColor = 'rgba(98,98,98,0.28)') {
    let html = '';
    for (let i = 1; i <= 5; i++) {
        const color = i <= level ? activeColor : inactiveColor;
        html += `<div class="w-7 h-3" style="background-color: ${color}; border-radius: 9999px;"></div>`;
    }
    return html;
}

window.initShowPayment = function (method) {
        console.log("initShowPayment called with method:", method);
    const allMethods = ['MasterCard', 'Qris', 'Visa', 'Paypal'];
        const title = document.querySelector('#payTitle');
        const formContainer = document.querySelector('#formPay');
        allMethods.forEach(m => {
            const img = document.getElementById(`method-${m}`);
            if (img) {
                img.classList.remove('border-2');
            }
        });

        const activeImg = document.getElementById(`method-${method}`);
        // console.log("Active Image:", activeImg);
        if (activeImg) {
            activeImg.classList.add('border-2');
        }

        if (title) {
            title.textContent = `Payment By ${method}`;
        }

        if (formContainer) {
            if (method === 'Qris') {
                formContainer.innerHTML = `
                    <h1 class="text-2xl font-bold flex justify-center">Payment By ${method}</h1>
                    <div class="w-full mt-2 flex justify-center">
                        <img src="/assets/qris.jpg" alt="QR Code" class="w-[200px] h-[200px] object-contain">
                    </div>
                    <p class="text-center text-gray-600">Silakan scan QR Code untuk menyelesaikan pembayaran.</p>
                `;
            } else {
                formContainer.innerHTML = `
                    <h1 class="text-2xl font-bold flex justify-center">Payment By ${method}</h1>
                    <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex items-center">
                        <input type="text" placeholder="Card Number" class="p-4 w-[100%] h-[100%] rounded-xl" required>
                    </div>
                    <div class="w-[100%] h-[25%] border-1 mt-5 rounded-xl flex items-center">
                        <input type="text" placeholder="Name on Card" class="p-4 w-[100%] h-[100%] rounded-xl" required>
                    </div>
                    <div class="inline-flex w-[100%] h-[25%] gap-4">
                        <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                            <input type="date" placeholder="Expiration Date" class="p-4 w-[100%] h-[100%] rounded-xl" required>
                        </div>
                        <div class="w-[50%] h-[100%] border-1 mt-5 rounded-xl flex items-center">
                            <input type="text" placeholder="CVV" class="p-4 w-[100%] h-[100%] rounded-xl" required>
                        </div>
                    </div>
                `;
            }
        }

        

}


