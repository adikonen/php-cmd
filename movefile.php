<?php

function movefile(string $file_type, string $from_path, string $to_path) : void 
{
    if(! file_exists($to_path)) {
        mkdir("$to_path");
        echo "Berhasil membuat direktori $to_path" . PHP_EOL;
    }

    $files = glob($from_path."*.{".$file_type."}",GLOB_BRACE);

    if(count($files) > 0) {
        foreach($files as $file) {
            $move_to = $to_path . basename($file);
            echo rename($file, $move_to) 
                ? "file $file berhasil dipindahkan ke lokasi $to_path" . PHP_EOL
                : "gagal memindahkan file $file ke lokasi $to_path" . PHP_EOL;
        }
    }

    echo "aksi memindahkan file telah selesai!" . PHP_EOL;
}

#main
if(php_sapi_name() != 'cli') {
    throw new Exception("File ini harus dijalankan melalui command line");
}

echo "Apakah anda ingin memindahkan semua file sesuai dengan ekstensinya ke suatu folder?\nCTRL + C untuk batal \n";

$file_type = readline("Masukan Jenis Ektensi File (ex. pdf, jpg): ");

echo "HINT: GUNAKAN BACKSLASH (\) UNTUK LOKASI FOLDER PADA WINDOWS" . PHP_EOL;

$from_path = readline("Masukan asal lokasi file yang akan dipindahkan (ex. C:\users\asal_file\): ");
$to_path = readline("Masukan lokasi file tujuan yang akan ditempatkan (ex. C:\users\lokasi_baru\): ");

if(! str_ends_with($from_path, '\\')) {
    $from_path .= "\\";
}

if(! str_ends_with($to_path, '\\')) {
    $to_path .= "\\";
}

movefile($file_type, $from_path, $to_path);