@foreach ($jobs as $job)
<div class="col-md-6 col-lg-4 mb-4 d-flex jobcard" data-job-id={{ $job->id }}>
    <div class="bg-white d-flex flex-column flex-fill job-card justify-content-between px-3 py-5">
        <div>
            <h2 class="mb-2 jobTitle">{{ $job->title }}</h2>
            <div class="d-flex justify-content-between mb-3">
                <div class="date">
                    {{ date('d-m-Y', strtotime($job->created_at)) }}
                </div>
                <div class="deadline">
                    نهاية التقديم
                    <span class="date red jobDeadline">
                        {{ date('d-m-Y', strtotime($job->deadline)) }}</span>
                </div>
            </div>
            <p class="mb-4 jobDesc">
                {{ $job->desc }}
            </p>
        </div>
        <div>
            <div class="contant-box mb-4">
                <span>للتواصل</span>
            </div>
            @if($job->recruiter_email)
            <div class="company-contact d-flex justify-content-between mb-2">
                <div class="text d-flex">
                    <span class="icon mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16.252" height="11.135"
                            viewBox="0 0 16.252 11.135">
                            <g id="message" opacity="0.6">
                                <g id="Group_15027" data-name="Group 15027">
                                    <path id="Path_7198" data-name="Path 7198"
                                        d="M14.824,80.609H1.428A1.43,1.43,0,0,0,0,82.037v8.278a1.43,1.43,0,0,0,1.428,1.428h13.4a1.43,1.43,0,0,0,1.428-1.428V82.037A1.43,1.43,0,0,0,14.824,80.609Zm-.186.952-.191.159L8.693,86.511a.886.886,0,0,1-1.133,0L1.806,81.72l-.191-.159ZM.952,82.249l4.688,3.9L.952,89.273Zm13.872,8.543H1.428a.477.477,0,0,1-.467-.381L6.4,86.788l.546.455a1.838,1.838,0,0,0,2.352,0l.546-.455,5.442,3.622A.477.477,0,0,1,14.824,90.792Zm.476-1.519-4.688-3.12,4.688-3.9Z"
                                        transform="translate(0 -80.609)" fill="#020621"></path>
                                </g>
                            </g>
                        </svg>

                    </span>
                    البريد الالكتروني
                </div>
                <div class="info text-right jobEmail">{{ $job->recruiter_email }}</div>
            </div>
            @endif

            @if($job->recruiter_phone)
            <div class="company-contact d-flex justify-content-between">
                <div class="text d-flex">
                    <span class="icon mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14.344" height="14.315"
                            viewBox="0 0 14.344 14.315">
                            <path id="call-outline"
                                d="M16.326,13.852a11.787,11.787,0,0,0-2.346-1.567c-.781-.394-.845-.426-1.459.031-.41.3-.681.576-1.161.474A6.215,6.215,0,0,1,8.928,11.2,6.423,6.423,0,0,1,7.3,8.745c-.1-.478.174-.746.475-1.157.425-.579.393-.675.03-1.456a10.676,10.676,0,0,0-1.571-2.34c-.553-.545-.553-.449-.908-.3a5.147,5.147,0,0,0-.83.442,2.49,2.49,0,0,0-1,1.052c-.2.426-.289,1.426.741,3.3a16.337,16.337,0,0,0,3.25,4.322,17.779,17.779,0,0,0,4.33,3.238c2.081,1.165,2.879.938,3.307.739a2.477,2.477,0,0,0,1.055-1,5.113,5.113,0,0,0,.443-.829C16.776,14.4,16.872,14.4,16.326,13.852Z"
                                transform="translate(-2.863 -2.912)" fill="none" stroke="#626577"
                                stroke-miterlimit="10" stroke-width="1"></path>
                        </svg>
                    </span>
                    رقم الجوال
                </div>
                <div class="info text-right jobPhone">{{ $job->recruiter_phone }}</div>
            </div>
            @endif
            <div class="d-flex flex-row justify-content-center mt-4">
                <a href="#" class="btn btn-primary btn-gray-color btn-s-40 mr-3 btn-EditJob"
                    data-job-id={{ $job->id }}>
                    <span class="text">تعديل</span>
                    <div class="loading-animate">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="btn btn-primary btn-danger-color btn-s-40 btn-dropdown">
                    <span class="text">حذف</span>
                    <div class="loading-animate">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
