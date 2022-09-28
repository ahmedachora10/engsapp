<div class="row mb-3">
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
</div>
<div class="row mb-3">
    <div class="col-md-12 border-bottom font-weight-bolder mb-4 pb-4">الرسالة</div>
    <div class="col-md-12">{{ $message->message }}</div>
</div>
