
INSERT INTO `jenis`(`namaJenis`) VALUES ('Obat Bebas');
INSERT INTO `jenis`(`namaJenis`) VALUES ('Obat Bebas Terbatas');
INSERT INTO `jenis`(`namaJenis`) VALUES ('Obat Keras');
INSERT INTO `jenis`(`namaJenis`) VALUES ('Non-Obat');

INSERT INTO `bentuk`(`namaBentuk`) VALUES ('Padat');
INSERT INTO `bentuk`(`namaBentuk`) VALUES ('Cair');
INSERT INTO `bentuk`(`namaBentuk`) VALUES ('Non-Obat');

INSERT INTO `rak` (`namaRak`) VALUES ('R01');
INSERT INTO `rak` (`namaRak`) VALUES ('R02');
INSERT INTO `rak` (`namaRak`) VALUES ('R03');

INSERT INTO `status`(`idStatus`, `namaStatus`) VALUES (1,"LUNAS");
INSERT INTO `status`(`idStatus`, `namaStatus`) VALUES (0,"BELUM LUNAS");

INSERT INTO `satuan`(`namaSatuan`) VALUES ('BOX');
INSERT INTO `satuan`(`namaSatuan`) VALUES ('BOTOL');
INSERT INTO `satuan`(`namaSatuan`) VALUES ('TABLET');

INSERT INTO jabatan VALUES ('1','Admin');
INSERT INTO jabatan VALUES ('2','Pegawai');

INSERT INTO pengguna VALUES ('nickhael','12345','Nick Hael','1');
INSERT INTO pengguna VALUES ('ayu','12345','Ayu Ya Yu','2');




INSERT INTO `produk`(`idProduk`, `namaProduk`, `hargaProduk`, `idJenis`,`idBentuk`,`idRak`) VALUES ('11','Panadol Hijau',50000,'1','1','1');
INSERT INTO `batch`(`noBatch`, `exp`, `idProduk`) VALUES ('ABCADALIMA','181201','11');
INSERT INTO `fakrtur`(`noFaktur`,`tanggalCetak`,`tanggalJatuhTempo`,`idPerusahaan`) 
VALUES ('305024','181008','181105',`1`);
INSERT INTO `ObatBeli`(`noFaktur`,`noBatch`,`kuotaBeli`,`diskon`) VALUES ('305024','ABCADALIMA','10','20.0');


CREATE PROCEDURE InputBatch(IN noBatch VARCHAR(12))
BEGIN
    INSERT INTO `batch` values ()
END;

Select *
from ProdukBeli
where noFaktur = '305024';


SELECT c.NamaProduk,a.noBatch,a.kuotaBeli,a.diskon,b.HargaBeli FROM ProdukBeli AS a
INNER JOIN Batch AS b on a.noBatch = b.noBatch
INNER JOIN Produk AS c on b.idProduk = c.idProduk
WHERE noFaktur = '305024'

SELECT 
SUM(HargaBeli)
FROM
ProdukBeli
WHERE
noFaktur = '305024'

SELECT noBatch, exp, kuota FROM `batch` WHERE idProduk = 1


select faktur.noFaktur,faktur.totalPembayaran,perusahaan.namaPerusahaan
from faktur
join perusahaan on perusahaan.idPerusahaan=faktur.idPerusahaan
where faktur.idPerusahaan = (
SELECT idPerusahaan
FROM KontraBon
where noKontraBon = 'ANOANO1st'
)



        -- // $post = $this->input->post();
        -- // $this->
        -- // $this->db->on_duplicate($this->_table,array(
        -- //     'noBatch'=> $post["noBatch"], 
        -- //     'tanggalKadaluarsa' => $post["tanggalKadaluarsa"],
        -- //     'idProduk' => $this->getProduk($post["idProduk"])->idProduk));