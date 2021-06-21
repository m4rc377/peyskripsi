<?php

use \Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *\
 *                                                                                                     *
 * Ini merupakan Fungsi yang menangani semua object                                                    *
 *                                                                                                     *
 * @see       : https://github.com/m4rc377 The Project Owner                                           *
 * @author    : Marshel Aldhi (github.com/m4rc377) (original coder) <marcell.aldhi@gmail.com>          *
 * @copyright : 2021                                                                                   *
 * @license   : http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License              *
 * @note      : This program is distributed in the hope that it will be useful - WITHOUT               *
 *              ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or                  *
 *              FITNESS FOR A PARTICULAR PURPOSE.                                                      *
 *                                                                                                     *
\* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/**
 * Fungsi untuk menambahkan Prefix atau suffi pada nilai di attribute collection
 *
 * @param collection $collection
 * @param string $parrentKey
 * @param string $parrentValue
 * @param string $type 
 * @param boolean $recusive
 * @return \Illuminate\Support\Collection
 */
function collectionSuffixPrefix($collection, $parrentKey, $parrentValue, $type, $recusive = false)
{
    if ($recusive){
        try {
            $results = collect($collection)->map(function ($item) use ($parrentKey, $parrentValue, $type) {
                if ($type == 'prefix') {
                    $item->$parrentKey =  $parrentValue . $item->$parrentKey;
                } elseif ($type == 'suffix') {
                    $item->$parrentKey = $item->$parrentKey . $parrentValue;
                } else {
                    debug_pesan_error('Kesalahan di fungsi ' . __FUNCTION__);
                }
                return $item;
            });
        }catch (Exception $e){
                debug_pesan_error('Perhatikan kembali fungsi ' . __FUNCTION__);
        }
    }else{
        $results = $collection;
        if ($type == 'prefix') {
            $results->$parrentKey =  $parrentValue . $results->$parrentKey;
        } elseif ($type == 'suffix') {
            $results->$parrentKey = $results->$parrentKey . $parrentValue;
        } else {
            debug_pesan_error('Kesalahan di fungsi ' . __FUNCTION__);
        }

    }
    return $results;
} 


/**
 * Return Array to Object and convert to Index Array.
 *
 * @param mixed $data
 * @param bool $toIndex
 * @return \Illuminate\Support\Collection|array
 *
 */
function toObject($data, $toIndex = false) {
    if ($toIndex) {
        $data = arrayAssocToIndex($data);
    }
    $result = (object)$data;
    return $result;
}

function daftar_nilai_format($array)
{
    $array->each(function ($daftar) /* use ($gajiPokok, &$total_potongan) */ {
        if ($daftar->formula == 'persen') {
            $daftar->nilai = nilai_format($daftar->nilai, 0, '.', ',', '', ' %');
        } elseif ($daftar->formula == 'nilai') {
            $daftar->nilai = nilai_format($daftar->nilai, 2, '.', ',', 'Rp. ', '');
        } else {
            return false;
        }
    });
    return $array;
}

/**
 * Fungsi untuk mengkonversi array ke collection,
 * dan juga konversi dari array assoc key index.
 *
 * @param array $array
 * @param boolean $toIndex
 * @return Illuminate\Support\Collection
 */
function arrayToCollection($array, $toIndex = false)
{
    if ($toIndex) {
        $array = arrayAssocToIndex($array);
    }
    return collect($array);
}

/**
 * Fungsi untuk mengconvert JSON atau array ke collection
 *
 * @param json|array $data
 * @return collection
 */
function toObjectCollection($data)
{

    if (isJson($data)) {
        // convert json to array as objected
        $data = json_decode($data, true);
    }

    $object = new Collection();

    foreach ($data as $key => $value) {
        $object->$key = $value;
    }
    $object->all();
    return $object;
}

