<style>
    .fa-star-wrapper {
        position: relative;
        display: inline-block;
        width: 1em;
        height: 1em;
        margin-right: 0.2em;
    }

    .fa-star-empty,
    .fa-star-filled {
        position: absolute;
        top: 0;
        left: 0;
        font-size: 12px;
    }

    .fa-star-empty {
        color: #e4e5e9;
    }

    .fa-star-filled {
        color: #facc15;
        /* Tailwind's yellow-400 */
        overflow: hidden;
        white-space: nowrap;
    }
</style>

<span class="flex items-end mt-1">
    @for ($i = 0; $i < 5; $i++)
        @php
            $fill = min(max($rating - $i, 0), 1) * 100;
        @endphp


        <span class="fa-star-wrapper">
            <i class="far fa-star fa-star-empty"></i>
            <i class="fas fa-star fa-star-filled" style="width: {{ $fill }}%;"></i>
        </span>
    @endfor
</span>
