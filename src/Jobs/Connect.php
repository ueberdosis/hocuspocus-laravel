<?php


namespace Ueberdosis\HocuspocusLaravel\Jobs;


use Illuminate\Auth\Authenticatable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ueberdosis\HocuspocusLaravel\Contracts\IsCollaborative;

class Connect implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected Authenticatable $user;

    protected IsCollaborative $document;

    public function __construct(Authenticatable $user, IsCollaborative $document)
    {
        $this->user = $user;
        $this->document = $document;
    }

    public function handle()
    {
        $this->user->connectTo($this->document);
    }
}
