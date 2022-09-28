<div class="col-md-6 border-left-form">
    <div class="form-group">
        <label for="freelancername">{{ __('form.freelancername') }}</label>
        <span class="has-icon person-icon">
            <input type="text" class="form-control" id="freelancername" name="freelancername" required
                value="{{ auth()->user()->name }}" placeholder="{{ __('form.freelancername') }}">
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
        <label>{{ __('form.occupation') }}</label>

        <div class="row">
            <div class="col-6 p-0 mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="civilengineer"
                        {{ auth()->user()->operatorProfile->occupation == 'civil' ? 'checked' : '' }}
                        name="occupation" value="civil">
                    <label class="custom-control-label" for="civilengineer">{{ __('form.civilengineer') }}</label>
                </div>
            </div>
            <div class="col-6 p-0 mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"
                        {{ auth()->user()->operatorProfile->occupation == 'architect' ? 'checked' : '' }}
                        id="architect" name="occupation" value="architect">
                    <label class="custom-control-label" for="architect">{{ __('form.architect') }}</label>
                </div>
            </div>
            <div class="col-6 p-0  mb-1">
                <div class="custom-control custom-radio">

                    <input type="radio" class="custom-control-input" id="Space_engineer" name="occupation"
                           {{ auth()->user()->operatorProfile->occupation  == 'space' ? 'checked="checked"' : '' }}
                           value="space">
                    <label class="custom-control-label"
                           for="Space_engineer">{{ __('form.spaceengineer') }}</label>
                </div>
            </div>
            <div class="col-6 p-0 mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="electrical" name="occupation"
                           {{ auth()->user()->operatorProfile->occupation   == 'electrical' ? 'checked="checked"' : '' }}
                           value="electrical">
                    <label class="custom-control-label" for="electrical">{{ __('form.electrical') }}</label>
                </div>
            </div>
            <div class="col-6 p-0 mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="mechanical" name="occupation"
                           {{ auth()->user()->operatorProfile->occupation    == 'mechanical'? 'checked="checked"' : '' }}
                           value="mechanical">
                    <label class="custom-control-label" for="mechanical">{{ __('form.mechanical') }}</label>
                </div>
            </div>
            <div class="col-6 p-0 mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="industrial" name="occupation"
                           {{ auth()->user()->operatorProfile->occupation   == 'industrial' ? 'checked="checked"' : '' }}
                           value="industrial">
                    <label class="custom-control-label" for="industrial">{{ __('form.industrial') }}</label>
                </div>
            </div>
        </div>
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
        <label for="membershipid">{{ __('form.membershipid') }}</label>
        <span class="has-icon card-icon">
            <input type="text" class="form-control font-Roboto" id="membershipid" required data-rule-number="true"
                name="membershipid" placeholder="{{ __('form.placeholders.membershipid') }}"
                value="{{ auth()->user()->operatorProfile->membershipId }}">
        </span>
    </div>
    <div class="form-group">
        <label for="typeofcompany">{{ __('form.admissiontype') }}</label>
        <div class="has-icon card-icon">
            <select class="custom-select" required id="admissiontype" name="admissiontype">
                <option value="" disabled selected>تحديد نوع الاعتماد</option>
                @foreach ($companyAdmissions as $admissionType)
                    @if (isset(auth()->user()->operatorProfile->admission_id) && auth()->user()->operatorProfile->admission_id == $admissionType->id)
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
        <label for="membershipattachment">{{ __('form.membershipattachment') }}</label>
        <div class="custom-file has-icon attachment-icon">
            <input type="file" class="custom-file-input" id="membershipattachment" accept="image/jpeg,application/pdf"
                name="membershipattachment">
            <label class="custom-file-label" for="customFile">{{ __('form.placeholders.attachmentjpgpdf') }}</label>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-between operatorLicenceStatus flex-wrap">
        <div class="file-uploaded d-flex flex-row align-items-center mr-2">
            <span class="mr-2">
                @php
                    $extention = strtolower(pathinfo(auth()->user()->operatorProfile->membership_copy, PATHINFO_EXTENSION));
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
            <span class="text">{{ auth()->user()->operatorProfile->membership_copy_filename }}</span>
        </div>
        <div class="file-status d-flex flex-row align-items-center">
            @if (auth()->user()->operatorProfile->membership_confirmed)
                <img class="mr-2" src="{{ asset('images/check-small.svg') }}" alt="">
                <span>تم الاعتماد</span>
            @else
                <img class="mr-2" src="{{ asset('images/empty-check.svg') }}" alt="">
                <span>غير معتمد</span>
            @endif
        </div>
    </div>
</div>
