{{-- <div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">اسم المرسل</div>
    <div class="col-md-8">{{ $message->name }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">الايميل</div>
    <div class="col-md-8">{{ $message->email }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">تاريخ الارسال</div>
    <div class="col-md-8">{{ $message->created_at }}</div>
</div> --}}

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">العنوان (باللغة العربية)</div>
    <div class="col-md-8">{{ $slide->title_ar }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">العنوان (باللغة الانجليزية)</div>
    <div class="col-md-8">{{ $slide->title_en }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">الترتيب</div>
    <div class="col-md-8">{{ $slide->order }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">تاريخ الاضافة</div>
    <div class="col-md-8">{{ $slide->created_at }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">الحالة</div>
    <div class="col-md-8">
        @if ($slide->isenabled)
            <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
        @else
            <span class="label label-lg font-weight-boldlabel-light-primary label-inline">غير فعال</span>
        @endif
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">وصف قصير (باللغة العربية)</div>
    <div class="col-md-8">{{ $slide->small_desc_ar }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">وصف قصير (باللغة الانجليزية)</div>
    <div class="col-md-8">{{ $slide->small_desc_en }}</div>
</div>

<div class="row mb-3">
    <div class="col-md-12 border-bottom font-weight-bolder mb-4 pb-4">التفاصيل (باللغة العربية)</div>
    <div class="col-md-12">
        @foreach (explode(PHP_EOL, $slide->desc_ar) as $item)
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="label label-dot label-light-dark mr-3"></span> {{ $item }}</li>
            </ul>
        @endforeach
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12 border-bottom font-weight-bolder mb-4 pb-4">التفاصيل (باللغة الانجليزية)</div>
    <div class="col-md-12">
        @foreach (explode(PHP_EOL, $slide->desc_en) as $item)
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="label label-dot label-light-dark mr-3"></span> {{ $item }}</li>
            </ul>
        @endforeach
    </div>

</div>

<div class="row mb-3">
    <div class="col-md-12 border-bottom font-weight-bolder mb-4 border-top pt-4 pb-4">صورة المقال</div>
    <div class="col-md-12">
        <a class="text-center d-block" href="{{ asset('storage/' . $slide->image) }}" target="_blank">
            <img class="img-fluid rounded" style="max-height: 250px;" src="{{ asset('storage/' . $slide->image) }}"
                alt="">
        </a>
    </div>
</div>
