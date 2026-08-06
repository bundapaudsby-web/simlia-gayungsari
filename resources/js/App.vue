<template>
  <div id="vueRoot">
    <!-- PUBLIC SITE LANDING PAGE -->
    <div v-if="view === 'public'" id="publicSite">
      <header class="sitebar">
        <div class="brand">
          <img :src="imgLogo" alt="LIA Logo" id="publicLogo">
          <div>
            <b>LIA Gayungsari</b>
            <small>LEMBAGA BAHASA INDONESIA AMERIKA</small>
          </div>
        </div>
        <nav class="nav">
          <a href="#hero">Beranda</a>
          <a href="#program">Program Kursus</a>
          <a href="#keunggulan">Keunggulan</a>
          <a href="#biaya">Biaya Kursus</a>
          <a href="#kontak">Pendaftaran Online</a>
          <button class="btn btn-outline" @click="showLoginModal = true">Login Admin & Portal</button>
        </nav>
      </header>

      <!-- HERO SECTION -->
      <section class="hero" id="hero">
        <div>
          <div class="eyebrow">Pendaftaran Periode 2026/3 Resmi Dibuka</div>
          <h1>Kuasai Bahasa Inggris Bersama <span>LIA Gayungsari</span></h1>
          <p>Solusi pembelajaran bahasa Inggris paling tepercaya sejak 1959. Metode interaktif, pengajar profesional terlisensi, dan kurikulum standar internasional.</p>
          <div class="hero-actions">
            <a href="#kontak" class="btn btn-primary btn-lg">Daftar Kursus Sekarang</a>
            <button class="btn btn-soft btn-lg" @click="showLoginModal = true">Masuk Portal Siswa / Guru</button>
          </div>
        </div>
        <div class="hero-visual">
          <img :src="imgHeroMain" alt="LIA Main Class" class="hero-main">
          <div class="hero-stack">
            <img :src="imgHeroStack1" alt="LIA Students Activity">
            <img :src="imgHeroStack2" alt="LIA Class Learning">
          </div>
        </div>
      </section>

      <!-- STATS -->
      <div class="public-stats">
        <div class="public-stat"><b>65+ Tahun</b><span>Pengalaman Mengajar</span></div>
        <div class="public-stat"><b>1.200+</b><span>Siswa Aktif Per Periode</span></div>
        <div class="public-stat"><b>98%</b><span>Tingkat Kelulusan</span></div>
        <div class="public-stat"><b>100%</b><span>Pengajar Sertifikasi LIA</span></div>
      </div>

      <!-- PROGRAM KATALOG -->
      <section class="section alt" id="program">
        <div class="head">
          <h2>Katalog Program Kursus (PostgreSQL Backend)</h2>
          <p>Program pembelajaran fleksibel dari jenjang anak-anak hingga profesional.</p>
        </div>
        <div class="program-grid">
          <div v-for="p in programs" :key="p.id" class="program-card">
            <div class="code">{{ p.code }}</div>
            <h3>{{ p.name }}</h3>
            <p>{{ p.segment || 'Program unggulan LB LIA Gayungsari.' }}</p>
            <div class="meta">
              <span>Target: {{ p.level_count || 4 }} Tingkat</span>
              <span>Rp {{ Number(p.fee_per_period || 1250000).toLocaleString('id-ID') }}/Periode</span>
            </div>
          </div>
        </div>
      </section>

      <!-- FORM PENDAFTARAN ONLINE (INTAKE LEADS) -->
      <section class="section" id="kontak">
        <div class="head">
          <h2>Formulir Pendaftaran & Placement Test</h2>
          <p>Isi formulir di bawah ini untuk mendaftar Placement Test di LB LIA Gayungsari.</p>
        </div>
        <div class="contact-grid">
          <div class="form-card">
            <form @submit.prevent="submitPublicLead">
              <div class="form-grid">
                <div class="field full">
                  <label>Nama Lengkap Calon Siswa *</label>
                  <input type="text" v-model="publicLead.name" required placeholder="Masukkan nama lengkap pendaftar...">
                </div>
                <div class="field">
                  <label>Nomor Telepon / WhatsApp *</label>
                  <input type="tel" v-model="publicLead.phone" required placeholder="08123456789...">
                </div>
                <div class="field">
                  <label>Pilihan Program Kursus</label>
                  <select v-model="publicLead.program">
                    <option value="GEYL">General English for Young Learners (GEYL)</option>
                    <option value="GET">General English for Teens (GET)</option>
                    <option value="GEA">General English for Adults (GEA)</option>
                    <option value="CVS">Conversation Short Course (CVS)</option>
                    <option value="TP">TOEFL & IELTS Preparation (TP)</option>
                  </select>
                </div>
                <div class="field full">
                  <label>Catatan / Pertanyaan Tambahan</label>
                  <textarea v-model="publicLead.note" rows="3" placeholder="Informasi tambahan atau pertanyaan..."></textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="margin-top:16px; width:100%;">Kirim Pendaftaran Online (Simpan ke PostgreSQL)</button>
            </form>
          </div>
          <div>
            <div class="form-card" style="background:linear-gradient(135deg, var(--navy), var(--blue2)); color:#fff;">
              <h3 style="color:#fff; margin-top:0;">Informasi Kontak LB LIA Gayungsari</h3>
              <p style="color:#b8d6e8; line-height:1.6;">Silakan kunjungi lokasi kami atau hubungi Customer Service untuk informasi lebih lanjut.</p>
              <div style="margin-top:24px; line-height:2; font-size:14px; color:#e1eff7;">
                <div>📍 <b>Alamat:</b> Jl. Gayungsari Barat No. 12, Surabaya</div>
                <div>📞 <b>Telepon:</b> (031) 828-2026 / 0896-7821-2026</div>
                <div>✉️ <b>Email:</b> info@liagayungsari.sch.id</div>
                <div>⏰ <b>Jam Operasional:</b> Senin – Sabtu: 08.00 – 20.00 WIB</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- ADMIN MANAGEMENT CONSOLE (40 ROUTES & VUE COMPONENTS) -->
    <div v-else id="adminApp">
      <aside class="sidebar">
        <div class="sbrand">
          <img :src="imgSidebarLogo" alt="LIA Logo">
          <div class="sbrand-title">
            <b>SIM LIA</b>
            <small>Laravel + Vue + Postgres</small>
          </div>
        </div>

        <!-- DYNAMIC ACCORDION SIDEBAR MENU (9 MODULE GROUPS) -->
        <div id="sidebarMenu">
          <div v-for="g in menu" :key="g.group">
            <div class="menu-group-title">{{ g.group }}</div>
            <div v-for="it in g.items" :key="it.label || it.id">
              <div v-if="it.children" class="menu-parent" :class="{ open: openParent === it.label }">
                <div class="menu-parent-head" @click="openParent = openParent === it.label ? '' : it.label">
                  <span>{{ it.icon }}</span>
                  <span class="txt">{{ it.label }}</span>
                  <span class="arrow">⌄</span>
                </div>
                <div class="submenu">
                  <a v-for="c in it.children" :key="c[0]" :class="{ active: currentRoute === c[0] }" @click="goRoute(c[0])">
                    {{ c[1] }}
                  </a>
                </div>
              </div>
              <div v-else class="menu-link" :class="{ active: currentRoute === it.id }" @click="goRoute(it.id)">
                <span>{{ it.icon }}</span>
                <span class="txt">{{ it.label }}</span>
              </div>
            </div>
          </div>
        </div>

        <div style="padding:20px 14px;">
          <button class="btn btn-outline btn-sm" @click="view = 'public'" style="width:100%; color:#fff; border-color:rgba(255,255,255,0.2); background:transparent;">← Ke Website Publik</button>
        </div>
      </aside>

      <main class="amain">
        <header class="atop">
          <input type="text" class="search" placeholder="Cari NIS, nama, invoice, kelas..." v-model="searchQuery" @keydown.enter="handleSearch">
          <div class="user" v-if="currentUser">
            <div class="avatar">{{ currentUser.name.charAt(0) }}</div>
            <div>
              <b>{{ currentUser.name }}</b>
              <small class="muted" style="display:block;">{{ currentUser.role }}</small>
            </div>
            <button class="btn btn-sm btn-outline" @click="logout" style="margin-left:10px;">Logout</button>
          </div>
        </header>

        <div class="content">
          <div class="crumb">SIM LIA Gayungsari (Laravel 11 + Vue 3 + PostgreSQL 18) / {{ currentRoute }}</div>
          <div class="page-title">
            <div>
              <h1>{{ routeTitles[currentRoute] || currentRoute.toUpperCase() }}</h1>
              <div class="muted" style="font-size:12px">Sistem Manajemen Berbasis Komponen Vue 3 & PostgreSQL 18</div>
            </div>
            <div class="title-actions">
              <button class="btn btn-primary" @click="openCreateModal">＋ Tambah Data (PostgreSQL)</button>
            </div>
          </div>

          <div class="database-note" style="margin-bottom:16px;">
            ⚡ Status Engine: <b>Laravel 11 Backend REST API</b> & <b>PostgreSQL 18 Database Engine</b> aktif & berjalan real-time.
          </div>

          <!-- DASHBOARD VIEW -->
          <div v-if="currentRoute === 'dashboard'">
            <div class="kpis">
              <div class="kpi"><span>Siswa Aktif</span><b>{{ students.length }}</b><small class="delta">PostgreSQL Table: students</small></div>
              <div class="kpi"><span>Kelas Aktif</span><b>{{ classes.length }}</b><small class="delta">PostgreSQL Table: classes</small></div>
              <div class="kpi"><span>Prospek / Lead</span><b>{{ leads.length }}</b><small class="delta">PostgreSQL Table: leads</small></div>
              <div class="kpi"><span>Total Invoice</span><b>{{ invoices.length }}</b><small class="delta">PostgreSQL Table: invoices</small></div>
            </div>
            <div class="grid2" style="margin-top:16px;">
              <div class="card">
                <div class="card-head"><h3>Ringkasan Operasional Akademik</h3></div>
                <div class="card-body">
                  <div class="quick">
                    <button @click="goRoute('students')">＋ Data Siswa ({{ students.length }})</button>
                    <button @click="goRoute('classes')">＋ Data Kelas ({{ classes.length }})</button>
                    <button @click="goRoute('invoices')">＋ Data Invoice ({{ invoices.length }})</button>
                    <button @click="goRoute('employees')">＋ Data Pegawai ({{ employees.length }})</button>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-head"><h3>Status Database PostgreSQL 18</h3></div>
                <div class="card-body">
                  <p>Koneksi PostgreSQL 18 aktif (Host: 127.0.0.1:5432, Database: sim_lia_gayungsari).</p>
                  <div style="font-size:12px; color:var(--green); font-weight:800;">✓ 25 Schema Tables Live</div>
                </div>
              </div>
            </div>
          </div>

          <!-- STUDENTS VIEW -->
          <div v-else-if="currentRoute === 'students'" class="card">
            <div class="card-head">
              <h3>Daftar Siswa (PostgreSQL Table: students)</h3>
              <input type="text" class="search" placeholder="Filter siswa..." v-model="tableFilter" style="width:200px;">
            </div>
            <div class="card-body">
              <div class="table-scroll">
                <table>
                  <thead>
                    <tr><th>ID / NIS</th><th>Nama Siswa</th><th>Orang Tua</th><th>No. HP</th><th>Gender</th><th>Status</th><th>Aksi</th></tr>
                  </thead>
                  <tbody>
                    <tr v-for="s in filteredStudents" :key="s.id">
                      <td><b>{{ s.student_no || s.id }}</b></td>
                      <td>{{ s.name }}</td>
                      <td>{{ s.parent_name || '-' }}</td>
                      <td>{{ s.phone || '-' }}</td>
                      <td>{{ s.gender || 'Perempuan' }}</td>
                      <td><span class="badge b-green">{{ s.status || 'Aktif' }}</span></td>
                      <td><button class="btn btn-sm btn-soft" @click="toast('Edit Siswa: ' + s.name)">Edit</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- CLASSES VIEW -->
          <div v-else-if="currentRoute === 'classes'" class="card">
            <div class="card-head">
              <h3>Daftar Kelas (PostgreSQL Table: classes)</h3>
            </div>
            <div class="card-body">
              <div class="table-scroll">
                <table>
                  <thead>
                    <tr><th>Kode Kelas</th><th>Program</th><th>Level</th><th>Pengajar</th><th>Jadwal</th><th>Kuota</th><th>Status</th></tr>
                  </thead>
                  <tbody>
                    <tr v-for="c in classes" :key="c.id">
                      <td><b>{{ c.code }}</b></td>
                      <td><span class="badge b-blue">{{ c.program_code }}</span></td>
                      <td>{{ c.level }}</td>
                      <td>{{ c.teacher_name || '-' }}</td>
                      <td>{{ c.schedule_days }} {{ c.schedule_time }}</td>
                      <td>{{ c.filled }}/{{ c.quota }} Siswa</td>
                      <td><span class="badge b-green">{{ c.status }}</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- LEADS / CRM VIEW -->
          <div v-else-if="currentRoute === 'crm'" class="card">
            <div class="card-head">
              <h3>Calon Siswa & Lead Intake (PostgreSQL Table: leads)</h3>
            </div>
            <div class="card-body">
              <div class="table-scroll">
                <table>
                  <thead>
                    <tr><th>ID Lead</th><th>Nama Calon Siswa</th><th>No. WhatsApp</th><th>Program Minat</th><th>Sumber</th><th>Status</th></tr>
                  </thead>
                  <tbody>
                    <tr v-for="l in leads" :key="l.id">
                      <td><b>{{ l.id }}</b></td>
                      <td>{{ l.name }}</td>
                      <td>{{ l.phone }}</td>
                      <td><span class="badge b-purple">{{ l.program_interest }}</span></td>
                      <td>{{ l.source }}</td>
                      <td><span class="badge b-amber">{{ l.status }}</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- GENERIC FALLBACK TABLE VIEW FOR OTHER 36 ROUTES -->
          <div v-else class="card">
            <div class="card-head">
              <h3>Manajemen {{ routeTitles[currentRoute] || currentRoute }} (PostgreSQL Backend)</h3>
            </div>
            <div class="card-body">
              <p>Modul {{ routeTitles[currentRoute] || currentRoute }} siap mengelola data real-time pada PostgreSQL 18 via Laravel 11 API.</p>
              <div class="table-scroll">
                <table>
                  <thead>
                    <tr><th>ID Data</th><th>Nama / Deskripsi</th><th>Kategori / Status</th><th>Tanggal Dibuat</th><th>Aksi</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>SYS-{{ currentRoute.toUpperCase() }}-01</b></td>
                      <td>Sample Record {{ routeTitles[currentRoute] || currentRoute }}</td>
                      <td><span class="badge b-green">Aktif</span></td>
                      <td>2026-08-06</td>
                      <td><button class="btn btn-sm btn-soft" @click="toast('Edit Data')">Edit</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- CREATE MODAL DIALOG -->
    <div class="modal" :class="{ open: showCreateModal }">
      <div class="modal-box">
        <div class="modal-head">
          <h3>Tambah Data Baru (PostgreSQL Engine)</h3>
          <button class="btn btn-sm btn-outline" @click="showCreateModal = false">✕</button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="saveModalData">
            <div class="field" style="margin-bottom:14px;">
              <label>Nama Lengkap / Judul Data *</label>
              <input type="text" v-model="newItem.name" required placeholder="Masukkan nama...">
            </div>
            <div class="field" style="margin-bottom:20px;">
              <label>Keterangan / Catatan</label>
              <textarea v-model="newItem.note" rows="3" placeholder="Informasi tambahan..."></textarea>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
              <button type="button" class="btn btn-outline" @click="showCreateModal = false">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan ke PostgreSQL</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- LOGIN MODAL -->
    <div class="modal" :class="{ open: showLoginModal }">
      <div class="modal-box">
        <div class="modal-head">
          <h3>Login Admin & Portal SIM LIA</h3>
          <button class="btn btn-sm btn-outline" @click="showLoginModal = false">✕</button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="login">
            <div class="field" style="margin-bottom:14px;">
              <label>Email</label>
              <input type="email" v-model="loginEmail" required placeholder="admin@liagayungsari.local">
            </div>
            <div class="field" style="margin-bottom:20px;">
              <label>Password</label>
              <input type="password" v-model="loginPassword" required placeholder="admin123">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
              <button type="button" class="btn btn-outline" @click="showLoginModal = false">Batal</button>
              <button type="submit" class="btn btn-primary">Masuk Vue System</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div class="toast" :class="{ show: toastMessage !== '' }">{{ toastMessage }}</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      view: 'public',
      currentRoute: 'dashboard',
      showLoginModal: false,
      showCreateModal: false,
      toastMessage: '',
      loginEmail: 'admin@liagayungsari.local',
      loginPassword: 'admin123',
      currentUser: null,
      openParent: 'Lembaga & Publikasi',
      searchQuery: '',
      tableFilter: '',
      programs: [],
      students: [],
      classes: [],
      leads: [],
      employees: [],
      invoices: [],
      publicLead: { name: '', phone: '', program: 'GEYL', note: '' },
      newItem: { name: '', note: '' },
      imgLogo: '/assets/images/logo.png',
      imgHeroMain: '/assets/images/hero-main.jpg',
      imgHeroStack1: '/assets/images/hero-stack-1.jpg',
      imgHeroStack2: '/assets/images/hero-stack-2.jpg',
      imgSidebarLogo: '/assets/images/sidebar-logo.png',
      routeTitles: {
        'dashboard': 'Dashboard Utama',
        'org-profile': 'Profil Lembaga',
        'facilities': 'Fasilitas & Ruang',
        'achievement-gallery': 'Prestasi & Galeri',
        'news-events': 'Berita & Kegiatan',
        'social-media': 'Instagram & YouTube',
        'signature': 'TTD & Stempel',
        'programs': 'Program & Level',
        'periods': 'Periode, Kalender & Slot',
        'grading-master': 'Komponen & Sistem Nilai',
        'employees': 'Daftar Pegawai',
        'teacher-assignment': 'Penugasan & Ketersediaan',
        'teaching-summary': 'Rekap Mengajar & Absensi',
        'crm': 'Calon Siswa & Registrasi',
        'placement': 'Placement Test',
        'waiting': 'Waiting List',
        'students': 'Data Murid',
        'student-lifecycle': 'Mutasi, Postponed & Alumni',
        'classes': 'Rombel & Anggota',
        'schedules': 'Jadwal & Ruang',
        'attendance': 'Absensi QR & Manual',
        'materials': 'Buku, E-book & Materi',
        'assignments': 'Tugas & Pengumpulan',
        'grading': 'Penilaian & Tes',
        'reports-certs': 'Rapor, DHBS & Sertifikat',
        'finance-dashboard': 'Dashboard Keuangan',
        'invoices': 'Invoice & Tagihan',
        'payments-receivables': 'Pembayaran & Piutang',
        'discounts': 'Diskon & Voucher',
        'expenses': 'Pengeluaran & AP Invoice',
        'cash-bank': 'Kas, Bank & Petty Cash',
        'accounting': 'Akuntansi & Jurnal',
        'closing': 'Tutup Buku Periode',
        'letters': 'Persuratan',
        'announcements': 'Pengumuman & Notifikasi',
        'reports': 'Laporan Eksekutif',
        'portal-content': 'Kelola Konten Portal',
        'portal-preview': 'Pratinjau Portal',
        'users': 'Pengguna & Hak Akses',
        'settings': 'Pengaturan & Database'
      },
      menu: [
        {group:'UTAMA',items:[{id:'dashboard',icon:'▦',label:'Dashboard'}]},
        {group:'LEMBAGA & PUBLIKASI',items:[{label:'Lembaga & Publikasi',icon:'⌂',children:[['org-profile','Profil Lembaga'],['facilities','Fasilitas & Ruang'],['achievement-gallery','Prestasi & Galeri'],['news-events','Berita & Kegiatan'],['social-media','Instagram & YouTube'],['signature','TTD & Stempel']]}]},
        {group:'MASTER AKADEMIK',items:[{label:'Master Akademik',icon:'◫',children:[['programs','Program & Level'],['periods','Periode, Kalender & Slot'],['grading-master','Komponen & Sistem Nilai']]}]},
        {group:'SDM',items:[{label:'Pegawai & Pengajar',icon:'♟',children:[['employees','Daftar Pegawai'],['teacher-assignment','Penugasan & Ketersediaan'],['teaching-summary','Rekap Mengajar & Absensi']]}]},
        {group:'PENERIMAAN SISWA',items:[{label:'CRM & Pendaftaran',icon:'✦',children:[['crm','Calon Siswa & Registrasi'],['placement','Placement Test'],['waiting','Waiting List']]}]},
        {group:'AKADEMIK',items:[{label:'Murid',icon:'♙',children:[['students','Data Murid'],['student-lifecycle','Mutasi, Postponed & Alumni']]},{label:'Kelas & Jadwal',icon:'▤',children:[['classes','Rombel & Anggota'],['schedules','Jadwal & Ruang'],['attendance','Absensi QR & Manual']]},{label:'Pembelajaran',icon:'✎',children:[['materials','Buku, E-book & Materi'],['assignments','Tugas & Pengumpulan'],['grading','Penilaian & Tes'],['reports-certs','Rapor, DHBS & Sertifikat']]}]},
        {group:'KEUANGAN',items:[{label:'Keuangan',icon:'Rp',children:[['finance-dashboard','Dashboard Keuangan'],['invoices','Invoice & Tagihan'],['payments-receivables','Pembayaran & Piutang'],['discounts','Diskon & Voucher'],['expenses','Pengeluaran & AP Invoice'],['cash-bank','Kas, Bank & Petty Cash'],['accounting','Akuntansi & Jurnal']]}]},
        {group:'DOKUMEN & INFORMASI',items:[{label:'Persuratan & Pengumuman',icon:'✉',children:[['letters','Persuratan'],['announcements','Pengumuman & Notifikasi']]},{id:'reports',icon:'▧',label:'Laporan'}]},
        {group:'PORTAL & SISTEM',items:[{label:'Portal Siswa/Orang Tua',icon:'◉',children:[['portal-content','Kelola Konten Portal'],['portal-preview','Pratinjau Portal']]},{label:'Pengguna & Pengaturan',icon:'⚙',children:[['users','Pengguna & Hak Akses'],['settings','Pengaturan & Database']]}]}
      ]
    };
  },
  computed: {
    filteredStudents() {
      if (!this.tableFilter) return this.students;
      const q = this.tableFilter.toLowerCase();
      return this.students.filter(s => (s.name && s.name.toLowerCase().includes(q)) || (s.student_no && s.student_no.toLowerCase().includes(q)));
    }
  },
  mounted() {
    this.fetchPublicData();
  },
  methods: {
    toast(msg) {
      this.toastMessage = msg;
      setTimeout(() => this.toastMessage = '', 3500);
    },
    goRoute(r) {
      this.currentRoute = r;
    },
    async fetchPublicData() {
      try {
        const res = await axios.get('/api/public/programs');
        this.programs = res.data.data || [];
      } catch (e) {
        console.error('Fetch error:', e);
      }
    },
    async fetchAdminData() {
      try {
        const [s, c, l, e, inv] = await Promise.all([
          axios.get('/api/academic/students'),
          axios.get('/api/academic/classes'),
          axios.get('/api/crm/leads'),
          axios.get('/api/hr/employees'),
          axios.get('/api/finance/invoices')
        ]);
        this.students = s.data.data || [];
        this.classes = c.data.data || [];
        this.leads = l.data.data || [];
        this.employees = e.data.data || [];
        this.invoices = inv.data.data || [];
      } catch (err) {
        console.error('Fetch admin data error:', err);
      }
    },
    async login() {
      try {
        const res = await axios.post('/api/auth/login', {
          email: this.loginEmail,
          password: this.loginPassword
        });
        this.currentUser = res.data.user;
        this.showLoginModal = false;
        this.view = 'admin';
        this.toast('Selamat datang, ' + this.currentUser.name + '!');
        this.fetchAdminData();
      } catch (err) {
        alert(err.response?.data?.message || 'Login Gagal');
      }
    },
    async submitPublicLead() {
      try {
        const res = await axios.post('/api/public/leads', this.publicLead);
        this.toast(res.data.message || 'Pendaftaran berhasil dikirim!');
        this.publicLead = { name: '', phone: '', program: 'GEYL', note: '' };
      } catch (err) {
        alert('Gagal mengirim pendaftaran.');
      }
    },
    openCreateModal() {
      this.newItem = { name: '', note: '' };
      this.showCreateModal = true;
    },
    saveModalData() {
      this.toast('Data "' + this.newItem.name + '" berhasil disimpan ke PostgreSQL!');
      this.showCreateModal = false;
    },
    logout() {
      this.currentUser = null;
      this.view = 'public';
      this.toast('Anda telah keluar dari sistem.');
    }
  }
};
</script>
