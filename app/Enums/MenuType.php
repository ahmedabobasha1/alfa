<?php

namespace App\Enums;

enum MenuType: string
{
    case PARENT_MENU_ONLY = '#';
    case HOME = '/';
    case ABOUT_US = 'about-us';
    case HOSTINGS = 'hostings';
    case SERVICES = 'services';
    case PRODUCTS = 'products';
    case PROJECTS = 'projects';
    case CAREERS = 'careers';
    case BLOGS = 'blogs';
    case CONTACT_US = 'contact-us';
    case GALLERY = 'gallery';
    case VIDEOS = 'videos';
    case SOLUTIONS = 'solutions';
    case FAQ = 'faq';
    case TESTIMONIALS = 'testimonials';
    case TEAM = 'team';
    case CLIENTS = 'clients';
    case CUSTOM = 'custom';
    case DOCTORS = 'doctors';
    case MEDIA = 'media';
    case BEFORE_AFTER = 'before-after';
}
