<?php

namespace App\Controllers; 

use App\Models\ReservaModel;
use App\Models\UsuarioModel;

class Reserva extends BaseController
{
    public function crear($id)
    {
        $cabanas = [
            1 => 'Cabaña Bosque',
            2 => 'Cabaña Lago',
            3 => 'Cabaña Montaña'
        ];

        return view('reserva_form', [
            'cabana_id' => $id,
            'cabana_nombre' => $cabanas[$id] ?? 'Cabaña'
        ]);
    }

   public function guardar()
{
    if (!session()->get('usuario_id')) {
        return redirect()->to('login');
    }

    $model = new ReservaModel();

    $existe = $model
        ->where('cabana_id', $this->request->getPost('cabana'))
        ->groupStart()
            ->where('fecha_entrada <=', $this->request->getPost('fecha_hasta'))
            ->where('fecha_salida >=', $this->request->getPost('fecha_desde'))
        ->groupEnd()
        ->first();

    if ($existe) {
        return redirect()->back()->with('error', 'La cabaña ya está reservada en esas fechas');
    }

    $fecha1 = new \DateTime($this->request->getPost('fecha_desde'));
    $fecha2 = new \DateTime($this->request->getPost('fecha_hasta'));

    $dias = $fecha1->diff($fecha2)->days;

    $precio = 15000;
    $monto = $dias * $precio;

    $data = [
        'fecha_entrada' => $this->request->getPost('fecha_desde'),
        'fecha_salida' => $this->request->getPost('fecha_hasta'),
        'cantHuesped' => $this->request->getPost('huespedes'),
        'monto' => $monto,
        'usuario_id' => session()->get('usuario_id'), 
        'cabana_id' => $this->request->getPost('cabana'),
        'mediosPago_id' => 1
    ];

    $model->insert($data);

    return redirect()->to(site_url('mis-reservas'));
}

    public function misReservas()
{
    if (!session()->get('usuario_id')) {
        return redirect()->to('login');
    }

    $model = new ReservaModel();

    $data['reservas'] = $model
        ->where('usuario_id', session()->get('usuario_id'))
        ->findAll();

    return view('mis_reservas', $data);
}
}