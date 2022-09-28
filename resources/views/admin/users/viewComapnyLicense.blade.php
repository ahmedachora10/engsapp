@extends('admin.users.viewUserLayout')

@section('aside')
    <!--begin::Aside-->
    @include('admin.users.viewUserSidebar',['user'=> $user, 'profileImg'=>$profileImg, 'currentPage' => $currentPage])
    <!--end::Aside-->
@endsection

@section('UserContent')
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">الرخصة الهندسية</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">ترخيص مزاولة المهنة للمكتب الهندسي</span>
                </div>
                <div class="card-toolbar">
                    <button type="reset" type="submit" class="btn btn-success mr-2 btnSubmitUserDetailsForm">حفظ</button>
                    {{-- <button type="reset" class="btn btn-secondary">الغاء الامر</button> --}}
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" id="userDetailsForm" method="post"
                action="{{ route('admin.company.license', ['userId' => $user->id]) }}">
                @csrf
                <!--begin::Body-->
                {{-- <input type="hidden" name="userId" value="{{ $user->id }}"> --}}
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                            <div class="alert-icon">
                                <i class="flaticon-success"></i>
                            </div>
                            <div class="alert-text"> {{ session()->get('success') }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="ki ki-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @foreach ($fields as $key => $section)
                        {{-- <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bolder {{ $loop->first ? '' : 'mt-10' }} mb-6">{{ $key }}
                                </h5>
                            </div>
                        </div> --}}
                        @foreach ($section as $field)

                            @if ($field->type == 'checkbox')
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ $field->title }}</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="d-flex flex-row">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox" id={{ $field->id }} name={{ $field->id }}
                                                        {{ $field->value == true ? 'checked="checked"' : '' }} />
                                                    <span></span>
                                                </label>
                                            </span>
                                            @if ($field->value == true)
                                                <span class="label label-xl label-light-success label-inline ml-3">
                                                    فعال
                                                </span>
                                            @else
                                                <span class="label label-xl label-light-danger label-inline ml-3">
                                                    غير فعال
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @elseif($field->type == 'link')
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ $field->title }}</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <a href="{{ $field->value }}" target="_blank" data-container="body"
                                            data-toggle="popover" data-placement="left" title="تنبيه" data-html="true"
                                            data-content="سيتم فتح او تحميل الملف من خلال نافذة منبثقة"
                                            class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-warning font-weight-bold btn-hover-bg-light">
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                                            fill="#000000" opacity="0.3"
                                                            transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                                        <path
                                                            d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                                            fill="#000000"
                                                            transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                                    </g>
                                                </svg>
                                            </span>عرض {{ $field->text }}</a>
                                    </div>
                                </div>
                            @elseif ($field->type == 'text')
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ $field->title }}</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input class="form-control form-control-lg form-control-solid" readonly
                                            id={{ $field->id }} name={{ $field->id }} type="text"
                                            value="{{ $field->value }}" />
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
@endsection
