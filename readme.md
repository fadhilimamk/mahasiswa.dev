## Aplikasi Presensi MMBR

Assalamualaikum wr wb.

Aplikasi ini digunakan untuk acara Mahasiswa Mengaji Bandung Raya 2017 di Masjid Al-Haq, Kota Bandung. Dibuat menggunakan vanilla PHP tanpa framework. Aplikasi ini sudah diuji dengan _software stack_ sebagai berikut:
* nginx web server
* mysql database
* PHP
* Linux ubuntu

Aplikasi ini juga dapat dijalankan menggunakan web server Apache atau dengan OS windows dan menggunakan XAMPP. Namun hal itu memerlukan konfigurasi lebih lanjut, berbeda dengan konfigurasi yang dijelaskan pada dokumen ini.

### Hak Cipta dan Penggunaan
Aplikasi ini bebas digunakan dan diedit untuk kepentingan sabilillah, namun tetap harus menyantumkan pemilik dan pembuat asli dari aplikasi ini yaitu PPG Bandung Utara. Harap digunakan dengan bijak, semoga Allah paring aman selamat dan barokah :D

### Konfigurasi Pemasangan
1. Siapkan server linux yang akan digunakan, untuk lebih mudahnya dapat menggunakan Ubuntu.
2. Siapkan kode aplikasi ini dalam server, pastikan tidak ada file yang tertinggal untuk mencegah aplikasi tidak berjalan dengan semestinya.
3. Install _software stack_ yang diperlukan. [Konfigurasi LEMP pada Ubuntu.](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04)
4. Konfigurasi _virtual host_ pada nginx khusus untuk aplikasi ini. Sebagai contoh, kita akan mengakses aplikasi ini melalui url http://mahasiswa.test. Pada kasus tersebut gunakan konfigurasi berikut ini:
```
server {
	listen 80;
	listen [::]:80;

	root /var/www/html/mahasiswa/public;

	# Pastikan ada index.php!
	index index.php index.html index.htm index.nginx-debian.html;

	# nama server / url yang digunakan adalah www.mahasiswa.test
    server_name mahasiswa.test www.mahasiswa.test;

	location / {
		# Pastikan ada /index.php?$args karena semua request dihandle oleh file tersebut!
        # ?$args digunakan untuk memastikan semua atribut get dapat dibaca oleh aplikasi!
		try_files $uri $uri/ /index.php?$args;
	}

	# pass PHP scripts to FastCGI server
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
	
		# With php-fpm (or other unix sockets):
		fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
	}

	# deny access to .htaccess files, if Apache's document root
	# concurs with nginx's one
	
	location ~ /\.ht {
		deny all;
	}
}
```
5. Buka aplikasi pada browser. Pada contoh ini, kita dapat mengakses aplikasi MMBR dengan membuka `http://mahasiswa.test` di browser.

[Gb. Tampilan Awal](doc/tampilan_awal.png)

[Gb. Tampilan Input](doc/tampilan_input.png)

## Konfigurasi Database
Data ada dalam folder `data`, silahkan import `db_mahasiswa.sql` ke dalam mysql di server. Konfigurasi username dan password mysql dapat diubah dalam file `Controller.php`.


Alhamdulillahi Jaza Kumullahukhoiro

Waalaikumussalam wr wb.

____
c 2017 PPG Bandung Utara