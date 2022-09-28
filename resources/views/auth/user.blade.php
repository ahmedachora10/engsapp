<div class="row justify-content-center no-gutters">
    <div class="col-lg-5 col-md-11">
        <form id="user-register" method="POST" action="{{ route('register.user') }}">
            @csrf
            <div class="form-group">
                <label for="nameforuser">{{ __('form.nameforuser') }}</label>
                <span class="has-icon person-icon">
                    <input type="text" class="form-control" id="nameforuser" name="nameforuser" required
                        value="{{ old('nameforuser') }}" placeholder="{{ __('form.nameforuser') }}">
                </span>
            </div>
            <div class="form-group @error('username') is-invalid @enderror">
                <label for="useremail">{{ __('form.username') }}</label>
                <span class="has-icon email-icon">
                    <input type="email" class="form-control" id="useremail" name="useremail" required
                        placeholder="{{ __('form.placeholders.email') }}">
                </span>
                @error('useremail', 'user')
                    <div id="useremail-error" class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="usermobilenumber">{{ __('form.mobilenumber') }}</label>
                <div class="has-icon has-dropdown-number phone-icon">
                    <input type="text" class="form-control" id="usermobilenumber" name="usermobilenumber" required
                        value="{{ old('usermobilenumber') }}" data-rule-number="true"
                        placeholder="{{ __('form.mobilenumber') }}">
                    <div class="selector-container">
                        <select class="custom-select" id="usermobilecountrycode" name="usermobilecountrycode">
                            @foreach ($countriesCode as $country)
                                @if (isset($defaultCode) && $country->code == $defaultCode && old('usermobilecountrycode') == null)
                                    <option value="{{ $defaultCode }}" selected>{{ $defaultCode }}</option>
                                @elseif (old('usermobilecountrycode') == $country->code)
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
                <label for="userpassword">{{ __('form.password') }}</label>
                <span class="has-icon lock-icon">
                    <input type="password" class="form-control" id="userpassword" name="userpassword" required
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
            <p>يجيب انشاء حساب حتي تتمتكن من إضافة المشاريع او عرض المشاريع من خلال لوحة تحكم
                خاصه
                بك </p>
            <br>
            <p>الرجاء استكمال ملفك الشخصي من لوحة التحكم
                بعد التسجيل لتتمكن من استخدام الخدمات </p>
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
