-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2026 pada 15.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darn5374_db_darso`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_asesmen`
--

CREATE TABLE `tbl_asesmen` (
  `no_asesmen` varchar(20) NOT NULL,
  `tgl_asesmen` date NOT NULL,
  `nik` varchar(16) NOT NULL,
  `petugas_asesmen` varchar(100) NOT NULL,
  `kondisi_ppks` text NOT NULL,
  `layanan_dibutuhkan` text DEFAULT NULL,
  `link_bukti` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_asesmen`
--

INSERT INTO `tbl_asesmen` (`no_asesmen`, `tgl_asesmen`, `nik`, `petugas_asesmen`, `kondisi_ppks`, `layanan_dibutuhkan`, `link_bukti`) VALUES
('DA-001', '2026-01-02', '3214010403050003', 'Sri Mulyati', 'Kondisi Fisik : secara fisik kondisi PPKS sehat \r\nEkonomi : secara ekonomi PPKS tidak bekerja, yang bekerja ibunya sebagai kuli serabutan\r\nMental : Secara mental PPKS memiliki emotional naik turun kadang-kadang menangis, dan kadang-kadang marah', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\", \"Reunifikasi Keluarga\"', NULL),
('DA-002', '2026-01-04', '3214120505250004', 'Lala', 'Ekonomi : PPKS merupakan keluarga yang kurang mampu. PPKS sedang dirawat di RS Karina Medika. BPJS PPKS nunggak sehingga untuk pulang perawatan mereka harus bayar jika BPJS nya tidak aktif\r\n\r\nTindak lanjut TRC berkoordinasi dengan Linjamsos, Dinkes, dan Rumah Sakit', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\", \"Akses Ke Layanan Pendidikan Dan Kesehatan Dasar\"', NULL),
('DA-003', '2026-01-04', '3214014804740005', 'Lala', 'Fisik : PPKS tidak memiliki kondisi fisik yang baik, tidak ada cacat.\r\nSosial : PPKS secara sosial kurang baik dengan lingkungan dikarenakan memiliki gangguan mental.\r\nEkonomi : PPKS dapat dikatakan sebagai masyarakat yang kurang mampu.\r\n\r\nTindak lanjut yang dilakukan, TIM TRC mengantarkan PPKS ke RSJ Bandung untuk tindak lanjut pengobatan mentalnya.', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\", \"Layanan Rujukan\"', NULL),
('DA-004', '2026-01-07', '3205210608820001', 'Dendi Somantri', 'Fisik : Secara fisik PPKS tidak memiliki kecacatan apapun\r\nMental : Secara mental PPKS sering melamun dan pandangan kosong\r\nSosial : PPKS jika ditanya oleh TRC sering tidak nyambung \r\n\r\nTindak lanjut yang dilakukan, yaitu dengan menghubungi pihak Pemdes Padamukti dan dilakukan penelusuran', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\", \"Penelusuran Keluarga\", \"Reunifikasi Keluarga\"', NULL),
('DA-005', '2026-01-07', '3210150203790021', 'Sri Mulyati', 'Kondisi Fisik : PPKS mengalami mata kuning, badan sakit dibagian perut dan memiliki riwayat kantung empedu. sudah dibawa ke klinik tetapi tidak ada perubahan.\r\nEkonomi : PPKS sedang mengalami keterpurukan ekonomi.\r\n\r\nTindak lanjut yang dilakukan Tim TRC yaitu mendampingi PPKS untuk dirujuk ke RS RSBA atau RS Asri untuk ke mendapatkan ruangan khusus pasien bedah, tetapi karena dikedua RS tersebut penuh akhirnya PPKS didampingi Tim TRC untuk dirawat di RS Holistik\r\n', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\"', NULL),
('DA-006', '2026-01-08', '3214121210680001', 'Sri Mulyati', 'Tim TRC mendapatkan info dari Bale Katresna, bahwa da warga dari DS. Cisarua meminta bantuan untuk penjemputan warga yang sakit. \r\nKondisi Fisik : PPKS tidak bisa jalan dikarenakan sudah pasang pacu jantung.\r\nEkonomi : PPKS dapat dikategorikan sebagai warga yang kurang mampu.\r\n\r\nTim TRC melakukan penjemputan dan mengantarkan PPKS ke RSBA untuk ditangani lebih lanjut oleh pihak medis.', '\"Layanan Data Dan Pengaduan\", \"Layanan Kedaruratan / Layanan Reaksi Cepat\"', NULL),
('DA-007', '2026-01-12', '3603010110010003', 'Sri Mulyati', 'PPKS diantarkan oleh Satpol PP ke Dinsos P3A kab. Purwakarta\r\nKondisi Fisik : PPKS memiliki kondisi fisik yang baik tidak ada kecacatan didalam tubuhnya.\r\nSosial : PPKS jika diajak bicara selalu diam terlebih dahulu, dan sering tidak nyambung jika diajak ngobrol oleh Tim TRC\r\n\r\nTim TRC melakukan tindak lanjut dengan melakukan iris mata pada PPKS untuk mengetahui data diri PPKS. setelah itu TRC melakukan penelusuran keluarga melalui grup PSM  dan setelah itu ada hasil bahwa kelurga PPKS berada sesuai alamat data diri PPKS.\r\nlalu PPKS d jemput oleh kelurga di Dinsos P3A Kab. Purwakarta', '\"Layanan Kedaruratan / Layanan Reaksi Cepat\", \"Penelusuran Keluarga\", \"Reunifikasi Keluarga\"', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_layanan`
--

CREATE TABLE `tbl_layanan` (
  `id_layanan` int(11) NOT NULL,
  `jenis_layanan` varchar(100) NOT NULL,
  `deskripsi_layanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_layanan`
--

INSERT INTO `tbl_layanan` (`id_layanan`, `jenis_layanan`, `deskripsi_layanan`) VALUES
(6, 'Penyediaan Permakanan', 'Layanan yang dilakukan oleh Dinas Sosial dan difasilitasi melalui lembaga yang ditetapkan oleh dinas sosial dan/atau di Pusat Kesejahteraan Sosial yang berkedudukan di desa/kelurahan/nama lain dan disesuaikan dengan indeks permakanan/orang/hari'),
(7, 'Penyediaan Sandang', 'Berupa pembelian pakaian, pembelian perlengkapan mandi, pembelian kebutuhan khusus untuk perempuan dewasa, balita, dan yang mengalami bedridden, pembelian alas kaki dan kebutuhan lainnya'),
(8, 'Penyediaan Alat Bantu', 'Penyediaan Alat Bantu berupa Kursi Roda, Tongkat dan alat bantu lainnya yang diberikan kepada Disabilitas Terlantar dan Lanjut Usia Terlantar'),
(9, 'Penyediaan Perbekalan Kesehatan', 'Obat umum, timbangan, pengukur tinggi badan, termometer dan lainnya sesuai dengan kebutuhan'),
(10, 'Layanan Kedaruratan / Layanan Reaksi Cepat', 'Layanan Kedaruratan/Layanan Reaksi Cepat merupakan tindakan penanganan segera yang dilakukan oleh dinas sosial dan/atau Pusat Kesejahteraan Sosial kepada PPKS terlantar'),
(11, 'Penelusuran Keluarga', 'Pencarian keluarga PPKS terlantar untuk tujuan reunifikasi'),
(12, 'Reunifikasi Keluarga', 'Pemulangan dan penyatuan kembali PPKS Terlantar dengan keluarga yang dapat memberikan perawatan dan/atau pendampingan sehingga berada di lingkungan yang terlindungi'),
(13, 'Layanan Rujukan', 'Layanan yang diberikan kepada PPKS terlantar yang membutuhkan layanan lebih lanjut dan layanan lainnya'),
(14, 'Bimbingan Fisik Mental Spiritual dan Sosial', 'Diberikan oleh pekerja sosial dan tenaga sosial lainnya dengan menggunakan teknik pekerjaan sosial melalui media alat peraga dan alat tulis lainnya (bimbingan fisik adalah kegiatan untuk memelihara dan meningkatkan kesehatan jasmani penerima pelayanan/olahraga/outbound/gym, bimbingan mental dan spiritual adalah kegiatan yang dilakukan untuk meningkatkan mental dan spiritual, bimbingan sosial adalah layanan bantuan psikologis yang ditujukan mengatasi masalah psikososial)'),
(15, 'Bimbingan Sosial Kepada Keluarga', 'Pemberian bimbingan sosial kepada keluarga lanjut usia terlantar serta masyarakat dilakukan oleh dinas sosial, dan difasilitasi melalui lembaga yang ditetapkan oleh dinas sosial di Pusat Kesejahteraan Sosial yang berkedudukan di desa/kelurahan/nama lain, dan/atau di lingkungan keluarga/masyarakat'),
(16, 'Fasilitasi Identitas Kependudukan', 'Fasilitasi pembuatan Nomor Induk Kependudukan/Bukti kepemilikan NIK / Dokumen Kependudukan untuk pelayanan kesejahteraan sosial'),
(17, 'Akses Ke Layanan Pendidikan Dan Kesehatan Dasar', 'Fasilitasi layanan pendidikan sekolah dan kesehatan dasar puskesmas/klinik/rumah sakit dan/atau Fasilitasi dokumen keperluan bantuan pendidikan dan kesehatan'),
(18, 'Layanan Data Dan Pengaduan', 'Layanan Data yang diberikan kepada PPKS untuk diusulkan masuk dalam DTSEN dan peringkat kesejahteraan sosial di DTSEN, Layanan Pengaduan merupakan sarana untuk menerima dan menindaklanjuti informasi berupa pengaduan, keluhan, dan/atau pertanyaan yang disampaikan oleh masyarakat kepada dinas sosial dan/atau Pusat Kesejahteraan Sosial');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ppks`
--

CREATE TABLE `tbl_ppks` (
  `nik` varchar(16) NOT NULL,
  `nama_ppks` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `jenis_ppks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_ppks`
--

INSERT INTO `tbl_ppks` (`nik`, `nama_ppks`, `tgl_lahir`, `jk`, `alamat`, `jenis_ppks`) VALUES
('3205210608820001', 'DENI', '1982-08-05', 'L', 'Garut, KP Buni Sakit RT 06 RW 03 DS. Padmukti Kec. Sukaresmi', 'Gelandangan'),
('3210150203790021', 'DODY HARYANTO', '1979-03-02', 'L', 'Purwakarta, Perum Griya Abdi Negara, RT 021 RW 007, DS. Sukatani , Kec. Sukatani', 'Lainnya'),
('3214010403050003', 'ZIDDAN', '2005-03-04', 'L', 'Purwakarta, Perum Panorama Blok L2 No. 18 RT 050 RW 012 Kel. Munjuljaya Kec. Purwakarta', 'Disabilitas Terlantar (Disabilitas Mental)'),
('3214014804740005', 'MARSIH', '1979-04-08', 'P', 'Purwakarta, KP Sarimulya RT 005 RW 006 Kel. Tegalmunjul Kec. Purwakarta', 'Disabilitas Terlantar (Disabilitas Mental)'),
('3214120505250004', 'MUHAMMAD PUTRA PRATAMA', '2026-01-04', 'L', 'Purwakarta, KP Karang Anyar RT 022 RW 006 DS. Maracang Kec. Babakancikao ', 'Anak Terlantar'),
('3214121210680001', 'HARTANTO', '1968-10-12', 'L', 'Purwakarta, KP Cigarut, RT 013 RW 007, DS. Cisarua, Kec. Tegalwaru', 'Lainnya'),
('3603010110010003', 'MOHAMAD PARID AKBAR', '2001-10-01', 'L', 'Tanggerang, KP Ampel RT 001 RW 007, DS. Gembong, Kec. Balaraja', 'Gelandangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `fullname`, `jabatan`, `gambar`) VALUES
(16, 'feri', 'admin001', 'Feriansyah Julkahfi', '2', 'user.png'),
(17, 'wulan', 'admin002', 'Wulan Nurfitriani', '2', 'user.png'),
(21, 'dendi', 'trc001', 'Dendi Somantri', '3', 'user.png'),
(22, 'ading', 'trc002', 'Ading Sonjaya', '3', 'user.png'),
(23, 'suhendar', 'trc003', 'Suhendar', '3', 'user.png'),
(24, 'srim', 'trc004', 'Sri Mulyati', '3', 'user.png'),
(25, 'lala', 'trc005', 'Lala', '3', 'user.png'),
(26, 'jamaludin', 'trc006', 'Jamaludin', '3', 'user.png'),
(27, 'enti', 'trc007', 'Enti Fatimah', '3', 'user.png'),
(28, 'apipudin', 'trc008', 'M. Apipudin', '3', 'user.png'),
(30, 'helga', 'admin', 'Helga Risty Damarys, S.Psi', '2', 'user.png'),
(31, 'dedim', 'pendamping001', 'Dedi Mulyadi', '3', 'user.png'),
(32, 'danu', 'rehsos001', 'Danu Maulid Efendi, S.Tr.Sos', '3', 'user.png'),
(34, 'admin', 'Rehsos2026', 'Administrator', '1', 'user.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_asesmen`
--
ALTER TABLE `tbl_asesmen`
  ADD PRIMARY KEY (`no_asesmen`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `tbl_ppks`
--
ALTER TABLE `tbl_ppks`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_asesmen`
--
ALTER TABLE `tbl_asesmen`
  ADD CONSTRAINT `tbl_asesmen_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tbl_ppks` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
