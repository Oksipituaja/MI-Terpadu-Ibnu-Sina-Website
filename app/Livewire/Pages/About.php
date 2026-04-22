<?php

namespace App\Livewire\Pages;

use App\Models\About as AboutModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class About extends Component
{
    public string $activeSection = '';

    public function mount(): void
    {
        $this->activeSection = request('section', '');
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
            'schoolProfile'     => $schoolProfile,
            'aboutSections'     => $aboutSections,
            'vision'            => $vision,
            'mission'           => $mission,
            'activeSection'     => $this->activeSection,
        ]);
    }
}
