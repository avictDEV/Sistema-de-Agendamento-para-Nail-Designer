<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

// Rota para ver a tela principal
Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');

// Rota para enviar o formulário de agendamento
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

// Rota para deletar um agendamento
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
