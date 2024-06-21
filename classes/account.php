<?php
class Account
{
  private int $id;
  private string $firstname;
  private string $lastname;
  private string $email;
  private string $password;
  private string $role;
  private string $updated_at;
  private string $created_at;

  function getId(): int
  {
    return $this->id;
  }

  function getFirstname(): string
  {
    return $this->firstname;
  }

  function getLastname(): string
  {
    return $this->lastname;
  }

  function getEmail(): string
  {
    return $this->email;
  }

  function getRole(): string
  {
    return $this->role;
  }

  function getUpdatedAt(): DateTime
  {
    return new DateTime($this->updated_at);
  }

  function getCreatedAt(): DateTime
  {
    return new DateTime($this->created_at);
  }
}
