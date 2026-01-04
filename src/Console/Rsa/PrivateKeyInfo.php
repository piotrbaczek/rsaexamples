<?php

namespace piotrbaczek\rsaexamples\Console\Rsa;

use Override;
use piotrbaczek\rsaexamples\Rsa\KeyGenerator;
use ReflectionException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use piotrbaczek\rsaexamples\Rsa\PrivateKeyInfo as CommonPrivateKeyInfo;
use piotrbaczek\rsaexamples\Rsa\Common\RsaWrapper;

class PrivateKeyInfo extends Command
{
    protected static $defaultDescription = 'Displays private key info';

    #[Override] protected function configure(): void
    {
        $this->addArgument('password', InputArgument::OPTIONAL, 'Rsa key password', KeyGenerator::MY_PRIVATE_KEY_PASSWORD);
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $privateKeyInfo = new CommonPrivateKeyInfo(new RsaWrapper());

        $keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');

        $privateKeyInfo->loadKey(
            $keysPath . DIRECTORY_SEPARATOR . 'private.pem',
            $input->getArgument('password')
        );

        $modulus = $privateKeyInfo->getModulus();

        $output->writeln('n = ' . $modulus->toString());
        $output->writeln('');

        $output->writeln('Length: ' . mb_strlen($modulus->toString()));
        $output->writeln('');

        $primes = $privateKeyInfo->getPrimes();

        $output->writeln('p = ' . $primes[1]->toString());
        $output->writeln('');

        $output->writeln('q = ' . $primes[2]->toString());
        $output->writeln('');

        return 1;
    }
}