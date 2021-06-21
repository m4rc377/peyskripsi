
<?php


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *\
 * Firebase Function.                                                                                  *
 *                                                                                                     *
 * Ini merupakan Core Fungsi dari Aplikasi Puskesmas                                                   *
 *                                                                                                     *
 * @see       : https://github.com/m4rc377 The Project Owner                                           *
 *                                                                                                     *
 * @author    : Marshel Aldhi (github.com/m4rc377) (original coder) <marcell.aldhi@gmail.com>          *
 * @copyright : 2021                                                                                   *
 * @license   : http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License              *
 * @note      : This program is distributed in the hope that it will be useful - WITHOUT               *
 *              ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or                  *
 *              FITNESS FOR A PARTICULAR PURPOSE.                                                      *
 *                                                                                                     *
\* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


/**
 * Fungsi untuk memberikan pesan error pada fungsi
 *
 * @param string $pesan
 * @return exit
 */
function debug_pesan_error($pesan)
{
    throw new \Exception(pathinfo(__FILE__, PATHINFO_FILENAME) . ' : ' . $pesan);
}

function getAvatarDir()
{
    /*    
    $setting = FirebaseSelect('pengaturan/website');
    $result = (object)$setting;
    $result = '/'.$result->images_path; 
    */
    $result = '/upload'; 
    return $result;
}

/**
 * This function for cheking base64 is valid image.
 *
 * @param string $base64DataImage
 * @return boolean
 */
function isBase64Image($base64DataImage)
{
    // checking if dataimage is base64
    preg_match('/data:((image\/([a-z]+));base64,)([A-Za-z0-9+=\/]+)/', $base64DataImage, $out);
    if ($out) {
        $base64 = $out['4'];
    }else {
        return false;
    }

    // Decode the string in strict mode and check the results let true base64
    $bin = base64_decode($base64, true);

    if (!$bin) {
        return false;
    }else{
        // Load GD resource from binary data
        $im = imageCreateFromString($bin);
        // Make sure that the GD library was able to load the image
        // This is important, because you should not miss corrupted or unsupported images
        if (!$im) {
            return false;
        }

        // Check the MIME type to be sure that the binary data is an image
        $size = getImageSizeFromString($bin);
        if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
            return false;
        }
    }

    // Encode the string again
    // cheking and compare base64 encode binary with input base64
    if (base64_encode($bin) !== $base64) {
        return false;
    }

    return true;
}

function base64ToImage($base64)
{
    list($type, $base64) = explode(';', $base64);
    preg_match("/\w+:\w+\/(\w+$)/", $type, $output_array);
    $ext = $output_array[1];
    // get images base64
    list(, $base64)      = explode(',', $base64);
    // ikages decode
    $images = base64_decode($base64);
    $arr = array(
        'binary' => $images,
        'ext' => $ext
    );
    $results = toObject($arr, false);
    return $results;
}

function ImageToBase64($image)
{
    $type = pathinfo($image, PATHINFO_EXTENSION);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($image);
    return $base64;
}


/**
 * Ini merupakan Fungsi bawaan PHP dengan tambahan prefix & suffix
 *
 * @param float $number — The number being formatted.
 * @param int $decimals — [optional]
 * @param string $dec_point — [optional]
 * @param string $thousands_sep — [optional]
 * @return string — A formatted version of number.
 * @link https://php.net/manual/en/function.number-format.php
 */
function nilai_format($number, $decimals = 0, $dec_point = '.', $thousands_sep = ',', $prefix ='' , $suffix = '')
{
    if($prefix){
        $result = $prefix . number_format($number, $decimals, $dec_point, $thousands_sep);
    }elseif($suffix){
        $result = number_format($number, $decimals, $dec_point, $thousands_sep) . $suffix;
    }else{
        $result = number_format($number, $decimals, $dec_point, $thousands_sep);
    }
    return $result;
}

/**
 * Fungsi untuk mendapatkan lama masa kerja.
 *
 * @param string $tahun_pengangkatan (MM/YYYY)
 * @return string (dalam tahun)
 */
function masakerja($tahun_pengangkatan)
{
    $carbon = new Illuminate\Support\Carbon;
    $tahun_pengangkatan = $carbon::createFromIsoFormat('M/Y', $tahun_pengangkatan)
        ->startOfMonth()
        ->toDateTimeString();
    $angkatan = $carbon::parse($tahun_pengangkatan);
    $masa_kerja = $carbon::now()->diffInYears($angkatan);
    return $masa_kerja;
}

function perkiraanGajiPokok($daftar_gaji_pokok, $masa_kerja, $pegawai)
{
    // prepare inheritance variable gaji_pokok
    $gaji_pokok = '';
    $daftar_gaji_pokok->each(function ($gapok) use ($pegawai, $masa_kerja, &$gaji_pokok) {
         
        // ini masi error jika melebihi list terakhir
        // solusi jika list terakhir kosong isi dengan nilai tertinggi
        if (($gapok->golongan == $pegawai->golongan) && ($masa_kerja >= $gapok->masa_dari && $masa_kerja <= $gapok->masa_sampai)) {
            $gaji_pokok = $gapok->nilai;
            return $gaji_pokok;
        }
    });
    return $gaji_pokok;
}

