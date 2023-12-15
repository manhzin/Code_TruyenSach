<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\Publisher;
use App\Models\Favorite;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct(
        protected StoryRepositoryInterface $storyRepository,
        protected ChapterRepositoryInterface $chapterRepository,
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }
    public function dangki(){
        $setting = Helper::getSetting();

        $objectSEO = (object) [
            'name' => $setting ? $setting->title : 'Truyện Zin',
            'description' => $setting ? $setting->description : 'Đọc truyện online, truyện hay. Truyện Zin luôn tổng hợp và cập nhật các chương truyện một cách nhanh nhất.',
            'keywords' => 'dang ki khach hang, đăng kí khách hàng',
            'no_index' => $setting ? !$setting->index : env('NO_INDEX'),
            'meta_type' => 'WebPage',
            'url_canonical' => route('home'),
            'image' => asset('assets/frontend/images/logo_text1.png'),
            'site_name' => 'Truyện Zin'
        ];

        Helper::setSEO($objectSEO);

        // $categories = Helper::getCategoies();

        return view('Frontend.user.dangki');
    }
    public function dangnhap(){
        $setting = Helper::getSetting();

        $objectSEO = (object) [
            'name' => $setting ? $setting->title : 'Truyện Zin',
            'description' => $setting ? $setting->description : 'Đọc truyện online, truyện hay. Truyện Zin luôn tổng hợp và cập nhật các chương truyện một cách nhanh nhất.',
            'keywords' => 'dang nhap khach hang, đăng nhap khách hàng',
            'no_index' => $setting ? !$setting->index : env('NO_INDEX'),
            'meta_type' => 'WebPage',
            'url_canonical' => route('home'),
            'image' => asset('assets/frontend/images/logo_text1.png'),
            'site_name' => 'Truyện Zin'
        ];
        Helper::setSEO($objectSEO);

        return view('Frontend.user.dangnhap');
    }
    public function index(Request $request)
    {
        $setting = Helper::getSetting();

        $objectSEO = (object) [
            'name' => $setting ? $setting->title : 'Truyện Zin',
            'description' => $setting ? $setting->description : 'Đọc truyện online, truyện hay. Truyện Zin luôn tổng hợp và cập nhật các chương truyện một cách nhanh nhất.',
            'keywords' => 'doc truyen, doc truyen online, truyen hay, truyen chu',
            'no_index' => $setting ? !$setting->index : env('NO_INDEX'),
            'meta_type' => 'WebPage',
            'url_canonical' => route('home'),
            'image' => asset('assets/frontend/images/logo_text1.png'),
            'site_name' => 'Truyện Zin'
        ];

        Helper::setSEO($objectSEO);

        $storiesHot = $this->storyRepository->getStoriesHot(16);
        $storiesNewIds = $this->storyRepository->getStoriesNewIds()->toArray();
        $storiesNew = $this->storyRepository->getStoriesNew($storiesNewIds);
        $chapterLast = $this->chapterRepository->getChapterLast($storiesNewIds) ?? [];

        $storiesFullIds = $this->storyRepository->getStoriesFullIds()->toArray();
        $storiesFull = $this->storyRepository->getStoriesFull($storiesFullIds);
        $chapterLastOffFull = $this->chapterRepository->getChapterLast($storiesFullIds);

        $storiesNew->map(function ($story) use ($chapterLast) {
            foreach ($chapterLast as $chapter) {
                if ($chapter->story_id == $story->id) {
                    return $story->chapter_last = $chapter;
                }
            }
        });

        $storiesFull->map(function ($story) use ($chapterLastOffFull) {
            foreach ($chapterLastOffFull as $chapter) {
                if ($chapter->story_id == $story->id) {
                    return $story->chapter_last = $chapter;
                }
            }
        });

        // $categories = Helper::getCategoies();

        return view('Frontend.home', compact('storiesHot', 'storiesNew', 'storiesFull'));
    }

    public function getListStoryHot(Request $request)
    {
        $res = ['success' => false];

        $category = $this->categoryRepository->find(intval($request->input('category_id')), ['stories']);
        $stories = $category->stories()->where('status', '=', Story::STATUS_ACTIVE)->limit(16)->get();

        $param = [
            'categoryIdSelected' => intval($request->input('category_id')),
            'categories' => Helper::getCategoies(),
            'storiesHot' => $stories
        ];
        $html = view('Frontend.sections.main.stories_hot', $param)->render();
        $res['success'] = true;
        $res['html'] = $html;
        return response()->json($res);
    }
    public function getListStoryHotRandom(Request $request)
    {
        $res = ['success' => false];

        $stories = $this->storyRepository->getStoriesHotRandom(16);

        $param = [
            'categoryIdSelected' => 0,
            'categories' => Helper::getCategoies(),
            'storiesHot' => $stories
        ];

        $html = view('Frontend.sections.main.stories_hot', $param)->render();       
        $res['success'] = true;
        $res['html'] = $html;

        return response()->json($res);
    }

    public function searchStory(Request $request)
    {
        $res = ['success' => false];

        $stories = $this->storyRepository->getStoryWithByKeyWord($request->input('key_word'));

        $res['success'] = true;
        $res['stories'] = $stories;

        return response()->json($res);
    }

    public function mainSearchStory(Request $request)
    {
        $stories = $this->storyRepository->getStoryWithByKeyWord($request->get('key_word'));

        $storiesIds = [];
        if (count($stories) > 0) {
            foreach ($stories as $story) {
                $storiesIds[] = $story->id;
            }
        }

        $chapterLast = [];

        if ($storiesIds) {
            $chapterLast = $this->chapterRepository->getChapterLast($storiesIds);
            $stories->map(function ($story) use ($chapterLast) {
                foreach ($chapterLast as $chapter) {
                    if ($story->id == $chapter->story_id) {
                        return $story->chapter_last = $chapter;
                    }
                }
            });
        }

        $data = [
            'stories' => $stories,
            'keyWord' => $request->get('key_word')
        ];
        return view('Frontend.main_search', $data);
    }
    public function register_publisher(Request $request):RedirectResponse
    {
        $data = $request->validate(
            [
                'fullname' => 'required|max:100',
                'username' => 'required|unique:publishers|max:100',
                'sdt' => 'required|max:100',
                'email' => 'required|unique:publishers|max:100',
                'password' => 'required|required_with:password|same:password_confirmation|max:100',
            ],
            [
                'username.unique'=> 'Tên username đã có, xin điền tên khác',
                'email.unique'=> 'Tên email đã có, xin điền tên khác',

                'email.required'=> 'Tên username phải có',
                'username.required'=> 'Tên email phải có',
                'password.required'=> 'Mật khẩu phải có',
                'fullname.required'=> 'FullName phải có',
                'sdt.required'=> 'Số điện thoại  phải có',
            ]
            );
        $publisher =new Publisher();
        $publisher-> email= $data['email'];
        $publisher-> password=md5 ($data['password']);
        $publisher-> username= $data['username'];
        $publisher-> fullname= $data['fullname'];
        $publisher-> sdt= $data['sdt'];
        $dateCreated = Carbon::now();
        $publisher->date_created = $dateCreated;
        $publisher->save();

        return redirect()->back()->with('success', 'Đăng kí thành công');
    }
    public function login_publisher(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required',
                
                'password' => 'required',
            ],
            [
                'username.required'=> 'Tên email phải có',
                'password.required'=> 'Mật khẩu phải có',
            ]
            );
        $publisher = Publisher::where('username' ,$data['username'])->where('password',md5($data['password']))->first();
        if($publisher){
            Session::put('login_publisher',true);
            Session::put('publisher_id',$publisher->id);
            Session::put('username',$publisher->username);
            Session::put('email_publisher',$publisher->email_publisher);
            return redirect()->to('/')->with('success', 'Đăng nhập thành công');
        }else{
            return redirect()->back()->with('success', 'Mật khẩu hoặc tài khoản sai. Vui lòng nhập lại');
        }  
    }
    public function sign_out(Request $request){
        Session::forget('login_publisher'); 
        Session::forget('publisher_id');
        Session::forget('username');
        Session::forget('email_publisher');
        return redirect()->back()->with('success', 'Đăng xuất thành công');
    }

    public function yeu_thich(){
        $setting = Helper::getSetting();

        $objectSEO = (object) [
            'name' => $setting ? $setting->title : 'Truyện Zin',
            'description' => $setting ? $setting->description : 'Đọc truyện online, truyện hay. Truyện Zin luôn tổng hợp và cập nhật các chương truyện một cách nhanh nhất.',
            'keywords' => 'dang nhap khach hang, đăng nhap khách hàng',
            'no_index' => $setting ? !$setting->index : env('NO_INDEX'),
            'meta_type' => 'WebPage',
            'url_canonical' => route('home'),
            'image' => asset('assets/frontend/images/logo_text1.png'),
            'site_name' => 'Truyện Zin'
        ];

        Helper::setSEO($objectSEO);

        $favorites = Favorite::with('publisher')->where('publisher_id',Session::get('publisher_id'))->orderBy('date_updated','DESC')->get();
        return view('Frontend.user.yeuthich')->with(compact('favorites'));
    }
    public function themyeuthich(Request $request){
        $data = $request->all();
        $favorite_check = Favorite::where('title', $data['title'])->where('publisher_id', $data['publisher_id'])->first();
        if($favorite_check){
            echo 'Fail';
        }else{
        $favorite = new Favorite();
        $favorite->title = $data['title'];
        $favorite->image = $data['image'];
        $favorite->status = 0;
        $favorite->publisher_id = $data['publisher_id'];
        $favorite->save();
        echo 'Done';
    }
    }
    
    public function xoayeuthich($id)
    {
        $favorite = Favorite::find($id);

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('status', 'Đã xoá yêu thích thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy yêu thích để xoá.');
        }
    }
}