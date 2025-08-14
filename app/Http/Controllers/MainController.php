<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactUs;
use Laracasts\Flash\Flash;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\ContactResource;
use App\Http\Requests\StoreContactRequest;

class MainController extends Controller
{
        use ApiResponseTrait;



     protected $contactService;
       public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
//    public function contacts(): AnonymousResourceCollection
//     {
//         $contacts = $this->contactService->getAllContacts();
//         return ContactResource::collection($contacts);
//       }
public function store(StoreContactRequest $request)
{
    try {
        $contact = $this->contactService->createContact($request->validated());
        return $this->success(new ContactResource($contact), 'Contact submitted successfully', 201);
    } catch (\Exception $e) {
        return $this->error('Failed to submit contact', 500, ['error' => $e->getMessage()]);
    }
}

    public function contacts()
    {
        try {
            $contacts = $this->contactService->getAllContacts();
            return $this->success(ContactResource::collection($contacts), 'Contacts fetched successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to fetch contacts', 500, ['error' => $e->getMessage()]);
        }
    }




    public function checkRole(){
        if (auth()->check()) {
            if (auth()->user()->role == "admin") {

                return redirect()->route('admin.dashboard');
            } else {

                return redirect()->route('profile.edit');
            }
        } else {

            return redirect()->route('login');
        }

    }


    public function contactList()
    {
        return view('admin.contacts.list');
    }
    public function contactUs()
    {
        return view('frontend.contact-us');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.blogs',compact('blogs'));
    }
    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        $recentBlog = Blog::select('id', 'title', 'slug', 'thumbnail', 'created_at')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $categories = BlogCategory::withCount('blogs')->get(); // Get categories with blog count

        if ($blog) {
            return view('frontend.blog-detail', compact('blog', 'recentBlog', 'categories'));
        } else {
            return redirect()->back()->with("error", "Blog Detail Not Found");
        }
    }

    public function categoryBlogs($slug){

        $category = BlogCategory::where('slug', $slug)->first();
        $blogs = Blog::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.category-blogs', compact('blogs', 'category'));

    }




}
