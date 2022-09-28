<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Models\FaqModel;
use App\Models\JobsModel;
use App\Models\PageModel;
use App\Models\PostsModel;
use App\Models\SliderModel;
use App\Models\WebsiteContentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WebsiteCmsController extends AdminBaseController
{

    public function getContentByPageName($page_name)
    {
        return WebsiteContentModel::where('page_name', $page_name)->get();
    }

    public function slider_list(Request $request)
    {
        if ($request->isMethod('post')) {
            $slides = SliderModel::all();
            return Datatables::of($slides)
                ->editColumn('image', function ($slide) {
                    $sliderImg = route('imagecache', ['template' => 'profile', 'filename' => $slide->image]);
                    return  $sliderImg;
                })
                ->addColumn('action', function ($slide) {
                    $viewBtn = '<a href="javascript:;" id="btnViewId_' . $slide->id . '" data-url="' . route('admin.slider.details', ['id' => $slide->id]) . '" class="btn btn-sm btn-clean btn-icon btnViewJob"  title="عرض"><i class="la la-eye"></i></a>';
                    $routeEdit = route('admin.slider.addedit', ['id' => $slide->id]);
                    $editBtn = '<a href="' . $routeEdit  . '" class="btn btn-sm btn-clean btn-icon "  title="تعديل"><i class="la la-edit"></i></a>';
                    $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $slide->id . '" title="حذف"><i class="la la-trash"></i></a>';
                    return $viewBtn . $editBtn . $removeBtn;
                })
                ->make();
        }
        if ($request->isMethod('get')) {
            return view('admin.mainSlider.sliderList');
        }
    }

    public function slider_addedit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $slide = $id != null ? SliderModel::find($id) : new SliderModel();

            $slide->title_ar = $request->title_ar;
            $slide->title_en = $request->title_en;

            $slide->small_desc_ar = $request->small_desc_ar;
            $slide->small_desc_en = $request->small_desc_en;

            $slide->desc_ar = $request->desc_ar;
            $slide->desc_en = $request->desc_en;

            $slide->button_text_ar = $request->button_text_ar;
            $slide->button_text_en = $request->button_text_en;

            $slide->linkTo = $request->linkTo;
            $slide->order = $request->order;
            $slide->isenabled = $request->isenabled != null ? true : false;

            if ($request->slide_image != null) {
                $request->slide_image->store('public');
                $hashName = $request->slide_image->hashName();
                $slide->image = $hashName;
            }

            $slide->save();

            if ($id == null) {
                return redirect()->route('admin.slider.list')->with('success', 'تمت عملية الحفظ بنجاح');
            } else
                return redirect()->route('admin.slider.addedit', ['id' => $slide->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }
        if ($request->isMethod('get')) {
            $slide = $id != null ? $slide = SliderModel::find($id) : null;
            return view('admin.mainSlider.addEditSlide', [
                'id' => $id,
                'slide' => $slide,
            ]);
        }
    }

    public function slider_details(Request $request, $id)
    {
        $slide = SliderModel::where('id', $id)->first();
        $slideDetails = view('admin.templates.slideDetails', ['slide' => $slide])->render();
        return response()->json([
            'status' => true,
            'slideDetails' => $slideDetails
        ]);
    }


    public function slider_delete(Request $request)
    {
        $slide = SliderModel::where('id', $request->only('slideId'))
            ->first();
        $slide->delete();
        return response()->json([
            'status' => true,
        ]);
    }


    public function post_uploadImage(Request $request)
    {
        $request->file->store('public');
        $filename = $request->file->getClientOriginalName();
        $hashName = $request->file->hashName();
        $url = asset('storage/' . $hashName);
        return response()->json([
            'status' => true,
            'filename' => $filename,
            'hashName' => $hashName,
            'url' => $url
        ]);
    }

    public function AddEditPost($request, $id, $post_type)
    {
        $post = $id != null ? PostsModel::find($id) : new PostsModel();
        $post->post_type = $post_type;
        $post->post_date = date("Y-m-d", strtotime($request->post_date));
        $post->lang = $request->lang;
        $post->title = $request->title;
        $post->small_desc = $request->small_desc;
        $post->content = $request->content;

        if ($request->post_image != null) {
            $request->post_image->store('public');
            $hashName = $request->post_image->hashName();
            $post->image = $hashName;
        }

        $post->save();
        return $post;
    }


    public function news_addedit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title'=>'required|max:255',
                'small_desc'=>'required|max:255',
            ]);
            $post =  $this->AddEditPost($request, $id, 'news');
            if ($id == null) {
                return redirect()->route('admin.news.list')->with('success', 'تمت عملية الحفظ بنجاح');
            } else
                return redirect()->route('admin.news.addedit', ['id' => $post->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }
        if ($request->isMethod('get')) {
            $post = $id != null ? $post = PostsModel::find($id) : null;
            return view('admin.newsArticles.addEditNewsArticle', [
                'id' => $id,
                'post' => $post,
                'post_type' => 'news'
            ]);
        }
    }

    public function articles_addedit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title'=>'required|max:255',
                'small_desc'=>'required|max:255',
            ]);
            $post =  $this->AddEditPost($request, $id, 'articles');
            if ($id == null) {
                return redirect()->route('admin.articles.list')->with('success', 'تمت عملية الحفظ بنجاح');
            } else
                return redirect()->route('admin.articles.addedit', ['id' => $post->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }
        if ($request->isMethod('get')) {
            $post = $id != null ? $post = PostsModel::find($id) : null;
            return view('admin.newsArticles.addEditNewsArticle', [
                'id' => $id,
                'post' => $post,
                'post_type' => 'articles'
            ]);
        }
    }

    public function GetPostListsByType($post_type)
    {
        $news_posts = PostsModel::with('comments')->where('post_type', $post_type)->select('id', 'title', 'post_date', 'lang', 'views', 'image');

        return Datatables::of($news_posts)
            ->editColumn('lang', function ($post) {
                return $post->lang == 'ar' ? "العربية" : "الانجليزية";
            })
            ->editColumn('image', function ($post) {
                return route('imagecache', ['template' => 'work', 'filename' => $post->image]);
            })
            ->addColumn('totalComments', function ($post) {
                return $post->comments->count();
            })
            ->addColumn('totalUnreadedComments', function ($post) {
                return $post->comments->where('isread', false)->count();
            })
            ->addColumn('action', function ($post) use ($post_type) {
                $viewBtn = '<a target="_blank" href="' . route('blog.post', ['postId' => $post->id]) . '" class="btn btn-sm btn-clean btn-icon btnViewJob"  title="عرض"><i class="la la-eye"></i></a>';
                $routeEdit = $post_type == "news"  ? route('admin.news.addedit', ['id' => $post->id]) : route('admin.articles.addedit', ['id' => $post->id]);
                $editBtn = '<a href="' . $routeEdit  . '" class="btn btn-sm btn-clean btn-icon"  title="تعديل"><i class="la la-edit"></i></a>';
                $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $post->id . '" title="حذف"><i class="la la-trash"></i></a>';
                return $viewBtn . $editBtn . $removeBtn;
            })
            ->make();
    }
    public function news_list(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->GetPostListsByType('news');
        }
        if ($request->isMethod('get')) {

            $cardTitle = "الاخبار";
            $columnTitle = "الخبر";

            return view('admin.newsArticles.viewNewsArticles', [
                'dataURL' => route('admin.news.list'),
                'cardTitle' => $cardTitle,
                'columnTitle' => $columnTitle
            ]);
        }
    }

    public function post_delete(Request $request)
    {
        $post = PostsModel::where('id', $request->only('postId'))
            ->first();
        $post->delete();

        return response()->json([
            'status' => true,
        ]);
    }



    public function articles_list(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->GetPostListsByType('articles');
        }
        if ($request->isMethod('get')) {

            $cardTitle = "المقالات";
            $columnTitle = "المقال";

            return view('admin.newsArticles.viewNewsArticles', [
                'dataURL' => route('admin.articles.list'),
                'cardTitle' => $cardTitle,
                'columnTitle' => $columnTitle
            ]);
        }
    }


    public function jobs_list(Request $request)
    {
        return view('admin.general.JobsList');
    }
    public function jobs_listData(Request $request)
    {
        $jobs = JobsModel::has('company')->with('company')->select('recruiters_jobs.id', 'recruiters_jobs.title', 'recruiters_jobs.user_id', 'recruiters_jobs.created_at', 'recruiters_jobs.deadline');


        return Datatables::of($jobs)
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d') : '';
            })
            ->editColumn('company.profile_img', function ($user) {
                $profileImg = asset('adminAssets/assets/media/users/blank.png');
                if ($user->company->profile_img != null) {
                    $profileImg = route('imagecache', ['template' => 'profile', 'filename' => $user->company->profile_img]);
                }
                return  $profileImg;
            })
            ->addColumn('action', function ($user) {
                $viewBtn = '<a href="javascript:;" id="btnViewJobId_' . $user->id . '" data-url="' . route('admin.jobs.details', ['id' => $user->id]) . '" class="btn btn-sm btn-clean btn-icon btnViewJob"  title="عرض"><i class="la la-eye"></i></a>';
                $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $user->id . '" title="حذف"><i class="la la-trash"></i></a>';
                return $viewBtn . $removeBtn;
            })
            ->make();
        // return view('admin.general.JobsList');
    }

    public function jobs_delete(Request $request)
    {
        // dd($request->all());
        $job = JobsModel::where('id', $request->only('jobId'))
            ->first();
        $job->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function jobs_details(Request $request, $id)
    {
        $job = JobsModel::with('company')->where('id', $id)->first();
        $jobDetails = view('admin.templates.jobDetails', ['jobDetails' => $job])->render();
        return response()->json([
            'status' => true,
            'jobDetails' => $jobDetails
        ]);
    }

    public function website_cms(Request $request, $page_name)
    {
        if ($request->isMethod('post')) {
            $fields = collect($request->all());
            $main_page_fields =  WebsiteContentModel::where('page_name', $page_name)->get();

            foreach ($main_page_fields as $key => $field) {
                if (strpos($field->paragraph_name, 'subs_enabled') !== false) {
                    $posted_subsEnabled = $fields->first(function ($value, $key) use ($field) {
                        return $key == $field->paragraph_name;
                    });
                    $field->content_ar = $posted_subsEnabled == null ? "0" : "1";
                    $field->content_en =  $posted_subsEnabled == null ? "0" : "1";
                    $field->save();
                } else if (strpos($field->paragraph_name, 'count_') !== false) {

                    $posted_Counts = $fields->first(function ($value, $key) use ($field) {
                        return $key == $field->paragraph_name;
                    });
                    $field->content_ar = $posted_Counts;
                    $field->content_en = $posted_Counts;
                    $field->save();
                } else {
                    $postedData_ar = $fields->first(function ($value, $key) use ($field) {
                        return $key == $field->paragraph_name . '_ar';
                    });
                    $postedData_en = $fields->first(function ($value, $key) use ($field) {
                        return $key == $field->paragraph_name . '_en';
                    });
                    if (strpos($field->paragraph_name, 'project_type_') !== false){
                        $postedData_active = $fields->first(function ($value, $key) use ($field) {
                            return $key == $field->paragraph_name . '_active';
                        });
                        $field->is_active = $postedData_active?1:0;

                    }


                    $field->content_ar = $postedData_ar;
                    $field->content_en = $postedData_en;
                    $field->save();
                }
            }
            return redirect()->route('admin.cms.update', ['page_name' => $page_name])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('get')) {
            $content = $this->getContentByPageName($page_name);
            $page_name_text = $content->first()->page_name_text;
            $content = $content->groupBy('section_name_text');

            $viewName = 'admin.cms.websiteCMS';
            if ($page_name == "main_page_subscriptions") {
                $viewName = "admin.cms.websiteSubs";
            }
            return view($viewName, [
                'content' => $content,
                'page_name' => $page_name,
                'page_name_text' => $page_name_text
            ]);
        }
    }

    public function faq(Request $request)
    {
        if ($request->isMethod('post')) {
            $titles=$request->title_ar;
            $ids=[];
            foreach ($titles as $id=>$ti){
                $faq=FaqModel::find($id);
                if(!$faq){
                    $faq=new FaqModel();
                }
                $faq->title_ar=$ti;
                $faq->title_en=$request->title_en[$id]??'';
                $faq->answer_ar=$request->answer_ar[$id]??'';
                $faq->answer_en=$request->answer_en[$id]??'';
                $faq->save();
                $ids[]=$faq->id;
            }

            FaqModel::whereNotIn('id',$ids)->delete();
            return redirect()->route('admin.faq.update')->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('get')) {
            $faqs=FaqModel::all();
            return view('admin.cms.faq', compact('faqs'));
        }
    }
    public function terms(Request $request)
    {
        if ($request->isMethod('post')) {
            $page=PageModel::find(1);
            $page->title_ar=$request->title_ar;
            $page->title_en=$request->title_en;
            $page->text_ar=$request->text_ar;
            $page->text_en=$request->text_en;
            $page->save();
            return redirect()->route('admin.terms.update')->with('success', 'تمت عملية الحفظ بنجاح');
        }

        $page=PageModel::find(1);
        return view('admin.cms.terms', compact('page'));

    }
}
