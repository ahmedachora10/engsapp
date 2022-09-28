<form id="AddEditUserForm" action="{{ route('admin.adminusers.addedituser') }}" method="post">
    <input type="hidden" name="user_id" value="{{ isset($user->id) ? $user->id : '' }}">
    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-form-label font-weight-bolder col-3 text-lg-right text-left">اسم المستخدم</label>
        <div class="col-9">
            <input class="form-control" type="text" name="name" value="{{ isset($user->name) ? $user->name : '' }}" />
        </div>
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-form-label font-weight-bolder col-3 text-lg-right text-left">الايميل</label>
        <div class="col-9">
            <input class="form-control" {{ isset($user->email) ? 'disabled="disabled"' : '' }} type="text"
                name="email" value="{{ isset($user->email) ? $user->email : '' }}" />
        </div>
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-form-label font-weight-bolder col-3 text-lg-right text-left">كلمة المرور</label>
        <div class="col-9">
            <input class="form-control" type="password" value="" name="password" />
            @if (isset($user))
                <span class="form-text font-weight-bolder text-muted">في حال تم ادخال حقل كلمة المرور سيتم استبدال كلمة المرور القديمة 
                    بالمدخلة</span>
            @endif
        </div>
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-form-label font-weight-bolder col-3 text-lg-right text-left">الحالة</label>
        <div class="col-9">
            <span class="switch switch-icon">
                <label>
                    <input type="checkbox"
                        {{ isset($user->active) ? ($user->active == true ? 'checked="checked"' : '') : '' }}
                        name="active" />
                    <span></span>
                </label>
            </span>
        </div>
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group row mb-0">
        <label class="col-form-label font-weight-bolder col-12 text-lg-left text-left">صلاحيات المستخدم</label>
        <div class="col-12">
            <select id="kt_dual_listbox_2" class="dual-listbox" data-search="false" name="permissions[]" multiple>
                @foreach ($permissions as $permission)
                    @if (isset($user) && $user->permissions->firstWhere('id', $permission->id))
                        <option selected value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @else
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <!--end::Group-->
</form>
