<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeTemplate extends Model
{
    protected $table = 'resume_templates';

    protected $fillable = [
        'template_name',
        'blade_file',
        'status',
        'preview_img',
    ];

    /**
     * Get the formatted image URL for preview
     */
    public function getPreviewUrlAttribute(): string
    {
        if (empty($this->preview_img)) {
            return asset('guest/assets/r1.jpeg');
        }

        // If it's a full URL or already an asset path
        if (str_starts_with($this->preview_img, 'http://') || str_starts_with($this->preview_img, 'https://')) {
            return $this->preview_img;
        }

        if (str_starts_with($this->preview_img, 'uploads/') || str_starts_with($this->preview_img, 'guest/')) {
            return asset($this->preview_img);
        }

        return asset('uploads/resume_templates/' . $this->preview_img);
    }

    /**
     * Check if this template is Normal Resume
     */
    public function isNormal(): bool
    {
        $name = strtolower($this->template_name);
        $file = strtolower($this->blade_file);
        return str_contains($name, 'normal') || str_contains($file, 'normal');
    }

    /**
     * Check if this template is Standard Resume
     */
    public function isStandard(): bool
    {
        $name = strtolower($this->template_name);
        $file = strtolower($this->blade_file);
        return str_contains($name, 'standard') || str_contains($file, 'standard');
    }

    /**
     * Check if this template requires a premium subscription
     */
    public function isPremium(): bool
    {
        $name = strtolower($this->template_name);
        $file = strtolower($this->blade_file);
        return str_contains($name, 'premium') || str_contains($file, 'premium');
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'template_id', 'id');
    }
}
