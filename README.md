Pemrograman API: "OpenAPI_documentation"
Dosen Pengampu: Andi Iwan Nurhidayat, S.Kom., M.T.

Kelompok 2:
- 22091397079 Sintiya (https://github.com/sintiyaaa73/PemrogramanAPI.git)
- 22091397089 M. Adhiel Vinco Auky (https://github.com/Vincoauky/API)
- 22091397102 Amallia Berliany Putri (https://github.com/AmalliaBerlianyPutri/Pemrograman-API)


Source Code data.php
<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = mysqli_query($connection, "SELECT * FROM tiket_film");
    $count = $query->num_rows;
    $result = array();
    while ($row = $query->fetch_assoc()) {
        array_push($result, array(
            'nomor_id' => $row['nomor_id'],
            'judul_film' => $row['judul_film'],
            'harga_film' => $row['harga_film'],
            'tanggal_tayang' => $row['tanggal_tayang']
        ));
    }

    if ($count == 0) {
        echo 'Tidak ada data';
    }else {
        echo json_encode(
            array($result)
        );
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_film = $_POST['judul_film'];
    $harga_film = $_POST['harga_film'];
    $tanggal_tayang = $_POST['tanggal_tayang'];
    $query = mysqli_query($connection, "INSERT INTO tiket_film (judul_film, harga_film, tanggal_tayang) VALUES ('$judul_film', '$harga_film', '$tanggal_tayang')");

    if ($query) {
        $data = [
            'status' => 'data berhasil disimpan'
        ];

        echo json_encode([$data]);
    }else {
        $data = [
            'status' => 'data gagal disimpan'
        ];

        echo json_encode([$data]);
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $nomor_id = $_GET['nomor_id'];
    $query = mysqli_query($connection, "DELETE FROM tiket_film WHERE nomor_id = '$nomor_id' ");

    if ($query) {
        $data = [
            'status' => 'data berhasil dihapus'
        ];

        echo json_encode([$data]);
    }else {
        $data = [
            'status' => 'data gagal dihapus'
        ];

        echo json_encode([$data]);
    }

}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $nomor_id = $_GET['nomor_id'];
    $judul_film = $_GET['judul_film'];
    $harga_film = $_GET['harga_film'];
    $tanggal_tayang = $_GET['tanggal_tayang'];

    $query = mysqli_query($connection, "UPDATE tiket_film SET 
                            nomor_id = '$nomor_id',
                            judul_film = '$judul_film',
                            harga_film = '$harga_film',
                            tanggal_tayang = '$tanggal_tayang'
                            WHERE nomor_id = '$nomor_id'
                        ");
    
    if ($query) {
        $data = [
            'status' => 'data berhasil diedit'
        ];

        echo json_encode([$data]);
    }else {
        $data = [
            'status' => 'data gagal diedit'
        ];

        echo json_encode([$data]);
    }
}

?>

Source Code connection.php
<?php
$connection = mysqli_connect('localhost: 8111', 'root', '', 'db_tiket film') 
?>

Source Code data.json
{
    "endpoint": {
      "GET": {
        "description": "Retrieve all ticket information",
        "url": "/tickets",
        "parameters": [],
        "response": {
          "status": "success",
          "data": [
            {
              "nomor_id": 1,
              "judul_film": "Movie A",
              "harga_film": 10,
              "tanggal_tayang": "2024-03-14"
            },
            {
              "nomor_id": 2,
              "judul_film": "Movie B",
              "harga_film": 12,
              "tanggal_tayang": "2024-03-15"
            }
          ]
        }
      },
      "POST": {
        "description": "Add a new ticket",
        "url": "/tickets",
        "parameters": {
          "judul_film": "string",
          "harga_film": "integer",
          "tanggal_tayang": "string (format: YYYY-MM-DD)"
        },
        "response": {
          "status": "success",
          "data": {
            "status": "data berhasil disimpan"
          }
        }
      },
      "DELETE": {
        "description": "Delete a ticket",
        "url": "/tickets/:nomor_id",
        "parameters": {
          "nomor_id": "integer"
        },
        "response": {
          "status": "success",
          "data": {
            "status": "data berhasil dihapus"
          }
        }
      },
      "PUT": {
        "description": "Update a ticket",
        "url": "/tickets/:nomor_id",
        "parameters": {
          "nomor_id": "integer",
          "judul_film": "string",
          "harga_film": "integer",
          "tanggal_tayang": "string (format: YYYY-MM-DD)"
        },
        "response": {
          "status": "success",
          "data": {
            "status": "data berhasil diedit"
          }
        }
      }
    }
  }

  Source Code dokumentasi data.yml
  endpoints:
  GET:
    description: Retrieve all ticket information
    url: /tickets
    parameters: []
    response:
      status: success
      data:
        - nomor_id: 1
          judul_film: Movie A
          harga_film: 10
          tanggal_tayang: '2024-03-14'
        - nomor_id: 2
          judul_film: Movie B
          harga_film: 12
          tanggal_tayang: '2024-03-15'
  POST:
    description: Add a new ticket
    url: /tickets
    parameters:
      judul_film: string
      harga_film: integer
      tanggal_tayang: string (format: YYYY-MM-DD)
    response:
      status: success
      data:
        status: data berhasil disimpan
  DELETE:
    description: Delete a ticket
    url: /tickets/:nomor_id
    parameters:
      nomor_id: integer
    response:
      status: success
      data:
        status: data berhasil dihapus
  PUT:
    description: Update a ticket
    url: /tickets/:nomor_id
    parameters:
      nomor_id: integer
      judul_film: string
      harga_film: integer
      tanggal_tayang: string (format: YYYY-MM-DD)
    response:
      status: success
      data:
        status: data berhasil diedit
