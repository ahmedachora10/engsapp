@for ($i = 1; $i <= 5; $i++)
    <li class="{{ $i <= $rate ? 'active' : '' }}">
        <span></span>
    </li>
@endfor
