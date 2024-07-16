<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    //

    public function allTestimonial()
    {
        $testimonialData = Testimonial::orderBy('id', 'desc')->latest()->get();

        return view('backend.testimonial.all_testimonial', compact('testimonialData'));
    }

    public function addTestimonial()
    {
        return view('backend.testimonial.add_testimonial');
    }

    public function storeTestimonial(Request $request)
    {
        if ($request->file('image')) {
            $image = new ImageManager(new Driver());
            $nam_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $image->read($request->file('image'));
            $directory = 'upload/tastimonial/';
            $img = $img->resize(50, 50);
            $img->toJpeg(100)->save(public_path($directory . $nam_gen));
            $save_url = $directory . $nam_gen;
        }

        Testimonial::insert([
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(

            'message' => 'Testimonial Data Inserted Successfully ',
            'alert-type' => 'success'

        );

        return redirect()->route('all.testimonial')->with($notification);
    }

    public function editTestimonial($id)
    {
        $id = Testimonial::findOrFail($id);

        return view('backend.testimonial.edit_testimonial', compact('id'));
    }

    public function submitTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);


        if ($request->file('image')) {
            if ($request->file('image')) {
                $image = new ImageManager(new Driver());
                $nam_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
                $img = $image->read($request->file('image'));
                $directory = 'upload/tastimonial/';
                $img = $img->resize(50, 50);
                $img->toJpeg(100)->save(public_path($directory . $nam_gen));
                $save_url = $directory . $nam_gen;
            }

            $testimonial->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(

                'message' => 'Testimonial Updated With Image Successfully ',
                'alert-type' => 'success'

            );

            return redirect()->route('all.testimonial')->with($notification);
        } else {
            $testimonial->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(

                'message' => 'Testimonial With Out Image Successfully ',
                'alert-type' => 'success'

            );

            return redirect()->route('all.testimonial')->with($notification);
        }
    }

    // Delete testimonial

    public function deleteTestimonial($id)
    {
        $deleteData = Testimonial::findOrFail($id);
        $img = $deleteData->image;
        unlink($img);

        Testimonial::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
