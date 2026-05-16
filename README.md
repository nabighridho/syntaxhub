# 🚀 Syntax Hub (Web Learning Hub)

Syntax Hub adalah platform edukasi interaktif modern (EdTech) yang dikembangkan untuk memudahkan pengguna dalam mempelajari pemrograman dan ekosistem terkait web. Melalui perpaduan materi pembelajaran yang terstruktur, *code playground*, koleksi *snippet*, serta sistem gamifikasi (*badge & progress*), platform ini ditujukan untuk menjadi ekosistem belajar yang komprehensif bagi developer dari berbagai tingkatan.

Platform ini dibangun di atas pondasi *monolith* modern yang memanfaatkan integrasi mulus antara backend dan frontend:
- **Backend:** Laravel 11 (PHP)
- **Frontend Utama:** React 18 & Inertia.js (menghubungkan Laravel & React tanpa REST API terpisah)
- **Styling:** Tailwind CSS (dikustomisasi penuh untuk *glassmorphism* dan *dark mode* premium)
- **Animasi:** Framer Motion (untuk transisi halaman, efek kartu, indikator kustom)
- **Fitur Interaktif:** CodeMirror 6 (menjadi mesin utama di balik *Code Playground*) & Recharts (untuk visualisasi data progres)

---

## 📌 Fitur Ekosistem Utama

1. **Autentikasi & Dashboard:** Sistem registrasi & login interaktif. Setelah masuk, *Dashboard* menampilkan ringkasan profil, modul yang sedang dipelajari, dan metrik pembelajaran.
2. **Modul Belajar (Tutorials):** Basis pengetahuan utama berbasis teori dan praktik.
3. **Interactive Code Playground:** Editor kode secara *real-time* dengan *syntax highlighting* di mana siswa dapat langsung menulis dan mengeksekusi kode (HTML/CSS/JS/Python) untuk membuktikan teori yang dibaca.
4. **Snippets Library:** Repositori kode-kode praktis dan fungsional yang bisa disimpan, ditinjau ulang, dan disalin pengguna.
5. **Sistem Progres & Gamifikasi:** 
   - *User Progress:* Perekaman otomatis sampai bagian modul mana siswa belajar.
   - *Badges:* Penghargaan (lencana digital) yang diberikan secara otomatis jika pengguna merampungkan *milestone* atau kondisi eksplorasi tertentu.
6. **Sistem Bookmark:** Fitur pendukung agar pengguna dapat menyimpan artikel (*Tutorial*) atau kumpulan *Snippet* untuk diakses dengan mudah tanpa harus mencarinya lagi.

---

## 🗺️ Diagram Sistem

Berikut adalah rancangan diagram sistem yang menopang arsitektur **Syntax Hub**, divisualisasikan menggunakan format Mermaid.

### 1. Flowchart Pengguna (User Journey Flow)
Menggambarkan alur interaksi logis dari pengguna saat pertama kali mengunjungi hingga menyelesaikan suatu modul dalam Syntax Hub.

```mermaid
graph TD
    Start([Kunjungi Syntax Hub]) --> Login{Sudah Login?}
    Login -- Belum --> Register[Halaman Auth] --> ProsesAuth[Daftar / Masuk] --> Dashboard[Dashboard Area]
    Login -- Sudah --> Dashboard
    
    Dashboard --> PilihAksi{Pilih Aktivitas}
    
    PilihAksi --> |Belajar Materi| Tutorials[Buka Menu Tutorial]
    Tutorials --> Baca[Membaca & Mempraktekkan]
    Baca --> UpdateProgress[Simpan Progres Otomatis]
    UpdateProgress --> KriteriaBadge{Selesai Modul?}
    KriteriaBadge -- Ya --> EarnBadge[Dapat Badge 🎉]
    KriteriaBadge -- Tidak --> Tutorials
    
    PilihAksi --> |Koding Bebas| Playground[Buka Code Playground]
    Playground --> UjiKode[Tes & Eksperimen Skrip]
    
    PilihAksi --> |Eksplorasi| Snippets[Buka Direktori Snippet]
    Snippets --> CopyCode[Pelajari & Salin Kode]
    
    Baca --> BookmarkNode[Klik Bookmark]
    Snippets --> BookmarkNode
    
    UpdateProgress --> End([Logout / Tinggalkan Web])
    EarnBadge --> End
    UjiKode --> End
    BookmarkNode --> End
```

### 2. Entity Relationship Diagram (ERD)
Struktur skema relasional tabel dalam *database* (berbasis migrasi Laravel) yang mengatur konten dan data pengguna.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        string password
        timestamp created_at
    }
    TUTORIALS {
        bigint id PK
        string title
        text content
        string slug
    }
    SNIPPETS {
        bigint id PK
        bigint user_id FK
        string title
        text code
        string language
    }
    USER_PROGRESS {
        bigint id PK
        bigint user_id FK
        bigint tutorial_id FK
        boolean is_completed
    }
    BADGES {
        bigint id PK
        string name
        string icon
    }
    USER_BADGES {
        bigint id PK
        bigint user_id FK
        bigint badge_id FK
    }
    BOOKMARKS {
        bigint id PK
        bigint user_id FK
        bigint bookmarkable_id "Polymorphic"
        string bookmarkable_type "Polymorphic"
    }

    USERS ||--o{ SNIPPETS : "membuat"
    USERS ||--o{ USER_PROGRESS : "memiliki"
    TUTORIALS ||--o{ USER_PROGRESS : "dicatat_ke"
    USERS ||--o{ USER_BADGES : "diperoleh"
    BADGES ||--o{ USER_BADGES : "diberikan_ke"
    USERS ||--o{ BOOKMARKS : "menyimpan"
```

### 3. Data Flow Diagram (DFD Level 0 / Context Diagram)
Representasi makro aliran data antara *Entitas Luar* dengan inti sistem *Syntax Hub*.

```mermaid
graph TD
    User((Pengguna / Siswa))
    System[Sistem Syntax Hub]
    Admin((Administrator))

    User -- "Registrasi, Login, Detail Profil" --> System
    User -- "Aksi Bookmark, Eksekusi Kode, Update Progress Belajar" --> System
    
    System -- "Konten Tutorial, Verifikasi Eksekusi Kode" --> User
    System -- "Grafik Progres Belajar, Badge Kelulusan" --> User
    
    Admin -- "Manajemen Konten (Tutorial, Badge)" --> System
    System -- "Laporan Sistem, Data Metrik User" --> Admin
```

---
*Dokumentasi ini telah diperbarui untuk mencerminkan rancangan ekosistem Web Learning Hub (Syntax Hub).*
