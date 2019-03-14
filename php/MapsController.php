<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\UsersSchedule;
use App\ServiceOrder;

class MapsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $breadcrumbs =  [
             (object)[
                 'href' => false,
                 'i' => false,
                 'title' => __('Mapa')
             ]
         ];
         $filters = [
             'user_id' => ''
         ];
         $page_title = 'Mapas';
         $users = User::where('group_id', 3)->get();

         return view('maps.view', compact('page_title', 'users', 'filters'));
     }

     public function search(Request $request)
     {
         $breadcrumbs =  [
             (object)[
                 'href' => false,
                 'i' => false,
                 'title' => __('Mapa')
             ]
         ];

         $page_title = 'Mapa';
         $filters = [
             'user_id' => ''
         ];

         $users = User::where('group_id', 3)->get();

         $maps = UsersSchedule::where('user_id', $request->user_id)
         ->whereDate('start_time', $request->date)
         ->with('service_order')
         ->get();
         //pegando primeiro registro
         $mapStart = UsersSchedule::where('user_id', $request->user_id)
         ->whereNotNull('os_id')
         ->whereDate('start_time', $request->date)
         ->with(['service_order' => function($query){
            $query->whereNotNull('location');
         }, 'user'])->first();
         //pegando ultimo registro
         $map_end = UsersSchedule::where('user_id', $request->user_id)
         ->whereNotNull('os_id')
         ->whereDate('start_time', $request->date)
         ->with(['service_order' => function($query){
            $query->whereNotNull('location');
         }, 'user'])->get()->last();

         //todos agendamentos
         $addresses = DB::table('users_schedules')
         ->where('user_id', $request->user_id)
         ->whereDate('start_time', $request->date)
         ->join('contracts', 'contracts.id', '=',
          'users_schedules.contract_id')
          ->join('clients', 'clients.id', '=',
          'contracts.client_id')
          ->get();

          //primeiro agendamento
          $address_start = DB::table('users_schedules')
          ->where('user_id', $request->user_id)
          ->whereDate('start_time', $request->date)
          ->join('contracts', 'contracts.id', '=',
           'users_schedules.contract_id')
           ->join('clients', 'clients.id', '=',
           'contracts.client_id')
          ->first();

           //ultimo agendamento
           $address_end = DB::table('users_schedules')
           ->where('user_id', $request->user_id)
           ->whereDate('start_time', $request->date)
           ->join('contracts', 'contracts.id', '=',
            'users_schedules.contract_id')
            ->join('clients', 'clients.id', '=',
            'contracts.client_id')
            ->get()->last();

         return view('maps.view', compact('page_title', 'maps','users', 'mapStart', 'map_end', 'address_start', 'addresses', 'address_end', 'filters'));
     }
}
