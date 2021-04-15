<?php


namespace Ueberdosis\HocuspocusLaravel\Traits;


use Illuminate\Support\Collection;
use Ueberdosis\HocuspocusLaravel\Models\Document;

trait IsCollaborative
{
    public static function bootIsCollaborative()
    {
        static::deleted(fn($model) => $model->documents->each->delete());
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'model');
    }

    public function getConnectedUsers(): Collection
    {
        return $this->documents()
            ->where('connected', true)
            ->with('collaborator.model')
            ->get()
            ->pluck('collaborator.model');
    }

    public function getCollaborativeAttributes(): array
    {
        return $this->collaborativeAttributes ?? [];
    }

    public function getCollaborationDocumentName(): string
    {
        return urlencode(get_called_class() . ":" . $this->id);
    }
}
