<a href="{{ $userLink }}" target="_blank" id="btnViewId_{{ $user->id }}"
    class="btn btn-sm btn-clean btn-icon btnViewJob" title="عرض"><i class="la la-eye"></i>
</a>
{{-- <div class="dropdown dropdown-inline">
    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon dropdown-List_{{ $user->id }}"
        data-toggle="dropdown" aria-expanded="false">
        <i class="la la-cog"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="display: none;">
        <ul class="nav nav-hoverable flex-column">
            <li class="nav-item">
                <form class="nav-link mb-0 btnActiveUserFromList" id="ActiveUserFormId_{{ $user->id }}"
                    method="POST" action="{{ route('admin.users.updateActiveStatus') }}">
                    <input type="hidden" name="userId" value="{{ $user->id }}">
                    <span class="nav-text">حالة الحساب</span>
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" checked="checked" class="TestClass" name="confirmed" />
                            <span></span>
                        </label>
                    </span>
                </form>
            </li>
        </ul>
    </div>
</div> --}}
