<?php

use \Illuminate\Support\Arr;
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *\
 *                                                                                                     *
 * Ini merupakan Fungsi yang menangani semua array                                                    *
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

function pushArray($data, $key, $value)
{
    $results = Arr::add($data, $key, $value);
    return $results;
}

function addDataToModel()
{
     debug_pesan_error('Perhatikan kembali fungsi ' . __FUNCTION__ . 'ganti ke pushArray()'); 
}

/**
 * Function for checking if array is multidimensin or not.
 *
 * Carefull : it will take a lot time and resource for cheking large array
 *
 * @param array $array
 * @return boolean
 */
function isMultiArray(array $array):bool
{
    foreach ($array as $v) {
        if (is_array($v)) return true;
    }
    return false;
    //return is_array($array[array_key_first($array)]);
}

function isAssocArray(array $arr)
//function isAssocArray($arr) // test
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

/**
 * Fungsi untuk konversi dari array assoc key index.
 *
 * @param array Assoc
 * @return array Index
 */
function arrayAssocToIndex($array)
{
    $arr =  array();
    foreach ($array as $key => $val) {
        $arr[] = $val;
    }
    return $arr;
}
/**
 * Convert from Array to String.
 * It will catch first array & return it.
 *
 * @param array $array
 * @return array $string
 */
function arrayToString($array)
{
    $string = $array[0];
    return $string;
}
