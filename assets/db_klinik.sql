/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : db_klinik

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-07-19 23:55:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `bank_id` int(3) NOT NULL AUTO_INCREMENT,
  `bank_nama` varchar(50) DEFAULT NULL,
  `bank_nomor_rekening` varchar(50) DEFAULT NULL,
  `bank_nama_rekening` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES ('1', 'BCA', '3245678900', 'RATNA DEWI');
INSERT INTO `bank` VALUES ('2', 'MUAMALAT', '3425364646', 'RATNA DEWI');
INSERT INTO `bank` VALUES ('3', 'BNI', '2484293486', 'RATNA DEWI');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kategori_id` int(7) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`),
  UNIQUE KEY `product_category_nama` (`kategori_nama`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('1', 'Pelayanan');
INSERT INTO `kategori` VALUES ('2', 'Produk');

-- ----------------------------
-- Table structure for outlet
-- ----------------------------
DROP TABLE IF EXISTS `outlet`;
CREATE TABLE `outlet` (
  `outlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `outlet_name` varchar(50) DEFAULT NULL,
  `outlet_address` varchar(100) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of outlet
-- ----------------------------
INSERT INTO `outlet` VALUES ('1', 'Ratna Dewi Klinik Jakarta', 'Jl. Matraman Raya', '106.843333', '-6.178078', 'active');
INSERT INTO `outlet` VALUES ('2', 'Ratna Dewi Klinik Bekasi', 'Jl. Agus Salim', '106.830392', '-6.180409', 'active');
INSERT INTO `outlet` VALUES ('3', 'Ratna Dewi Klinik Bandung', 'Jl. Soekarno-Hatta', '106.830370', '-6.180470', 'active');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_kode_member` varchar(50) NOT NULL,
  `pelanggan_email` varchar(50) NOT NULL,
  `pelanggan_password` varchar(50) DEFAULT NULL,
  `pelanggan_nama` varchar(50) DEFAULT NULL,
  `pelanggan_jenis_kelamin` enum('Pria','Wanita') DEFAULT NULL,
  `pelanggan_telepon` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pelanggan_id`,`pelanggan_kode_member`,`pelanggan_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('1', 'USER00001', 'amanda@gmail.com', '202cb962ac59075b964b07152d234b70', 'Amanda Roziana', 'Wanita', '081234566788');

-- ----------------------------
-- Table structure for pelayanan
-- ----------------------------
DROP TABLE IF EXISTS `pelayanan`;
CREATE TABLE `pelayanan` (
  `pelayanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(3) DEFAULT NULL,
  `pelayanan_status` varchar(10) DEFAULT 'active',
  `pelayanan_kode` varchar(50) NOT NULL,
  `pelayanan_nama` varchar(128) DEFAULT NULL,
  `pelayanan_url` varchar(255) NOT NULL,
  `pelayanan_harga` float DEFAULT NULL,
  `pelayanan_harga_promo` float DEFAULT NULL,
  `pelayanan_deskripsi` text,
  `pelayanan_gambar` varchar(100) DEFAULT NULL,
  `pelayanan_utama` int(1) DEFAULT '0',
  `pelayanan_utama_tanggal` datetime DEFAULT NULL,
  `pelayanan_promo` int(1) DEFAULT '0',
  `pelayanan_promo_tanggal` datetime DEFAULT NULL,
  `pelayanan_baru` int(1) DEFAULT '0',
  `pelayanan_baru_tanggal` datetime DEFAULT NULL,
  `pelayanan_populer` int(1) DEFAULT '0',
  `pelayanan_populer_tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`pelayanan_id`,`pelayanan_kode`,`pelayanan_url`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pelayanan
-- ----------------------------
INSERT INTO `pelayanan` VALUES ('1', '1', 'active', 'PROD0001', 'Bedah Kosmetik', 'bedah-kosmetik', '2000000', '0', 'Apa yang dimaksud dengan bedah kosmetik?\r\n\r\nProsedur estetik untuk menyempurnakan penampilan wajah dan bentuk tubuh melalui:\r\n\r\nRhinoplasty: bertujuan untuk membuat keserasian antara bentuk hidung dan wajah agar proporsional di samping itu juga dapat mengoreksi gangguan pernafasan akibat adanya bentuk struktur sekat hidung yang abnormal.\r\n\r\nRhinoplasty dapat mengubah:\r\n\r\nUkuran hidung agar seimbang dengan wajah\r\nUkuran lebar dan batang hidung\r\nProfil hidung yang terlalu lebar atau depresi pada batang hidung\r\nUjung hidung yang terlalu besar, turun atau bengkok\r\nLubang hidung yang terlalu lebar atau tidak simetris\r\nHidung yang simetris\r\nBlepharoplasty: bertujuan untuk mengoreksi kerusakan, kelainan bentuk dan ketidakseimbangan bentuk kelopak mata dengan wajah serta memodifikasi secara estetik regio mata dengan wajah. Dilakukan dengan jalan membuang kelebihan kulit yang kendur dan lemak yang membuat mata mengantung.\r\n\r\nBody contouring: bertujuan untuk mengurangi kelebihan lemak tubuh dan membentuk kontur tubuh, termasuk di dalamnya:\r\n\r\nFacelift: mengurangi kerutan pada wajah dan mengencangkan kulit wajah yang keendur\r\nBreast lift: mengangkat payudara dan membesarkan payudara\r\nLower body lift: mengurangi ukuran perut yang membesar, bokong dan paha\r\nArm lift: mengencangkan lengan atas\r\n\r\nApa kelebihan dari bedah kosmetik?\r\n\r\nHasil lebih permanen dan dapat bertahan dalam jangka waktu lama', 'PROD0001_bedahkosmetik.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '1', '2019-07-02 09:55:41');
INSERT INTO `pelayanan` VALUES ('2', '1', 'active', 'PROD0002', 'Laser Treatment', 'laser-treatment', '1500000', '0', 'Adalah suatu tindakan laser yang bertujuan untuk mengatasi :\r\n• Problem pigmentasi/flek\r\n• Kerut-kerut halus dan pengencangan kulit (SR)\r\n• Pelebaran Pembuluh darah/telangiectasia (Vasculaser)\r\n• Menghilangkan rambut yang tidak diinginkan di bagian wajah atau tubuh tertentu (Hair Removal)\r\n\r\nCara Kerja Laser Treatment\r\nProfira Laser Treatment mempunyai target sasaran berupa pigmen seperti melanin, oksihemoglobin dalam sel darah merah dan pigmen pada tato. Sinar laser akan mengenai dan merusak pigmen-pigmen tersebut, kemudian akan mengalami fragmentasi dan akan terbawa aliran getah bening dan secara berangsur-angsur akan menghilang dari lokasi yang dilakukan terapi. Sedangkan pada daerah telangiectasia/couperous, sinar laser akan merusak sel-sel dinding pembuluh darah, sehingga pembuluh darah akan mengecil kemudian menghilang. Sinar laser juga menstimulasi produksi kolagen dan sel kulit baru sehingga kulit tampak lebih halus, lebih kencang dan lebih sehat\r\n\r\nPersiapan khusus sebelum dilakukan perawatan Tidak ada persiapan khusus yang perlu dilakukan. Pemakain produk-produk yang merangsang pengelupasan kulit hendaknya dihentikan 3-5 hari sebelum perawatan.\r\n\r\nReaksi yang terjadi setelah perawatan Kulit akan tampak sedikit kemerahan yang akan hilang setelah beberapa saat. Dapat juga timbul kerak-kerak pada area yang diterapi yang akan hilang dalam waktu 1 minggu.\r\n\r\nInterval Perawatan\r\nTergantung pada jenis problemnya, terkadang diperlukan lebih dari 1 kali perawatan dengan interval waktu 4-8 minggu', 'PROD0002_lasertreatment.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '1', '2019-07-02 09:58:19');
INSERT INTO `pelayanan` VALUES ('3', '1', 'active', 'PROD0003', 'Mikrodermabrasi', 'mikrodermabrasi', '2500000', '0', 'Apa yang disebut Mikrodermabrasi?\r\n\r\n Mikrodermabrasi adalah suatu cara untuk menghaluskan kulit yang kasar atau bergelombang. Merupakan tindakan nonbedah, yang menggunakan alat elektronik dengan sistem noninvasive yang bekerja mengabrasi/mengamplas kulit secara aman dan terkontrol, serta tidak ada resiko terjadinya kontaminasi. Alat mikrodermabrasi dapat menggunakan kristal atau tip  diamond.\r\n\r\nBagaimana kerja mikrodermabrasi memperbaiki kulit?\r\n\r\nTrauma minimal pada intra-epidermal yang dilakukan berulang-ulang dengan mikrodermabrasi, menyebabkan timbul usaha kulit untuk memperbaiki kerusakan secara bertahap dan regenerasi. Stratum korneum yang terkikis merangsang aktivitas stratum basalis mengganti lapisan epidermis. Aktivitas fibroblast di dermis meningkatkan pembentukan kolagen baru. Aliran darah untuk oksigenisasi kulit meningkat. Kulit akan tampak lebih sehat dan segar.\r\n\r\nKelainan kulit apa saja yang dapat diperbaiki dengan mikrodermabrasi?\r\n\r\nKulit yang kasar\r\nKulit yang tebal\r\nPori-pori yang membesar\r\nBekas jerawat / skar ringan\r\nPenuaan dini\r\nKerutan halus\r\nKulit kusam\r\nStrech mark / striae\r\nKapan mikrodermabrasi memberikan hasil yang nyata?\r\n\r\nMikrodermabrasi akan memberikan hasil yang baik bila dilakukan serial lebih dari 5 kali dengan interval paling cepat 1 minggu. Bila dikombinasi dengan tindakan chemical peeling, facial dan perawatan kulit harian akan memberikan hasil yang bermakna.\r\n\r\nApakah ada efek samping mikrodermabrasi?\r\n\r\nHampir tidak ada laporan mengenai efek samping. Yang pernah ada berupa : bekas hipo atau hiperpigmentasi akibat kulit yang mengelupas yang dapat diatasi.', 'PROD0003_mikrodermabrasi.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '1', '2019-07-02 09:59:33');
INSERT INTO `pelayanan` VALUES ('4', '1', 'active', 'PROD0004', 'Radio Frequency', 'radio-frequency', '1000000', '0', 'Apa yang disebut dengan RF face lift?\r\n\r\nMerupakan salah satu terapi yang efektif dan nyaman untuk mengencangkan kulit wajah dan mengurangi kerutan. Setelah menjalani terapi RF maka akan terasa kulit tampak lebih cerah, kencang, kenyal dan elastis. RF juga dapat mengurangi deposit lemak yang membandel pada wajah dan leher.\r\n\r\nMerupakan terapi pilihan bagi profesional yang sibuk tetapi tetap ingin menjaga penampilan\r\n\r\nBagaimana mekanisme kerja RF?\r\n\r\nEnergi dari RF akan masuk ke dalam kulit melalui aplikator bipolar yang akan menghangatkan kulit, merangsang produksi kolagen mengkontraksikan serabut kolagen agar kulit tampak kencang.\r\n\r\nDengan meningkatkan tenaga RF, sel lemak juga akan menjadi target dan dapat dihancurkan dengan metode lipolisis.\r\n\r\nApa manfaat RF?\r\n\r\nMengencangkan lapisan terluar kulit, mengurangi kerutan dan memperbaiki kontur wajah.. Bila sering menggunakan RF maka tidak perlu melakukan bedah face lift di kemudian hari. RF telah di setujui penggunaanya oleh FDA sebagai salah satu terapi non bedah untuk mengatasi kerutan dan memperbaiki tekstur kulit.\r\n\r\n \r\n\r\nBagaimana melakukan terapi RF?\r\n\r\nSelapis tipis gel diaplikasikan pada permukaan kulit wajah yang akan diterapi.  Aplikator RF digerakkan dengan  gerakan sirkuler untuk menghangatkan kulit. Temperatur kulit yang diharapkan akan tercapai dengan cepat kemudian akan terpelihara selama 2-3 menit. Setiap treatment memakan waktu 30-40 menit. Kemudian gel dipermukaan kulit dibersihkan dan kulit didinginkan.\r\n\r\nApa yang dirasakan setelah terapi RF?\r\n\r\n Dalam beberapa saat kulit akan kemerahan tettapi segera membaik dalam waktu singkat. Aktivitas normal dapat segera dilakukan tanpa membutuhkan perawatan khusus. Segera setelah terapi kontraksi serabut kolagen akan membuat wajah menjadi kencang dan lebih elastis. Namun hasil terbaik akan tampak setelah 1-2 bulan setelah terapi serial.\r\n\r\nBerapa kali terapi RF yang dibutuhkan untuk hasil yang terbaik?\r\n\r\nTerapi RF memberikan hasil yang menggembirakan bila dilakukan 6-8 kali dengan interval setiap minggu.\r\n\r\nApakah ada efek samping tindakan RF?\r\n\r\n Sangat jarang terjadi efek samping, tetapi dapat saja terjadi sedikit rasa tidak nyaman yang dengan cepat ditoleransi, edema (pembengkakan) dan kemerahan tetapi akan menghilang dalam beberapa jam kemudian.', 'PROD0004_rf.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '1', '2019-07-02 10:01:05');
INSERT INTO `pelayanan` VALUES ('5', '1', 'active', 'PROD0005', 'Peeling Kimia', 'peeling-kimia', '800000', '0', 'Chemical peeling, adalah proses pengelupasan akibat pemakaian bahan kimia pada kulit, sehingga menimbulkan perubahan pada dermis dan epidermis.  Bahan yang digunakan adalah bahan kimia yang bersifat kaustik, dengan tujuan memperbaiki keadaan kulit.\r\n\r\n \r\n\r\nMEKANISME KERJA PEELING KIMIA\r\n\r\n \r\n\r\nMerangsang pertumbuhan epidermis\r\nMerusak lapisan kulit yang mengalami kelainan khususnya pada pengobatan pigmentasi abnormal dan keratosis aktinik\r\nMerangsang pembentukan serabut kolagen baru dan substansi dasar pada dermis.\r\n \r\n\r\n Perawatan setelah Peeling AHA\r\n \r\n\r\nSetelah tindakan peeling pasien akan mengalami kemerahan pada wajah selama 1-2 jam.  Kadangkala di beberapa tempat dapat terjadi sedikit lecet yang perih selama 1-2 hari, namun kemudian akan mengelupas dengan sendirinya.\r\n\r\n \r\n\r\n Bagaimana cara pemakaian krim setelah tindakan peeling?\r\nOleskan Moisturizer pada malam hari setelah peeling\r\nGunakan Sunscreen/Morning cream pada pagi harinya.\r\nBila terdapat lecet, oleskan Biozinc 2x/hari (pagi dan malam) di tempat lecetnya saja sampai sembuh.\r\nBila tidak bermasalah keesokan harinya, dapat menggunakan krim seperti biasa.\r\n \r\n\r\nKapan dapat dilakukan tindakan peeling berikutnya?\r\nPeeling AHA 20% selama 4 kali, interval setiap 1 minggu.\r\nPeeling AHA 35% selama 2 kali, interval setiap 2 minggu\r\nPeeling AHA 50% selama 2 kali, interval setiap 3 minggu\r\nPeeling AHA 70% setiap 4 minggu\r\n \r\n\r\nPerawatan setelah Peeling dengan TCA dan Modified Jessner\r\n \r\n\r\nSetelah tindakan peeling, pasien akan mengalami kemerahan pada wajahnya selama 1-2 jam.  Keesokan harinya kulit secara keseluruhan terasa kencang dan kering.  Pada hari ke-3 di beberapa tempat akan  timbul flek coklat kehitaman.  Kulit kecoklatan yang kering tersebut berangsur-angsur mengelupas dengan sendirinya mulai hari ke-4 di sekitar daerah mulut, hidung dan dahi.  Wajah akan tampak bersih kembali antara hari ke 6-10.\r\n\r\n \r\n\r\nBagaimana cara pemakaian krim setelah tindakan peeling TCA atau Modified Jessner?\r\nHari pertama: gunakan krim Anti inflammation\r\nHari ke-2 dan ke-3: gunakan krim Moisturizer\r\nHari ke-4 dan ke-5: gunakan Smoothing cream\r\nHari ke-6 dan seterusnya dapat menggunakan krim wajah seperti biasa.\r\nBila terdapat lecet: oleskan hanya salep Biozinc 2x sehari (pagi dan malam) di tempat lecetnya saja sampai sembuh.\r\n \r\n\r\nKapan harus kontrol ke dokter?\r\nSatu minggu setelah tindakan peeling atau bila terdapat masalah\r\n\r\n \r\n\r\nMengapa tindakan peeling harus dilakukan berulangkali?\r\nPeeling dilakukan sesuai kondisi kulit pasien.  Makin sering peeling dilakukan, maka akan memacu regenerasi kulit makin baik.', 'PROD0005_pk.jpg', '0', null, '0', '0000-00-00 00:00:00', '1', '2019-07-02 10:02:28', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('6', '1', 'active', 'PROD0006', 'Revitalizing Eye', 'revitalizing-eye', '500000', '0', 'Pembersihan, sebelum perawatan dimulai, wajah dan area seputar mata dibersihkan untuk mengangkat sisa-sisa make up dan kotoran yang melekat. Pembersihan dilakukan dengan cleansing milk, dilanjutkan dengan membasuh wajah menggunakan spons yang telah dibasahi air untuk mengangkat sisa-sisa milk cleanser.\r\nPemijatan, setelah wajah bersih, dilanjutkan dengan pemijatan ringan di wajah dan area sekitar mata. Pemijatan dilakukan sekitar 15 menit, menggunakan Eye Treatment\r\nPenggunaan Alat Ultrasonic, dilakukan terapi menggunakan alat utrasonic eye treatment, selama sekitar 30 menit. Alat itu juga bekerja sebagap pemijatan di sekitar mata, mulai titik medial (tengah) di bagian dalam mata  dekat hidung, hingga lateral di bagian ujung luar mata. Pemijatan itu berfungsi untuk melancarkan aliran darah di sekitar mata. Ada tiga titik utama yang diterapi menggunakan alat ultrasonic tersebut. Yaitu, titik di bawah mata untuk mengurangi bengkak dan sembab, titik di pangkal medial mata untuk mengurangi kelelahan pada mata, dan titik di lateral yang berfungsi mengurangi keriput pada mata.', 'PROD0006_re.jpg', '0', null, '0', '0000-00-00 00:00:00', '1', '2019-07-02 10:05:45', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('7', '1', 'active', 'PROD0007', 'Ultrasound Facial', 'ultrasound-facial', '3000000', '2000000', 'Treatment\r\nUltrasound Facial Treatment\r\nUltrasound Facial Treatment\r\nApa yang dimaksud dengan ultrasound facial treatment?\r\n\r\nUltrasound facial treatment adalah prosedur perawatan kulit menggunakan gelombang suara frekuensi rendah sekitar 20 kilohertz bekerja dengan 3 sistem, yaitu: \r\n\r\n(1) mengangkat jaringan kulit mati secara aman,\r\n\r\n(2) membuat penetrasi lebih dalam molekul yang diaplikasikan pada wajah,\r\n\r\n(3) mempercepat penyembuhan luka dan mengurangi kerutan pada wajah. \r\n\r\nApa keuntungan dari penggunaan ultrasound yang lain?\r\n\r\nMemberikan hasil yang baik pada acne rosasea dan hiperpigmentasi. Dapat dilakukan pada semua jenis kulit dan warna kulit tanpa kecuali. Kulit akan menjadi lebih cerah, kencang, mengecilkan ukuran pori dan lembab.\r\n\r\nBagaimana cara kerja ultrasound?\r\n\r\nDengan media cairan serum, maka maka ultrasound akan bekerja mengangkat kulit mati dengan  “low energy, no injury” . Vibrasi yang lembut akan memutar molekul cairan melewati stratum korneum epidermis. Vibrasi gelombang sekitar 28,000 kali per detik akan membuka jalan untuk masuknya serum karena terjadi pengelupasan kulit mati secara cepat.\r\n\r\nKapan sebaiknya dilakukan serum intensive dengan ultrasound?\r\n\r\nSetelah dilakukan tindakan perawatan facial, peeling, mikrodermabrasi, atau pada kulit yang iritasi.', 'PROD0007_ultrasound.jpg', '0', null, '1', '2019-07-02 10:14:01', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('8', '1', 'active', 'PROD0008', 'High Frequency Electrotherapy', 'high-frequency-electrotherapy', '1000000', '500000', 'Apa yang disebut High Frequency Electrotherapy (HFE)?\r\n\r\nHFE adalah instrument yang penting dalam perawatan kulit. Melalui electrode tabung kaca akan timbul aliran high frequency yang akan diaplikasikan pada wajah. Terapi dengan HFE dilakukan setelah tindakan yang menyebabkan kulit terluka seperti ekstraksi komedo.', 'PROD0008_hf.jpg', '0', null, '1', '2019-07-02 10:21:27', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('9', '2', 'active', 'PROD0009', 'Rain n Dew Acne Cream', 'rain-n-dew-acne-cream', '250000', '0', 'Rain n Dew Acne cream mengandung bahan aktif retinol dan resorsinol. Retinol adalah salah satu bentuk vitamin A, merupakan vitamin antioksidan yang larut dalam lemak dan dapat digunakan untuk membantu menghilangkan jerawat. Pada kulit terdapat reseptor untuk retinoic acid yang terapat pada lapisan luar membran sel tempat retinol aktif bekerja menghilangkan jerawat. Sedangkan resorsinol bermanfaat untuk menghilangkan komedo dengan mengangkat kulit mati pada wajah.\r\n\r\nManfaat Rain \'n Dew Acne Cream :\r\n\r\nBerfungsi menstimulasi reproduksi sel\r\nMemperbaiki fungsi kulit\r\nMemperbaiki kerusakan kulit akibat pajanan sinar matahari\r\nMemperbaiki keratinisasi di sekitar folikel rambut yang mengakibatkan hilangnya jerawat dan komedo\r\nMenghaluskan dan melembutkan kulit\r\nMengecilkan pori\r\nMenstimulasi kolagen dan mencegah tanda penuaan dini.\r\nAkan lebih optimal hasilnya bila dikombinasikan dengan pemakaian Rain \'n Dew Whitening Cream', 'PROD0009_antiacne.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('10', '2', 'active', 'PROD0010', 'Rain n Dew Acne Gel', 'rain-n-dew-acne-gel', '250000', '0', 'Rain n Dew Acne Gel mengandung bahan aktif retinol dan resorsinol. Retinol adalah salah satu bentuk vitamin A, merupakan vitamin antioksidan yang larut dalam lemak dan dapat digunakan untuk membantu menghilangkan jerawat. Pada kulit terdapat reseptor untuk retinoic acid yang terapat pada lapisan luar membran sel tempat retinol aktif bekerja menghilangkan jerawat. Sedangkan resorsinol bermanfaat untuk menghilangkan komedo dengan mengangkat kulit mati pada wajah.\r\n\r\nManfaat Rain n Dew Acne Gel :\r\n\r\nBerfungsi menstimulasi reproduksi sel\r\nMemperbaiki fungsi kulit\r\nMemperbaiki kerusakan kulit akibat pajanan sinar matahari\r\nMemperbaiki keratinisasi di sekitar folikel rambut yang mengakibatkan hilangnya jerawat dan komedo\r\nMenghaluskan dan melembutkan kulit\r\nMengecilkan pori\r\nMenstimulasi kolagen dan mencegah tanda penuaan dini.\r\nAkan lebih optimal hasilnya bila dikombinasikan dengan pemakaian Rain \'n Dew Whitening Cream.\r\n\r\nDikarenakan berbentuk gel sehingga bisa dipakai pada pagi hari dan cocok untuk pria berjerawat karena bentuknya gel sehingga tidak terlihat.', 'PROD0010_antiacnegel.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('11', '2', 'active', 'PROD0011', 'Rain n Dew Anti Acne Solution', 'rain-n-dew-anti-acne-solution', '250000', '0', 'Rain n Dew Anti Acne Solution mengandung bahan aktif sulfur, retinol dan asam salisilat. Resorcinol, salicylic acid, and sulfur membantu menghilangkan whitehead comedo dan blackhead comedo. Asam salisilat membantu mengelupaskan kulit pada permukaan folikel rambut pada kelenjar minyak.\r\n\r\nRain n Dew anti acne solution memiliki efek pengelupasan dan iritasi, sangat efektif untuk jerawat pada dada, punggung dan lengan atas.\r\n\r\nManfaat Rain n Dew Anti Acne Solution :\r\n- Berfungsi menstimulasi reproduksi sel\r\n- Memperbaiki fungsi kulit\r\n- Memperbaiki keratinisasi disekitar folikel rambut yang mengakibatkan hilangnya jerawat dan komedo,\r\n- Mengecilkan pori', 'PROD0011_antiacnesolution.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `pelayanan` VALUES ('12', '2', 'active', 'PROD0012', 'Rain n Dew Milk Cleanser', 'rain-n-dew-milk-cleanser', '200000', '0', 'Kombinasi khusus yang diformulasikan tidak sekedar untuk membersihkan tetapi juga melembabkan kulit. Membuat kulit bersih dan lembut.\r\n\r\nSelanjutnya untuk mengangkat sisa produk Milk Cleanser dapat dilakukan pembersihan dengan Rain\'n Dew Facial wash untuk semua jenis kulit. Bagi kulit yang berminyak atau berjerawat dapat menggunakan Rainn Dew Facial wash acne', 'PROD0012_antiacnecleanser.jpg', '0', null, '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `konfirmasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(11) NOT NULL,
  `konfirmasi_tanggal` datetime DEFAULT NULL,
  `konfirmasi_nama_bank` varchar(50) DEFAULT NULL,
  `konfirmasi_nomor_rekening` varchar(50) DEFAULT NULL,
  `konfirmasi_nama_rekening` varchar(50) DEFAULT NULL,
  `konfirmasi_jumlah_transfer` float DEFAULT NULL,
  `konfirmasi_catatan` text,
  `konfirmasi_gambar` varchar(50) DEFAULT NULL,
  `konfirmasi_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`konfirmasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------
INSERT INTO `pembayaran` VALUES ('1', '1', '2019-07-19 23:45:50', 'BRI', '548768476945', 'Amanda Roziana', '2500000', 'sffsdfdsfds', '1_pribadi_coffee.png', '1');
INSERT INTO `pembayaran` VALUES ('2', '2', '2019-07-19 23:47:43', 'BRI', '786785765757', 'Amanda Roziana', '2000000', 'fndjskd', '2_mrpribadi.jpg', '1');

-- ----------------------------
-- Table structure for pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemesanan_nomer` varchar(50) NOT NULL,
  `pemesanan_total` float DEFAULT NULL,
  `pemesanan_status` int(2) DEFAULT '1',
  `pelanggan_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`pemesanan_id`,`pemesanan_nomer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
INSERT INTO `pemesanan` VALUES ('1', 'CUST00001', '2500000', '1', '1');
INSERT INTO `pemesanan` VALUES ('2', 'CUST00002', '2000000', '1', '1');

-- ----------------------------
-- Table structure for pemesanan_detail
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan_detail`;
CREATE TABLE `pemesanan_detail` (
  `pemesanan_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(11) DEFAULT NULL,
  `pelayanan_id` int(11) DEFAULT NULL,
  `pemesanan_detail_tanggal` date DEFAULT NULL,
  `pemesanan_detail_jam` int(5) DEFAULT NULL,
  `pemesanan_detail_nomor_ruangan` int(1) DEFAULT NULL,
  `pemesanan_detail_subtotal` float DEFAULT NULL,
  PRIMARY KEY (`pemesanan_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pemesanan_detail
-- ----------------------------
INSERT INTO `pemesanan_detail` VALUES ('1', '1', '3', '2019-07-20', '8', '1', '2500000');
INSERT INTO `pemesanan_detail` VALUES ('2', '2', '1', '2019-07-20', '10', '1', '2000000');

-- ----------------------------
-- Table structure for user_admin
-- ----------------------------
DROP TABLE IF EXISTS `user_admin`;
CREATE TABLE `user_admin` (
  `admin_id` int(3) NOT NULL AUTO_INCREMENT,
  `admin_level` varchar(20) DEFAULT NULL,
  `admin_status` varchar(8) DEFAULT 'active',
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(32) DEFAULT NULL,
  `admin_full_name` varchar(50) DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(3) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`,`admin_email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_admin
-- ----------------------------
INSERT INTO `user_admin` VALUES ('1', 'admin_super', 'active', 'didi@gmail.com', '202cb962ac59075b964b07152d234b70', 'Anggun Pribadi', '1', '2019-05-22 09:51:11', null, null);
INSERT INTO `user_admin` VALUES ('4', 'beautician', 'active', 'farkha@gmail.com', '202cb962ac59075b964b07152d234b70', 'Missnanda Farkha', '1', '2019-07-01 10:41:05', '1', '2019-07-05 14:40:31');
INSERT INTO `user_admin` VALUES ('6', 'beautician', 'active', 'amanda@gmail.com', '202cb962ac59075b964b07152d234b70', 'Amanda Putri', '1', '2019-07-05 11:13:01', '1', '2019-07-05 14:40:58');
INSERT INTO `user_admin` VALUES ('7', 'dokter', 'active', 'ayesha@gmail.com', '202cb962ac59075b964b07152d234b70', 'Ayesha Mayzuri', '1', '2019-07-19 16:48:34', null, null);
INSERT INTO `user_admin` VALUES ('8', 'kasir', 'active', 'riyanti@gmail.com', '202cb962ac59075b964b07152d234b70', 'Riyanti', '1', '2019-07-19 16:49:09', null, null);
