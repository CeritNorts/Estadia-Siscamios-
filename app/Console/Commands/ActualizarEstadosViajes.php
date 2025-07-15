<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Viaje;
use Carbon\Carbon;

class ActualizarEstadosViajes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viajes:actualizar-estados 
                           {--force : Forzar actualización de todos los viajes}
                           {--verbose : Mostrar información detallada}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza automáticamente los estados de los viajes según sus fechas y horas programadas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🚛 Iniciando actualización de estados de viajes...');
        $this->newLine();

        $inicio = microtime(true);
        $viajesActualizados = 0;
        $viajesRevisados = 0;

        try {
            // Obtener viajes que pueden ser actualizados
            $query = Viaje::with(['camion', 'chofer', 'cliente']);
            
            if (!$this->option('force')) {
                // Solo viajes que pueden cambiar automáticamente
                $query->whereIn('estado', [
                    Viaje::ESTADO_PROGRAMADO,
                    Viaje::ESTADO_TRANSITO
                ]);
            }

            $viajes = $query->get();
            $viajesRevisados = $viajes->count();

            if ($viajesRevisados === 0) {
                $this->info('ℹ️  No hay viajes para actualizar.');
                return Command::SUCCESS;
            }

            $this->info("📋 Revisando {$viajesRevisados} viaje(s)...");
            
            if ($this->option('verbose')) {
                $this->newLine();
                $progressBar = $this->output->createProgressBar($viajesRevisados);
                $progressBar->start();
            }

            foreach ($viajes as $viaje) {
                $estadoAnterior = $viaje->estado;
                
                if ($viaje->actualizarEstadoAutomatico()) {
                    $viajesActualizados++;
                    
                    if ($this->option('verbose')) {
                        $this->newLine();
                        $this->line("✅ Viaje VJ-{$viaje->id}: {$estadoAnterior} → {$viaje->estado}");
                        $this->line("   📍 Ruta: {$viaje->ruta}");
                        $this->line("   🚛 Camión: " . ($viaje->camion->placa ?? 'Sin asignar'));
                        $this->newLine();
                    }
                }

                if ($this->option('verbose')) {
                    $progressBar->advance();
                }
            }

            if ($this->option('verbose')) {
                $progressBar->finish();
                $this->newLine(2);
            }

            // Mostrar estadísticas finales
            $this->mostrarEstadisticas($viajesActualizados, $viajesRevisados);

            // Verificar viajes retrasados
            $this->verificarViajesRetrasados();

            $tiempoTotal = round(microtime(true) - $inicio, 2);
            $this->newLine();
            $this->info("⏱️  Proceso completado en {$tiempoTotal} segundos");

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Error durante la actualización: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Mostrar estadísticas de la actualización
     */
    private function mostrarEstadisticas($actualizados, $revisados)
    {
        $this->info("📊 Resultados de la actualización:");
        $this->table(
            ['Métrica', 'Cantidad'],
            [
                ['Viajes revisados', $revisados],
                ['Viajes actualizados', $actualizados],
                ['Sin cambios', $revisados - $actualizados]
            ]
        );

        // Estadísticas por estado
        $estadisticas = [
            'Programados' => Viaje::where('estado', Viaje::ESTADO_PROGRAMADO)->count(),
            'En Tránsito' => Viaje::where('estado', Viaje::ESTADO_TRANSITO)->count(),
            'Entregados' => Viaje::where('estado', Viaje::ESTADO_ENTREGADO)->count(),
            'Retrasados' => Viaje::where('estado', Viaje::ESTADO_RETRASADO)->count(),
        ];

        $this->newLine();
        $this->info("📈 Estado actual de todos los viajes:");
        
        $tableData = [];
        foreach ($estadisticas as $estado => $cantidad) {
            $tableData[] = [$estado, $cantidad];
        }
        
        $this->table(['Estado', 'Cantidad'], $tableData);
    }

    /**
     * Verificar y reportar viajes retrasados
     */
    private function verificarViajesRetrasados()
    {
        $ahora = Carbon::now();
        
        $viajesRetrasados = Viaje::whereIn('estado', [
            Viaje::ESTADO_PROGRAMADO,
            Viaje::ESTADO_TRANSITO
        ])->where('fecha_llegada', '<', $ahora)->get();

        if ($viajesRetrasados->count() > 0) {
            $this->newLine();
            $this->warn("⚠️  Se encontraron {$viajesRetrasados->count()} viaje(s) retrasado(s):");
            
            foreach ($viajesRetrasados as $viaje) {
                $retrasoHoras = Carbon::parse($viaje->fecha_llegada)->diffInHours($ahora);
                $this->line("   • VJ-{$viaje->id} - Retraso: {$retrasoHoras}h - Ruta: {$viaje->ruta}");
                
                // Marcar como retrasado automáticamente
                $viaje->marcarComoRetrasado();
            }
            
            $this->info("✅ Viajes marcados automáticamente como retrasados.");
        }
    }
}