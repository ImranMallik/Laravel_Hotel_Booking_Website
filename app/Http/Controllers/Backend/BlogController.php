<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    //

    public function blogcategory()
    {
        $categoryData = Blog::latest()->get();
        return view('backend.category.blog_category', compact('categoryData'));
    }

    public function StoreBlogCategory(Request $request)
    {

        Blog::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id)
    {

        $categories = Blog::find($id);
        return response()->json($categories);
    }

    public function UpdateBlogCategory(Request $request)
    {

        $cat_id = $request->cat_id;

        Blog::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

    public function DeleteBlogCategory($id)
    {

        Blog::find($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
    // Blog Post

    public function allBlogPost()
    {
        $post = BlogPost::latest()->get();
        return view('backend.post.all_post', compact('post'));
    }

    public function addBlogPost()
    {
        $blogcat = Blog::latest()->get();
        return view('backend.post.add_post', compact('blogcat'));
    }


    public function storeBlogPost(Request $request)
    {
        $image = $request->file('post_image');
        $image = new ImageManager(new Driver());
        $nam_gen = hexdec(uniqid()) . '.' . $request->file('post_image')->getClientOriginalExtension();
        $img = $image->read($request->file('post_image'));
        $directory = 'upload/blog/';
        $img = $img->resize(550, 370);
        $img->toJpeg(100)->save(public_path($directory . $nam_gen));
        $save_url = $directory . $nam_gen;

        BlogPost::insert([

            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_titile' => $request->post_titile,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_titile)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'BlogPost Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog-post')->with($notification);
    }

    public function EditBlogPost($id)
    {

        $blogcat = Blog::latest()->get();
        $post = BlogPost::find($id);
        return view('backend.post.edit_post', compact('blogcat', 'post'));
    }


    public function UpdateBlogPost(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {

            $image = new ImageManager(new Driver());
            $nam_gen = hexdec(uniqid()) . '.' . $request->file('post_image')->getClientOriginalExtension();
            $img = $image->read($request->file('post_image'));
            $directory = 'upload/blog/';
            $img = $img->resize(550, 370);
            $img->toJpeg(100)->save(public_path($directory . $nam_gen));
            $save_url = $directory . $nam_gen;

            BlogPost::findOrFail($post_id)->update([

                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_titile' => $request->post_titile,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_titile)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog-post')->with($notification);
        } else {

            BlogPost::findOrFail($post_id)->update([

                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_titile' => $request->post_titile,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_titile)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog-post')->with($notification);
        } // End Eles 


    } // End Method 



    public function DeleteBlogPost($id)
    {

        $item = BlogPost::findOrFail($id);
        $img = $item->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function blogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $bcategory = Blog::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        return view('frontend.blogs.blog_details', compact('blog', 'bcategory', 'lpost'));
    }


    public function blogCatdetails($id)
    {
        $blogCataList = BlogPost::where('blogcat_id', $id)->get();
        $bcataName = Blog::where('id', $id)->first();
        $bcategory = Blog::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        return view('frontend.blogs.blog_cat_list', compact('blogCataList', 'bcategory', 'lpost', 'bcataName'));
    }

    public function BlogList()
    {
        $blog = BlogPost::latest()->paginate(3);
        $bcategory = Blog::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        return view('frontend.blogs.all_blog', compact('blog', 'bcategory', 'lpost'));
    }
}
