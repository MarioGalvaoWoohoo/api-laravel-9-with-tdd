<?php

namespace App\Repository\Contracts;

interface MessageRepositoryInterface
{
    public function findAll(): array;
    public function getAllIsActive(): array;
    public function unreadMessages(string $user_id): array;
    public function messagesOnTimeIsActive(): array;
    public function findByMessagePrioritize(): ?object;
    public function create(array $data): object;
    public function findById(int $id): ?object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function deprioritizeAllMessage(): bool;
    public function prioritizeMessage(int $id): object;
    public function checkDisplayedMessage($messageId): bool;
    public function checkIfMessageIsActive($messageId): bool;

}
