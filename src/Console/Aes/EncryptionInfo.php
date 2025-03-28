<?php

namespace piotrbaczek\rsaexamples\Console\Aes;

use Exception;
use phpseclib3\Crypt\AES;
use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\Aes\Common\AesWrapper;
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
        $this->addArgument('key', InputArgument::REQUIRED);
        $this->addArgument('key_length', InputArgument::OPTIONAL, '', 128);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $aes = new AES('cbc');

        $aesWrapper = new AesWrapper($aes);
        $cipherText = $aesWrapper
            ->setKey($input->getArgument('key'))
            ->setKeyLength($input->getArgument('key_length'))
            ->encrypt($input->getArgument('message'));

        $output->writeln(' RAW Ciphertext:');
        $output->writeln($cipherText);
        $output->writeln('');

        $cipherTextInDecimal = new BigInteger($cipherText, 256);

        $output->writeln('Ciphertext in decimal: ' . $cipherTextInDecimal->toString());

        $decryptedMessage = $aesWrapper->decrypt($cipherText);
        $output->writeln('Decrypted message: ' . $decryptedMessage);

        return 1;
    }
}