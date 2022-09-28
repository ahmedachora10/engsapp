<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageProjectsController;
use App\Http\Controllers\Admin\WebsiteCmsController;
use App\Http\Controllers\Admin\WebsiteUsersController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteContentController;
use App\Mail\NewRegister;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/cron', [ServiceRequestController::class, 'delete_unused_request']);

//Route::get('/', function () {
//    return redirect('/ar');
//});

Route::get('reset', [\App\Http\Controllers\UserPasswordController::class, 'forget'])->name('user.password.forget');
Route::post('reset', [\App\Http\Controllers\UserPasswordController::class, 'forgetPassword'])->name('user.password.forget_post');
Route::get('user/password/reset/{token}', [\App\Http\Controllers\UserPasswordController::class, 'showResetForm'])->name('user.password.reset-form');
Route::post('user/password/reset', [\App\Http\Controllers\UserPasswordController::class, 'reset'])->name('user.password.reset');

Route::get('/sign-in/google', [SocialAuthController::class, 'login_google'])->name('auth.login.google');
Route::get('/sign-in/google/redirect', [SocialAuthController::class, 'login_google_redirect'])->name('auth.login.google.redirect');
Route::get('/tokensignin', [SocialAuthController::class, 'login_google_redirect'])->name('auth.tokensignin');


//Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ar|en']], function () {

Route::get('/', [WebsiteContentController::class, 'page_main'])->name('home');

Route::view('/terms', 'terms')->name('terms');


Route::get('/contactus', function () {
    return view('contactus');
})->name('contactus');

Route::post('/contactus/send', [ContactUsController::class, 'send_message'])->name('contactus_send');
Route::get('/faq', [WebsiteContentController::class, 'page_faq'])->name('faqcontent');

Route::prefix('services')->group(function () {


    Route::get('/project', [WebsiteContentController::class, 'page_project'])->name('services.project');
    Route::get('/judge', [WebsiteContentController::class, 'page_judge'])->name('services.judge');
    Route::get('/visit', [WebsiteContentController::class, 'page_visit'])->name('services.visit');
    Route::get('/consult', [WebsiteContentController::class, 'page_consult'])->name('services.consult');
    Route::get('/licence', [WebsiteContentController::class, 'page_licence'])->name('services.licence');
});


Route::prefix('blog')->group(function () {
    // Route::get('/', function () {
    //     return view('blog.blogindex');
    // })->name('blog.index');

    Route::get('/', [WebsiteContentController::class, 'blog_index'])->name('blog.index');

    Route::get('/{list_type}', [WebsiteContentController::class, 'blog_listData'])->where('list_type', 'news|articles')->name('blog.list');

    Route::get('/articles', function () {
        return view('blog.bloglist');
    })->name('blog.articles');

    // Route::get('/post', function () {
    //     return view('blog.post');
    // })

    Route::get('/post/{postId}', [WebsiteContentController::class, 'page_blog_post'])->name('blog.post');
    Route::post('/post/{postId}/comment', [WebsiteContentController::class, 'post_comment'])->name('blog.post.comment');

    Route::get('/jobs', [WebsiteContentController::class, 'BlogJobs'])->name('blog.blogjobs');
    Route::get('/job/{jobId}', [WebsiteContentController::class, 'job_details'])->name('job.details');

});

Route::get('/login', [UserController::class, 'index'])->name('auth.login');
Route::post('/login', [UserController::class, 'login'])->name('auth.login.serve');
Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
Route::get('/changeUser/{id}', [UserController::class, 'changeUser'])->name('auth.changeUser');

Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');


Route::prefix('/register')->group(function () {
    Route::post('/user', [RegisterController::class, 'register_user'])->name('register.user');
    Route::post('/company', [RegisterController::class, 'register_company'])->name('register.company');
    Route::post('/freelancer', [RegisterController::class, 'register_freelancer'])->name('register.freelancer');
});


