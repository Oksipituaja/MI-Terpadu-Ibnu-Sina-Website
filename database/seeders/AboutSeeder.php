<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $sections = [
            [
                'key'            => 'home_hero_image',
                'title'          => 'Hero Image Beranda',
                'content'        => '',
                'featured_image' => null,
            ],
            [
                'key'            => 'hero_image',
                'title'          => 'Hero Image',
                'content'        => '',
                'featured_image' => null,
            ],
            [
                'key'            => 'principal_greeting',
                'title'          => 'Sambutan Kepala Sekolah',
                'principal_name' => 'Kepala Madrasah',
                'content'        => '<p>Assalamu\'alaikum warahmatullahi wabarakatuh.</p>
<p>Puji syukur kehadirat Allah SWT atas segala nikmat dan karunia-Nya.</p>
<p>MI Terpadu Ibnu Sina berkomitmen untuk mewujudkan generasi muslim yang berilmu, berkarya, taat beribadah, berakhlaqul karimah, terampil, dan unggul dalam prestasi.</p>
<p>Wassalamu\'alaikum warahmatullahi wabarakatuh.</p>',
                'featured_image' => null,
            ],
            [
                'key'     => 'school_profile',
                'title'   => 'Profil Sekolah',
                'content' => '<p>MIS TERPADU IBNU SINA merupakan salah satu sekolah jenjang MI berstatus Swasta yang berada di wilayah Kec. Kembang, Kab. Jepara, Jawa Tengah. Berdiri sejak 28 Januari 2008, madrasah ini berkomitmen untuk mewujudkan generasi muslim yang berilmu, berkarya, dan berakhlaqul karimah.</p>',
            ],
            [
                'key'     => 'school_info',
                'title'   => 'Informasi Sekolah',
                'content' => json_encode([
                    'npsn'                => '60712544',
                    'nsm'                 => '111233200167',
                    'nama_sekolah'        => 'MI TERPADU IBNU SINA',
                    'naungan'             => 'Kementerian Agama',
                    'tanggal_berdiri'     => '28 Januari 2008',
                    'no_sk_pendirian'     => 'Kd.11.20/4/PP.03.2/58/2008',
                    'tanggal_operasional' => '28 Januari 2008',
                    'no_sk_operasional'   => 'Kd.11.20/MI/167/08',
                    'jenjang_pendidikan'  => 'MI',
                    'status_sekolah'      => 'Swasta',
                    'akreditasi'          => 'B',
                    'tanggal_akreditasi'  => '20 November 2014',
                    'no_sk_akreditasi'    => '137/BAP-SM/X/2014',
                    'alamat'              => 'Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang, Kab. Jepara 59457',
                    'desa'                => 'Jinggotan',
                    'kecamatan'           => 'Kec. Kembang',
                    'kabupaten'           => 'Kab. Jepara',
                    'provinsi'            => 'Jawa Tengah',
                ], JSON_UNESCAPED_UNICODE),
            ],
            [
                'key'     => 'vision',
                'title'   => 'Visi Madrasah',
                'content' => '<p>TERWUJUDNYA GENERASI MUSLIM YANG ULAMA\' ( BERILMU ) DAN AMILIN ( BERKARYA ) SEHINGGA TA\'AT DAN RAJIN BERIBADAH BERAKHLAQUL KARIMAH TERAMPIL DAN UNGGUL DALAM PRESTASI</p>',
            ],
            [
                'key'     => 'mission',
                'title'   => 'Misi Madrasah',
                'content' => '<ol>
<li>Menanamkan aqidah shohihah dan ibadah salimah.</li>
<li>Menanamkan akhlaqul karimah dalam kehidupan sehari-hari.</li>
<li>Menanamkan jiwa kemandirian sejak dini.</li>
<li>Menanamkan sikap kreatif dan inovatif dalam menghadapi permasalahan.</li>
<li>Menyiapkan peserta didik untuk menempuh jenjang pendidikan yang lebih tinggi.</li>
</ol>',
            ],
        ];

        foreach ($sections as $section) {
            About::updateOrCreate(
                ['key' => $section['key']],
                $section
            );
        }
    }
}
