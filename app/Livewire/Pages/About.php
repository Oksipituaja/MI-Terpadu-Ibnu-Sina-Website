<?php

namespace App\Livewire\Pages;

use App\Models\About as AboutModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class About extends Component
{
    public bool $expanded = false;

    public function mount(): void
    {
        $section = request('section');
        if (in_array($section, ['tentang', 'visi-misi']) || request()->boolean('expanded')) {
            $this->expanded = true;
        }
    }

    public function expand(): void
    {
        $this->expanded = true;
    }

    public function render()
    {
        $heroImage         = AboutModel::where('key', 'hero_image')->first();
        $principalGreeting = AboutModel::where('key', 'principal_greeting')->first();
        $schoolProfile     = AboutModel::where('key', 'school_profile')->first();
        $vision            = AboutModel::where('key', 'vision')->first();
        $mission           = AboutModel::where('key', 'mission')->first();

        $aboutSections = AboutModel::whereNotIn('key', [
            'hero_image',
            'home_hero_image',
            'principal_greeting',
            'vision',
            'mission',
            'school_profile',
        ])->get();

        return view('livewire.pages.about', [
            'heroImage'         => $heroImage,
            'principalGreeting' => $principalGreeting,
            'aboutSections'     => $this->expanded ? $aboutSections : collect(),
            'schoolProfile'     => $this->expanded ? $schoolProfile : null,
            'vision'            => $this->expanded ? $vision : null,
            'mission'           => $this->expanded ? $mission : null,
            'expanded'          => $this->expanded,
        ]);
    }
}