Route::middleware('auth')->prefix('user')->group(function () {
    Route::middleware('ensure_role:user')->get('/dashboard', [UserController::class, 'userDashboard'])->name('user.userDashboard');
    Route::middleware('ensure_role:user')->get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::middleware('ensure_role:user')->get('/services/{serviceName}', [UserController::class, 'service_index'])->name('user.services');
    Route::middleware('ensure_role:user')->get('/services/request/judge', [UserController::class, 'service_request_judge'])->name('user.request.judge');
    Route::middleware('ensure_role:user')->get('/services/request/licence', [UserController::class, 'service_request_licence'])->name('user.request.licence');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/services/request/project', [UserController::class, 'service_request_project'])->name('user.request.project');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/services/request/consult', [UserController::class, 'service_request_consult'])->name('user.request.consult');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/services/request/visit', [UserController::class, 'service_request_visit'])->name('user.request.visit');
    //profile
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/personalinfo', [UserController::class, 'userPersonalInfo'])->name('user.profile.personal');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/contactinfo', [UserController::class, 'userContactInfo'])->name('user.profile.contact');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/bankInfo', [UserController::class, 'userBankInfo'])->name('user.profile.bank');
    Route::middleware('ensure_role:user')->match(['get', 'post'], '/changePassword', [UserController::class, 'userChangePassword'])->name('user.profile.password');

    // Route::middleware('ensure_role:user')->get('/services/request/success', [UserController::class, 'service_request_successTemp'])->name('user.request.success');
    Route::middleware('ensure_role:user')->any('/services/request/searchResults', [UserController::class, 'service_search_results'])->name('user.serviceResults');
});


Route::middleware('auth')->prefix('me')->group(function () {
    Route::post('/update-profile-img', [UserController::class, 'userUpdateProfileImage'])->name('user.profile.img');
    Route::get('/{user}', [UserController::class, 'freelancerCompanyProfile'])->name('freelancecompanyprofile');
    Route::post('/services/request/licence/services', [UserController::class, 'get_licence_services'])->name('get.license.services');
    Route::middleware('ensure_role:user|company|freelancer')->get('/user/chatAllMessages', [UserController::class, 'allUserChatMsgs'])->name('get.user.messages');
    Route::middleware('ensure_role:user|company|freelancer')->get('/user/allNotifications', [UserController::class, 'allNotifications'])->name('get.user.notifications');
    Route::middleware('ensure_role:user|company|freelancer')->get('/user/unreadNotifications', [UserController::class, 'unreadNotifications'])->name('get.user.unreadNotifications');
});

Route::middleware('auth')->prefix('bookmarks')->group(function () {
    Route::get('/index', [BookmarksController::class, 'index'])->name('booksmarks.index');
    Route::middleware('throttle:5')->post('/addBookmark', [BookmarksController::class, 'addBookmark'])->name('booksmarks.addbookmark');
    Route::middleware('throttle:5')->post('/removeBookmark', [BookmarksController::class, 'removeBookmark'])->name('booksmarks.removebookmark');
    Route::post('/searchBookmarks', [BookmarksController::class, 'searchBookmarks'])->name('booksmarks.searchbookmarks');
});


Route::middleware('auth')->prefix('operator')->group(function () {
    Route::middleware('ensure_role:company|freelancer')->get('/profile', [OperatorController::class, 'operatorProfile'])->name('operator.profile');
    Route::middleware('ensure_role:company|freelancer')->post('/profile/rateUser', [OperatorController::class, 'operatorRateUser'])->name('operator.rateUser');
    Route::middleware('ensure_role:company|freelancer')->get('/myprojects', [OperatorController::class, 'operatorProjects'])->name('operator.myprojects');
    Route::middleware('ensure_role:company|freelancer')->get('/myoffers', [OperatorController::class, 'operatorOffers'])->name('operator.myoffers');
    Route::middleware('ensure_role:company|freelancer')->post('/myoffers/search', [OperatorController::class, 'operatorOffers_search'])->name('operator.myoffers.search');
    Route::middleware('ensure_role:company|freelancer')->post('/myprojects/search', [OperatorController::class, 'operatorProjects_search'])->name('operator.myprojects.search');


    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/accountSettings', [OperatorController::class, 'accountSettings'])->name('operator.accountSettings');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/changePassword', [OperatorController::class, 'operatorChangePassword'])->name('operator.changePassword');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/bankInfo', [OperatorController::class, 'operatorBankInfo'])->name('operator.bankInfo');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/arbitration', [OperatorController::class, 'operatorJudgeService'])->name('operator.judgeService');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/testQualityService', [OperatorController::class, 'operatorTestQualityService'])->name('operator.testQualityService');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/testBuildService', [OperatorController::class, 'operatorTestBuildService'])->name('operator.testBuildService');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/workFields', [OperatorController::class, 'operatorworkFields'])->name('operator.workFields');
    Route::middleware('ensure_role:company|freelancer')->match(['get', 'post'], '/contactInfo', [OperatorController::class, 'operatorContactInfo'])->name('operator.contactInfo');
    Route::middleware('ensure_role:company|freelancer')->get('/explore', [OperatorController::class, 'operatorExplore'])->name('operator.explore');
    Route::middleware('ensure_role:company')->get('/jobs', [OperatorController::class, 'operatorJobs'])->name('operator.jobs');
    Route::middleware('ensure_role:company')->post('/jobs/create', [OperatorController::class, 'operatorCreateJob'])->name('operator.createjobs');
    Route::middleware('ensure_role:company')->delete('/jobs/delete', [OperatorController::class, 'operatorDeleteJob'])->name('operator.deletejobs');

    Route::middleware('ensure_role:company|freelancer')->post('/portfolio/create', [OperatorController::class, 'operatorAddPortfolio'])->name('operator.addPortfolio');
    Route::middleware('ensure_role:company|freelancer')->delete('/portfolio/delete', [OperatorController::class, 'operatorDeleteWork'])->name('operator.DeleteWork');

    Route::middleware('ensure_role:company|freelancer')->post('/search-projects', [OperatorController::class, 'operatorExploreSearch'])->name('operator.exploresearch');
    Route::middleware('ensure_role:company|freelancer')->post('/deliver-project/{service_request}', [OperatorController::class, 'operatorDeliverProject'])->name('operator.deliverproject');
});


