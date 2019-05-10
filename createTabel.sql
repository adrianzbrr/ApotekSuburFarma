CREATE TABLE Satuan
(
    idSatuan int AUTO_INCREMENT,
    namaSatuan varchar (15),
    PRIMARY KEY (idSatuan),
    CONSTRAINT satuan_unique UNIQUE (namaSatuan)
);
CREATE TABLE Jabatan
(
    idJabatan int NOT NULL AUTO_INCREMENT,
    namaJabatan varchar(20),
    PRIMARY KEY(idJabatan),
    CONSTRAINT jabatan_unique UNIQUE (namaJabatan)
);
CREATE TABLE Pengguna
(
    username varchar(15) NOT NULL,
    password varchar(15) NOT NULL,
    namaPengguna varchar(50),
    idJabatan int ,
    FOREIGN KEY (idJabatan) REFERENCES Jabatan(idJabatan),
    PRIMARY KEY (username)
);
CREATE TABLE Rak
(
    idRak int NOT NULL AUTO_INCREMENT,
    namaRak varchar(7),
    PRIMARY KEY(idRak),
    CONSTRAINT rak_unique UNIQUE (namaRak)
);
CREATE TABLE Jenis
(
    idJenis int AUTO_INCREMENT,
    namaJenis varchar(25),
    PRIMARY KEY(idJenis),
    CONSTRAINT jenis_unique UNIQUE (namaJenis)
);
CREATE TABLE Bentuk
(
    idBentuk int AUTO_INCREMENT,
    namaBentuk varchar(15),
    PRIMARY KEY(idBentuk),
    CONSTRAINT bentuk_unique UNIQUE (namaBentuk)
);
CREATE TABLE Produk
(
    idProduk int NOT NULL AUTO_INCREMENT,
    namaProduk varchar(50) ,
    minimalStok int DEFAULT 10,
    idJenis int,
    idBentuk int,
    idRak int,
    idSatuan int,
    PRIMARY KEY(idProduk),
    FOREIGN KEY(idJenis) REFERENCES Jenis(idJenis),
    FOREIGN KEY(idBentuk) REFERENCES Bentuk(idBentuk),
    FOREIGN KEY(idRak) REFERENCES Rak(idRak),
    FOREIGN KEY(idSatuan) REFERENCES Satuan (idSatuan),
    CONSTRAINT produk_unique UNIQUE (namaProduk)
);
CREATE TABLE Batch
(
    idBatch int AUTO_INCREMENT,
    noBatch varchar(20) NOT NULL,
    tanggalKedaluwarsa date,
    jumlah int DEFAULT 0,
    idProduk int,
    PRIMARY KEY(idBatch),
    FOREIGN KEY(idProduk) REFERENCES Produk(idProduk)
);
CREATE TABLE Perusahaan
(
    idPerusahaan int AUTO_INCREMENT,
    namaPerusahaan varchar(30),
    alamatPerusahaan varchar(50),
    noTelp varchar(13),
    PRIMARY KEY(idPerusahaan),
    CONSTRAINT perusahaan_unique UNIQUE (namaPerusahaan)
);
CREATE TABLE KontraBon(
    idKontraBon int AUTO_INCREMENT,
    noKontraBon varchar(20),
    tanggalCetak date,
    tanggalKembali date,
    idPerusahaan int,
    final int DEFAULT 0,
    PRIMARY KEY(idKontraBon),
    CONSTRAINT kontraBon_unique UNIQUE (noKontraBon)
);
CREATE TABLE Pesanan(
    idPesanan VARCHAR(20),
    tanggalPesanan date,
    idPerusahaan int,
    final int DEFAULT 0,
    PRIMARY KEY(idPesanan),
    FOREIGN KEY(idPerusahaan) REFERENCES Perusahaan(idPerusahaan)
);
CREATE TABLE PesananProduk(
    idPemesanan int AUTO_INCREMENT,
    idPesanan VARCHAR(20),
    idProduk int,
    jumlahBeli int DEFAULT 0,
    PRIMARY KEY(idPemesanan),
    FOREIGN KEY(idPesanan) REFERENCES Pesanan(idPesanan),
    FOREIGN KEY(idProduk) REFERENCES Produk(idProduk)
);
CREATE TABLE Faktur(
    idFaktur int AUTO_INCREMENT,
    noFaktur varchar(20),
    tanggalCetak date,
    tanggalJatuhTempo date,
    idPerusahaan int,
    idKontraBon int,
    idPesanan VARCHAR(20),
    final int DEFAULT 0,
    PRIMARY KEY(idFaktur),
    FOREIGN KEY(idPerusahaan) REFERENCES Perusahaan(idPerusahaan),
    FOREIGN KEY(idKontraBon) REFERENCES KontraBon(idKontraBon),
    FOREIGN KEY(idPesanan) REFERENCES Pesanan(idPesanan),
    CONSTRAINT faktur_unique UNIQUE (noFaktur)
);
CREATE TABLE ProdukBeli
(
    idFaktur int,
    idBatch int,
    jumlahBeli int DEFAULT 0,
    diskon int DEFAULT 0,
    hargaBeli double(11,2) DEFAULT 0.0,
    FOREIGN KEY(idFaktur) REFERENCES Faktur(idFaktur),
    FOREIGN KEY(idBatch) REFERENCES Batch(idBatch)
);
CREATE TABLE Angsuran(
    idAngsuran int AUTO_INCREMENT,
    tanggalAngsuran date,
    jumlahAngsuran double (11,2) DEFAULT 0.0,
    idKontraBon int,
    PRIMARY KEY (idAngsuran),
    FOREIGN KEY(idKontraBon) REFERENCES KontraBon(idKontraBon)
);
CREATE TABLE Laporan(
    idLaporan int AUTO_INCREMENT,
    tanggalLaporan date,
    jenisLaporan int,
    idBatch int,
    sisa int,
    PRIMARY KEY (idLaporan),
    FOREIGN KEY(idBatch) REFERENCES Batch(idBatch)
);

