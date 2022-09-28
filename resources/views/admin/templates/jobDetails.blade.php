<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">المعلن</div>
    <div class="col-md-8">{{ $jobDetails->company->name }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">اسم الوظيفة</div>
    <div class="col-md-8">{{ $jobDetails->title }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">وصف الوظيفة</div>
    <div class="col-md-8">{{ $jobDetails->desc }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">تاريخ إنشاء</div>
    <div class="col-md-8">{{ $jobDetails->created_at }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">تاريخ نهاية التقديم</div>
    <div class="col-md-8">{{ $jobDetails->deadline }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">البريد الاكتروني</div>
    <div class="col-md-8">{{ $jobDetails->recruiter_email }}</div>
</div>
<div class="row mb-3">
    <div class="col-md-4 border-right-md font-weight-bolder mb-4 mb-md-0">رقم الجوال</div>
    <div class="col-md-8">{{ $jobDetails->recruiter_phone }}</div>
</div>
