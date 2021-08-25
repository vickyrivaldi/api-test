# API Routes :
  1.1 Binary To Decimal (POST)
    
    URL   : http://localhost/api-test/v1/bintodec
    REQUEST_BODY :
    {
        "input" : "1001",
        "output" : "binary"
    }
 
 2.1 Decimal To Binary(POST)
    
    URL   : http://localhost/api-test/v1/bintodec
    REQUEST_BODY :
    {
        "input" : "9",
        "output" : "decimal"
    }
    
#Query Test
  - Nama File : Query_Test.txt
  - Contoh data :
    1. data_transaksi :
        insert into `data_transaksi` (`id`, `tgl_order`, `status_pelunasan`, `tgl_pembayaran`) values('1','2020-12-01 11:30:00','lunas','2020-12-01 12:00:00');
        insert into `data_transaksi` (`id`, `tgl_order`, `status_pelunasan`, `tgl_pembayaran`) values('2','2020-12-02 10:30:00','pending',NULL);
          
    2. detail_transaksi :
        insert into `detail_transaksi` (`id`, `id_transaksi`, `harga`, `jumlah`, `subtotal`) values('1','1','10000','2','20000');
        insert into `detail_transaksi` (`id`, `id_transaksi`, `harga`, `jumlah`, `subtotal`) values('2','2','6250','4','25000');

        
      

