<?php

namespace Rakhasa\Whatsapp\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rakhasa\Whatsapp\Contracts\Event;

class MessageDocEvent implements Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * event source
     *
     * @var string
     */
    public string $source;

    /**
     * event type
     *
     * @var string
     */
    public string $type;

    /**
     * webhook data
     *
     * @var array
     */
    public array $data;

    /**
     * Create a new event instance.
     *
     * @param string $source
     * @param string $type
     * @param array $data
     * @return void
     */
    public function __construct(string $source, string $type, array $data)
    {
        $this->source = $source;
        $this->type = $type;
        $this->data = $data;
    }
}
