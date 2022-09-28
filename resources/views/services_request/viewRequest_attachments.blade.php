@if ($attachments->count() > 0)
    <div class="row no-gutters px-4 mb-4">
        <div class="col-md-12">
            <h5 class="font-weight-bold">ملفات مرفقة</h5>
        </div>
    </div>
    <div class="row no-gutters bg-white py-4 mb-4">
        <div class="col-md-12 px-5">
            <div class="project-attachments">
                <ul>
                    @foreach ($attachments as $attachment)
                        @include('services_request.viewRequest_attachments_item',['attachment'=>$attachment])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
