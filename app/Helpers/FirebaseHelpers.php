<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *\
 * Firebase Function.                                                                                  *
 *                                                                                                     *
 * Ini merupakan Core Aplikasi yang berhubungan dengan query ke Firebase database                      *
 *                                                                                                     *
 * @see       https://github.com/m4rc377 The Project Owner                                             *
 *                                                                                                     *
 * @author    Marshel Aldhi (github.com/m4rc377) <marcell.aldhi@gmail.com>                             *
 * @author    Marshel Aldhi (original coder)                                                           *
 * @copyright 2021                                                                                     *
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License                *
 * @note      This program is distributed in the hope that it will be useful - WITHOUT                 *
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or                               *
 * FITNESS FOR A PARTICULAR PURPOSE.                                                                   *
 *                                                                                                     *
\* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/* ======================================================== Start CRUD Firebase ======================================================== */
/**
 * Inisialisasi Firebase database
 *
 * @param string $refer
 *
 */
function Firebaseinit($refer)
{
    $database = app('firebase.database');
    $result = $database->getReference($refer);
    return $result;
}

/**
 * Function to Get data from Firebase
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai SELECT
 * yang berfungsi memperlihatkan data yang telah di querykan.
 *
 * @param string $refer
 * @param string $uid
 * @param boolean $getValue
 */
function FirebaseSelect($refer, $token = null, $getValue = true)
{
    if ($token) {
        $refer = $refer . '/' . $token;
    }
    $db = Firebaseinit($refer);
    if ($getValue) {
        $db = $db->getvalue();
    }

    return $db;
}

/**
 * Fungsi Create Untuk Firebase
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai CREATE
 * yang berfungsi menambahkan data yang telah di querykan.
 *
 * @param object $refer
 * @param array $data
 * @param mixed $getkey
 *
 */
function FirebaseCreate($refer,$data, $getkey = false)
{
    $data = pushArray($data, 'create_at', ['.sv' => 'timestamp']);
    $init = Firebaseinit($refer);
    $results =  $init->push($data);
    if ($getkey){
        $results = $results->getKey();
    }
    return $results;
}

/**
 * Fungsi Update Untuk Firebase
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai UPDATE
 * yang berfungsi mengubah data yang telah di querykan.
 *
 * @param object $refer
 * @param array $data
 *
 */
function FirebaseUpdate($refer, $data)
{
    $data = pushArray($data, 'update_at', ['.sv' => 'timestamp']);
    $refer = Firebaseinit($refer);
    $update =  $refer->update($data);
    return $update;
}

/**
 * Fungsi Delete Untuk Firebase
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai DELETE
 * yang berfungsi menghapus data yang telah di querykan.
 *
 * @param object $refer
 * @param array $data
 *
 */
function FirebaseDelete($refer, $token)
{
    $refer = $refer . '/' . $token;
    $db = Firebaseinit($refer);
    $delete = $db->remove();
    return $delete;
}

/**
 * Ini Fungsi Model Firebase Select dengan output fake model,
 *
 * @param array $ref
 * @param string $token
 * @param string $key
 * @param string $value
 * @return \Illuminate\Support\Collection|\App\DummyModel
 */
function fbSelect($ref, $token = '', $key = '', $value = '', $keyoutput = false)
{
    $db = FirebaseSelect($ref, $token, true);
    if ($key && $value){
        if ($token){ // select by token add key and value
            $model = modelBaru($db);
            $model = pushArray($model, $key, $value);
        }else{ // select all  add key adn value
            $parrentKey   = $key;
            $parrentValue = $value;
            $model = collect($db)->map(function ($value, $key) use ($parrentKey, $parrentValue) {
                $model = modelBaru($value);
                $model = pushArray($model, $parrentKey, $parrentValue);
                return $model;
            });
        }
    }elseif($token && $key){ // select token dengan key value (by token)
        $model = modelBaru($db);
        $model = pushArray($model, $key, $token);
    }elseif($token){ // select token
        $model = modelBaru($db);
    }elseif($key){ // select all dengan key (value by item key firebase)
        $parrentKey   = $key;
        $parrentValue = $value;
        $model = collect($db)->map(function ($value, $key) use ($parrentKey, $parrentValue) {
            $model = modelBaru($value);
            $model = pushArray($model, $parrentKey, $key);
            return $model;
        });

    } else{ // select all
        $model = collect($db)->map(function ($value, $key){
            $model = modelBaru($value);
            return $model;
        });;
    }

    return $model;
}

/**
 * Ini Fungsi Model Firebase Select dengan Where dengan output fake model,
 *
 * @param array $ref
 * @param string $token
 * @param string $key
 * @param string $value
 * @return \Illuminate\Support\Collection|\App\DummyModel
 */
