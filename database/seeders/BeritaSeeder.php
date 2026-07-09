<?php

namespace Database\Seeders;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $berita = [
            [
                'judul' => 'Kepala Desa Tatung Resmikan Program Bedah Rumah untuk Warga Kurang Mampu',
                'ringkasan' => 'Pemerintah Desa Tatung meresmikan program bedah rumah bagi 5 keluarga kurang mampu sebagai wujud kepedulian sosial dan pemerataan kesejahteraan.',
                'konten' => '<p>Pemerintah Desa Tatung melalui dana desa tahun ini meresmikan program bedah rumah bagi 5 keluarga kurang mampu yang tersebar di beberapa dusun. Program ini bertujuan untuk meningkatkan kualitas hunian warga agar lebih layak dan sehat.</p><p>Kepala Desa Tatung, dalam sambutannya, menyampaikan bahwa program ini merupakan prioritas pembangunan di bidang sosial. Setiap rumah mendapatkan bantuan renovasi senilai Rp20 juta yang dialokasikan untuk perbaikan atap, lantai, dan dinding rumah.</p><p>Warga yang menerima bantuan menyambut antusias program ini. Salah satu penerima manfaat mengaku sangat bersyukur karena akhirnya bisa memiliki rumah yang layak ditempati.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'judul' => 'Pembangunan Jalan Usaha Tani Sepanjang 1,5 KM Resmi Dimulai',
                'ringkasan' => 'Pembangunan jalan usaha tani di Dusun Krajan dimulai untuk mempermudah akses petani mengangkut hasil panen ke pasar.',
                'konten' => '<p>Pemerintah Desa Tatung memulai pembangunan jalan usaha tani sepanjang 1,5 kilometer di Dusun Krajan. Jalan ini akan menghubungkan area persawahan utama dengan jalan desa, memudahkan petani mengangkut hasil panen.</p><p>Pembangunan menggunakan anggaran Dana Desa tahun berjalan dengan sistem padat karya. Pengerjaan melibatkan warga setempat sehingga dapat menyerap tenaga kerja lokal.</p><p>Kepala Dusun Krajan berharap jalan ini dapat meningkatkan produktivitas pertanian dan menekan biaya distribusi hasil panen.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'judul' => 'Posyandu Flamboyan Gelar Imunisasi Rutin untuk Balita',
                'ringkasan' => 'Posyandu Flamboyan Desa Tatung menggelar imunisasi rutin yang diikuti puluhan balita dari berbagai dusun.',
                'konten' => '<p>Posyandu Flamboyan yang berlokasi di Dusun Krajan mengadakan kegiatan imunisasi rutin bagi balita. Kegiatan ini diikuti oleh puluhan ibu yang membawa balita mereka untuk mendapatkan imunisasi dasar lengkap.</p><p>Bidan desa menjelaskan bahwa imunisasi rutin sangat penting untuk mencegah berbagai penyakit menular pada anak. Posyandu juga memberikan tambahan vitamin dan pemantauan tumbuh kembang balita.</p><p>Kegiatan imunisasi ini dijadwalkan setiap bulan pada minggu kedua. Pemerintah desa mengimbau seluruh warga yang memiliki balita untuk aktif mengikuti program ini.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'judul' => 'Kelompok Tani Sido Makmur Panen Raya Padi Varietas Unggul',
                'ringkasan' => 'Kelompok Tani Sido Makmur berhasil panen raya padi varietas unggul dengan hasil melimpah berkat pendampingan penyuluh pertanian.',
                'konten' => '<p>Kelompok Tani Sido Makmur yang beranggotakan 40 petani di Desa Tatung berhasil melakukan panen raya padi varietas unggul Ciherang dan Inpari. Luas lahan yang dipanen mencapai 25 hektare dengan hasil rata-rata 7 ton per hektare.</p><p>Keberhasilan ini tidak lepas dari pendampingan intensif dari penyuluh pertanian lapangan yang rutin memberikan edukasi mengenai teknik budidaya modern dan penggunaan pupuk organik.</p><p>Kepala Desa Tatung berharap hasil panen ini dapat meningkatkan kesejahteraan petani dan mendorong semangat gotong royong dalam mengelola lahan pertanian.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'judul' => 'Desa Tatung Raih Penghargaan Desa Peduli Lingkungan Tingkat Kabupaten',
                'ringkasan' => 'Desa Tatung berhasil meraih penghargaan sebagai Desa Peduli Lingkungan berkat program pengelolaan sampah dan penghijauan.',
                'konten' => '<p>Pemerintah Kabupaten Ponorogo memberikan penghargaan kepada Desa Tatung sebagai Desa Peduli Lingkungan tahun ini. Penghargaan ini diberikan atas keberhasilan desa dalam mengelola program kebersihan, pengelolaan sampah berbasis masyarakat, dan gerakan penghijauan.</p><p>Program bank sampah yang digagas oleh Kelompok Swadaya Masyarakat (KSM) menjadi salah satu faktor penilaian utama. Bank sampah ini berhasil mengelola puluhan kilogram sampah plastik setiap minggunya.</p><p>Kepala desa menyampaikan apresiasi kepada seluruh warga yang telah berpartisipasi aktif dalam menjaga kebersihan dan kelestarian lingkungan desa.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'judul' => 'Pelatihan Digital Marketing untuk Pelaku UMKM Desa Tatung',
                'ringkasan' => 'Pemerintah desa mengadakan pelatihan digital marketing bagi pelaku UMKM untuk memperluas pasar dan meningkatkan penjualan produk lokal.',
                'konten' => '<p>Pemerintah Desa Tatung bekerja sama dengan Dinas Koperasi dan UMKM mengadakan pelatihan digital marketing bagi 30 pelaku UMKM desa. Pelatihan ini mencakup materi fotografi produk, pembuatan konten promosi, dan strategi penjualan melalui marketplace.</p><p>Para peserta diajarkan cara membuat akun bisnis di Shopee dan Tokopedia, serta teknik mengambil foto produk yang menarik menggunakan smartphone. Pelatihan berlangsung selama dua hari di balai desa.</p><p>Produk unggulan seperti keripik pisang, wingko, dan anyaman bambu diharapkan bisa menjangkau pasar yang lebih luas setelah pelatihan ini.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'judul' => 'Pemdes Tatung Salurkan Bantuan Langsung Tunai untuk 200 Keluarga',
                'ringkasan' => 'Pemerintah Desa Tatung menyalurkan Bantuan Langsung Tunai (BLT) Dana Desa kepada 200 keluarga penerima manfaat.',
                'konten' => '<p>Pemerintah Desa Tatung menyalurkan Bantuan Langsung Tunai (BLT) yang bersumber dari Dana Desa kepada 200 keluarga penerima manfaat. Masing-masing keluarga menerima Rp300.000 per bulan untuk tiga bulan sekaligus dengan total Rp900.000.</p><p>Penyaluran dilakukan di balai desa dengan menerapkan protokol kesehatan. Pendataan penerima manfaat dilakukan secara transparan melalui musyawarah desa khusus (Musdesus) yang melibatkan perangkat desa, BPD, dan tokoh masyarakat.</p><p>Kepala desa berharap bantuan ini dapat meringankan beban ekonomi warga kurang mampu di tengah kenaikan harga bahan pokok.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(14),
            ],
            [
                'judul' => 'Gotong Royong Pembangunan Talud Penahan Tebing di Dusun Mulyo',
                'ringkasan' => 'Warga Dusun Mulyo bergotong royong membangun talud penahan tebing untuk mencegah longsor di musim hujan.',
                'konten' => '<p>Warga Dusun Mulyo secara bergotong royong membangun talud penahan tebing sepanjang 100 meter di area pemukiman yang rawan longsor. Pembangunan ini merupakan respons atas kekhawatiran warga saat musim hujan tiba.</p><p>Pemerintah desa menyediakan material seperti batu, pasir, dan semen, sementara warga secara sukarela menyumbangkan tenaga. Kegiatan gotong royong ini berlangsung selama dua pekan dan melibatkan puluhan warga dari berbagai usia.</p><p>Selain membangun talud, warga juga melakukan penanaman pohon vetiver di area tebing untuk memperkuat struktur tanah secara alami.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
            ],
            [
                'judul' => 'Semarak HUT RI ke-81: Desa Tatung Gelar Lomba Tradisional',
                'ringkasan' => 'Peringatan HUT RI ke-81 di Desa Tatung dimeriahkan dengan berbagai lomba tradisional yang diikuti seluruh lapisan masyarakat.',
                'konten' => '<p>Pemerintah Desa Tatung menggelar serangkaian lomba tradisional dalam rangka memperingati HUT RI ke-81. Lomba yang digelar antara lain lomba balap karung, panjat pinang, tarik tambang, dan lomba makan kerupuk.</p><p>Kegiatan berlangsung di lapangan desa dan diikuti oleh ratusan warga dari berbagai dusun. Acara ini bertujuan untuk mempererat tali silaturahmi antarwarga sekaligus menumbuhkan semangat nasionalisme.</p><p>Puncak acara ditutup dengan pembagian hadiah bagi para pemenang dan pertunjukan seni tradisional dari warga.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(30),
            ],
            [
                'judul' => 'Pelatihan Pembuatan Pupuk Organik untuk Kurangi Ketergantungan Pupuk Kimia',
                'ringkasan' => 'Penyuluh pertanian memberikan pelatihan pembuatan pupuk organik kepada petani untuk mengurangi biaya produksi dan menjaga kesuburan tanah.',
                'konten' => '<p>Penyuluh pertanian dari Kecamatan Balong memberikan pelatihan pembuatan pupuk organik kepada kelompok tani di Desa Tatung. Pelatihan ini bertujuan untuk mengurangi ketergantungan petani pada pupuk kimia yang harganya terus melambung.</p><p>Bahan baku pupuk organik mudah didapat di lingkungan desa, seperti kotoran ternak, sisa tanaman, dan limbah rumah tangga organik. Proses pembuatannya juga relatif sederhana dan bisa dilakukan secara mandiri oleh petani.</p><p>Dengan menggunakan pupuk organik, petani bisa menghemat biaya produksi hingga 30% sekaligus menjaga kesuburan tanah dalam jangka panjang.</p>',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(45),
            ],
        ];

        foreach ($berita as $i => $data) {
            $slug = str($data['judul'])->slug();
            Berita::create(array_merge($data, [
                'slug' => $slug,
                'gambar' => 'https://picsum.photos/200/300',
            ]));
        }
    }
}
