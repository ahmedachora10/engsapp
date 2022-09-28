<?php

namespace App\Http\Controllers;

use App\Models\BookmarksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookmarksController extends Controller
{
    //
    public function index(Request $request)
    {
        // $bookmark = new BookmarksModel();

        //Nested Eager Loading
        // DB::enableQueryLog();

        // $bookmarks = BookmarksModel::with('request_data.service_stage')->whereHas('request_data', function ($query) {
        //     $query->with(['service_stage'])->where('title', 'like', '%%');
        // })->where('user_id', $request->user()->id)->get();

        $bookmarks = BookmarksModel::where('user_id', $request->user()->id)->orderByDesc('created_at')->get();

        // dd(DB::getQueryLog());

        return view('general.bookmarks', [
            'bookmarks' =>  $bookmarks,
            'bookmarks_empty_msg' => __('form.bookmarks_empty_msg'),
        ]);
    }

    public function searchBookmarks(Request $request)
    {


        $bookmarks = BookmarksModel::whereHas('request_data', function ($query) use ($request) {
            $query->with(['service_stage'])->where('title', 'like', '%' . $request->searchValue . '%');
        })->where('user_id', $request->user()->id)->orderByDesc('created_at')->get();
        $result = view('general.bookmark_items', ['bookmarks' => $bookmarks, 'bookmarks_empty_msg' => __('form.bookmarks_empty_search_results_msg')])->render();
        return response()->json([
            'status' => true,
            'message' => "results",
            'data' => $result
        ]);
    }


    public function addbookmark(Request $request)
    {

        $messages = [
            'request_id.unique' => 'Given request_id and user_id are already registerd',
        ];

        $this->validate(request(), [
            'request_id' => [
                'required',
                Rule::unique('bookmarks', 'request_id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id)->whereNull('deleted_at');
                }),
            ],
        ], $messages);


        $bookmark = new BookmarksModel();
        $bookmark->user_id = $request->user()->id;
        $bookmark->request_id = $request->request_id;
        $bookmark->save();

        return response()->json([
            'status' => true,
            'message' => "bookmark added",
            'bookmark_id' => $bookmark->id
        ]);
    }

    public function removebookmark(Request $request)
    {
        $request->validate([
            'bookmark_id' => 'required',
        ]);
        $bookmark = BookmarksModel::where('user_id', $request->user()->id)->where('id', $request->bookmark_id)->first();

        $bookmark->delete();

        return response()->json([
            'status' => true,
            'message' => "bookmark removed !",
            'bookmarkid' => $bookmark->id
        ]);
    }
}
