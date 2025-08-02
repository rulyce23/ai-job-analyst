<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand as BaseServeCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Env;

class ServeCommand extends BaseServeCommand
{
    /**
     * Get the port for the command.
     *
     * @return int
     */
    protected function port()
    {
        $port = $this->input->getOption('port');

        if (is_null($port)) {
            [, $port] = $this->getHostAndPort();
        }

        // Convert $port to integer to avoid string + int error
        $port = $port ? (int) $port : 8000;

        return $port + $this->portOffset;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on', Env::get('SERVER_HOST', '127.0.0.1')],
            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on', Env::get('SERVER_PORT')],
            ['tries', null, InputOption::VALUE_OPTIONAL, 'The max number of ports to attempt to serve from', 10],
            ['no-reload', null, InputOption::VALUE_NONE, 'Do not reload the development server on .env file changes'],
        ];
    }
}