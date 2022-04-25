<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ContractsValidationValidator;
use Illuminate\Validation\Validator as ValidationValidator;
use Validator;

class DeviceController extends Controller
{
    function add(Request $req)
    {
        $device = new Device;
        $device->name->req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if ($result) {
            return ["Result" => "Data has been saved"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }

    function update(Request $req)
    {
        $device = Device::find($req->id);
        $device->name = $req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if ($result) {
            return ["Result" => "Data is updated"];
        } else {
            return ["result" => "update operation has been failed"];
        }
    }
    function search($name)
    {
        return Device::where("name", "like", "%" . $name . "%")->get();
    }

    function delete($id)
    {
        $device = Device::find($id);
        $result = $device->delete();
        if ($result) {
            return ["result" => "record has been deleted" . $id];
        } else {
            return ["result" => "delete operation is failed"];
        }
    }

    function testData(Request $req)
    {
        $rules = array(
            "member_id" => "required|min:2|max:4"
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $device = new Device;
            $device->name->req->name;
            $device->member_id = $req->member_id;
            $result = $device->save();
            if ($result) {
                return ["Result" => "Data has been saved"];
            } else {
                return ["Result" => "Operation failed"];
            }
        }
    }
}
