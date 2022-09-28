@foreach ($services as $service)
    <li>
        <div class="checkbox-control">
            <input class="styled-checkbox" id="service{{ $service->id }}" type="checkbox" name="selectedservices[]"
                value="{{ $service->id }}">
            <label for="service{{ $service->id }}">
                <span class="ml-3 text">{{ $service->name }}</span>
                <span class="background"></span>
            </label>
        </div>
    </li>
@endforeach
