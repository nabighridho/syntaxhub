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
        $tutorials = [
            // ========================
            // TKJ DEPARTMENT
            // ========================

            // 1. Fundamental Jaringan & Topologi
            [
                'title' => 'Fundamental Jaringan & Topologi',
                'description' => 'Pelajari arsitektur dasar jaringan komputer, model OSI, dan jenis-jenis topologi fisik maupun logis.',
                'content' => '<h2>Apa itu Jaringan Komputer?</h2><p>Jaringan komputer adalah sekumpulan komputer dan perangkat yang saling terhubung untuk berbagi informasi dan sumber daya. Komunikasi antar perangkat didasarkan pada protokol standar seperti TCP/IP.</p><p>Jaringan komputer memungkinkan kita untuk:</p><ul><li><strong>Berbagi file</strong> — Transfer dokumen, gambar, video antar komputer</li><li><strong>Berbagi printer</strong> — Satu printer diakses oleh banyak komputer</li><li><strong>Komunikasi</strong> — Email, chat, video call</li><li><strong>Akses internet</strong> — Browsing, streaming, download</li></ul><p>Berdasarkan cakupan area, jaringan dibagi menjadi:</p><ul><li><strong>LAN (Local Area Network)</strong> — Jaringan dalam satu gedung atau area kecil (contoh: lab komputer sekolah)</li><li><strong>MAN (Metropolitan Area Network)</strong> — Jaringan yang mencakup satu kota</li><li><strong>WAN (Wide Area Network)</strong> — Jaringan yang mencakup wilayah geografis luas (contoh: Internet)</li><li><strong>PAN (Personal Area Network)</strong> — Jaringan personal seperti Bluetooth</li></ul>

<h2>Model OSI (Open Systems Interconnection)</h2><p>Model OSI adalah kerangka referensi untuk memahami cara data dikirim melalui jaringan. Model ini memiliki 7 layer yang masing-masing memiliki fungsi spesifik:</p><ul><li><strong>Layer 7 (Application)</strong> — Interaksi langsung dengan pengguna. Protokol: HTTP, FTP, SMTP, DNS</li><li><strong>Layer 6 (Presentation)</strong> — Enkripsi, kompresi, dan format data. Contoh: SSL/TLS, JPEG, ASCII</li><li><strong>Layer 5 (Session)</strong> — Mengelola sesi komunikasi antar perangkat</li><li><strong>Layer 4 (Transport)</strong> — Pengiriman data yang handal. Protokol: TCP (reliable), UDP (fast)</li><li><strong>Layer 3 (Network)</strong> — Routing dan pengalamatan logis. Protokol: IP, ICMP, ARP</li><li><strong>Layer 2 (Data Link)</strong> — Framing dan akses media. Alamat: MAC Address</li><li><strong>Layer 1 (Physical)</strong> — Media fisik: kabel UTP, fiber optic, sinyal wireless</li></ul><p>Cara mudah mengingat (dari atas): <strong>A</strong>ll <strong>P</strong>eople <strong>S</strong>eem <strong>T</strong>o <strong>N</strong>eed <strong>D</strong>ata <strong>P</strong>rocessing.</p>

<h2>Topologi Jaringan</h2><p>Topologi jaringan menggambarkan bagaimana node-node (komputer, switch, router) saling terhubung secara fisik maupun logis.</p><ul><li><strong>Topologi Bus</strong> — Semua perangkat terhubung ke satu kabel utama (backbone). Sederhana tapi jika kabel putus, seluruh jaringan mati.</li><li><strong>Topologi Star</strong> — Setiap perangkat terhubung ke satu titik pusat (hub/switch). Paling umum digunakan. Jika satu kabel rusak, hanya satu perangkat yang terpengaruh.</li><li><strong>Topologi Ring</strong> — Perangkat terhubung membentuk lingkaran. Data beredar satu arah. Digunakan dalam teknologi Token Ring.</li><li><strong>Topologi Mesh</strong> — Setiap perangkat terhubung ke semua perangkat lain. Sangat handal tapi mahal. Digunakan dalam backbone ISP.</li><li><strong>Topologi Hybrid</strong> — Kombinasi dari beberapa topologi di atas.</li></ul>

<h2>Perangkat Jaringan Utama</h2><p>Berikut perangkat-perangkat yang sering digunakan dalam jaringan:</p><ul><li><strong>Hub</strong> — Perangkat layer 1 yang meneruskan data ke semua port (broadcast). Sudah jarang digunakan.</li><li><strong>Switch</strong> — Perangkat layer 2 yang meneruskan data berdasarkan MAC address. Lebih cerdas dari hub.</li><li><strong>Router</strong> — Perangkat layer 3 yang menghubungkan jaringan berbeda dan melakukan routing berdasarkan IP address.</li><li><strong>Access Point (AP)</strong> — Perangkat yang menyediakan koneksi wireless (Wi-Fi).</li><li><strong>Firewall</strong> — Perangkat keamanan yang memfilter lalu lintas jaringan.</li></ul><pre><code>Contoh jaringan sederhana:
[PC1] ---+
[PC2] ---+--- [Switch] --- [Router] --- [Internet]
[PC3] ---+</code></pre>',
                'level' => 'beginner',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 20,
                'order' => 1,
                'icon' => 'globe',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi model OSI di bawah ini.',
                        'code_template' => "Layer 2: {0} Link\nLayer 4: {1}\nLayer 7: {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'Data', '{1}' => 'Transport', '{2}' => 'Application']
                    ],
                    [
                        'instruction' => 'Tentukan jenis jaringan berdasarkan cakupan areanya.',
                        'code_template' => "Jaringan dalam satu gedung: {0}\nJaringan seluas kota: {1}\nJaringan seluas dunia (Internet): {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'LAN', '{1}' => 'MAN', '{2}' => 'WAN']
                    ],
                    [
                        'instruction' => 'Tentukan perangkat jaringan berdasarkan layer dan fungsinya.',
                        'code_template' => "Layer 1 - broadcast ke semua port: {0}\nLayer 2 - forward berdasarkan MAC: {1}\nLayer 3 - routing antar jaringan: {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'Hub', '{1}' => 'Switch', '{2}' => 'Router']
                    ],
                ]
            ],

            // 2. IP Address & Subnetting Dasar
            [
                'title' => 'IP Address & Subnetting Dasar',
                'description' => 'Memahami konsep IPv4, kelas jaringan, dan cara menghitung subnet mask sederhana.',
                'content' => '<h2>Apa itu IP Address?</h2><p>IP Address (Internet Protocol Address) adalah identitas unik setiap perangkat di jaringan. Ibarat alamat rumah, IP address memastikan data sampai ke tujuan yang benar.</p><p>IPv4 terdiri dari 32-bit angka biner yang ditulis dalam format desimal bertitik (dotted decimal). Contoh: <code>192.168.1.10</code></p><p>Setiap oktet (bagian yang dipisahkan titik) bernilai 0-255. Jadi total ada 4 oktet × 8 bit = 32 bit.</p><pre><code>Contoh konversi:
192     .168    .1      .10
11000000.10101000.00000001.00001010</code></pre>

<h2>Kelas IP Address</h2><p>IPv4 dibagi menjadi beberapa kelas berdasarkan oktet pertama:</p><ul><li><strong>Kelas A</strong>: 1.0.0.0 - 126.255.255.255 (Subnet default: 255.0.0.0 atau /8). Untuk jaringan besar dengan jutaan host.</li><li><strong>Kelas B</strong>: 128.0.0.0 - 191.255.255.255 (Subnet default: 255.255.0.0 atau /16). Untuk jaringan menengah.</li><li><strong>Kelas C</strong>: 192.0.0.0 - 223.255.255.255 (Subnet default: 255.255.255.0 atau /24). Untuk jaringan kecil.</li></ul><p>IP Address juga dibagi menjadi:</p><ul><li><strong>IP Publik</strong> — Unik di seluruh internet, diberikan oleh ISP</li><li><strong>IP Privat</strong> — Hanya untuk jaringan internal:<ul><li>10.0.0.0 - 10.255.255.255 (Kelas A)</li><li>172.16.0.0 - 172.31.255.255 (Kelas B)</li><li>192.168.0.0 - 192.168.255.255 (Kelas C)</li></ul></li></ul>

<h2>Subnetting Dasar</h2><p>Subnetting adalah teknik membagi satu jaringan besar menjadi beberapa sub-jaringan (subnet) yang lebih kecil. Ini meningkatkan efisiensi dan keamanan.</p><p><strong>Subnet Mask</strong> menentukan bagian mana dari IP address yang merupakan Network ID dan mana yang Host ID.</p><pre><code>IP Address:   192.168.1.10
Subnet Mask:  255.255.255.0
              |||||||||||
Network ID:   192.168.1.0
Host ID:      .10
Broadcast:    192.168.1.255
Host Range:   192.168.1.1 - 192.168.1.254</code></pre><p>Prefix /24 merepresentasikan 255.255.255.0 dimana 24 bit pertama adalah Network ID.</p>

<h2>Menghitung Jumlah Host</h2><p>Rumus menghitung jumlah host yang tersedia dalam sebuah subnet:</p><pre><code>Jumlah Host = 2^n - 2
(n = jumlah bit host, dikurangi 2 untuk Network ID dan Broadcast)

Contoh /24:
Host bits = 32 - 24 = 8
Jumlah host = 2^8 - 2 = 254 host

Contoh /26:
Host bits = 32 - 26 = 6
Jumlah host = 2^6 - 2 = 62 host
Subnet mask = 255.255.255.192</code></pre><p>Tabel prefix yang sering digunakan:</p><ul><li><code>/24</code> = 255.255.255.0 → 254 host</li><li><code>/25</code> = 255.255.255.128 → 126 host</li><li><code>/26</code> = 255.255.255.192 → 62 host</li><li><code>/27</code> = 255.255.255.224 → 30 host</li><li><code>/28</code> = 255.255.255.240 → 14 host</li><li><code>/30</code> = 255.255.255.252 → 2 host (point-to-point link)</li></ul>',
                'level' => 'beginner',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 30,
                'order' => 2,
                'icon' => 'wifi',
                'quiz' => [
                    [
                        'instruction' => 'Isi prefix subnet berikut untuk subnet mask 255.255.255.0 dan 255.0.0.0',
                        'code_template' => "IP: 192.168.1.10 Mask: 255.255.255.0 Prefix: /{0}\nIP: 10.0.0.5 Mask: 255.0.0.0 Prefix: /{1}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '24', '{1}' => '8']
                    ],
                    [
                        'instruction' => 'Hitung jumlah host yang tersedia pada subnet /26 dan /30.',
                        'code_template' => "Subnet /26: Host bits = 32 - 26 = {0}\nJumlah host = 2^6 - 2 = {1}\n\nSubnet /30: Host bits = 32 - 30 = {2}\nJumlah host = 2^2 - 2 = {3}",
                        'blanks' => ['{0}', '{1}', '{2}', '{3}'],
                        'answers' => ['{0}' => '6', '{1}' => '62', '{2}' => '2', '{3}' => '2']
                    ],
                    [
                        'instruction' => 'Tentukan kelas IP address berikut.',
                        'code_template' => "IP 10.0.0.1 termasuk Kelas: {0}\nIP 172.16.0.1 termasuk Kelas: {1}\nIP 192.168.1.1 termasuk Kelas: {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'A', '{1}' => 'B', '{2}' => 'C']
                    ],
                ]
            ],

            // 3. Navigasi CLI Cisco IOS
            [
                'title' => 'Navigasi CLI Cisco IOS',
                'description' => 'Panduan praktis bernavigasi menggunakan Command Line Interface (CLI) pada perangkat Cisco.',
                'content' => '<h2>Pengenalan Cisco IOS</h2><p>Cisco IOS (Internetwork Operating System) adalah sistem operasi yang berjalan pada router dan switch Cisco. Semua konfigurasi dilakukan melalui CLI (Command Line Interface).</p><p>IOS menggunakan sistem berbasis <strong>mode</strong>. Anda harus berada di mode yang tepat untuk menjalankan perintah tertentu. Ini adalah mekanisme keamanan agar tidak sembarang mengubah konfigurasi.</p><p>Saat pertama kali mengakses perangkat Cisco, Anda akan masuk ke <strong>User EXEC Mode</strong> yang ditandai dengan prompt <code>Router&gt;</code>.</p>

<h2>Mode-Mode dalam Cisco IOS</h2><p>Ada beberapa mode utama yang perlu Anda ketahui:</p><ul><li><strong>User EXEC Mode</strong> (<code>Router&gt;</code>) — Mode terbatas. Hanya bisa melihat informasi dasar seperti <code>show version</code>.</li><li><strong>Privileged EXEC Mode</strong> (<code>Router#</code>) — Mode penuh untuk monitoring. Akses dengan perintah <code>enable</code>.</li><li><strong>Global Configuration Mode</strong> (<code>Router(config)#</code>) — Mode untuk mengubah konfigurasi global. Akses dengan <code>configure terminal</code>.</li><li><strong>Interface Configuration Mode</strong> (<code>Router(config-if)#</code>) — Mode untuk mengkonfigurasi interface spesifik.</li><li><strong>Line Configuration Mode</strong> (<code>Router(config-line)#</code>) — Mode untuk mengkonfigurasi line console/vty.</li></ul><pre><code>Router> enable
Router# configure terminal
Router(config)# interface GigabitEthernet0/0
Router(config-if)# ip address 192.168.1.1 255.255.255.0
Router(config-if)# no shutdown
Router(config-if)# exit
Router(config)# exit
Router#</code></pre>

<h2>Perintah-Perintah Penting</h2><p>Berikut perintah-perintah yang wajib dikuasai:</p><pre><code># Melihat konfigurasi yang sedang berjalan
Router# show running-config

# Melihat konfigurasi tersimpan
Router# show startup-config

# Menyimpan konfigurasi
Router# copy running-config startup-config
(atau singkatan: write memory)

# Melihat status interface
Router# show ip interface brief

# Melihat tabel routing
Router# show ip route

# Melihat versi IOS
Router# show version</code></pre><p>Tips navigasi CLI:</p><ul><li><code>?</code> — Menampilkan bantuan/daftar perintah yang tersedia</li><li><code>Tab</code> — Auto-complete perintah</li><li><code>Ctrl+Z</code> — Kembali ke Privileged EXEC dari mode apapun</li><li><code>do</code> — Menjalankan perintah Privileged dari Global Config (contoh: <code>do show ip int brief</code>)</li></ul>

<h2>Konfigurasi Dasar Perangkat</h2><p>Setiap perangkat baru harus dikonfigurasi dengan pengaturan dasar berikut:</p><pre><code>Router> enable
Router# configure terminal

! Memberi nama hostname
Router(config)# hostname R1

! Memberi password enable
R1(config)# enable secret class123

! Mengamankan console
R1(config)# line console 0
R1(config-line)# password cisco
R1(config-line)# login
R1(config-line)# exit

! Mengamankan akses remote (Telnet/SSH)
R1(config)# line vty 0 4
R1(config-line)# password cisco
R1(config-line)# login
R1(config-line)# exit

! Mengenkripsi semua password
R1(config)# service password-encryption

! Banner peringatan
R1(config)# banner motd #Unauthorized Access Prohibited!#

! Simpan
R1(config)# exit
R1# copy running-config startup-config</code></pre>',
                'level' => 'beginner',
                'category' => 'router',
                'department' => 'tkj',
                'estimated_minutes' => 25,
                'order' => 3,
                'icon' => 'terminal',
                'quiz' => [
                    [
                        'instruction' => 'Tuliskan perintah yang benar untuk berpindah dari mode User EXEC ke Global Configuration.',
                        'code_template' => "Router> {0}\nRouter# {1}\nRouter(config)#",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'enable', '{1}' => 'configure terminal']
                    ],
                    [
                        'instruction' => 'Lengkapi perintah untuk melihat status interface dan menyimpan konfigurasi.',
                        'code_template' => "Router# show ip {0} brief\nRouter# {1} running-config startup-config",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'interface', '{1}' => 'copy']
                    ],
                    [
                        'instruction' => 'Lengkapi konfigurasi hostname dan password enable.',
                        'code_template' => "Router(config)# {0} R1\nR1(config)# enable {1} class123",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'hostname', '{1}' => 'secret']
                    ],
                ]
            ],

            // 4. Routing Statis Inter-Network
            [
                'title' => 'Routing Statis Inter-Network',
                'description' => 'Mengkonfigurasi routing statis pada router agar jaringan berbeda dapat saling terhubung.',
                'content' => '<h2>Konsep Routing</h2><p>Routing adalah proses menentukan jalur terbaik untuk mengirimkan paket data dari satu jaringan ke jaringan lain. Router menggunakan <strong>tabel routing</strong> untuk memutuskan ke mana paket harus dikirim.</p><p>Ada dua jenis routing utama:</p><ul><li><strong>Static Routing</strong> — Administrator memasukkan rute secara manual ke tabel routing. Cocok untuk jaringan kecil dan stabil.</li><li><strong>Dynamic Routing</strong> — Router secara otomatis menemukan dan memperbarui rute menggunakan protokol seperti OSPF, EIGRP, atau BGP.</li></ul><p>Keuntungan static routing:</p><ul><li>Tidak memakan bandwidth (tidak ada pertukaran update routing)</li><li>Lebih aman (admin menentukan jalur secara eksplisit)</li><li>Mudah dipahami untuk jaringan sederhana</li></ul>

<h2>Format Perintah Static Route</h2><p>Untuk menambahkan rute statis pada router Cisco, gunakan perintah:</p><pre><code>ip route [network-tujuan] [subnet-mask] [next-hop-ip | exit-interface]</code></pre><p>Contoh skenario: Router R1 ingin menuju jaringan 192.168.2.0/24 melalui router R2 (IP next-hop: 10.0.0.2).</p><pre><code>R1(config)# ip route 192.168.2.0 255.255.255.0 10.0.0.2</code></pre><p>Penjelasan:</p><ul><li><code>192.168.2.0</code> — Network tujuan yang ingin dijangkau</li><li><code>255.255.255.0</code> — Subnet mask dari network tujuan</li><li><code>10.0.0.2</code> — IP address next-hop (router tetangga)</li></ul>

<h2>Default Route</h2><p>Default route digunakan ketika router tidak memiliki rute spesifik ke suatu tujuan. Semua trafik yang tidak dikenal dikirim ke default gateway.</p><pre><code>R1(config)# ip route 0.0.0.0 0.0.0.0 10.0.0.1</code></pre><p>Default route biasanya mengarah ke ISP atau router utama. Ini setara dengan "gateway of last resort" dalam tabel routing.</p>

<h2>Verifikasi dan Troubleshooting</h2><p>Setelah mengkonfigurasi static route, verifikasi dengan perintah-perintah berikut:</p><pre><code># Lihat tabel routing
R1# show ip route

# Contoh output:
# S    192.168.2.0/24 [1/0] via 10.0.0.2
# (S = Static, [1/0] = Administrative Distance/Metric)

# Test konektivitas
R1# ping 192.168.2.1

# Trace route ke tujuan
R1# traceroute 192.168.2.1</code></pre><p>Jika routing tidak bekerja, periksa:</p><ul><li>Interface sudah dalam keadaan <code>up/up</code> (no shutdown)</li><li>IP address sudah benar di kedua sisi</li><li>Routing dikonfigurasi di <strong>kedua arah</strong> (bolak-balik)</li></ul>',
                'level' => 'intermediate',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 45,
                'order' => 4,
                'icon' => 'switch',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi perintah static routing berikut untuk menuju jaringan 172.16.5.0/24 via 192.168.1.1.',
                        'code_template' => "Router(config)# {0} 172.16.5.0 255.255.255.0 {1}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'ip route', '{1}' => '192.168.1.1']
                    ],
                    [
                        'instruction' => 'Lengkapi default route agar semua trafik tidak dikenal diarahkan ke 10.0.0.1.',
                        'code_template' => "Router(config)# ip route {0} {1} 10.0.0.1",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '0.0.0.0', '{1}' => '0.0.0.0']
                    ],
                ]
            ],

            // 5. Konfigurasi VLAN & Inter-VLAN Routing
            [
                'title' => 'Konfigurasi VLAN & Inter-VLAN Routing',
                'description' => 'Membangun Virtual LAN pada Switch dan menghubungkannya via Router-on-a-stick.',
                'content' => '<h2>Apa itu VLAN?</h2><p>VLAN (Virtual Local Area Network) memungkinkan administrator untuk membagi satu switch fisik menjadi beberapa <strong>broadcast domain</strong> secara logis. Perangkat dalam VLAN yang sama dapat berkomunikasi langsung, sedangkan komunikasi antar VLAN memerlukan router.</p><p>Keuntungan VLAN:</p><ul><li><strong>Keamanan</strong> — Memisahkan trafik departemen berbeda (misal: guru dan siswa)</li><li><strong>Performa</strong> — Mengurangi ukuran broadcast domain</li><li><strong>Fleksibilitas</strong> — Pengelompokan berdasarkan fungsi, bukan lokasi fisik</li></ul>

<h2>Konfigurasi VLAN di Switch</h2><p>Berikut cara membuat dan meng-assign VLAN pada port switch:</p><pre><code>! Membuat VLAN
Switch(config)# vlan 10
Switch(config-vlan)# name GURU
Switch(config-vlan)# exit
Switch(config)# vlan 20
Switch(config-vlan)# name SISWA
Switch(config-vlan)# exit

! Assign port ke VLAN (Access Port)
Switch(config)# interface FastEthernet0/1
Switch(config-if)# switchport mode access
Switch(config-if)# switchport access vlan 10
Switch(config-if)# exit

Switch(config)# interface FastEthernet0/2
Switch(config-if)# switchport mode access
Switch(config-if)# switchport access vlan 20
Switch(config-if)# exit</code></pre>

<h2>Trunk Port & 802.1Q</h2><p>Port trunk mengangkut data dari <strong>banyak VLAN</strong> antar switch atau dari switch ke router. Pada port trunk, paket dilabeli dengan VLAN Tag menggunakan standar IEEE 802.1Q.</p><pre><code>! Konfigurasi trunk pada port yang menghubungkan ke switch/router lain
Switch(config)# interface GigabitEthernet0/1
Switch(config-if)# switchport mode trunk
Switch(config-if)# switchport trunk allowed vlan 10,20
Switch(config-if)# exit

! Verifikasi
Switch# show vlan brief
Switch# show interfaces trunk</code></pre>

<h2>Router on a Stick (Inter-VLAN Routing)</h2><p>Untuk menghubungkan antar VLAN, diperlukan router. Metode "Router on a Stick" menggunakan satu interface fisik router yang dibagi menjadi sub-interface untuk setiap VLAN.</p><pre><code>! Konfigurasi sub-interface di Router
Router(config)# interface GigabitEthernet0/0.10
Router(config-subif)# encapsulation dot1Q 10
Router(config-subif)# ip address 192.168.10.1 255.255.255.0
Router(config-subif)# exit

Router(config)# interface GigabitEthernet0/0.20
Router(config-subif)# encapsulation dot1Q 20
Router(config-subif)# ip address 192.168.20.1 255.255.255.0
Router(config-subif)# exit

! Aktifkan interface fisik
Router(config)# interface GigabitEthernet0/0
Router(config-if)# no shutdown</code></pre><p>Sekarang PC di VLAN 10 (192.168.10.x) bisa ping ke PC di VLAN 20 (192.168.20.x) melalui router!</p>',
                'level' => 'intermediate',
                'category' => 'switch',
                'department' => 'tkj',
                'estimated_minutes' => 50,
                'order' => 5,
                'icon' => 'status',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi konfigurasi Access Port untuk VLAN 10 dan Trunk Port berikut.',
                        'code_template' => "Switch(config-if)# switchport mode {0}\nSwitch(config-if)# switchport access vlan 10\n\nSwitch(config-if)# switchport mode {1}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'access', '{1}' => 'trunk']
                    ],
                    [
                        'instruction' => 'Lengkapi konfigurasi sub-interface Router on a Stick untuk VLAN 20.',
                        'code_template' => "Router(config)# interface GigabitEthernet0/0.20\nRouter(config-subif)# {0} dot1Q {1}\nRouter(config-subif)# ip address 192.168.20.1 255.255.255.0",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'encapsulation', '{1}' => '20']
                    ],
                ]
            ],

            // 6. Routing OSPF Single-Area
            [
                'title' => 'Routing OSPF Single-Area',
                'description' => 'Mengaplikasikan routing dinamis menggunakan protokol OSPF Link-State.',
                'content' => '<h2>Pengenalan OSPF</h2><p>OSPF (Open Shortest Path First) adalah protokol routing dinamis berbasis <strong>Link-State</strong>. Berbeda dengan routing statis yang harus dikonfigurasi manual, OSPF menemukan rute terbaik secara otomatis.</p><p>Karakteristik OSPF:</p><ul><li>Menggunakan algoritma <strong>Dijkstra (SPF)</strong> untuk mencari jalur tercepat</li><li>Metric berdasarkan <strong>bandwidth</strong> (cost)</li><li>Administrative Distance: <strong>110</strong></li><li>Mendukung pembagian area untuk skalabilitas</li><li>Protokol standar terbuka (bukan proprietary seperti EIGRP)</li></ul>

<h2>Cara Kerja OSPF</h2><p>Router OSPF melakukan beberapa tahap untuk membangun tabel routing:</p><ul><li><strong>Hello Packets</strong> — Router mengirim hello packet untuk menemukan tetangga (neighbor)</li><li><strong>Adjacency</strong> — Router membentuk hubungan adjacency dengan tetangga</li><li><strong>LSA Flooding</strong> — Setiap router membagikan informasi link-state (LSA) ke seluruh area</li><li><strong>LSDB</strong> — Semua router membangun Link State Database yang identik</li><li><strong>SPF Calculation</strong> — Algoritma Dijkstra menghitung jalur terpendek ke setiap tujuan</li></ul>

<h2>Konfigurasi OSPF Dasar</h2><pre><code>! Aktifkan OSPF dengan process ID 10
Router(config)# router ospf 10

! Masukkan network ke OSPF
! Format: network [IP] [wildcard-mask] area [area-id]
Router(config-router)# network 192.168.1.0 0.0.0.255 area 0
Router(config-router)# network 10.0.0.0 0.0.0.3 area 0

! Opsional: Set router-id manual
Router(config-router)# router-id 1.1.1.1</code></pre><p><strong>Wildcard mask</strong> adalah kebalikan dari subnet mask:</p><ul><li>Subnet 255.255.255.0 → Wildcard 0.0.0.255</li><li>Subnet 255.255.255.252 → Wildcard 0.0.0.3</li></ul>

<h2>Verifikasi OSPF</h2><pre><code># Lihat tetangga OSPF
Router# show ip ospf neighbor

# Lihat database LSDB
Router# show ip ospf database

# Lihat interface OSPF
Router# show ip ospf interface brief

# Lihat tabel routing (rute OSPF ditandai "O")
Router# show ip route ospf</code></pre>',
                'level' => 'intermediate',
                'category' => 'router',
                'department' => 'tkj',
                'estimated_minutes' => 60,
                'order' => 6,
                'icon' => 'map',
                'quiz' => [
                    [
                        'instruction' => 'Aktifkan OSPF proses 10, dan masukkan network 192.168.1.0/24 ke Area 0.',
                        'code_template' => "Router(config)# router ospf {0}\nRouter(config-router)# network 192.168.1.0 {1} area {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => '10', '{1}' => '0.0.0.255', '{2}' => '0']
                    ],
                    [
                        'instruction' => 'Tentukan wildcard mask dari subnet mask berikut.',
                        'code_template' => "Subnet 255.255.255.0 -> Wildcard: {0}\nSubnet 255.255.255.252 -> Wildcard: {1}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '0.0.0.255', '{1}' => '0.0.0.3']
                    ],
                ]
            ],

            // 7. BGP (Border Gateway Protocol)
            [
                'title' => 'BGP (Border Gateway Protocol)',
                'description' => 'Expert Level: Menghubungkan jaringan antar benua dan Autonomous System besar menggunakan BGP.',
                'content' => '<h2>Protokol Inti Internet</h2><p>BGP (Border Gateway Protocol) adalah protokol routing yang menjadi tulang punggung Internet. BGP adalah satu-satunya protokol <strong>EGP (Exterior Gateway Protocol)</strong> yang digunakan untuk menghubungkan <strong>Autonomous System (AS)</strong> yang berbeda.</p><p>BGP menggunakan konsep <strong>Path Vector</strong> — daripada hanya mencari jarak terpendek, BGP memanfaatkan atribut rute seperti AS_PATH, LOCAL_PREF, MED, dan WEIGHT untuk menentukan jalur terbaik.</p><p>Jenis BGP:</p><ul><li><strong>eBGP (External BGP)</strong> — Antara dua AS yang berbeda. Administrative Distance: 20</li><li><strong>iBGP (Internal BGP)</strong> — Dalam satu AS yang sama. Administrative Distance: 200</li></ul>

<h2>Konfigurasi eBGP</h2><p>Skenario: Router R1 (AS 100) terhubung ke Router R2 (AS 200) melalui link point-to-point.</p><pre><code>! Konfigurasi di R1 (AS 100)
R1(config)# router bgp 100
R1(config-router)# neighbor 10.0.0.2 remote-as 200
R1(config-router)# network 192.168.1.0 mask 255.255.255.0

! Konfigurasi di R2 (AS 200)
R2(config)# router bgp 200
R2(config-router)# neighbor 10.0.0.1 remote-as 100
R2(config-router)# network 172.16.0.0 mask 255.255.0.0</code></pre>

<h2>Atribut BGP & Pemilihan Path</h2><p>BGP memilih jalur terbaik berdasarkan urutan atribut berikut (Best Path Selection):</p><ul><li><strong>WEIGHT</strong> — Semakin tinggi semakin dipilih (Cisco proprietary, lokal)</li><li><strong>LOCAL_PREF</strong> — Semakin tinggi semakin dipilih (dalam satu AS)</li><li><strong>Locally Originated</strong> — Rute yang berasal dari router sendiri</li><li><strong>AS_PATH</strong> — Jalur dengan AS_PATH terpendek lebih dipilih</li><li><strong>ORIGIN</strong> — IGP > EGP > Incomplete</li><li><strong>MED</strong> — Semakin rendah semakin dipilih (antar AS)</li></ul>

<h2>Verifikasi BGP</h2><pre><code># Lihat tetangga BGP
Router# show bgp summary

# Lihat tabel BGP
Router# show bgp

# Lihat detail rute tertentu
Router# show bgp 192.168.1.0/24

# Lihat atribut path
Router# show ip bgp neighbors 10.0.0.2 advertised-routes</code></pre>',
                'level' => 'advanced',
                'category' => 'networking',
                'department' => 'tkj',
                'estimated_minutes' => 90,
                'order' => 7,
                'icon' => 'globe-alt',
                'quiz' => [
                    [
                        'instruction' => 'Konfigurasikan sesi BGP untuk router di AS 500 dengan neighbor 1.1.1.2 di AS 600.',
                        'code_template' => "Router(config)# router {0} 500\nRouter(config-router)# {1} 1.1.1.2 remote-as {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'bgp', '{1}' => 'neighbor', '{2}' => '600']
                    ],
                    [
                        'instruction' => 'BGP memilih jalur berdasarkan atribut. Lengkapi atribut yang tepat.',
                        'code_template' => "Atribut AS path terpendek: AS_{0}\nAtribut preferensi lokal (semakin tinggi semakin baik): LOCAL_{1}\nProtokol BGP antara AS yang berbeda: {2}BGP",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'PATH', '{1}' => 'PREF', '{2}' => 'e']
                    ],
                ]
            ],

            // 8. Linux Netfilter & Iptables
            [
                'title' => 'Linux Netfilter & Iptables',
                'description' => 'Expert Level: Manajemen Firewall level kernel menggunakan Iptables di env Linux.',
                'content' => '<h2>Pengenalan Firewall Linux</h2><p>Dalam dunia DevOps & NetOps, pengamanan level server sangat kritikal. Iptables adalah utility command-line yang memungkinkan administrator Linux untuk mengkonfigurasi firewall kernel (Netfilter).</p><p>Iptables bekerja berdasarkan konsep <strong>tables</strong>, <strong>chains</strong>, dan <strong>rules</strong>:</p><ul><li><strong>Tables</strong>: filter (default), nat, mangle, raw</li><li><strong>Chains</strong>: INPUT (masuk), OUTPUT (keluar), FORWARD (diteruskan)</li><li><strong>Targets</strong>: ACCEPT, DROP, REJECT, LOG</li></ul>

<h2>Sintaks Dasar Iptables</h2><pre><code>iptables -[A|I|D] [CHAIN] [options] -j [TARGET]

Opsi umum:
  -A    Append (tambah rule di akhir)
  -I    Insert (sisipkan rule di awal)
  -D    Delete (hapus rule)
  -p    Protocol (tcp, udp, icmp)
  --dport  Destination port
  --sport  Source port
  -s    Source IP
  -d    Destination IP
  -i    Input interface
  -o    Output interface</code></pre>

<h2>Contoh Konfigurasi Firewall</h2><pre><code># Drop semua ping (ICMP) yang masuk
iptables -A INPUT -p icmp -j DROP

# Mengizinkan SSH masuk (port 22)
iptables -A INPUT -p tcp --dport 22 -j ACCEPT

# Mengizinkan HTTP dan HTTPS
iptables -A INPUT -p tcp --dport 80 -j ACCEPT
iptables -A INPUT -p tcp --dport 443 -j ACCEPT

# Drop semua trafik masuk lainnya (default deny)
iptables -A INPUT -j DROP

# Mengizinkan trafik yang sudah ter-establish
iptables -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT

# Menyimpan rules agar persist setelah reboot
iptables-save > /etc/iptables/rules.v4</code></pre>

<h2>NAT dengan Iptables</h2><p>Network Address Translation (NAT) digunakan untuk mengubah alamat IP source/destination saat paket melewati firewall.</p><pre><code># SNAT - Mengubah source IP (untuk internet sharing)
iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE

# DNAT - Port Forwarding (forward port 80 ke server internal)
iptables -t nat -A PREROUTING -p tcp --dport 80 -j DNAT --to-destination 192.168.1.100:80

# Aktifkan IP forwarding
echo 1 > /proc/sys/net/ipv4/ip_forward</code></pre>',
                'level' => 'advanced',
                'category' => 'scripting',
                'department' => 'tkj',
                'estimated_minutes' => 75,
                'order' => 8,
                'icon' => 'shield',
                'quiz' => [
                    [
                        'instruction' => 'Buat rule iptables untuk APPEND rantai INPUT agar DROP trafik ke port 80 berprotokol tcp.',
                        'code_template' => "iptables -A {0} -p {1} --dport {2} -j {3}",
                        'blanks' => ['{0}', '{1}', '{2}', '{3}'],
                        'answers' => ['{0}' => 'INPUT', '{1}' => 'tcp', '{2}' => '80', '{3}' => 'DROP']
                    ],
                    [
                        'instruction' => 'Buat rule iptables untuk mengizinkan SSH (port 22) masuk.',
                        'code_template' => "iptables -{0} INPUT -p tcp --dport {1} -j {2}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'A', '{1}' => '22', '{2}' => 'ACCEPT']
                    ],
                ]
            ],

            // 9. Python Netmiko Automation
            [
                'title' => 'Python Netmiko Automation',
                'description' => 'Expert Level: Otomatisasi konfigurasi masif infrastruktur jaringan menggunakan Python Netmiko.',
                'content' => '<h2>Infrastructure as Code</h2><p>Di era modern, network engineer tidak lagi masuk ke router satu per satu. Netmiko (Network Paramiko) adalah library Python yang memudahkan otomatisasi konfigurasi perangkat jaringan via SSH.</p><p>Install Netmiko:</p><pre><code>pip install netmiko</code></pre><p>Netmiko mendukung berbagai vendor: Cisco IOS, Cisco NX-OS, Juniper Junos, Arista EOS, MikroTik, dan banyak lagi.</p>

<h2>Koneksi Dasar & Show Command</h2><pre><code>from netmiko import ConnectHandler

device = {
    "device_type": "cisco_ios",
    "host": "192.168.1.1",
    "username": "admin",
    "password": "password"
}

# Membuat koneksi SSH
net_connect = ConnectHandler(**device)

# Mengirim perintah show
output = net_connect.send_command("show ip int brief")
print(output)

# Disconnect
net_connect.disconnect()</code></pre>

<h2>Mengirim Konfigurasi</h2><p>Untuk mengirim konfigurasi, gunakan <code>send_config_set()</code>:</p><pre><code>from netmiko import ConnectHandler

device = {
    "device_type": "cisco_ios",
    "host": "192.168.1.1",
    "username": "admin",
    "password": "password"
}

net_connect = ConnectHandler(**device)

# Kirim satu set konfigurasi
config_commands = [
    "interface Loopback0",
    "ip address 1.1.1.1 255.255.255.255",
    "no shutdown",
]
output = net_connect.send_config_set(config_commands)
print(output)

# Simpan konfigurasi
net_connect.save_config()
net_connect.disconnect()</code></pre>

<h2>Otomasi Multi-Device</h2><p>Kekuatan sesungguhnya Netmiko adalah saat mengkonfigurasi banyak perangkat sekaligus:</p><pre><code>from netmiko import ConnectHandler

devices = [
    {"device_type": "cisco_ios", "host": "192.168.1.1", "username": "admin", "password": "pass"},
    {"device_type": "cisco_ios", "host": "192.168.1.2", "username": "admin", "password": "pass"},
    {"device_type": "cisco_ios", "host": "192.168.1.3", "username": "admin", "password": "pass"},
]

for device in devices:
    try:
        conn = ConnectHandler(**device)
        hostname = conn.send_command("show run | include hostname")
        print(f"Connected to: {hostname}")

        conn.send_config_set(["banner motd #Automated Config#"])
        conn.save_config()
        conn.disconnect()
        print(f"  -> Config applied to {device[\'host\']}")
    except Exception as e:
        print(f"  -> Error on {device[\'host\']}: {e}")</code></pre>',
                'level' => 'advanced',
                'category' => 'scripting',
                'department' => 'tkj',
                'estimated_minutes' => 120,
                'order' => 9,
                'icon' => 'terminal',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi script Netmiko untuk mengirimkan perintah "show version".',
                        'code_template' => "from {0} import ConnectHandler\n\nnet_connect = ConnectHandler(**device)\noutput = net_connect.{1}('show version')\nprint(output)",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'netmiko', '{1}' => 'send_command']
                    ],
                    [
                        'instruction' => 'Lengkapi script untuk mengirim konfigurasi ke perangkat Cisco.',
                        'code_template' => "config_commands = ['interface Loopback0', 'ip address 1.1.1.1 255.255.255.255']\noutput = net_connect.{0}(config_commands)\nnet_connect.{1}()",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'send_config_set', '{1}' => 'save_config']
                    ],
                ]
            ],

            // ========================
            // RPL DEPARTMENT
            // ========================

            // 10. Dasar HTML: Struktur & Elemen
            [
                'title' => 'Dasar HTML: Struktur & Elemen',
                'description' => 'Pelajari struktur dasar halaman web, elemen HTML semantik, heading, paragraf, list, dan link.',
                'content' => '<h2>Struktur Dasar HTML</h2><p>HTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. Setiap dokumen HTML memiliki struktur dasar yang harus diikuti:</p><pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="id"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Halaman Pertama&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Halo Dunia!&lt;/h1&gt;
    &lt;p&gt;Ini paragraf pertama saya.&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre><p>Penjelasan setiap bagian:</p><ul><li><code>&lt;!DOCTYPE html&gt;</code> — Deklarasi tipe dokumen HTML5</li><li><code>&lt;html&gt;</code> — Elemen root dari halaman</li><li><code>&lt;head&gt;</code> — Metadata halaman (title, charset, CSS links)</li><li><code>&lt;body&gt;</code> — Konten yang ditampilkan di browser</li></ul>

<h2>Heading, Paragraf & Format Teks</h2><p>HTML menyediakan 6 level heading dari <code>&lt;h1&gt;</code> (terbesar) sampai <code>&lt;h6&gt;</code> (terkecil). Gunakan heading secara hierarkis untuk aksesibilitas dan SEO.</p><pre><code>&lt;h1&gt;Judul Utama (hanya satu per halaman)&lt;/h1&gt;
&lt;h2&gt;Sub Judul&lt;/h2&gt;
&lt;h3&gt;Sub Sub Judul&lt;/h3&gt;

&lt;p&gt;Ini adalah paragraf biasa.&lt;/p&gt;
&lt;p&gt;Teks &lt;strong&gt;tebal&lt;/strong&gt; dan &lt;em&gt;miring&lt;/em&gt;.&lt;/p&gt;
&lt;p&gt;Baris baru dengan &lt;br&gt; tag.&lt;/p&gt;
&lt;hr&gt; &lt;!-- Garis horizontal --&gt;</code></pre>

<h2>List & Link</h2><p>HTML memiliki dua jenis list:</p><pre><code>&lt;!-- Unordered List (bullet) --&gt;
&lt;ul&gt;
    &lt;li&gt;Item pertama&lt;/li&gt;
    &lt;li&gt;Item kedua&lt;/li&gt;
    &lt;li&gt;Item ketiga&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- Ordered List (nomor) --&gt;
&lt;ol&gt;
    &lt;li&gt;Langkah 1&lt;/li&gt;
    &lt;li&gt;Langkah 2&lt;/li&gt;
    &lt;li&gt;Langkah 3&lt;/li&gt;
&lt;/ol&gt;

&lt;!-- Link / Anchor --&gt;
&lt;a href="https://google.com" target="_blank"&gt;Buka Google&lt;/a&gt;
&lt;a href="halaman2.html"&gt;Halaman Berikutnya&lt;/a&gt;
&lt;a href="#bagian-bawah"&gt;Scroll ke Bawah&lt;/a&gt;</code></pre>

<h2>Elemen Semantik HTML5</h2><p>HTML5 memperkenalkan elemen semantik yang memberikan makna pada struktur halaman:</p><ul><li><code>&lt;header&gt;</code> — Bagian atas halaman (logo, navigasi)</li><li><code>&lt;nav&gt;</code> — Area navigasi</li><li><code>&lt;main&gt;</code> — Konten utama halaman</li><li><code>&lt;section&gt;</code> — Bagian tematik dari konten</li><li><code>&lt;article&gt;</code> — Konten independen (blog post, berita)</li><li><code>&lt;aside&gt;</code> — Konten sampingan (sidebar)</li><li><code>&lt;footer&gt;</code> — Bagian bawah halaman</li></ul><pre><code>&lt;header&gt;
    &lt;nav&gt;
        &lt;a href="/"&gt;Home&lt;/a&gt;
        &lt;a href="/about"&gt;About&lt;/a&gt;
    &lt;/nav&gt;
&lt;/header&gt;
&lt;main&gt;
    &lt;article&gt;
        &lt;h2&gt;Judul Artikel&lt;/h2&gt;
        &lt;p&gt;Konten artikel...&lt;/p&gt;
    &lt;/article&gt;
    &lt;aside&gt;
        &lt;h3&gt;Sidebar&lt;/h3&gt;
    &lt;/aside&gt;
&lt;/main&gt;
&lt;footer&gt;
    &lt;p&gt;&amp;copy; 2026 Website Saya&lt;/p&gt;
&lt;/footer&gt;</code></pre>

<h2>Gambar, Tabel & Form Sederhana</h2><p>Elemen multimedia dan interaktif dasar:</p><pre><code>&lt;!-- Gambar --&gt;
&lt;img src="foto.jpg" alt="Deskripsi gambar" width="300"&gt;

&lt;!-- Tabel --&gt;
&lt;table border="1"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;Nama&lt;/th&gt;
            &lt;th&gt;Kelas&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;tr&gt;
            &lt;td&gt;Budi&lt;/td&gt;
            &lt;td&gt;XII RPL&lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;
&lt;/table&gt;

&lt;!-- Form Sederhana --&gt;
&lt;form action="/submit" method="POST"&gt;
    &lt;label for="nama"&gt;Nama:&lt;/label&gt;
    &lt;input type="text" id="nama" name="nama" required&gt;
    &lt;button type="submit"&gt;Kirim&lt;/button&gt;
&lt;/form&gt;</code></pre>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 101,
                'icon' => 'code',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi struktur dasar HTML berikut.',
                        'code_template' => "<!{0} html>\n<html>\n<{1}>\n    <title>Web Pertama</title>\n</{1}>\n<{2}>\n    <h1>Halo!</h1>\n</{2}>\n</html>",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'DOCTYPE', '{1}' => 'head', '{2}' => 'body']
                    ],
                    [
                        'instruction' => 'Lengkapi elemen HTML untuk membuat link dan gambar.',
                        'code_template' => "<{0} href=\"https://google.com\">Buka Google</{0}>\n<{1} src=\"foto.jpg\" {2}=\"Deskripsi gambar\">",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'a', '{1}' => 'img', '{2}' => 'alt']
                    ],
                    [
                        'instruction' => 'Lengkapi elemen semantik HTML5 berikut.',
                        'code_template' => "<{0}>\n    <nav>Menu navigasi</nav>\n</{0}>\n<{1}>\n    <article>Konten utama</article>\n</{1}>\n<{2}>\n    <p>Copyright 2026</p>\n</{2}>",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'header', '{1}' => 'main', '{2}' => 'footer']
                    ],
                ]
            ],

            // 11. CSS Dasar: Selector & Properti
            [
                'title' => 'CSS Dasar: Selector & Properti',
                'description' => 'Memahami selector CSS, properti styling, box model, dan cara menghubungkan CSS ke HTML.',
                'content' => '<h2>Apa itu CSS?</h2><p>CSS (Cascading Style Sheets) digunakan untuk mengatur tampilan elemen HTML. Ada 3 cara menautkan CSS:</p><ul><li><strong>Inline</strong>: langsung di atribut style — <code>&lt;p style="color: red;"&gt;</code></li><li><strong>Internal</strong>: di tag <code>&lt;style&gt;</code> dalam <code>&lt;head&gt;</code></li><li><strong>External</strong>: file .css terpisah — <code>&lt;link rel="stylesheet" href="style.css"&gt;</code> (RECOMMENDED)</li></ul>

<h2>Selector CSS</h2><p>Selector menentukan elemen mana yang akan di-style:</p><pre><code>/* Element Selector — memilih semua elemen h1 */
h1 { color: blue; font-size: 24px; }

/* Class Selector — memilih elemen dengan class tertentu */
.container { max-width: 960px; margin: 0 auto; }
.highlight { background-color: yellow; }

/* ID Selector — memilih elemen dengan ID tertentu (unik) */
#header { background-color: #333; color: white; }

/* Descendant Selector */
.container p { color: gray; }

/* Pseudo-class */
a:hover { color: red; text-decoration: underline; }
button:active { transform: scale(0.95); }

/* Pseudo-element */
p::first-line { font-weight: bold; }
h2::before { content: "→ "; }</code></pre>

<h2>Box Model</h2><p>Setiap elemen HTML terdiri dari lapisan: <strong>Content → Padding → Border → Margin</strong></p><pre><code>.box {
    width: 300px;
    padding: 20px;        /* jarak konten ke border */
    border: 2px solid #333; /* garis pembatas */
    margin: 16px;          /* jarak elemen ke elemen lain */

    /* Box sizing agar padding tidak menambah width */
    box-sizing: border-box;
}

/* Total width TANPA border-box: 300 + 40 + 4 = 344px */
/* Total width DENGAN border-box: 300px (padding masuk ke dalam) */</code></pre>

<h2>Properti Styling Umum</h2><pre><code>/* Typography */
.text {
    font-family: \'Inter\', sans-serif;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.6;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #333;
}

/* Background */
.card {
    background-color: #f5f5f5;
    background-image: url(\'bg.jpg\');
    background-size: cover;
    background-position: center;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Display & Position */
.element {
    display: block;       /* block, inline, inline-block, flex, grid */
    position: relative;   /* static, relative, absolute, fixed, sticky */
    top: 10px;
    overflow: hidden;
    z-index: 10;
    opacity: 0.8;
    cursor: pointer;
    transition: all 0.3s ease;
}</code></pre>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 102,
                'icon' => 'color-swatch',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi CSS selector berikut.',
                        'code_template' => "/* Selector class */\n{0}judul {\n    color: red;\n}\n\n/* Selector id */\n{1}konten {\n    background-color: white;\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '.', '{1}' => '#']
                    ],
                    [
                        'instruction' => 'Lengkapi properti Box Model berikut.',
                        'code_template' => ".box {\n    {0}: 20px;         /* jarak konten ke border */\n    {1}: 2px solid #333; /* garis pembatas */\n    {2}: 16px;          /* jarak ke elemen lain */\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'padding', '{1}' => 'border', '{2}' => 'margin']
                    ],
                ]
            ],

            // 12. Responsive Design & Flexbox
            [
                'title' => 'Responsive Design & Flexbox',
                'description' => 'Membuat layout halaman web responsif menggunakan CSS Flexbox dan Media Queries.',
                'content' => '<h2>Flexbox Layout</h2><p>Flexbox adalah metode layout CSS modern yang memudahkan pengaturan elemen secara horizontal atau vertikal dalam satu dimensi.</p><pre><code>.container {
    display: flex;
    justify-content: center;  /* horizontal alignment */
    align-items: center;      /* vertical alignment */
    gap: 16px;                /* jarak antar item */
    flex-wrap: wrap;          /* item wrap ke baris baru */
}

