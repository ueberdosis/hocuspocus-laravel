<?php


namespace Ueberdosis\HocuspocusLaravel\Jobs;


use Illuminate\Auth\Authenticatable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ueberdosis\HocuspocusLaravel\Contracts\Collaborative;

class Change implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected Authenticatable $user;

    protected Collaborative $document;

    protected array $payload;

    public function __construct(Authenticatable $user, Collaborative $document, array $payload)
    {
        $this->user = $user;
        $this->document = $document;
        $this->payload = $payload;
    }

    public function handle()
    {
        $allowed = $this->document->getCollaborativeAttributes();

        foreach ($this->payload as $attribute => $content) {
            if (!in_array($attribute, $allowed)) {
                continue;
            }

            $this->document->{$attribute} = $content;
        }

        $this->document->save();
    }
}
