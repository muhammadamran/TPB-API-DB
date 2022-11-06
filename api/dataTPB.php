<?php
include "connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function tpb_header()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_header ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'NOMOR_AJU' => $result['NOMOR_AJU']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_bahan_baku()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_bahan_baku ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_bahan_baku_dokumen()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_bahan_baku_dokumen ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_bahan_baku_tarif()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_bahan_baku_tarif ORDER BY ID_HEADER DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_barang()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_barang ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_barang_dokumen()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_barang_dokumen ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_barang_penerima()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_barang_penerima ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_barang_tarif()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_barang_tarif ORDER BY ID_HEADER DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_detil_status()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_detil_status ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_dokumen()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_dokumen ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_jaminan()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_jaminan ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_kemasan()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_kemasan ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_kontainer()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_kontainer ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_npwp_billing()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_npwp_billing ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_penerima()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_penerima ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_pungutan()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_pungutan ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}

function tpb_respon()
{
    global $dbcon;
    $dataTPB = $dbcon->query("SELECT * FROM tpb_respon ORDER BY ID DESC LIMIT 1", 0);
    $cek = $dataTPB->num_rows;

    if ($cek > 0) {
        $data = [];

        while ($result = $dataTPB->fetch_assoc()) {
            $data[] = [
                'ID' => $result['ID'],
                'ID_HEADER' => $result['ID_HEADER']
            ];
        }

        echo json_encode([
            'status' => 200,
            'result' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'result' => 'Data not found'
        ]);
    }
}
