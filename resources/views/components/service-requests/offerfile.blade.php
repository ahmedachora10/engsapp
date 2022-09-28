<li class="d-flex flex-row justify-content-between align-items-center">
    <div class="d-flex flex-row align-items-center">
        <span class="number">%number%</span>
        <span class="icon mx-2">
            <img src="{{ asset('images') }}/%filetype%" alt="">
        </span>
        <span class="text">%filename%</span>
    </div>
    <div class="d-flex flex-row align-items-center">
        <div class="mr-5">
            <span class="fileUploadStatus">
                <span class="uploadingFile" style="display: none;">
                    <img src="{{ asset('images/spinner.gif') }}" alt="">
                    جاري رفع الملف
                    <span class="font-Roboto percentage ml-2">
                        %75
                    </span>
                </span>
                <span class="uploadingCompleted mr-3" style="display: none;">
                    تم الرفع
                </span>
                <span class="uploadingError text-danger" style="display: none;">
                    حدث مشكلة اثناء رفع الملف !
                </span>
            </span>
        </div>
        <a href="#" class="d-flex btnDeleteOfferAttach" data-filename="%filename%">
            <img src="{{ asset('images/delete.svg') }}" alt="">
        </a>
    </div>
</li>
