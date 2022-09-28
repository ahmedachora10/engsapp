<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use App\Models\JobsModel;
use App\Models\PostCommentsModel;
use App\Models\PostsModel;
use App\Models\SliderModel;
use App\Models\WebsiteContentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WebsiteContentController extends Controller
{

    public function getContentByPageName($page_name)
    {
        return WebsiteContentModel::where('page_name', $page_name)->get();
    }

    public function page_main(Request $request)
    {
        $sliderContent = SliderModel::where('isenabled', true)->get();
        // dd($sliderContent->pluck('image'));
        $content = $this->getContentByPageName('main_page');
        $subsContent = $this->getContentByPageName('main_page_subscriptions');
        $subsEnabled = $subsContent->where('paragraph_name', 'subs_enabled')->first();
        return view('welcome', [
            'content' => $content,
            'subsContent' => $subsContent,
            'sliderContent' => $sliderContent,
            'subsEnabled' => boolval($subsEnabled->content_ar)
        ]);
    }

    public function page_project(Request $request)
    {
        $content = $this->getContentByPageName('project');
        return view('services.project', ['content' => $content]);
    }
    public function page_judge(Request $request)
    {
        $content = $this->getContentByPageName('judge');
        return view('services.judge', ['content' => $content]);
    }

    public function page_visit(Request $request)
    {
        $content = $this->getContentByPageName('visit');
        return view('services.visit', ['content' => $content]);
    }
    public function page_consult(Request $request)
    {
        $content = $this->getContentByPageName('consult');
        return view('services.consult', ['content' => $content]);
    }
    public function page_licence(Request $request)
    {
        $content = $this->getContentByPageName('licence');
        return view('services.licence', ['content' => $content]);
    }

    public function blog_index(Request $request, $locale='ar')
    {

        $lastTwoNews = PostsModel::where('lang', $locale)
            ->where('post_type', 'news')
            ->orderByDesc('created_at')
            ->limit(2)
            ->get();

        $lastThreeArticles = PostsModel::where('lang', $locale)
            ->where('post_type', 'articles')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        $latestJobs = JobsModel::with('company')->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $MostViewsPosts =  PostsModel::where('lang', $locale)
            ->orderByDesc('views')
            ->limit(4)
            ->get();

        return view('blog.blogindex', [
            'latestJobs' => $latestJobs,
            'lastTwoNews' => $lastTwoNews,
            'lastThreeArticles' => $lastThreeArticles,
            'MostViewsPosts' => $MostViewsPosts
        ]);
    }

    public function blog_listData(Request $request,  $post_type)
    {
        $locale='ar';
        $posts = PostsModel::where('lang', $locale)
            ->where('post_type', $post_type)
            ->orderByDesc('created_at')
            ->paginate(3);

        return view('blog.bloglist', [
            'posts' => $posts,
            'post_type' => $post_type
        ]);
    }

    public function page_blog_post(Request $request, $postId)
    {
        $post = PostsModel::with(['comments' => function ($query) {
            $query->where('isactive', true);
        }])->find($postId);

        $post->views = $post->views + 1;
        $post->save();
        $latestJobs = JobsModel::with('company')->orderByDesc('created_at')
            ->limit(12)
            ->get();

        return view('blog.post', [
            'post' => $post,
            'latestJobs' => $latestJobs,
        ]);
    }
    public function job_details(Request $request, $jobId)
    {
        $post = JobsModel::find($jobId);
        $latestJobs = JobsModel::with('company')->where('id','<>',$jobId)->orderByDesc('created_at')
            ->limit(12)
            ->get();
        return view('blog.job', [
            'post' => $post,
            'latestJobs' => $latestJobs,

        ]);
    }

    public function post_comment(Request $request, $postId)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'comment' => 'required|string',
        ]);

        $comment = new PostCommentsModel();
        $comment->post_id = $postId;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->isactive = false;
        $comment->isread = false;
        $comment->save();

        return response()->json([
            'status' => true,
            'message' => __('form.messages.post_comment')
        ]);

        // dd($request->all());
    }

    public function page_faq(Request $request)
    {
        $titleColumnName = App::currentLocale() == 'ar' ? 'title_ar as title' : 'title_en as title';
        $AnswerColumnName = App::currentLocale() == 'ar' ? 'answer_ar as answer' : 'answer_en as answer';
        $faq = FaqModel::select('id', $titleColumnName, $AnswerColumnName)->get();
        return view('faq', ['FAQ' => $faq]);
    }

    public function BlogJobs(Request $request)
    {

        $jobs = JobsModel::with('company')->orderByDesc('created_at')->paginate(12);
        return view('blog.blogjobs', [
            'jobs' => $jobs
        ]);
    }
}
