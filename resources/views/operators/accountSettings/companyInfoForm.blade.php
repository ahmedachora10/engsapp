<div class="col-md-6 border-left-form">
    <div class="form-group">
        <label for="companyname">{{ __('form.companyname') }}</label>
        <span class="has-icon person-icon">
            <input type="text" class="form-control" id="companyname" name="companyname"
                value="{{ auth()->user()->name }}" required placeholder="{{ __('form.companyname') }}">
        </span>
    </div>
    <div class="form-group">
        <label for="companyowner">أسم مالك الشركة</label>
        <span class="has-icon person-icon">
            <input type="text" class="form-control" id="companyowner" name="companyowner"
                value="{{ auth()->user()->operatorProfile->owner_name }}" required placeholder="">
        </span>
    </div>
    <div class="form-group">
        <label for="email">{{ __('form.username') }}</label>
        <span class="has-icon email-icon">
            <input type="email" class="form-control" id="email" name="email" disabled="disabled"
                value="{{ auth()->user()->email }}">
        </span>
    </div>
    <div class="form-group">
        <label for="contact_person_name">اسم مسئول التواصل</label>
        <span class="has-icon person-icon">
            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name"
                value="{{ auth()->user()->operatorProfile->contact_person_name }}" required
                placeholder="{{ __('form.companyname') }}">
        </span>
    </div>
</div>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">المدينة</label>

            <input type="text" class="form-control" id="city" name="city" required placeholder=""
                   value="{{ auth()->user()->operatorProfile->city }}">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">المنطقة</label>

            <input type="text" class="form-control" id="area" name="area" required placeholder=""
                   value="{{ auth()->user()->operatorProfile->area }}">

            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="licencenumber">{{ __('form.licencenumber') }}</label>
        <span class="has-icon card-icon">
            <input type="text" class="form-control font-Roboto" id="licencenumber" name="licencenumber" required
                data-rule-number="true" value="{{ auth()->user()->operatorProfile->licensenumber }}"
                placeholder="{{ __('form.licencenumber') }}">
        </span>
    </div>
    <div class="form-group">
        <label for="typeofcompany">{{ __('form.admissiontype') }}</label>
        <div class="has-icon card-icon">
            <select class="custom-select" required id="admissiontype" name="admissiontype">
                <option value="" disabled selected>تحديد نوع الاعتماد</option>
                @foreach ($companyAdmissions as $admissionType)
                    @if (isset(auth()->user()->operatorProfile->company_admission_id) && auth()->user()->operatorProfile->company_admission_id == $admissionType->id)
                        <option selected value="{{ $admissionType->id }}">
                            {{ $admissionType->name }}
                        </option>
                    @else
                        <option value="{{ $admissionType->id }}">
                            {{ $admissionType->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="fileattachmen">{{ __('form.licenceattachment') }}</label>
        <div class="custom-file has-icon attachment-icon">
            <input type="file" class="custom-file-input" accept="image/jpeg,application/pdf" id="companylicencefile"
                name="companylicencefile">
            <label class="custom-file-label"
                for="companylicencefile">{{ __('form.placeholders.attachmentjpgpdf') }}</label>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-between operatorLicenceStatus flex-wrap">
        <div class="file-uploaded d-flex flex-row align-items-center mr-2">
            <span class="mr-2">
                @php
                    $extention = strtolower(pathinfo(auth()->user()->operatorProfile->license_copy, PATHINFO_EXTENSION));
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
            <span class="text">{{ auth()->user()->operatorProfile->licence_copy_fileName }}</span>
        </div>
        <div class="file-status d-flex flex-row align-items-center">
            @if (auth()->user()->operatorProfile->licence_confirmed)
                <img class="mr-2" src="{{ asset('images/check-small.svg') }}" alt="">
                <span>تم الاعتماد</span>
            @else
                <img class="mr-2" src="{{ asset('images/empty-check.svg') }}" alt="">
                <span>غير معتمد</span>
            @endif
        </div>
    </div>
</div>
