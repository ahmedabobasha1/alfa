<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory , HasLanguage;

    protected $table = 'faqs';

    protected $fillable = [
        'question_en',
        'question_ar',
        'answer_en',
        'answer_ar',
        'faqable_id',
        'faqable_type',
        'status',
        'order',
    ];

    public function faqable()
    {
        return $this->morphTo();
    }

    public static function getTypeSelect()
    {
        return [
            null => __('website.general'),
            'technical_issue' => __('website.technical_issue'),
            'help_support' => __('website.help_support'),
        ];
    }

    public function getQuestionAttribute()
    {
        return $this->{'question_'.$this->lang};
    }

    public function getAnswerAttribute()
    {
        return $this->{'answer_'.$this->lang};
    }

    public function getTypeNameAttribute()
    {
        return $this->faqable_type ? $this->faqable_type : __('dashboard.general');
    }

    public function getTypeAttribute()
    {
        return $this->faqable_type ? $this->faqable_type : __('dashboard.general');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeGeneral($query)
    {
        return $query->where('faqable_type', null);
    }

    public function scopeHostings($query)
    {
        return $query->where('faqable_type', 'hostings');
    }

    public function scopeTechnicalIssue($query)
    {
        return $query->where('faqable_type', 'technical_issue');
    }

    public function scopeDomains($query)
    {
        return $query->where('faqable_type', 'domains');
    }

    public function scopeSupport($query)
    {
        return $query->where('faqable_type', 'help_support');
    }
}