.item {
    flex: 1;                  /* semua item sama lebar */
    min-width: 250px;         /* lebar minimum */
}</code></pre><p>Properti Flex Container:</p><ul><li><code>flex-direction</code>: row | column | row-reverse | column-reverse</li><li><code>justify-content</code>: flex-start | center | flex-end | space-between | space-around | space-evenly</li><li><code>align-items</code>: flex-start | center | flex-end | stretch | baseline</li></ul>

<h2>CSS Grid Layout</h2><p>Grid adalah layout 2 dimensi (baris dan kolom) yang lebih powerful untuk layout kompleks:</p><pre><code>.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);  /* 3 kolom sama rata */
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    padding: 20px;
}

/* Grid area untuk layout kompleks */
.layout {
    display: grid;
    grid-template-areas:
        "header header header"
        "sidebar main main"
        "footer footer footer";
    grid-template-columns: 250px 1fr 1fr;
}
.header  { grid-area: header; }
.sidebar { grid-area: sidebar; }
.main    { grid-area: main; }
.footer  { grid-area: footer; }</code></pre>

<h2>Media Queries</h2><p>Media queries membuat halaman responsif di berbagai ukuran layar:</p><pre><code>/* Mobile First Approach */
.container {
    flex-direction: column;
    padding: 16px;
}