Route::middleware('auth')->prefix('requests')->group(function () {
    Route::middleware('ensure_role:user|company|freelancer')->get('view/{service_request}', [ServiceRequestController::class, 'viewRequest'])->name('request.view');
    Route::middleware('ensure_role:user|company|freelancer')->get('view/{service_request}/offer/{offer}', [ServiceRequestController::class, 'viewOffer'])->name('request.offer');
    Route::middleware('ensure_role:user')->post('view/{service_request}/offer/{offer}/accept-offer', [UserController::class, 'accept_offer'])->name('user.acceptoffer');
    Route::middleware('ensure_role:company|freelancer')->post('/offer', [OperatorController::class, 'operatorApplyOffer'])->name('operator.applyoffer');
    Route::middleware('ensure_role:company|freelancer')->post('/editoffer', [OperatorController::class, 'operatorEditOffer'])->name('operator.editoffer');
    Route::middleware('ensure_role:company|freelancer')->post('/uploadOfferFiles', [OperatorController::class, 'operatorUploadOfferFiles'])->name('operator.uploadofferfiles');


    Route::middleware('ensure_role:user|company|freelancer')->post('view/{service_request}/offer/{offer}/chat', [ServiceRequestController::class, 'send_chat_msg'])->name('request.sendchatmsg');
    Route::middleware('ensure_role:user|company|freelancer')->get('view/{service_request}/chat-msgs', [ServiceRequestController::class, 'chat_msgs'])->name('request.chatmsgs');

    Route::middleware('ensure_role:user')->post('view/{service_request}/rateOperator', [UserController::class, 'rateOperator'])->name('user.rateOperator');
    Route::middleware('ensure_role:user')->get('cancel/{service_request}', [UserController::class, 'cancelProject'])->name('user.cancelProject');

    Route::middleware('ensure_role:company|freelancer')->post('request/{service_request}/offer/{offer}/visit-report', [OperatorController::class, 'operatorUploadVisitReport'])->name('operator.uploadvisitreport');
});
//});


Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return $exitCode;
});

Route::get('/rollback', function () {
    $exitCode = Artisan::call('migrate:rollback');
    return $exitCode;
});

Route::get('/droppermissions', function () {
    $exitCode = Schema::dropIfExists('permissions');
    return $exitCode;
});

Route::get('/test3', function () {
    return new NewRegister('Freelancer', \App\Models\User::find(36));

    \Mail::to('a.sh@selsela.net')->send(new NewRegister('Freelancer', \App\Models\User::find(36)));

});


/************ DELETED PLUGIN HERE AND REPLACED WITH ADMIN ROUTES****************/

