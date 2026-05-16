<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\StoreContactUsRequest;
use App\Http\Resources\Website\AboutStructResource;
use App\Http\Resources\Website\AboutUsResource;
use App\Http\Resources\Website\BlogResource;
use App\Http\Resources\Website\CategoryResource;
use App\Http\Resources\Website\ContactUsResource;
use App\Http\Resources\Website\ProjectResource;
use App\Http\Resources\Website\ServiceResource;
use App\Models\AboutStruct;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Project;
use App\Models\Section;
use App\Models\Service;
use App\Models\SiteAddress;
use App\Services\Seo\SeoService;
use App\Services\Website\ContactUsService;

class WebsiteController extends Controller
{
    public function about()
    {
        $about = AboutUs::first();
        $about_structs = AboutStruct::active()->orderBy('order')->get();

        $about_resource = new AboutUsResource($about);
        $about_structs_resource = AboutStructResource::collection($about_structs);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('about');

        return response()->json(['data' => [
            'about' => $about_resource,
            'about_structs' => $about_structs_resource,
            'seo' => $seoData,
        ]]);
    }

    public function services()
    {
        $services = Service::active()->get();
        $services_resource = ServiceResource::collection($services);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('services');

        return response()->json(['data' => [
            'services' => $services_resource,
            'seo' => $seoData,
        ]]);
    }

    public function serviceDetails(Service $service)
    {
        $service->load(['tabs', 'benefits']);
        $service_resource = new ServiceResource($service);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('service-details', $service);

        return response()->json(['data' => [
            'service' => $service_resource,
            'seo' => $seoData,
        ]]);
    }

    public function categories()
    {
        $categories = Category::with('projects')->active()->get();
        $categories_resource = CategoryResource::collection($categories);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('categories');

        return response()->json(['data' => [
            'categories' => $categories_resource,
            'seo' => $seoData,
        ]]);
    }

    public function projects()
    {
        $projects = Project::active()->get();
        $projects_resource = ProjectResource::collection($projects);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('projects');

        return response()->json(['data' => [
            'projects' => $projects_resource,
            'seo' => $seoData,
        ]]);
    }

    public function projectDetails(Project $project)
    {
        $project_resource = new ProjectResource($project);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('project-details', $project);

        return response()->json(['data' => [
            'project' => $project_resource,
            'seo' => $seoData,
        ]]);
    }

    public function blogs()
    {
        $blogs = Blog::with('author')->active()->paginate(9);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('blogs');

        return BlogResource::collection($blogs)->additional([
            'seo' => $seoData,
        ]);
    }

    public function blogDetails(Blog $blog)
    {
        $blog->load(['author', 'faqs']);
        $blog_resource = new BlogResource($blog);

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('blog-details', $blog);

        return response()->json(['data' => [
            'blog' => $blog_resource,
            'seo' => $seoData,
        ]]);
    }

    public function contactUs()
    {
        $contact_section = Section::where('key', 'contact_section')->first();
        $contact_resource = new ContactUsResource($contact_section);
        $siteAddress = SiteAddress::type('head_office')->first();
        $contact_data = [
            'email' => config('settings.site_email'),
            'phone' => config('settings.site_phone'),
            'address' => $siteAddress ? $siteAddress->address : null,
        ];

        $seoService = new SeoService;
        $seoData = $seoService->getApiData('contact');

        return response()->json(['data' => [
            'contact_section' => $contact_resource,
            'contact_data' => $contact_data,
            'seo' => $seoData,
        ]]);
    }

    public function saveContactUs(StoreContactUsRequest $request)
    {
        $contactUsService = new ContactUsService;
        $contactUsService->store($request->validated());

        return response()->json(['message' => 'Contact us message sent successfully']);
    }
}
