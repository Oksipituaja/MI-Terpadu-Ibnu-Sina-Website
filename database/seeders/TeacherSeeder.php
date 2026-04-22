<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Teacher::truncate();

        $teachers = [
            [
                'name'    => 'Miftahudin Al Faruq, S.Pd.I',
                'subject' => 'Kepala Sekolah',
            ],
            [
                'name'    => 'Nur Hasan, S.Pd.I',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Saryati, A.Md',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Eni Hartatik, S.Pd.I',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Ahmad Syukri, S.Pd.I',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Ratih Widiyanti, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Ichwatul Hasanah',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Diah Ayu Windasari, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Muhammad Zulkarnain, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Luluk Atul Fadhillah',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Lina Mazaya, S.E',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Nikmatul Arivah, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Lutfiana Nabila, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Afthonul Afif, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Annisa Nuraini Hanik',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Sukron',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Dyah Wahyu Lestari, S.Kom',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Azzahro',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Muhammad Rozif',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Isniyati, S.Pd',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Nadia Atha Tsabita',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Syahidan Ulil Albab',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Fatimah Azzahro',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Amalia Nabil Ramadhani',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Chovivah Nur Khaniv',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Anggit Priyastuti',
                'subject' => 'Guru',
            ],
            [
                'name'    => "Muh. Sa'dan Assayaf",
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Firman Sholih Abdillah',
                'subject' => 'Guru',
            ],
            [
                'name'    => 'Marsya Dwi Aristianti',
                'subject' => 'Guru',
            ],
        ];

        foreach ($teachers as $data) {
            $nameLower = Str::lower($data['name']);
            $nameParts = explode(',', $nameLower)[0]; // ambil sebelum gelar
            $emailSlug = Str::slug($nameParts, '.');   // misal: miftahudin.al.faruq

            Teacher::create([
                'name'           => $data['name'],
                'slug'           => Str::slug($data['name']),
                'email'          => $emailSlug . '@gmail.com',
                'phone'          => '081234567890',
                'subject'        => $data['subject'],
                'featured_image' => null,
            ]);
        }
    }
}