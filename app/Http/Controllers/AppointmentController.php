<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;     // <-- IMPORTAÇÃO QUE FALTAVA
use App\Models\User;        // <-- IMPORTAÇÃO QUE FALTAVA
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Mostrar a página inicial com a lista de agendamentos e serviços
    public function index()
    {
        // Busca os agendamentos trazendo junto o usuário e o serviço
        $appointments = Appointment::with(['user', 'service'])->orderBy('appointment_date', 'asc')->get();
        
        // Pega os serviços ativos para o <select> do formulário
        $services = Service::where('active', true)->get();

        return view('appointments.index', compact('appointments', 'services'));
    }

    // Salvar um novo agendamento
    public function store(Request $request)
    {
        // 1. Valida os campos que vêm do formulário novo
        $request->validate([
            'client_name' => 'required|string|max:100',
            'client_phone' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        // 2. Cria um usuário temporário para o cliente (já que não mudamos o fluxo de login ainda)
        $user = User::create([
            'name' => $request->client_name,
            'email' => time() . '@cliente.com', // Gera um email único temporário
            'password' => bcrypt('123456'),
            'type' => 'cliente'
        ]);

        // 3. Busca o serviço para saber a duração e calcular a hora de término
        $service = Service::find($request->service_id);
        $startTime = strtotime($request->start_time);
        $endTime = date('H:i:s', strtotime("+" . $service->duration . " minutes", $startTime));

        // 4. Regra de Negócio: Evitar duplicidade no mesmo dia e horário de início
        $horarioOcupado = Appointment::where('appointment_date', $request->appointment_date)
            ->where('start_time', date('H:i:s', $startTime))
            ->exists();

        if ($horarioOcupado) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['start_time' => 'Este horário já está reservado por outra cliente!']);
        }

        // 5. Salva no banco usando a estrutura nova
        Appointment::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'appointment_date' => $request->appointment_date,
            'start_time' => date('H:i:s', $startTime),
            'end_time' => $endTime,
            'status' => 'pendente',
            'notes' => $request->notes
        ]);

        return redirect()->route('appointments.index')->with('success', 'Unhas agendadas com sucesso!');
    }

    // Cancelar/Deletar um agendamento
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento cancelado!');
    }
}