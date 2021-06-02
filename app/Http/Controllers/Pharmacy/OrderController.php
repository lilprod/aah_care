<?php

namespace App\Http\Controllers\Pharmacy;


use App\User;
use App\PharmacyDrug;
use App\Drug;
use App\Supplier;
use App\DrugType;
use App\Order;
use App\OrderedDrug;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:pharmacy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacy = auth('pharmacy')->user();

        $orders = $pharmacy->orders;

        return view('pharmacies.admin.orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drugs = PharmacyDrug::all();

        $suppliers = Supplier::all();

        return view('pharmacies.admin.orders.create', compact('drugs', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('order.index')
            ->with('success',
             'Commande ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('pharmacies.admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drugs = PharmacyDrug::all();

        $order = Order::findOrFail($id);

        return view('pharmacies.admin.orders.edit', compact('drugs', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        return redirect()->route('order.index')
            ->with('success',
             'Commande éditée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'Order';
        $historique->user_id = auth('pharmacy')->user()->id;

        $order->delete();
        $historique->save();

        return redirect()->route('order.index')
            ->with('success',
             'Commande supprimée avec succès.');
    }
}
