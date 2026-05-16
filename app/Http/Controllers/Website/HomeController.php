<?php

namespace App\Http\Controllers\Website;

use App\Enums\SectionType;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Album;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Partener;
use App\Models\Phone;
use App\Models\Project;
use App\Models\Section;
use App\Models\Service;
use App\Models\SiteAddress;
use App\Models\Slider;
use App\Models\Statistic;
use App\Models\Team;
use App\Models\Testimonial;
use App\Services\Seo\SeoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data['sliders'] = Slider::type('home')->active()->get();
        $data['about'] = AboutUs::first();
        $data['projects_section'] = Section::type(SectionType::PROJECTS)->first();
        $data['categories'] = Category::with([
            'projects' => function ($query) {
                $query->active()->home()->notPrevious()->orderBy('order');
            },
        ])->whereHas('projects', function ($query) {
            $query->active()->home()->notPrevious();
        })->active()->get();

        $data['previous_projects_section'] = Section::type(SectionType::PREVIOUS_PROJECTS)->first();
        $data['previous_projects'] = Project::with('images')->active()->home()->previous()->orderBy('order')->get();

        $data['blogs_section'] = Section::type(SectionType::BLOGS)->first();
        $data['blogs'] = Blog::with('category')->active()->home()->orderBy('order')->take(3)->get();


        $data['hero'] = Slider::type('home')->active()->first();
        $data['services'] = Service::whereNull('parent_id')
            ->active()
            ->home()
            ->orderBy('order')
            ->take(6)
            ->get();
        $data['projects'] = Project::with('images')->active()->home()->notPrevious()->orderBy('order')->take(3)->get();
      
        $data['albums'] = Album::with('images')->active()->whereNull('type')->orderBy('order')->take(6)->get();

        // $data['services_section'] = Section::type(SectionType::SERVICES)->first();

        $data['projects'] = Project::with('images')->active()->home()->notPrevious()->orderBy('order')->get();

        $data['contact_section'] = Section::type(\App\Enums\SectionType::CONTACT_SECTION)->first();

        $data['appointment_section'] = Section::where('key', 'appointment_section')->first();

        $data['doctors'] = Team::active()->orderBy('order')->get();
        $data['doctors_section'] = Section::where('key', 'doctors_section')->first();
        $data['testimonials'] = Testimonial::active()->get();
        $data['testimonials_section'] = Section::where('key', 'testimonials_section')->first();
        $data['partners'] = Partener::active()->get();
        $data['partners_section'] = Section::where('key', 'partners_section')->first();
        $data['statistics'] = Statistic::active()->get();
       

        $data['site_addresses'] = SiteAddress::active()->orderBy('order')->get();
        $data['phones'] = Phone::active()->get();

        $seoService = new SeoService;
        $data['seoHandler'] = $seoService->forHome();

        return view('Website.home', $data);
    }
}
