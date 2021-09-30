<?php

namespace App\Services;

use App\Exceptions\CampeonatoAlreadyHasMatchesException;
use App\Exceptions\CampeonatoWithoutTimesException;
use App\Models\Campeonato;
use App\Models\Transmissao;
use Carbon\Carbon;

class CampeonatoService
{
    public static ?CampeonatoService $instance = null;
    protected Campeonato $campeonato;

    public function __construct(Campeonato $campeonato)
    {
        $this->campeonato = $campeonato;
    }

    public static function mount(Campeonato $campeonato): CampeonatoService
    {
        if ($campeonato->load('times')->times) {
            throw new CampeonatoWithoutTimesException('Esse campeonato não possui times!');
        }

        if ($campeonato->load('partidas')->partidas) {
            throw new CampeonatoAlreadyHasMatchesException('Esse campeonato já tem partidas geradas!');
        }

        if (is_null(self::$instance)) {
            self::$instance = new self($campeonato);
        }

        return self::$instance->setCampeonato($campeonato);
    }

    public function getCampeonato(): Campeonato
    {
        return $this->campeonato;
    }

    public function setCampeonato(Campeonato $campeonato): CampeonatoService
    {
        $this->campeonato = $campeonato;
        return $this;
    }

    public function generatePartidas()
    {
        $campeonato = $this->getCampeonato()->load('times');
        $times = $campeonato->times;
        $data = Carbon::now();
        $partidas = [];

        foreach ($times as $timeCurrent) {
            foreach ($times as $time) {
                if ($timeCurrent->id == $time->id) continue;

                $transmissao = ['tv', 'radio', 'lives'];

                $partida = [
                    'partida' => [
                        'mandante' => $timeCurrent->id,
                        'visitante' => $time->id,
                        'data_partida' => $data->toDateTimeString(),
                        'campeonato_id' => $campeonato->id,
                    ],
                    'resultado' => [
                        'gols_mandante' => 0,
                        'gols_visitante' => 0,
                    ],
                    'transmissao' => $transmissao[array_rand($transmissao)]
                ];

                $partidas[] = $partida;
                $data->addWeek(1);
            }

            $data->addDays(2);
        }

        return $partidas;
    }
}
