<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRecordCreated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    protected $record;
    protected $type;
    public function __construct(mixed $record, string $type)
    {
        $this->record = $record;
        $this->type = $type;
    }

    public function broadcastAs(): string
    {
        return 'record_created';
    }

    public function broadcastWith(): array
    {
        return [
            'record' => $this->record->name,
            'type' => $this->type,
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('public-channel')
        ];
    }
}