/* Tablet (768px ke atas) */
@media (min-width: 768px) {
    .container {
        flex-direction: row;
        padding: 24px;
    }
}

/* Desktop (1024px ke atas) */
@media (min-width: 1024px) {
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px;
    }
}

/* Breakpoint umum:
   Mobile: < 768px
   Tablet: 768px - 1023px
   Desktop: >= 1024px
   Large: >= 1280px */</code></pre>

<h2>Viewport & Responsive Units</h2><p>Unit-unit CSS yang berguna untuk responsive design:</p><pre><code>/* Viewport units */
.hero {
    width: 100vw;     /* 100% viewport width */
    height: 100vh;    /* 100% viewport height */
}

/* Relative units */
.text {
    font-size: 1rem;     /* relatif ke root font-size */
    font-size: 1.2em;    /* relatif ke parent font-size */
    width: 50%;          /* relatif ke parent width */
}

/* Clamp - min, preferred, max */
.title {
    font-size: clamp(1.5rem, 4vw, 3rem);
}

/* Container queries (modern) */
@container (min-width: 400px) {
    .card { flex-direction: row; }
}</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 35,
                'order' => 103,
                'icon' => 'device-mobile',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi properti Flexbox berikut.',
                        'code_template' => ".container {\n    display: {0};\n    justify-content: {1};\n    align-items: {2};\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'flex', '{1}' => 'center', '{2}' => 'center']
                    ],
                    [
                        'instruction' => 'Lengkapi media query untuk tablet (min 768px).',
                        'code_template' => "@{0} ({1}: 768px) {\n    .container {\n        flex-direction: row;\n    }\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'media', '{1}' => 'min-width']
                    ],
                ]
            ],

            // 13. JavaScript Dasar: Variabel & Tipe Data
            [
                'title' => 'JavaScript Dasar: Variabel & Tipe Data',
                'description' => 'Fondasi pemrograman JavaScript: variabel, tipe data, operator, dan percabangan.',
                'content' => '<h2>Variabel di JavaScript</h2><p>JavaScript memiliki 3 cara mendeklarasikan variabel:</p><pre><code>var nama = "Budi";     // cara lama (hindari - function scoped)
let umur = 17;         // bisa diubah nilainya (block scoped)
const PI = 3.14;       // tidak bisa diubah (block scoped)

// let vs const:
let skor = 0;
skor = 100;     // ✅ OK, let bisa diubah

const MAX = 100;
MAX = 200;      // ❌ Error! const tidak bisa diubah</code></pre>

<h2>Tipe Data</h2><p>JavaScript memiliki tipe data primitif dan non-primitif:</p><pre><code>// Primitif
let str = "Hello";        // String
let num = 42;             // Number
let dec = 3.14;           // Number (no int/float distinction)
let bool = true;          // Boolean
let kosong = null;        // Null (sengaja kosong)
let belumAda;             // Undefined
let simbol = Symbol();    // Symbol (ES6)

// Non-Primitif
let arr = [1, 2, 3];                    // Array
let obj = { nama: "Budi", umur: 17 };   // Object

// Cek tipe data
console.log(typeof str);    // "string"
console.log(typeof num);    // "number"
console.log(typeof bool);   // "boolean"
console.log(typeof arr);    // "object" (array is object!)
console.log(Array.isArray(arr)); // true</code></pre>

<h2>Operator & Percabangan</h2><pre><code>// Operator Aritmatika
let hasil = 10 + 5;   // 15
let sisa = 10 % 3;    // 1 (modulus)
let pangkat = 2 ** 3;  // 8 (exponentiation)

// Operator Perbandingan
10 == "10"    // true  (loose equality)
10 === "10"   // false (strict equality - RECOMMENDED!)
10 !== "10"   // true

// Percabangan if/else
if (umur >= 17) {
    console.log("Boleh buat SIM");
} else if (umur >= 12) {
    console.log("Remaja");
} else {
    console.log("Anak-anak");
}

// Ternary Operator
let status = umur >= 17 ? "Dewasa" : "Anak";

// Switch
switch (hari) {
    case "Senin": console.log("Semangat!"); break;
    case "Jumat": console.log("TGIF!"); break;
    default: console.log("Hari biasa");
}</code></pre>

<h2>Perulangan (Loops)</h2><pre><code>// For loop
for (let i = 0; i < 5; i++) {
    console.log(`Iterasi ${i}`);
}

// While loop
let count = 0;
while (count < 3) {
    console.log(count);
    count++;
}

// For...of (untuk array)
const buah = ["Apel", "Mangga", "Jeruk"];
for (const b of buah) {
    console.log(b);
}

// For...in (untuk object)
const siswa = { nama: "Budi", kelas: "XII" };
for (const key in siswa) {
    console.log(`${key}: ${siswa[key]}`);
}

// Array.forEach()
buah.forEach((item, index) => {
    console.log(`${index}: ${item}`);
});</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 104,
                'icon' => 'lightning',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi deklarasi variabel JavaScript berikut.',
                        'code_template' => "// Variabel yang nilainya bisa berubah\n{0} nama = \"Budi\";\n\n// Variabel konstan\n{1} MAX_SCORE = 100;\n\n// Menampilkan ke console\nconsole.{2}(nama);",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'let', '{1}' => 'const', '{2}' => 'log']
                    ],
                    [
                        'instruction' => 'Lengkapi operator perbandingan yang tepat.',
                        'code_template' => "// Strict equality (tipe dan nilai sama)\n10 {0} 10    // true\n10 {0} \"10\"  // false\n\n// Strict inequality\n10 {1} \"10\"  // true",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '===', '{1}' => '!==']
                    ],
                    [
                        'instruction' => 'Lengkapi perulangan JavaScript berikut.',
                        'code_template' => "const buah = [\"Apel\", \"Mangga\", \"Jeruk\"];\n\n// For...of loop\n{0} (const b {1} buah) {\n    console.log(b);\n}\n\n// forEach\nbuah.{2}((item) => {\n    console.log(item);\n});",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'for', '{1}' => 'of', '{2}' => 'forEach']
                    ],
                ]
            ],

            // 14. JavaScript: Fungsi & Array Methods
            [
                'title' => 'JavaScript: Fungsi & Array Methods',
                'description' => 'Menguasai fungsi, arrow function, dan metode array modern seperti map, filter, dan reduce.',
                'content' => '<h2>Fungsi di JavaScript</h2><pre><code>// Function Declaration
function sapa(nama) {
    return "Halo, " + nama;
}

// Function Expression
const sapa2 = function(nama) {
    return `Halo, ${nama}`;
};

// Arrow Function (ES6) - RECOMMENDED
const sapa3 = (nama) => `Halo, ${nama}`;

// Arrow function dengan body
const hitungLuas = (p, l) => {
    const luas = p * l;
    return luas;
};

// Default Parameter
const greeting = (nama, sapaan = "Halo") => {
    return `${sapaan}, ${nama}!`;
};
console.log(greeting("Budi"));           // "Halo, Budi!"
console.log(greeting("Budi", "Hi"));     // "Hi, Budi!"</code></pre>

<h2>Array Methods Modern</h2><pre><code>const angka = [1, 2, 3, 4, 5];

// filter: ambil elemen yang memenuhi kondisi
const genap = angka.filter(n => n % 2 === 0);
// [2, 4]

// map: transformasi setiap elemen
const kali2 = angka.map(n => n * 2);
// [2, 4, 6, 8, 10]

// reduce: akumulasi menjadi satu nilai
const total = angka.reduce((acc, n) => acc + n, 0);
// 15

// find: cari elemen pertama yang cocok
const found = angka.find(n => n > 3);
// 4

// some: apakah ada yang memenuhi kondisi?
const adaGenap = angka.some(n => n % 2 === 0);
// true

// every: apakah semua memenuhi kondisi?
const semuaPositif = angka.every(n => n > 0);
// true

// includes: apakah mengandung nilai?
angka.includes(3); // true

// sort: urutkan
const sorted = [...angka].sort((a, b) => b - a);
// [5, 4, 3, 2, 1]</code></pre>

<h2>Chaining Methods</h2><p>Array methods bisa digabungkan (chaining) untuk operasi kompleks:</p><pre><code>const siswa = [
    { nama: "Adi", nilai: 80 },
    { nama: "Budi", nilai: 65 },
    { nama: "Citra", nilai: 90 },
    { nama: "Dina", nilai: 55 },
    { nama: "Eka", nilai: 75 },
];

// Ambil nama siswa yang lulus (nilai >= 70), diurutkan dari yang tertinggi
const hasilLulus = siswa
    .filter(s => s.nilai >= 70)        // filter yang lulus
    .sort((a, b) => b.nilai - a.nilai)  // sort descending
    .map(s => `${s.nama} (${s.nilai})`); // format string

console.log(hasilLulus);
// ["Citra (90)", "Adi (80)", "Eka (75)"]</code></pre>

<h2>Destructuring & Spread</h2><pre><code>// Object Destructuring
const user = { nama: "Budi", umur: 17, kelas: "XII" };
const { nama, umur } = user;
console.log(nama); // "Budi"

// Array Destructuring
const [first, second, ...rest] = [1, 2, 3, 4, 5];
console.log(rest); // [3, 4, 5]

// Spread Operator
const arr1 = [1, 2, 3];
const arr2 = [...arr1, 4, 5]; // [1, 2, 3, 4, 5]

// Clone object dengan override
const updatedUser = { ...user, umur: 18 };</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 40,
                'order' => 105,
                'icon' => 'cog',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode array methods berikut.',
                        'code_template' => "const nilai = [80, 65, 90, 55, 75];\n\n// Ambil nilai di atas 70\nconst lulus = nilai.{0}(n => n > 70);\n\n// Kalikan semua nilai dengan 1.1\nconst bonus = nilai.{1}(n => n * 1.1);",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'filter', '{1}' => 'map']
                    ],
                    [
                        'instruction' => 'Lengkapi kode reduce dan find berikut.',
                        'code_template' => "const angka = [10, 20, 30, 40];\n\n// Jumlahkan semua angka\nconst total = angka.{0}((acc, n) => acc + n, 0);\n\n// Cari angka pertama yang > 25\nconst found = angka.{1}(n => n > 25);",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'reduce', '{1}' => 'find']
                    ],
                ]
            ],

            // 15. DOM Manipulation & Event Handling
            [
                'title' => 'DOM Manipulation & Event Handling',
                'description' => 'Memanipulasi elemen HTML menggunakan JavaScript DOM API dan menangani event pengguna.',
                'content' => '<h2>Apa itu DOM?</h2><p>DOM (Document Object Model) adalah representasi terstruktur dari dokumen HTML. JavaScript menggunakannya untuk mengakses dan memanipulasi elemen HTML secara dinamis.</p><pre><code>// Mengambil elemen
const judul = document.getElementById("judul");
const items = document.querySelectorAll(".item");
const firstItem = document.querySelector(".item");

// Mengubah konten
judul.textContent = "Judul Baru";     // teks saja
judul.innerHTML = "&lt;em&gt;Judul Baru&lt;/em&gt;"; // bisa HTML

// Mengubah style
judul.style.color = "blue";
judul.style.fontSize = "24px";

// Mengubah atribut
const img = document.querySelector("img");
img.setAttribute("src", "foto-baru.jpg");
img.getAttribute("alt");</code></pre>

<h2>Manipulasi Class & Elemen</h2><pre><code>// Class manipulation
const card = document.querySelector(".card");
card.classList.add("active");
card.classList.remove("hidden");
card.classList.toggle("expanded");
card.classList.contains("active"); // true

// Membuat dan menambah elemen baru
const newP = document.createElement("p");
newP.textContent = "Paragraf baru";
newP.classList.add("text-bold");
document.body.appendChild(newP);

// Insert di posisi tertentu
const container = document.getElementById("container");
container.insertBefore(newP, container.firstChild);

// Menghapus elemen
const oldElement = document.getElementById("hapus");
oldElement.remove();
// atau parent.removeChild(oldElement);</code></pre>

<h2>Event Listener</h2><pre><code>const tombol = document.getElementById("btn");

// Click event
tombol.addEventListener("click", function(event) {
    alert("Tombol diklik!");
    console.log(event.target); // elemen yang diklik
});

// Arrow function
tombol.addEventListener("click", (e) => {
    e.preventDefault(); // mencegah default behavior
    console.log("Clicked!");
});

// Event umum lainnya:
// "mouseover" - mouse masuk ke elemen
// "mouseout"  - mouse keluar dari elemen
// "keydown"   - tombol keyboard ditekan
// "keyup"     - tombol keyboard dilepas
// "submit"    - form di-submit
// "input"     - input field berubah
// "change"    - select/checkbox berubah
// "scroll"    - halaman di-scroll
// "load"      - halaman selesai dimuat

// Event delegation (efisien)
document.querySelector("ul").addEventListener("click", (e) => {
    if (e.target.tagName === "LI") {
        console.log("Li diklik:", e.target.textContent);
    }
});</code></pre>

<h2>Contoh Praktis: Todo List</h2><pre><code>const input = document.getElementById("todoInput");
const list = document.getElementById("todoList");
const addBtn = document.getElementById("addBtn");

addBtn.addEventListener("click", () => {
    const text = input.value.trim();
    if (!text) return;

    // Buat elemen li baru
    const li = document.createElement("li");
    li.textContent = text;

    // Tambahkan tombol hapus
    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "×";
    deleteBtn.addEventListener("click", () => li.remove());

    li.appendChild(deleteBtn);
    list.appendChild(li);
    input.value = ""; // reset input
});</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 106,
                'icon' => 'cursor',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode DOM manipulation berikut.',
                        'code_template' => "// Ambil elemen berdasarkan ID\nconst judul = document.{0}(\"judul\");\n\n// Ubah teks\njudul.{1} = \"Selamat Datang\";\n\n// Tambah event listener klik\njudul.{2}(\"click\", function() {\n    alert(\"Diklik!\");\n});",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'getElementById', '{1}' => 'textContent', '{2}' => 'addEventListener']
                    ],
                    [
                        'instruction' => 'Lengkapi kode untuk membuat elemen baru.',
                        'code_template' => "// Buat elemen paragraf\nconst p = document.{0}(\"p\");\np.textContent = \"Halo!\";\n\n// Tambahkan ke body\ndocument.body.{1}(p);\n\n// Hapus elemen\np.{2}();",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'createElement', '{1}' => 'appendChild', '{2}' => 'remove']
                    ],
                ]
            ],

            // 16. Python Dasar
            [
                'title' => 'Python Dasar: Sintaks & Struktur Data',
                'description' => 'Fondasi pemrograman Python: variabel, tipe data, list, dictionary, dan kontrol alur.',
                'content' => '<h2>Mengapa Python?</h2><p>Python adalah bahasa pemrograman yang mudah dipelajari dengan sintaks yang bersih. Python digunakan dalam web development, data science, AI, otomasi, dan banyak lagi.</p>

<h2>Variabel & Tipe Data</h2><pre><code>nama = "Budi"          # string
umur = 17               # integer
tinggi = 170.5          # float
aktif = True            # boolean

# Python tidak perlu deklarasi tipe!
# Tipe otomatis berdasarkan nilai

# String operations
sapaan = f"Halo, {nama}!"      # f-string (recommended)
sapaan2 = "Halo, " + nama      # concatenation
panjang = len(nama)              # 4

# Type conversion
angka_str = str(42)              # "42"
angka_int = int("42")            # 42
angka_float = float("3.14")     # 3.14</code></pre>

<h2>List, Tuple & Dictionary</h2><pre><code># List (mutable - bisa diubah)
nilai = [80, 90, 75, 85]
nilai.append(95)          # tambah di akhir
nilai.insert(0, 100)      # sisipkan di index 0
nilai.pop()               # hapus elemen terakhir
nilai.sort()              # urutkan
print(len(nilai))         # panjang list
print(nilai[0])           # akses index pertama
print(nilai[-1])          # akses index terakhir

# Tuple (immutable - tidak bisa diubah)
koordinat = (10, 20)
x, y = koordinat          # unpacking

# Dictionary (key-value pairs)
siswa = {
    "nama": "Budi",
    "kelas": "XII RPL",
    "nilai": 90
}
print(siswa["nama"])       # akses value
siswa["email"] = "b@mail.com"  # tambah key baru
del siswa["email"]         # hapus key

# Set (nilai unik, tanpa urutan)
buah = {"apel", "mangga", "apel"}
print(buah)  # {"apel", "mangga"}</code></pre>

<h2>Percabangan & Perulangan</h2><pre><code># If / elif / else
if umur >= 17:
    print("Dewasa")
elif umur >= 12:
    print("Remaja")
else:
    print("Anak-anak")

# For loop
for i in range(5):
    print(f"Iterasi {i}")

for item in nilai:
    print(item)

# While loop
count = 0
while count < 3:
    print(count)
    count += 1

# List comprehension (pythonic!)
genap = [x for x in range(10) if x % 2 == 0]
# [0, 2, 4, 6, 8]

kuadrat = [x**2 for x in range(5)]
# [0, 1, 4, 9, 16]</code></pre>

<h2>Input & Output</h2><pre><code># Input dari user
nama = input("Masukkan nama: ")
umur = int(input("Masukkan umur: "))

# Output
print("Halo,", nama)
print(f"Umur kamu {umur} tahun")

# Format string
print("Nama: {}, Umur: {}".format(nama, umur))
print(f"Nama: {nama}, Umur: {umur}")  # f-string</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 107,
                'icon' => 'beaker',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode Python berikut.',
                        'code_template' => "# Membuat list\nnilai = [80, 90, 75]\n\n# Menambah elemen ke list\nnilai.{0}(85)\n\n# Percabangan\nif nilai[0] >= 75:\n    {1}(\"Lulus\")\n{2}:\n    print(\"Tidak Lulus\")",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'append', '{1}' => 'print', '{2}' => 'else']
                    ],
                    [
                        'instruction' => 'Lengkapi kode dictionary Python berikut.',
                        'code_template' => "# Membuat dictionary\nsiswa = {\n    \"nama\": \"Budi\",\n    \"kelas\": \"XII RPL\"\n}\n\n# Akses value\nprint(siswa[\"{0}\"])\n\n# Panjang dictionary\nprint({1}(siswa))\n\n# Tambah key baru\nsiswa[\"{2}\"] = 90",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'nama', '{1}' => 'len', '{2}' => 'nilai']
                    ],
                ]
            ],

            // 17. Python: Fungsi & Modul
            [
                'title' => 'Python: Fungsi & Modul',
                'description' => 'Membuat fungsi reusable, menggunakan parameter, return value, dan mengimpor modul.',
                'content' => '<h2>Fungsi di Python</h2><pre><code>def hitung_luas(panjang, lebar):
    """Menghitung luas persegi panjang"""
    return panjang * lebar

luas = hitung_luas(10, 5)
print(f"Luas: {luas}")  # Luas: 50</code></pre>

<h2>Parameter & Return</h2><pre><code># Parameter default
def sapa(nama, sapaan="Halo"):
    return f"{sapaan}, {nama}!"

print(sapa("Budi"))             # Halo, Budi!
print(sapa("Budi", "Selamat"))  # Selamat, Budi!

# *args (positional arguments variable)
def total(*angka):
    return sum(angka)

print(total(1, 2, 3, 4))  # 10

# **kwargs (keyword arguments variable)
def info(**data):
    for key, value in data.items():
        print(f"{key}: {value}")

info(nama="Budi", kelas="XII", hobi="coding")

# Multiple return values
def min_max(numbers):
    return min(numbers), max(numbers)

low, high = min_max([3, 1, 4, 1, 5])
print(f"Min: {low}, Max: {high}")</code></pre>

<h2>Lambda & Higher-Order Functions</h2><pre><code># Lambda (anonymous function)
kuadrat = lambda x: x ** 2
print(kuadrat(5))  # 25

# Map, Filter, Sorted dengan lambda
angka = [1, 2, 3, 4, 5]
genap = list(filter(lambda x: x % 2 == 0, angka))
kali = list(map(lambda x: x * 3, angka))

# Sorted dengan key
siswa = [("Citra", 90), ("Adi", 80), ("Budi", 85)]
by_nilai = sorted(siswa, key=lambda s: s[1], reverse=True)
print(by_nilai)  # [("Citra", 90), ("Budi", 85), ("Adi", 80)]</code></pre>

<h2>Import Modul</h2><pre><code>import math
print(math.sqrt(144))  # 12.0
print(math.pi)         # 3.14159...

from random import randint, choice
print(randint(1, 100))
print(choice(["merah", "hijau", "biru"]))

from datetime import datetime
now = datetime.now()
print(now.strftime("%d/%m/%Y %H:%M"))

# Import module sendiri
# file: utils.py
# def hitung(x): return x * 2
# 
# file: main.py
# from utils import hitung
# print(hitung(5))  # 10</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 35,
                'order' => 108,
                'icon' => 'cube',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode fungsi Python berikut.',
                        'code_template' => "# Definisi fungsi\n{0} luas_segitiga(alas, tinggi):\n    {1} (alas * tinggi) / 2\n\n# Panggil fungsi\nhasil = luas_segitiga(10, 5)\n{2}(f\"Luas: {hasil}\")",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'def', '{1}' => 'return', '{2}' => 'print']
                    ],
                    [
                        'instruction' => 'Lengkapi import modul Python berikut.',
                        'code_template' => "{0} math\nprint(math.{1}(144))  # 12.0\n\n{2} random import randint\nprint(randint(1, 100))",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'import', '{1}' => 'sqrt', '{2}' => 'from']
                    ],
                ]
            ],

            // 18. Python OOP
            [
                'title' => 'Python OOP: Class & Inheritance',
                'description' => 'Pemrograman berorientasi objek di Python: class, constructor, inheritance, dan encapsulation.',
                'content' => '<h2>Class di Python</h2><pre><code>class Siswa:
    def __init__(self, nama, kelas):
        self.nama = nama
        self.kelas = kelas
        self.nilai = []

    def tambah_nilai(self, n):
        self.nilai.append(n)

    def rata_rata(self):
        if not self.nilai:
            return 0
        return sum(self.nilai) / len(self.nilai)

    def perkenalan(self):
        return f"Nama saya {self.nama} dari kelas {self.kelas}"

budi = Siswa("Budi", "XII RPL")
budi.tambah_nilai(80)
budi.tambah_nilai(90)
print(budi.perkenalan())
print(f"Rata-rata: {budi.rata_rata()}")</code></pre>

<h2>Inheritance (Pewarisan)</h2><pre><code>class KetuaKelas(Siswa):
    def __init__(self, nama, kelas, jabatan):
        super().__init__(nama, kelas)
        self.jabatan = jabatan

    def info(self):
        return f"{self.perkenalan()}, jabatan: {self.jabatan}"

ketua = KetuaKelas("Citra", "XII RPL", "Ketua Kelas")
print(ketua.info())</code></pre>

<h2>Encapsulation & Property</h2><pre><code>class BankAccount:
    def __init__(self, pemilik, saldo=0):
        self.pemilik = pemilik
        self.__saldo = saldo    # private attribute (name mangling)

    @property
    def saldo(self):
        return self.__saldo

    def deposit(self, jumlah):
        if jumlah > 0:
            self.__saldo += jumlah
            return f"Deposit {jumlah}. Saldo: {self.__saldo}"
        return "Jumlah harus positif"

    def withdraw(self, jumlah):
        if jumlah > self.__saldo:
            return "Saldo tidak cukup"
        self.__saldo -= jumlah
        return f"Withdraw {jumlah}. Sisa: {self.__saldo}"

akun = BankAccount("Budi", 1000)
print(akun.saldo)        # 1000
print(akun.deposit(500)) # Deposit 500. Saldo: 1500</code></pre>

<h2>Magic Methods & Polymorphism</h2><pre><code>class Vektor:
    def __init__(self, x, y):
        self.x = x
        self.y = y

    def __str__(self):
        return f"Vektor({self.x}, {self.y})"

    def __add__(self, other):
        return Vektor(self.x + other.x, self.y + other.y)

    def __len__(self):
        return int((self.x**2 + self.y**2) ** 0.5)

v1 = Vektor(3, 4)
v2 = Vektor(1, 2)
v3 = v1 + v2
print(v3)       # Vektor(4, 6)
print(len(v1))  # 5</code></pre>',
                'level' => 'advanced',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 50,
                'order' => 109,
                'icon' => 'puzzle',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode OOP Python berikut.',
                        'code_template' => "{0} Hewan:\n    def {1}(self, nama, jenis):\n        self.nama = nama\n        self.jenis = jenis\n\n    def suara(self):\n        return f\"{self.nama} bersuara!\"\n\nkucing = Hewan(\"Kitty\", \"Kucing\")\nprint(kucing.{2}())",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'class', '{1}' => '__init__', '{2}' => 'suara']
                    ],
                    [
                        'instruction' => 'Lengkapi kode inheritance Python berikut.',
                        'code_template' => "class Kucing(Hewan):\n    def __init__(self, nama):\n        {0}().__init__(nama, \"Kucing\")\n\n    def suara(self):\n        {1} f\"{self.nama} bilang Meow!\"",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'super', '{1}' => 'return']
                    ],
                ]
            ],

            // 19. Java Dasar
            [
                'title' => 'Java Dasar: Sintaks & OOP Fundamentals',
                'description' => 'Memahami struktur program Java, tipe data, class, dan method dasar.',
                'content' => '<h2>Program Java Pertama</h2><p>Java adalah bahasa pemrograman berorientasi objek yang bersifat "Write Once, Run Anywhere". Kode Java dikompilasi menjadi bytecode yang berjalan di JVM (Java Virtual Machine).</p><pre><code>public class HelloWorld {
    public static void main(String[] args) {
        String nama = "Budi";
        int umur = 17;

        System.out.println("Halo, " + nama);
        System.out.println("Umur: " + umur);
    }
}</code></pre>

