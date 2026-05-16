<?php

namespace App\Enums;

enum MenuRouteName: string
{
    case PARENT_MENU_ONLY = '#';
    case HOME = 'home';
    case ABOUT_US = 'about-us';
    case PROJECTS = 'projects';
    case PREVIOUS_PROJECTS = 'previous-projects';
    case BLOGS = 'blogs';
    case BLOG_DETAILS = 'blogDetails';
    // case TEAMS = 'teams';
    // case TEAM_DETAILS = 'teamDetails';
    // case PRODUCTS = 'products';
    case PRODUCT_DETAILS = 'productDetails';
   
    case CONTACT_US = 'contact-us';
    case MEDIA = 'media';
    case GALLERY = 'gallery';
    // case BEFORE_AFTER = 'before-after';
    case VIDEOS = 'videos';
    // case SERVICES = 'services';
    // case SERVICE_DETAILS = 'serviceDetails';
    case CATEGORIES = 'categories';
    case CATEGORY_DETAILS = 'categoryDetails';
   
    // case PROJECT_DETAILS = 'projectDetails';
    // case CLIENTS = 'clients';
    // case DOCTORS = 'doctors';

}
