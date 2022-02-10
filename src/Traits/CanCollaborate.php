<?php


namespace Hocuspocus\Traits;


use Exception;
use Illuminate\Contracts\Auth\Access\Authorizable;
use ReflectionClass;
use Hocuspocus\Models\Collaborator;

trait CanCollaborate
{
    public static function bootCanCollaborate()
    {
        static::created(fn($user) => $user->createNewCollaborator());
        static::deleted(fn($user) => $user->collaborator->delete());

        if (!(new ReflectionClass(static::class))->implementsInterface(Authorizable::class)) {
            throw new Exception("Model \"" . static::class . "\" doesn't implement \"" . Authorizable::class . "\"");
        }
    }

    public function collaborator()
    {
        return $this->morphOne(Collaborator::class, 'model');
    }

    /**
     * Get the access token for authenticating the user
     * @return string
     * @throws Exception
     */
    public function getCollaborationAccessToken(): string
    {
        if (!$this->collaborator) {
            $this->createNewCollaborator();
        }

        return $this->collaborator->token;
    }

    /**
     * Create a new collaborator
     * @throws Exception
     */
    public function createNewCollaborator(): void
    {
        $this->setRelation('collaborator', $this->collaborator()->create([
            'token' => Collaborator::generateToken(),
        ]));
    }
}