function fbSelectWhere($ref, $orderBy, $value, $getLast=false)
{
    $result = Firebaseinit($ref)
            ->orderByChild($orderBy)
            ->equalTo($value)
            ->getValue();

    // karena firebase tidak support dengan pengurutan selain asccending atau mendapatkan last value pada array
    // https://github.com/kreait/firebase-php/issues/291
    // jadi untuk mendapatkan data terakhir kita gunakan fungsi end untuk mendaptkan element terakhir
    if ($getLast){
        $result = end($result);
        $results = modelBaru($result);
        return $results;
    }

    $results= collect($result)->map(function ($value, $key) {
        $results = modelBaru($value);
        return $results;
    });

}

/**
 * Ini adalah Reusable Firebase Select All ke model,
 * sehingga tidak perlu membuat duplikasi kode yang berulang
 *
 * @param string $ref
 * @param string $inputdata (if null using key as value required $inputdataname)
 * @param string $inputdataname
 * @return \Illuminate\Http\Response
 */
function FirebaseSelectAllToModel($ref, $addKey = null, $addValue = null)
{
    dd('ganti FirebaseSelectAllToModel() ke fbModelSelect()');
}


function fbModelSelect($ref, $addKey = null, $addValue = '')
{
    $db = FirebaseSelect($ref);
    if (!empty($addKey)) {
        $results = toModelWithAdd($db, $addKey, $addValue);
    } else {
        $results = toModel($db);
    }
    return $results;
}

/**
 * Ini adalah Reusable Firebase Select All ke model,
 * sehingga tidak perlu membuat duplikasi kode yang berulang
 *
 * @param string $ref
 * @param string $inputdata (if null using key as value required $inputdataname)
 * @param string $inputdataname
 * @return \Illuminate\Http\Response
 */
function fbSelectToModelwithAdd($ref, $addKey = null, $addValue = null)
{
    $db = FirebaseSelect($ref);
    if (!empty($addKey)) {
        $results = toModelWithAdd($db, $addKey, $addValue);
    } else {
        $results = toModel($db);
    }
    return $results;
}

/**
 * Ini Fungsi Firebase Select dengan output fake model,
 * dengan melakukan akti penambahan pada attribute model.
 *
 * @param string $ref
 * @param string $token
 * @return \Illuminate\Http\Response
 */
function fbSelectAddToModel($ref, $key, $value ,$token = '')
{
    $model = fbSelectToModel($ref, $token);
    $result = addDataToModel($model, $key, $value);
    return $result;
}

/**
 * Function to Get data from Firebase with condition
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai SELECT denga kondisi where
 * yang berfungsi memperlihatkan data yang telah di querykan.
 *
 * @example where you can using multiarray like
 *      $where = [['COLUMN' => 'val', 'OPERATOR' => 'val', 'VALUE' => 'val']];
 *      $where = array(['COLUMN' => 'val', 'OPERATOR' => 'val', 'VALUE' => 'val']);
 *      $where = array(['COLUMN', 'OPERATOR', 'VALUE']);
 *      $where = [['COLUMN', 'OPERATOR', 'VALUE']];
 *
 *
 * @param string $refer
 * @param string $where
 * @param string $order
 *
 * @link Doc - https://firebase-php.readthedocs.io/en/stable/realtime-database.html#equalto
 *
 * In this time just support equal condition
 * In this time order data just support by value only, but from SDK support Key, value and Child
 *
 * where
 * ['kolom' => $data (array or string)]
 */
function FirebaseSelectWhere($refer,$where = null,$uid = null,  $order = null) {
    // inisialisasi
    $ref = Firebaseinit($refer);
    if (!empty($where) && is_array($where) && !isMultiArray($where)) {
        [$keys, $values] = Arr::divide($where);
        $key = arrayToString($keys);
        $value = arrayToString($values);

        $ref = $ref->orderByChild($key);
        $ref = $ref->equalTo($value);
    }

    $result = $ref->getValue();
    return $result;
}


/**
 * Function to Get data from Firebase
 *
 * Jika di mysql fungsi ini bisa disebutkan sebagai SELECT
 * yang berfungsi memperlihatkan data yang telah di querykan.
 *
 * @param   string  $refer
 * @param   boolean $json
 *
 */
function FirebaseGet($refer, $json = false)
{
    $ref = Firebaseinit($refer);
    //Convert array to json form...
    if ($json){
        $result = $ref->getvalue();
    }else {
        $result = $ref->getvalue();
    }
   return $result;
}

