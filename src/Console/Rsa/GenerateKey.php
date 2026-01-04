<?php

namespace piotrbaczek\rsaexamples\Console\Rsa;

use Override;
use piotrbaczek\rsaexamples\Rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\Rsa\KeyGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateKey extends Command
{
    protected static $defaultDescription = 'Generates Keys';

    protected function configure(): void
    {
        parent::configure();
        $this->addArgument('length', InputArgument::REQUIRED, 'Length of RSA Key');
        $this->addArgument('password', InputArgument::REQUIRED, 'Password for the key');
    }

    #[Override] protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $keyGenerator = new KeyGenerator(new RsaWrapper());

        $keyGenerator->generate(
            $input->getArgument('length'),
            $input->getArgument('password'),
            realpath(__DIR__ . '/../../../keys'),
            'private.pem',
            'public.pem'
        );

        return Command::SUCCESS;
    }
}