<h2>Tipe Data & Variabel</h2><pre><code>// Tipe Data Primitif
int bilangan = 42;
double desimal = 3.14;
boolean aktif = true;
char huruf = \'A\';

// Reference Type
String teks = "Hello Java";
int[] angka = {10, 20, 30, 40};

// Konstanta
final double PI = 3.14159;

// Type casting
int i = (int) 3.7;    // 3 (explicit cast)
double d = 42;          // 42.0 (implicit cast)

// Input dari user
import java.util.Scanner;
Scanner sc = new Scanner(System.in);
System.out.print("Nama: ");
String input = sc.nextLine();
int num = sc.nextInt();</code></pre>

<h2>Percabangan & Perulangan</h2><pre><code>// If-else
if (umur >= 17) {
    System.out.println("Dewasa");
} else if (umur >= 12) {
    System.out.println("Remaja");
} else {
    System.out.println("Anak");
}

// Switch
switch (hari) {
    case "Senin": System.out.println("Semangat!"); break;
    case "Jumat": System.out.println("TGIF!"); break;
    default: System.out.println("Hari biasa");
}

// For loop
for (int i = 0; i < 5; i++) {
    System.out.println("Iterasi " + i);
}

// Enhanced for (foreach)
String[] buah = {"Apel", "Mangga", "Jeruk"};
for (String b : buah) {
    System.out.println(b);
}

