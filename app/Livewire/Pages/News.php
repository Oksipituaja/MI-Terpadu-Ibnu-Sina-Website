<?php

namespace App\Livewire\Pages;

use App\Models\Agenda as AgendaModel;
use App\Models\News as NewsModel;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class News extends Component
{
    use WithPagination;

    public string $tab    = 'berita';
    public string $search = '';
    public string $filter = 'upcoming';

    public function mount(): void
    {
        $this->tab    = request()->query('tab', 'berita');
        $this->search = request()->query('search', '');
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTab(): void
    {
        $this->resetPage();
        $this->search = '';
        $this->filter = 'upcoming';
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
        $this->updatedTab();
    }

    public function render()
    {
        $todayStr = Carbon::now()->format('Y-m-d');

        // ── BERITA ────────────────────────────────────────────────────
        $news = NewsModel::where('status', 'published')
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%")
            )
            ->orderBy('published_at', 'desc')
            ->paginate(9, pageName: 'newsPage');

        // ── AGENDA — filter berdasarkan event_date vs hari ini ────────
        // TIDAK pakai where('status', ...) karena kolom status sudah dihapus
        // Status dihitung otomatis via Model accessor getStatusAttribute()
        $agendaQuery = AgendaModel::query();

        switch ($this->filter) {
            case 'upcoming':
                // Mendatang = event_date lebih besar dari hari ini
                $agendaQuery->where('event_date', '>', $todayStr)
                            ->orderBy('event_date', 'asc')
                            ->orderBy('event_time', 'asc');
                break;

            case 'ongoing':
                // Berlangsung = event_date sama dengan hari ini
                $agendaQuery->where('event_date', '=', $todayStr)
                            ->orderBy('event_time', 'asc');
                break;

            case 'completed':
                // Selesai = event_date kurang dari hari ini
                $agendaQuery->where('event_date', '<', $todayStr)
                            ->orderBy('event_date', 'desc')
                            ->orderBy('event_time', 'desc');
                break;

            case 'all':
            default:
                // Semua — ongoing dulu, lalu upcoming, lalu completed
                $agendaQuery->orderByRaw("
                    CASE
                        WHEN event_date = ?  THEN 0
                        WHEN event_date > ?  THEN 1
                        ELSE 2
                    END,
                    event_date ASC,
                    event_time ASC
                ", [$todayStr, $todayStr]);
                break;
        }

        $agendas = $agendaQuery->paginate(10, pageName: 'agendaPage');

        // ── BADGE COUNT per filter tab ────────────────────────────────
        $counts = [
            'all'       => AgendaModel::count(),
            'ongoing'   => AgendaModel::where('event_date', '=', $todayStr)->count(),
            'upcoming'  => AgendaModel::where('event_date', '>', $todayStr)->count(),
            'completed' => AgendaModel::where('event_date', '<', $todayStr)->count(),
        ];

        return view('livewire.pages.news', [
            'news'    => $news,
            'agendas' => $agendas,
            'counts'  => $counts,
        ]);
    }
}