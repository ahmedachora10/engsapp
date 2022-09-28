<span class="mr-2">
    @php
        $extention = strtolower(pathinfo($hashName, PATHINFO_EXTENSION));
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
<span class="text">{{ $fileName }}</span>
