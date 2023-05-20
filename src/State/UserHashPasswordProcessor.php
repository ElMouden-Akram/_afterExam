<?php

namespace App\State;

use App\Entity\User;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsDecorator('api_platform.doctrine.orm.state.persist_processor')]
class UserHashPasswordProcessor implements ProcessorInterface
{
    public function __construct(private ProcessorInterface $innerProcessor,private UserPasswordHasherInterface $userPasswordHacher)
    {
        
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if($data instanceof User && $data->getPlainPassword()){
            $data->setPassword($this->userPasswordHacher->hashPassword($data, $data->getPlainPassword()));
        }
        $this->innerProcessor->process($data,$operation,$uriVariables,$context);
    }
}
