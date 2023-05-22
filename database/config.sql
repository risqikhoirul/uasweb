-- Buat database
CREATE DATABASE db_kas;

-- Menggunakan database db_kas
USE db_kas;



-- Buat tabel table_user
CREATE TABLE table_user (
    user VARCHAR(20) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_timestamp,
    PRIMARY KEY (user)
);

-- Tambah data ke tabel table_user
INSERT INTO table_user (user, nama, password, created_at)
VALUES ('Risqi', 'M Khoirul Risqi', 'password123', CURRENT_timestamp());

INSERT INTO table_user (user, password, created_at)
VALUES ('Fikri', 'M Ahsanul Fikri', 'password123', CURRENT_timestamp());

-- Buat tabel tabel_pinjaman

CREATE TABLE table_pinjaman (
    no INT NOT NULL AUTO_INCREMENT,
    jenis VARCHAR(20) NOT NULL,
    user VARCHAR(20) NOT NULL,
    nilai VARCHAR(16) NOT NULL,
    created_at DATE NOT NULL,
    PRIMARY KEY (no)
);

-- Tambah data ke tabel table_pinjaman
INSERT INTO table_pinjaman (jenis, user, nilai, created_at)
VALUES ('listrik', 'Risqi', '1000000', '10/10/2023');

INSERT INTO table_pinjaman (jenis, user, nilai, created_at)
VALUES ('listrik', 'fikri', '5000000', '06/06/2023');

INSERT INTO table_pinjaman (jenis, user, nilai, created_at)
VALUES ('PDAM', 'fikri', '700000', '07/07/2023');

-- Update data pada tabel table_pinjaman no 3
UPDATE table_pinjaman
SET jenis = 'Internet', nilai = '21500', created_at = '08/07/2023'
WHERE no = 3;

-- Hapus data pada tabel table_pinjaman no 3
DELETE FROM table_keuangan WHERE no = 3;

-- Lihat data user tertentu pada tabel table_pinjaman
SELECT no, jenis, user, nilai, created_at FROM table_keuangan WHERE user = 'fikri';



-- Buat tabel table_keuangan
CREATE TABLE table_keuangan (
    no INT NOT NULL AUTO_INCREMENT,
    jenis ENUM('Pemasukan', 'Pengeluaran') NOT NULL,
    user VARCHAR(20) NOT NULL,
    keterangan TEXT NOT NULL,
    nilai VARCHAR(16) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (no)
);

-- Tambah data ke tabel table_keuangan
INSERT INTO table_keuangan (jenis, user, keterangan, nilai, created_at)
VALUES ('Pemasukan', 'Risqi', 'Gaji bulan Mei', '1000000', CURRENT_timestamp());

INSERT INTO table_keuangan (jenis, user, keterangan, nilai, created_at)
VALUES ('Pemasukan', 'Risqi', 'KIP Mei', '2000000', CURRENT_timestamp());

INSERT INTO table_keuangan (jenis, user, keterangan, nilai, created_at)
VALUES ('Pengeluaran', 'Fikri', 'Makan Malam', '20000', CURRENT_timestamp());

INSERT INTO table_keuangan (jenis, user, keterangan, nilai, created_at)
VALUES ('Pemasukan', 'Risqi', 'Bantuan Sosial', '30000', CURRENT_timestamp());

-- Update data pada tabel table_keuangan no 3
UPDATE table_keuangan
SET jenis = 'Pengeluaran', keterangan = 'Beli bahan baku', nilai = '21500', created_at = CURRENT_timestamp()
WHERE no = 3;

-- Lihat data user tertentu pada tabel table_keuangan
SELECT no, jenis, user, keterangan, nilai, created_at FROM table_keuangan WHERE user = 'Risqi';

-- Hapus data pada tabel table_keuangan no 3
DELETE FROM table_keuangan WHERE no = 3;