CREATE FUNCTION fHitungSatuan (harga int,diskon int,jumlah int) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE hasil int;
    SET hasil = (harga * 100 / (100-diskon))/jumlah;
    RETURN(hasil);
END$$

CREATE OR REPLACE VIEW produk_view   AS
    SELECT a.idProduk, a.namaProduk, a.minimalStok, a.idJenis, b.namaJenis, a.idBentuk, c.namaBentuk, a.idRak, d.namaRak, IFNULL(SUM(f.jumlah),0) as Jumlah, e.idSatuan, e.namaSatuan, COUNT(f.idProduk) as rowBatch, COUNT(g.idProduk) as rowPesanan 
    FROM produk AS a
        INNER JOIN jenis AS b ON b.idJenis = a.idJenis
        INNER JOIN bentuk AS c ON c.idBentuk = a.idBentuk
        INNER JOIN rak AS d ON d.idRak = a.idRak
        INNER JOIN satuan AS e ON e.idSatuan = a.idSatuan
        LEFT JOIN batch as f ON f.idProduk = a.idProduk
        LEFT JOIN PesananProduk as g ON g.idProduk = a.idProduk
    GROUP BY a.idProduk

CREATE OR REPLACE VIEW perusahaan_view AS
    SELECT a.idPerusahaan, a.namaPerusahaan, a.alamatPerusahaan, a.noTelp, COUNT(b.idPerusahaan) as rowFaktur, COUNT(c.idPerusahaan) as rowKontra, COUNT(d.idPerusahaan) as rowPesanan
    FROM perusahaan AS a
        LEFT JOIN faktur AS b on b.idPerusahaan = a.idPerusahaan
        LEFT JOIN kontraBon AS c on c.idPerusahaan = a.idPerusahaan
        LEFT JOIN Pesanan AS d on d.idPerusahaan = a.idPerusahaan
    GROUP BY a.idPerusahaan 

