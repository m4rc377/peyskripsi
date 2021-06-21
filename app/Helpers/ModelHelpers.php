<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *\
 *                                                                                                     *
 * Ini merupakan Fungsi yang menangani semua model                                                    *
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

function modelBaru($array)
{
    $model = new App\DummyModel;
    collect($array)->map(function ($value, $key) use ($model) {
        $model->$key = $value;
        return $model;
    });
    return $model;
}

function modelToAdd($models,$destKey, $changeValue)
{
    $results = collect($models)->map(function ($model, $key) use ($destKey, $changeValue) {
        Arr::add($model, $destKey, $changeValue);
        dd($model);
        return $model;
    });
    return $results;
}

function toModel($array)
{
    $results = collect($array)->map(function ($value, $key) {
        $model = new App\DummyModel;
        collect($value)->map(function ($value, $key) use ($model) {
            $model->$key = $value;
        });
        return $model;
    });
    return $results;
}

function toModelWithAdd($array, $inputdataname, $inputdata = '')
{
    $dfgdf = toModel($array);
     $results = collect($array)->map(function ($value, $key) use ($inputdata, $inputdataname) {
        $model = new App\DummyModel;
        if (empty($inputdata)){
            $valuedata = $key;
        }else{
            $valuedata = $inputdata;
        }
        $valuename = $inputdataname;
        collect($value)->map(function ($value, $key) use ($model, $valuedata, $valuename) {
            $model->$key = $value;
            Arr::add($model, $valuename, $valuedata); // add token to inside, just in case (this will be error if token not loaded fro begining )
        });
        return $model;
    });
    return $results;
}

/* 
function modelToEdit($model,$destKey, $changeValue)
{
    $results = collect($model)->map(function ($value, $key) use ($destKey, $changeValue) {
        $value->$destKey = $value->$changeValue;
        return $value;
    });
    return $results;
}
 */

