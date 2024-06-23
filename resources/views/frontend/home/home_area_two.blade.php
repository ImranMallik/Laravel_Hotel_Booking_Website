 <!-- Book Area Two-->
 @php
     $book_area = App\Models\BookArea::find(1);
 @endphp
 <div class="book-area-two pt-100 pb-70">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-6">
                 <div class="book-content-two">
                     <div class="section-title">
                         <span class="sp-color">{{ $book_area->short_title }}</span>
                         <h2>
                             {{ $book_area->main_title }}
                         </h2>
                         <p>
                             {{ $book_area->short_desc }}
                         </p>
                     </div>
                     <a href="{{ $book_area->link_url }}" class="default-btn btn-bg-three">Quick Booking</a>
                 </div>
             </div>

             <div class="col-lg-6">
                 <div class="book-img-2">
                     <img src="{{ asset('upload/bookarea/' . $book_area->image) }}" alt="Images" />
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Book Area Two End -->
