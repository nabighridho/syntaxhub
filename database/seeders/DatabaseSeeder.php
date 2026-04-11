<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Snippet;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create demo user
        $user = User::firstOrCreate(
            ['email' => 'nabigh@example.com'],
            ['name' => 'Nabigh Nailur Ridho', 'password' => Hash::make('password')]
        );

        // ===== TUTORIALS =====
        // Added lots of content up to Expert level with embedded Quizzes
        $tutorials = [
            // ========================
            // TKJ DEPARTMENT
            // ========================

            // BEGINNER
            [
                'title' => 'Fundamental Jaringan & Topologi',
                'description' => 'Pelajari arsitektur dasar jaringan komputer, model OSI, dan jenis-jenis topologi fisik maupun logis.',
                'content' => '<h2>Apa itu Jaringan Komputer?</h2><p>Jaringan komputer adalah sekumpulan komputer dan perangkat yang saling terhubung untuk berbagi informasi. Komunikasi didasarkan pada protokol standar seperti TCP/IP.</p><h3>Model OSI</h3><p>Model OSI (Open Systems Interconnection) memiliki 7 layer:</p><ul><li><strong>Layer 7 (Application)</strong>: HTTP, FTP, SMTP</li><li><strong>Layer 4 (Transport)</strong>: TCP, UDP</li><li><strong>Layer 3 (Network)</strong>: IP, ICMP, Perutean</li><li><strong>Layer 2 (Data Link)</strong>: MAC Address, Frame Ethernet</li><li><strong>Layer 1 (Physical)</strong>: Kabel, Sinyal Elektrik</li></ul>',
                'level' => 'beginner',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 20,
                'order' => 1,
                'icon' => 'globe',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi model OSI di bawah ini. Layer 3 adalah Network, Layer 4 adalah Transport.',
                    'code_template' => "Layer 2: {0} Link\nLayer 4: {1}\nLayer 7: {2}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'Data', '{1}' => 'Transport', '{2}' => 'Application']
                ])
            ],
            [
                'title' => 'IP Address & Subnetting Dasar',
                'description' => 'Memahami konsep IPv4, kelas jaringan, dan cara menghitung subnet mask sederhana.',
                'content' => '<h2>IPv4 dan Subnetting</h2><p>IP Address adalah identitas perangkat di jaringan. IPv4 terdiri dari 32-bit angka biner.</p><h3>Kelas IP</h3><ul><li><strong>Kelas A</strong>: 1.0.0.0 - 126.255.255.255 (Subnet default: 255.0.0.0)</li><li><strong>Kelas B</strong>: 128.0.0.0 - 191.255.255.255 (Subnet default: 255.255.0.0)</li><li><strong>Kelas C</strong>: 192.0.0.0 - 223.255.255.255 (Subnet default: 255.255.255.0)</li></ul><p>Prefix /24 merepresentasikan 255.255.255.0 dimana 24 bit pertama adalah Network ID.</p>',
                'level' => 'beginner',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 30,
                'order' => 2,
                'icon' => 'wifi',
                'quiz' => json_encode([
                    'instruction' => 'Isi prefix subnet berikut untuk subnet mask 255.255.255.0 dan 255.0.0.0',
                    'code_template' => "IP: 192.168.1.10 Mask: 255.255.255.0 Prefix: /{0}\nIP: 10.0.0.5 Mask: 255.0.0.0 Prefix: /{1}",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => '24', '{1}' => '8']
                ])
            ],
            [
                'title' => 'Navigasi CLI Cisco IOS',
                'description' => 'Panduan praktis bernavigasi menggunakan Command Line Interface (CLI) pada perangkat Cisco.',
                'content' => '<h2>Mode Eksekusi Cisco IOS</h2><p>Sistem operasi Cisco IOS berbasis mode. Anda harus berpindah ke mode dengan level yang tepat untuk melakukan aksi tertentu.</p><h3>Perintah Berpindah Mode</h3><ul><li><code>enable</code> : Dari User EXEC (&gt;) ke Privileged EXEC (#)</li><li><code>configure terminal</code> : Ke Global Configuration (config)#</li><li><code>interface [nama]</code> : Ke spesifik interface (config-if)#</li></ul>',
                'level' => 'beginner',
                'category' => 'router',
                'department' => 'tkj',
                'estimated_minutes' => 25,
                'order' => 3,
                'icon' => 'terminal',
                'quiz' => json_encode([
                    'instruction' => 'Tuliskan perintah yang benar untuk berpindah dari mode Privileged ke Global Configuration.',
                    'code_template' => "Router> {0}\nRouter# {1}\nRouter(config)#",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => 'enable', '{1}' => 'configure terminal']
                ])
            ],

            // INTERMEDIATE
            [
                'title' => 'Routing Statis Inter-Network',
                'description' => 'Mengkonfigurasi routing statis pada router agar jaringan berbeda dapat saling terhubung.',
                'content' => '<h2>Static Routing</h2><p>Routing statis berarti administrator memasukkan secara manual jalur ke tabel routing pada router.</p><h3>Format Perintah</h3><pre><code>ip route [network-tujuan] [subnet-mask] [next-hop-ip]</code></pre><p>Contoh: Untuk menuju jaringan 192.168.2.0/24 melalui router sebelah (10.0.0.2), perintahnya adalah <code>ip route 192.168.2.0 255.255.255.0 10.0.0.2</code>.</p>',
                'level' => 'intermediate',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 45,
                'order' => 4,
                'icon' => 'switch',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi perintah static routing berikut untuk menuju jaringan 172.16.5.0/24 via 192.168.1.1.',
                    'code_template' => "Router(config)# {0} 172.16.5.0 255.255.255.0 {1}",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => 'ip route', '{1}' => '192.168.1.1']
                ])
            ],
            [
                'title' => 'Konfigurasi VLAN & Inter-VLAN Routing',
                'description' => 'Membangun Virtual LAN pada Switch dan menghubungkannya via Router-on-a-stick.',
                'content' => '<h2>VLAN & Trunking</h2><p>VLAN memecah satu switch fisik menjadi beberapa broadcast domain logika.</p><h3>Trunk</h3><p>Port trunk mengangkut data dari banyak VLAN antar switch atau switch ke router. Pada port trunk, paket dilabeli (VLAN Tagging / 802.1q).</p><h3>Router on a Stick</h3><p>Metode menghubungkan router menggunakan satu antarmuka fisik yang dibuat menjadi sub-interface (contoh: Gig0/0.10).</p>',
                'level' => 'intermediate',
                'category' => 'switch',
                'department' => 'tkj',
                'estimated_minutes' => 50,
                'order' => 5,
                'icon' => 'status',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi konfigurasi Access Port untuk VLAN 10 dan Trunk Port berikut.',
                    'code_template' => "Switch(config-if)# switchport mode {0}\nSwitch(config-if)# switchport access vlan 10\n\nSwitch(config-if)# switchport mode {1}",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => 'access', '{1}' => 'trunk']
                ])
            ],
            [
                'title' => 'Routing OSPF Single-Area',
                'description' => 'Mengaplikasikan routing dinamis menggunakan protokol OSPF Link-State.',
                'content' => '<h2>OSPF (Open Shortest Path First)</h2><p>Berbeda dengan Routing Statis, OSPF menemukan rute terbaik secara dinamis. Router membentuk "adjacencies" dengan router yang berdekatan untuk saling bertukar LSDB (Link State Database).</p><h3>Konfigurasi Dasar</h3><pre><code>router ospf [process-id]\nnetwork [network-ip] [wildcard-mask] area [area-id]</code></pre><p>Wildcard mask adalah kebalikan dari subnet mask (contoh: 0.0.0.255). Semua network dikelompokkan dalam Area 0 (Backbone).</p>',
                'level' => 'intermediate',
                'category' => 'router',
                'department' => 'tkj',
                'estimated_minutes' => 60,
                'order' => 6,
                'icon' => 'map',
                'quiz' => json_encode([
                    'instruction' => 'Aktifkan OSPF proses 10, dan masukkan network 192.168.1.0/24 ke Area 0. Ingat, wildcard dari /24 adalah 0.0.0.255',
                    'code_template' => "Router(config)# router ospf {0}\nRouter(config-router)# network 192.168.1.0 {1} area {2}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => '10', '{1}' => '0.0.0.255', '{2}' => '0']
                ])
            ],

            // ADVANCED / EXPERT
            [
                'title' => 'BGP (Border Gateway Protocol)',
                'description' => 'Expert Level: Menghubungkan jaringan antar benua dan Autonomous System besar menggunakan BGP.',
                'content' => '<h2>Protokol Inti Internet</h2><p>BGP adalah protokol Vector Jalur (Path Vector Protocol). Daripada hanya mencari jarak, BGP memanfaatkan atribut rute (AS_PATH, LOCAL_PREF, MED) untuk menentukan path keluar.</p><h3>Konfigurasi eBGP</h3><p>eBGP (External BGP) digunakan antara sistem otonom yang berbeda (Contoh: AS 100 dan AS 200). Kita harus mendefinisikan neighbor secara manual.</p><pre><code>router bgp 100\nneighbor 10.0.0.2 remote-as 200\nnetwork 192.168.1.0 mask 255.255.255.0</code></pre>',
                'level' => 'advanced',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 90,
                'order' => 7,
                'icon' => 'globe-alt',
                'quiz' => json_encode([
                    'instruction' => 'Konfigurasikan sesi BGP untuk router di AS 500, dengan tetangga (neighbor) IP 1.1.1.2 di AS 600.',
                    'code_template' => "Router(config)# router {0} 500\nRouter(config-router)# {1} 1.1.1.2 remote-as {2}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'bgp', '{1}' => 'neighbor', '{2}' => '600']
                ])
            ],
            [
                'title' => 'Linux Netfilter & Iptables',
                'description' => 'Expert Level: Manajemen Firewall level kernel menggunakan Iptables di env Linux.',
                'content' => '<h2>Netfilter & Iptables</h2><p>Dalam DevOps & NetOps, pengamanan level server sangat kritikal. Iptables memungkinkan kita memfilter trafik berdasarkan rantai (INPUT, OUTPUT, FORWARD).</p><h3>Melakukan Drop & Accept</h3><p>Mendrop semua ping (ICMP) yang masuk:</p><pre><code>iptables -A INPUT -p icmp -j DROP</code></pre><p>Mengizinkan SSH masuk:</p><pre><code>iptables -A INPUT -p tcp --dport 22 -j ACCEPT</code></pre>',
                'level' => 'advanced',
                'category' => 'scripting',
                'department' => 'tkj',
                'estimated_minutes' => 75,
                'order' => 8,
                'icon' => 'shield',
                'quiz' => json_encode([
                    'instruction' => 'Buat rule iptables untuk APPEND rantai INPUT agar DROP trafik ke port 80 (HTTP) berprotokol tcp.',
                    'code_template' => "iptables -A {0} -p {1} --dport {2} -j {3}",
                    'blanks' => ['{0}', '{1}', '{2}', '{3}'],
                    'answers' => ['{0}' => 'INPUT', '{1}' => 'tcp', '{2}' => '80', '{3}' => 'DROP']
                ])
            ],
            [
                'title' => 'Python Netmiko Automation',
                'description' => 'Expert Level: Otomatisasi konfigurasi masif infrastruktur jaringan menggunakan Python Netmiko.',
                'content' => '<h2>Infrastructure as Code</h2><p>Di era modern, engineer tidak lagi masuk ke router satu per satu. Netmiko (Network Paramiko) memudahkan otomatisasi via SSH.</p><h3>Contoh Script Koneksi</h3><pre><code>from netmiko import ConnectHandler\ndevice = {\n   "device_type": "cisco_ios",\n   "host": "192.168.1.1",\n   "username": "admin",\n   "password": "password"\n}\nnet_connect = ConnectHandler(**device)\noutput = net_connect.send_command("show ip int brief")\nprint(output)</code></pre>',
                'level' => 'advanced',
                'category' => 'scripting',
                'department' => 'tkj',
                'estimated_minutes' => 120,
                'order' => 9,
                'icon' => 'terminal',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi script Netmiko di Python untuk mengirimkan perintah "show version".',
                    'code_template' => "from {0} import ConnectHandler\n\nnet_connect = ConnectHandler(**device)\noutput = net_connect.{1}('show version')\nprint(output)",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => 'netmiko', '{1}' => 'send_command']
                ])
            ],

            // ========================
            // RPL DEPARTMENT
            // ========================

            // --- HTML & CSS ---
            [
                'title' => 'Dasar HTML: Struktur & Elemen',
                'description' => 'Pelajari struktur dasar halaman web, elemen HTML semantik, heading, paragraf, list, dan link.',
                'content' => '<h2>Struktur Dasar HTML</h2><p>HTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. Setiap dokumen HTML memiliki struktur dasar:</p><pre><code>&lt;!DOCTYPE html&gt;\n&lt;html lang="id"&gt;\n&lt;head&gt;\n    &lt;meta charset="UTF-8"&gt;\n    &lt;title&gt;Halaman Pertama&lt;/title&gt;\n&lt;/head&gt;\n&lt;body&gt;\n    &lt;h1&gt;Halo Dunia!&lt;/h1&gt;\n    &lt;p&gt;Ini paragraf pertama saya.&lt;/p&gt;\n&lt;/body&gt;\n&lt;/html&gt;</code></pre><h3>Elemen Semantik HTML5</h3><ul><li><code>&lt;header&gt;</code> — Bagian atas halaman</li><li><code>&lt;nav&gt;</code> — Navigasi</li><li><code>&lt;main&gt;</code> — Konten utama</li><li><code>&lt;section&gt;</code> — Bagian konten</li><li><code>&lt;footer&gt;</code> — Bagian bawah halaman</li></ul>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 101,
                'icon' => 'code',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi struktur dasar HTML berikut.',
                    'code_template' => "<!{0} html>\n<html>\n<{1}>\n    <title>Web Pertama</title>\n</{1}>\n<{2}>\n    <h1>Halo!</h1>\n</{2}>\n</html>",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'DOCTYPE', '{1}' => 'head', '{2}' => 'body']
                ])
            ],
            [
                'title' => 'CSS Dasar: Selector & Properti',
                'description' => 'Memahami selector CSS, properti styling, box model, dan cara menghubungkan CSS ke HTML.',
                'content' => '<h2>Apa itu CSS?</h2><p>CSS (Cascading Style Sheets) digunakan untuk mengatur tampilan elemen HTML. Ada 3 cara menautkan CSS:</p><ul><li><strong>Inline</strong>: langsung di atribut style</li><li><strong>Internal</strong>: di tag &lt;style&gt; dalam &lt;head&gt;</li><li><strong>External</strong>: file .css terpisah</li></ul><h3>Selector Dasar</h3><pre><code>/* Element Selector */\nh1 { color: blue; }\n\n/* Class Selector */\n.container { max-width: 960px; margin: 0 auto; }\n\n/* ID Selector */\n#header { background-color: #333; }</code></pre><h3>Box Model</h3><p>Setiap elemen HTML terdiri dari: Content → Padding → Border → Margin</p>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 102,
                'icon' => 'color-swatch',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi CSS selector dan properti berikut.',
                    'code_template' => "/* Selector class */\n{0}judul {\n    color: red;\n}\n\n/* Selector id */\n{1}konten {\n    background-color: white;\n}",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => '.', '{1}' => '#']
                ])
            ],
            [
                'title' => 'Responsive Design & Flexbox',
                'description' => 'Membuat layout halaman web responsif menggunakan CSS Flexbox dan Media Queries.',
                'content' => '<h2>Flexbox Layout</h2><p>Flexbox adalah metode layout CSS yang memudahkan pengaturan elemen secara horizontal atau vertikal.</p><pre><code>.container {\n    display: flex;\n    justify-content: center;\n    align-items: center;\n    gap: 16px;\n}\n\n.item {\n    flex: 1;\n}</code></pre><h3>Media Queries</h3><p>Untuk membuat halaman responsif di berbagai ukuran layar:</p><pre><code>@media (max-width: 768px) {\n    .container {\n        flex-direction: column;\n    }\n}</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 35,
                'order' => 103,
                'icon' => 'device-mobile',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi properti Flexbox berikut agar elemen tersusun di tengah secara horizontal dan vertikal.',
                    'code_template' => ".container {\n    display: {0};\n    justify-content: {1};\n    align-items: {2};\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'flex', '{1}' => 'center', '{2}' => 'center']
                ])
            ],

            // --- JavaScript ---
            [
                'title' => 'JavaScript Dasar: Variabel & Tipe Data',
                'description' => 'Fondasi pemrograman JavaScript: variabel, tipe data, operator, dan percabangan.',
                'content' => '<h2>Variabel di JavaScript</h2><p>JavaScript memiliki 3 cara mendeklarasikan variabel:</p><pre><code>var nama = "Budi";     // cara lama (hindari)\nlet umur = 17;         // bisa diubah nilainya\nconst PI = 3.14;       // tidak bisa diubah</code></pre><h3>Tipe Data</h3><ul><li><strong>String</strong>: "Hello", \'World\'</li><li><strong>Number</strong>: 42, 3.14</li><li><strong>Boolean</strong>: true, false</li><li><strong>Array</strong>: [1, 2, 3]</li><li><strong>Object</strong>: { nama: "Budi", umur: 17 }</li></ul><h3>Percabangan</h3><pre><code>if (umur >= 17) {\n    console.log("Boleh buat SIM");\n} else {\n    console.log("Belum cukup umur");\n}</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 104,
                'icon' => 'lightning',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi deklarasi variabel JavaScript berikut. Gunakan keyword yang tepat.',
                    'code_template' => "// Variabel yang nilainya bisa berubah\n{0} nama = \"Budi\";\n\n// Variabel konstan\n{1} MAX_SCORE = 100;\n\n// Menampilkan ke console\nconsole.{2}(nama);",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'let', '{1}' => 'const', '{2}' => 'log']
                ])
            ],
            [
                'title' => 'JavaScript: Fungsi & Array Methods',
                'description' => 'Menguasai fungsi, arrow function, dan metode array modern seperti map, filter, dan reduce.',
                'content' => '<h2>Fungsi di JavaScript</h2><pre><code>// Function Declaration\nfunction sapa(nama) {\n    return "Halo, " + nama;\n}\n\n// Arrow Function (ES6)\nconst sapa = (nama) => `Halo, ${nama}`;</code></pre><h3>Array Methods</h3><pre><code>const angka = [1, 2, 3, 4, 5];\n\n// Filter: ambil angka genap\nconst genap = angka.filter(n => n % 2 === 0);\n// [2, 4]\n\n// Map: kalikan 2\nconst kali2 = angka.map(n => n * 2);\n// [2, 4, 6, 8, 10]\n\n// Reduce: jumlahkan semua\nconst total = angka.reduce((acc, n) => acc + n, 0);\n// 15</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 40,
                'order' => 105,
                'icon' => 'cog',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode array methods berikut.',
                    'code_template' => "const nilai = [80, 65, 90, 55, 75];\n\n// Ambil nilai di atas 70\nconst lulus = nilai.{0}(n => n > 70);\n\n// Kalikan semua nilai dengan 1.1\nconst bonus = nilai.{1}(n => n * 1.1);",
                    'blanks' => ['{0}', '{1}'],
                    'answers' => ['{0}' => 'filter', '{1}' => 'map']
                ])
            ],
            [
                'title' => 'DOM Manipulation & Event Handling',
                'description' => 'Memanipulasi elemen HTML menggunakan JavaScript DOM API dan menangani event pengguna.',
                'content' => '<h2>DOM (Document Object Model)</h2><p>DOM memungkinkan JavaScript mengakses dan memanipulasi elemen HTML secara dinamis.</p><pre><code>// Mengambil elemen\nconst judul = document.getElementById("judul");\nconst items = document.querySelectorAll(".item");\n\n// Mengubah konten\njudul.textContent = "Judul Baru";\njudul.style.color = "blue";\n\n// Menambah elemen baru\nconst p = document.createElement("p");\np.textContent = "Paragraf baru";\ndocument.body.appendChild(p);</code></pre><h3>Event Listener</h3><pre><code>const tombol = document.getElementById("btn");\ntombol.addEventListener("click", function() {\n    alert("Tombol diklik!");\n});</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 106,
                'icon' => 'cursor',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode DOM manipulation berikut.',
                    'code_template' => "// Ambil elemen berdasarkan ID\nconst judul = document.{0}(\"judul\");\n\n// Ubah teks\njudul.{1} = \"Selamat Datang\";\n\n// Tambah event listener klik\njudul.{2}(\"click\", function() {\n    alert(\"Diklik!\");\n});",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'getElementById', '{1}' => 'textContent', '{2}' => 'addEventListener']
                ])
            ],

            // --- Python ---
            [
                'title' => 'Python Dasar: Sintaks & Struktur Data',
                'description' => 'Fondasi pemrograman Python: variabel, tipe data, list, dictionary, dan kontrol alur.',
                'content' => '<h2>Mengapa Python?</h2><p>Python adalah bahasa pemrograman yang mudah dipelajari dengan sintaks yang bersih dan banyak digunakan di dunia industri maupun pendidikan.</p><h3>Variabel & Tipe Data</h3><pre><code>nama = "Budi"          # string\numur = 17               # integer\ntinggi = 170.5          # float\naktif = True            # boolean\n\n# List (Array)\nnilai = [80, 90, 75, 85]\n\n# Dictionary (Object)\nsiswa = {\n    "nama": "Budi",\n    "kelas": "XII RPL"\n}</code></pre><h3>Percabangan</h3><pre><code>if umur >= 17:\n    print("Dewasa")\nelif umur >= 12:\n    print("Remaja")\nelse:\n    print("Anak-anak")</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 107,
                'icon' => 'beaker',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode Python berikut.',
                    'code_template' => "# Membuat list\nnilai = [80, 90, 75]\n\n# Menambah elemen ke list\nnilai.{0}(85)\n\n# Percabangan\nif nilai[0] >= 75:\n    {1}(\"Lulus\")\n{2}:\n    print(\"Tidak Lulus\")",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'append', '{1}' => 'print', '{2}' => 'else']
                ])
            ],
            [
                'title' => 'Python: Fungsi & Modul',
                'description' => 'Membuat fungsi reusable, menggunakan parameter, return value, dan mengimpor modul.',
                'content' => '<h2>Fungsi di Python</h2><pre><code>def hitung_luas(panjang, lebar):\n    """Menghitung luas persegi panjang"""\n    return panjang * lebar\n\nluas = hitung_luas(10, 5)\nprint(f"Luas: {luas}")  # Luas: 50</code></pre><h3>Parameter Default & *args</h3><pre><code>def sapa(nama, sapaan="Halo"):\n    return f"{sapaan}, {nama}!"\n\ndef total(*angka):\n    return sum(angka)\n\nprint(total(1, 2, 3, 4))  # 10</code></pre><h3>Import Modul</h3><pre><code>import math\nprint(math.sqrt(144))  # 12.0\n\nfrom random import randint\nprint(randint(1, 100))</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 35,
                'order' => 108,
                'icon' => 'cube',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode fungsi Python berikut.',
                    'code_template' => "# Definisi fungsi\n{0} luas_segitiga(alas, tinggi):\n    {1} (alas * tinggi) / 2\n\n# Panggil fungsi\nhasil = luas_segitiga(10, 5)\n{2}(f\"Luas: {hasil}\")",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'def', '{1}' => 'return', '{2}' => 'print']
                ])
            ],
            [
                'title' => 'Python OOP: Class & Inheritance',
                'description' => 'Pemrograman berorientasi objek di Python: class, constructor, inheritance, dan encapsulation.',
                'content' => '<h2>Class di Python</h2><pre><code>class Siswa:\n    def __init__(self, nama, kelas):\n        self.nama = nama\n        self.kelas = kelas\n    \n    def perkenalan(self):\n        return f"Nama saya {self.nama} dari kelas {self.kelas}"\n\nbudi = Siswa("Budi", "XII RPL")\nprint(budi.perkenalan())</code></pre><h3>Inheritance</h3><pre><code>class KetuaKelas(Siswa):\n    def __init__(self, nama, kelas, jabatan):\n        super().__init__(nama, kelas)\n        self.jabatan = jabatan\n\n    def info(self):\n        return f"{self.perkenalan()}, jabatan: {self.jabatan}"</code></pre>',
                'level' => 'advanced',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 50,
                'order' => 109,
                'icon' => 'puzzle',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode OOP Python berikut.',
                    'code_template' => "{0} Hewan:\n    def {1}(self, nama, jenis):\n        self.nama = nama\n        self.jenis = jenis\n\n    def suara(self):\n        return f\"{self.nama} bersuara!\"\n\nkucing = Hewan(\"Kitty\", \"Kucing\")\nprint(kucing.{2}())",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'class', '{1}' => '__init__', '{2}' => 'suara']
                ])
            ],

            // --- Java ---
            [
                'title' => 'Java Dasar: Sintaks & OOP Fundamentals',
                'description' => 'Memahami struktur program Java, tipe data, class, dan method dasar.',
                'content' => '<h2>Program Java Pertama</h2><p>Java adalah bahasa pemrograman berorientasi objek yang bersifat "Write Once, Run Anywhere".</p><pre><code>public class HelloWorld {\n    public static void main(String[] args) {\n        String nama = "Budi";\n        int umur = 17;\n        \n        System.out.println("Halo, " + nama);\n        System.out.println("Umur: " + umur);\n    }\n}</code></pre><h3>Tipe Data Primitif</h3><ul><li><code>int</code> — bilangan bulat</li><li><code>double</code> — bilangan desimal</li><li><code>boolean</code> — true/false</li><li><code>char</code> — karakter tunggal</li><li><code>String</code> — teks (bukan primitif, tapi class)</li></ul>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 30,
                'order' => 110,
                'icon' => 'chip',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi program Java berikut agar bisa menampilkan output.',
                    'code_template' => "public {0} Main {\n    public static void {1}(String[] args) {\n        String pesan = \"Hello RPL!\";\n        System.out.{2}(pesan);\n    }\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'class', '{1}' => 'main', '{2}' => 'println']
                ])
            ],
            [
                'title' => 'Java: Class, Constructor & Encapsulation',
                'description' => 'Mendalami OOP di Java: membuat class, constructor, getter/setter, dan access modifier.',
                'content' => '<h2>Class & Object</h2><pre><code>public class Siswa {\n    private String nama;\n    private int nilai;\n\n    // Constructor\n    public Siswa(String nama, int nilai) {\n        this.nama = nama;\n        this.nilai = nilai;\n    }\n\n    // Getter\n    public String getNama() {\n        return nama;\n    }\n\n    // Setter\n    public void setNilai(int nilai) {\n        this.nilai = nilai;\n    }\n\n    public String info() {\n        return nama + " - Nilai: " + nilai;\n    }\n}</code></pre><h3>Membuat Object</h3><pre><code>Siswa s = new Siswa("Budi", 90);\nSystem.out.println(s.info());</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 111,
                'icon' => 'key',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi class Java dengan encapsulation berikut.',
                    'code_template' => "public class Mobil {\n    {0} String merk;\n\n    public Mobil(String merk) {\n        {1}.merk = merk;\n    }\n\n    public String getMerk() {\n        {2} merk;\n    }\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'private', '{1}' => 'this', '{2}' => 'return']
                ])
            ],
            [
                'title' => 'Java: Inheritance & Polymorphism',
                'description' => 'Konsep pewarisan dan polimorfisme di Java: extends, super, override, dan interface.',
                'content' => '<h2>Inheritance</h2><pre><code>public class Hewan {\n    protected String nama;\n    \n    public Hewan(String nama) {\n        this.nama = nama;\n    }\n    \n    public String suara() {\n        return "...";\n    }\n}\n\npublic class Kucing extends Hewan {\n    public Kucing(String nama) {\n        super(nama);\n    }\n    \n    @Override\n    public String suara() {\n        return "Meow!";\n    }\n}</code></pre><h3>Interface</h3><pre><code>public interface Drawable {\n    void draw();\n}\n\npublic class Circle implements Drawable {\n    @Override\n    public void draw() {\n        System.out.println("Drawing circle");\n    }\n}</code></pre>',
                'level' => 'advanced',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 55,
                'order' => 112,
                'icon' => 'fingerprint',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode inheritance Java berikut.',
                    'code_template' => "public class Kucing {0} Hewan {\n    public Kucing(String nama) {\n        {1}(nama);\n    }\n\n    @{2}\n    public String suara() {\n        return \"Meow!\";\n    }\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'extends', '{1}' => 'super', '{2}' => 'Override']
                ])
            ],

            // --- PHP ---
            [
                'title' => 'PHP Dasar: Sintaks & Variabel',
                'description' => 'Fondasi pemrograman PHP: variabel, echo, tipe data, dan operasi dasar untuk pengembangan web.',
                'content' => '<h2>PHP untuk Web</h2><p>PHP (Hypertext Preprocessor) adalah bahasa server-side yang sangat populer untuk web development.</p><pre><code>&lt;?php\n// Variabel diawali dengan $\n$nama = "Budi";\n$umur = 17;\n$aktif = true;\n\n// Menampilkan output\necho "Nama: " . $nama;\necho "Umur: $umur";  // interpolasi string\n\n// Array\n$buah = ["Apel", "Mangga", "Jeruk"];\necho $buah[0];  // Apel\n\n// Associative Array\n$siswa = [\n    "nama" => "Budi",\n    "kelas" => "XII RPL"\n];\necho $siswa["nama"];\n?&gt;</code></pre>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 113,
                'icon' => 'server',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode PHP berikut.',
                    'code_template' => "<?php\n// Deklarasi variabel\n{0}nama = \"Budi\";\n\n// Menampilkan output\n{1} \"Halo, \" . {0}nama;\n\n// Array\n{0}buah = [\"Apel\", \"Mangga\"];\necho {0}buah[{2}];\n?>",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => '$', '{1}' => 'echo', '{2}' => '0']
                ])
            ],
            [
                'title' => 'PHP: Form Handling & Database MySQL',
                'description' => 'Memproses data form HTML dengan PHP dan melakukan operasi CRUD ke database MySQL.',
                'content' => '<h2>Mengambil Data Form</h2><pre><code>// form.html\n&lt;form method="POST" action="proses.php"&gt;\n    &lt;input type="text" name="nama"&gt;\n    &lt;button type="submit"&gt;Kirim&lt;/button&gt;\n&lt;/form&gt;\n\n// proses.php\n&lt;?php\n$nama = $_POST["nama"];\necho "Halo, $nama";\n?&gt;</code></pre><h3>Koneksi MySQL (PDO)</h3><pre><code>&lt;?php\n$pdo = new PDO("mysql:host=localhost;dbname=sekolah", "root", "");\n\n// SELECT\n$stmt = $pdo->query("SELECT * FROM siswa");\n$hasil = $stmt->fetchAll();\n\n// INSERT\n$stmt = $pdo->prepare("INSERT INTO siswa (nama, kelas) VALUES (?, ?)");\n$stmt->execute(["Budi", "XII RPL"]);\n?&gt;</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 50,
                'order' => 114,
                'icon' => 'database',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode PHP untuk mengambil data form dan query database.',
                    'code_template' => "<?php\n// Mengambil data dari form POST\n\$nama = \$_{0}[\"nama\"];\n\n// Koneksi database\n\$pdo = new {1}(\"mysql:host=localhost;dbname=sekolah\", \"root\", \"\");\n\n// Query SELECT\n\$stmt = \$pdo->{2}(\"SELECT * FROM siswa\");\n?>",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'POST', '{1}' => 'PDO', '{2}' => 'query']
                ])
            ],

            // --- C++ ---
            [
                'title' => 'C++ Dasar: Sintaks & Kontrol Program',
                'description' => 'Fondasi pemrograman C++: input/output, variabel, perulangan, dan percabangan.',
                'content' => '<h2>Program C++ Pertama</h2><pre><code>#include &lt;iostream&gt;\nusing namespace std;\n\nint main() {\n    string nama;\n    int umur;\n\n    cout &lt;&lt; "Masukkan nama: ";\n    cin &gt;&gt; nama;\n    cout &lt;&lt; "Masukkan umur: ";\n    cin &gt;&gt; umur;\n\n    if (umur >= 17) {\n        cout &lt;&lt; nama &lt;&lt; " sudah dewasa" &lt;&lt; endl;\n    } else {\n        cout &lt;&lt; nama &lt;&lt; " masih pelajar" &lt;&lt; endl;\n    }\n\n    // Perulangan\n    for (int i = 1; i <= 5; i++) {\n        cout &lt;&lt; "Iterasi ke-" &lt;&lt; i &lt;&lt; endl;\n    }\n\n    return 0;\n}</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 115,
                'icon' => 'template',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi program C++ berikut.',
                    'code_template' => "#include <{0}>\nusing namespace std;\n\nint {1}() {\n    string nama = \"RPL\";\n    {2} << \"Halo \" << nama << endl;\n    return 0;\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'iostream', '{1}' => 'main', '{2}' => 'cout']
                ])
            ],
            [
                'title' => 'C++: Array, Pointer & Fungsi',
                'description' => 'Mendalami array, pointer, dan fungsi di C++ untuk manajemen memori dan modularisasi kode.',
                'content' => '<h2>Array di C++</h2><pre><code>int nilai[5] = {80, 90, 75, 85, 95};\n\nfor (int i = 0; i < 5; i++) {\n    cout << "Nilai ke-" << i << ": " << nilai[i] << endl;\n}</code></pre><h3>Pointer</h3><pre><code>int x = 10;\nint *ptr = &x;  // ptr menyimpan alamat x\n\ncout << "Nilai x: " << x << endl;        // 10\ncout << "Alamat x: " << &x << endl;     // 0x...\ncout << "Isi ptr: " << *ptr << endl;     // 10</code></pre><h3>Fungsi</h3><pre><code>int luasPersegiPanjang(int p, int l) {\n    return p * l;\n}\n\nint hasil = luasPersegiPanjang(10, 5);\ncout << "Luas: " << hasil << endl;</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 116,
                'icon' => 'variable',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode pointer dan fungsi C++ berikut.',
                    'code_template' => "int x = 42;\nint {0}ptr = {1}x;  // pointer ke x\n\ncout << *ptr << endl;  // output: 42\n\n// Fungsi\nint tambah(int a, int b) {\n    {2} a + b;\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => '*', '{1}' => '&', '{2}' => 'return']
                ])
            ],

            // --- SQL / Database ---
            [
                'title' => 'SQL Dasar: Query & Manipulasi Data',
                'description' => 'Fondasi database: CREATE TABLE, INSERT, SELECT, UPDATE, DELETE, dan WHERE clause.',
                'content' => '<h2>Structured Query Language</h2><p>SQL adalah bahasa standar untuk mengelola database relasional.</p><h3>DDL (Data Definition Language)</h3><pre><code>CREATE TABLE siswa (\n    id INT PRIMARY KEY AUTO_INCREMENT,\n    nama VARCHAR(100) NOT NULL,\n    kelas VARCHAR(10),\n    nilai INT DEFAULT 0\n);</code></pre><h3>DML (Data Manipulation Language)</h3><pre><code>-- Insert data\nINSERT INTO siswa (nama, kelas, nilai)\nVALUES (\'Budi\', \'XII RPL\', 85);\n\n-- Select data\nSELECT * FROM siswa WHERE nilai >= 75;\n\n-- Update data\nUPDATE siswa SET nilai = 90 WHERE nama = \'Budi\';\n\n-- Delete data\nDELETE FROM siswa WHERE id = 1;</code></pre>',
                'level' => 'beginner',
                'category' => 'database',
                'department' => 'rpl',
                'estimated_minutes' => 30,
                'order' => 117,
                'icon' => 'collection',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi query SQL berikut.',
                    'code_template' => "-- Membuat tabel\n{0} TABLE produk (\n    id INT PRIMARY KEY,\n    nama VARCHAR(100)\n);\n\n-- Memasukkan data\n{1} INTO produk (id, nama)\nVALUES (1, 'Laptop');\n\n-- Mengambil data\n{2} * FROM produk;",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'CREATE', '{1}' => 'INSERT', '{2}' => 'SELECT']
                ])
            ],
            [
                'title' => 'SQL Lanjutan: JOIN, GROUP BY & Subquery',
                'description' => 'Menguasai relasi antar tabel, agregasi data, dan subquery untuk analisis data kompleks.',
                'content' => '<h2>JOIN — Menggabungkan Tabel</h2><pre><code>-- INNER JOIN\nSELECT siswa.nama, kelas.nama_kelas\nFROM siswa\nINNER JOIN kelas ON siswa.kelas_id = kelas.id;\n\n-- LEFT JOIN (semua data dari tabel kiri)\nSELECT siswa.nama, nilai.skor\nFROM siswa\nLEFT JOIN nilai ON siswa.id = nilai.siswa_id;</code></pre><h3>GROUP BY & Aggregate</h3><pre><code>SELECT kelas, COUNT(*) as jumlah, AVG(nilai) as rata_rata\nFROM siswa\nGROUP BY kelas\nHAVING AVG(nilai) >= 75;</code></pre><h3>Subquery</h3><pre><code>SELECT nama FROM siswa\nWHERE nilai > (SELECT AVG(nilai) FROM siswa);</code></pre>',
                'level' => 'intermediate',
                'category' => 'database',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 118,
                'icon' => 'link',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi query JOIN dan GROUP BY berikut.',
                    'code_template' => "SELECT siswa.nama, kelas.nama_kelas\nFROM siswa\n{0} JOIN kelas ON siswa.kelas_id = kelas.id;\n\nSELECT kelas, {1}(*) as jumlah\nFROM siswa\n{2} BY kelas;",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'INNER', '{1}' => 'COUNT', '{2}' => 'GROUP']
                ])
            ],

            // --- Async JS / API ---
            [
                'title' => 'JavaScript Async: Fetch API & Promise',
                'description' => 'Expert Level: Mengonsumsi REST API menggunakan fetch, async/await, dan menangani error.',
                'content' => '<h2>Fetch API</h2><p>Fetch API memungkinkan kita mengambil data dari server secara asynchronous.</p><pre><code>// Menggunakan .then()\nfetch("https://api.example.com/siswa")\n    .then(response => response.json())\n    .then(data => console.log(data))\n    .catch(error => console.error(error));\n\n// Menggunakan async/await\nasync function getSiswa() {\n    try {\n        const response = await fetch("https://api.example.com/siswa");\n        const data = await response.json();\n        console.log(data);\n    } catch (error) {\n        console.error("Error:", error);\n    }\n}</code></pre><h3>POST Request</h3><pre><code>async function tambahSiswa(nama) {\n    const response = await fetch("/api/siswa", {\n        method: "POST",\n        headers: { "Content-Type": "application/json" },\n        body: JSON.stringify({ nama })\n    });\n    return response.json();\n}</code></pre>',
                'level' => 'advanced',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 60,
                'order' => 119,
                'icon' => 'refresh',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi kode async/await dan fetch berikut.',
                    'code_template' => "{0} function getData() {\n    try {\n        const response = {1} fetch(\"/api/data\");\n        const data = {1} response.json();\n        console.log(data);\n    } {2} (error) {\n        console.error(error);\n    }\n}",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'async', '{1}' => 'await', '{2}' => 'catch']
                ])
            ],

            // --- Git / Version Control ---
            [
                'title' => 'Git & Version Control',
                'description' => 'Menguasai Git untuk kolaborasi tim: init, commit, branch, merge, dan push ke GitHub.',
                'content' => '<h2>Mengapa Git?</h2><p>Git adalah version control system yang wajib dikuasai setiap programmer. Git melacak setiap perubahan kode sehingga kita bisa berkolaborasi dan rollback jika ada kesalahan.</p><h3>Perintah Dasar</h3><pre><code># Inisialisasi repository\ngit init\n\n# Menambahkan file ke staging\ngit add .\n\n# Commit perubahan\ngit commit -m "Initial commit"\n\n# Membuat branch baru\ngit branch fitur-login\ngit checkout fitur-login\n\n# Merge branch\ngit checkout main\ngit merge fitur-login\n\n# Push ke GitHub\ngit remote add origin https://github.com/user/repo.git\ngit push -u origin main</code></pre>',
                'level' => 'beginner',
                'category' => 'tools',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 120,
                'icon' => 'pencil',
                'quiz' => json_encode([
                    'instruction' => 'Lengkapi perintah Git berikut.',
                    'code_template' => "# Inisialisasi repo\ngit {0}\n\n# Tambahkan semua file\ngit {1} .\n\n# Commit\ngit {2} -m \"First commit\"",
                    'blanks' => ['{0}', '{1}', '{2}'],
                    'answers' => ['{0}' => 'init', '{1}' => 'add', '{2}' => 'commit']
                ])
            ],
        ];

        // Ensure clean slate for tutorials to avoid logic conflict on fresh seed
        DB::table('tutorials')->delete();

        foreach ($tutorials as $tutorial) {
            Tutorial::create($tutorial);
        }

        // ===== SNIPPETS =====
        DB::table('snippets')->delete();

        $snippets = [
            // TKJ Snippets
            [
                'title' => 'Standard Cisco ACL (Access Control List)',
                'code' => "Router(config)# access-list 10 permit 192.168.1.0 0.0.0.255\nRouter(config)# access-list 10 deny any\nRouter(config)# interface GigabitEthernet0/0\nRouter(config-if)# ip access-group 10 in",
                'language' => 'cli',
                'description' => 'Konfigurasi ACL standar untuk mengamankan jaringan dari subnet tertentu.',
                'annotations' => [
                    ['line' => 1, 'text' => 'Izinkan semua lalu lintas dari subnet 192.168.1.0/24'],
                    ['line' => 2, 'text' => 'Tolak selain dari IP yang disebutkan (Implicit Deny)'],
                    ['line' => 3, 'text' => 'Terapkan pada antarmuka Giga0/0'],
                    ['line' => 4, 'text' => 'Menerapkan daftar 10 pada lalu lintas inbound'],
                ],
                'category' => 'router',
            ],
            [
                'title' => 'Python Scapy Packet Crafter (Expert)',
                'code' => 'from scapy.all import *' . "\n\n" .
                    'ip_layer = IP(src="192.168.1.100", dst="192.168.1.1")' . "\n" .
                    'tcp_layer = TCP(sport=1024, dport=80, flags="S")' . "\n" .
                    'paket_syn = ip_layer / tcp_layer' . "\n\n" .
                    'response = sr1(paket_syn, timeout=2)' . "\n" .
                    'response.show()',
                'language' => 'python',
                'description' => 'Membuat dan mengirimkan injeksi paket TCP SYN kustom menggunakan librari Scapy.',
                'annotations' => [
                    ['line' => 3, 'text' => 'Mendefinisikan header IP dengan IP sumber dan tujuan palsu/spesifik.'],
                    ['line' => 4, 'text' => 'Membuat header lapisan Transport TCP untuk port 80 dengan SYN flag.'],
                    ['line' => 5, 'text' => 'Menumpuk layer menggunakan operator division (/) khas Scapy.'],
                    ['line' => 7, 'text' => 'Kirim 1 paket dan tunggu 1 response (sr1)'],
                ],
                'category' => 'scripting',
            ],
            [
                'title' => 'BGP Prefix Aggregation',
                'code' => "Router(config)# router bgp 65000\nRouter(config-router)# aggregate-address 10.0.0.0 255.0.0.0 summary-only\nRouter(config-router)# neighbor 172.16.1.2 remote-as 65001",
                'language' => 'cli',
                'description' => 'Meringkas banyak subnets menjadi satu supernet besar yang di-advertise ke ISP.',
                'annotations' => [
                    ['line' => 2, 'text' => 'Mengakumulasi semua rute kelas A menjadi satu notasi agregat guna menghemat memori router BGP di luar.'],
                ],
                'category' => 'router',
            ],
             [
                'title' => 'Docker Compose Network Bridge',
                'code' => "version: '3.8'\nservices:\n  web:\n    image: nginx:alpine\n    networks:\n      - dev_bridge\n\nnetworks:\n  dev_bridge:\n    driver: bridge\n    ipam:\n      config:\n        - subnet: 172.20.0.0/16",
                'language' => 'cli',
                'description' => 'Konfigurasi Subnet dan Network Driver Bridge kustom melalui Docker Compose.',
                'annotations' => [
                    ['line' => 8, 'text' => 'Mendefinisikan topologi jaringan pada Docker container.'],
                    ['line' => 11, 'text' => 'Konfigurasi IPAM (IP Address Management) untuk membatasi ruang alamat DHCP container docker lokal.'],
                ],
                'category' => 'scripting',
            ],

            // RPL Snippets
            [
                'title' => 'HTML5 Responsive Card Layout',
                'code' => "<!DOCTYPE html>\n<html lang=\"id\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Card Layout</title>\n    <style>\n        .cards {\n            display: grid;\n            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));\n            gap: 1rem;\n            padding: 1rem;\n        }\n        .card {\n            border: 1px solid #e2e8f0;\n            border-radius: 12px;\n            padding: 1.5rem;\n            transition: transform 0.2s, box-shadow 0.2s;\n        }\n        .card:hover {\n            transform: translateY(-4px);\n            box-shadow: 0 10px 25px rgba(0,0,0,0.1);\n        }\n    </style>\n</head>\n<body>\n    <div class=\"cards\">\n        <div class=\"card\">\n            <h3>Card 1</h3>\n            <p>Konten card pertama</p>\n        </div>\n    </div>\n</body>\n</html>",
                'language' => 'html',
                'description' => 'Layout card responsif menggunakan CSS Grid yang otomatis menyesuaikan jumlah kolom.',
                'annotations' => [
                    ['line' => 10, 'text' => 'CSS Grid auto-fill membuat kolom otomatis sesuai lebar layar.'],
                    ['line' => 19, 'text' => 'Transisi hover memberikan efek interaktif pada card.'],
                ],
                'category' => 'web',
            ],
            [
                'title' => 'JavaScript Array Destructuring & Spread',
                'code' => "// Destructuring\nconst siswa = { nama: 'Budi', kelas: 'XII', nilai: 90 };\nconst { nama, kelas, nilai } = siswa;\nconsole.log(nama); // 'Budi'\n\n// Array Destructuring\nconst [first, second, ...rest] = [1, 2, 3, 4, 5];\nconsole.log(rest); // [3, 4, 5]\n\n// Spread Operator\nconst arr1 = [1, 2, 3];\nconst arr2 = [4, 5, 6];\nconst gabung = [...arr1, ...arr2];\nconsole.log(gabung); // [1, 2, 3, 4, 5, 6]\n\n// Clone object\nconst siswaBaru = { ...siswa, nilai: 95 };\nconsole.log(siswaBaru.nilai); // 95",
                'language' => 'javascript',
                'description' => 'Teknik destructuring dan spread operator ES6+ untuk manipulasi data yang lebih bersih.',
                'annotations' => [
                    ['line' => 2, 'text' => 'Object destructuring mengekstrak properti ke variabel langsung.'],
                    ['line' => 7, 'text' => 'Rest operator (...) menangkap sisa elemen array.'],
                    ['line' => 13, 'text' => 'Spread operator menggabungkan array tanpa mutasi.'],
                    ['line' => 16, 'text' => 'Shallow clone object dengan override properti tertentu.'],
                ],
                'category' => 'programming',
            ],
            [
                'title' => 'Python Flask REST API Sederhana',
                'code' => "from flask import Flask, jsonify, request\n\napp = Flask(__name__)\nsiswa_list = []\n\n@app.route('/api/siswa', methods=['GET'])\ndef get_siswa():\n    return jsonify(siswa_list)\n\n@app.route('/api/siswa', methods=['POST'])\ndef add_siswa():\n    data = request.get_json()\n    siswa_list.append(data)\n    return jsonify(data), 201\n\n@app.route('/api/siswa/<int:idx>', methods=['DELETE'])\ndef delete_siswa(idx):\n    if 0 <= idx < len(siswa_list):\n        removed = siswa_list.pop(idx)\n        return jsonify(removed)\n    return jsonify({'error': 'Not found'}), 404\n\nif __name__ == '__main__':\n    app.run(debug=True)",
                'language' => 'python',
                'description' => 'REST API CRUD sederhana menggunakan Python Flask dengan endpoint GET, POST, dan DELETE.',
                'annotations' => [
                    ['line' => 6, 'text' => 'Decorator route mendefinisikan endpoint dan method HTTP.'],
                    ['line' => 12, 'text' => 'request.get_json() mengambil body JSON dari client.'],
                    ['line' => 14, 'text' => 'Return status 201 Created untuk resource baru.'],
                ],
                'category' => 'programming',
            ],
            [
                'title' => 'Java: Implementasi Stack dengan Generics',
                'code' => "public class Stack<T> {\n    private Object[] data;\n    private int top;\n    private int capacity;\n\n    public Stack(int capacity) {\n        this.capacity = capacity;\n        this.data = new Object[capacity];\n        this.top = -1;\n    }\n\n    public void push(T item) {\n        if (top >= capacity - 1)\n            throw new RuntimeException(\"Stack penuh!\");\n        data[++top] = item;\n    }\n\n    @SuppressWarnings(\"unchecked\")\n    public T pop() {\n        if (top < 0)\n            throw new RuntimeException(\"Stack kosong!\");\n        return (T) data[top--];\n    }\n\n    public boolean isEmpty() {\n        return top < 0;\n    }\n}",
                'language' => 'java',
                'description' => 'Implementasi struktur data Stack menggunakan Java Generics untuk tipe data fleksibel.',
                'annotations' => [
                    ['line' => 1, 'text' => 'Generics <T> membuat Stack fleksibel untuk tipe data apapun.'],
                    ['line' => 12, 'text' => 'Push menambahkan elemen ke puncak stack.'],
                    ['line' => 19, 'text' => 'Pop mengeluarkan dan mengembalikan elemen dari puncak stack.'],
                ],
                'category' => 'programming',
            ],
            [
                'title' => 'PHP Laravel: Controller & Eloquent CRUD',
                'code' => "<?php\nnamespace App\\Http\\Controllers;\n\nuse App\\Models\\Siswa;\nuse Illuminate\\Http\\Request;\n\nclass SiswaController extends Controller\n{\n    public function index()\n    {\n        \$siswa = Siswa::orderBy('nama')->get();\n        return view('siswa.index', compact('siswa'));\n    }\n\n    public function store(Request \$request)\n    {\n        \$request->validate([\n            'nama' => 'required|string|max:100',\n            'kelas' => 'required|string',\n        ]);\n\n        Siswa::create(\$request->all());\n        return redirect()->route('siswa.index')\n            ->with('success', 'Data siswa berhasil ditambahkan!');\n    }\n\n    public function destroy(Siswa \$siswa)\n    {\n        \$siswa->delete();\n        return redirect()->route('siswa.index')\n            ->with('success', 'Data siswa berhasil dihapus!');\n    }\n}",
                'language' => 'php',
                'description' => 'CRUD Controller menggunakan Laravel Eloquent ORM — pattern standar untuk web app PHP modern.',
                'annotations' => [
                    ['line' => 11, 'text' => 'Eloquent ORM: query builder yang elegan dan readable.'],
                    ['line' => 17, 'text' => 'Validasi request otomatis dari Laravel.'],
                    ['line' => 22, 'text' => 'Mass assignment dengan create() — pastikan $fillable di Model.'],
                ],
                'category' => 'web',
            ],
            [
                'title' => 'SQL: Stored Procedure & Transaction',
                'code' => "-- Stored Procedure\nDELIMITER //\nCREATE PROCEDURE transfer_nilai(\n    IN dari_id INT,\n    IN ke_id INT,\n    IN jumlah INT\n)\nBEGIN\n    DECLARE EXIT HANDLER FOR SQLEXCEPTION\n    BEGIN\n        ROLLBACK;\n    END;\n\n    START TRANSACTION;\n        UPDATE siswa SET nilai = nilai - jumlah\n            WHERE id = dari_id AND nilai >= jumlah;\n        UPDATE siswa SET nilai = nilai + jumlah\n            WHERE id = ke_id;\n    COMMIT;\nEND //\nDELIMITER ;\n\n-- Panggil procedure\nCALL transfer_nilai(1, 2, 10);",
                'language' => 'sql',
                'description' => 'Stored Procedure dengan Transaction dan Error Handling untuk operasi database yang aman.',
                'annotations' => [
                    ['line' => 9, 'text' => 'Handler untuk rollback otomatis jika terjadi error SQL.'],
                    ['line' => 14, 'text' => 'Transaction memastikan kedua UPDATE terjadi secara atomik.'],
                    ['line' => 24, 'text' => 'CALL untuk mengeksekusi stored procedure.'],
                ],
                'category' => 'database',
            ],
            [
                'title' => 'C++: Linked List Sederhana',
                'code' => "#include <iostream>\nusing namespace std;\n\nstruct Node {\n    int data;\n    Node* next;\n};\n\nclass LinkedList {\nprivate:\n    Node* head;\npublic:\n    LinkedList() : head(nullptr) {}\n\n    void insertFront(int val) {\n        Node* newNode = new Node{val, head};\n        head = newNode;\n    }\n\n    void display() {\n        Node* curr = head;\n        while (curr != nullptr) {\n            cout << curr->data << \" -> \";\n            curr = curr->next;\n        }\n        cout << \"NULL\" << endl;\n    }\n\n    ~LinkedList() {\n        while (head) {\n            Node* temp = head;\n            head = head->next;\n            delete temp;\n        }\n    }\n};",
                'language' => 'cpp',
                'description' => 'Implementasi Linked List dasar di C++ dengan insert, display, dan destructor untuk memory cleanup.',
                'annotations' => [
                    ['line' => 4, 'text' => 'Struct Node menyimpan data dan pointer ke node berikutnya.'],
                    ['line' => 15, 'text' => 'Insert di depan: O(1) time complexity.'],
                    ['line' => 29, 'text' => 'Destructor membersihkan memory untuk mencegah memory leak.'],
                ],
                'category' => 'programming',
            ],
        ];

        foreach ($snippets as $snippet) {
            Snippet::create($snippet);
        }

        // ===== BADGES =====
        DB::table('badges')->delete();
        $badges = [
            ['name' => 'Data Link Initiate', 'icon' => 'star', 'description' => 'Menyelesaikan tutorial pertama', 'criteria' => 'complete_first_tutorial'],
            ['name' => 'Terminal Ghost', 'icon' => 'terminal', 'description' => 'Kompilasi kode perdana di Playground.', 'criteria' => 'first_playground'],
            ['name' => 'Archive Archivist', 'icon' => 'bookmark', 'description' => 'Menyimpan 5 sintaks ke bookmark.', 'criteria' => 'five_bookmarks'],
            ['name' => 'Routing Architect', 'icon' => 'crown', 'description' => 'Menyelesaikan rute intermediat', 'criteria' => 'all_intermediate'],
            ['name' => 'BGP Grandmaster', 'icon' => 'globe-alt', 'description' => 'Menguasai protokol BGP (Advanced)', 'criteria' => 'complete_bgp'],
            ['name' => 'SysAdmin 0-Day', 'icon' => 'sparkles', 'description' => 'Menyelesaikan seluurh ekosistem tutorial.', 'criteria' => 'all_tutorials'],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }

        // Give user some badges and progress
        $user->badges()->sync([1, 2]);

        // Create some progress
        DB::table('user_progress')->delete();
        \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => 1, 'status' => 'completed', 'completed_at' => now()->subDays(5)]);
        \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => 2, 'status' => 'completed', 'completed_at' => now()->subDays(3)]);
        \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => 3, 'status' => 'in_progress']);

        // Create some bookmarks
        DB::table('bookmarks')->delete();
        \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Tutorial::class, 'bookmarkable_id' => 1]);
        \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Snippet::class, 'bookmarkable_id' => 1]);
        \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Snippet::class, 'bookmarkable_id' => 2]);
    }
}
