<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jsonString = file_get_contents(asset('assets/parquet_json.json'));
        $data = json_decode($jsonString);
        $devices = [];
        foreach($data as $r) {
            $device['status'] = 'success';
            $stamp = Carbon::parse($r->stamp);
            $days = $stamp->diffInDays(Carbon::now());

            if($days > 1) {
                $device['status'] = 'danger';
            } elseif($days <= 1 && $days <> 0) {
                $device['status'] = 'warning';
            }

            $device['id'] = $r->id;
            $device['stamp'] = Carbon::createFromDate($r->stamp)->format('d/m/Y');
            $device['bat'] = $r->bat;
            $device['temp'] = $r->temp;
            $device['umi'] = $r->umi;
            $device['lon'] = $r->lon;
            $device['lat'] = $r->lat;
            $device['co2'] = $r->co2;
            $device['co2'] = $r->co2;

            $devices[] = (object) $device;
        }

        return view('dashboard.index', compact('devices'));
    }
}
