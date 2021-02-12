<?php
require_once 'InterfaceThreadProcess.php';

use \LeadGenerator\Lead;

/**
 * Обработка Лида (длительный процесс)
 * Class ThreadProcessLead
 * @property $lead Lead
 */
final class ThreadProcessLead extends Threaded implements InterfaceThreadProcess
{
    const LOG_FILE = 'log.txt';

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Записываем обработанный лид в файл
     */
    private function logResultOfWork()
    {
        file_put_contents(self::LOG_FILE,
            sprintf("%s | %s | %s\n",
                $this->lead->id,
                $this->lead->categoryName,
                (new \DateTime)->format('Y-m-d H:i:s')
            ),
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * Обрабатываем полученный лид
     */
    public function run()
    {
        sleep(2);
        $this->logResultOfWork();
    }
}