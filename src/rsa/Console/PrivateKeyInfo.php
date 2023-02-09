<?php

namespace piotrbaczek\rsaexamples\rsa\Console;

use piotrbaczek\rsaexamples\rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\rsa\KeyGenerator;
use ReflectionException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PrivateKeyInfo extends Command
{
    protected static $defaultDescription = 'Displays private key info';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateKeyInfo = new \piotrbaczek\rsaexamples\rsa\PrivateKeyInfo(new RsaWrapper());

        $keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');

        $privateKeyInfo->loadKey($keysPath . DIRECTORY_SEPARATOR . 'private.pem',
            KeyGenerator::MY_PRIVATE_KEY_PASSWORD);

        $output->writeln('n= ' . $privateKeyInfo->getModulus()->toString());
        $output->writeln('');

        foreach ($privateKeyInfo->getPrimes() as $key => $prime) {
            $output->writeln('p' . $key . '= ' . $prime->toString());
            $output->writeln('');
        }

        return 1;
    }
}