<?php

use \LeadGenerator\Lead;

/**
 * Обработка Лида (длительный процесс)
 * Class ThreadProcessLead
 * @property $lead Lead
 */
final class ThreadProcessLead extends Threaded
{
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /** Записываем обработанный лид в файл */
    private function logResultOfWork()
    {
        file_put_contents('file.log',
            sprintf("%s | %s | %s\n",
                $this->lead->id,
                $this->lead->categoryName,
                (new \DateTime)->format('Y-m-d H:i:s')
            ),
            FILE_APPEND | LOCK_EX
        );
    }

    /** Обрабатываем полученный лид */
    public function run()
    {
        sleep(2);
        $this->logResultOfWork();
    }
}