// While loop
int count = 0;
while (count < 3) {
    System.out.println(count);
    count++;
}</code></pre>

<h2>Array & ArrayList</h2><pre><code>// Array (fixed size)
int[] nilai = new int[5];
nilai[0] = 80;

// ArrayList (dynamic size)
import java.util.ArrayList;
ArrayList<String> siswa = new ArrayList<>();
siswa.add("Budi");
siswa.add("Citra");
siswa.remove("Budi");
System.out.println(siswa.size());    // 1
System.out.println(siswa.get(0));    // Citra</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 30,
                'order' => 110,
                'icon' => 'chip',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi program Java berikut agar bisa menampilkan output.',
                        'code_template' => "public {0} Main {\n    public static void {1}(String[] args) {\n        String pesan = \"Hello RPL!\";\n        System.out.{2}(pesan);\n    }\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'class', '{1}' => 'main', '{2}' => 'println']
                    ],
                    [
                        'instruction' => 'Lengkapi kode enhanced for loop Java berikut.',
                        'code_template' => "String[] buah = {\"Apel\", \"Mangga\", \"Jeruk\"};\n{0} (String b : buah) {\n    System.out.println(b);\n}",
                        'blanks' => ['{0}'],
                        'answers' => ['{0}' => 'for']
                    ],
                ]
            ],

            // 20. Java: Class, Constructor & Encapsulation
            [
                'title' => 'Java: Class, Constructor & Encapsulation',
                'description' => 'Mendalami OOP di Java: membuat class, constructor, getter/setter, dan access modifier.',
                'content' => '<h2>Class & Object</h2><pre><code>public class Siswa {
    private String nama;
    private int nilai;

    // Constructor
    public Siswa(String nama, int nilai) {
        this.nama = nama;
        this.nilai = nilai;
    }

    // Getter
    public String getNama() { return nama; }
    public int getNilai() { return nilai; }

    // Setter
    public void setNilai(int nilai) {
        if (nilai >= 0 && nilai <= 100) {
            this.nilai = nilai;
        }
    }

    public String info() {
        return nama + " - Nilai: " + nilai;
    }
}

