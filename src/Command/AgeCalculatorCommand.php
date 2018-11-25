<?php

namespace App\Command;

use App\Services\AgeCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AgeCalculatorCommand extends Command
{
    protected static $defaultName = 'app:age:calculator';

    protected function configure()
    {
        $this
            ->setDescription('Calculate the age')
            ->addArgument('date', InputArgument::REQUIRED, 'Birthday date, exp: 2012-10-15')
            ->addOption('adult', null, InputOption::VALUE_NONE, 'is adult?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $date = $input->getArgument('date');

        $birthday = new AgeCalculator($date);
        $age = $birthday->getAge();

        if ($age) {
            $io->note(sprintf('I\'m %s', $age));
        }

        if ($input->getOption('adult')) {
           $age >= 18 ? $io->success('Am I an adult? ---- YES !!!') : $io->warning('Am I an adult? ---- NO !!!');
        }
    }
}
