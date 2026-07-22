<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:remove-user',
    description: 'Allow an admin to remove a user',
)]
class RemoveUserCommand extends Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'email',
                InputArgument::REQUIRED,
                'Email of the user to remove'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');

        $user = $this->userRepository->findOneBy([
            'email' => $email
        ]);

        if (!$user) {
            $io->error('User not found.');
            return Command::FAILURE;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $io->success(
            sprintf(
                'User %s has been removed.',
                $email
            )
        );

        return Command::SUCCESS;
    }
}