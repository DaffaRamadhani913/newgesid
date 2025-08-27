<?php
return [
  'bpn' => [
    ['url' => 'admin/bpn', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'admin/bpn/data-member', 'icon' => 'mdi:alert-outline', 'label' => 'Data Member'],
    ['url' => 'admin/bpn/verifikasi-member', 'icon' => 'mdi:account-check-outline', 'label' => 'Verifikasi Member'],
    ['url' => 'admin/bpn/artikel', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Artikel'],
    ['url' => 'admin/bpn/acara', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Acara'],
    ['url' => 'admin//bpn/adminbpw', 'icon' => 'mdi:account-tie-outline', 'label' => 'Admin BPW'],
  ],
  'bpd' => [
    ['url' => 'admin/bpd', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'admin/bpd/data-member', 'icon' => 'mdi:alert-outline', 'label' => 'Data Member'],
    ['url' => 'admin/bpd/aduan', 'icon' => 'mdi:alert-outline', 'label' => 'Aduan'],
    ['url' => 'admin/bpd/artikel', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Artikel'],
    ['url' => 'admin/bpd/acara', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Acara'],
    ['url' => 'admin//bpd/adminbpdes', 'icon' => 'mdi:account-tie-outline', 'label' => 'Admin BPDes'],
  ],

  'bpdes' => [
    ['url' => 'admin/bpdes', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'admin/bpdes/data-member', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Data Member'],
    ['url' => 'admin/bpdes/aduan', 'icon' => 'mdi:alert-outline', 'label' => 'Aduan'],
    ['url' => 'admin/bpdes/artikel', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Artikel'],
    ['url' => 'admin/bpdes/acara', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Acara'],
  ],


  'bpw' => [
    ['url' => 'admin/bpw', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'admin/bpw/data-member', 'icon' => 'mdi:alert-outline', 'label' => 'Data Member'],
    ['url' => 'admin/bpw/artikel', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Artikel'],
    ['url' => 'admin/bpw/acara', 'icon' => 'mdi:account-check-outline', 'label' => 'Buat Acara'],
    ['url' => 'admin//bpw/adminbpd', 'icon' => 'mdi:account-tie-outline', 'label' => 'Admin BPD'],
  ],
  'superadmin' => [
    ['url' => 'admin/superadmin', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'admin/superadmin/data-member', 'icon' => 'mdi:account-group', 'label' => 'Data Member'],
    ['url' => 'admin/superadmin/pengurus/manage_view', 'icon' => 'mdi:account-tie', 'label' => 'Pengurus BPN'],
    ['url' => 'admin/superadmin/roles/access_control', 'icon' => 'mdi:shield-account-outline', 'label' => 'Hak Akses'],

    // ✅ Tambahan Menu Baru
    ['url' => 'admin/slider', 'icon' => 'mdi:image-album', 'label' => 'Kelola Slider'],
    ['url' => 'admin/selayang-pandang', 'icon' => 'mdi:book-open-outline', 'label' => 'Latar Belakang'],
    ['url' => 'admin/visi-misi', 'icon' => 'mdi:target-variant', 'label' => 'Visi & Misi'],
    // ✅ Tambahan menu Event
    ['url' => 'admin/events', 'icon' => 'mdi:calendar-star', 'label' => 'Event'],
    ['url' => 'admin/superadmin/verifikasi-artikel', 'icon' => 'mdi:target-variant', 'label' => 'Verifikasi Artikel'],
    ['url' => 'admin/superadmin/verifikasi-acara', 'icon' => 'mdi:target-variant', 'label' => 'Verifikasi Acara'],
    ['url' => 'admin/superadmin/adminbpn', 'icon' => 'mdi:account-tie-outline', 'label' => 'Admin BPN'],

  ],
  'member' => [
    ['url' => 'member', 'icon' => 'mdi:view-dashboard-outline', 'label' => 'Dashboard'],
    ['url' => 'member/aduan', 'icon' => 'mdi:alert-outline', 'label' => 'Aduan'],
    ['url' => 'member/profile', 'icon' => 'mdi:account-circle-outline', 'label' => 'Profil Saya'],
  ],


];
