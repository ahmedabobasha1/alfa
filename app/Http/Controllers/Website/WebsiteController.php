<?php

namespace App\Http\Controllers\Website;

use App\Enums\AlbumType;
use App\Enums\SectionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\SaveCareerApplicationRequest;
use App\Http\Requests\Website\StoreContactUsRequest;
use App\Models\AboutStruct;
use App\Models\AboutUs;
use App\Models\Album;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Category;
use App\Models\GalleryVideo;
use App\Models\Page;
use App\Models\Partener;
use App\Models\Product;
use App\Models\Project;
use App\Models\Section;
use App\Models\Service;
use App\Models\SiteAddress;
use App\Models\Statistic;
use App\Models\Subscribe;
use App\Models\Team;
use App\Services\Dashboard\SaveApplicationService;
use App\Services\Seo\SeoService;
use App\Services\Website\ContactUsService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function about()
    {
        $data['about'] = AboutUs::first();
        $data['about_structs'] = AboutStruct::active()->get();
        $data['statistics'] = Statistic::active()->get();
        $data['teams'] = Team::active()->orderBy('order')->get();
        $data['benefits'] = Benefit::active()->get();

        $data['about_structs_section'] = Section::where('key', 'about_structs_section')->first();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forAbout();

        return view('Website.about', $data);
    }

    public function products()
    {
        $data['products'] = Product::with('images')->active()->paginate(12);

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forProducts();

        return view('Website.products', $data);
    }

    public function productDetails(Product $product)
    {
        $data['product'] = $product->load('images');
        $data['related_products'] = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->take(4)
            ->get();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forProductDetails($product);

        return view('Website.product-details', $data);
    }

    public function blogs()
    {
        $data['blogs'] = Blog::active()->orderBy('order')->get();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forBlogs();

        return view('Website.blogs', $data);
    }

    public function blogDetails(Blog $blog)
    {
        $data['blog'] = $blog;
        $data['services'] = Service::active()->get();
        $data['related_blogs'] = Blog::where('id', '!=', $blog->id)
            ->active()
            ->take(3)
            ->get();
        $data['site_addresses'] = SiteAddress::active()->orderBy('order')->get();
        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forBlogDetails($blog);

        return view('Website.blog-details', $data);
    }

    public function showContactUs()
    {
        // $data['site_addresses'] = SiteAddress::active()->orderBy('order')->get();
        $data['contact_us_page'] = Section::type(SectionType::CONTACT_US_PAGE)->first();
        $data['services'] = Service::active()->get();
        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forContact();

        return view('Website.contact-us', $data);
    }

    public function saveContactUs(StoreContactUsRequest $request)
    {
        try {

            $data = $request->validated();

            $response = (new ContactUsService)->store($data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('website.failed_to_send_message')]);
            }

            return redirect()->back()->with(['success' => __('website.thanks_message')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('website.something wrong pls try letter')]);
        }
    }

    public function gallery()
    {

        $albums = Album::with('images')
                        ->active()
                        ->whereNull('type')
                        ->orderBy('order')
                        ->get();

        return view('Website.gallery', compact('albums'));
    }

    public function beforeAfter()
    {
        $albums = Album::with('images')->active()->type(AlbumType::BEFORE_AFTER->value)->get();

        return view('Website.before-after', compact('albums'));
    }

    public function projectDetails(Project $project)
    {
        $data['project'] = $project->load('images');

        $data['other_projects'] = Project::with('images')->where('id', '!=', $project->id)->orderBy('order')->active()->take(3)->get();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forProjectDetails($project);

        return view('Website.project-details', $data);
    }

    public function services()
    {
        $data['services'] = Service::active()->orderBy('order')->get();

        $data['services_page_section'] = Section::type(SectionType::SERVICES_PAGE)->first();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forServices();

        return view('Website.services', $data);
    }

    public function serviceDetails(Service $service)
    {
        $data['service'] = $service->load('images');
        $data['related_services'] = Service::where('id', '!=', $service->id)->active()->take(3)->get();

        if ($service->children->isNotEmpty()) {
            $data['services'] = $service->children;
            $seoService = new SeoService;
            $data['seoHandler'] = $seoService->forServiceDetails($service);

            return view('Website.services', $data);
        }

        $seoService = new SeoService;
        $data['site_addresses'] = SiteAddress::active()->orderBy('order')->get();
        $data['seoHandler'] = $seoService->forServiceDetails($service);

        return view('Website.service-details', $data);
    }

    public function projects()
    {
        $data['categories'] = Category::with('projects')->whereHas('projects', function ($query) {
            $query->active()->notPrevious()->orderBy('order');
        })->active()->get();
        $data['projects'] = Project::with(['images', 'category'])->active()->notPrevious()->orderBy('order')->get();
        $data['projects_page_section'] = Section::type(SectionType::PROJECTS_PAGE)->first();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forProjects();

        return view('Website.projects', $data);
    }

    public function saveApplication(SaveCareerApplicationRequest $request)
    {
        try {

            $response = (new SaveApplicationService)->saveApplication($request);

            if (! $response) {
                return redirect()->back()->with(['error' => __('website.failed_to_send_message')]);
            }

            return redirect()->back()->with(['success' => __('website.thanks_message')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('website.something wrong pls try letter')]);
        }
    }

    public function partners()
    {
        $data['partners'] = Partener::active()->get();
        $data['section'] = Section::where('key', 'partners_page')->first();

        return view('Website.partners', $data);
    }

    // public function categories()
    // {
    //     $data['categories'] = Category::with('projects')
    //         ->whereHas('projects', function ($query) {
    //             $query->active();
    //         })
    //         ->active()
    //         ->orderBy('order')
    //         ->get();
    //     return view('Website.categories', $data);
    // }
    public function categoryDetails(Category $category)
    {
        $data['category'] = $category;
        $data['projects'] = $category->projects()->active()->get();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forCategoryDetails($category);

        return view('Website.category-details', $data);
    }

    public function teams()
    {
        $data['doctors'] = Team::active()->get();

        return view('Website.teams', $data);
    }

    public function teamDetails(Team $team)
    {
        $data['team'] = $team;

        return view('Website.team-details', $data);
    }

    public function pageDetails(Page $page)
    {
        return view('Website.page-details', compact('page'));
    }

    public function saveSubscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        Subscribe::updateOrCreate(['email' => $data['email']]);

        return redirect()->back()->with(['success' => __('website.thanks_message')]);
    }

    public function videos()
    {
        $videos = GalleryVideo::active()->get();

        return view('Website.videos', compact('videos'));
    }

    public function previousProjects()
    {
        $data['categories'] = Category::with([
            'projects' => function ($query) {
                $query->with('images')->active()->previous()->orderBy('order');
            },
        ])->whereHas('projects', function ($query) {
            $query->active()->previous();
        })->active()->orderBy('order')->get();

        return view('Website.previous-projects', $data);
    }
}
