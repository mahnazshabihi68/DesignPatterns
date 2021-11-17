<?php
abstract class AbstractChain
{
    /** @var self */
    private $next;
 
    public function linkNext(self $next): self
    {
        $this->next = $next;
 
        return $next;
    }
 
    public function check(User $user): bool
    {
        return $this->next ? $this->next->check($user) : true;
    }
}


class CredentialChain extends AbstractChain
{
    private $validCredentials = [
        ['username' => 'hello', 'password' => '123123'],
        ['username' => 'mahnaz', 'password' => '321321'],
        ['username' => 'mahnaz', 'password' => '123123']
    ];
 
    public function check(User $user): bool
    {
        foreach ($this->validCredentials as $validCredential) {
            if (
                $user->getUsername() === $validCredential['username'] &&
                $user->getPassword() === $validCredential['password']
            ) {
                return parent::check($user);
            }
        }
 
        throw new Exception('Invalid credentials.');
    }
}

class StatusChain extends AbstractChain
{
    public function check(User $user): bool
    {
        if ($user->isActive()) {
            return parent::check($user);
        }
 
        throw new Exception('Invalid status.');
    }
}

class RoleChain extends AbstractChain
{
    private $validRoles = [
        'STUDENT',
        'LECTURER',
        'ADMIN',
    ];
 
    public function check(User $user): bool
    {
        foreach ($this->validRoles as $validRole) {
            if ($user->getRole() === $validRole) {
                return parent::check($user);
            }
        }
 
        throw new Exception('Invalid role.');
    }
}



class User
{
    private $username;
    private $password;
    private $role;
    private $isActive;
 
    public function __construct(string $username, string $password, string $role, bool $isActive)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->isActive = $isActive;
    }
 
    public function getUsername(): string
    {
        return $this->username;
    }
 
    public function getPassword(): string
    {
        return $this->password;
    }
 
    public function getRole(): string
    {
        return $this->role;
    }
 
    public function isActive(): bool
    {
        return $this->isActive;
    }
}


class Authenticate
{
    private $chain;
 
    public function __construct(AbstractChain $chain)
    {
        $this->chain = $chain;
    }
 
    public function login(User $user): bool
    {
        return $this->chain->check($user);
    }
}

$chain = new CredentialChain();
$chain
    ->linkNext(new StatusChain())
    ->linkNext(new RoleChain());
 
try {
    (new Authenticate($chain))
        ->login(
            new User('mahnaz', '123123', 'ADMIN', true)
        );
 
    echo 'Success'.PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage().PHP_EOL;
}