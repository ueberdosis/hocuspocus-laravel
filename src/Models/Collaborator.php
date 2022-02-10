<?php


namespace Hocuspocus\Models;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Hocuspocus\Contracts\Collaborative;

class Collaborator extends Model
{
    protected $table = 'collaborators';

    protected $guarded = [];

    public static function boot()
    {
        static::deleted(fn($collaborator) => $collaborator->documents->each->delete());

        parent::boot();
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
     * @param Collaborative $document
     */
    public function connectTo(Collaborative $document): void
    {
        $this->getOrCreateDocument($document)->update([
            'connected' => true,
            'connected_at' => now(),
        ]);
    }

    /**
     * Disconnect the user from the given collaborative document
     * @param Collaborative $document
     */
    public function disconnectFrom(Collaborative $document): void
    {
        $this->getOrCreateDocument($document)->update([
            'connected' => false,
        ]);
    }

    /**
     * Get or create the document pivot table entry
     * @param Collaborative $document
     * @return Document
     */
    protected function getOrCreateDocument(Collaborative $document): Document
    {
        $pivot = $this->documents()->byModel($document)->first();

        if (!$pivot) {
            $pivot = $this->documents()->create([
                'model_type' => get_class($document),
                'model_id' => $document->id,
                'connected' => true,
                'connected_at' => now(),
            ]);
        }

        return $pivot;
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
