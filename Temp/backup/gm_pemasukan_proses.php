<?php
class Library
{
    public function __construct()
    {
        $host       = "localhost";
        $dbname     = "inxmiles_tpb";
        $username   = "inxmiles_tpb";
        $password   = "Flatrone2241TPB";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }
    public function add_data($nama_siswa, $kelas, $alamat)
    {
        $data = $this->db->prepare('INSERT INTO tb_siswa (nama_siswa,kelas,alamat) VALUES (?, ?, ?)');

        $data->bindParam(1, $nama_siswa);
        $data->bindParam(2, $kelas);
        $data->bindParam(3, $alamat);

        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * FROM tb_siswa");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_siswa)
    {
        $query = $this->db->prepare("SELECT * FROM tb_siswa where kd_siswa=?");
        $query->bindParam(1, $kd_siswa);
        $query->execute();
        return $query->fetch();
    }

    public function update($kd_siswa, $nama_siswa, $kelas, $alamat)
    {
        $query = $this->db->prepare('UPDATE tb_siswa set nama_siswa=?,kelas=?,alamat=? where kd_siswa=?');

        $query->bindParam(1, $nama_siswa);
        $query->bindParam(2, $kelas);
        $query->bindParam(3, $alamat);
        $query->bindParam(4, $kd_siswa);

        $query->execute();
        return $query->rowCount();
    }

    public function delete($kd_siswa)
    {
        $query = $this->db->prepare("DELETE FROM tb_siswa where kd_siswa=?");

        $query->bindParam(1, $kd_siswa);

        $query->execute();
        return $query->rowCount();
    }
}