Route::prefix('/admin')->middleware(['auth:admin'])->group(function () {
    Route::get('', [DashboardController::class, 'dashboard'])->name('admin.home');
    Route::prefix('/settings')->middleware(['permission:manage website'])->group(function () {
        Route::match(['get', 'post'], '/website-perc', [DashboardController::class, 'website_perc'])->name('admin.settings.perc');
        Route::match(['get', 'post'], '/website-links', [DashboardController::class, 'website_links'])->name('admin.settings.links');
    });
    Route::post('/myData', [DashboardController::class, 'myData'])->name('admin.myData');

    Route::prefix('/admin-users')->middleware(['permission:super-admin'])->group(function () {
        Route::match(['get', 'post'], '', [DashboardController::class, 'admin_users'])->name('admin.adminusers.controlUsers');
        Route::match(['get', 'post'], '/admin-users/addedituser', [DashboardController::class, 'add_edit_admin_user'])->name('admin.adminusers.addedituser');
        Route::post('/delete', [DashboardController::class, 'delete_admin_user'])->name('admin.adminusers.delete');
    });


    //CMS
    Route::match(['get', 'post'], '/website-cms/{page_name}', [WebsiteCmsController::class, 'website_cms'])->middleware(['permission:manage cms'])->name('admin.cms.update');
    Route::match(['get', 'post'], '/faq', [WebsiteCmsController::class, 'faq'])->middleware(['permission:manage cms'])->name('admin.faq.update');
    Route::match(['get', 'post'], '/terms', [WebsiteCmsController::class, 'terms'])->middleware(['permission:manage cms'])->name('admin.terms.update');

    Route::prefix('/news')->middleware(['permission:manage blog'])->group(function () {
        Route::match(['get', 'post'], '/addedit/{id?}', [WebsiteCmsController::class, 'news_addedit'])->name('admin.news.addedit');
        Route::match(['get', 'post'], '/list', [WebsiteCmsController::class, 'news_list'])->name('admin.news.list');
    });

    Route::prefix('/articles')->middleware(['permission:manage blog'])->group(function () {
        Route::match(['get', 'post'], '/addedit/{id?}', [WebsiteCmsController::class, 'articles_addedit'])->name('admin.articles.addedit');
        Route::match(['get', 'post'], '/list', [WebsiteCmsController::class, 'articles_list'])->name('admin.articles.list');
    });


    Route::prefix('/slider')->middleware(['permission:manage blog'])->group(function () {
        Route::match(['get', 'post'], '/list', [WebsiteCmsController::class, 'slider_list'])->name('admin.slider.list');
        Route::get('/slide/details/{id}', [WebsiteCmsController::class, 'slider_details'])->name('admin.slider.details');
        Route::post('/slide/delete/', [WebsiteCmsController::class, 'slider_delete'])->name('admin.slider.delete');
        Route::match(['get', 'post'], '/addedit/{id?}', [WebsiteCmsController::class, 'slider_addedit'])->name('admin.slider.addedit');
    });

    Route::middleware(['permission:manage blog'])->post('/post/delete', [WebsiteCmsController::class, 'post_delete'])->name('admin.post.delete');
    Route::post('/post/uploadImage', [WebsiteCmsController::class, 'post_uploadImage'])->name('admin.post.uploadImage');


    Route::middleware(['permission:manage website'])->get('/contactus', [DashboardController::class, 'contactus_list'])->name('admin.contactus');
    Route::middleware(['permission:manage website'])->post('/contactus', [DashboardController::class, 'contactus_listData'])->name('admin.contactusData');
    Route::middleware(['permission:manage website'])->get('/contactus/message/{id}', [DashboardController::class, 'contactus_messageDetails'])->name('admin.contactusData.messageDetails');
    Route::middleware(['permission:manage website'])->post('/contactus/deleteMessage', [DashboardController::class, 'contactus_delete'])->name('admin.contactusData.delete');


    Route::middleware(['permission:manage cms'])->get('/jobs-list', [WebsiteCmsController::class, 'jobs_list'])->name('admin.jobs.list');
    Route::middleware(['permission:manage cms'])->post('/jobs-list-data', [WebsiteCmsController::class, 'jobs_listData'])->name('admin.jobs.listData');
    Route::middleware(['permission:manage cms'])->get('/job-details/{id}', [WebsiteCmsController::class, 'jobs_details'])->name('admin.jobs.details');
    Route::middleware(['permission:manage cms'])->post('/deleteJob', [WebsiteCmsController::class, 'jobs_delete'])->name('admin.jobs.delete');


    Route::prefix('/users')->middleware(['permission:manage users'])->group(function () {
        Route::match(['get', 'post'], '/list/users', [WebsiteUsersController::class, 'users_list'])->name('admin.users.list');
        Route::match(['get', 'post'], '/list/companies', [WebsiteUsersController::class, 'companies_list'])->name('admin.companies.list');
        Route::match(['get', 'post'], '/list/companies/export', [WebsiteUsersController::class, 'companies_export'])->name('admin.companies.export');
        Route::match(['get', 'post'], '/list/freelancers', [WebsiteUsersController::class, 'freelancers_list'])->name('admin.freelancers.list');
        Route::match(['get', 'post'], '/list/freelancers/export', [WebsiteUsersController::class, 'freelancer_export'])->name('admin.freelancers.export');
        Route::match(['get', 'post'], '/list/users/export', [WebsiteUsersController::class, 'users_export'])->name('admin.users.export');
        Route::post('/delete/', [WebsiteUsersController::class, 'request_delete'])->name('admin.users.delete');

        Route::get('/user-details/{userId}', [WebsiteUsersController::class, 'user_overview'])->name('admin.user.overview');
        Route::get('/user-details/{userId}/details', [WebsiteUsersController::class, 'user_details'])->name('admin.user.details');
        Route::match(['get', 'post'], '/user-details/{userId}/companylicense', [WebsiteUsersController::class, 'user_company_license'])->name('admin.company.license');
        Route::match(['get', 'post'], '/user-details/{userId}/companyarbitration', [WebsiteUsersController::class, 'user_company_arbitration'])->name('admin.company.arbitration');
        Route::match(['get', 'post'], '/user-details/{userId}/testQuality', [WebsiteUsersController::class, 'user_company_testQuality'])->name('admin.company.testQuality');
        Route::match(['get', 'post'], '/user-details/{userId}/testBuild', [WebsiteUsersController::class, 'user_company_testBuild'])->name('admin.company.testBuild');
        Route::match(['get', 'post'], '/user-details/{userId}/freelancerMemberShip', [WebsiteUsersController::class, 'user_freelancer_membership'])->name('admin.freelancer.membership');

        Route::post('/update-active-status', [WebsiteUsersController::class, 'user_update_active_status'])->name('admin.users.updateActiveStatus');

        Route::post('/sendNotification', [WebsiteUsersController::class, 'user_send_notification'])->name('admin.user.sendNotify');
    });

    Route::post('/notification/markAsRead', [DashboardController::class, 'admin_notifications'])->name('admin.notifications.markSelected');
    Route::post('/notification/markAll', [DashboardController::class, 'admin_mark_allNotifications'])->name('admin.notifications.markAll');

    Route::prefix('/requests')->middleware(['permission:manage requests'])->group(function () {
        Route::get('/view/{requestId}', [ManageProjectsController::class, 'request_view'])->name('admin.request.view');
        Route::post('/view/{requestId}', [ManageProjectsController::class, 'confirm_request'])->name('admin.request.view');
        Route::match(['get', 'post'], '/list', [ManageProjectsController::class, 'request_list'])->name('admin.request.list');
        Route::post('/deleteRequest', [ManageProjectsController::class, 'request_delete'])->name('admin.request.delete');
    });
});

Route::match(['get', 'post'], '/admin/auth/login', [LoginController::class, 'login'])->name('admin.auth.login');
Route::get('/admin/auth/logout', [LoginController::class, 'logout'])->name('admin.auth.logout');

Route::get('commands/clear', function () {
    $base = base_path();


    print `php $base/artisan clear-compiled`;
    echo "<br>";
    print `php $base/artisan view:clear`;
    echo "<br>";
//    print `php $base/artisan route:clear`;
    echo "<br>";
    print `php $base/artisan config:cache`;
    echo "<br>";
//    print `php $base/artisan optimize`;
    print `php $base/artisan route:clear`;
    echo "<br>";
});
Route::get('commands/route_list', function () {
    $base = base_path();


    print `php $base/artisan route:list`;
    echo "<br>";
//    print `php $base/artisan view:clear`;
//    echo "<br>";
//    print `php $base/artisan route:clear`;
//    echo "<br>";
//    print `php $base/artisan config:cache`;
//    echo "<br>";
//    print `php $base/artisan optimize`;
});
