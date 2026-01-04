<?php

namespace piotrbaczek\rsaexamples\Console\Rsa;

use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\Rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\Rsa\KeyGenerator;
use piotrbaczek\rsaexamples\Rsa\PrivateKeyInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EncryptionInfo extends Command
{
    protected static $defaultDescription = 'Encryption example';

    protected function configure(): void
    {
        $this->addArgument('message', InputArgument::REQUIRED);
        $this->addArgument('password', InputArgument::OPTIONAL, 'Private key password', KeyGenerator::MY_PRIVATE_KEY_PASSWORD);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());

        $keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');

        $privateKeyInfo->loadKey(
            $keysPath . DIRECTORY_SEPARATOR . 'private.pem',
            $input->getArgument('password')
        );

        $publicKey = $privateKeyInfo->getKey()->getPublicKey();

        $cipherText = $publicKey->encrypt($input->getArgument('message'));


        $output->writeln(' RAW Ciphertext:');
        $output->writeln($cipherText);
        $output->writeln('');

        $cipherTextInDecimal = new BigInteger($cipherText, 256);

        $output->writeln('Ciphertext in decimal: ' . $cipherTextInDecimal->toString());

        $decryptedMessage = $privateKeyInfo->getKey()->decrypt($cipherText);
        $output->writeln('Decrypted message: ' . $decryptedMessage);

        return Command::SUCCESS;
    }
}