// Membuat Object
Siswa s = new Siswa("Budi", 90);
System.out.println(s.info());</code></pre>

<h2>Access Modifier</h2><p>Java memiliki 4 access modifier untuk mengontrol visibilitas:</p><ul><li><code>public</code> — Bisa diakses dari mana saja</li><li><code>private</code> — Hanya bisa diakses dalam class yang sama</li><li><code>protected</code> — Bisa diakses dalam package dan subclass</li><li><code>default</code> (tanpa modifier) — Hanya dalam package yang sama</li></ul>

<h2>Static Members</h2><pre><code>public class Counter {
    private static int count = 0;  // shared by all objects

    public Counter() {
        count++;
    }

    public static int getCount() {
        return count;
    }
}

new Counter();
new Counter();
System.out.println(Counter.getCount()); // 2</code></pre>

<h2>Constructor Overloading</h2><pre><code>public class Mobil {
    private String merk;
    private int tahun;
    private String warna;

    // Constructor 1
    public Mobil(String merk) {
        this(merk, 2024, "Hitam");
    }

    // Constructor 2
    public Mobil(String merk, int tahun) {
        this(merk, tahun, "Hitam");
    }

    // Constructor 3 (full)
    public Mobil(String merk, int tahun, String warna) {
        this.merk = merk;
        this.tahun = tahun;
        this.warna = warna;
    }
}

Mobil m1 = new Mobil("Toyota");
Mobil m2 = new Mobil("Honda", 2023);
Mobil m3 = new Mobil("BMW", 2025, "Merah");</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 111,
                'icon' => 'key',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi class Java dengan encapsulation berikut.',
                        'code_template' => "public class Mobil {\n    {0} String merk;\n\n    public Mobil(String merk) {\n        {1}.merk = merk;\n    }\n\n    public String getMerk() {\n        {2} merk;\n    }\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'private', '{1}' => 'this', '{2}' => 'return']
                    ],
                    [
                        'instruction' => 'Lengkapi kode static member Java berikut.',
                        'code_template' => "public class Counter {\n    private {0} int count = 0;\n\n    public Counter() {\n        count++;\n    }\n\n    public {0} int getCount() {\n        return {1};\n    }\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'static', '{1}' => 'count']
                    ],
                ]
            ],

            // 21. Java: Inheritance & Polymorphism
            [
                'title' => 'Java: Inheritance & Polymorphism',
                'description' => 'Konsep pewarisan dan polimorfisme di Java: extends, super, override, dan interface.',
                'content' => '<h2>Inheritance</h2><pre><code>public class Hewan {
    protected String nama;

    public Hewan(String nama) {
        this.nama = nama;
    }

    public String suara() {
        return "...";
    }
}

public class Kucing extends Hewan {
    public Kucing(String nama) {
        super(nama);
    }

    @Override
    public String suara() {
        return "Meow!";
    }
}</code></pre>

<h2>Polymorphism</h2><pre><code>// Parent reference can hold child object
Hewan h1 = new Kucing("Kitty");
Hewan h2 = new Anjing("Bobby");

// Method yang dipanggil sesuai tipe asli object
System.out.println(h1.suara()); // "Meow!"
System.out.println(h2.suara()); // "Woof!"

// Array polimorfik
Hewan[] kebunBinatang = {
    new Kucing("Kitty"),
    new Anjing("Bobby"),
    new Burung("Tweety")
};
for (Hewan h : kebunBinatang) {
    System.out.println(h.nama + ": " + h.suara());
}</code></pre>

<h2>Abstract Class</h2><pre><code>public abstract class Shape {
    protected String name;

    public Shape(String name) {
        this.name = name;
    }

    // Method abstrak - HARUS diimplementasikan oleh subclass
    public abstract double area();

    // Method biasa - bisa langsung dipakai
    public String info() {
        return name + " area: " + area();
    }
}

public class Circle extends Shape {
    private double radius;

    public Circle(double radius) {
        super("Circle");
        this.radius = radius;
    }

    @Override
    public double area() {
        return Math.PI * radius * radius;
    }
}</code></pre>

<h2>Interface</h2><pre><code>public interface Drawable {
    void draw();
    default void info() {
        System.out.println("This is drawable");
    }
}

public interface Resizable {
    void resize(double factor);
}

// Implementasi multiple interface
public class Rectangle implements Drawable, Resizable {
    private double w, h;

    @Override
    public void draw() {
        System.out.println("Drawing rectangle " + w + "x" + h);
    }

