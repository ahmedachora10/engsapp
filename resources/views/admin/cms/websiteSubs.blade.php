@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <form id="website_cms_main" method="POST"
                action="{{ route('admin.cms.update', ['page_name' => $page_name]) }}">
                @csrf
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header">

                        <div class="card-title">
                            <h3 class="card-label">{{ $page_name_text }}
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-primary font-weight-bolder">
                                <i class="ki ki-check icon-xs"></i>حفظ التعديلات</button>
                        </div>
                    </div>
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
                        @foreach ($content as $sectionKey => $sectionValue)

                            @if (!$loop->first)
                                <div class="separator separator-dashed my-5"></div>
                            @endif
                            <div class="alert alert-custom alert-default" role="alert">
                                <div class="alert-icon">
                                    <i class="icon-xl la la-angle-double-left"></i>
                                </div>
                                <div class="alert-text">{{ $sectionKey }}</div>
                            </div>
                            @foreach ($sectionValue as $pargraph)
                                <div class="form-group row">
                                    <label
                                        class="col-form-label text-lg-right col-lg-3 col-sm-12 font-weight-bolder">{{ $pargraph->paragraph_name_text }}</label>
                                    <div class="col-lg-9 col-md-12 col-sm-12">
                                        @if (strpos($pargraph->paragraph_name, 'count_') !== false)
                                            <input class="form-control" name="{{ $pargraph->paragraph_name }}"
                                                type="number" value="{{ $pargraph->content_ar }}"
                                                id="example-number-input">
                                        @elseif (strpos($pargraph->paragraph_name, 'subs_enabled') !== false)
                                            <div class="form-group mb-0">
                                                <span class="switch switch-icon">
                                                    <label>
                                                        <input type="checkbox"
                                                            {{ $pargraph->content_ar == '1' ? 'checked="checked"' : '' }}
                                                            name="{{ $pargraph->paragraph_name }}" />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        @elseif (strpos($pargraph->paragraph_name, '_curr') !== false ||
                                            strpos($pargraph->paragraph_name, '_price') !== false)
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة العربية</span>
                                                <input class="form-control" name="{{ $pargraph->paragraph_name }}_ar"
                                                    type="text" value="{{ $pargraph->content_ar }}"
                                                    id="example-number-input{{ $loop->parent->iteration }}">
                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                                <input class="form-control" name="{{ $pargraph->paragraph_name }}_en"
                                                    type="text" value="{{ $pargraph->content_en }}"
                                                    id="example-number-input{{ $loop->parent->iteration }}">
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة العربية</span>
                                                <textarea class="form-control autosise_textarea"
                                                    id="kt_autosize_{{ $loop->parent->iteration }}" rows="3"
                                                    name="{{ $pargraph->paragraph_name }}_ar"
                                                    style="overflow: hidden; overflow-wrap: break-word; resize: none;">{{ $pargraph->content_ar }}</textarea>
                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                                <textarea class="form-control autosise_textarea"
                                                    id="kt_autosize_{{ $loop->parent->iteration }}" rows="3"
                                                    name="{{ $pargraph->paragraph_name }}_en"
                                                    style="overflow: hidden; overflow-wrap: break-word; resize: none;">{{ $pargraph->content_en }}</textarea>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {

            var demo1 = $('.autosise_textarea');
            autosize(demo1);
            autosize.update(demo1);
            var validation = FormValidation.formValidation(
                document.getElementById('website_cms_main'), {
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );

            $.each($('input[type=number], input[type=text], textarea'), function(key, ele) {
                validation.addField(ele.name, {
                    validators: {
                        notEmpty: {
                            message: 'الحقل الزامي'
                        }
                    }
                });
            });

        });

    </script>
@endpush
