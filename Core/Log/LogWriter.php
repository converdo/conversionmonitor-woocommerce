<?php

namespace Converdo\ConversionMonitor\Core\Log;

use Converdo\ConversionMonitor\Core\Contracts\Log;

class LogWriter implements Log
{
    /**
     * System is unusable.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->write('EMERGENCY', $this->interpolate($message, $context));
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->write('ALERT', $this->interpolate($message, $context));
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->write('CRITICAL', $this->interpolate($message, $context));
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->write('ERROR', $this->interpolate($message, $context));
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->write('WARNING', $this->interpolate($message, $context));
    }

    /**
     * Normal but significant events.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->write('NOTICE', $this->interpolate($message, $context));
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->write('INFO', $this->interpolate($message, $context));
    }

    /**
     * Detailed debug information.
     *
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->write('DEBUG', $this->interpolate($message, $context));
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param  mixed            $level
     * @param  string           $message
     * @param  array            $context
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->info($message, $context);
    }

    /**
     * Interpolates context values into the message placeholders.
     *
     * @param  string           $message
     * @param  array            $context
     * @return string
     */
    protected function interpolate($message, array $context = array())
    {
        // build a replacement array with braces around the context keys
        $replace = [];

        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (! is_array($val) && (! is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

    /**
     * Returns the file name of the log file.
     *
     * @return string
     */
    protected function output()
    {
        return cvd_config()->environment()['log_file'];
    }

    /**
     * Write a line to the log file.
     *
     * @param string        $level
     * @param string        $text
     */
    public function write($level, $text)
    {
        $date = date(DATE_ATOM);

        $level = strtoupper($level);

        $message = "{$date} {$level}: {$text}". PHP_EOL;

        if (! is_dir(cvd_config()->platform()->pluginPath('/logs'))) {
            mkdir(cvd_config()->platform()->pluginPath('/logs'), 644, true);
        }

        file_put_contents(cvd_config()->platform()->pluginPath("/logs/{$this->output()}"), $message, FILE_APPEND);
    }

    /**
     * Retrieve the last lines of the log file.
     *
     * @param  int          $limit
     * @return array|null
     */
    public function tail($limit)
    {
        if ((int) $limit == 0) {
            return null;
        }

        $file = realpath(cvd_config()->platform()->pluginPath() . '/logs/' . $this->output());

        if (! file_exists($file)) {
            return [];
        }

        return array_reverse(explode(PHP_EOL, LogReader::tailCustom($file, $limit)));
    }
}