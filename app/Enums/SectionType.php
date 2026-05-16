<?php

namespace App\Enums;

enum SectionType: string
{
    case BREADCRUMB = 'breadcrumb_section';
    case SERVICES = 'services_section';
    case PROJECTS = 'projects_section';
    case BLOGS = 'blogs_section';
    case CONTACT_US = 'contact_us_page';
    case CONTACT_SECTION = 'contact_section';
    case SERVICES_PAGE = 'services_page';
    case PROJECTS_PAGE = 'projects_page';
}