function hitungGapok($model, $gajiPokok, $total_potongan = 0)
{
    $model->each(function ($potongan) use ($gajiPokok, &$total_potongan) {
        if ($potongan->formula == 'persen') {
            $total_potongan = (($potongan->nilai / 100) *  $gajiPokok) + $total_potongan;
        } elseif ($potongan->formula == 'nilai') {
            $total_potongan = $potongan->nilai + $total_potongan;
        } else {
            return false;
        }
    });
    return $total_potongan;
}

function hitunganKomponenGaji($model, $gajiPokok, $total_komponen = 0)
{
    $model->each(function ($komponen) use ($gajiPokok, &$total_komponen) {
        if ($komponen->formula == 'persen') {
            $total_komponen = (($komponen->nilai / 100) *  $gajiPokok) + $total_komponen;
        } elseif ($komponen->formula == 'nilai') {
            $total_komponen = $komponen->nilai + $total_komponen;
        } else {
            return false;
        }
    });
    return $total_komponen;
}


function daftar_hitung_potongan($array, $gajiPokok)
{
    $results = collect($array)->map(function ($daftar) use ($gajiPokok) {
        $daftar->gapok = nilai_format($gajiPokok, 2, '.', ',', 'Rp. ', '');
        if ($daftar->formula == 'persen') {
            $persen = $daftar->nilai / 100;
            $nilai_potongan = $gajiPokok * $persen;
            $daftar->nilai_format = nilai_format($daftar->nilai, 0, '.', ',', '', ' %');
            $daftar->nilai_potongan = nilai_format($nilai_potongan, 2, '.', ',', 'Rp. ', '');
            $total_potongan = $gajiPokok - $nilai_potongan;
        } elseif ($daftar->formula == 'nilai') {
            $total_potongan = $gajiPokok - $daftar->nilai;
            $daftar->nilai_format = nilai_format($daftar->nilai, 2, '.', ',', 'Rp. ', '');
            $daftar->nilai_potongan = nilai_format($daftar->nilai, 2, '.', ',', 'Rp. ', '');
        } else {
            return false;
        }
        $daftar->total_potongan = nilai_format($total_potongan, 2, '.', ',', 'Rp. ', '');
        return $daftar;
    });
    return $results;
}

function daftar_hitung_tunjangan($array, $gajiPokok)
{
    $array->each(function ($daftar) use ($gajiPokok) /* $gajiPokok, &$total_potongan) */ {
        $daftar->gaji_pokok = nilai_format($gajiPokok, 2, '.', ',', 'Rp. ', '');
        if ($daftar->formula == 'persen') {
            $persen = $daftar->nilai / 100;
            $nilai_tunjangan = $gajiPokok * $persen;
            $daftar->nilai_format = nilai_format($daftar->nilai, 0, '.', ',', '', ' %');
            $daftar->nilai_tunjangan = nilai_format($nilai_tunjangan, 2, '.', ',', 'Rp. ', '');
            $total_tunjangan = $gajiPokok + $nilai_tunjangan;
        } elseif ($daftar->formula == 'nilai') {
            $total_tunjangan = $gajiPokok + $daftar->nilai;
            $daftar->nilai_format = nilai_format($daftar->nilai, 2, '.', ',', 'Rp. ', '');
            $daftar->nilai_tunjangan = nilai_format($daftar->nilai, 2, '.', ',', 'Rp. ', '');
        } else {
            return false;
        }
        $daftar->total_tunjangan = nilai_format($total_tunjangan, 2, '.', ',', 'Rp. ', '');
    });

    return $array;
}


function attribut_gaji($model, $gajiPokok)
{

    //hitunganGaji($model, $gajiPokok);
    //$gaji_bersih = ($gaji_pokok + $tunjangan) - $potongan;

    /*
    $atribut = [
        'potongan' => '',
        'tunjangan' =>,
        'gaji_kotor' =>,
        'gaji_bersih' =>,
    ];
     */

}

function userLogin()
{
    $user = auth()->user();
    return $user;
}



 /**
 * Fungsi validasi Json without JSON_THROW_ON_ERROR throw support with php =< 7.3
 *
 * @param string $json
 * @return boolean
 */
function isJson($json) {
    try {
        json_decode($json, true);
        return true;
    } catch (Throwable $e) {
        return false;
    }
}

/**
 * Fungsi untuk mengconvert JSON ke Array
 *
 * @param json $data
 * @return array
 */
function jsonToArray($json)
{
    return json_decode($json, true);
}

/**
 * Undocumented function
 *
 * @param   array $arr
 * @return  void
 */
function convert_json($arr, $response = false)
{
    $json = [$arr];
    //$json=json_encode((object)$arr,JSON_FORCE_OBJECT);
    $json = json_encode($json);
    if ($response) {
        return response()->json(['success' => '1', 'data' => $json]);
    } else {
        return $json;
    }
}


/**
 * Fungsi Untuk membuat Slug
 *
 * @param string $text
 * @return string
 */
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


