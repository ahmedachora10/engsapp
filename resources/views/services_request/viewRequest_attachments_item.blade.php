<li>
    <a href="{{ asset('request_files/' . $attachment->hashName) }}" target="_blank"
        class="d-flex flex-row align-items-center">
        <span class="number">{{ sprintf('%02d', $loop->iteration) }}</span>
        <span class="icon mx-2">
            @php
                $extention = strtolower(pathinfo($attachment->filename, PATHINFO_EXTENSION));
            @endphp
            @switch($extention)
                @case('pdf')
                <img src="{{ asset('images/pdf.png') }}" alt="">
                @break
                @case($extention == 'jpg'|| $extention =='jpeg')
                <img src="{{ asset('images/jpg.png') }}" alt="">
                @break
                @case('doc')
                <img src="{{ asset('images/doc.png') }}" alt="">
                @break
                @case('pdf')
                <img src="{{ asset('images/pdf.png') }}" alt="">
                @break
                @default
                <img src="{{ asset('images/pdf.png') }}" alt="">
            @endswitch
        </span>
        <span class="text">{{ pathinfo($attachment->filename, PATHINFO_FILENAME) }}</span>
    </a>
</li>
