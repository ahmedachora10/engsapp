<div class="row justify-content-center no-gutters">
    <div class="col-lg-5 col-md-11">
        <form id="freelancer-register" method="post" enctype="multipart/form-data"
            action="{{ route('register.freelancer') }}">
            @csrf
            <div class="form-group">
                <label for="freelancername">{{ __('form.freelancername') }}</label>
                <span class="has-icon person-icon">
                    <input type="text" class="form-control" id="freelancername" name="freelancername" required
                        value="{{ old('freelancername') }}" placeholder="{{ __('form.freelancername') }}">
                </span>
            </div>
            <div class="form-group">
                <label for="freelanceremail">{{ __('form.username') }}</label>
                <span class="has-icon email-icon">
                    <input type="email" class="form-control" id="freelanceremail" name="freelanceremail" required
                        value="{{ old('freelanceremail') }}" placeholder="{{ __('form.placeholders.email') }}">
                </span>
                @error('freelanceremail', 'freelancer')
                    <div id="freelanceremail-error" class="invalid-feedback" style="display: block;">{{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="freelancermobilenumber">{{ __('form.mobilenumber') }}</label>
                <div class="has-icon has-dropdown-number phone-icon">
                    <input type="text" class="form-control" id="freelancermobilenumber"
                        value="{{ old('freelancermobilenumber') }}" name="freelancermobilenumber" required
                        placeholder="{{ __('form.mobilenumber') }}">
                    <div class="selector-container">
                        <select class="custom-select" id="freelancermobilecountrycode"
                            name="freelancermobilecountrycode">
                            @foreach ($countriesCode as $country)
                                @if (isset($defaultCode) && $country->code == $defaultCode && old('freelancermobilecountrycode') == null)
                                    <option value="{{ $defaultCode }}" selected>{{ $defaultCode }}</option>
                                @elseif (old('freelancermobilecountrycode') == $country->code)
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
                <label for="membershipid">{{ __('form.UDId') }}</label>
                <span class="has-icon card-icon">
                    <input type="text" class="form-control enNumbers" id="membershipid"
                        value="{{ old('membershipid') }}" required data-rule-number="true" name="membershipid"
                        placeholder="{{ __('form.UDId') }}">
                </span>
            </div>

            <div class="form-group">
                <label>{{ __('form.occupation') }}</label>
                <div class="row">
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">

                            <input type="radio" class="custom-control-input" id="civilengineer" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'civil' ? 'checked="checked"' : '') : '' }}
                                value="civil">
                            <label class="custom-control-label"
                                for="civilengineer">{{ __('form.civilengineer') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="architect" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'architect' ? 'checked="checked"' : '') : '' }}
                                value="architect">
                            <label class="custom-control-label" for="architect">{{ __('form.architect') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0  mb-1">
                        <div class="custom-control custom-radio">

                            <input type="radio" class="custom-control-input" id="Space_engineer" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'space' ? 'checked="checked"' : '') : '' }}
                                value="space">
                            <label class="custom-control-label"
                                for="Space_engineer">{{ __('form.spaceengineer') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="electrical" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'electrical' ? 'checked="checked"' : '') : '' }}
                                value="electrical">
                            <label class="custom-control-label" for="electrical">{{ __('form.electrical') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="mechanical" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'mechanical' ? 'checked="checked"' : '') : '' }}
                                value="mechanical">
                            <label class="custom-control-label" for="mechanical">{{ __('form.mechanical') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="industrial" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'industrial' ? 'checked="checked"' : '') : '' }}
                                value="industrial">
                            <label class="custom-control-label" for="industrial">{{ __('form.industrial') }}</label>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="planning" name="occupation"
                                {{ old('occupation') != null ? (old('occupation') == 'planning' ? 'checked="checked"' : '') : '' }}
                                value="planning">
                            <label class="custom-control-label" for="planning">{{ __('form.planning') }}</label>
                        </div>
                    </div>
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
                <label for="membershipattachment">{{ __('form.membershipattachment') }}</label>
                <div class="custom-file has-icon attachment-icon">
                    <input type="file" class="custom-file-input" id="membershipattachment"
                        accept="image/jpeg,image/png,application/pdf" name="membershipattachment">
                    <label class="custom-file-label"
                        for="customFile">{{ __('form.placeholders.attachmentjpgpdf') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="freelancepassword">{{ __('form.password') }}</label>
                <span class="has-icon lock-icon">
                    <input type="password" required class="form-control" id="freelancepassword" name="freelancepassword"
                        placeholder="*********">
                </span>
            </div>
            <div class="form-row justify-content-center mt-4 pb-5">
                <div class="col-5 col-lg-6">
                    <button class="btn btn-primary has-shadow btn-40 font-weight-bold"
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
            <p>يجب على المهندس المستقل انشاء حساب حتى يتمكن من الاستفادة من خدمات المنصة من خلال لوحة التحكم الخاصة به </p>
            <br>
{{--            <p>علما بأنه لا يوجد رسوم للاشتراك مع امكانية الاستفادة من خدمات المنصة بشكل مجاني </p>--}}
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
