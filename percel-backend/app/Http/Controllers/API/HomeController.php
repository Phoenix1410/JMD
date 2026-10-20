<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;
use App\Slider;
use App\Slidertwo;
use App\HomepageSetting;
use App\Categorie;
use App\ProductVideo;
use App\Models\Settings;
use App\Models\Contact;
use App\ProductBestSeller;
use App\Deal;
use App\ManageCategory;
use App\ProductReview;
use App\ProductListView;
use App\Product;
use App\User;

use Hash;
use CommonHelper;

class HomeController extends Controller
{
    public function states(){
        $states=DB::table('states')->select('states.id','states.name','states.image')->where('country_id',101)->where('status',1)->get();
        return response()->json([
            'status' => 1,
            'responseText' => 'Home Page Fetch Successful',
            'responseData' => [
                'states' => $states,
               
            ]]);

    }
    public function cms($slug){
        $cms=DB::table('cms_pages')->where('page_slug',$slug)->first();
        return response()->json([
            'status' => 1,
            'responseText' => 'Home Page Fetch Successful',
            'responseData' => [
                'cms'=> $cms
            ]]);
    }
    public function homeitems()
    {
         $Sliders = Slider::where('status', 1)->get();
         $elements = HomepageSetting::where('status', 1)->get();
         $collections = DB::table('home_layouts')
            ->leftJoin('collections', 'home_layouts.collection_id', '=', 'collections.id')
            ->select(
                'home_layouts.id',
                'collections.id as collection_id',
                'collections.name as title',
                'collections.slug',
                'collections.parent_id',
                'collections.short_description',
                'home_layouts.layout',
                'home_layouts.button',
                'home_layouts.sort_order as sort',
                'collections.collection_banner as image',
                'collections.mobile_image as mobileimage'
            )
            ->orderBy('home_layouts.sort_order', 'asc')
            ->get();
            $formattedCollections = $collections->map(function ($item) {
            // Format image path
            $item->image = $item->image
                ? $item->image
                : asset('assets/frontend/images/no-image.jpg');
            $item->mobileimage = $item->mobileimage
                ? $item->mobileimage
                : asset('assets/frontend/images/no-image.jpg');


            // ✅ Build route URL
            if ($item->parent_id == 0) {
                // Parent collection => /collection-slug
                $item->route = '/' . $item->slug;
            } else {
                // Subcollection => find parent slug first
                $parent = DB::table('collections')->where('id', $item->parent_id)->first();
                if ($parent) {
                    $item->route ='/' . $parent->slug . '/' . $item->slug;
                } else {
                    $item->route ='/' . $item->slug; // fallback
                }
            }

            return $item;
        });
         return response()->json([
            'satus' => 1,
            'responseText' => 'Home Page Fetch Successful',
            'responseData' => [
                'sliders' => $Sliders,
                'elements' => $elements,
                'collections'=> $formattedCollections
            ]]);
    }
     public function productitems()
    {
         $Sliders = Slidertwo::where('status', 1)->get();
        $elements = [];
         return response()->json([
            'satus' => 1,
            'responseText' => 'Home Page Fetch Successful',
            'responseData' => [
                'sliders' => $Sliders,
                'elements' => $elements,
            ]]);
    }
    public function Home()
    {
        $data = [];
        $categoryData = Categorie::where('status', 1)
            ->where('approved', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->limit(4)
            ->get();
        $Sliders = Slider::where('status', 1)->get();
        $deals = Deal::with('getProducts', 'getCategories')->get();
        $product_ids = \App\OrderProduct::select('product_id', DB::raw('(select count(product_id) from order_product as p1 where p1.product_id=order_product.product_id group by product_id) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->pluck('product_id')
            ->toArray();
        $products = \App\ProductListView::select('*', DB::raw('(select count(product_id) from order_product as p1 where p1.product_id=product_list_view.product_id group by product_id) as count'))
            ->whereIn('product_id', $product_ids)
            ->orderBy('count', 'desc')
            ->where('status', 1)
            ->where('approved', 1)
            ->limit(4)
            ->get();
        $topSellings = \CommonHelper::updateItems($products);
        $layout = HomepageSetting::first();

        $bestSallers = ProductBestSeller::with('getProduct')
            ->where('status', 1)
            ->limit(4)
            ->inRandomOrder()
            ->get();
        $trending_products = ProductListView::where('trending', 1)
            ->where('status', 1)
            ->limit(4)
            ->where('approved', 1)
            ->get();
        $trendingProductsUpdateds = \CommonHelper::updateItems($trending_products);

        $catArray = [];
        $topSellingArray = [];
        $SlidersArray = [];
        $dealArray = [];
        $bestSallerArray = [];

        $trendingProductsUpdatedDataArray = [];

        foreach ($categoryData as $category) {
            $CategorieSlug = Categorie::where('parent_id', $category->id)->get();
            $subCatArray = [];
            foreach ($CategorieSlug as $subcategory) {
                $Slug = [
                    'categoryId' => (string) $subcategory->id,
                    'name' => $subcategory->name,
                    'categoryBanner' => $subcategory->category_banner == '' ? asset('uploads/users/placeholder.jpg') : $subcategory->category_banner,
                ];
                array_push($subCatArray, $Slug);
            }
            $catData = [
                'id' => (string) $category->id,
                'name' => $category->name,
                'categoryBanner' => $category->category_banner == '' ? asset('uploads/users/placeholder.jpg') :$category->category_banner,
                'subCategory' => $subCatArray,
            ];
            array_push($catArray, $catData);
        }
        foreach ($topSellings as $topSelling) {
            $reviewTop = ProductReview::where('product_id', $topSelling->product_id)->count();
            $review_dataTop = ProductReview::where('product_id', $topSelling->product_id)->get();
            $discountTop = (($topSelling['mrp_price'] - $topSelling['unit_price']) / $topSelling['mrp_price']) * 100;
            $discount_percentageTop = round($discountTop);
            if ($reviewTop > 0) {
                $total_ratingTop = 0;
                foreach ($review_dataTop as $key => $valueTop) {
                    $total_ratingTop += (int) $valueTop->rating;
                }
                $avg_ratingTop = (int) $total_ratingTop / $reviewTop;
            } else {
                $avg_ratingTop = 0;
            }
            $topData = [
                'productId' => (string) $topSelling->product_id,
                'productName' => $topSelling->name,
                'productImage' => $topSelling->image == '' ? asset('uploads/users/placeholder.jpg') :$topSelling->image,
                'quantity' => (string) $topSelling->quantity,
                'isPrime' => (string) $topSelling->is_prime,
                'countSells' => (string) $topSelling->countSells(),
                'mrpPrice' => (string) $topSelling->mrp_price,
                'unitPrice' => (string) $topSelling->base_price,
                'discount' => (string) $discount_percentageTop,
                'review' => (string) $reviewTop,
                'rating' => (string) $avg_ratingTop,
            ];
            array_push($topSellingArray, $topData);
        }
        foreach ($bestSallers as $bestSaller) {
            $CatDataBest = DB::table('products')
                ->join('product_images', 'products.id', 'product_images.product_id')
                ->where('products.id', $bestSaller->product_id)
                ->first();
            // dd($bestSaller->getProduct);

            $reviewbe = ProductReview::where('product_id', $bestSaller->getProduct->id)->count();
            $review_databe = ProductReview::where('product_id', $bestSaller->getProduct->id)->get();
            $discountbe = (($bestSaller->getProduct->mrp_price - $bestSaller->getProduct->base_price) / $bestSaller->getProduct->mrp_price) * 100;
            $discount_percentagebe = round($discountbe);
            if ($reviewbe > 0) {
                $total_ratingbe = 0;
                foreach ($review_databe as $key => $valuebe) {
                    $total_ratingbe += (int) $valuebe->rating;
                }
                $avg_ratingbe = (int) $total_ratingbe / $reviewbe;
            } else {
                $avg_ratingbe = 0;
            }

            $catDataNew = [
                'productId' => (string) $bestSaller->getProduct->id,
                'productName' => $bestSaller->getProduct->name,
                'productImage' => $CatDataBest->image == '' ? asset('uploads/users/placeholder.jpg') :$CatDataBest->image,
                'quantity' => (string) $bestSaller->getProduct->quantity,
                'mrpPrice' => (string) $bestSaller->getProduct->mrp_price,
                'unitPrice' => (string) $bestSaller->getProduct->base_price,
                'discount' => (string) $discount_percentagebe,
                'isPrime' => (string) $topSelling->is_prime,
                'countSells' => (string) $topSelling->countSells(),
                'review' => (string) $reviewbe,
                'rating' => (string) $avg_ratingbe,
            ];

            array_push($bestSallerArray, $catDataNew);
        }
        foreach ($Sliders as $Slider) {
            $SliderData = [
                'id' => (string) $Slider->id,
                'name' => $Slider->title,
                'SliderImage' => $Slider->slider_image == '' ? asset('uploads/site/sliders/slider-image-1673091852.jpg') : $Slider->slider_image,
            ];
            array_push($SlidersArray, $SliderData);
        }

        foreach ($trendingProductsUpdateds as $trendingProductsUpdated) {
            $reviewtr = ProductReview::where('product_id', $trendingProductsUpdated->id)->count();
            $review_datatr = ProductReview::where('product_id', $trendingProductsUpdated->id)->get();
            $discounttr = (($trendingProductsUpdated->mrp_price - $trendingProductsUpdated->price) / $trendingProductsUpdated->mrp_price) * 100;
            $discount_percentagetr = round($discounttr);
            if ($reviewtr > 0) {
                $total_ratingtr = 0;
                foreach ($review_datatr as $key => $valuetr) {
                    $total_ratingtr += (int) $valuetr->rating;
                }
                $avg_ratingtr = (int) $total_ratingtr / $reviewtr;
            } else {
                $avg_ratingtr = 0;
            }

            $trendingProductsUpdatedData = [
                'productId' => (string) $trendingProductsUpdated->id,
                'productName' => $trendingProductsUpdated->name,
                'productImage' => $trendingProductsUpdated->image == '' ? asset('uploads/users/placeholder.jpg') :$trendingProductsUpdated->image,
                'quantity' => (string) $trendingProductsUpdated->quantity,
                'mrpPrice' => (string) $trendingProductsUpdated->mrp_price,
                'unitPrice' => (string) $trendingProductsUpdated->price,
                'discount' => (string) $discount_percentagetr,
                'isPrime' => (string) $topSelling->is_prime,
                'countSells' => (string) $topSelling->countSells(),
                'review' => (string) $reviewtr,
                'rating' => (string) $avg_ratingtr,
            ];
            array_push($trendingProductsUpdatedDataArray, $trendingProductsUpdatedData);
        }

        $dealProductsArray = [];
        foreach ($deals as $deal) {
            if (count($deal->getProducts) > 0) {
                foreach ($deal->getProducts as $products) {
                    $productIdData = DB::table('products')
                        ->join('product_images', 'products.id', 'product_images.product_id')
                        ->where('products.id', $products->product_id)
                        ->first();
                    $reviewDeal = ProductReview::where('product_id', $productIdData->product_id)->count();
                    $review_dataDeal = ProductReview::where('product_id', $productIdData->product_id)->get();
                    $discountDeal = (($productIdData->mrp_price - $productIdData->unit_price) / $productIdData->mrp_price) * 100;
                    $discount_percentageDeal = round($discountDeal); 
                    if ($reviewDeal > 0) {
                        $total_ratingDeal = 0;
                        foreach ($review_dataDeal as $key => $valueDeal) {
                            $total_ratingDeal += (int) $valueDeal->rating;
                        }
                        $avg_ratingDeal = (int) $total_ratingDeal / $reviewDeal;
                    } else {
                        $avg_ratingDeal = 0;
                    }
                    $dataP[] = [
                        'id' => (string) $productIdData->product_id,
                        'type' => 'product',
                        'name' => $productIdData->name,
                        'image' => $productIdData->image == '' ? asset('uploads/users/placeholder.jpg') :$productIdData->image,
                        // 'quantity' => (string) $productIdData->quantity,
                        // 'mrpPrice' => (string) $productIdData->mrp_price,
                        // 'unitPrice' => (string) $productIdData->unit_price,
                        // 'discount' => (string) $discount_percentageDeal,
                        // 'review' => (string) $reviewDeal,
                        // 'rating' => (string) $avg_ratingDeal,
                    ];
                }
            }

            if (count($deal->getCategories) > 0) {
                foreach ($deal->getCategories as $getCategories) {
                    $productIdDataCategories = DB::table('categories')
                        ->where('id', $getCategories->category_id)
                        ->first();
                    $dataP[] = [
                        'id' => (string) $productIdDataCategories->id,
                        // 'dealId' => (string) $getCategories->deal_id,
                        'type' => 'category',
                        'name' => $productIdDataCategories->name,
                        'image' =>$productIdDataCategories->category_banner,
                    ];
                }
            }

            $dealData = [
                'id' => (string) $deal->id,
                'name' => $deal->title,
                'slug' => $deal->slug,
                'ProductsDetails' => $dataP,
            ];
            $dataP = [];
            array_push($dealArray, $dealData);
        }

        $data['TopBannerOne'] = [
            'imageUrl' => $layout->top_banner_add_image1,
            'LinkUrl' => $layout->top_banner_add_image1_url != null ? 'register' : '',
        ];
        $data['TopBannerTwo'] = [
            'imageUrl' => $layout->top_banner_add_image2,
            'LinkUrl' => $layout->top_banner_add_image2_url != null ? 'category' : '',
        ];
        $data['AdBannerOne'] = [
            'imageUrl' => $layout->banner_add2_image1,
            'LinkUrl' => $layout->banner_add2_image1_url != null ? '' : '',
        ];
        $data['AdBannerTwo'] = [
            'imageUrl' => $layout->top_banner_add_image2,
            'LinkUrl' => $layout->top_banner_add_image2_url != null ? 'category' : '',
        ];
        $data['AdBannerThree'] = [
            'imageUrl' => $layout->banner_add3_image1,
            'LinkUrl' => $layout->banner_add3_image1_url != null ? '' : '',
        ];
        $productVideo =  ProductVideo::select('product_videos.*', 'products.name', 'products.slug')->join('products', 'products.id', '=', 'product_videos.product_id')->get();
        $VideoData = [];
        foreach ($productVideo as $productVideos) {
            $Data = [
                'id' => (string) $productVideos->id,
                'productId' => (string) $productVideos->product_id,
                'sellerId' => (string)$productVideos->seller_id,
                'videoUrl' => $productVideos->video_url,
                'videoThumb' => $productVideos->video_thumb,
                'name' => $productVideos->name,
                'slug' => $productVideos->slug,
            ];
            array_push($VideoData, $Data);
        }
        $data['ShopByCategory'] = $catArray;
        $data['video'] = $VideoData;
        $data['topSelling'] = $topSellingArray;
        $data['sliders'] = $SlidersArray;
        $data['Deals'] = $dealArray;

        $data['bestSaller'] = $bestSallerArray;
        $data['trendingProducts'] = $trendingProductsUpdatedDataArray;
        return response()->json([
            'responseCode' => 1,
            'responseText' => 'Home Page Fetch Successful',
            'responseData' => $data,
        ]);
    }

    public function Categories()
    {
        $categoryData = Categorie::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        $catArray = [];
        foreach ($categoryData as $category) {
            $CategorieSlug = Categorie::where('parent_id', $category->id)->get();
            $subCatArray = [];
            foreach ($CategorieSlug as $subcategory) {
                $Slug = [
                    'categoryId' => (string) $subcategory->id,
                    'name' => $subcategory->name,
                    'categoryBanner' => $subcategory->category_banner == '' ? asset('uploads/users/placeholder.jpg') :$subcategory->category_banner,
                ];
                array_push($subCatArray, $Slug);
            }
            $catData = [
                'categoryId' => (string) $category->id,
                'name' => $category->name,
                'categoryBanner' => $category->category_banner == '' ? asset('uploads/users/placeholder.jpg') :$category->category_banner,
                'subCategory' => $subCatArray,
            ];
            array_push($catArray, $catData);
        }

        if ($catArray) {
            return response()->json([
                'responseCode' => 1,
                'responseText' => 'All Category',
                'responseData' => $catArray,
            ]);
        } else {
            return response()->json([
                'responseCode' => 0,
                'responseText' => 'Category not found!',
            ]);
        }
    }

    public function featuredProduct()
    {
        $data = Product::select('id', 'product_name', 'thumbnail', 'description', 'slug', 'summary')
            ->where('is_product_featured', 1)
            ->where('status', '1')
            ->where('is_delete', '0')
            ->orderBy('id', 'DESC')
            ->get();
        if ($data) {
            return response()->json([
                'responseCode' => 1,
                'responseText' => 'featured Product list!',
                'responseData' => $data,
            ]);
        } else {
            return response()->json([
                'responseCode' => 0,
                'responseText' => 'featured Product not found!',
            ]);
        }
    }

    public function AllBrand()
    {
        $data = DB::table('manage_banners')
            ->select('id', 'name', 'image', 'link')
            ->where('banner_type', 'brand')
            ->where('status', '1')
            ->where('is_delete', '0')
            ->get();
        if ($data) {
            return response()->json([
                'responseCode' => 1,
                'responseText' => 'featured Product list!',
                'responseData' => $data,
            ]);
        } else {
            return response()->json([
                'responseCode' => 0,
                'responseText' => 'featured Product not found!',
            ]);
        }
    }



public function contactUs(Request $request)
{
    // Insert into DB c
    try {
        $check = DB::table('contact_us')->insert([
            'name'  => $request->name,
            'email'      => $request->email,
            'phone' => $request->contact_no,
            'message'    => $request->inquiry,
            'status' =>   "1"
        ]);

        if (!$check) {
            return response()->json([
                'responseCode' => 0,
                'responseText' => 'Something went wrong while saving your inquiry!',
            ]);
        }

        $adminSetting = Settings::first();
        $data = array(
                'name' =>  $request->name,
                'email' => $request->email,
                'phone_number' => $request->contact_no,
                'status'=>"1",
                'message'=>$request->inquiry,
                // 'message' => $request->input('message')
            );
            $common_setting = Settings::where('id', 1)->select('admin_inquiry_email')->first();
            \AdminHelper::sendEmail(['to' =>  $common_setting->admin_inquiry_email, 'data' => $data, 'template' => 'contact-us-admin']);
            $data = array(
                'name' => $request->input('name'),
            );
            $eml =$request->input('email');
            \AdminHelper::sendEmail(['to' =>  $eml, 'data' => $data, 'template' => 'contact-us']);
            
        return response()->json(['status' => 1, 'message' => 'Your request submiited sucessfully. Our support team will revert to you as soon as possibe.']);

        return response()->json([
            'responseCode' => 1,
            'responseText' => 'Inquiry submitted successfully!',
        ]);

    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('ContactUs Mail error: ' . $e->getMessage());

        return response()->json([
            'responseCode' => 0,
            'responseText' => 'Something went wrong while sending the email!',
            'error'        => $e->getMessage(),
        ]);
    }
}

public function size(Request $request)
    {
        $data = DB::table('sizes')
            ->whereNot('id',12)
            ->where('status', '1')
            ->orderBy('sort','asc')
            ->get();
        if ($data) {
            return response()->json([
                'responseCode' => 1,
                'responseText' => 'Size list!',
                'responseData' => $data,
            ]);
        } else {
            return response()->json([
                'responseCode' => 0,
                'responseText' => 'Size not found!',
            ]);
        }
    }

    public function customerService(Request $request)
    {
        $adminSetting = Settings::first();
        // $foooterAddress=DB::table('offices as o')->leftJoin('office_types as ot', 'ot.id', '=', 'o.office_type_id')
        //     ->leftJoin('states as s','s.id','=','o.state')
        //     ->leftJoin('cities as c','c.id','=','o.city')
        //     ->where('o.status','1')
        //     ->select('o.office_name','o.address','s.name as state','c.name as city', 'ot.type_name')->get();
        $foooterAddress=DB::table('contact_addresses')->select('contact_addresses.title','contact_addresses.address')->where('status','1')->get();
           $footerBanner=DB::table('banner_images')->where('type',2)->first();
        // dd($footerBanner);
        $responseData = [
            'siteName' => $adminSetting->appname,
            'sitbrandimage'=> $adminSetting->logo,
            'siteLogo' => $adminSetting->favicon,
            'footerLogo' => $adminSetting->footer_logo,
            'facebook'=> $adminSetting->facebook_link,
            'instagram'=> $adminSetting->instagram_link,
            'phonenumber' => $adminSetting->site_phone_number,
            'additionalphonenumber'=>$adminSetting->additional_number,
            'companyName' =>$adminSetting->company,
            'twitter' => $adminSetting->twitter_link,
            'youtube' => $adminSetting->youtube_link,
            'linkedin' => $adminSetting->linkedin_link,
            'playstorelink'=>$adminSetting->playstorelink,
            'applestorelink'=>$adminSetting->apllestorelink,
            // 'dispatch'=>$adminSetting->R_dispatch_Time,
            'disclaimer'=>$adminSetting->notice,
            'email' => $adminSetting->site_email,
            'footercontent'=>$foooterAddress,
            'footerbanner'=>$footerBanner->image,
            // 'contactEmail' => $adminSetting->contact_email_additional,
            // 'sitePhone' => $adminSetting->contact_phone_number,
            // 'contactPhone' => $adminSetting->contact_phone_number_additional,
            // 'siteAddress' => $adminSetting->site_address,
        ];
        return response()->json([
            'responseCode' => 1,
            'responseText' => 'Customer service Fetch successfully.',
            'responseData' => $responseData,
        ]);
    }
    public function homepagecontent(Request $request){
        $headerBanner=DB::table('banner_images')->where('type',1)->where('status',1)->get();
        // $headercms = DB::table('who_we_are')
        // //  ->whereIn('id', [1,2,3,4])
        //  ->first();
         // Fetch news
        $ourpresence=DB::table('cms_pages')->where('page_slug','like','%our-presence%')->first();
        $cmdsdesk=DB::table('cms_pages')->where('page_slug','like','%from-cmds-desk%')->first();
        $ourservice=DB::table('cms_pages')->where('page_slug','like','%our-services%')->first();
        $services= $services = DB::table('services')
        ->where('status', 1)
        ->select('services.id','services.title','services.image','services.icon','services.text')
        ->orderBy('id', 'desc')
        ->paginate(4);
        $responseData = [
            'Headerbanner' => $headerBanner,
            'ourpresence'=>$ourpresence,
            'services' => $services->items(),
            'cmdsdesk'=>$cmdsdesk ,
            'ourservice'=>$ourservice,
        ];
        return response()->json([
            'responseCode' => 1,
            'responseText' => 'Customer service Fetch successfully.',
            'responseData' => $responseData,
        ]);
    }
public function submitForgetPasswordForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|max:255',
    ]);

    $user = User::where('email', $request->email)
                ->whereIn('user_type', [1,2])
                ->first();

    if (!$user) {
        return response()->json([
            'status'  => false,
            'message' => "We can't find a user with that e-mail address."
        ], 404);
    }

    $token = Str::random(64);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        [
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => now(),
        ]
    );

