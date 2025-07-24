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
    <h1 class="font-popReg font-semibold text-3xl text-[#333333]">Profil</h1>
    <div id="dropDownNav" class="md:hidden">
        <img class="w-10 h-8 mr-12" src="{{ asset('assets/Dropdown.png') }}" alt="">
    </div>
</div>
<div class="line h-[1px] bg-maroon"></div>
<div class="content ms-12 md:mr-0 mr-12 mt-10 md:flex-row md:gap-12 flex flex-col-reverse gap-5">
    <div class="left md:w-[50%] w-full flex flex-col gap-5">

        <div class="rating">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">Rating Anda</h3>
            <div class="flex gap-1 items-center">

                <x-star-rating-user :rating="$data->rating" />
                <p id="rating-display" class="text-[17px] text-abu">({{ number_format($data->rating, 1) }})</p>
            </div>

        </div>
        <div class="email">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">Alamat Email</h3>
            <p id="email-display" class="text-[17px] text-abu">{{ $data->email }}</p>
            <input id="email-input" type="email" class="border p-2 w-[300px] rounded hidden"
                value="{{ $data->email }}">
        </div>
        <div class="name">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">Nama Lengkap</h3>
            <p id="name-display" class="text-[17px] text-abu">{{ $data->name }}</p>
            <input id="name-input" type="text" class="border p-2 w-[300px] rounded hidden"
                value="{{ $data->name }}">
        </div>
        <div class="phone">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">No. Telepon</h3>
            <p id="phone-display" class="text-[17px] text-abu">{{ $data->phone_num }}</p>
            <input id="phone-input" type="text" class="border p-2 w-[300px] rounded hidden"
                value="{{ $data->phone_num }}">
        </div>
        <div class="bod">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">Tanggal Lahir</h3>
            <p id="bod-display" class="text-[17px] text-abu">{{ date('d F Y', strtotime($data->bod)) }}</p>
            <input id="bod-input" type="date" class="border p-2 w-[300px] rounded hidden"
                value="{{ $data->bod }}">
        </div>
        <div class="gender">
            <h3 class="text-xl text-black font-popReg font-semibold pb-1">Jenis Kelamin</h3>
            <p id="gender-display" class="text-[17px] text-abu">{{ $data->gender }}</p>
            <select id="gender-input" class="border p-2 w-[300px] rounded hidden">
                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div id="edit-button"
            class="edit md:mb-0 mb-8 px-5 py-2 bg-[#5E2D2D] font-popReg text-white rounded-sm w-[120px] text-center mt-4 cursor-pointer">
            Ubah
        </div>
        <div id="save-button"
            class="edit px-5 py-2 md:mb-0 mb-8 bg-[#88A825] font-popReg text-white rounded-sm w-[120px] text-center mt-3 hidden cursor-pointer">
            Simpan
        </div>
    </div>
    <div class="right md:w-[50%] w-full flex flex-col gap-7">
        <div class="photo w-full flex flex-col">
            <h4 class="text-xl text-black font-popReg font-semibold mb-2">Foto Profil</h4>
            <div class="w-full flex justify-center">
                <div class="w-fit relative">
                    <img class="w-[180px] h-[180px] rounded-full" src="{{ asset($data->profile_picture) }}"
                        alt="">
                    <img class="w-[50px] h-[50px] rounded-full py-2 px-2 bg-maroon absolute right-0 bottom-0"
                        src="{{ asset('assets/OrangFix.png') }}" alt="">
                </div>


            </div>
        </div>
        <div class="occupation">
            <h4 class="text-xl text-black font-popReg font-semibold pb-1">Pekerjaan</h4>
            <p id="occupation-display" class="text-[17px] text-abu">{{ $data->occupation }}</p>
            <select id="occupation-input" class="border p-2 w-[300px] rounded hidden">
                <option value="Student" {{ $data->occupation == 'Student' ? 'selected' : '' }}>Pelajar
                </option>
                <option value="Worker" {{ $data->occupation == 'Worker' ? 'selected' : '' }}>Pekerja
                </option>
                <option value="Businessman" {{ $data->occupation == 'Businessman' ? 'selected' : '' }}>
                    Pebisinis</option>
            </select>
        </div>
        <div id="notification" class="w-full flex justify-center hidden">
            <div
                class=" w-fit bg-[#88A825] font-popReg font-semibold text-white px-4 py-3 rounded transition-opacity duration-500 mr-5">
                Data berhasil diperbarui!
            </div>
        </div>
    </div>
</div>

<script>
    $('#edit-button').on('click', function() {
        console.log('hello')
        // Sembunyikan text
        $('#email-display, #name-display, #phone-display, #bod-display, #gender-display, #occupation-display')
            .hide();

        // Tampilkan input
        $('#email-input, #name-input, #phone-input, #bod-input, #gender-input, #occupation-input')
            .removeClass('hidden');

        // Ganti tombol
        $('#edit-button').hide();
        $('#save-button').show();
    });

    $('#save-button').on('click', function() {
        let userId = '{{ $data->id }}';
        console.log(userId)

        let email = $('#email-input').val();
        let name = $('#name-input').val();
        let phone = $('#phone-input').val();
        let bod = $('#bod-input').val();
        let gender = $('#gender-input').val();
        let occupation = $('#occupation-input').val();

        $.ajax({
            url: '/user/' + userId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: email,
                name: name,
                phone_num: phone,
                bod: bod,
                gender: gender,
                occupation: occupation
            },
            success: function(response) {
                // Update tampilan text
                // $('#desc-display').text(desc).show();
                $('#email-display').text(email).show();
                $('#name-display').text(name).show();
                $('#phone-display').text(phone).show();

                let formattedDate = new Date(bod).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                $('#bod-display').text(formattedDate).show();

                $('#gender-display').text(gender).show();
                $('#occupation-display').text(occupation).show();

                // Sembunyikan input
                $('#email-input, #name-input, #phone-input, #bod-input, #gender-input, #occupation-input')
                    .addClass('hidden');

                // Ganti tombol
                $('#save-button').hide();
                $('#edit-button').show();
                $('#notification').removeClass('hidden').addClass('opacity-100');

                // Sembunyikan notifikasi setelah 5 detik
                setTimeout(function() {
                    $('#notification').addClass('hidden').removeClass('opacity-100');
                }, 5000);

                // alert('Data berhasil diperbarui!');
            },
            error: function(xhr) {
                alert('Gagal update data!');
            }
        });
    });
</script>
