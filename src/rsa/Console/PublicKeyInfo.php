<?php

namespace piotrbaczek\rsaexamples\rsa\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublicKeyInfo extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($input);die();
    }
}