<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Profissional - Nail Designer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-rose-50 p-4 md:p-8">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow-xl border border-rose-100">
        <h1 class="text-3xl font-bold mb-6 text-rose-600 text-center md:text-left">💅 Agendamento Nail Designer</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('start_time'))
            <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded-lg mb-4">
                {{ $errors->first('start_time') }}
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-rose-50/50 p-5 rounded-xl mb-8">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Cliente</label>
                <input type="text" name="client_name" class="w-full border p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                <input type="text" name="client_phone" placeholder="(11) 99999-9999" class="w-full border p-2 rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Procedimento Desejado</label>
                <select name="service_id" class="w-full border p-2 rounded-lg bg-white" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->name }} (R$ {{ number_format($service->price, 2, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data do Atendimento</label>
                <input type="date" name="appointment_date" class="w-full border p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Horário de Início</label>
                <input type="time" name="start_time" class="w-full border p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observações (Opcional)</label>
                <input type="text" name="notes" placeholder="Ex: Formato quadrado, glitter..." class="w-full border p-2 rounded-lg">
            </div>
            
            <button type="submit" class="md:col-span-3 bg-rose-500 text-white font-bold p-3 rounded-lg hover:bg-rose-600 transition shadow-md mt-2">
                Confirmar Novo Agendamento
            </button>
        </form>

        <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">📅 Próximos Atendimentos na Agenda</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-rose-100 text-rose-700 font-medium">
                        <th class="p-3">Data</th>
                        <th class="p-3">Horário (Início - Fim)</th>
                        <th class="p-3">Cliente</th>
                        <th class="p-3">Procedimento Escolhido</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $app)
                        <tr class="border-b hover:bg-gray-50 text-sm">
                            <td class="p-3 font-medium text-gray-700">
                                {{ date('d/m/Y', strtotime($app->appointment_date)) }}
                            </td>
                            <td class="p-3 font-bold text-gray-600">
                                {{ date('H:i', strtotime($app->start_time)) }} às {{ date('H:i', strtotime($app->end_time)) }}
                            </td>
                            <td class="p-3">
                                <div class="font-bold text-gray-800">{{ $app->user->name }}</div>
                                <div class="text-xs text-gray-500">Logada como Cliente</div>
                            </td>
                            <td class="p-3">
                                <span class="bg-rose-100 text-rose-800 text-xs px-2 py-1 rounded-full font-semibold">
                                    {{ $app->service->name }}
                                </span>
                                <div class="text-xs text-gray-400 mt-1">Duração: {{ $app->service->duration }} min</div>
                            </td>
                            <td class="p-3">
                                <span class="capitalize px-2 py-1 rounded text-xs font-bold bg-yellow-100 text-yellow-800">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="p-3">
                                <form action="{{ route('appointments.destroy', $app->id) }}" method="POST" onsubmit="return confirm('Cancelar este atendimento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:underline font-semibold">
                                        Cancelar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">Nenhum agendamento relacional criado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>