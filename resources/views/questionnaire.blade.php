@extends('layouts.app')
@section('title', 'Pertanyaan Preferensi | Stay Buddy')

@section('content')

    @php
        $progressBarQuestions = [3, 7, 8, 11]; // ID yang butuh value integer
    @endphp

    <div class="flex min-h-screen bg-[#f1f1e8] md:flex-row flex-col">
        <!-- Left Panel -->


        <div class="w-full md:w-1/2 bg-[#e9cfc4] p-12 flex flex-col justify-center">
            <div class=" justify-center mb-5 md:hidden flex ">
                <img src="{{ asset('assets/LogoStayBuddy.png') }}" alt="Stay Buddy" class="w-48 h-24">
            </div>
            <p class="text-sm font-semibold">Pertanyaan {{ $question->id }}/12</p>
            <h1 class="text-2xl md:text-4xl font-extrabold mt-2 text-[#4a0000]">{{ $question->question_text }}</h1>
            <p class="text-sm mt-4">Pilih satu jawaban</p>
        </div>

        <!-- Right Panel -->
        <div class="w-full md:w-1/2 p-12 flex flex-col h-fit md:h-screen">
            <!-- Logo -->
            <div class=" justify-center mb-4 md:flex hidden">
                <img src="{{ asset('assets/LogoShadow.png') }}" alt="Stay Buddy" class="w-[500px] mt-3">
            </div>

            <!-- Form -->
            <form method="POST"
                action="{{ $question->id < 12 ? route('questionnaire.next') : route('questionnaire.submit') }}"
                class="flex flex-col md:flex-grow">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">

                <!-- Opsi -->
                <div class="flex flex-col md:flex-grow justify-center space-y-4">
                    @foreach (['option_1', 'option_2', 'option_3', 'option_4', 'option_5'] as $opt)
                        @if (!empty($question->$opt))
                            <div>


                                @php
                                    $inputId = 'option_' . $question->id . '_' . $opt;
                                @endphp

                                <div>
                                    <input type="radio" name="answer" id="{{ $inputId }}"
                                        value="{{ in_array($question->id, $progressBarQuestions) ? intval(str_replace('option_', '', $opt)) : $question->$opt }}"
                                        {{ old('answer', $selectedAnswer) == (in_array($question->id, $progressBarQuestions) ? intval(str_replace('option_', '', $opt)) : $question->$opt) ? 'checked' : '' }}
                                        class="hidden peer" required>

                                    <label for="{{ $inputId }}" style="border-color: #570807 !important;"
                                        class="flex items-center justify-between border-2 rounded-xl px-4 py-3 bg-[#f0f6f3] cursor-pointer hover:bg-[rgba(161,29,29,0.15)] peer-checked:bg-[rgba(161,29,29,0.15)] transition">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-gray-800">{{ $question->$opt }}</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="flex justify-center mt-8 space-x-4">
                    @if ($question->id > 1)
                        <a href="{{ route('questionnaire.show', ['id' => $question->id - 1]) }}"
                            class="px-6 py-2 border border-red-900 text-red-900 rounded-md">Mundur</a>
                    @endif
                    @if ($question->id < 12)
                        <!-- Kalau belum pertanyaan terakhir -->
                        <button type="submit" class="px-6 py-2 bg-red-900 text-white rounded-md">Lanjut →</button>
                    @else
                        <!-- Kalau sudah pertanyaan terakhir -->
                        <button type="submit" class="px-6 py-2 bg-[#88A825] text-white rounded-md">Kirim</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
