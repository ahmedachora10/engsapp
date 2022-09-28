<div class="container chatTab">
    <div class="row">
        <div class="col-lg-12 p-0 px-xl-3">
            <div class="row no-gutters px-4 mb-2">
                <div class="col-md-12">
                    <h5 class="font-weight-bold">المحادثة مع الجهة المنفذه</h5>
                </div>
            </div>
            <div class="row no-gutters chat-msgs bg-white px-3 mb-3 py-5 chatList">
                @if ($chatMessages)
                    {!! $chatMessages !!}
                @else
                    <h5 class="text-center">لا يوجد رسائل محادثة سابقة لعرضها</h5>
                @endif
            </div>
            <form id="sendMsgForm"
                action="{{ route('request.sendchatmsg', ['service_request' => $service_request_id, 'offer' => $offerId]) }}"
                method="POST" class="row no-gutters chat-msgs bg-white px-3 mb-3 py-4 justify-content-center">
                <x-alert />
                <div class="align-items-center col-md-1 d-flex justify-content-center text-center">
                    <h5 class="font-weight-bold">إضافة رد</h5>
                </div>
                <div class="col-md-10 d-flex align-items-center">
                    <div class="flex-fill pl-md-3 px-3">
                        <div class="form-group mb-0">
                            <textarea id="message" name="message" class="form-control p-3" cols="30" rows="7"
                                required></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-1"></div>
                <div class="col-md-10 mt-3">
                    <div class="row no-gutters justify-content-between">
                        <div class="col-md-4 pl-md-3 px-3">
                            <div class="chat-msgs-fileupload ">
                                <div class="form-group">
                                    <div class="custom-file has-icon attachment-icon">
                                        <input type="file" class="custom-file-input"
                                            id="chat_attachment" name="chat_attachment">
                                        <label class="custom-file-label" for="chat_attachment">يمكنك ارفاق
                                            ملف</label>
                                    </div>
                                    <p class="chat-msgs-file-upload mt-2 ml-2">
                                        <span>
                                            ارفاق ملف
                                        </span>
                                        <span class="roboto">(pdf-doc-jpg-dwg)</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary has-shadow btn-send-msg btn-s-40">
                                <span class="text">
                                    ارسال
                                </span>
                                <div class="loading-animate">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
