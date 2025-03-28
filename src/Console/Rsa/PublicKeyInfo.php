<?php

namespace piotrbaczek\rsaexamples\Console\Rsa;

use ReflectionException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use piotrbaczek\rsaexamples\Rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\Rsa\PublicKeyInfo as CommonPublicKeyInfo;

class PublicKeyInfo extends Command
{
    protected static $defaultDescription = 'Displays public key info';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $publicKeyInfo = new CommonPublicKeyInfo(new RsaWrapper());

        $keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');

        $publicKeyInfo->loadKey($keysPath . DIRECTORY_SEPARATOR . 'public.pem');

        $output->writeln('e = ' . $publicKeyInfo->getPublicExponent()->toString());
        $output->writeln('');

        $output->writeln('n = ' . $publicKeyInfo->getModulus()->toString());
        $output->writeln('');

        return 1;
    }
}