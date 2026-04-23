<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'event_date',
        'event_time',
        'location',
        // 'status' SENGAJA tidak ada — dihitung otomatis via accessor
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Tambahkan 'status' ke array/JSON output agar bisa diakses
     * $agenda->status dari mana saja.
     */
    protected $appends = ['status', 'formatted_time', 'event_date_time'];

    /* ─────────────────────────────────────────────────────────────
     |  BOOT — pastikan kolom 'status' lama tidak ikut tersimpan
     ──────────────────────────────────────────────────────────── */
    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Agenda $agenda) {
            // Buang kolom status dari attributes supaya tidak ditimpa ke DB
            unset($agenda->attributes['status']);

            // Normalisasi event_time
            if (isset($agenda->attributes['event_time'])) {
                $value = $agenda->attributes['event_time'];

                if ($value instanceof Carbon) {
                    $agenda->attributes['event_time'] = $value->format('H:i:s');
                } elseif (is_string($value) && ! empty($value)) {
                    $parts = explode(':', $value);
                    if (count($parts) >= 2) {
                        $agenda->attributes['event_time'] = sprintf(
                            '%02d:%02d:00',
                            (int) $parts[0],
                            (int) $parts[1]
                        );
                    }
                } elseif (empty($value)) {
                    $agenda->attributes['event_time'] = null;
                }
            }
        });
    }

    /* ─────────────────────────────────────────────────────────────
     |  STATUS ACCESSOR — dihitung dari event_date vs hari ini
     |
     |  event_date > hari ini  →  upcoming   (belum mulai)
     |  event_date = hari ini  →  ongoing    (sedang berlangsung)
     |  event_date < hari ini  →  completed  (sudah selesai)
     ──────────────────────────────────────────────────────────── */
    public function getStatusAttribute(): string
    {
        if (! $this->event_date) {
            return 'upcoming';
        }

        $eventDate = $this->event_date->format('Y-m-d');
        $today     = Carbon::now()->format('Y-m-d');

        if ($eventDate === $today) {
            return 'ongoing';
        }

        if ($eventDate > $today) {
            return 'upcoming';
        }

        return 'completed';
    }

    /* ─────────────────────────────────────────────────────────────
     |  EVENT TIME MUTATOR
     ──────────────────────────────────────────────────────────── */
    public function setEventTimeAttribute($value): void
    {
        if (empty($value)) {
            $this->attributes['event_time'] = null;
            return;
        }

        if ($value instanceof Carbon) {
            $this->attributes['event_time'] = $value->format('H:i:s');
            return;
        }

        if (is_string($value)) {
            $parts = explode(':', $value);
            if (count($parts) >= 2) {
                $this->attributes['event_time'] = sprintf(
                    '%02d:%02d:00',
                    (int) $parts[0],
                    (int) $parts[1]
                );
            } else {
                $this->attributes['event_time'] = null;
            }
        } else {
            $this->attributes['event_time'] = null;
        }
    }

    /* ─────────────────────────────────────────────────────────────
     |  ACCESSORS TAMBAHAN
     ──────────────────────────────────────────────────────────── */
    public function getFormattedTimeAttribute(): ?string
    {
        if (empty($this->attributes['event_time'])) {
            return null;
        }

        return Carbon::parse($this->attributes['event_time'])->format('H:i');
    }

    // Alias untuk kompatibilitas
    public function getEventTimeFormattedAttribute(): ?string
    {
        return $this->formatted_time;
    }

    public function getEventDateTimeAttribute(): ?string
    {
        if (! $this->event_date) {
            return null;
        }

        $date = Carbon::parse($this->event_date)->format('Y-m-d');
        $time = $this->event_time
            ? Carbon::parse($this->event_time)->format('H:i')
            : '00:00';

        return "{$date} {$time}";
    }
}