CREATE OR REPLACE VIEW batch_view AS
    SELECT a.idBatch, a.noBatch, a.tanggalKedaluwarsa, a.jumlah, a.idProduk, c.namaProduk, d.tanggalCetak, b.jumlahBeli, c.Jumlah as total
    FROM Batch as a
    LEFT JOIN ProdukBeli as b on b.idBatch = a.idBatch
    INNER JOIN Produk_view as c on c.idProduk = a.idProduk
    INNER JOIN Faktur as d on d.idFaktur = b.idFaktur
    ORDER BY a.idBatch DESC


CREATE OR REPLACE VIEW produkBeli_view AS
    SELECT a.idFaktur, b.noFaktur, a.idBatch, c.noBatch, d.namaProduk, a.jumlahBeli, c.tanggalKedaluwarsa, fHitungSatuan(a.hargaBeli,a.diskon,a.jumlahBeli) as hargaSatuan, a.diskon, hargaBeli, b.final
    FROM produkbeli as a
        INNER JOIN Faktur as b on b.idFaktur = a.idFaktur
        INNER JOIN Batch as c on c.idBatch = a.idBatch 
        INNER JOIN Produk as d on c.idProduk = d.idProduk

CREATE OR REPLACE VIEW faktur_view AS
    SELECT a.idFaktur, a.noFaktur, a.tanggalCetak, a.tanggalJatuhTempo, a.idKontraBon, d.noKontraBon, a.idPerusahaan, b.namaPerusahaan, COUNT(c.idBatch) as jumlahProduk, IFNULL(SUM(c.hargaBeli),0) as totalPembayaran, e.idPesanan,a.final
    FROM Faktur AS a
        LEFT JOIN perusahaan AS b on b.idPerusahaan = a.idPerusahaan
        LEFT JOIN produkBeli AS c on c.idFaktur = a.idFaktur
        LEFT JOIN kontraBon AS d on d.idKontraBon = a.idKontraBon
        LEFT JOIN pesanan AS e on e.idPesanan = a.idPesanan
    GROUP BY noFaktur

CREATE OR REPLACE VIEW kontraBon_view AS
    SELECT a.idKontraBon, a.noKontraBon, a.tanggalCetak, a.tanggalKembali, a.idPerusahaan ,c.namaPerusahaan, IFNULL(SUM(b.totalPembayaran),0) as totalPembayaran, IFNULL(COUNT(b.idFaktur),0) as jumlahFaktur, a.final
    FROM KontraBon AS a
        LEFT JOIN faktur_view AS b on b.idKontraBon = a.idKontraBon
        LEFT JOIN perusahaan AS c on c.idPerusahaan = a.idPerusahaan
    GROUP BY a.noKontraBon

CREATE OR REPLACE VIEW kedaluwarsa_view AS
    SELECT a.idBatch, a.noBatch, b.namaProduk, a.jumlah, b.namaRak, TIMESTAMPDIFF(DAY,CURRENT_DATE,a.tanggalKedaluwarsa) as Sisa
    FROM Batch as a
        JOIN produk_view as b on b.idProduk = a.idProduk
    WHERE TIMESTAMPDIFF(DAY,CURRENT_DATE,tanggalKedaluwarsa) <= 90 && TIMESTAMPDIFF(DAY,CURRENT_DATE,tanggalKedaluwarsa) > 0 && a.jumlah > 0 
    ORDER BY Sisa ASC

CREATE OR REPLACE VIEW totalAngsuran_view AS
    SELECT idKontraBon, IFNULL(SUM(jumlahAngsuran),0) as totalAngsuran
    FROM Angsuran 
    GROUP BY idKontraBon

CREATE OR REPLACE VIEW kontraBonTunggak_view AS
    SELECT a.idKontraBon, a.totalAngsuran, b.totalPembayaran, IFNULL((b.totalPembayaran-a.TotalAngsuran),0) as sisa
    FROM totalAngsuran_view as a
         JOIN kontraBon_view as b on b.idKontraBon = a.idKontraBon
    GROUP BY idKontraBon