    @Override
    public void resize(double factor) {
        w *= factor;
        h *= factor;
    }
}</code></pre>',
                'level' => 'advanced',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 55,
                'order' => 112,
                'icon' => 'fingerprint',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode inheritance Java berikut.',
                        'code_template' => "public class Kucing {0} Hewan {\n    public Kucing(String nama) {\n        {1}(nama);\n    }\n\n    @{2}\n    public String suara() {\n        return \"Meow!\";\n    }\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'extends', '{1}' => 'super', '{2}' => 'Override']
                    ],
                    [
                        'instruction' => 'Lengkapi kode interface Java berikut.',
                        'code_template' => "public {0} Drawable {\n    void draw();\n}\n\npublic class Circle {1} Drawable {\n    @Override\n    public void draw() {\n        System.out.println(\"Drawing circle\");\n    }\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'interface', '{1}' => 'implements']
                    ],
                ]
            ],

            // 22. PHP Dasar
            [
                'title' => 'PHP Dasar: Sintaks & Variabel',
                'description' => 'Fondasi pemrograman PHP: variabel, echo, tipe data, dan operasi dasar untuk pengembangan web.',
                'content' => '<h2>PHP untuk Web</h2><p>PHP (Hypertext Preprocessor) adalah bahasa server-side yang sangat populer untuk web development. PHP dieks\ekusi di server dan hasilnya dikirim ke browser sebagai HTML.</p><pre><code>&lt;?php
// Variabel diawali dengan $
$nama = "Budi";
$umur = 17;
$aktif = true;

// Menampilkan output
echo "Nama: " . $nama;       // concatenation
echo "Umur: $umur";           // interpolasi string (double quotes)
echo \'Nama: \' . $nama;      // single quotes (no interpolation)

// print_r untuk debug
print_r($variabel);
var_dump($variabel);  // lebih detail (tipe + nilai)
?&gt;</code></pre>

<h2>Array di PHP</h2><pre><code>&lt;?php
// Indexed Array
$buah = ["Apel", "Mangga", "Jeruk"];
echo $buah[0];  // Apel
$buah[] = "Durian";  // tambah di akhir

// Associative Array
$siswa = [
    "nama" => "Budi",
    "kelas" => "XII RPL",
    "nilai" => 90
];
echo $siswa["nama"];

// Looping array
foreach ($buah as $item) {
    echo "$item\n";
}

foreach ($siswa as $key => $value) {
    echo "$key: $value\n";
}

// Array functions
count($buah);           // panjang array
array_push($buah, "X"); // tambah elemen
sort($buah);             // urutkan
in_array("Apel", $buah); // cek keberadaan
?&gt;</code></pre>

<h2>Fungsi di PHP</h2><pre><code>&lt;?php
function hitungLuas(int $panjang, int $lebar): int {
    return $panjang * $lebar;
}

echo hitungLuas(10, 5);  // 50

// Default parameter
function sapa(string $nama, string $sapaan = "Halo"): string {
    return "$sapaan, $nama!";
}

echo sapa("Budi");              // Halo, Budi!
echo sapa("Budi", "Selamat");   // Selamat, Budi!

// Arrow function (PHP 7.4+)
$kali2 = fn($x) => $x * 2;
echo $kali2(5);  // 10
?&gt;</code></pre>

<h2>Percabangan & Perulangan</h2><pre><code>&lt;?php
// If-else
if ($umur >= 17) {
    echo "Dewasa";
} elseif ($umur >= 12) {
    echo "Remaja";
} else {
    echo "Anak-anak";
}

// For loop
for ($i = 0; $i < 5; $i++) {
    echo "Iterasi $i\n";
}

// While loop
$count = 0;
while ($count < 3) {
    echo $count . "\n";
    $count++;
}

// Match expression (PHP 8.0+)
$status = match($nilai) {
    100 => "Sempurna",
    default => "Biasa"
};
?&gt;</code></pre>',
                'level' => 'beginner',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 20,
                'order' => 113,
                'icon' => 'server',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode PHP berikut.',
                        'code_template' => "<?php\n// Deklarasi variabel\n{0}nama = \"Budi\";\n\n// Menampilkan output\n{1} \"Halo, \" . {0}nama;\n\n// Array\n{0}buah = [\"Apel\", \"Mangga\"];\necho {0}buah[{2}];\n?>",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => '$', '{1}' => 'echo', '{2}' => '0']
                    ],
                    [
                        'instruction' => 'Lengkapi kode fungsi PHP berikut.',
                        'code_template' => "<?php\n{0} hitungLuas(\$p, \$l) {\n    {1} \$p * \$l;\n}\n\necho hitungLuas(10, 5);\n?>",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'function', '{1}' => 'return']
                    ],
                ]
            ],

            // 23. PHP: Form Handling & Database MySQL
            [
                'title' => 'PHP: Form Handling & Database MySQL',
                'description' => 'Memproses data form HTML dengan PHP dan melakukan operasi CRUD ke database MySQL.',
                'content' => '<h2>Mengambil Data Form</h2><pre><code>// form.html
&lt;form method="POST" action="proses.php"&gt;
    &lt;input type="text" name="nama" required&gt;
    &lt;input type="email" name="email" required&gt;
    &lt;button type="submit"&gt;Kirim&lt;/button&gt;
&lt;/form&gt;

// proses.php
&lt;?php
$nama = htmlspecialchars($_POST["nama"]);  // sanitize!
$email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

if ($email === false) {
    echo "Email tidak valid!";
} else {
    echo "Halo, $nama ($email)";
}
?&gt;</code></pre>

<h2>Koneksi MySQL (PDO)</h2><pre><code>&lt;?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=sekolah;charset=utf8mb4",
        "root", "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Koneksi berhasil!";
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?&gt;</code></pre>

<h2>CRUD Operations</h2><pre><code>&lt;?php
// CREATE - Insert data
$stmt = $pdo->prepare("INSERT INTO siswa (nama, kelas, nilai) VALUES (?, ?, ?)");
$stmt->execute(["Budi", "XII RPL", 85]);

// READ - Select data
$stmt = $pdo->query("SELECT * FROM siswa ORDER BY nama");
$hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($hasil as $row) {
    echo "{$row[\'nama\']} - {$row[\'kelas\']}\n";
}

// READ with WHERE (prepared statement - aman dari SQL injection)
$stmt = $pdo->prepare("SELECT * FROM siswa WHERE kelas = ?");
$stmt->execute(["XII RPL"]);
$siswaRpl = $stmt->fetchAll();

// UPDATE
$stmt = $pdo->prepare("UPDATE siswa SET nilai = ? WHERE id = ?");
$stmt->execute([90, 1]);

// DELETE
$stmt = $pdo->prepare("DELETE FROM siswa WHERE id = ?");
$stmt->execute([1]);
?&gt;</code></pre>

<h2>Upload File</h2><pre><code>// form upload
&lt;form method="POST" action="upload.php" enctype="multipart/form-data"&gt;
    &lt;input type="file" name="foto" accept="image/*"&gt;
    &lt;button type="submit"&gt;Upload&lt;/button&gt;
&lt;/form&gt;

// upload.php
&lt;?php
if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES["foto"]["tmp_name"];
    $fileName = basename($_FILES["foto"]["name"]);
    $targetDir = "uploads/";

    // Validasi tipe file
    $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
    if (in_array($_FILES["foto"]["type"], $allowedTypes)) {
        move_uploaded_file($tmpName, $targetDir . $fileName);
        echo "File berhasil diupload!";
    } else {
        echo "Tipe file tidak diizinkan!";
    }
}
?&gt;</code></pre>',
                'level' => 'intermediate',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 50,
                'order' => 114,
                'icon' => 'database',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode PHP untuk mengambil data form dan query database.',
                        'code_template' => "<?php\n// Mengambil data dari form POST\n\$nama = \$_{0}[\"nama\"];\n\n// Koneksi database\n\$pdo = new {1}(\"mysql:host=localhost;dbname=sekolah\", \"root\", \"\");\n\n// Query SELECT\n\$stmt = \$pdo->{2}(\"SELECT * FROM siswa\");\n?>",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'POST', '{1}' => 'PDO', '{2}' => 'query']
                    ],
                    [
                        'instruction' => 'Lengkapi kode prepared statement untuk INSERT.',
                        'code_template' => "\$stmt = \$pdo->{0}(\"INSERT INTO siswa (nama, kelas) VALUES (?, ?)\");\n\$stmt->{1}([\"Budi\", \"XII RPL\"]);",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'prepare', '{1}' => 'execute']
                    ],
                ]
            ],

            // 24. C++ Dasar
            [
                'title' => 'C++ Dasar: Sintaks & Kontrol Program',
                'description' => 'Fondasi pemrograman C++: input/output, variabel, perulangan, dan percabangan.',
                'content' => '<h2>Program C++ Pertama</h2><pre><code>#include &lt;iostream&gt;
using namespace std;

int main() {
    string nama;
    int umur;

    cout &lt;&lt; "Masukkan nama: ";
    cin &gt;&gt; nama;
    cout &lt;&lt; "Masukkan umur: ";
    cin &gt;&gt; umur;

    if (umur >= 17) {
        cout &lt;&lt; nama &lt;&lt; " sudah dewasa" &lt;&lt; endl;
    } else {
        cout &lt;&lt; nama &lt;&lt; " masih pelajar" &lt;&lt; endl;
    }

    return 0;
}</code></pre>

<h2>Tipe Data & Variabel</h2><pre><code>// Tipe data primitif
int bilangan = 42;
float desimal = 3.14f;
double presisi = 3.14159265;
char huruf = \'A\';
bool aktif = true;
string teks = "Hello C++";

// Konstanta
const double PI = 3.14159;

// Auto type (C++11)
auto x = 42;        // int
auto y = 3.14;      // double
auto z = "hello";   // const char*</code></pre>

<h2>Percabangan & Perulangan</h2><pre><code>// If-else
if (umur >= 17) {
    cout &lt;&lt; "Dewasa" &lt;&lt; endl;
} else if (umur >= 12) {
    cout &lt;&lt; "Remaja" &lt;&lt; endl;
} else {
    cout &lt;&lt; "Anak" &lt;&lt; endl;
}

// For loop
for (int i = 1; i <= 5; i++) {
    cout &lt;&lt; "Iterasi ke-" &lt;&lt; i &lt;&lt; endl;
}

// While loop
int count = 0;
while (count < 3) {
    cout &lt;&lt; count &lt;&lt; endl;
    count++;
}

// Range-based for (C++11)
int nilai[] = {80, 90, 75, 85};
for (int n : nilai) {
    cout &lt;&lt; n &lt;&lt; " ";
}</code></pre>

<h2>String & Input</h2><pre><code>#include &lt;iostream&gt;
#include &lt;string&gt;
using namespace std;

int main() {
    string namaLengkap;
    cout &lt;&lt; "Nama lengkap: ";
    getline(cin, namaLengkap);  // membaca satu baris penuh

    // String operations
    cout &lt;&lt; "Panjang: " &lt;&lt; namaLengkap.length() &lt;&lt; endl;
    cout &lt;&lt; "Huruf pertama: " &lt;&lt; namaLengkap[0] &lt;&lt; endl;

    // Substring
    string depan = namaLengkap.substr(0, 5);

    // Find
    size_t pos = namaLengkap.find("Budi");
    if (pos != string::npos) {
        cout &lt;&lt; "Ditemukan di posisi " &lt;&lt; pos &lt;&lt; endl;
    }

    return 0;
}</code></pre>',
                'level' => 'beginner',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 115,
                'icon' => 'template',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi program C++ berikut.',
                        'code_template' => "#include <{0}>\nusing namespace std;\n\nint {1}() {\n    string nama = \"RPL\";\n    {2} << \"Halo \" << nama << endl;\n    return 0;\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'iostream', '{1}' => 'main', '{2}' => 'cout']
                    ],
                    [
                        'instruction' => 'Lengkapi kode for loop C++ berikut.',
                        'code_template' => "{0} (int i = 0; i < 5; i{1}) {\n    cout << i << \" \";\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'for', '{1}' => '++']
                    ],
                ]
            ],

            // 25. C++: Array, Pointer & Fungsi
            [
                'title' => 'C++: Array, Pointer & Fungsi',
                'description' => 'Mendalami array, pointer, dan fungsi di C++ untuk manajemen memori dan modularisasi kode.',
                'content' => '<h2>Array di C++</h2><pre><code>int nilai[5] = {80, 90, 75, 85, 95};

for (int i = 0; i < 5; i++) {
    cout &lt;&lt; "Nilai ke-" &lt;&lt; i &lt;&lt; ": " &lt;&lt; nilai[i] &lt;&lt; endl;
}

// Array 2D
int matrix[2][3] = {
    {1, 2, 3},
    {4, 5, 6}
};
cout &lt;&lt; matrix[1][2]; // 6</code></pre>

<h2>Pointer</h2><pre><code>int x = 10;
int *ptr = &amp;x;  // ptr menyimpan alamat x

cout &lt;&lt; "Nilai x: " &lt;&lt; x &lt;&lt; endl;        // 10
cout &lt;&lt; "Alamat x: " &lt;&lt; &amp;x &lt;&lt; endl;     // 0x...
cout &lt;&lt; "Isi ptr: " &lt;&lt; *ptr &lt;&lt; endl;     // 10 (dereference)
cout &lt;&lt; "Alamat ptr: " &lt;&lt; ptr &lt;&lt; endl;   // sama dgn &amp;x

// Pointer dan array berkaitan erat
int arr[] = {10, 20, 30};
int *p = arr;  // pointer ke elemen pertama
cout &lt;&lt; *(p + 1); // 20 (pointer arithmetic)

// Dynamic memory allocation
int *data = new int[5];  // alokasi array di heap
data[0] = 100;
delete[] data;  // WAJIB: bebaskan memori!</code></pre>

<h2>Fungsi</h2><pre><code>// Fungsi dengan return value
int luasPersegiPanjang(int p, int l) {
    return p * l;
}

// Fungsi void (tanpa return)
void cetak(string pesan) {
    cout &lt;&lt; pesan &lt;&lt; endl;
}

// Pass by reference (mengubah variabel asli)
void tukar(int &amp;a, int &amp;b) {
    int temp = a;
    a = b;
    b = temp;
}

int x = 5, y = 10;
tukar(x, y);
cout &lt;&lt; x; // 10
cout &lt;&lt; y; // 5

// Default parameter
int pangkat(int base, int exp = 2) {
    int result = 1;
    for (int i = 0; i < exp; i++) result *= base;
    return result;
}
cout &lt;&lt; pangkat(3);    // 9 (3^2)
cout &lt;&lt; pangkat(3, 3); // 27 (3^3)</code></pre>

<h2>Struct</h2><pre><code>struct Siswa {
    string nama;
    int umur;
    float nilai;
};

Siswa s1 = {"Budi", 17, 85.5};
cout &lt;&lt; s1.nama &lt;&lt; ": " &lt;&lt; s1.nilai &lt;&lt; endl;

// Array of struct
Siswa kelas[3] = {
    {"Adi", 16, 80},
    {"Budi", 17, 85},
    {"Citra", 16, 90}
};

for (const auto&amp; s : kelas) {
    cout &lt;&lt; s.nama &lt;&lt; " - " &lt;&lt; s.nilai &lt;&lt; endl;
}</code></pre>',
                'level' => 'intermediate',
                'category' => 'programming',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 116,
                'icon' => 'variable',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode pointer dan fungsi C++ berikut.',
                        'code_template' => "int x = 42;\nint {0}ptr = {1}x;  // pointer ke x\n\ncout << *ptr << endl;  // output: 42\n\n// Fungsi\nint tambah(int a, int b) {\n    {2} a + b;\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => '*', '{1}' => '&', '{2}' => 'return']
                    ],
                    [
                        'instruction' => 'Lengkapi kode pass by reference C++ berikut.',
                        'code_template' => "void tukar(int {0}a, int {0}b) {\n    int temp = a;\n    a = b;\n    b = {1};\n}",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => '&', '{1}' => 'temp']
                    ],
                ]
            ],

            // 26. SQL Dasar
            [
                'title' => 'SQL Dasar: Query & Manipulasi Data',
                'description' => 'Fondasi database: CREATE TABLE, INSERT, SELECT, UPDATE, DELETE, dan WHERE clause.',
                'content' => '<h2>Structured Query Language</h2><p>SQL adalah bahasa standar untuk mengelola database relasional. SQL dibagi menjadi:</p><ul><li><strong>DDL (Data Definition Language)</strong>: CREATE, ALTER, DROP</li><li><strong>DML (Data Manipulation Language)</strong>: SELECT, INSERT, UPDATE, DELETE</li><li><strong>DCL (Data Control Language)</strong>: GRANT, REVOKE</li></ul>

<h2>DDL - Membuat & Mengubah Tabel</h2><pre><code>CREATE TABLE siswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    kelas VARCHAR(10),
    nilai INT DEFAULT 0,
    email VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menambah kolom baru
ALTER TABLE siswa ADD COLUMN telepon VARCHAR(15);

-- Mengubah tipe kolom
ALTER TABLE siswa MODIFY COLUMN nilai DECIMAL(5,2);

-- Menghapus tabel
DROP TABLE IF EXISTS siswa;</code></pre>

<h2>DML - Manipulasi Data</h2><pre><code>-- INSERT data
INSERT INTO siswa (nama, kelas, nilai)
VALUES (\'Budi\', \'XII RPL\', 85);

-- INSERT multiple rows
INSERT INTO siswa (nama, kelas, nilai) VALUES
    (\'Adi\', \'XII RPL\', 80),
    (\'Citra\', \'XII TKJ\', 90),
    (\'Dina\', \'XI RPL\', 75);

-- SELECT data
SELECT * FROM siswa;
SELECT nama, nilai FROM siswa WHERE nilai >= 75;
SELECT * FROM siswa WHERE kelas = \'XII RPL\' ORDER BY nilai DESC;
SELECT * FROM siswa WHERE nama LIKE \'%udi%\';  -- pencarian

-- UPDATE data
UPDATE siswa SET nilai = 90 WHERE nama = \'Budi\';

-- DELETE data
DELETE FROM siswa WHERE id = 1;</code></pre>

<h2>WHERE & Operator</h2><pre><code>-- Operator perbandingan
SELECT * FROM siswa WHERE nilai > 80;
SELECT * FROM siswa WHERE nilai BETWEEN 70 AND 90;
SELECT * FROM siswa WHERE kelas IN (\'XII RPL\', \'XII TKJ\');
SELECT * FROM siswa WHERE email IS NULL;

-- Operator logika
SELECT * FROM siswa
WHERE kelas = \'XII RPL\' AND nilai >= 80;

SELECT * FROM siswa
WHERE kelas = \'XII RPL\' OR kelas = \'XII TKJ\';

-- LIMIT & OFFSET
SELECT * FROM siswa ORDER BY nilai DESC LIMIT 5;
SELECT * FROM siswa LIMIT 10 OFFSET 20;  -- pagination</code></pre>

<h2>Fungsi Agregat</h2><pre><code>SELECT COUNT(*) as total FROM siswa;
SELECT AVG(nilai) as rata_rata FROM siswa;
SELECT MIN(nilai) as terendah, MAX(nilai) as tertinggi FROM siswa;
SELECT SUM(nilai) as total_nilai FROM siswa;

-- GROUP BY
SELECT kelas, COUNT(*) as jumlah, AVG(nilai) as avg_nilai
FROM siswa
GROUP BY kelas
HAVING AVG(nilai) >= 75;</code></pre>',
                'level' => 'beginner',
                'category' => 'database',
                'department' => 'rpl',
                'estimated_minutes' => 30,
                'order' => 117,
                'icon' => 'collection',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi query SQL berikut.',
                        'code_template' => "-- Membuat tabel\n{0} TABLE produk (\n    id INT PRIMARY KEY,\n    nama VARCHAR(100)\n);\n\n-- Memasukkan data\n{1} INTO produk (id, nama)\nVALUES (1, 'Laptop');\n\n-- Mengambil data\n{2} * FROM produk;",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'CREATE', '{1}' => 'INSERT', '{2}' => 'SELECT']
                    ],
                    [
                        'instruction' => 'Lengkapi query SQL dengan fungsi agregat.',
                        'code_template' => "SELECT {0}(*) as jumlah FROM siswa;\nSELECT {1}(nilai) as rata_rata FROM siswa;\n\nSELECT kelas, COUNT(*) as total\nFROM siswa\n{2} BY kelas;",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'COUNT', '{1}' => 'AVG', '{2}' => 'GROUP']
                    ],
                ]
            ],

            // 27. SQL Lanjutan: JOIN, GROUP BY & Subquery
            [
                'title' => 'SQL Lanjutan: JOIN, GROUP BY & Subquery',
                'description' => 'Menguasai relasi antar tabel, agregasi data, dan subquery untuk analisis data kompleks.',
                'content' => '<h2>JOIN — Menggabungkan Tabel</h2><pre><code>-- INNER JOIN (hanya data yang cocok di kedua tabel)
SELECT siswa.nama, kelas.nama_kelas
FROM siswa
INNER JOIN kelas ON siswa.kelas_id = kelas.id;

-- LEFT JOIN (semua data dari tabel kiri)
SELECT siswa.nama, nilai.skor
FROM siswa
LEFT JOIN nilai ON siswa.id = nilai.siswa_id;

-- RIGHT JOIN (semua data dari tabel kanan)
SELECT siswa.nama, kelas.nama_kelas
FROM siswa
RIGHT JOIN kelas ON siswa.kelas_id = kelas.id;

-- FULL OUTER JOIN (semua data dari kedua tabel)
-- MySQL tidak support, gunakan UNION:
SELECT * FROM siswa LEFT JOIN kelas ON siswa.kelas_id = kelas.id
UNION
SELECT * FROM siswa RIGHT JOIN kelas ON siswa.kelas_id = kelas.id;</code></pre>

<h2>GROUP BY & Aggregate Lanjut</h2><pre><code>SELECT kelas, COUNT(*) as jumlah, AVG(nilai) as rata_rata
FROM siswa
GROUP BY kelas
HAVING AVG(nilai) >= 75
ORDER BY rata_rata DESC;

-- Multiple GROUP BY
SELECT kelas, jenis_kelamin, COUNT(*) as jumlah
FROM siswa
GROUP BY kelas, jenis_kelamin;</code></pre>

<h2>Subquery</h2><pre><code>-- Subquery di WHERE
SELECT nama FROM siswa
WHERE nilai > (SELECT AVG(nilai) FROM siswa);

-- Subquery di FROM (derived table)
SELECT avg_kelas.kelas, avg_kelas.rata
FROM (
    SELECT kelas, AVG(nilai) as rata
    FROM siswa
    GROUP BY kelas
) as avg_kelas
WHERE avg_kelas.rata > 80;

-- EXISTS subquery
SELECT nama FROM siswa s
WHERE EXISTS (
    SELECT 1 FROM nilai n
    WHERE n.siswa_id = s.id AND n.skor > 90
);</code></pre>

<h2>Index & Optimasi</h2><pre><code>-- Membuat index untuk mempercepat query
CREATE INDEX idx_nama ON siswa(nama);
CREATE UNIQUE INDEX idx_email ON siswa(email);

-- Composite index
CREATE INDEX idx_kelas_nilai ON siswa(kelas, nilai);

-- Melihat execution plan
EXPLAIN SELECT * FROM siswa WHERE nama = \'Budi\';

-- View (query tersimpan)
CREATE VIEW siswa_lulus AS
SELECT nama, kelas, nilai
FROM siswa
WHERE nilai >= 75;</code></pre>',
                'level' => 'intermediate',
                'category' => 'database',
                'department' => 'rpl',
                'estimated_minutes' => 45,
                'order' => 118,
                'icon' => 'link',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi query JOIN dan GROUP BY berikut.',
                        'code_template' => "SELECT siswa.nama, kelas.nama_kelas\nFROM siswa\n{0} JOIN kelas ON siswa.kelas_id = kelas.id;\n\nSELECT kelas, {1}(*) as jumlah\nFROM siswa\n{2} BY kelas;",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'INNER', '{1}' => 'COUNT', '{2}' => 'GROUP']
                    ],
                    [
                        'instruction' => 'Lengkapi subquery SQL berikut.',
                        'code_template' => "-- Ambil siswa dengan nilai di atas rata-rata\nSELECT nama FROM siswa\nWHERE nilai > ({0} AVG(nilai) {1} siswa);",
                        'blanks' => ['{0}', '{1}'],
                        'answers' => ['{0}' => 'SELECT', '{1}' => 'FROM']
                    ],
                ]
            ],

            // 28. JavaScript Async: Fetch API & Promise
            [
                'title' => 'JavaScript Async: Fetch API & Promise',
                'description' => 'Expert Level: Mengonsumsi REST API menggunakan fetch, async/await, dan menangani error.',
                'content' => '<h2>Synchronous vs Asynchronous</h2><p>JavaScript adalah bahasa single-threaded, artinya hanya bisa mengeksekusi satu tugas pada satu waktu. Operasi asynchronous memungkinkan JS menjalankan tugas berat (seperti fetch data) tanpa memblokir eksekusi kode lain.</p>

<h2>Promise</h2><pre><code>// Promise adalah objek yang merepresentasikan operasi async
const janji = new Promise((resolve, reject) => {
    const berhasil = true;
    if (berhasil) {
        resolve("Data berhasil dimuat!");
    } else {
        reject("Gagal memuat data!");
    }
});

// Menggunakan .then() dan .catch()
janji
    .then(data => console.log(data))
    .catch(error => console.error(error))
    .finally(() => console.log("Selesai"));

// Promise.all - tunggu semua selesai
const p1 = fetch("/api/users");
const p2 = fetch("/api/posts");
const [users, posts] = await Promise.all([p1, p2]);</code></pre>

<h2>Fetch API</h2><pre><code>// GET request dengan .then()
fetch("https://api.example.com/siswa")
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));

