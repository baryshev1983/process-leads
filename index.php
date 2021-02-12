<?php

require_once 'vendor/autoload.php';
require_once 'ThreadProcessLead.php';

/**
 * Класс обработки лидов
 * https://docs.google.com/document/d/12ia3kVyMn0WAaPzXOdRNbqKKE6YTx1MYwuELch7AaVw/edit#
 * Class ProcessLeads
 */
final class ProcessLeads
{
    /** @var int Количество потоков */
    const THREADS_COUNT = 200;

    /** @var int Количество генерируемых лидов */
    const GENERATOR_LEADS_COUNT = 10000;

    private $startedAt;

    /**
     * Фиксируем время запуска
     */
    public function __construct()
    {
        $this->startedAt = microtime(true);
    }

    /**
     * Запускаем генерацию и обработку лидов в потоках
     */
    public function run()
    {
        echo "Запуск обработки лидов\n";

        $pool = new Pool(self::THREADS_COUNT);

        (new \LeadGenerator\Generator)->generateLeads(
            self::GENERATOR_LEADS_COUNT,
            static function (LeadGenerator\Lead $lead) use ($pool) {
                $pool->submit(new ThreadProcessLead($lead));
            }
        );

        $pool->shutdown();
    }

    /**
     * Выводим время работы
     */
    public function __destruct()
    {
        echo sprintf(
            "Время работы %s сек.\n",
            round(microtime(true) - $this->startedAt, 2)
        );
    }
}

(new ProcessLeads)->run();