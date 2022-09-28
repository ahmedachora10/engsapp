<div class="row justify-content-center no-gutters">
    <div class="col-lg-5 col-md-11">
        <form id="company-register" method="post" enctype="multipart/form-data"
            action="{{ route('register.company') }}">
            @csrf
            <div class="form-group">
                <label for="companyname">{{ __('form.companyname') }}</label>
                <span class="has-icon person-icon">
                    <input type="text" class="form-control" id="companyname" name="companyname" required
                        value="{{ old('companyname') }}" placeholder="{{ __('form.companyname') }}">
                </span>
            </div>
            <div class="form-group">
                <label for="companyemail">{{ __('form.username') }}</label>
                <span class="has-icon email-icon">
                    <input type="email" class="form-control" id="companyemail" name="companyemail" required
                        value="{{ old('companyemail') }}" placeholder="{{ __('form.placeholders.email') }}">
                </span>
                @error('companyemail', 'company')
                    <div id="companyemail-error" class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobilenumber">{{ __('form.mobilenumber') }}</label>
                <div class="has-icon has-dropdown-number phone-icon">
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" required
                        data-rule-number="true" placeholder="{{ __('form.mobilenumber') }}"
                        value="{{ old('mobilenumber') }}">
                    <div class="selector-container">
                        <select class="custom-select" id="companymobilecountrycode" name="companymobilecountrycode">
                            @foreach ($countriesCode as $country)
                                @if (isset($defaultCode) && $country->code == $defaultCode && old('companymobilecountrycode') == null)
                                    <option value="{{ $defaultCode }}" selected>{{ $defaultCode }}</option>
                                @elseif (old('companymobilecountrycode') == $country->code)
                                    <option value="{{ $country->code }}" selected>{{ $country->code }}</option>
                                @else
                                    <option value="{{ $country->code }}">{{ $country->code }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="licencenumber">{{ __('form.licencenumber') }}</label>
                <span class="has-icon card-icon ">
                    <input type="text" class="form-control enNumbers" id="licencenumber" name="licencenumber" required
                        value="{{ old('licencenumber') }}" data-rule-number="true"
                        placeholder="{{ __('form.licencenumber_pla') }}">
                </span>
            </div>
            <div class="form-group">
                <label for="fileattachmen">{{ __('form.licenceattachment') }}</label>
                <div class="custom-file has-icon attachment-icon">
                    <input type="file" class="custom-file-input" accept="image/jpeg,image/png,application/pdf"
                        id="companylicencefile" name="companylicencefile">
                    <label class="custom-file-label"
                        for="companylicencefile">{{ __('form.placeholders.attachmentjpgpdf') }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="typeofcompany">{{ __('form.admissiontype') }}</label>
                <div class="has-icon card-icon">
                    <select class="custom-select" required id="admissiontype" name="admissiontype">
                        <option value="" disabled selected>تحديد نوع الاعتماد</option>
                        @foreach ($companyAdmissions as $admissionType)
                            @if (old('companymobilecountrycode') != null)
                                <option selected value="{{ $admissionType->id }}">{{ $admissionType->name }}
                                </option>
                            @else
                                <option value="{{ $admissionType->id }}">{{ $admissionType->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="companypassword">{{ __('form.password') }}</label>
                <span class="has-icon lock-icon">
                    <input type="password" class="form-control" id="companypassword" name="companypassword" required
                        placeholder="*********">
                </span>
            </div>
            <div class="form-row justify-content-center mt-4 pb-5">
                <div class="col-5 col-lg-6">
                    <button id="btnComapnySubmit" type="submit"
                        class="btn btn-primary has-shadow btn-40 font-weight-bold"
                        type="submit">{{ __('form.buttons.create') }}</button>
                </div>
                <div class="col-5 col-lg-6 d-flex justify-content-center">
                    <a href="{{ route('auth.login') }}"
                        class="btn btn-40 font-weight-bold">{{ __('main.signin') }}</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-5 offset-lg-1">
        <h5 class="mt-4 text-danger mb-1">{{ __('form.notice') }}</h5>
        <div class="notice-msg">
            <p> يجب على المكتب الهندسي انشاء حساب حتى يتمكن من الاستفادة من خدمات المنصة من خلال لوحة التحكم الخاصة به </p>
            <br>
{{--            <p> علما بأن رسوم الاشتراك مجانا لمدة 6 أشهر مع إمكانية الاستفادة من جميع الخدمات مجانا خلال هذه الفترة</p>--}}
        </div>
{{--        <div class="align-items-center d-flex flex-row justify-content-between p-4 register-notice mt-5">--}}
{{--            <div class="circle-container">--}}
{{--                <span class="circle-1"></span>--}}
{{--                <span class="circle-2"></span>--}}
{{--            </div>--}}
{{--            <div class="register-img">--}}
{{--                <img src="{{ asset('images/wallet-img.svg') }}" alt="">--}}
{{--            </div>--}}
{{--            <div class="text-content">--}}
{{--                <h2 class="mb-3">{{ __('form.price') }}</h2>--}}
{{--                <div class="subs-price">--}}
{{--                    <span class="price">--}}
{{--                        0.0--}}
{{--                    </span>--}}
{{--                    <span class="currency">{{ __('form.currmonthly') }}</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <img class="pricebox-shadow" src="{{ asset('images/pricebox-shadow.svg') }}" alt="">
        <a href="{{ route('terms') }}" class="plan-link d-block">{{ __('form.subscriptionplans') }}</a>
    </div>
</div>