// GET dengan async/await (RECOMMENDED)
async function getSiswa() {
    try {
        const response = await fetch("https://api.example.com/siswa");
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error("Error:", error);
    }
}</code></pre>

<h2>POST, PUT, DELETE</h2><pre><code>// POST - menambah data
async function tambahSiswa(nama, kelas) {
    const response = await fetch("/api/siswa", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ nama, kelas })
    });
    return response.json();
}

// PUT - mengubah data
async function updateSiswa(id, data) {
    const response = await fetch(`/api/siswa/${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });
    return response.json();
}

// DELETE - menghapus data
async function deleteSiswa(id) {
    const response = await fetch(`/api/siswa/${id}`, {
        method: "DELETE"
    });
    return response.ok;
}</code></pre>

<h2>Error Handling & Loading State</h2><pre><code>// Pattern umum di aplikasi nyata
let loading = false;
let error = null;
let data = null;

async function fetchData() {
    loading = true;
    error = null;
    try {
        const res = await fetch("/api/data");
        if (!res.ok) throw new Error("Server error");
        data = await res.json();
    } catch (err) {
        error = err.message;
    } finally {
        loading = false;
    }
}</code></pre>',
                'level' => 'advanced',
                'category' => 'web',
                'department' => 'rpl',
                'estimated_minutes' => 60,
                'order' => 119,
                'icon' => 'refresh',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi kode async/await dan fetch berikut.',
                        'code_template' => "{0} function getData() {\n    try {\n        const response = {1} fetch(\"/api/data\");\n        const data = {1} response.json();\n        console.log(data);\n    } {2} (error) {\n        console.error(error);\n    }\n}",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'async', '{1}' => 'await', '{2}' => 'catch']
                    ],
                    [
                        'instruction' => 'Lengkapi fetch POST request berikut.',
                        'code_template' => "const response = await fetch(\"/api/siswa\", {\n    {0}: \"POST\",\n    headers: { \"Content-Type\": \"application/{1}\" },\n    body: JSON.{2}({ nama: \"Budi\" })\n});",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'method', '{1}' => 'json', '{2}' => 'stringify']
                    ],
                ]
            ],

            // 29. Git & Version Control
            [
                'title' => 'Git & Version Control',
                'description' => 'Menguasai Git untuk kolaborasi tim: init, commit, branch, merge, dan push ke GitHub.',
                'content' => '<h2>Mengapa Git?</h2><p>Git adalah version control system yang wajib dikuasai setiap programmer. Git melacak setiap perubahan kode sehingga kita bisa berkolaborasi dan rollback jika ada kesalahan.</p>

<h2>Perintah Dasar Git</h2><pre><code># Inisialisasi repository
git init

# Cek status file
git status

# Menambahkan file ke staging
git add .                  # semua file
git add index.html         # file spesifik

# Commit perubahan
git commit -m "Initial commit"

# Melihat history commit
git log --oneline</code></pre>

<h2>Branching & Merging</h2><pre><code># Membuat branch baru
git branch fitur-login

# Pindah ke branch
git checkout fitur-login
# atau (Git 2.23+)
git switch fitur-login

# Buat dan pindah sekaligus
git checkout -b fitur-register

# Merge branch ke main
git checkout main
git merge fitur-login

# Hapus branch yang sudah di-merge
git branch -d fitur-login

# Melihat semua branch
git branch -a</code></pre>

<h2>Remote Repository (GitHub)</h2><pre><code># Menambahkan remote
git remote add origin https://github.com/user/repo.git

# Push ke GitHub
git push -u origin main

# Pull perubahan dari GitHub
git pull origin main

# Clone repository
git clone https://github.com/user/repo.git

# Fork workflow
# 1. Fork repository di GitHub
# 2. Clone fork ke lokal
# 3. Buat branch fitur
# 4. Commit & push ke fork
# 5. Buat Pull Request di GitHub</code></pre>

<h2>Tips & Best Practices</h2><pre><code># .gitignore - file/folder yang tidak perlu di-track
node_modules/
.env
*.log
dist/

# Commit message yang baik:
# ✅ "Add login authentication with JWT"
# ✅ "Fix null pointer error on user profile"
# ❌ "fix bug"
# ❌ "update"

# Stash (simpan sementara perubahan)
git stash
git stash pop

# Reset (hati-hati!)
git reset --soft HEAD~1   # undo commit, keep changes
git reset --hard HEAD~1   # undo commit, delete changes</code></pre>',
                'level' => 'beginner',
                'category' => 'tools',
                'department' => 'rpl',
                'estimated_minutes' => 25,
                'order' => 120,
                'icon' => 'pencil',
                'quiz' => [
                    [
                        'instruction' => 'Lengkapi perintah Git dasar berikut.',
                        'code_template' => "# Inisialisasi repo\ngit {0}\n\n# Tambahkan semua file\ngit {1} .\n\n# Commit\ngit {2} -m \"First commit\"",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'init', '{1}' => 'add', '{2}' => 'commit']
                    ],
                    [
                        'instruction' => 'Lengkapi perintah Git branching berikut.',
                        'code_template' => "# Buat branch baru\ngit {0} fitur-login\n\n# Pindah ke branch\ngit {1} fitur-login\n\n# Gabungkan ke main\ngit checkout main\ngit {2} fitur-login",
                        'blanks' => ['{0}', '{1}', '{2}'],
                        'answers' => ['{0}' => 'branch', '{1}' => 'checkout', '{2}' => 'merge']
                    ],
                ]
            ],
        ];

        // Ensure clean slate for tutorials
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
                    ['line' => 3, 'text' => 'Mendefinisikan header IP dengan IP sumber dan tujuan.'],
                    ['line' => 4, 'text' => 'Membuat header TCP untuk port 80 dengan SYN flag.'],
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
                    ['line' => 2, 'text' => 'Mengakumulasi semua rute kelas A menjadi satu notasi agregat.'],
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
                    ['line' => 11, 'text' => 'Konfigurasi IPAM (IP Address Management) untuk container docker.'],
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
        DB::table('user_badges')->delete();
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
        $badgeIds = Badge::whereIn('criteria', ['complete_first_tutorial', 'first_playground'])->pluck('id')->toArray();
        $user->badges()->sync($badgeIds);

        // Create some progress
        DB::table('user_progress')->delete();
        $tut1 = Tutorial::where('order', 1)->first();
        $tut2 = Tutorial::where('order', 2)->first();
        $tut3 = Tutorial::where('order', 3)->first();
        if ($tut1) \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => $tut1->id, 'status' => 'completed', 'completed_at' => now()->subDays(5)]);
        if ($tut2) \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => $tut2->id, 'status' => 'completed', 'completed_at' => now()->subDays(3)]);
        if ($tut3) \App\Models\UserProgress::create(['user_id' => $user->id, 'tutorial_id' => $tut3->id, 'status' => 'in_progress']);

        // Create some bookmarks
        DB::table('bookmarks')->delete();
        $snip1 = Snippet::first();
        $snip2 = Snippet::skip(1)->first();
        if ($tut1) \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Tutorial::class, 'bookmarkable_id' => $tut1->id]);
        if ($snip1) \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Snippet::class, 'bookmarkable_id' => $snip1->id]);
        if ($snip2) \App\Models\Bookmark::create(['user_id' => $user->id, 'bookmarkable_type' => Snippet::class, 'bookmarkable_id' => $snip2->id]);
    }
}