    try {

        $resetLink = 'https://muexclusive.com/beta/resetpassword/' . $token . '?email=' . $request->email;

        $mailData = [
            'name'    => $user->name ?? 'User',
            'link'    => $resetLink, // your blade already handles button if link exists
            'content' => 'We received your request to reset the password for forgot-password-user. Please use the following link to reset your password.',
            'whatsapplink' => 'https://api.whatsapp.com/send/?phone=919831166902',
            'subject' => 'Password Reset Request – Manjusha Upadhyay',
        ];

        Mail::send('emails.general', $mailData, function ($message) use ($request, $mailData) {
            $message->to($request->email)
                    ->subject($mailData['subject'])
                    ->from(env('MAIL_FROM_ADDRESS'), 'Manjusha Upadhyay');
        });

    } catch (\Exception $e) {

        \Log::error('Forget Password Mail error: ' . $e->getMessage());

        return response()->json([
            'status'  => false,
            'message' => "Can not send emails due to some technical errors.",
            'error'   => $e->getMessage(),
        ], 500);
    }

    return response()->json([
        'status'  => true,
        'message' => "We have emailed you a link to reset your password.",
    ]);
}


      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.passwords.reset', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function aboutus(){
        $data=DB::table('about_content')->first();
         return response()->json([
        'success' => true,
        'data' =>$data,
        'message' => 'Your password has been changed successfully!'
        ], 200);
      }
    public function submitResetPasswordForm(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email|exists:all_users,email',
        'password' => 'required|string|min:8|max:16|confirmed',
        'password_confirmation' => 'required'
    ]);

    $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $id
        ])
        ->first();

    if (!$updatePassword) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or expired token!'
        ], 400);
    }

    User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return response()->json([
        'success' => true,
        'message' => 'Your password has been changed successfully!'
    ], 200);
}

}
