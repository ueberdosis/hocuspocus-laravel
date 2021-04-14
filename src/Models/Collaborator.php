<?php


namespace Ueberdosis\HocuspocusLaravel\Models;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Ueberdosis\HocuspocusLaravel\Contracts\IsCollaborative;

class Collaborator extends Model
{
    protected $table = 'collaborators';

    protected $guarded = [];

    public static function boot()
    {
        static::deleted(fn($collaborator) => $collaborator->documents->each->delete());
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Connect the user from to given collaborative document
     * @param IsCollaborative $document
     */
    public function connectTo(IsCollaborative $document): void
    {
        // TODO: update/create pivot table
    }

    /**
     * Disconnect the user from the given collaborative document
     * @param IsCollaborative $document
     */
    public function disconnectFrom(IsCollaborative $document): void
    {
        // TODO: update pivot
    }

    /**
     * Get collaborator by the given token
     * @param string $token
     * @return Collaborator
     * @throws ModelNotFoundException
     */
    public static function token(string $token): Collaborator
    {
        return static::where('token', $token)->firstOrFail();
    }

    /**
     *  Generate a cryptographically secure token
     * @throws Exception
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}
