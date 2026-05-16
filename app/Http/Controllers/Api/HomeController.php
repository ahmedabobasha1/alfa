<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AboutUsResource;
use App\Http\Resources\Website\BannerResource;
use App\Http\Resources\Website\BenefitResource;
use App\Http\Resources\Website\BlogResource;
use App\Http\Resources\Website\ClientResource;
use App\Http\Resources\Website\ContactUsResource;
use App\Http\Resources\Website\PartnerResource;
use App\Http\Resources\Website\ProjectResource;
use App\Http\Resources\Website\ServiceResource;
use App\Http\Resources\Website\SocialMediaResource;
use App\Http\Resources\Website\StatisticResource;
use App\Models\AboutUs;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Client;
use App\Models\Partener;
use App\Models\Project;
use App\Models\Section;
use App\Models\Service;
use App\Models\SiteAddress;
use App\Models\Slider;
use App\Models\Statistic;
use App\Services\Seo\SeoService;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Slider::type('home')->active()->first();
        $about = AboutUs::first();
        $clients = Client::active()->get();
        $service = Service::with('tabs')->home()->active()->orderBy('order')->latest()->take(6)->get();
        $projects = Project::with('tabs')->home()->active()->latest()->take(6)->get();
        $benefits = Benefit::active()->get();
        $achievements = Statistic::active()->get();
        $blogs = Blog::home()->active()->latest()->take(3)->get();
        $contact_section = Section::where('key', 'contact_section')->first();
        $siteAddress = SiteAddress::type('head_office')->first();
        $social_media_resource = new SocialMediaResource(null);
        $contact_data = [
            'email' => config('settings.site_email'),
            'phone' => config('settings.site_phone'),
            'address' => $siteAddress ? $siteAddress->address : null,
        ];
        $partners = Partener::active()->get();

        $banner_resource = new BannerResource($banner);
        $about_resource = new AboutUsResource($about);
        $clients_resource = ClientResource::collection($clients);
        $service_resource = ServiceResource::collection($service);
        $projects_resource = ProjectResource::collection($projects);
        $benefits_resource = BenefitResource::collection($benefits);
        $achievements_resource = StatisticResource::collection($achievements);
        $blogs_resource = BlogResource::collection($blogs);
        $contact_resource = new ContactUsResource($contact_section);
        $partners_resource = PartnerResource::collection($partners);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('home');

        return response()->json([
            'banner' => $banner_resource,
            'about' => $about_resource,
            'clients' => $clients_resource,
            'services' => $service_resource,
            'projects' => $projects_resource,
            'benefits' => $benefits_resource,
            'achievements' => $achievements_resource,
            'blogs' => $blogs_resource,
            'contact_section' => $contact_resource,
            'contact_data' => $contact_data,
            'social_media' => $social_media_resource,
            'partners' => $partners_resource,
            'seo' => $seoData,
        ]);
    }
}
