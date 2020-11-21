-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 10:15 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-grosir-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Deterjen'),
(2, 'Shampoo Botol'),
(3, 'Shampoo Renceng'),
(4, 'Sabun Batang'),
(5, 'Makanan Ringan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `no_keranjang` int(255) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`no_keranjang`, `id_produk`, `id_user`, `jumlah`) VALUES
(7, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `no_pelanggan` int(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `grup_pel` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`no_pelanggan`, `nama_pelanggan`, `grup_pel`, `alamat`, `kontak`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'Rianikha', 'Member', 'Subang', '083872899914', 'rian123', 'rianikha@gmail.com', 'default.jpg', '$2y$10$CXG1ooBetBEwFUcB7csvVO.GTjXhDeIKZPRGB7URki8yedM4ocrhq', 2, 1, 1557643135),
(3, 'Arsien', 'Member', 'Subang', '08123456789', 'firo', 'firo@gmail.com', 'default.jpg', '$2y$10$sbLNKuGWLw9AZG/ItuwZ8uf2B33bpbG/X8E4Nq9BwxRDSMi37Ma8m', 2, 1, 1557649178),
(4, 'Alfinus Akmalus', 'Member', 'subang', '083872899914', 'alfin123', 'alfinfattah@gmail.com', 'default.jpg', '$2y$10$Kiz7rLCqnYbxIVVuLS.TVe6WCkgpXK.Rf0fEQmDae9HUYafjZj6P6', 2, 1, 1558252714),
(5, 'Choco White', 'Pemilik Warung', 'Tambak Mekar', '+6283872899912', 'firizki123', 'firoo@gmail.com', 'kiritoimfine.png', '$2y$10$SjoKn5XtxnCSCF0DbVzR7Oojdg/eLOlFaTi1xZanNcOqjdCYqC4cq', 1, 1, 1558255117),
(6, 'Froblema', 'Pemilik Warung', 'Jalancagak', '083872899914', 'firizki212', 'firofa@yahoo.com', 'yes.png', '$2y$10$KdvUE4WSeCAKdM3cwM/1yOIO1ZNM87eF6Bhmpla3YkjxIzsDJFuMO', 1, 1, 1560691046),
(8, 'Adi Perwira', 'Member', 'Bandung', '082128823592', 'adi212', 'arfiro@gmail.com', '5086_Uno_Nanbaka.png', '$2y$10$npFQLGd6GvE8nr9ND0tLDerlOUpV5uv1qbirvkikPg1ouRP0JG64y', 2, 1, 1560693610),
(9, 'M Bagas Setia', 'Member', 'Sagala Herang', '0812345678910', 'bagas123', 'setiapermanabagas@gmail.com', 'default.jpg', '$2y$10$Iud1EsIRke46RvQi7gbAb.K1qvCSFOCDBIok60T.0MT6WLePYf1dK', 2, 0, 1562309661);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `tanggal_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_produk`, `id_user`, `jumlah`, `id_status`, `tanggal_pemesanan`) VALUES
(5, 1, 5, 1, 4, 1562387921),
(6, 2, 5, 1, 4, 1562387921),
(7, 3, 5, 10, 4, 1562388027),
(8, 1, 5, 2, 4, 1562402137),
(10, 2, 5, 10, 4, 1562406316),
(11, 7, 5, 1, 4, 1562420169),
(12, 3, 5, 1, 2, 1562420169),
(13, 2, 5, 1, 1, 1562420169),
(14, 3, 5, 2, 1, 1562470540),
(15, 7, 5, 5, 1, 1562470540),
(16, 9, 5, 10, 1, 1562471418);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `stok_produk` int(255) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga_pokok` int(255) NOT NULL,
  `harga_jual` int(255) NOT NULL,
  `keterangan` text NOT NULL,
  `date_updated` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `image`, `stok_produk`, `id_satuan`, `id_kategori`, `harga_pokok`, `harga_jual`, `keterangan`, `date_updated`) VALUES
(1, 'S001', 'Shampoo Botol Lifebuoy', 'shampoo_lifebuoy.jpg', 5, 2, 2, 9000, 10000, '', 1558842882),
(2, 'D001', 'Daia Softener+ Pink', 'daia_softener_pink.png', 3, 1, 1, 12000, 15000, '', 1558842882),
(3, 'S002', 'Shampoo Clear Botol', 'shampoo_clear2.jpg', 15, 1, 2, 6000, 7000, 'Produk Shampoo dengan merk Clear', 1561471962),
(6, 'S003', 'Shampoo Clear Renceng Biru', 'sampo-clear.jpg', 15, 2, 3, 3000, 3000, 'Shampoo Clear Renceng Warna Biru', 1562417550),
(7, 'SB01', 'Sabun Batang Lifebuoy Clini Shield Fresh 70gr', 'lifebuoy-sbn-clini-shield-fresh-70gr-pcs.jpg', 19, 1, 4, 2000, 2000, 'Sabun Batang Lifebuoy Clini Shield untuk membersihkan badan dari kuman', 1562417663),
(8, 'S004', 'Pantene Conditioner', '13408.jpg', 12, 1, 2, 3000, 3000, 'Bersihkan rambut dan jadikan rambut sehat dengan pantene', 1562417857),
(9, 'MR001', 'Kusuka Ayam Lada Hitam 200g', 'kusuka_kusuka-ayam-lada-hitam-keripik-singkong--180-g-_full028.jpg', 50, 1, 5, 3000, 4000, 'Produk Kusuka Ayam lada hitam, makanan ringan keripik singkong dengan rasa ayam lada hitam', 1562466170),
(10, 'MR002', 'Chitato Indomie', 'chitato-indomie.jpg', 60, 1, 5, 3000, 3000, 'Chitato dengan Rasa Mie Indomie, Perpaduan rasa keripik kentang dan rasa khas indomie pasti bikin kamu ketagihan..', 1562418163);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id` int(11) NOT NULL,
  `satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_produk`
--

INSERT INTO `satuan_produk` (`id`, `satuan`) VALUES
(1, 'pcs'),
(2, 'Renceng');

-- --------------------------------------------------------

--
-- Table structure for table `status_produk`
--

CREATE TABLE `status_produk` (
  `id_status` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_produk`
--

INSERT INTO `status_produk` (`id_status`, `status`) VALUES
(1, 'Sedang Diproses'),
(2, 'Siap Ambil'),
(3, 'Sudah Diambil'),
(4, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(6, 2, 4),
(7, 2, 2),
(10, 1, 3),
(11, 1, 4),
(13, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Shop');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(4, 3, 'Sub Menu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(5, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(6, 4, 'Check Shop', 'Shop', 'fas fa-fw fa-shopping-bag', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(10, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(11, 1, 'Data Pelanggan', 'admin/dataanggota', 'fas fa-fw fa-user-friends', 1),
(12, 1, 'Data Barang', 'admin/databarang', 'fas fa-fw fa-box', 1),
(13, 4, 'My Cart', 'shop/cart', 'fas fa-fw fa-shopping-cart', 1),
(14, 1, 'Data Pesanan', 'admin/pesanan', 'fas fa-fw fa-sticky-note', 1),
(15, 4, 'Status Pesanan', 'shop/pesanan', 'fas fa-fw fa-envelope-open-text', 1),
(16, 1, 'History Pesanan', 'admin/historypesanan', 'fas fa-fw fa-history', 1),
(17, 1, 'Data Pendapatan', 'admin/datakas', 'fas fa-fw fa-coins', 1),
(18, 1, 'Data Kategori', 'admin/category', 'fas fa-fw fa-tags', 1),
(19, 1, 'Data Satuan', 'admin/datasatuan', 'fas fa-fw fa-bars', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'setiapermanabagas@gmail.com', 'NTjj72rlsKosxZKdTSSbMotg9dvrwvg+Wt74Ux45iG8=', 1562309661);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`no_keranjang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`no_pelanggan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_produk`
--
ALTER TABLE `status_produk`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `no_keranjang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `no_pelanggan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `satuan_produk`
--
ALTER TABLE `satuan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_produk`
--
ALTER TABLE `status_produk`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