CREATE OR REPLACE VIEW fakturTunggak_view AS
    SELECT IFNULL(SUM(a.totalPembayaran),0) as total, a.idKontraBon
    FROM faktur_view as a
        LEFT JOIN KontraBon as b on b.idKontraBon = a.idKontraBon
    WHERE a.idKontraBon IS NULL

CREATE OR REPLACE VIEW kontraBonFinal_view AS
    SELECT a.idKontraBon, a.noKontraBon, a.tanggalCetak, a.tanggalKembali, a.idPerusahaan ,a.namaPerusahaan, a.totalPembayaran, a.jumlahFaktur, a.final, TIMESTAMPDIFF(DAY,CURRENT_DATE,a.tanggalKembali) as sisaHari,IFNULL(b.sisa,a.totalPembayaran) as sisa
    FROM KontraBon_view AS a
        LEFT JOIN kontraBonTunggak_view AS b on b.idKontraBon = a.idKontraBon
    WHERE a.final = 1
    GROUP BY a.noKontraBon
    ORDER BY sisaHari ASC

CREATE OR REPLACE VIEW totalTunggakan_view AS
    SELECT IFNULL(SUM(sisa),0) as hutang
    FROM kontraBonFinal_view

CREATE OR REPLACE VIEW habis_view AS
    SELECT idProduk, namaProduk, minimalStok, jumlah
    FROM produk_view 
    WHERE jumlah <= minimalStok

CREATE OR REPLACE VIEW angsuran_view AS
    SELECT a.idAngsuran, b.idKontraBon, b.noKontraBon, a.tanggalAngsuran, a.jumlahAngsuran
        FROM Angsuran AS a
        JOIN kontraBon AS b on b.idKontraBon = a.idKontraBon
    ORDER BY a.tanggalAngsuran    

CREATE OR REPLACE VIEW pesananproduk_view AS
    SELECT a.idPemesanan, a.idPesanan, a.idProduk, a.jumlahBeli, b.tanggalPesanan,c.namaProduk,d.namaPerusahaan, b.final
    FROM PesananProduk as a
    JOIN Pesanan as b on b.idPesanan = a.idPesanan
    JOIN Produk as c on c.idProduk = a.idProduk
    JOIN Perusahaan as d on d.idPerusahaan = b.idPerusahaan

CREATE OR REPLACE VIEW pesanan_view AS
    SELECT a.idPesanan, a.tanggalPesanan, b.namaPerusahaan, a.final, IFNULL(SUM(c.jumlahBeli),0) as totalBarang
    FROM Pesanan as a
    JOIN Perusahaan as b on b.idPerusahaan = a.idPerusahaan
    LEFT JOIN PesananProduk as c on c.idPesanan = a.idPesanan
    GROUP BY idPesanan

CREATE OR REPLACE VIEW pengguna_view AS
    SELECT a.username, a.password, a.namaPengguna, a.idJabatan, b.namaJabatan
    FROM Pengguna as a
    JOIN Jabatan as b on b.idJabatan = a.idJabatan

CREATE OR REPLACE VIEW jumlahProduk_view AS
    SELECT IFNULL(SUM(Jumlah),0) as jumlah
    FROM produk_view

CREATE OR REPLACE VIEW rak_view AS
    SELECT a.idRak, a.namaRak, COUNT(b.idProduk) as jumlah
    FROM Rak as a
    LEFT JOIN Produk as b on b.idRak = a.idRak
    GROUP BY a.idRak 

CREATE OR REPLACE VIEW laporan_view AS
    SELECT a.idLaporan, a.tanggalLaporan, a.jenisLaporan, b.idBatch, b.noBatch, b.idProduk, b.namaProduk, b.jumlahBeli, b.tanggalKedaluwarsa, a.sisa
    FROM Laporan as a
    JOIN batch_view as b on b.idBatch = a.idBatch
    JOIN produk_view as c on c.idProduk = b.idProduk

